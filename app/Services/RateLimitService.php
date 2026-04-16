<?php

namespace App\Services;

use App\Models\BotPreventionLog;

class RateLimitService
{
    protected int $defaultLimit = 5;
    protected int $defaultWindow = 3600; // 1 hour

    /**
     * Check if the submission is within the rate limit
     *
     * @param string $ipAddress
     * @param string $formType (contact, consultation, career, newsletter)
     * @param int $limit Number of submissions allowed per window
     * @param int $windowSeconds Time window in seconds (default: 3600 = 1 hour)
     * @return array ['allowed' => bool, 'remaining' => int, 'resetAt' => datetime]
     */
    public function checkRateLimit($ipAddress, $formType, $limit = null, $windowSeconds = null)
    {
        $limit = $limit ?? $this->defaultLimit;
        $windowSeconds = $windowSeconds ?? $this->defaultWindow;

        // Get current submission count within the window
        $submissionCount = BotPreventionLog::getSubmissionCount($ipAddress, $formType, $windowSeconds);

        if ($submissionCount >= $limit) {
            // Rate limit exceeded
            $log = BotPreventionLog::where('ip_address', $ipAddress)
                ->where('form_type', $formType)
                ->first();

            $resetAt = $log->last_submitted_at->addSeconds($windowSeconds);

            return [
                'allowed' => false,
                'remaining' => 0,
                'resetAt' => $resetAt,
            ];
        }

        // Log the submission
        BotPreventionLog::logSubmission($ipAddress, $formType);

        return [
            'allowed' => true,
            'remaining' => $limit - ($submissionCount + 1),
            'resetAt' => now()->addSeconds($windowSeconds),
        ];
    }

    /**
     * Check if a submission is allowed (convenience method)
     */
    public function isAllowed($ipAddress, $formType, $limit = null, $windowSeconds = null)
    {
        return $this->checkRateLimit($ipAddress, $formType, $limit, $windowSeconds)['allowed'];
    }

    /**
     * Get submission details for debugging
     */
    public function getDetails($ipAddress, $formType)
    {
        return BotPreventionLog::where('ip_address', $ipAddress)
            ->where('form_type', $formType)
            ->first();
    }
}

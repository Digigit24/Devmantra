<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BotPreventionLog extends Model
{
    protected $table = 'bot_prevention_logs';

    protected $fillable = [
        'ip_address',
        'form_type',
        'submission_count',
        'last_submitted_at',
    ];

    protected $casts = [
        'submission_count' => 'integer',
        'last_submitted_at' => 'datetime',
    ];

    /**
     * Update or create a submission log for the given IP and form type
     */
    public static function logSubmission($ipAddress, $formType)
    {
        return self::updateOrCreate(
            ['ip_address' => $ipAddress, 'form_type' => $formType],
            [
                'submission_count' => \Illuminate\Support\Facades\DB::raw('submission_count + 1'),
                'last_submitted_at' => now(),
            ]
        );
    }

    /**
     * Get submission count for the given IP and form type within the specified window
     */
    public static function getSubmissionCount($ipAddress, $formType, $windowSeconds = 3600)
    {
        $log = self::where('ip_address', $ipAddress)
            ->where('form_type', $formType)
            ->first();

        if (!$log) {
            return 0;
        }

        // If the last submission was within the window, return the count
        if ($log->last_submitted_at->diffInSeconds(now()) <= $windowSeconds) {
            return $log->submission_count;
        }

        // Reset the counter if the window has passed
        $log->update([
            'submission_count' => 0,
            'last_submitted_at' => now(),
        ]);

        return 0;
    }
}

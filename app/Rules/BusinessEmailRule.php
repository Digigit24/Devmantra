<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BusinessEmailRule implements ValidationRule
{
    /**
     * List of free email domains to block
     */
    protected array $freeEmailDomains = [
        'gmail.com',
        'yahoo.com',
        'outlook.com',
        'hotmail.com',
        'mail.com',
        'protonmail.com',
        'aol.com',
        'icloud.com',
        'yandex.com',
        'mailinator.com',
        '10minutemail.com',
        'guerrillamail.com',
        'temp-mail.org',
        'tempmail.com',
        'trashmail.com',
        'throwaway.email',
        'maildrop.cc',
        'mytrashmail.com',
        'emailondeck.com',
        'fakeinbox.com',
        'mintemail.com',
        'tempmail.net',
        'temp-mail.io',
        'yopmail.com',
        'sharklasers.com',
        'test.com',
        'example.com',
    ];

    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Extract domain from email
        $parts = explode('@', $value);
        if (count($parts) !== 2) {
            $fail('The :attribute must be a valid email address.');
            return;
        }

        $domain = strtolower($parts[1]);

        // Check if domain is in the free email domains list
        if (in_array($domain, $this->freeEmailDomains, true)) {
            $fail('The :attribute must be a business email address. Personal email addresses are not allowed.');
            return;
        }
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class NotSpamBot implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // If the honeypot field has a value, it's likely a bot
        if (!empty($value)) {
            $fail('Invalid form submission detected.');
            return;
        }
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordRules implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9])(?!.*\s).+$/' , $value))
            $fail('The :attribute must contain at least one uppercase letter, one number, and one special character, and must not contain spaces.');
    }
}

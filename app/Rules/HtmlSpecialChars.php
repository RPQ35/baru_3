<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class HtmlSpecialChars implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== htmlspecialchars($value, ENT_QUOTES)) {
            $fail('The :attribute contains invalid HTML characters.');
        }
    }
}
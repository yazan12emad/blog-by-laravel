<?php

namespace App\Http\Requests;

use App\Rules\PasswordRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPassword extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'exists:users,email'],
            'token' => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', new PasswordRules()],
        ];
    }
}

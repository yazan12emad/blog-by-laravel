<?php

namespace App\Http\Requests;

use App\Rules\PasswordRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class logInRequest extends FormRequest
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
            'email' => ['required','string','email','max:30'],
            'password' => ['required','min:8', new PasswordRules()],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Please enter email',
            'password.required' => 'Please enter password',
        ];
    }
}

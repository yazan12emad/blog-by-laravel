<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->id() === $this->route('user')->id;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:20',
            'email' => [
                'required',
                'string',
                'email',
                'max:30',
                Rule::unique('users', 'email')->ignore($this->route('user')->id),
            ],
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.unique' => 'This email address is already in use.',
            'profile_image.image' => 'Please upload a valid image file.',
            'profile_image.max' => 'The profile image must be smaller than 2 MB.',
            'password.confirmed' => 'The password confirmation does not match.',
        ];
    }
}

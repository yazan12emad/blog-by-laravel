<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlog extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'short_desc' => 'required|string|max:255',
            'category_id'=>'required|exists:category,id',
            'image'=>'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
    public function messages(): array{
        return [
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'title.string' => 'The title must be a string.',
            'description.required' => 'The description field is required.',
            'description.max' => 'The description may not be greater than 50 characters.',
            'description.string' => 'The description must be a string.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The category does not exist.',
            'image.required' => 'The image field is required.',
            'image.image' => 'The image must be a image.',
            'image.mimes' => 'The image must be a file of type: jpg, jpeg, png.',
            'image.max' => 'The image may not be greater than 2 MB.',
        ];
    }
}

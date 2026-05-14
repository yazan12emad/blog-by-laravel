<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string','max:255'
                , Rule::unique(Category::class,'name')
                    ->ignore($this->category)], // if the same category its ok to be the same name
            'description' =>['nullable','string'],
        ];
    }

    public function messages(): array{
        return [
            'name.unique'   => "The category name ':input'is already taken. Please choose a different name.",
        ];
    }
}

<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:subcategories,name,',
            'category_id' => 'required|integer|exists:categories,id',
        ];
    }
// sadas
    public function messages()
    {
        return [
            'category_id.exists' => 'The selected category is invalid.',
            'category_id.required' => 'The category is required.',
            'name.required' => 'The name is required.',
            'name.string' => 'The name must be a string.',
            'name.unique' => 'The name has already been taken.',
        ];
    }

}

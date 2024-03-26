<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryrequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
         "name" => ["required", "string", "unique:categories", "max:10"],
        ]; 
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Please enter an valid name.', 
             'name.max' => 'category name must be less then  :max ' ,
             'name.unique' => 'category name is exist'
            
        ];
    }
}

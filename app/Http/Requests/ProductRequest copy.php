<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            
            "name" => ["required", "string", "max:10"],
            "serial_number" => ["required", "integer", "unique:products"],
            "model" => ["required", "string", "max:10"], 
            "sales_price" => ["required" , "integer" ] , 
            "tax" =>["required" , "integer" , "max:100"]

        ]; 
    } 

    public function messages(): array
    {
        return [
             'name.unique' => 'product name is exist' ,
             'sales_price.integer' => 'price must be an integer' , 
             'sales_price.required' => 'please enter price'  ,
             'model.required' => 'please enter a model' ,
             'tax.required' => 'please enter a valid tax '
            
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceProductRequest extends FormRequest
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
             "product_id" => ["required"] ,
             "price" => ["required"] ,      
             "quantity" => ["required" ,"max:100"] ,
             "amount" =>["required" ] ,
             "discount" => ["required" ,"max:100"] ,

             
               //
        ];
    }
    public function messages(): array
    {
        return [
            "product_id.required" => "product is reqired" ,
            "price.required" => "The price field is required.",
            "quantity.required" => "The quantity field is required.",
            "quantity.max" => "The quantity may not be greater than 100.",
            "amount.required" => "The amount field is required.",
            "discount.required" => "The discount field is required.",
            "discount.max" => "The discount may not be greater than 100.",
        ];
    }
}

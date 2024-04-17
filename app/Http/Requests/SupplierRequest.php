<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            
            "supplier_name" => ["required", "string", "max:10"],
            "contact" => ["required", "integer", "max:8"],
            "address" => ["required", "string", "max:12"], 
            "description" => ["required" , "string" ] , 

        ]; 
    } 

    public function messages(): array
    {
        return [
             'supplier_name.required' => 'please enter a name ' ,
             'contact.required' => 'please enter a contact' ,
             'address.required' => 'please enter an address' ,
             'description.required' => 'please enter a description ' ,
            
        ];
    }
}

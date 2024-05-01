<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array<string,
     *  \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */ 
    public function rules(): array
    {
        return [ 
            
            "name" => ["required", "string", "max:10"],
            "contact" => ["required", "string","unique:customers" , "max:8"],
            "address" => ["required", "string", "max:12"], 
            "details" => ["required" , "string" ] ,  
            "email" => ["required", "email", "unique:users,email"],

             

        ]; 
    } 

    public function messages(): array
    {
        return [
             'name.required' => 'please enter a name ' ,
             'contact.required' => 'please enter a contact' ,
             'address.required' => 'please enter an address' ,
             'details.required' => 'please enter a details '  , 
             'email.required' => 'please enter an email' , 
             'contact.unique' => "contact is exist"
             
        ];
    }
}  

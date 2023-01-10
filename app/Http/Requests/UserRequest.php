<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * Determine the name of the attributes for the request.
     *
     * @return array
     */
    public function attributes(){
        return [
         'name' => '-Nombre-',
         'email' => '-Email-',
         'password' => '-Password-',
         'status' => '-Estado-',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->getMethod() == "POST") {
            return [
                'email' => 'required|email|max:255',
                'name' => 'required|max:255',
                'password' => 'min:6|max:255|confirmed',
                'status' => 'required',
            ];
         }
         else{
            return [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'status' => 'required',
            ];
        }
    }
}

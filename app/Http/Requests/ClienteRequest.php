<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
         'nombre' => '-Nombre-',
         'ejecutivo' => '-Ejecutivo-',
         'telefono' => '-Telefono Ejecutivo-',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        
        return [
            'nombre' => 'required|max:255',
            'ejecutivo' => 'required|max:255',
            'telefono' => 'required|numeric|min:10',
        ];
        
    }
}

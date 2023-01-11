<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaRequest extends FormRequest
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
         'descripcion' => '-Descripcion de la cuenta-',
         'tabla_telefonos' => '-Tabla de telefonos-',
         'tipo_robotica' => '-Tipo de Robotica-',
         'dato_tipo' => '-El parametro extra-',
         'canales' => '-Cantidad de Canales-',
         'grabacion' => '-Password Manager-',
         'asterisk_id' => '-Servidor Asterisk-',
         'troncal' => '-Troncal-',
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
            'descripcion' => 'required|max:255',
            'tabla_telefonos' => 'required',
            'tipo_robotica' => 'required',
            'dato_tipo' => "required_if:tipo_robotica,<=,A",
            'canales' => 'required',
            'grabacion' => 'required',
            'asterisk_id' => 'required',
            'troncal' => 'required'
        ];
        
    }
}

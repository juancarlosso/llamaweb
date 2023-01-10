<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsteriskRequest extends FormRequest
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
         'descripcion' => '-Nombre del Servidor-',
         'ip' => '-Ejecutivo-',
         'usuario' => '-Telefono Ejecutivo-',
         'password' => '-Password Manager-',
         'puerto' => '-Puerto Manager-',
         'contexto' => '-Contexto-',
         'contexto_cd' => '-Contexto Click & Dial-',
         'marcar_login' => '-Marcar Login-',
         'puerto_http' => '-Puerto http local-',
         'puerto_http_publico' => '-TPuerto http publico-',
         'marcar_logout' => '-Marcar Logout-',
         'marcar_pausa' => '-Marcar Pausa-',
         'marcar_despausa' => '-Marcar Despausa-',
         'ip_mysql' => '-ip MYSQL-',
         'usuario_mysql' => '-Usuario MYSQL-',
         'password_mysql' => '-Password MYSQL-',
         'puerto_mysql' => '-Puerto MYSQL-',
         'bd_mysql' => '-DB MYSQL-',
         'tabla_mysql' => '-Tabla MYSQL-'
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
            'ip' => 'required',
            'usuario' => 'required',
            'password' => 'required',
            'puerto' => 'required',
            'contexto' => 'required',
            'contexto_cd' => 'required',
            'marcar_login' => 'required',
            'puerto_http' => 'required',
            'puerto_http_publico' => 'required',
            'marcar_logout' => 'required',
            'marcar_pausa' => 'required',
            'marcar_despausa' => 'required',
            'ip_mysql' => 'required',
            'usuario_mysql' => 'required',
            'password_mysql' => 'required',
            'puerto_mysql' => 'required',
            'bd_mysql' => 'required',
            'tabla_mysql' => 'required'
        ];
        
    }
}

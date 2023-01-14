<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaImportRequest extends FormRequest
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

    public function attributes(){
        return [
			'import' => 'Archivo a importar',
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
			'import' => 'required',
		];
    }
}

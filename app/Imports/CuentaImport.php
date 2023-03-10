<?php

namespace App\Imports;

use App\Models\Importa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CuentaImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Importa([
            //
            'telefono' => $row[0],
		]);
	}
	public function startRow(): int{
		return 2;
	}
    
}

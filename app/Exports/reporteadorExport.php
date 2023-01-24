<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class reporteadorExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $tabla;
    private $DESDE;
    private $HASTA;
     
     
    public function __construct($tabla, $DESDE, $HASTA) {
        $this->tabla = $tabla;
        $this->DESDE = $DESDE;
        $this->HASTA = $HASTA;
    }

    public function headings(): array
    {
        return [
            'Tipo',
            'Telefono',
            'Fecha Hora',
            'Disposition',
            'AMD',
            'Tiempo'
        ];
    }

    public function collection()
    {
        
        $sql="SELECT DISTINCT tipo, telefono, fecha_hora, disposition, amd, SEC_TO_TIME(tiempo) AS tiempo  
        FROM {$this->tabla} WHERE fecha_hora BETWEEN '{$this->DESDE} 00:00:00' AND '{$this->HASTA} 23:59:00' ORDER BY tipo";
        $registros = DB::select($sql);
        return collect($registros);

    }
}
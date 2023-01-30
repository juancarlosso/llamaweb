<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion','tabla_telefonos','tipo_robotica','canales','grabacion','fecha_ini','hora_ini','fecha_fin','hora_fin','asterisk_id','email','activa',
    'tabla_resultados','bloque','ignorar','cantidad_barridas','dispo_barrer','pausa','mostrar','idcuenta','queue','ivr','troncal','incluir_buzon','slot','callerid'];

    /*
    *
    * @brief
    * @author Gustavo Ramirez Yahuaca
    * @param string
    * @return
    *
    */
    public function asterisk()
    {
     return $this->hasOne(Asterisk::class,'id','astersik_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    use HasFactory;

    protected $fillable = ['descripcion','tabla_telefonos','tipo_robotica','canales','grabacion','fecha_ini','hora_inicial','fecha_fin','hora_final','asterisk_id','email','activa',
    'tabla_resultados','bloque','ignorar','cantidad_barridas','dispo_barrer','pausa','mostrar','idcuenta','contexto','queue','ivr','troncal','incluir_buzon','slot'];

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

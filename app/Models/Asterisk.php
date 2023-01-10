<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asterisk extends Model
{
    use HasFactory;

    protected $table = "servidores_asterisk";

    protected $fillable = ['descripcion','ip','usuario','password','puerto','contexto','contexto_cd','marcar_login','puerto_http','puerto_http_publico','marcar_logout','marcar_pausa',
                            'marcar_despausa','ip_mysql','usuario_mysql','password_mysql','puerto_mysql','bd_mysql','tabla_mysql','version'];
}

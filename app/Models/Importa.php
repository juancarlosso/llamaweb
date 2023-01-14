<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importa extends Model
{
    use HasFactory;

    protected $table = "cuenta_importa";

    protected $fillable = [
        'telefono'
    ];
}

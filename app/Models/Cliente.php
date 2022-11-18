<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{   protected $fillable =['id',
    'identidadC',
    'nombreCompleto', 
    'telefono',
    'direccion', 
    'fechaNacimiento',
    'descripcion',];
    use HasFactory;
}

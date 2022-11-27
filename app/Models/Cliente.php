<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{   use HasFactory;
     protected $fillable =['id',
    'identidadC',
    'nombreCompleto', 
    'telefono',
    'direccion', 
    'fechaNacimiento',
    'descripcion',];

    public function beneficiario(){
        return $this->belongsTo(Beneficiario::class);
    }
   
    public function venta(){
        return $this->hasMany(venta::class);
    }
}

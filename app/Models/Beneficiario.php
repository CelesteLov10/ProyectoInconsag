<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiario extends Model
{
    use HasFactory;
    protected $fillable =['id',
    'identidadBen',
    'nombreCompletoBen', 
    'telefonoBen',
    'direccionBen', 
    'cliente_id',];
   
    public function cliente(){
        return $this->hasMany(Cliente::class);
    }

    public function venta(){
        return $this->hasMany(Venta::class);
    }
}

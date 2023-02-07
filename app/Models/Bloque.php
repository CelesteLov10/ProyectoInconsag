<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;
    protected $fillable =['id',
    'nombreBloque',
    'cantidadLotes', 
    'subirfoto',];
    
    public function lote(){
        return $this->hasMany(Lote::class);
    }
    //se pueden vender muchos bloques
    public function venta(){
        return $this->hasMany(Venta::class);
    }
   
 
}

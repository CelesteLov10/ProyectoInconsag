<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $fillable = ['id', 
    'numLote',
           'medidaLateralR',
           'medidaLateralL',
           'medidaEnfrente',
           'medidaAtras',
           'valorTerreno',
            'colindanciaN',
            'colindanciaS',
            'colindanciaE',
            'colindanciaO',
            'bloque_id'
           ];
    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }

    public function venta(){
        return $this->hasOne(Venta::class);
    }
}
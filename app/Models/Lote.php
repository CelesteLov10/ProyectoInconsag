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
            'colindanciaN',
            'colindanciaS',
            'colindanciaE',
            'colindanciaO',
           ];
    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;
    protected $fillable = ['id', 
   'status',
           'medidaLateralR',
           'medidaLateralL',
           'medidaEnfrente',
           'medidaAtras',
           'valorTerreno',
            'colindanciaN',
            'colindanciaS',
            'colindanciaE',
            'colindanciaO',
            'bloque_id',
            'cliente_id'
            
           ];
    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }

    public function venta(){
        return $this->hasOne(Venta::class);
    }
  
      // muchos pagos para un lote
      public function pago(){
        return $this->belongsToMany(Pago::class);
    }
    public function cliente(){
        return $this->hasOne(cliente::class);
    }
}
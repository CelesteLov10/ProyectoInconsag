<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $fillable =['id',
    'venta_id', 
    'cliente_id',
    'lote_id',
    'fechaPago',
    'cantidadCuotasPagar',
    'cuotaPagar',
    'valorTerrenoPagar',
    'saldoEnCuotas',
    //'nuevoSaldo',
    ];

        // un cliente puede hacer muchos pagos
        public function cliente(){
            return $this->hasMany(Cliente::class);
        }

        // un lote puede recibir muchos pagos
        public function lote(){
            return $this->hasMany(Lote::class);
        }
         // un bloque puede recibir muchos pagos
         //no se pero por si acaso
        public function bloque(){
            return $this->hasMany(Bloque::class);
        }
         // de una venta pueden surgir muchos pagos de mensualidades
         //tampoco se si va
        public function venta(){
            return $this->hasMany(Venta::class);
        }
}

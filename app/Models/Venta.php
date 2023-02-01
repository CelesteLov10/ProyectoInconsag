<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable =['id',
    'cliente_id',
    'bloque_id', 
    'lote_id',
    'beneficiario_id',
    'valorTerreno',
    'fechaVenta',
    'formaVenta',
    'valorPrima',
    'cantidadCuotas',
    'valorCuotas',
    'valorRestantePagar'
    ];
    use HasFactory;
    
    //una venta pertnece a un solo cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }
    public function lote(){
        return $this->belongsTo(Lote::class);
    }

    public function beneficiario(){
        return $this->belongsTo(Beneficiario::class);
    }
}


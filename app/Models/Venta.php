<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable =['id',
    'casa_id',
    'cliente_id',
    'bloque_id', 
    'lote_id',
    'beneficiario_id',
    'valorTerreno',
    'total',
    'fechaVenta',
    'formaVenta',
    'valorPrima',
    'cantidadCuotas',
    'valorCuotas',
    'valorRestantePagar'
    ];
    use HasFactory;
    //convertir a fecha carbon
    protected $dates = [
        'fechaVenta'
    ];
    public function setFechaVenta($date){
        $this->attributes['fechaVenta'] = Carbon::parse($date);
    }
    
    //una venta pertnece a un solo cliente
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    //de un bloque pueden salir muchas ventas
    //pero solo se puede con belongsTo
    public function bloque(){
        return $this->belongsTo(Bloque::class);
    }
    public function lote(){
        return $this->belongsTo(Lote::class);
    }

    public function beneficiario(){
        return $this->belongsTo(Beneficiario::class);
    }
    //de venta pueden salir muchos pagos
    public function pago(){
        return $this->hasMany(Pago::class); //tenia belongTo
    }

    //un estilo de casa pertenece a muchas ventas
    public function casa(){
        return $this->belongsTo(Casa::class);
    }
}


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
    'fechaVenta',
    'valorTerreno',
    'formaVenta',
    'valorPrima',
    'cantidadCuotas',
    'valorCuotas',
    'valorRestantePagar'];
    use HasFactory;
}

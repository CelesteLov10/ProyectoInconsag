<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservacion extends Model
{
    use HasFactory;
    protected $fillable =['id',  
    'nombreCliente',
    'identidadCliente',
    'telefono',
    'correoCliente',
    'fechaCita',
    'horaCita',
    //'empleado_id',
    ];
    public function reservacion(){
        return $this->belongsTo(Reservacion::class);
    }
}

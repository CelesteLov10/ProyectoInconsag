<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquinaria extends Model
{
    use HasFactory;
    protected $table = 'maquinarias';

    protected $fillable =['id',
    'nombreMaquinaria',
    'modelo',
    'placa', 
    'cantidadMaquinaria',
    'descripcion',
    'fechaAdquisicion',
    'maquinaria',
    'cantidadHoraAlquilada',
    'valorHora',
    'totalPagar',
    'proveedor_id',

   ];

   public function proveedor(){
    return $this->belongsTo(Proveedor::class);
}
}
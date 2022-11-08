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
    'descripcion',
    'fechaAdquisicion',
    'proveedor_id',
    'maquinaria',
    'cantidadHoraAlquilada',
    'valorHora',
    'totalPagar',
   ];

   public function proveedor(){
    return $this->belongsTo(Proveedor::class);
}
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';

    protected $fillable =['id',
    'nombreProveedor',
    'nombreContacto',
    'cargoContacto', 
    'direccion',
    'telefono',
    'email',
    'categoria_id',];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}

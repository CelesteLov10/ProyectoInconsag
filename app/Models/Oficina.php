<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;
    //Una oficina puede tener muchos articulos de inventario
    public function inventario(){
        return $this->hasMany(Inventario::class);
    }

    //Una oficina puede tener muchos empleados
    public function empleado(){
        return $this->hasMany(Empleado::class);
    }
}

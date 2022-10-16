<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;
    //Relacion con la tabla empleados. muchos inventarios puede registrar un empleado
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    // un inventario pertenece a una oficina
    
    public function oficina(){
        return $this->belongsTo(Oficina::class);
    }
    
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    use HasFactory;
    //relacion un puesto puede tener muchos empleados
    public function empleado(){
        return $this->hasMany(Empleado::class);
    }
}

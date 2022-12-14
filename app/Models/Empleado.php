<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    // relacion un empleado pertenece a un solo puesto

    protected $fillable =['id',
    'identidad',
    'nombres', 
    'apellidos',
    'telefono',
    'estado',
    'correo',
    'fechaNacimiento',
    'direccion', 
    'fechaIngreso', 
    'puesto_id', 
    'oficina_id'];
    public function puesto(){
        return $this->belongsTo(Puesto::class);
    }
    
    public function estado(){ 
    // return $this->belongsTo(Estado::class);
    }

    // un empleado puede ingresar varios inventarios
    public function inventario(){
        return $this->hasMany(Inventario::class);
    }
    //un empleado solo puede pertenecer a una oficina
    public function oficina(){
        return $this->belongsTo(Oficina::class);
    }
}

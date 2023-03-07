<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;
    protected $fillable =['id',
    'nombreGastos',
    'montoGastos', 
    'nombreEmpresa',
    'fechaGastos',
    'descripcion',
    'empleado_id',
    'baucherRecibo',];

       //Relacion con la tabla empleados. muchos inventarios puede registrar un empleado
    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }
}

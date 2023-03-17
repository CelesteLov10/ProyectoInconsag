<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tablaplanilla extends Model
{
    use HasFactory;

    protected $fillable =['id',
    'totalp',
    'fechap',
    'canEmpleados',
    'identidad_empleado',
    'nombre_empleado', 
    'sueldo_empleado',
    'puesto_empleado',
    'dias_empleado',
    'total_empleado',
    // 'dias', 
    // 'total',
    // 'fecha',
    //'empleado_id',
    ];

    // public function planilla(){
    //     return $this->belongsTo(Planilla::class);
    // }

    // public function empleado(){
    //     return $this->belongsTo(Empleado::class);
    // }
}
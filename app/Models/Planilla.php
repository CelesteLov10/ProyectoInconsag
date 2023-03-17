<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $fillable =['id',
    'dias', 
    'total',
    'fecha',
    'empleado_id',
    // 'puesto_id'
    ];

    public function empleado(){
        return $this->belongsTo(Empleado::class);
    }

    // public function puesto(){
    //     return $this->belongsTo(Puesto::class);
    // }
}

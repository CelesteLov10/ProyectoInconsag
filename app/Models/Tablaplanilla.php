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
    // 'empleado_id',
    ];

    public function planilla(){
        return $this->belongsTo(Planilla::class);
    }
}

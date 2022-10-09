<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    // relacion un empleado pertenece a un solo puesto

    protected $fillable =['id','estado', 'puesto_id'];
    public function puesto(){
        return $this->belongsTo(Puesto::class);
    }
    
    public function estado()
    { 
       // return $this->belongsTo(Estado::class);
    }
}

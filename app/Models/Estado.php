<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

      // un estado puede tener muchos empleadoa
      public function empleado(){
        return $this->hasMany(Empleado::class);
    }
}

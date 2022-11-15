<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;
    // un bloque puede ingresar varios terrenos
    public function bloque(){
        return $this->hasMany(Bloque::class);
    }

}

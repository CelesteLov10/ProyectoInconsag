<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bloque extends Model
{
    use HasFactory;
    // un bloque puede tener varios bloques
    public function bloque(){
        return $this->hasMany(Bloque::class);
    }

}

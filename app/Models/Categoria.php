<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //relacion una categoria puede tener muchos prov
    public function proveedor(){
        return $this->hasMany(Proveedor::class);
    }
}

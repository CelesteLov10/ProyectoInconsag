<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Constructora extends Model
{
    use HasFactory;
    //
    protected $fillable =['id',
    'nombreConstructora',
    'direccion', 
    'telefono',
    'email',
    'fechaContrato',];

    //Una constructor puede construir muchas casas
    public function casa(){
        return $this->hasMany(Casa::class);
    }

}

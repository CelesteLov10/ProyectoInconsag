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
    public function constructora(){
        return $this->hasMany(Constuctora::class);
    }

}

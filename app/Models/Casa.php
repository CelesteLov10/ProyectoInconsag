<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casa extends Model
{
    use HasFactory;
    protected $fillable =['id',
    'claseCasa',
    'valorCasa', 
    'cantHabitacion',
    'descripcion',
    'constructora_id',];

    //Un casa solo la puede construir una constructora
    public function constructora()
    {
        return $this->belongsTo(Constructora::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function venta(){
        return $this->hasMany(Venta::class);
    }
}

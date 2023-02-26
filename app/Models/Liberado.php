<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liberado extends Model
{
    use HasFactory;
    protected $fillable = ['id', 
    // 'lote_id',
   'nomBloque',
           'nomLote',
           'nomCliente',
           'fecha',
           'descripcion',
];

// public function lote(){
//     return $this->belongsTo(Lote::class);
// }
}

<?php
namespace App\Services;

use App\Models\Estado;

class Estados{
    public function get(){
        $estado = Estado::get();
        $estadoArray[''] = 'Seleccione un estado';
        foreach ($estado as $estados){
            $estadoArray[$estados->id] = $estados->nombreE;
        }
        return $estadoArray;
    }
}

?>
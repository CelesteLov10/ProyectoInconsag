<?php
namespace App\Services;

use App\Models\Bloque;

class Bloques{
    public function get(){
        $bloques = Bloque::get();
        $bloquesArray[''] = 'Seleccione un bloque';
        foreach ($bloques as $bloque){
            $bloquesArray[$bloque->id] = $bloque->nombreBloque;
        }
        return $bloquesArray;
    }
}

?>
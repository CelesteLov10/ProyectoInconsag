<?php
namespace App\Services;

use App\Models\Departamento;

class Departamentos{
    public function get(){
        $departamentos = Departamento::get();
        $departamentosArray[''] = 'Seleccione un departamento';
        foreach ($departamentos as $departamento){
            $departamentosArray[$departamento->id] = $departamento->nombreD;
        }
        return $departamentosArray;
    }
}

?>
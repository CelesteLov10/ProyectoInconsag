<?php
namespace App\Services;

use App\Models\Cliente;

class Clientes{
    public function get(){
        $clientes = Cliente::get();
        $clientesArray[''] = '-- Seleccione un cliente --';
        foreach ($clientes as $cliente){
            $clientesArray[$cliente->id] = $cliente->nombreCompleto;
        }
        return $clientesArray;
    }
}

?>
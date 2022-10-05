<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Puesto;

class SearchController extends Controller
{
    public function empleado(Request $request){
        $term = $request->get('term');
        $querys = Empleado::where('identidad', 'LIKE', '%'. $term . '%')->get();
        $queros = Puesto::where('nombreCargo', 'LIKE', '%'. $term . '%')->get();

        $data = [];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->identidad
        ];
        }
        /* Se supone que buscar por puesto
        $data1 = [];
        foreach($queros as $quero){
        $data1[] = [
        'label' => $quero->nombreCargo
        ];
        }*/
        return $data;
    }
}
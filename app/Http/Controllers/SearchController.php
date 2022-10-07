<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Puesto;

class SearchController extends Controller
{
    public function empleado(Request $request){
        $term = $request->get('term');
        $termi = $request->get('termi');
        $querys = Empleado::where('identidad', 'LIKE', '%'. $term . '%')->get();
        $queros = Puesto::where('nombreCargo', 'LIKE', '%'. $termi . '%')->get();

        $data = [];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->identidad
        ];
        }
       
        $dataa =[];
        foreach($queros as $quero){
        $dataa[] = [
        'label' => $quero->nombreCargo
        ];
        }
        return $data;
        return $dataa;
       
    }
}
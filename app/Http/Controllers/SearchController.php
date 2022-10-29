<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\Oficina;
use App\Models\Puesto;

class SearchController extends Controller
{
    public function empleado(Request $request){
        $term = $request->get('term');
        $querys = Empleado::where('identidad', 'LIKE', '%'. $term . '%')->get();
        
        $data = [];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->identidad
        ];
        }
        return $data;  
    }

    public function puesto(Request $request){
        $term = $request->get('term');
        $querys = Puesto::where('nombreCargo', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreCargo
        ];
        }
        return $data;
    }

    public function inventario(Request $request){
        $term = $request->get('term');
        $querys = Inventario::where('nombreInv', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreInv
        ];
        }
        return $data;
    }

    public function oficina(Request $request){
        $term = $request->get('term');
        $querys = Oficina::where('nombreOficina', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreOficina
        ];
        }
        return $data;
    }

    public function proveedor(Request $request){
        $term = $request->get('term');
        $querys = Oficina::where('nombreProveedor', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreProveedor
        ];
        }
        return $data;
    }
    
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\Inventario;
use App\Models\Maquinaria;
use App\Models\Oficina;
use App\Models\Proveedor;
use App\Models\Puesto;
use App\Models\Bloque;
use App\Models\Casa;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\Constructora;


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
        $querys = Proveedor::where('nombreProveedor', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreProveedor
        ];
        }
        return $data;
    }

    public function maquinaria(Request $request){
        $term = $request->get('term');
        $querys = Maquinaria::where('nombreMaquinaria', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreMaquinaria
        ];
        }
        return $data;
    }
    public function bloque(Request $request){
        $term = $request->get('term');
        $querys = Bloque::where('nombreBloque', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreBloque
        ];
        }
        return $data;
    }
    
    public function cliente(Request $request){
        $term = $request->get('term');
        $querys = Cliente::where('nombreCompleto', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreCompleto
        ];
        }
        return $data;
    }
    public function venta(Request $request){
        $term = $request->get('term');
        $querys = Venta::where('nombreCompleto', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreCompleto
        ];
        }
        return $data;
    }
    public function constructora(Request $request){
        $term = $request->get('term');
        $querys = Constructora::where('nombreConstructora', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->nombreConstructora
        ];
        }
        return $data;
    }

    public function casa(Request $request){
        $term = $request->get('term');
        $querys = Casa::where('claseCasa', 'LIKE', '%'. $term . '%')->get();
        
        $data =[];
        foreach($querys as $query){
        $data[] = [
        'label' => $query->claseCasa
        ];
        }
        return $data;
    }
}

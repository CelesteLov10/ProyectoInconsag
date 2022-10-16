<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {       //Campo busqueda
        $oficinas = Oficina::query()
            ->when(request('search'), function($query){
            return $query->where('nombreOficina', 'LIKE', '%' .request('search') .'%')
            ->orWhere('municipio', 'LIKE', '%' .request('search') .'%')
            //Aqui es la tabla relacionada y abajo el nombre del campo que desea.
            ->orWhereHas('inventario', function($q){
                $q->where('nombreOficina','LIKE', '%' .request('search') .'%');
            });
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        $inventario = inventario::all();

        return view('oficina.index', compact('oficinas', 'inventario'));
    }

    //
    public function create(){
 
        return view('oficina.create');

    }

    public function store(Request $request){
        $oficina = new Oficina();

        $oficina->nombreOficina = $request->nombreOficina;
        $oficina->municipio = $request->municipio;
        $oficina->direccion = $request->direccion;
        $oficina->inventario_id = $request->inventario_id;


        
        $create = $oficina->save();
        
        if ($create){
            return redirect()->route('puestoLaboral.index')
            ->with('mensaje', 'Se guardó el registro de la nueva oficina correctamente');
        } 
    }
}

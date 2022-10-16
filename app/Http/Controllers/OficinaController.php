<?php

namespace App\Http\Controllers;

use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    //
    public function create(){
 
        return view('oficina.create');

    }

    public function store(Request $request){
        $oficina = new Oficina();

        $oficina->nombreOficina = $request->nombreOficina;
        $oficina->municipio = $request->municipio;
        $oficina->direccion = $request->direccion;
        
        $create = $oficina->save();
        
        if ($create){
            return redirect()->route('puestoLaboral.index')
            ->with('mensaje', 'Se guardó el registro de la nueva oficina correctamente');
        } 
    }
}

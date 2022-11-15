<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use Illuminate\Http\Request;

class BloqueController extends Controller
{
    
    public function index(){   
        
    }
    public function create(){  
        //$bloque = Bloque::all(); 
        return view('bloque.create');
    }
    public function show(){   
        
    }

    public function store(Request $request){

        /*Bloque::create([
            'nombreBloque'=>$request ['nombreBloque'],
            'cantidadLotes'=>$request ['cantidadLotes'],
            'colindancia'=>$request ['colindancia'],
            'colindancia'=>$request ['colindancia'],
            'colindancia'=>$request ['colindancia'],
            'colindancia'=>$request ['colindancia'],
            'subirfoto'=>$request ['subirfoto'],
             
            
        ]);
            return redirect()->route('bloque.index')
            ->with('mensaje', 'Se guardó un nuevo bloque correctamente');*/

            $bloque = new bloque();

        $bloque->nombreBloque = $request->nombreBloque;
        $bloque->cantidadLotes = $request->cantidadLotes;
        $bloque->colindancia = $request->colindancia;
        $bloque->colindancia = $request->colindancia;
        $bloque->colindancia = $request->colindancia;
        $bloque->colindancia = $request->colindancia;
        $bloque->subirfoto = $request->subirfoto;

        $create = $bloque->save();
        
        if ($create){
            return redirect()->route('bloque.index')
            ->with('mensaje', 'Se guardó el registro de la nueva oficina correctamente');
        } 
    }
        
    //}    
    public function edit(){
        
    }

    public function update(Request $request){

    }
}

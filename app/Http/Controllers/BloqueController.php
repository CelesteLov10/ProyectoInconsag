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
        $bloque->colindanciaN = $request->colindanciaN;
        $bloque->colindanciaS = $request->colindanciaS;
        $bloque->colindanciaO = $request->colindanciaO;
        $bloque->colindanciaE = $request->colindanciaE;
        $bloque->subirfoto = $request->subirfoto;

        $create = $bloque->save();
        
        if ($create){
            return redirect()->route('bloque.index')
            ->with('mensaje', 'Se guardó el registro del nuevo bloque correctamente');
        } 
    }
        
    //}    
    public function edit(){
        
    }

    public function update(Request $request){

    }
}

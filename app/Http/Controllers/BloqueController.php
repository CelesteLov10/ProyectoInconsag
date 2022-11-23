<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use Illuminate\Http\Request;

class BloqueController extends Controller
{
    
    public function index(){   

    $bloques = Bloque::query()
    ->when(request('search'), function($query){
    return $query->where('nombreBloque', 'LIKE', '%' .request('search') .'%');
    })->orderBy('id','desc')->paginate(10)->withQueryString(); 

    return view('bloque.index', compact('bloques'));
    }

    public function create(){  
        //$bloque = Bloque::all(); 
        return view('bloque.create');
    }
    
    public function show(){   
        
    }

    public function store(Request $request){

        $reglas = [

            'nombreBloque'   => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9]+\s{0,1})+$/u',
            'cantidadLotes'    => 'required|numeric|min:10|regex:/^[0-9]{1,2}+$/u',
            'subirfoto'    => 'required',
            
        
        ];
        $mensaje =[
            'nombreBloque.required' => 'El nombre del bloque es requerido, no puede estar vacío. ',
            'nombreBloque.regex' => 'El nombre del bloque solo permite un espacio entre los nombres.',

            'cantidadLotes.required' => 'La cantidad de lotes es requerida.', 
            'cantidadLotes.numeric' => 'La cantidad de lotes no permite letras.',
            'cantidadLotes.min' => 'La cantidad de lotes de un bloque debe ser al menos de 10 lotes.',

            'subirfoto.required' => 'Debe seleccionar una imagen. ',

        ];
        $this->validate($request, $reglas, $mensaje);

        Bloque::create([
            'nombreBloque'=>$request ['nombreBloque'],
            'cantidadLotes'=>$request ['cantidadLotes'],
            'colindanciaN'=>$request ['colindanciaN'],
            'colindanciaS'=>$request ['colindanciaS'],
            'colindanciaE'=>$request ['colindanciaE'],
            'colindanciaO'=>$request ['colindanciaO'],
            'subirfoto'=>$request ['subirfoto'],  
        ]);
            return redirect()->route('bloque.index')
            ->with('mensaje', 'Se guardó un nuevo bloque correctamente');

        $bloque = new bloque();

        $bloque->nombreBloque = $request->nombreBloque;
        $bloque->cantidadLotes = $request->cantidadLotes;
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

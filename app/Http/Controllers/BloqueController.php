<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Lote;
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
    
    public function show($id){   
        $bloque = Bloque::findOrFail($id);
        $lotes = Lote::all();
        return view('bloque.show', compact('lotes'))->with('bloque', $bloque);
    }

    public function store(Request $request){

        /*Bloque::create([
            'nombreBloque'=>$request ['nombreBloque'],
            'cantidadLotes'=>$request ['cantidadLotes'],
            'colindanciaN'=>$request ['colindanciaN'],
            'colindanciaS'=>$request ['colindanciaS'],
            'colindanciaE'=>$request ['colindanciaE'],
            'colindanciaO'=>$request ['colindanciaO'],
            'subirfoto'=>$request ['subirfoto'],  
        ]);
            return redirect()->route('bloque.index')
            ->with('mensaje', 'Se guardó un nuevo bloque correctamente');*/

        $bloque = new bloque();
        if($request->hasFile('subirfoto') ){
            $file = $request->file('subirfoto');
            $destinationPath = 'public/imagenes/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('subirfoto')->move($destinationPath, $filename);
            $bloque->subirfoto = $destinationPath . $filename;
        };
        $bloque->nombreBloque = $request->nombreBloque;
        $bloque->cantidadLotes = $request->cantidadLotes;

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

<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\Venta;
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
        $pago = Pago::all();
        $venta = Venta::all();
        $lotes = Lote::query()
    ->when(request('search'), function($query){
    return $query->where('nombreLote', 'LIKE', '%' .request('search') .'%');
    })->orderBy('id','desc')->paginate(10000000)->withQueryString();
        return view('bloque.show', compact('lotes'))->with('bloque', $bloque);
    }

    public function store(Request $request){
        $reglas = [
            'nombreBloque'   => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9]+\s{0,1})+$/u|unique:bloques',
            'cantidadLotes'    => 'required|numeric|min:5|regex:/^[0-9]{1,2}+$/u',
            'subirfoto'    => 'required',
        ];
        $mensaje =[
            'nombreBloque.required' => 'El nombre del bloque es obligatorio, no puede estar vacío. ',
            'nombreBloque.regex' => 'El nombre del bloque solo permite un espacio entre los nombres.',
            'nombreBloque.unique' => 'El nombre del bloque debe ser único.',

            'cantidadLotes.required' => 'Ingresar la cantidad de lotes es obligatorio.',
            'cantidadLotes.numeric' => 'La cantidad de lotes no permite letras.',
            'cantidadLotes.min' => 'La cantidad de lotes de un bloque debe ser al menos de 5 lotes.',

            'subirfoto.required' => 'Debe seleccionar una imagen. ',

        ];
        $this->validate($request, $reglas, $mensaje);

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
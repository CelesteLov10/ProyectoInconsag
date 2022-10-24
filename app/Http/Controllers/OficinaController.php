<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    public function index(){
        //Campo busqueda
        $oficinas = Oficina::query()
            ->when(request('search'), function($query){
            return $query->where('nombreOficina', 'LIKE', '%' .request('search') .'%')
            ->orWhere('municipio', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        $inventario = inventario::all();

        return view('oficina.index', compact('oficinas', 'inventario'));
    }

    public function show($id){
        $oficina = Oficina::findOrFail($id);
        return view('oficina.show')->with('oficina', $oficina);
    }
    public function create(){

        return view('oficina.create');

    }

    public function store(Request $request){

        $request->validate([

            'nombreOficina' => 'required|regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\s]+$/u',
            'municipio'     => 'required|regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/u',
            'direccion'     => 'required',
            'nombreGerente' => 'required|regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/u',
            'telefono'      => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/',
    
        ]);

        $oficina = new Oficina();

        $oficina-> nombreOficina = $request-> nombreOficina;
        $oficina-> municipio = $request-> municipio;
        $oficina-> direccion = $request-> direccion;
        $oficina-> nombreGerente = $request-> nombreGerente;
        $oficina-> telefono = $request-> telefono;

        $create = $oficina->save();
        
        if ($create){
            return redirect()->route('oficina.index')
            ->with('mensaje', 'Se guardó el registro de la nueva oficina correctamente');
        } 
    }

    public function edit($id){
        
        $oficina = Oficina::findOrFail($id);
        return view('oficina.edit')->with('oficina', $oficina);
    }

    public function update(Request $request, $id){

        $request->validate([
            'nombreOficina' => ' required| regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ0-9\s]+$/u',
            'municipio'     => ' required| regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/u',
            'direccion'     => ' required ',
            'nombreGerente' => ' required| regex:/^[a-záéíóúñA-ZÁÉÍÓÚÑ\s]+$/u',
            'telefono'      => ' required| numeric |digits:8 |regex:/^[(2)(3)(8)(9)][0-9]/',
    
        ]);
        
        $oficina = Oficina::findOrFail($id);

        $oficina-> nombreOficina= $request->input('nombreOficina ');
        $oficina-> municipio = $request->input('municipio ');
        $oficina-> direccion = $request->input('direccion ');
        $oficina-> nombreGerente = $request->input('nombreGerente ');
        $oficina-> telefono = $request->input('telefono ');
        
        $update = $oficina->save();
        
        if ($update){
            return redirect()->route('oficina.index')
            ->with('mensajeW', ' Se actualizó el registro de la oficina correctamente ');
        } 
    }
}

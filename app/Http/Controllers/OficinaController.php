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

        $reglas = [

            'nombreOficina' => 'required|regex:/^([A-ZÁÉÍÓÚÑ]{1})[a-záéíóúñ]{0,15}+\s{0,1}[A-ZÁÉÍÓÚÑ]{0,1}[a-záéíóúñ]{0,15}+$/u',
            'municipio'     => 'required|regex:/^([A-ZÁÉÍÓÚÑ]{1})[a-záéíóúñ]{0,15}+\s{0,1}[A-ZÁÉÍÓÚÑ]{0,1}[a-záéíóúñ]{0,15}+$/u',
            'direccion'     => 'required|regex:/^.{10,200}$/u',
            'nombreGerente' => 'required|regex:/^([A-ZÁÉÍÓÚÑ]{1})[a-záéíóúñ]{0,15}+\s{0,1}[A-ZÁÉÍÓÚÑ]{0,1}[a-záéíóúñ]{0,15}+$/u',
            'telefono'      => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/',
    
        ];
        $mensaje = [
            'nombreOficina.required' => 'Debe escoger un nombre para la oficina, no puede estar vacío.',
            'nombreOficina.regex' =>'El nombre de la oficina debe iniciar con mayúscula y solo permite un espacio entre los nombres de la oficina.',

            'municipio.required' => 'El nombre del municipio es obligatorio.',
            'municipio.regex' => 'El nombre de la oficina debe iniciar con mayúscula.',

            'direccion.required' => 'La ubicación de dirección es obligatorio.', 
            'direccion.regex' => 'La descripción es muy corta.',

            'nombreGerente.required' => 'El nombre del gerente es obligatorio, no puede estar vacío.', 
            'nombreGerente.alpha' => 'En el nombre del gerente sólo se permite letras.',
            'nombreGerente.regex' => 'El nombre del gerente debe iniciar con mayúscula, solo permite un espacio entre los nombres y no se admiten números.',

            'telefono.required' =>  'El teléfono es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono no puede contener letras.',
            'telefono.digits' => 'El teléfono debe contener  8 dígitos.',
            'telefono.regex' => 'El teléfono solo puede iniciar con los siguientes dígitos: 2, 3, 8 ó 9. ',

        ];
        $this->validate($request, $reglas, $mensaje);


        $oficina = new Oficina();

        $oficina->nombreOficina = $request->nombreOficina;
        $oficina->municipio = $request->municipio;
        $oficina->direccion = $request->direccion;
        $oficina->nombreGerente = $request->nombreGerente;
        $oficina->telefono = $request->telefono;

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

        $this->validate($request,[
       
            'nombreOficina' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1})[a-záéíóúñ]{0,15}+\s{0,1}[A-ZÁÉÍÓÚÑ]{0,1}[a-záéíóúñ]{0,15}+$/u'],
            'municipio'     => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1})[a-záéíóúñ]{0,15}+\s{0,1}[A-ZÁÉÍÓÚÑ]{0,1}[a-záéíóúñ]{0,15}+$/u'],
            'direccion'     => ['required', 'regex:/^.{10,200}$/u'],
            'nombreGerente' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1})[a-záéíóúñ]{0,15}+\s{0,1}[A-ZÁÉÍÓÚÑ]{0,1}[a-záéíóúñ]{0,15}+$/u'],
            'telefono'      => ['required','numeric','digits:8','regex:/^[(2)(3)(8)(9)][0-9]/'],
        ],[
            'nombreOficina.required' => 'Debe escoger un nombre para la oficina, no puede estar vacío.',
            'nombreOficina.regex' =>'El nombre de la oficina debe iniciar con mayúscula y solo permite un espacio entre los nombres.',
   
            'municipio.required' => 'El nombre del municipio es obligatorio.',
            'municipio.regex' => 'El nombre de la oficina debe iniciar con mayúscula.',

            'direccion.required' => 'La ubicación de dirección es obligatorio.', 
            'direccion.regex' => 'La descripción es muy corta.',

            'nombreGerente.required' => 'El nombre del gerente es obligatorio, no puede estar vacío.', 
            'nombreGerente.regex' => 'El nombre del gerente debe iniciar con mayúscula, solo permite un espacio entre los nombres y no se admiten números.',

            'telefono.required' =>  'El teléfono es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono no puede contener letras.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono solo puede iniciar con los siguientes dígitos: 2, 3, 8 ó 9. ',
    
        ]);
        
        $oficina = Oficina::findOrFail($id);

        $oficina->nombreOficina= $request->input('nombreOficina');
        $oficina->municipio = $request->input('municipio');
        $oficina->direccion = $request->input('direccion');
        $oficina->nombreGerente = $request->input('nombreGerente');
        $oficina->telefono = $request->input('telefono');
        
        $update = $oficina->save();
        
        if ($update){
            return redirect()->route('oficina.index')
            ->with('mensajeW', 'Se actualizó el registro de la oficina correctamente');
        } 
    }
}

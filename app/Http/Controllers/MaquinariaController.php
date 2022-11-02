<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class MaquinariaController extends Controller
{
    //

    public function create(){   
        $proveedor = Proveedor::orderBy('nombreProveedor')->get();
        return view('maquinaria.create',compact('proveedor'));
    }

    public function store(Request $request){
        //validacion para cuando se agregue un empleado
        // regex basico para nombres regex:/^[a-zA-Z]+\s{0,1}[a-zA-Z]+$/u

        /* regex para verificacion de la primera letra mayuscula 
           regex:/^([A-Z]{1})[a-z]{0,15}+\s{0,1}[A-Z]{0,1}[a-z]{0,15}+$/u */

        $this->validate($request,[
            'nombreMaquinaria'   => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]{1}[a-záéíóúñ]+\s{0,1}([0-9]{0,15}?))+$/u'],
            'modelo' => ['required'],
            'placa'  => ['required','unique:maquinarias'],
            'cantidadMaquinaria' =>['required'],
            'descripcion'       => ['required','regex:/^.{10,150}$/u'],
            'fechaCompra'    => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'proveedor_id'       => ['required'],

        ],[
            
            'nombreMaquinaria.required' => 'El nombre no puede ir vacío.',
            'nombreMaquinaria.regex' => 'El nombre solo permite un espacio entre los nombres.',



            'descripcion.required' => 'Se necesita saber la descripción, no puede ir vacío.',
            'descripcion.regex' => 'La descripción permite mínimo 10 y máximo 150 palabras.',

            'fechaCompra.required' => 'La fecha de nacimiento no puede ir vacío.',


            'proveedor_id.required' => 'Debe seleccionar el puesto de trabajo, no puede ir vacío.',
            
            

        ]);
        $input = $request->all();
        
     
         Maquinaria::create($input);
            return redirect()->route('inventario.index')
            ->with('mensaje', 'Se guardó el registro de una nueva maquinaria correctamente');

    }
    
}

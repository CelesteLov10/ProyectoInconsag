<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use App\Models\Tablaplanilla;


use Illuminate\Http\Request;

class TablaplanillaController extends Controller
{
    public function index(){

        $planillas = Planilla::all();
        $tablaplanillas = Tablaplanilla::all();
        return view('tablaplanilla.index', compact('planillas', 'tablaplanillas'));
    }
    }

    public function show(){
        $planillas = Planilla::all();
        $tablaplanillas = Tablaplanilla::all();
        return view('tablaplanilla.show', compact('planillas', 'tablaplanillas'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'totalp'  => ['min:1'],
            'canEmpleados'  => ['min:1'],

            'fechap'  => ['unique:tablaplanillas', 'required','regex:/^[0-9]{4}+-[0-9]{2}+-[0-9]{2}+$/u'], 
        ],[
            'totalp.min'=>'Debe de agregar al menos un empleado a la tabla.',
            'canEmpleados.min'=>'Debe de agregar al menos un empleado a la tabla.',

            'fechap.unique'=>'La planilla del día de hoy ya se guardo.',
            'fechap.required'=>'Se necesita la fecha.',

            'fechap.regex'=>'Formato no valido.',


        ]);

        $input = $request->all();
        Tablaplanilla::create($input);
           return redirect()->route('planilla.index')
           ->with('mensaje', 'Registro guardado');
    }
}

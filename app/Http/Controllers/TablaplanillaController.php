<?php

namespace App\Http\Controllers;

use App\Models\Planilla;
use App\Models\Tablaplanilla;


use Illuminate\Http\Request;

class TablaplanillaController extends Controller
{
    public function index(){

        // $canEmpleados = Tablaplanilla::whereRaw('(SELECT count(id) FROM planillas WHERE id = planillas.id)')->get();


        $planillas = Planilla::all();
        $tablaplanillas = Tablaplanilla::all();
        return view('tablaplanilla.index', compact('planillas', 'tablaplanillas'));
    }

    public function show(){
        $planillas = Planilla::all();
        $tablaplanillas = Tablaplanilla::all();
        return view('tablaplanilla.show', compact('planillas', 'tablaplanillas'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'dias'  => ['required','numeric', 'min:1'],
            'empleado_id' => ['required', 'unique:planillas']
        ],[
            'dias.required'=>'Debe ingresar la cantidad de días, no puede estar vacío.',
            'dias.min'=>'La cantidad de días debe ser al menos de 1 día',
            'dias.numeric'=>'Solo se permiten números',

            'empleado_id.required'=>'Debe seleccionar un empleado, no puede estar vacío.',
            'empleado_id.unique'=>'Ya se agrego este empleado a la planilla.',
        ]);

        $input = $request->all();
        Tablaplanilla::create($input);
           return redirect()->route('planilla.index')
           ->with('mensaje', 'Registro guardado');
    }
}

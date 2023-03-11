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
            'totalp'  => ['min:1.00'],
            'canEmpleados'  => ['min:1.00'],

            /*Esta validacion en realidad la veo innecesaria pero bueno la 
            dejo para que al volverle a dar al boton de guardar planilla 
            no la guarde*/
            'fechap'  => ['unique:tablaplanillas'],
        ],[
            'totalp.min'=>'Debe de agregar al menos un empleado a la tabla',
            'canEmpleados.min'=>'Debe de agregar al menos un empleado a la tabla',
            'fechap.unique'=>'La planilla ya ha sido guardada',

        ]);

        $input = $request->all();
        Tablaplanilla::create($input);
           return redirect()->route('planilla.index')
           ->with('mensaje', 'Registro guardado');
    }
}

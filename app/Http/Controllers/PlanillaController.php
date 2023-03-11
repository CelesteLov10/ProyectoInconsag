<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Planilla;
use App\Models\Puesto;
use App\Models\Tablaplanilla;
use Illuminate\Http\Request;

class PlanillaController extends Controller
{
    public function index(){
        $planillas = Planilla::all();
        $puestos = Puesto::all();
        $empleados = Empleado::all();
        $tablaplanillas = Tablaplanilla::all();
        return view('planilla.index', compact('planillas', 'empleados', 'puestos', 'tablaplanillas'));
    }

    public function create(){
        $planillas = Planilla::all();
        $empleado = Empleado::all();
        $puestos = Puesto::all();
        return view('planilla.create', compact('empleado', 'puestos', 'planillas'));
    }

    public function store(Request $request){

        //
        
        $input = $request->all();
         Planilla::create($input);
            return redirect()->route('planilla.create')
            ->with('mensaje', 'Registro guardado');
    }
}
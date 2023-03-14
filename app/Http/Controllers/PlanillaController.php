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

        // $empactivos = Empleado::whereRaw('(SELECT count(estado) FROM empleados WHERE estado = "activo")')->get();

        $planillas = Planilla::all();
        $empleado = Empleado::all();
        $puestos = Puesto::all();
        return view('planilla.create', compact('empleado', 'puestos', 'planillas'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'dias'  => ['required','numeric', 'min:1'],
            'empleado_id' => ['required', 'unique:planillas'],
        ],[
            'dias.required'=>'Debe ingresar la cantidad de días, no puede estar vacío.',
            'dias.min'=>'La cantidad de días debe ser al menos de 1 día.',
            'dias.numeric'=>'Solo se permiten números.',
        
            'empleado_id.required'=>'Debe seleccionar un empleado, no puede estar vacío.',
            'empleado_id.unique'=>'Ya se agregó este empleado a la planilla.',
        ]);
        
        $input = $request->all();
         Planilla::create($input);
            return redirect()->route('planilla.create')
            ->with('mensaje', 'Registro guardado');
    }
}
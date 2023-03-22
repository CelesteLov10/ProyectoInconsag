<?php

namespace App\Http\Controllers;

use App\Models\Detallesplanilla;
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
        $tablaplanillas = Tablaplanilla::query()
        ->when(request('search'), function($query){
        return $query->where('fechap', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(10)->withQueryString();

        return view('planilla.index', compact('planillas', 'empleados', 'puestos', 'tablaplanillas'));
    }

    public function create(){

        // $empactivos = Empleado::whereRaw('(SELECT count(estado) FROM empleados WHERE estado = "activo")')->get();

        $tablaplanillas = Tablaplanilla::all();
        $planillas = Planilla::all();
        $empleado = Empleado::all();
        $puestos = Puesto::all();
        return view('planilla.create', compact('empleado', 'puestos', 'planillas', 'tablaplanillas'));
    }

    public function store(Request $request){

        $fecha = $request->input('fecha');
        $empleado_id = $request->input('empleado_id');

        $existe = Detallesplanilla::where('fecha', $fecha)->where('empleado_id', $empleado_id)->first();

    if ($existe) {
        // Mostrar un mensaje de error si el empleado existe en detallesplanillas
        return back()->withErrors(['empleado_id' => 'El empleado ya esta registrado con esa fecha']);
    }

        // Funcion que permite guardar el registro en el ultimo dia del mes (real)
        $request->validate([
            'fecha' => ['required', function($attribute, $value, $fail) {
                $fecha = \DateTime::createFromFormat('d-m-Y', $value);
                $ultimoDia = $fecha->format('t');
    
                if ($fecha->format('d') != $ultimoDia) {
                    $fail('Los empleados se agregan en el último día del mes');
                }
            }],
            
            'dias'  => ['required','numeric', 'min:1', 'max:30'],
            'empleado_id' => ['required', 'unique:planillas'],
            'total'  => ['required', 'numeric'],
            // 'fecha'  => ['required','regex:/^[0-9]{4}+-[0-9]{2}+-[0-9]{2}+$/u'], 

            // Validacion para que solo guarde a los empleados en el dia 28 de cada mes
            // 'fecha'  => ['required','regex:/^[0-9]{4}+-[0-9]{2}+-[28]{2}+$/u'], 
            
        ],[

            // 'fecha.regex'=>'Fecha no permitída. Los empleados se agregan a la planilla el dia 28 de cada mes',

            'fecha.required'=>'Debe seleccionar una fecha',

            'dias.required'=>'Debe ingresar la cantidad de días, no puede estar vacío.',
            'dias.min'=>'La cantidad de días debe ser al menos de 1 día.',
            'dias.max'=>'La cantidad de días supera el mes laboral.',

            'dias.numeric'=>'Solo se permiten números.',
        
            'empleado_id.required'=>'Debe seleccionar un empleado, no puede estar vacío.',
            'empleado_id.unique'=>'Ya se agregó este empleado a la planilla.',

            'total.required'=>'El total es requerido.',
            'total.numeric'=>'No se permite valores nulos.',

        ]);
        
        $input = $request->all();
         Planilla::create($input);
         Detallesplanilla::create($input);
            return redirect()->route('planilla.create')
            ->with('mensaje', 'Registro guardado');
    }

    public function eliminar($id)
    {
        $planillas = Planilla::findOrFail($id);
        $planillas->delete();

        $detalleplanillas = Detallesplanilla::findOrFail($id);
        $detalleplanillas->delete();

        return redirect()->route('planilla.create')
        ->with('mensaje', 'Se eliminó correctamente el registro');
    }

    public function eliminartodo(){
        $planillas = Planilla::all();

        $planillas->delete();

        return redirect()->route('planilla.create')
        ->with('mensaje', 'Se eliminó correctamente la tabla');
    }

    // public function backup(Request $request)
    // {

    //     // Valida si el empleado agregado a la tabla de detalles planilla ya existe
    // $exists = Detallesplanilla::where('fecha', $request->fecha)->exists();

    // if ($exists) {
    //     return response()->json(['mensaje' => 'El empleado ya se guardo con esa fecha'], 400);
    // }

    //     // Recupera todos los empleados de la planilla de la tabla original
    //     $planillas= Planilla::all();
        
    //     // Itera sobre los empleados y los inserta en la nueva tabla
    //     foreach ($planillas as $planilla) {
    //      Detallesplanilla::create([
    //         'identidad' => $planilla->empleado->identidad,
    //         'dias' => $planilla->dias,
    //         'total' => $planilla->total,
    //         'fecha' => $planilla->fecha,
    //         'nombreEmp' => $planilla->empleado->nombres,
    //         'apellidoEmp' => $planilla->empleado->apellidos,
    //         'puesto'  => $planilla->empleado->puesto->nombreCargo,
    //         'sueldo' => $planilla->empleado->puesto->sueldo

    //      ]); 
    //     }
    //     return redirect()->route('planilla.create')
    //     ->with('mensaje', 'Registro guardado');    
    // }
}
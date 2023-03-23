<?php

namespace App\Http\Controllers;

use App\Models\Detallesplanilla;
use App\Models\Empleado;
use App\Models\Planilla;
use App\Models\Tablaplanilla;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

use Illuminate\Http\Request;

class TablaplanillaController extends Controller
{
    public function index(){

        $planillas = Planilla::all();
        $tablaplanillas = Tablaplanilla::all(); 
        
        return view('tablaplanilla.index', compact('planillas', 'tablaplanillas'));
    }

    public function show($id){
        $detallesplanilla = Detallesplanilla::all();
        $empleados = Empleado::all();
        $planillas = Planilla::all();
        $tablaplanillas = Tablaplanilla::findOrFail($id);
        return view('tablaplanilla.show', compact('planillas', 'tablaplanillas', 'empleados', 'detallesplanilla'));
    }

    public function store(Request $request){

        // Funcion que permite guardar el registro en el ultimo dia del mes (real)
        $request->validate([
            'fechap' => ['required', function($attribute, $value, $fail) {
                $fecha = \DateTime::createFromFormat('d-m-Y', $value);
                $ultimoDia = $fecha->format('t');
    
                if ($fecha->format('d') != $ultimoDia) {
                    $fail('La planilla se guarda en el último día del mes');
                }
            }]
        ]);

        $this->validate($request,[
            'totalp'  => ['min:1'],
            'canEmpleados'  => ['min:1'],
                                                                                        // Valida solamente esos numeros
            // 'fechap'  => ['unique:tablaplanillas', 'required','regex:/^[0-9]{4}+-[0-9]{2}+-(28|29|30|31)+$/u'], 
            'fechap'  => ['unique:tablaplanillas'], 

            // ESTA VALIDACION PERMITE QUE SOLO GUARDE UNA VEZ AL MES EN EL DIA 28
            // 'fechap'  => ['unique:tablaplanillas', 'required','regex:/^[0-9]{4}+-[0-9]{2}+-[28]{2}+$/u'], 
            // VALIDACION PARA QUE NO GUARDE EL MISMO DIA
            // 'fechap'  => ['unique:tablaplanillas', 'required','regex:/^[0-9]{4}+-[0-9]{2}+-[0-9]{2}+$/u'], 

        ],[
            'totalp.min'=>'Debe de agregar al menos un empleado a la tabla.',
            'canEmpleados.min'=>'Debe de agregar al menos un empleado a la tabla.',

            // 'fechap.unique'=>'La planilla se guarda cada 28 de cada mes.',
            'fechap.unique'=>'La planilla del día de hoy ya se guardó.',
            'fechap.unique'=>'Ya existe una planilla con esa fecha.',
            'fechap.required'=>'Se necesita la fecha.',
            // 'fechap.regex'=>'Fecha no permitída. La planilla se guardar en los últimos dias del mes a partir del 28',

        ]);

        $input = $request->all();
        Tablaplanilla::create($input);
           return redirect()->route('planilla.index')
           ->with('mensaje', 'Registro guardado');
    }

    // Metodo para mostrar pdf
    public function pdf ($id){
        $detallesplanilla = Detallesplanilla::all();
        $tablaplanillas = Tablaplanilla::findOrFail($id);  

        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
        $pdf = PDF::loadView('tablaplanilla.pdf', compact('tablaplanillas', 'detallesplanilla'));
        return $pdf -> stream();
        
    }
}
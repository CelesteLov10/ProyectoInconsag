<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    //
    public function index(){

        $gasto = Gasto::query()
        ->when(request('search'), function($query){
        return $query->where('nombreGastos', 'LIKE', '%' .request('search') .'%')
        ->orWhere('nombreEmpresa', 'LIKE', '%' .request('search') .'%')
        ->orWhere('fechaGastos', 'LIKE', '%' .request('search') .'%')
        //para que realice busquedas por el nombre del empleado
        ->orWhereHas('empleado', function($q){
            $q->where('nombres','LIKE', '%' .request('search') .'%');
        });
        })->orderBy('id','desc')->paginate(10)->withQueryString();
    
        return view('gasto.index', compact('gasto'));
        }
    
        public function create(){
            $gasto = Gasto::all();
            $empleado = Empleado::all();
        return view('gasto.create', compact('gasto', 'empleado'));
        }
    
        public function store(Request $request){
            $reglas = [
                'nombreGastos'   => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u|min:3|max:50',
                'montoGastos' => 'required|min:1|max:9999|numeric', 
                'nombreEmpresa' => 'required|min:2|max:50', #|regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'
                'fechaGastos' => 'required', 
                'descripcion' => 'required|min:10|max:150', 
                'empleado_id' => 'required', 
                'baucherRecibo'    => 'required',
            ];
            $mensaje =[
                'nombreGastos.required' => 'El nombre del gasto es obligatorio, no puede estar vacío. ',
                'nombreGastos.regex' => 'El nombre del gasto no permite números y un espacio entre palabras.',
                'nombreGastos.min' => 'El nombre del gasto es muy corto.',
                'nombreGastos.max' => 'El nombre del gasto sobrepasa el límite de caracteres',


                'montoGastos.required' => 'El monto del gasto es obligatorio, no puede estar vacío. ',
                'montoGastos.numeric' => 'El monto del gasto debe contener sólo números.',
                'montoGastos.min' => 'El monto del gasto no debe ser menor que 1.',
                'montoGastos.max' => 'El monto del gasto no debe ser mayor que 9999.',


                'nombreEmpresa.required' => 'El nombre de la empresa es obligatorio, no puede estar vacío. ',
                'nombreEmpresa.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',
                'nombreEmpresa.min' => 'El nombre de la empresa es muy corto.',
                'nombreEmpresa.max' => 'El nombre de la empresa sobrepasa el límite de caracteres',


                'fechaGastos.required' => 'La fecha de gasto es obligatorio, no puede estar vacío. ',

                'descripcion.required' => 'La descripción del gasto es obligatoria, no puede estar vacío. ',
                'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
                'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

                'empleado_id.required' => 'El nombre del empleado que realizo el gasto es obligatorio, no puede estar vacío. ',

                'baucherRecibo.required' => 'Debe seleccionar una imagen, no puede estar vacío. ',
    
            ];
            $this->validate($request, $reglas, $mensaje);
    
            $gasto = new Gasto();
            $gasto->nombreGastos = $request->nombreGastos;
            $gasto->montoGastos = $request->montoGastos;
            $gasto->nombreEmpresa = $request->nombreEmpresa;
            $gasto->fechaGastos = $request->fechaGastos;
            $gasto->descripcion = $request->descripcion;
            $gasto->empleado_id = $request->empleado_id;

            if($request->hasFile('baucherRecibo') ){
                $file = $request->file('baucherRecibo');
                $destinationPath = 'public/imagenesGastos/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('baucherRecibo')->move($destinationPath, $filename);
                $gasto->baucherRecibo = $destinationPath . $filename;
            };
    
            $create = $gasto->save();
    
            if ($create){
                return redirect()->route('gasto.index')
                ->with('mensaje', 'Se guardó el registro del nuevo gasto correctamente');
            }
        }

        public function show($id){
            $gasto = Gasto::findOrFail($id);
            $empleado = Empleado::all();
            return view('gasto.show', compact('empleado'))->with('gasto', $gasto);
        }
    
}
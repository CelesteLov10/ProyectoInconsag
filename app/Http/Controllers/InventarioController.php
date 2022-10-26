<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Models\Oficina;
use Carbon\Carbon;

class InventarioController extends Controller
{
    public function index(){
        //Campo busqueda
        $inventarios = Inventario::query()
            ->when(request('search'), function($query){
            return $query->where('nombreInv', 'LIKE', '%' .request('search') .'%')
            //Aqui es la tabla relacionada y abajo el nombre del campo que desea.
            ->orWhereHas('oficina', function($q){
                $q->where('nombreOficina','LIKE', '%' .request('search') .'%');
            })
            ->orWhereHas('empleado', function($q){
                $q->where('nombres','LIKE', '%' .request('search') .'%');
            });
            })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        
        $empleado = Empleado::all();
        $oficina = Oficina::all();
        return view('inventario.index', compact('inventarios', 'empleado', 'oficina'));
    }

    public function create(){   
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();
        return view('inventario.create',compact('empleado', 'oficina'));
    }

    public function store(Request $request){

        $reglas = [

            'nombreInv'   => 'required|regex:/^([A-ZÁÉÍÓÚÑ a-záéíóúñ]+\s{0,1})+$/u',
            'cantidad'    => 'required|numeric|regex:/^[0-9]{1,4}+$/u',
            'precioInv'   => 'required|numeric|min:1.00|regex:/^[0-9]{1,5}+[.]{1}[0-9]{2}$/u',
            'descripcion' => 'required|regex:/^.{10,100}$/u',
            'fecha'       => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            'empleado_id' => 'required',
            'oficina_id'  => 'required',
    
        ];
        $mensaje =[
            'nombreInv.required' => 'El nombre del inventario es requerido, no puede estar vacío. ',
            'nombreInv.regex' => 'El nombre del inventario debe iniciar con mayúscula, solo permite un espacio entre los nombres y no debe  incluir números.',
            'nombreInv.alpha' => 'En el nombre del inventario sólo se permite letras.',

            'cantidad.required' => 'La cantidad del inventario es requerido.', 
            'cantidad.numeric' => 'En cantidad de inventario no se permiten letras.',
            'cantidad.regex' => 'No puede ingresar mas de 9999 artículos.',

            'precioInv.required' => 'El precio del inventario es requerido, no puede estar vacío.',
            'precioInv.numeric'=> 'En el precio del inventario no se permiten letras.',
            'precioInv.min' => 'El precio del inventario no puede ser menor a $1.00.',
            'precioInv.regex' => 'En el precio del inventario debe incluir los centavos y no pueden ir espacios.',

            'descripcion' => 'La descripción es requerido, no puede estar vacío. ',
            'descripcion.regex' => 'La descripción es muy corta.',


            'fecha.required' => 'La fecha es requerida', 
            'fecha.regex' => 'No debe agregar mas datos a la fecha seleccionada', 

            'empleado_id.required' => 'Debe seleccionar un empleado',

            'oficina_id.required' => 'Debe seleccionar una oficina'




        ];
        $this->validate($request, $reglas, $mensaje);

        Inventario::create([
            'nombreInv'=>$request['nombreInv'],
            'cantidad'=>$request['cantidad'],
            'precioInv'=>$request['precioInv'],
            'descripcion'=>$request['descripcion'],
             'fecha' =>$request[ 'fecha' ],
            'empleado_id'=>$request['empleado_id'], 
            'oficina_id'=>$request['oficina_id'], 
            
        ]);
            return redirect()->route('inventario.index')
            ->with('mensaje', 'Se guardó un nuevo inventario correctamente');
        
    }

    public function show($id){
        $inventario = Inventario::findOrFail($id);
        //$oficina = Oficina::findOrFail($id); no se para que funciona , $oficina
        return view('inventario.show')->with('inventario', $inventario);
    }

    public function edit($id){
        $inventario = Inventario::findOrFail($id);
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();

        return view('inventario.edit', compact('inventario', 'empleado','oficina'))
        ->with('inventario', $inventario);
    }

    public function update(Request $request, $id){

        $this->validate($request,[

            'nombreInv'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ a-záéíóúñ]+\s{0,1})+$/u'],
            'cantidad'    => ['required','numeric','regex:/^[0-9]{1,4}+$/u'],
            'precioInv'   => ['required','numeric','min:1.00','regex:/^[0-9]{1,5}+[.]{1}[0-9]{2}$/u'],
            'descripcion' => ['required', 'regex:/^.{10,100}$/u'],
            'fecha'       => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'empleado_id' => ['required'],
            'oficina_id'  => ['required'],
        ],[
            'nombreInv.required' => 'El nombre del inventario es requerido, no puede estar vacío. ',
            'nombreInv.alpha' => 'En el nombre del inventario sólo se permite letras.',
            'nombreInv.regex' => 'El nombre del inventario debe iniciar con mayúscula y solo permite un espacio entre el nombre',

            'cantidad.required' => 'La cantidad del inventario es requerido.', 
            'cantidad.numeric' => 'En cantidad de inventario no se permiten letras.',
            'cantidad.regex' => 'No puede ingresar mas de 9999 artículos.',

            'precioInv.required' => 'El precio del inventario es requerido, no puede estar vacío.',
            'precioInv.numeric'=> 'No se permiten letras.',
            'precioInv.min' => 'El precio del inventario no puede ser menor a $1.00.',
            'precioInv.regex' => 'El precio del inventario debe incluir los centavos.',
      

            'descripcion' => 'La descripción es requerido, no puede estar vacío. ',
            'descripcion.regex' => 'La descripción es muy corta.',


            'fecha.required' => 'La fecha es requerida', 
            'fecha.regex' => 'No debe agregar más datos a la fecha seleccionada', 

            'empleado_id.required' => 'Debe seleccionar un empleado',

            'oficina_id.required' => 'Debe seleccionar una oficina'

    
        ]);

        $inventario = Inventario::findOrFail($id);

        $inventario->nombreInv = $request->input('nombreInv');
        $inventario->cantidad = $request->cantidad;
        $inventario->precioInv = $request->precioInv;
        $inventario->descripcion = $request->descripcion;
        $inventario->fecha = $request->fecha;
        $inventario->empleado_id = $request->empleado_id;
        $inventario->oficina_id = $request->oficina_id;
        
        $update = $inventario->save();
        
        if ($update){
            return redirect()->route('inventario.index')
            ->with('mensajeW', 'Se actualizó el inventario correctamente');
        } 
    }
}

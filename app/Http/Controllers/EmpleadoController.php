<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Estado;
use App\Models\Puesto;
use Carbon\Carbon;
use Illuminate\Http\Request;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       //Campo busqueda
        $empleados = Empleado::query()
            ->when(request('search'), function($query){
            return $query->where('identidad', 'LIKE', '%' .request('search') .'%')
            ->orWhere('nombres', 'LIKE', '%' .request('search') .'%')
            //Aqui es la tabla relacionada y abajo el nombre del campo que desea.
            ->orWhereHas('puesto', function($q){
             $q->where('nombreCargo','LIKE', '%' .request('search') .'%');
            });
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        $puesto = Puesto::all();
        
        return view('empleado.indexEmp', compact('empleados', 'puesto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleado.showEmp')->with('empleado', $empleado);
    
    }
    public function create()
    {   //select de estados 
        //esta es una prueba deberia de funcionar, pero bueno
        $estados = Estado::all();
        $puesto = Puesto::orderBy('nombreCargo')->get();
        
        return view('empleado.createEmp', compact('estados', 'puesto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //variable para establecer si es mayor de edad o se coloca otro numero
        $dt = new Carbon();
        $before = $dt->subYears(18);
        //validacion para cuando se agregue un empleado
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            'identidad' =>'numeric|required|starts_with:0,1 between: 01,18|unique:empleados|digits:13',
            'nombres' =>'required|regex:/^[a-zA-Z\s]+$/u',
            'apellidos' =>'required|regex:/^[a-zA-Z\s]+$/u',
            'telefono' => 'required|unique:empleados|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/',
            'estado' => 'required',
            'correo' => 'required|email|regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#|unique:empleados',
            'fechaNacimiento' => 'required|before:'. $before,
            'direccion' => 'required',
            'fechaIngreso' => 'required',
            'puesto_id' => 'required',
        ]);
        $empleado = new Empleado();

        $empleado->identidad = $request->identidad;
        $empleado->nombres = $request->nombres;
        $empleado->apellidos = $request->apellidos;
        $empleado->telefono = $request->telefono;
        $empleado->estado = $request->estado;
        $empleado->correo = $request->correo;
        $empleado->fechaNacimiento = $request->fechaNacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->fechaIngreso = $request->fechaIngreso;
        $empleado->puesto_id = $request->puesto_id;
        
        $create = $empleado->save();
        
        if ($create){
            return redirect()->route('empleado.indexEmp')
            ->with('mensaje', 'Se guardó un nuevo empleado correctamente');
        } 
        /** redireciona una vez enviado  */
    }

    public function edit($id){
        
        $empleado = Empleado::findOrFail($id);
        $estado = Estado::all();
        $puesto = Puesto::all();

        return view('empleado.editEmp', compact('empleado', 'estado','puesto'))
        ->with('empleado', $empleado);
    }

    public function update(Request $request, $id){
        //variable para establecer si es mayor de edad o se coloca otro numero
        $dt = new Carbon();
        $before = $dt->subYears(18);
        //validacion para cuando se agregue un empleado
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            //agregamos en elcampo  "unique:empleados,: el campo del identidad y el id para que no haya problemas al momento de actualizar ya que son campos unicos
            'identidad' =>'numeric|required|starts_with:0,1 between: 01,18|unique:empleados,identidad,'.$id.'id|digits:13',
            'nombres' =>'required|regex:/^[a-zA-Z\s]+$/u',
            'apellidos' =>'required|regex:/^[a-zA-Z\s]+$/u',
            'telefono' => 'required|unique:empleados,telefono,'.$id.'id|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/',
            'estado' => 'required|string|in:activo,inactivo',
            'correo' => 'required|email|regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#|unique:empleados,correo,'.$id.'id',
            'fechaNacimiento' => 'required|before:'. $before,
            'direccion' => 'required',
            'fechaIngreso' => 'required',
            'puesto_id' => 'required',
        ]);
        $empleado = Empleado::findOrFail($id);

        $empleado->identidad = $request->input('identidad');
        $empleado->nombres = $request->input('nombres');
        $empleado->apellidos = $request->input('apellidos');
        $empleado->telefono = $request->input('telefono');
        $empleado->estado = $request->estado;
        $empleado->correo = $request->correo;
        $empleado->fechaNacimiento = $request->fechaNacimiento;
        $empleado->direccion = $request->input('direccion');
        $empleado->fechaIngreso = $request->fechaIngreso;
        $empleado->puesto_id = $request->puesto_id;
        
        $update = $empleado->save();
        
        if ($update){
            return redirect()->route('empleado.indexEmp')
            ->with('mensajeW', 'Se actualizó el empleado correctamente');
        } 
    }
    public function destroy($id)
    {
        //
    }
}
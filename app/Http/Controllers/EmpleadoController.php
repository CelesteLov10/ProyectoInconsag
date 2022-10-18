<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Estado;
use App\Models\Oficina;
use App\Models\Puesto;
use Carbon\Carbon;
use Illuminate\Http\Request;


class EmpleadoController extends Controller
{
    public function index(){
        //Campo busqueda
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
        $estado = Estado::all();

        return view('empleado.indexEmp', compact('empleados', 'puesto','estado'));
    }

    public function show($id){
        $empleado = Empleado::findOrFail($id);
        return view('empleado.showEmp')->with('empleado', $empleado);
    
    }
    public function create(){ 
        //select de estados 
        //esta es una prueba deberia de funcionar, pero bueno
        $estados = Estado::all();
        $oficina = Oficina::all();
        $puesto = Puesto::orderBy('nombreCargo')->get();
        
        return view('empleado.createEmp', compact('estados', 'puesto', 'oficina'));
    }

    public function store(Request $request){
        //variable para establecer si es mayor de edad o se coloca otro numero ->format("Y-m-d") date_format:DD-MM-YYYY
        $dt = new Carbon();
        $before = $dt->subYears(18);
        //validacion para cuando se agregue un empleado
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            'identidad' => 'required|numeric|digits:13|unique:empleados|Regex:/^[(0)(1)][0-9]+$/u',
            'nombres'   => 'required|regex:/^[a-zA-Z]+\s[a-zA-Z]+$/u|regex:/^.{1,20}$/u',
            'apellidos' => 'required|regex:/^[a-zA-Z]+\s[a-zA-Z]+$/u|regex:/^.{1,20}$/u',
            'telefono'  => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/|unique:empleados',
            'estado'    => 'required|string|in:activo,inactivo',
            'correo'    => 'required|email|regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#|unique:empleados',
            'fechaNacimiento' => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u|before:'. $before,
            'direccion'       => 'required|regex:/^.{1,50}$/u',
            'fechaIngreso'    => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            'puesto_id'       => 'required',
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
        $empleado->oficina_id = $request->oficina_id;
        
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
        $oficina = Oficina::with(['empleado.oficina'])->get();
        $puesto = Puesto::with(['empleado.puesto'])->get();
        // $puesto = DB::table('puestos')->orderBy('name', 'asc')->list('name');
        
        return view('empleado.editEmp', compact('empleado', 'estado','puesto','oficina'))
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
            'identidad' => 'numeric|required|Regex:/^[(0)(1)][0-9]+$/u|unique:empleados,identidad,'.$id.'id|digits:13',
            'nombres'   => 'required|regex:/^[a-zA-Z/s]+$/u|regex:/^.{1,20}$/u',
            'apellidos' => 'required|regex:/^[a-zA-Z/s]+$/u|regex:/^.{1,20}$/u',
            'telefono'  => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/|unique:empleados,telefono,'.$id.'id',
            'estado'    => 'required|string|in:activo,inactivo',
            'correo'    => 'required|email|regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#|unique:empleados,correo,'.$id.'id',
            'fechaNacimiento' => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u|before:'. $before,
            'direccion'       => 'required|regex:/^.{1,50}$/u',
            'fechaIngreso'    => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            'puesto_id'       => 'required',
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
        $empleado->oficina_id = $request->oficina_id;
        
        $update = $empleado->save();
        
        if ($update){
            return redirect()->route('empleado.indexEmp')
            ->with('mensajeW', 'Se actualizó el empleado correctamente');
        } 
    }
}
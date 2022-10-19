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
        $reglas = [
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            'identidad' => 'required|unique:empleados|numeric|regex:/^[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0-9]+$/u',
            'nombres'   => 'required|regex:/^[a-zA-Z]+\s{0,1}[a-zA-Z]+$/u|regex:/^.{1,20}$/u',
            'apellidos' => 'required|regex:/^[a-zA-Z]+\s{0,1}[a-zA-Z]+$/u|regex:/^.{1,20}$/u',
            'telefono'  => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/|unique:empleados',
            'estado'    => 'required|string|in:activo,inactivo',
            'correo'    => 'required|email|regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#|unique:empleados',
            'fechaNacimiento' => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u|before:'. $before,
            'direccion'       => 'required|string|min:40',
            'fechaIngreso'    => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            'puesto_id'       => 'required',
            'oficina_id'       => 'required',

        ];
        $mensaje=[
            'identidad.required'=>'Debe ingresar el número de identidad, no puede estar vacío.',
            'identidad.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidad.unique' => 'El número de identidad debe ser único.',
           // 'identidad.numeric' => 'El número de identidad sólo se permiten números ',
           'identidad.regex' => 'El formato para el número de identidad no es válido.',

           'nombres.required' => 'El nombre no puede ir vacío.',
            'nombres.alpha' => 'En el nombre sólo permite letras.',
            'nombres.regex' => 'En el nombre sólo se permite un espacio entre los nombres.',

            'apellidos.required' => 'El apellido no puede ir vacío.',
            'apellidos.alpha' => 'En el apellido sólo se permite letras.',
            'apellidos.regex' => 'En el apellido sólo se permite un espacio entre los apellidos.',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener sólo 8 números.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',

            'estado.required' => 'Debe seleccionar un estado.',

            'correo.required' => '¡Debe ingresar el correo electrónico!',
            'correo.email' => '¡Debe ingresar un correo electrónico válido!',
            'correo.unique' => '¡Debe ingresar un correo electrónico diferente!',

            'fechaNacimiento.required' => 'La fecha de nacimiento no puede ir vacío.',
            'fechaNacimiento.regex' => 'Debe ser mayor de edad.',

            'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.min' => 'La dirección es muy corta.',

            'fechaIngreso.required' => 'Debe seleccionar la fecha de ingreso, no puede ir vacío.',
            'puesto_id.required' => 'Debe seleccionar el puesto de trabajo, no puede ir vacío.',
            'oficina_id.required'=> 'Debe seleccionar la oficina, no puede ir vacío.',
            
            

        ];
        $this->validate($request, $reglas, $mensaje);

        /*|regex:([0-1][0-8][0-2][0-9]{10})|max:13
         regex:/^[a-zA-Z]+\s[a-zA-Z]+$/u|regex:/^.{1,20}$/u
         |regex:/^[a-zA-Z]+\s[a-zA-Z]+$/u|regex:/^.{1,20}$/u
        */
        Empleado::create([
            'identidad'=>$request['identidad'],
            'nombres'=>$request['nombres'],
            'apellidos'=>$request['apellidos'],
            'telefono'=>$request['telefono'],
            'estado'=>$request['estado'], 
            'correo'=>$request['correo'], 
            'fechaNacimiento'=>$request['fechaNacimiento'], 
            'direccion'=>$request['direccion'],
            'fechaIngreso'=>$request['fechaIngreso'], 
            'puesto_id'=>$request['puesto_id'],
            'oficina_id'=>$request['oficina_id'],
        ]);

            return redirect()->route('empleado.indexEmp')
            ->with('mensaje', 'Se guardó un nuevo empleado correctamente');
        
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
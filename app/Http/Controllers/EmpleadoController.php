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
        // regex basico para nombres regex:/^[a-zA-Z]+\s{0,1}[a-zA-Z]+$/u

        /* regex para verificacion de la primera letra mayuscula 
           regex:/^([A-Z]{1})[a-z]{0,15}+\s{0,1}[A-Z]{0,1}[a-z]{0,15}+$/u */

        $this->validate($request,[
            'identidad' => ['required','numeric','unique:empleados',
            'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
            'nombres'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'apellidos' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:empleados'],
            'estado'    => ['required','alpha','in:activo,inactivo'],
            'correo'    => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:empleados'],
            'fechaNacimiento' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u','before:'. $before],
            'direccion'       => ['required','regex:/^.{10,150}$/u'],
            'fechaIngreso'    => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'puesto_id'       => ['required'],
            'oficina_id'       => ['required'],

        ],[
            'identidad.required'=>'Debe ingresar el número de identidad, no puede estar vacío.',
            'identidad.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidad.unique' => 'El número de identidad debe ser único.',
            'identidad.numeric' => 'En la identidad sólo se permiten números ',
            'identidad.regex' => 'El formato para el número de identidad no es válido.',

            'nombres.required' => 'El nombre no puede ir vacío.',
            'nombres.alpha' => 'En el nombre sólo se permite letras.',
            'nombres.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'apellidos.required' => 'El apellido no puede ir vacío.',
            'apellidos.alpha' => 'El apellido sólo permite letras.',
            'apellidos.regex' => 'El apellido debe iniciar con mayúscula y sólo permite un espacio entre ellos.',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'estado.required' => 'Debe seleccionar un estado.',
           // 'estado.in:activo,inactivo' => 'Solo se permite: activo o inactivo.',

            'correo.required' => 'Debe ingresar el correo electrónico.',
            'correo.email' => 'Debe ingresar un correo electrónico válido.',
            'correo.unique' => 'El correo electrónico ya está en uso.',

            'fechaNacimiento.required' => 'La fecha de nacimiento no puede ir vacío.',
            'fechaNacimiento.regex' => 'Debe ser mayor de edad.',

            'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.regex' => 'La dirección permite mínimo 10 y máximo 150 palabras.',

            'fechaIngreso.required' => 'Debe seleccionar la fecha de ingreso, no puede ir vacío.',
            'puesto_id.required' => 'Debe seleccionar el puesto de trabajo, no puede ir vacío.',
            'oficina_id.required'=> 'Debe seleccionar la oficina, no puede ir vacío.',
            
            

        ]);
        $input = $request->all();
        
     
         Empleado::create($input);
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
        $this->validate($request, [
            'identidad' => ['numeric','required','unique:empleados,identidad,'.$id.'id'
            ,'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
            'nombres'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'apellidos' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:empleados,telefono,'.$id.'id'],
            'estado'    => ['required','string','in:activo,inactivo'],
            'correo'    => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:empleados,correo,'.$id.'id'],
            'fechaNacimiento' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u', 'before:'. $before],
            'direccion'       => ['required','regex:/^.{10,150}$/u'],
            'fechaIngreso'    => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'puesto_id'       => ['required'],
            'oficina_id'       => ['required'],
        ], [
    
            'identidad.required'=>'Debe ingresar el número de identidad, no puede estar vacío.',
            'identidad.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidad.unique' => 'El número de identidad debe ser único.',
            'identidad.numeric' => 'En la identidad sólo se permiten números.',
            'identidad.regex' => 'El formato para el número de identidad no es válido.',

            'nombres.required' => 'El nombre no puede ir vacío.',
            'nombres.alpha' => 'El nombre sólo permite letras.',
            'nombres.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'apellidos.required' =>'El apellido no puede ir vacío.',
            'apellidos.alpha' =>'El apellido sólo permite letras.',
            'apellidos.regex' =>'El apellido debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'estado.required' => 'Debe seleccionar un estado.',

            'correo.required' =>'Debe ingresar el correo electrónico.',
            'correo.email' =>'Debe ingresar un correo electrónico válido.',
            'correo.unique' =>'El correo electrónico ya está en uso.',

            'fechaNacimiento.required' =>'La fecha de nacimiento no puede ir vacío.',
            'fechaNacimiento.regex' =>'Debe ser mayor de edad.',

            'direccion.required' =>'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.regex' => 'La dirección permite mínimo 10 y máximo 150 palabras.',

            'fechaIngreso.required' =>'Debe seleccionar la fecha de ingreso, no puede ir vacío.',
            'puesto_id.required' =>'Debe seleccionar el puesto de trabajo, no puede ir vacío.',
            'oficina_id.required'=>'Debe seleccionar la oficina, no puede ir vacío.',
        
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
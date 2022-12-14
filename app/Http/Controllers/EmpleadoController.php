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
            'nombres'   => ['required','regex:/^([A-Z????????????]{1}[a-z????????????]+\s{0,1})+$/u'],
            'apellidos' => ['required','regex:/^([A-Z????????????]{1}[a-z????????????]+\s{0,1})+$/u'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:empleados'],
            'estado'    => ['required','alpha','in:activo,inactivo'],
            'correo'    => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:empleados'],
            'fechaNacimiento' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u','before:'. $before],
            'direccion'       => ['required','min:10','max:150'],
            'fechaIngreso'    => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'puesto_id'       => ['required'],
            'oficina_id'       => ['required'],

        ],[
            'identidad.required'=>'Debe ingresar el n??mero de identidad, no puede estar vac??o.',
            'identidad.digits' => 'El n??mero de identidad debe tener 13 d??gitos. ',
            'identidad.unique' => 'El n??mero de identidad debe ser ??nico.',
            'identidad.numeric' => 'En la identidad s??lo se permiten n??meros ',
            'identidad.regex' => 'El formato para el n??mero de identidad no es v??lido.',

            'nombres.required' => 'El nombre no puede ir vac??o.',
            'nombres.alpha' => 'En el nombre s??lo se permite letras.',
            'nombres.regex' => 'El nombre debe iniciar con may??scula y solo permite un espacio entre ellos.',

            'apellidos.required' => 'El apellido no puede ir vac??o.',
            'apellidos.alpha' => 'El apellido s??lo permite letras.',
            'apellidos.regex' => 'El apellido debe iniciar con may??scula y s??lo permite un espacio entre ellos.',

            'telefono.required' => 'El tel??fono no puede ir vac??o.',
            'telefono.numeric' => 'El tel??fono debe contener s??lo n??meros.',
            'telefono.digits' => 'El tel??fono debe contener 8 d??gitos.',
            'telefono.regex' => 'El tel??fono debe empezar s??lo con los siguientes d??gitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El n??mero de tel??fono ya est?? en uso.',

            'estado.required' => 'Debe seleccionar un estado.',
           // 'estado.in:activo,inactivo' => 'Solo se permite: activo o inactivo.',

            'correo.required' => 'Debe ingresar el correo electr??nico.',
            'correo.email' => 'Debe ingresar un correo electr??nico v??lido.',
            'correo.unique' => 'El correo electr??nico ya est?? en uso.',

            'fechaNacimiento.required' => 'La fecha de nacimiento no puede ir vac??o.',
            'fechaNacimiento.regex' => 'Debe ser mayor de edad.',

            'direccion.required' => 'Se necesita saber la direcci??n, no puede ir vac??o.',
            'direccion.min' => 'La direcci??n es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La direcci??n sobrepasa el l??mite de caracteres',

            'fechaIngreso.required' => 'Debe seleccionar la fecha de ingreso, no puede ir vac??o.',
            'puesto_id.required' => 'Debe seleccionar el puesto de trabajo, no puede ir vac??o.',
            'oficina_id.required'=> 'Debe seleccionar la oficina, no puede ir vac??o.',
            
            

        ]);
        $input = $request->all();
        
     
         Empleado::create($input);
            return redirect()->route('empleado.indexEmp')
            ->with('mensaje', 'Se guard?? un nuevo empleado correctamente');
        
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
            'nombres'   => ['required','regex:/^([A-Z????????????]{1}[a-z????????????]+\s{0,1})+$/u'],
            'apellidos' => ['required','regex:/^([A-Z????????????]{1}[a-z????????????]+\s{0,1})+$/u'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:empleados,telefono,'.$id.'id'],
            'estado'    => ['required','string','in:activo,inactivo'],
            'correo'    => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:empleados,correo,'.$id.'id'],
            'fechaNacimiento' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u', 'before:'. $before],
            'direccion'       => ['required','min:10','max:150'],
            'fechaIngreso'    => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'puesto_id'       => ['required'],
            'oficina_id'       => ['required'],
        ], [
    
            'identidad.required'=>'Debe ingresar el n??mero de identidad, no puede estar vac??o.',
            'identidad.digits' => 'El n??mero de identidad debe tener 13 d??gitos. ',
            'identidad.unique' => 'El n??mero de identidad debe ser ??nico.',
            'identidad.numeric' => 'En la identidad s??lo se permiten n??meros.',
            'identidad.regex' => 'El formato para el n??mero de identidad no es v??lido.',

            'nombres.required' => 'El nombre no puede ir vac??o.',
            'nombres.alpha' => 'El nombre s??lo permite letras.',
            'nombres.regex' => 'El nombre debe iniciar con may??scula y solo permite un espacio entre ellos.',

            'apellidos.required' =>'El apellido no puede ir vac??o.',
            'apellidos.alpha' =>'El apellido s??lo permite letras.',
            'apellidos.regex' =>'El apellido debe iniciar con may??scula y solo permite un espacio entre ellos.',

            'telefono.required' => 'El tel??fono no puede ir vac??o.',
            'telefono.numeric' => 'El tel??fono debe contener s??lo n??meros.',
            'telefono.digits' => 'El tel??fono debe contener 8 d??gitos.',
            'telefono.regex' => 'El tel??fono debe empezar s??lo con los siguientes d??gitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El n??mero de tel??fono ya est?? en uso.',

            'estado.required' => 'Debe seleccionar un estado.',

            'correo.required' =>'Debe ingresar el correo electr??nico.',
            'correo.email' =>'Debe ingresar un correo electr??nico v??lido.',
            'correo.unique' =>'El correo electr??nico ya est?? en uso.',

            'fechaNacimiento.required' =>'La fecha de nacimiento no puede ir vac??o.',
            'fechaNacimiento.regex' =>'Debe ser mayor de edad.',

            'direccion.required' =>'Se necesita saber la direcci??n, no puede ir vac??o.',
            'direccion.min' => 'La direcci??n es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La direcci??n sobrepasa el l??mite de caracteres',

            'fechaIngreso.required' =>'Debe seleccionar la fecha de ingreso, no puede ir vac??o.',
            'puesto_id.required' =>'Debe seleccionar el puesto de trabajo, no puede ir vac??o.',
            'oficina_id.required'=>'Debe seleccionar la oficina, no puede ir vac??o.',
        
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
            ->with('mensajeW', 'Se actualiz?? el empleado correctamente');
        } 
    }
}
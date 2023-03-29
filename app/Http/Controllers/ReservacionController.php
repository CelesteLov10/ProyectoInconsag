<?php

namespace App\Http\Controllers;

//use App\Models\Empleado;
use App\Models\Reservacion;
use Illuminate\Http\Request;

class ReservacionController extends Controller
{
    public function index()
    {
        //Campo busqueda
        
        $reservaciones = Reservacion::query()
            ->when(request('search'), function($query){
            return $query->where('nombreCliente', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        return view('reservacion.index', compact('reservaciones'));
    }

    public function create()
    {
       // $empleado = Empleado::all();
         //$empleado = Empleado::orderBy('nombres')->get();
        $reservacion = Reservacion::all();
        return view('reservacion.create', compact('reservacion'));
    }

    public function store(Request $request)
    {

            $this->validate($request,[
                'nombreCliente'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
                'identidadCliente' => ['required','numeric','unique:reservacions',
                'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
                'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/'],
                ['regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
                'correoCliente' =>['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:reservacions'],
                'fechaCita' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
                'horaCita' => ['required'],
                 //'empleado_id' => ['required'],
                

            ], [
            'nombreCliente.required' => 'El nombre del cliente es obligatorio, no puede estar vacío.',
            'nombreCliente.alpha' => 'En el nombre sólo se permite letras.',
            'nombreCliente.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'identidadCliente.required'=>'El número de identidad es obligatorio, no puede estar vacío.',
            'identidadCliente.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidadCliente.unique' => 'El número de identidad debe ser único.',
            'identidadCliente.numeric' => 'En la identidad sólo se permiten números ',
            'identidadCliente.regex' => 'El formato para el número de identidad no es válido.',

            'telefono.required' => 'El teléfono del cliente es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'correoCliente.required' => 'El correo electrónico es obligatorio, no puede estar vacío.',
            'correoCliente.email' => 'Debe ingresar un correo electrónico válido.',
            'correoCliente.unique' => 'El correo electrónico ya está en uso.',

            'fechaCita.required' => 'La fecha de reservacion de la cita es obligatorio, no puede estar vacío.',
            'fechaCita.regex' => 'Debe ser mayor un mes antes.',

            'horaCita.required' => 'La hora de reservacion de la cita es obligatorio, no puede estar vacío.',

             //'empleado_id.required' => 'seleccione el nombre del empleado es obligatorio, no puede estar vacío.',

            
            ]);

            $input = $request->all();
            
            Reservacion::create($input);
                return redirect()->route('reservacion.index')
                ->with('mensaje', 'Se guardó el registro de la nueva reservacion de la cita correctamente');         
         
            
    }

    public function show($id)
    {
        $reservaciones = Reservacion::findOrFail($id);
        return view('reservacion.show')->with('reservacion', $reservaciones);
    }
    public function edit($id){
        $reservacion = Reservacion::findOrFail($id);
        //$empleado = Empleado::orderBy('nombres')->get();
        return view('reservacion.edit', compact('reservacion'))
        ->with('reservacion', $reservacion);
    }

    public function update(Request $request, $id){

        $this->validate($request,[

            'nombreCliente'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'identidadCliente'    => ['required','numeric', 'unique:reservacions,identidadCliente,' .$id.'id',
            'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/'],
            'correoCliente' => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:reservacions,correoCliente,' .$id.'id'],
            'fechaCita'       => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
             //'horaCita'  => ['required', 'regex:/(1[0-2]|0?[1-9]):[0-5][0-9] (AM|PM)/'],
             'horaCita'  => ['required'],
             //'empleado_id' => ['required'],
            
        ],[
            'nombreCliente.required' => 'El nombre del cliente es obligatorio, no puede estar vacío.',
            'nombreCliente.alpha' => 'En el nombre sólo se permite letras.',
            'nombreCliente.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            //'nombreEmpleado.required' => 'El nombre del empleadp es obligatorio, no puede estar vacío.',

            'identidadCliente.required'=>'El número de identidad es obligatorio, no puede estar vacío.',
            'identidadCliente.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidadCliente.unique' => 'El número de identidad debe ser único.',
            'identidadCliente.numeric' => 'En la identidad sólo se permiten números ',
            'identidadCliente.regex' => 'El formato para el número de identidad no es válido.',

            'telefono.required' => 'El teléfono del cliente es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'correoCliente.required' => 'El correo electrónico es obligatorio, no puede estar vacío.',
            'correoCliente.email' => 'Debe ingresar un correo electrónico válido.',
            'correoCliente.unique' => 'El correo electrónico ya está en uso.',

            'fechaCita.required' => 'La fecha de reservacion de la cita es obligatorio, no puede estar vacío.',
            'fechaCita.regex' => 'Debe ser mayor un mes antes.',

            'horaCita.required' => 'La hora de reservacion de la cita es obligatorio, no puede estar vacío.',
            'horaCita.regex' => 'El formato para el número de identidad no es válido.',

             //'empleado_id.required' => 'seleccione el nombre del empleado es obligatorio, no puede estar vacío.',
        ]);

        $reservacion = Reservacion::findOrFail($id);

        $reservacion->nombreCliente = $request->input('nombreCliente');
        $reservacion->identidadCliente = $request->input('identidadCliente');
        $reservacion->telefono = $request->input('telefono');
        $reservacion->correoCliente = $request->input('correoCliente');
        $reservacion->fechaCita = $request->input('fechaCita');
        $reservacion->horaCita = $request->input('horaCita');
         //$reservacion->empleado_id = $request->empleado_id;
        
        $update = $reservacion->save();
        
        if ($update){
            return redirect()->route('reservacion.index')
            ->with('mensajeW', 'Se actualizó la cita correctamente');
        } 
    }
}
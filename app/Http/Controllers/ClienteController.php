<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        //Campo busqueda
        $clientes = Cliente::query()
            ->when(request('search'), function($query){
            return $query->where('identidadC', 'LIKE', '%' .request('search') .'%')
            ->orWhere('nombreCompleto', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(1000000)->withQueryString(); 

        return view('cliente.index', compact('clientes'));
    }

    public function create()
    {
        $cliente = Cliente::all();
        return view('cliente.create', compact('cliente'));
    }

    public function store(Request $request)
    {
         //variable para establecer si es mayor de edad o se coloca otro numero ->format("Y-m-d") date_format:DD-MM-YYYY
            $dt = new Carbon();
            $before = $dt->subYears(18);
    
            $this->validate($request,[
                'identidadC' => ['required','numeric','unique:clientes',
                'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
                'nombreCompleto'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
                'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:clientes'],
                'direccion'       => ['required','min:10','max:150'],
                'fechaNacimiento' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u','before:'. $before],
            ],[
            'identidadC.required'=>'El número de identidad es obligatorio, no puede estar vacío.',
            'identidadC.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidadC.unique' => 'El número de identidad debe ser único.',
            'identidadC.numeric' => 'En la identidad sólo se permiten números ',
            'identidadC.regex' => 'El formato para el número de identidad no es válido.',

            'nombreCompleto.required' => 'El nombre del cliente es obligatorio, no puede estar vacío.',
            'nombreCompleto.alpha' => 'En el nombre sólo se permite letras.',
            'nombreCompleto.regex' => 'El nombre debe iniciar con mayúscula, solo permite un espacio entre ellos y no se permiten números.',

            'telefono.required' => 'El teléfono del cliente es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'fechaNacimiento.required' => 'La fecha de nacimiento del cliente es obligatorio, no puede estar vacío.',
            'fechaNacimiento.regex' => 'Debe ser mayor de edad.',

            'direccion.required' => 'La dirección del cliente es obligatoria, no puede estar vacío.',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',

            ]);
            $input = $request->all();
            
            Cliente::create($input);
                return redirect()->route('cliente.index')
                ->with('mensaje', 'Se guardó un nuevo cliente correctamente');
            
         /** redireciona una vez enviado  */
    }

    public function show($id)
    {
        $beneficiario = Beneficiario::all();
        $cliente = Cliente::findOrFail($id);
        return view('cliente.show')->with('cliente', $cliente);
    }

    public function edit($id){
        $clientes = Cliente::findOrFail($id);
        return view('cliente.edit', compact('clientes'))
        ->with('cliente', $clientes);
    }

    public function update(Request $request, $id){
        //variable para establecer si es mayor de edad o se coloca otro numero ->format("Y-m-d") date_format:DD-MM-YYYY
        $dt = new Carbon();
        $before = $dt->subYears(18);

        $this->validate($request,[
            'identidadC' => ['numeric','required','unique:clientes,identidadC,'.$id.'id'
            ,'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
            'nombreCompleto'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:clientes,telefono,'.$id.'id'],
            'direccion'       => ['required','min:10','max:150'],
            'fechaNacimiento' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u','before:'. $before],
        ],[
            'identidadC.required'=>'El número de identidad es obligatorio, no puede estar vacío.',
            'identidadC.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidadC.unique' => 'El número de identidad debe ser único.',
            'identidadC.numeric' => 'En la identidad sólo se permiten números ',
            'identidadC.regex' => 'El formato para el número de identidad no es válido.',

            'nombreCompleto.required' => 'El nombre del cliente es obligatorio, no puede estar vacío.',
            'nombreCompleto.alpha' => 'En el nombre sólo se permite letras.',
            'nombreCompleto.regex' => 'El nombre debe iniciar con mayúscula, solo permite un espacio entre ellos y no se permiten números.',

            'telefono.required' => 'El teléfono del cliente es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'fechaNacimiento.required' => 'La fecha de nacimiento del cliente es obligatorio, no puede estar vacío.',
            'fechaNacimiento.regex' => 'Debe ser mayor de edad.',

            'direccion.required' => 'La dirección del cliente es obligatoria, no puede estar vacío.',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',
        
        ]);

        $clientes = Cliente::findOrFail($id);

        $clientes->identidadC = $request->input('identidadC');
        $clientes->nombreCompleto = $request->input('nombreCompleto');
        $clientes->telefono = $request->input('telefono');
        $clientes->direccion = $request->input('direccion');
        $clientes->fechaNacimiento = $request->fechaNacimiento;
        
        
        $update = $clientes->save();
        
        if ($update){
            return redirect()->route('cliente.index')
            ->with('mensajeW', 'Se actualizó el cliente correctamente');
        } 
    }
}
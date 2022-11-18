<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Campo busqueda
        $clientes = Cliente::query()
            ->when(request('search'), function($query){
            return $query->where('identidadC', 'LIKE', '%' .request('search') .'%')
            ->orWhere('nombreCompleto', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 

        return view('cliente.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cliente = Cliente::all();
        return view('cliente.create', compact('cliente'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
             'descripcion'       => ['required','min:10','max:150'],
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
 
             'fechaNacimiento.required' => 'La fecha de nacimiento no puede ir vacío.',
             'fechaNacimiento.regex' => 'Debe ser mayor de edad.',
 
             'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
             'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
             'direccion.max' => 'La dirección sobrepasa el límite de caracteres',
             
 
         ]);
         $input = $request->all();
         
          Cliente::create($input);
             return redirect()->route('empleado.indexEmp')
             ->with('mensaje', 'Se guardó un nuevo cliente correctamente');
         
         /** redireciona una vez enviado  */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('cliente.show')->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

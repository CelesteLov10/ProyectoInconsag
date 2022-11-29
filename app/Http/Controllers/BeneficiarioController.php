<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Cliente;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{
    public function index()
    {
    
    }

    public function create()
    {
        $beneficiario = Beneficiario::all();
        $cliente = Cliente::all();
        return view('cliente.create', compact('beneficiario'));
    }

    public function store(Request $request)
    {
            $this->validate($request,[
                'identidadBen' => ['required','numeric','unique:beneficiarios',
                'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
                'nombreCompletoBen'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
                'telefonoBen'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:beneficiarios'],
                'direccionBen'       => ['required','min:10','max:150'],
                'cliente_id'       => ['required'],
            ],[

            'identidadBen.required'=>'Debe ingresar el número de identidad, no puede estar vacío.',
            'identidadBen.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidadBen.unique' => 'El número de identidad debe ser único.',
            'identidadBen.numeric' => 'En la identidad sólo se permiten números ',
            'identidadBen.regex' => 'El formato para el número de identidad no es válido.',

            'nombreCompletoBen.required' => 'El nombre no puede ir vacío.',
            'nombreCompletoBen.alpha' => 'En el nombre sólo se permite letras.',
            'nombreCompletoBen.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'telefonoBen.required' => 'El teléfono no puede ir vacío.',
            'telefonoBen.numeric' => 'El teléfono debe contener sólo números.',
            'telefonoBen.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefonoBen.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefonoBen.unique' => 'El número de teléfono ya está en uso.',

            'direccionBen.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccionBen.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccionBen.max' => 'La dirección sobrepasa el límite de caracteres',

            'cliente_id' => 'La nombre del cliente es requerido, no puede estar vacío. ',

            ]);
            $input = $request->all();
            
            Beneficiario::create($input);
                return redirect()->route('venta.index')
                ->with('mensaje', 'Se guardó un nuevo beneficiario correctamente');
            
         /** redireciona una vez enviado  */
    }

    public function edit($id){
        $beneficiarios = Beneficiario::findOrFail($id);
        $cliente = Cliente::findOrFail($id);
        return view('venta.show', compact('beneficiarios','cliente'))
        ->with('beneficiarios', $beneficiarios);
    }

    public function update(Request $request, $id){
        //variable para establecer si es mayor de edad o se coloca otro numero ->format("Y-m-d") date_format:DD-MM-YYYY

        $this->validate($request,[
            'identidadBen' => ['numeric','required','unique:clientes,identidadC,'.$id.'id'
            ,'regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
            'nombreCompletoBen'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'telefonoBen'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:clientes,telefono,'.$id.'id'],
            'direccionBen'       => ['required','min:10','max:150'],
            'cliente_id' => ['required'],
        ],[
            'identidadBen.required'=>'Debe ingresar el número de identidad, no puede estar vacío.',
            'identidadBen.digits' => 'El número de identidad debe tener 13 dígitos. ',
            'identidadBen.unique' => 'El número de identidad debe ser único.',
            'identidadBen.numeric' => 'En la identidad sólo se permiten números ',
            'identidadBen.regex' => 'El formato para el número de identidad no es válido.',

            'nombreCompletoBen.required' => 'El nombre no puede ir vacío.',
            'nombreCompletoBen.alpha' => 'En el nombre sólo se permite letras.',
            'nombreCompletoBen.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'telefonoBen.required' => 'El teléfono no puede ir vacío.',
            'telefonoBen.numeric' => 'El teléfono debe contener sólo números.',
            'telefonoBen.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefonoBen.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefonoBen.unique' => 'El número de teléfono ya está en uso.',

            'direccionBen.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccionBen.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccionBen.max' => 'La dirección sobrepasa el límite de caracteres',

            'cliente_id' => 'La nombre del cliente es requerido, no puede estar vacío. ',
        
        ]);

        $beneficiario = Beneficiario::findOrFail($id);

        $beneficiario->identidadBen = $request->input('identidadBen');
        $beneficiario->nombreCompletoBen = $request->input('nombreCompletoBen');
        $beneficiario->telefonoBen = $request->input('telefonoBen');
        $beneficiario->direccionBen = $request->input('direccionBen');
        $beneficiario->cliente_id = $request->cliente_id;
        
        
        $update = $beneficiario->save();
        
        if ($update){
            return redirect()->route('cliente.index')
            ->with('mensajeW', 'Se actualizó el beneficiario correctamente');
        } 
    }
}

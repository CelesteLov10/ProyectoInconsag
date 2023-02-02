<?php

namespace App\Http\Controllers;

use App\Models\Constructora;
use Illuminate\Http\Request;

class ConstructoraController extends Controller
{
    public function index()
    {
    $constructoras = Constructora::query()
    ->when(request('search'), function($query){
    return $query->where('nombreConstructora', 'LIKE', '%' .request('search') .'%')
    ->orWhere('telefono', 'LIKE', '%' .request('search') .'%')
    ->orWhere('fechaContrato', 'LIKE', '%' .request('search') .'%');
    })->orderBy('id','desc')->paginate(10)->withQueryString();

    return view('constructora.index', compact('constructoras'));
    }

    public function create()
    {
        $constructoras=Constructora::all();
       return view('constructora.create');
    }

    public function store(Request $request)
    {
            $this->validate($request,[
                'nombreConstructora' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
                'direccion' => ['required','min:10','max:150'],
                'telefono' => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:constructoras'],
                'email' => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:constructoras'],
                'fechaContrato' =>'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            ],[

            'nombreConstructora.required' => 'El nombre no puede ir vacío.',
            'nombreConstructora.alpha' => 'En el nombre sólo se permite letras.',
            'nombreConstructora.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'email.required' => 'Debe ingresar el correo electrónico.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'fechaContrato.required' => 'Debe seleccionar la fecha de adquisición, no puede estar vacío.',
            ]);
            $input = $request->all();
            
            Constructora::create($input);
                return redirect()->route('constructora.index')
                ->with('mensaje', 'Se guardó el registro de la nueva constructora correctamente');
            
         /** redireciona una vez enviado  */
    }

    public function show($id)
    {
        $constructoras = Constructora::all();
        $constructoras = Constructora::findOrFail($id);
        return view('constructora.show')->with('constructora', $constructoras);
    }

    public function edit($id){
        $constructoras = Constructora::findOrFail($id);
        return view('constructora.edit', compact('constructoras'))
        ->with('constructora', $constructoras);//es con es
    }
      
    public function update(Request $request, $id){
        
        $this->validate($request,[
            'nombreConstructora'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'direccion'       => ['required','min:10','max:150'],
            'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:clientes,telefono,'.$id.'id'],
            'email'    => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:constructoras'],
            'fechaContrato'  => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
        ],[
            'nombreConstructora.required' => 'El nombre no puede ir vacío.',
            'nombreConstructora.alpha' => 'En el nombre sólo se permite letras.',
            'nombreConstructora.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'email.required' => 'Debe ingresar el correo electrónico.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'fechaAdquisicion.required' => 'Debe seleccionar la fecha de adquisición, no puede estar vacío.',

            
        
        ]);

        $constructoras = Constructora::findOrFail($id);

        $constructoras->nombreConstructora = $request->input('nombreConstructora');
        $constructoras->direccion = $request->input('direccion');
        $constructoras->telefono = $request->input('telefono');
        $constructoras->email = $request->input('email');
        $constructoras->fechaContrato = $request->input('fechaContrato');
       
        
        
        $update = $constructoras->save();
        
        if ($update){
            return redirect()->route('constructora.index')
            ->with('mensajeW', 'Se actualizó la constructora correctamente');
        } 
    }
}
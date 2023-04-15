<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    //
    public function index()
    {
        //Campo busqueda
        
        $contactos = Contacto::query()
            ->when(request('search'), function($query){
            return $query->where('nombre', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(1000000)->withQueryString(); 
        return view('contacto.index', compact('contactos'));
    }

    public function create()
    {
       // $empleado = Empleado::all();
         //$empleado = Empleado::orderBy('nombres')->get();
        $contacto =  Contacto::all();
        return view('contacto.create', compact('contacto'));
    }

    public function store(Request $request)
    {         

        
            $this->validate($request,[
                'nombre'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
                'apellido'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],

                'telefono'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/', 'digits:8'],
                ['regex:/^(?!0{2})(?!1{1}9{1})[0-1]{1}[0-9]{1}[0-2]{1}[0-9]{1}[1-2]{1}[0,9]{1}[0-9]+$/u'],
                'correo' =>['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#'],
                'mensaje'       => ['required','min:10','max:255'], 
                'fecha' => ['required']

              
                

            ], [
            'nombre.required' => 'Su nombre es obligatorio, no puede estar vacío.',
            'nombre.alpha' => 'En el nombre sólo se permite letras.',
            'nombre.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',


            'apellido.required' => 'Su apellido es obligatorio, no puede estar vacío.',
            'apellido.alpha' => 'En el apellido sólo se permite letras.',
            'apellido.regex' => 'El apellido debe iniciar con mayúscula y solo permite un espacio entre ellos.',


            'telefono.required' => 'El número de su teléfono es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
           

            'correo.required' => 'Su correo electrónico es obligatorio, no puede estar vacío.',
            'correo.email' => 'Debe ingresar un correo electrónico válido.',
           
            'mensaje.required' => 'Debe escribir una razón por la cual quiere comunicarse con nosotros, no puede estar vacío.',
            'mensaje.min' => 'El mensaje es muy corto. Ingrese entre 10 y 250 caracteres',
            'mensaje.max' => 'El mensaje sobrepasa el límite de caracteres',

            'fecha.required' => 'La fecha de su registro es obligatoria, no puede estar vacío.'

            
            ]);

            $input = $request->all();
            
            Contacto::create($input);
              return redirect()->route('dashboard')
              ->with('mensajeContacto', '¡Se envió la información correctamente!');         
         
            
    }

    public function show($id)
    {
        $contacto = Contacto::findOrFail($id);
        return view('contacto.show')->with('contacto', $contacto);
    }

}

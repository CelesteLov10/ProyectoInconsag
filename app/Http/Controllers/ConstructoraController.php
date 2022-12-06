<?php

namespace App\Http\Controllers;

use App\Models\Constructora;
use Illuminate\Http\Request;

class ConstructoraController extends Controller
{
    public function index()
    {
    
    }

    public function create()
    {
       //$constructora=Constructora::all();
       return view('constructora.create');
    }

    public function store(Request $request)
    {
            $this->validate($request,[
                'nombreConstructora'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
                'direccion'       => ['required','min:10','max:150'],
                'telefonot'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:beneficiarios'],
                
            ],[

            'nombreConstructora.required' => 'El nombre no puede ir vacío.',
            'nombreConstructora.alpha' => 'En el nombre sólo se permite letras.',
            'nombreConstructora.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',

            'telefonot.required' => 'El teléfono no puede ir vacío.',
            'telefonot.numeric' => 'El teléfono debe contener sólo números.',
            'telefonot.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefonot.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefonot.unique' => 'El número de teléfono ya está en uso.',

            

            ]);
            $input = $request->all();
            
            Constructora::create($input);
                return redirect()->route('venta.index')
                ->with('mensaje', 'Se guardó el registro de la nueva constructora correctamente');
            
         /** redireciona una vez enviado  */
    }

    public function edit($id){
        //$constructora = Constructora::findOrFail($id);
        //return view('constructora.show', compact('constructora'))
        //->with('constructora', $constructora);//es con es
    }

    public function update(Request $request, $id){
        //variable para establecer si es mayor de edad o se coloca otro numero ->format("Y-m-d") date_format:DD-MM-YYYY

        $this->validate($request,[
            'nombreConstructora'   => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'direccion'       => ['required','min:10','max:150'],
            'telefonot'  => ['required','numeric','regex:/^[(2)(3)(8)(9)][0-9]/','unique:clientes,telefono,'.$id.'id'],
            
        ],[
            'nombreConstructora.required' => 'El nombre no puede ir vacío.',
            'nombreConstructora.alpha' => 'En el nombre sólo se permite letras.',
            'nombreConstructora.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'direccion.required' => 'Se necesita saber la dirección, no puede ir vacío.',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',

            'telefonot.required' => 'El teléfono no puede ir vacío.',
            'telefonot.numeric' => 'El teléfono debe contener sólo números.',
            'telefonot.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefonot.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefonot.unique' => 'El número de teléfono ya está en uso.',

            
        
        ]);

        $constructora = Constructora::findOrFail($id);

        $constructora->nombreConstructora = $request->input('nombreConstructora');
        $constructora->direccion = $request->input('direccion');
        $constructora->telefono = $request->input('telefono');
        $constructora->email = $request->input('email');
        $constructora->fechaContrato = $request->input('fechaContrato');
       
        
        
        $update = $constructora->save();
        
        if ($update){
            return redirect()->route('venta.index')
            ->with('mensajeW', 'Se actualizó la constructora correctamente');
        } 
    }
}

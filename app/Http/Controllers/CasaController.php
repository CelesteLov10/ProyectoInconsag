<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Constructora;
use Illuminate\Http\Request;

class CasaController extends Controller
{
    public function index()
    {
    $casa = Casa::query()
    ->when(request('search'), function($query){
    return $query->where('claseCasa', 'LIKE', '%' .request('search') .'%');
    })->orWhereHas('constructora', function($q){
        $q->where('nombreConstructora','LIKE', '%' .request('search') .'%');
    })->orderBy('id','desc')->paginate(10)->withQueryString();
    $constructora = Constructora::all();
    return view('casa.index', compact('casa', 'constructora'));
    }

    public function create()
    {
        $casa = Casa::all();
        $constructora = Constructora::all();
        return view('casa.create', compact('constructora'))->with('casa', $casa);
    }

    public function store(Request $request)
    {
            $this->validate($request,[
                'claseCasa' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ][a-záéíóúñ]+\s{0,1})+$/u'],
                'valorCasa' => ['required','min:1', 'numeric'],
                'cantHabitacion' => ['required','numeric','max:5','regex:/^[0-9]{1,5}/u'],
                'descripcion' => ['required', 'min:10','max:150'],
                'constructora_id' => ['required'],
                //'fechaContrato' =>'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            ],[

            'claseCasa.required' => 'El nombre del modelo no puede ir vacío.',
            'claseCasa.regex' => 'El nombre debe iniciar con mayúscula y solo permite un espacio entre ellos.',

            'valorCasa.required' => 'El valor de la casa no puede ir vacío.',
            'valorCasa.numeric' => 'El valor de la casa debe contener sólo números.',

            'cantHabitacion.required' => 'La cantidad de habitaciones no puede ir vacío.',
            'cantHabitacion.numeric' => 'El valor de la casa debe contener sólo números.',
            'cantHabitacion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'cantHabitacion.max' => 'La cantidad de habitaciones no debe de exceder de 5.',

            'descripcion.required' => 'La descripción no puede ir vacío.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'email.required' => 'Debe ingresar el correo electrónico.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            
            'fechaContrato.required' => 'Debe seleccionar la fecha de adquisición, no puede estar vacío.',
            ]);
            $input = $request->all();
            $casa = new Casa();
            if($request->hasFile('subirCasa') ){
                $file = $request->file('subirCasa');
                $destinationPath = 'public/imagenes/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('subirCasa')->move($destinationPath, $filename);
                $casa->subirCasa = $destinationPath . $filename;
            };
            
            Casa::create($input);
                return redirect()->route('casa.index')
                ->with('mensaje', 'Se guardó el registro de la nueva casa modelo correctamente');         
         /** redireciona una vez enviado  */
    }

}

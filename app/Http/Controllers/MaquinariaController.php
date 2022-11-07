<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class MaquinariaController extends Controller
{
    //

    public function index(){
        //Campo busqueda
       $maquinarias = Maquinaria::query()
            ->when(request('search'), function($query){
            return $query->where('nombreMaquinaria', 'LIKE', '%' .request('search') .'%')
            //Aqui es la tabla relacionada y abajo el nombre del campo que desea.
            ->orWhereHas('proveedor', function($q){
                $q->where('nombreProveedor','LIKE', '%' .request('search') .'%');
            })
            ->orWhereHas('proveedor', function($q){
                $q->where('nombreContacto','LIKE', '%' .request('search') .'%');
            });
            })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        $proveedor = Proveedor::all();
        
        return view('maquinaria.index', compact('maquinarias', 'proveedor'));

    }
    public function show($id){
        $maquinaria = Maquinaria::findOrFail($id);
        return view('maquinaria.show')->with('maquinaria', $maquinaria);

        //DB::table('notificaciones')->select(...)->whereNotIn('id',DB::table('Noti_leidas')->select('id_notificacion')->get())->get();
    }

    
    public function create(){   
        $proveedor = Proveedor::orderBy('nombreProveedor')->get();
        return view('maquinaria.create',compact('proveedor'));
    }

    public function store(Request $request){
    

        $this->validate($request,[
            'nombreMaquinaria'   => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]{1}[a-záéíóúñ]+\s{0,1}([0-9]{0,15}?))+$/u'],
            'modelo' => ['required'],
            'placa'  => ['required','between: 6, 7', 'unique:maquinarias'],
            'cantidadMaquinaria' =>['required', 'numeric', 'min:1'],
            'descripcion'       => ['required','regex:/^.{10,150}$/u'],
            'fechaAdquisicion'    => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'proveedor_id'       => ['required'],
            'cantidadHoraAlquilada' => ['numeric', 'min:1'], 
            'valorHora' => ['numeric', 'regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/', 'min:1'], 
            'totalPagar' => ['numeric', 'regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/'], 
/*/[A-Z]{1}[0-9][0-9A-Z][0-9]/ */
            
        ],[
            
            'nombreMaquinaria.required' => 'El nombre de la maquinaria es requerido, no puede estar vacío.',
            'nombreMaquinaria.regex' => 'En el nombre de la maquinaria solo permite un espacio entre los nombres.',

            'modelo.required' => 'El modelo de la maquinaria es requerido.',

            'placa.required' => 'El formato de la placa de maquinaria es requerido.',
            'placa.between' => 'El formato de la placa debe contener mínimo 6 y máximo 7 caracteres.',
           // 'placa.max' => 'El formato de la placa debe contener máximo 7 caracteres.', 
            'placa.regex' => 'El formato de la placa debe ser con 3 letras mayúsculas y 4 números.',
            'placa.unique' => 'El formato de la placa debe ser único.',

             
            'cantidadMaquinaria.required' => 'Debe ingresar la cantidad de maquinaria', 
            'cantidadMaquinaria.numeric' => 'Solo se permiten números.',
            'cantidadMaquinaria.min' => 'La cantidad mínima de maquinaria a ingresar es 1. ',


            'descripcion.required' => 'Se necesita saber la descripción, no puede estar vacío.',
            'descripcion.regex' => 'La descripción permite mínimo 10 y máximo 150 palabras.',

            'fechaAdquisicion.required' => 'Debe seleccionar la fecha de adquisición , no puede estar vacío.',

            'proveedor_id.required' => 'Debe seleccionar el puesto de trabajo, no puede estar vacío.',

            'cantidadHoraAlquilada.numeric' => 'Solo se permite números; para separar la hora de los minutos debe usar "."',
            'cantidadHoraAlquilada.min' => 'La cantidad de hora alquilada para maquinaria mínimo es 1. ',

            'valorHora.numeric' => 'Solo se permite números.',
            'valorHora.regex' => 'El precio del alquiler de la maquinaria debe contener 1 o 2 cifras despues del punto (opcional).',
            'valorHora.min' => 'El valor mínimo por hora alquilada es 1. ',

            'totalPagar.numeric' => 'Solo se permite números', 
            'totalPagar.regrex' => 'El total del alquiler de la maquinaria debe contener 1 o 2 cifras despues del punto (opcional).',
            

        ]);
        $input = $request->all();
        
        Maquinaria::create($input);
            return redirect()->route('maquinaria.index')
            ->with('mensaje', 'Se guardó el registro de una nueva maquinaria correctamente');

    }

    public function edit($id){
        $maquinaria = Maquinaria::findOrFail($id);
        $proveedor = Proveedor::orderBy('nombreProveedor')->get();
        return view('maquinaria.edit', compact('maquinaria', 'proveedor'))
        ->with('maquinaria', $maquinaria);
    }

    public function update(Request $request, $id){

        $this->validate($request,[

            'nombreMaquinaria' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u'],
            'modelo'           => ['required'],
            'placa'            => ['required', 'between: 6, 7','unique:maquinarias,placa,'.$id.'id'],
            'cantidadMaquinaria' =>['required', 'numeric', 'min:1'],
            'descripcion'       => ['required','regex:/^.{10,150}$/u'],
            'fechaAdquisicion'  => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'proveedor_id'      => ['required'],
            'cantidadHoraAlquilada' => ['numeric'], 
            'valorHora' => ['numeric', 'regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/'], 
            'totalPagar' => ['numeric', 'regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/'], 

        ],[

            
            'nombreMaquinaria.required' => 'El nombre de la maquinaria es requerido, no puede estar vacío.',
            'nombreMaquinaria.regex' => 'En el nombre de la maquinaria solo permite un espacio entre los nombres.',

            'modelo.required' => 'El modelo de la maquinaria es requerido.',

            'placa.required' => 'El formato de la maquinaria es requerido.',
            'placa.between' => 'El formato de la placa debe contener mínimo 6 y máximo 7 caracteres.',
           'placa.regex' => 'El formato de la placa debe ser con 3 letras mayúsculas y 4 números.',
           'placa.unique' => 'El formato de la placa debe ser único.',

            'cantidadMaquinaria.required' => 'Debe ingresar la cantidad de maquinaria', 
            'cantidadMaquinaria.numeric' => 'Solo se permiten números.',
            'cantidadMaquinaria.min' => 'La cantidad mínima de maquinaria a ingresar es 1. ',

            'descripcion.required' => 'Se necesita saber la descripción, no puede estar vacío.',
            'descripcion.regex' => 'La descripción permite mínimo 10 y máximo 150 palabras.',

            'fechaAdquisicion.required' => 'Debe seleccionar la fecha de adquisición , no puede estar vacío.',

            'proveedor_id.required' => 'Debe seleccionar el puesto de trabajo, no puede estar vacío.',

            'cantidadHoraAlquilada.numeric' => 'Solo se permite números, y para separar la hora de los minutos debe usar ".".', 

            'valorHora.numeric' => 'Solo se permite números.',
            'valorHora.regex' => 'El precio del alquiler de la maquinaria debe contener 1 o 2 cifras despues del punto (opcional).',

            'totalPagar.numeric' => 'Solo se permite números', 
            'totalPagar.regrex' => 'El total del alquiler de la maquinaria debe contener 1 o 2 cifras despues del punto (opcional).',
    
        ]);

        $maquinaria = Maquinaria::findOrFail($id);

        $maquinaria->nombreMaquinaria = $request->input('nombreMaquinaria');
        $maquinaria->modelo = $request->input('modelo');
        $maquinaria->placa = $request->input('placa');
        $maquinaria->cantidadMaquinaria = $request->input('cantidadMaquinaria');
        $maquinaria->descripcion = $request->input('descripcion');
        $maquinaria->fechaAdquisicion = $request->input('fechaAdquisicion');
        $maquinaria->proveedor_id = $request->proveedor_id;
        
        $update = $maquinaria->save();
        
        if ($update){
            return redirect()->route('maquinaria.index')
            ->with('mensajeW', 'Se actualizó el registro de la maquinaria correctamente');
        } 
    }

}
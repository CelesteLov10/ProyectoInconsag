<?php

namespace App\Http\Controllers;

use App\Models\Maquinaria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

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

    // Metodo para mostrar pdf
    public function pdf (){

        $maquinarias = Maquinaria::all();
        
        $proveedor = Proveedor::all();

        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
        $pdf = PDF::loadView('maquinaria.pdf', compact('maquinarias', 'proveedor'));
        return $pdf -> stream();
        
    }

    public function show($id){
        $maquinaria = Maquinaria::findOrFail($id);
        return view('maquinaria.show')->with('maquinaria', $maquinaria);

        //DB::table('notificaciones')->select(...)->whereNotIn('id',DB::table('Noti_leidas')->select('id_notificacion')->get())->get();
        //select fecha from perfiles_evento where perfiles_evento.fecha IS NULL;
    }


    
    public function create(){   
        $proveedor = Proveedor::orderBy('nombreProveedor')->get();
        return view('maquinaria.create',compact('proveedor'));
    }

    public function store(Request $request){
    
        $reglas = [
            'nombreMaquinaria'   => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/',
            'modelo' => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9-.]+\s{0,1})+$/',
            'placa'  => 'nullable|min:7|regex:/^[A-Za-z0-9]+$/u', // regex: /^[A-Z]{2,3}[0-9]{4}+$/u
            'descripcion'       => 'required|min:10|max:150',
            'fechaAdquisicion'    =>'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            'proveedor_id'       => 'required',
            'cantidadHoraAlquilada' => 'nullable|numeric|min:1|nullable|regex:/^[0-9]{1,3}+$/U', 
            'valorHora' => 'numeric|regex:/^[0-9]{1,4}+$/|min:1|nullable', 
            //'cantidadAlquilada' => 'nullable|min:1|numeric|regex:/^[0-9]{1,4}+$/',
            'totalPagar' => 'nullable',
            
        ]; $mensaje = [
            
            'nombreMaquinaria.required' => 'El nombre de la maquinaria es requerido, no puede estar vacío.',
            'nombreMaquinaria.regex' => 'En el nombre de la maquinaria solo se permite un espacio entre los nombres y no permite caracteres especiales.',

            'modelo.required' => 'El modelo de la maquinaria es requerido, no puede estar vacío.',
            'modelo.regex' => 'En el modelo solo se permite un espacio entre cada palabra.',


            'placa.required' => 'El formato de la placa de maquinaria es requerido , no puede estar vacío.',
            'placa.min' => 'El formato de la placa debe contener mínimo 7 caracteres.',
            //'placa.max' => 'El formato de la placa debe contener máximo 7 caracteres.', 
            'placa.regex' => 'Formato de placa incorrecto. Ejem. "AAA0000"',            
            'placa.unique' => 'El número de placa ya esta en uso.',

             
            /*'cantidadMaquinaria.required' => 'Debe ingresar la cantidad de maquinaria', 
            'cantidadMaquinaria.numeric' => 'Solo se permiten números.',
            'cantidadMaquinaria.min' => 'La cantidad mínima de maquinaria a ingresar es 1. ',*/


            'descripcion.required' => 'Se necesita saber la descripción, no puede estar vacío.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'fechaAdquisicion.required' => 'Debe seleccionar la fecha de adquisición, no puede estar vacío.',

            'proveedor_id.required' => 'Debe seleccionar el nombre del proveedor, no puede estar vacío.',

            'cantidadHoraAlquilada.numeric' => 'Solo se permite números enteros. Ejem. "123"',
            'cantidadHoraAlquilada.regex' => 'El valor es incorrecto. Ejem. "123"',
            'cantidadHoraAlquilada.min' => 'La cantidad de hora alquilada mínima es "1". ',

            'valorHora.numeric' => 'Solo se permite ingresar números.',
            'valorHora.regex' => 'El valor por hora solo permite numeros enteros. Ejem. "1850"',
            'valorHora.min' => 'El valor por hora alquilada mínimo es "1". ',

            'totalPagar.numeric' => 'Solo se permite ingresar números', 
            'totalPagar.regex' => 'El total ha pagar debe ser un valor entero. Ejem. "12450"',
            

        ];
        $this->validate($request, $reglas, $mensaje);
        
        Maquinaria::create([
            'nombreMaquinaria'=>$request['nombreMaquinaria'],
            'modelo'=>$request['modelo'],
            'placa'=>$request['placa'],
            'descripcion'=>$request['descripcion'],
            'fechaAdquisicion' =>$request[ 'fechaAdquisicion' ],
            'proveedor_id'=>$request['proveedor_id'], 
            'maquinaria' =>$request['maquinaria'],
            'cantidadHoraAlquilada'=>$request['cantidadHoraAlquilada'], 
            'valorHora'=>$request['valorHora'], 
            'totalPagar'=>$request['totalPagar'], 

            
        ]);
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

            'nombreMaquinaria' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/'],
            'modelo' => ['required', 'regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9-.]+\s{0,1})+$/'],
            'placa'  => ['nullable','min:7','regex:/^[A-Za-z0-9]+$/u'],
            //'cantidad' => 'required|min:1|numeric|regex:/^[0-9]{1,4}+$/',
            'descripcion'       => ['required','min:10','max:150'],
            'fechaAdquisicion'  => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'proveedor_id'      => ['required'],
            'cantidadHoraAlquilada' => ['numeric', 'nullable','min:1','regex:/^[0-9]{1,3}+$/U'], 
            'valorHora' => ['numeric', 'min:1', 'regex:/^[0-9]{1,4}+$/', 'nullable'],
            //'cantidadAlquilada' => 'nullable|min:1|numeric|regex:/^[0-9]{1,4}+$/', 
            'totalPagar' => ['nullable'], 

        ],[

            
            'nombreMaquinaria.required' => 'El nombre de la maquinaria es requerido, no puede estar vacío.',
            'nombreMaquinaria.regex' => 'En el nombre de la maquinaria solo se permite un espacio entre los nombres y no permite caracteres especiales.',

            'modelo.required' => 'El modelo de la maquinaria es requerido, no puede estar vacío.',
            'modelo.regex' => 'En el modelo solo se permite un espacio entre cada palabra.',


            'placa.required' => 'El formato de la maquinaria es requerido, no puede estar vacío .',
            'placa.min' => 'El formato de la placa debe contener mínimo 7 caracteres.',
            'placa.regex' => 'Formato de placa incorrecto. Ejem. "AAA0000"',
            'placa.unique' => 'El número de placa ya esta en uso.',

            /*'cantidadMaquinaria.required' => 'Debe ingresar la cantidad de maquinaria', 
            'cantidadMaquinaria.numeric' => 'Solo se permiten números.',
            'cantidadMaquinaria.min' => 'La cantidad mínima de maquinaria a ingresar es 1. ',*/

            'descripcion.required' => 'Se necesita saber la descripción, no puede estar vacío.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'fechaAdquisicion.required' => 'Debe seleccionar la fecha de adquisición , no puede estar vacío.',

            'proveedor_id.required' => 'Debe seleccionar el nombre del proveedor, no puede estar vacío.',

            'cantidadHoraAlquilada.numeric' => 'Solo se permite números enteros. Ejem. "12"',
            'cantidadHoraAlquilada.regex' => 'El valor es incorrecto. Ejem. "12"',
            'cantidadHoraAlquilada.min' => 'La cantidad de hora alquilada mínima es "1". ',

            'valorHora.numeric' => 'Solo se permite ingresar números.',
            'valorHora.regex' => 'El valor por hora solo permite numeros enteros. Ejem. "1850"',
            'valorHora.min' => 'El valor por hora alquilada mínimo es "1". ',

            'totalPagar.numeric' => 'Solo se permite ingresar números', 
            'totalPagar.regex' => 'El total ha pagar debe ser un valor entero. Ejem. "12450"',
    
        ]);

        $maquinaria = Maquinaria::findOrFail($id);

        $maquinaria->nombreMaquinaria = $request->input('nombreMaquinaria');
        $maquinaria->modelo = $request->input('modelo');
        $maquinaria->placa = $request->input('placa');
        $maquinaria->descripcion = $request->input('descripcion');
        $maquinaria->fechaAdquisicion = $request->input('fechaAdquisicion');
        $maquinaria->proveedor_id = $request->proveedor_id;
        $maquinaria->maquinaria = $request->maquinaria;
        $maquinaria->cantidadHoraAlquilada = $request->input('cantidadHoraAlquilada');
        $maquinaria->valorHora = $request->input('valorHora');
        $maquinaria->totalPagar = $request->input('totalPagar');

        
        $update = $maquinaria->save();
        
        if ($update){
            return redirect()->route('maquinaria.index')
            ->with('mensajeW', 'Se actualizó el registro de la maquinaria correctamente');
        } 
    }

}
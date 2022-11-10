<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Unique;

class ProveedorController extends Controller
{

    public function index(){
            //Campo busqueda
            $proveedor = Proveedor::query()
                ->when(request('search'), function($query){
                return $query->where('nombreProveedor', 'LIKE', '%' .request('search') .'%')
                ->orWhere('nombreContacto', 'LIKE', '%' .request('search') .'%')
                ->orWhereHas('categoria', function($q){
                    $q->where('nombreCat','LIKE', '%' .request('search') .'%');
            });
            })->orderBy('id','desc')->paginate(10)->withQueryString();

            $categoria = Categoria::all();
            return view('proveedor.index', compact('proveedor','categoria'));
        
        //
    }

    public function create(){   
        $categoria = Categoria::orderBy('nombreCat')->get();
        return view('proveedor.create', compact('categoria'));
    }

    public function store(Request $request){
        $reglas = [

            'nombreProveedor' => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]{1}[a-záéíóúñ]+\s{0,1}([0-9]{0,15}?))+$/u|unique:proveedores',
            'nombreContacto' => 'required|regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u',
            'cargoContacto' => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u',
            'direccion' => 'required|min:10|max:150',
            'telefono'  => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/|unique:proveedores',
            'email'    => 'required|email|regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#|unique:proveedores',
            'categoria_id' => 'required',
    
        ];
        $mensaje =[
            'nombreProveedor.required' => 'El nombre del proveedor es requerido, no puede estar vacío. ',
            'nombreProveedor.regex' => 'El nombre del proveedor solo permite un espacio entre los nombres
             y no se admiten números o caracteres especiales.',
            'nombreProveedor.unique' => 'El nombre del proveedor ya está en uso.',

            'nombreContacto.required' => 'El nombre del contacto es requerido, no puede estar vacío. ',
            'nombreContacto.regex' => 'Debe iniciar con mayúscula cada palabra, solo permite un espacio entre los nombres y no se admiten números.',

            'cargoContacto.required' => 'El cargo del contacto es requerido, no puede estar vacío. ',
            'cargoContacto.regex' => 'El cargo del contacto solo permite un espacio entre los nombres y no permite números.',

            'direccion' => 'La direccion es requerido, no puede estar vacío. ',
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

            'categoria_id.required' => 'Debe seleccionar una categoría',

        ];
            $this->validate($request, $reglas, $mensaje);

            Proveedor::create([
                'nombreProveedor'=>$request['nombreProveedor'],
                'nombreContacto'=>$request['nombreContacto'],
                'cargoContacto'=>$request['cargoContacto'],
                'direccion'=>$request['direccion'],
                'telefono'=>$request['telefono'],
                'email' =>$request[ 'email' ],
                'categoria_id'=>$request['categoria_id'], 
            ]);
            
            return redirect()->route('proveedor.index')
            ->with('mensaje', 'Se guardó un nuevo registro de proveedor correctamente');
    }

    public function show($id){
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedor.show')->with('proveedor', $proveedor);
    }

    public function edit($id){
        $proveedor = Proveedor::findOrFail($id);
        $categoria = Categoria::with(['proveedor.categoria'])->get();
        return view('proveedor.edit', compact('proveedor','categoria'))
        ->with('proveedor', $proveedor);
    }

    public function update(Request $request, $id){
        
        $this->validate($request,[
            
            'nombreProveedor' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]{1}[a-záéíóúñ]+\s{0,1}([0-9]{0,15}?))+$/u','unique:proveedores,nombreProveedor,'.$id.'id'],
            'nombreContacto' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u'],
            'cargoContacto' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u'],
            'direccion' => ['required','min:10','max:150'],
            'telefono' => ['required','numeric','digits:8','regex:/^[(2)(3)(8)(9)][0-9]/','unique:proveedores,telefono,'.$id.'id'],
            'email'  => ['required','email','regex:#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,8}$#','unique:proveedores,email,'.$id.'id'],
            'categoria_id' => ['required'],
        ],[
            'nombreProveedor.required' => 'El nombre del proveedor es requerido, no puede estar vacío. ',
            'nombreProveedor.regex' => 'El nombre del proveedor solo permite un espacio 
            entre los nombres y no se admiten números o caracteres especiales.',
            'nombreProveedor.unique' => 'El nombre del proveedor ya está en uso.',

            'nombreContacto.required' => 'El nombre del contacto es requerido, no puede estar vacío. ',
            'nombreContacto.regex' => 'Debe iniciar con mayúscula cada palabra, solo permite un espacio entre los nombres y no se admiten números.',

            'cargoContacto.required' => 'El cargo del contacto es requerido, no puede estar vacío. ',
            'cargoContacto.regex' => 'El cargo del contacto solo permite un espacio entre los nombres y no permite números.',

            'direccion' => 'La direccion es requerido, no puede estar vacío. ',
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
            
            'categoria_id.required' => 'Debe seleccionar una categoría',

    
        ]);
        
        $proveedor = Proveedor::findOrFail($id);

        $proveedor->nombreProveedor = $request->input('nombreProveedor');
        $proveedor->nombreContacto = $request->input('nombreContacto');
        $proveedor->cargoContacto= $request->input('cargoContacto');
        $proveedor->direccion = $request->input('direccion');
        $proveedor->telefono = $request->input('telefono');
        $proveedor->email = $request->input('email');
        $proveedor->categoria_id = $request->input('categoria_id');;
        
        $update = $proveedor->save();
        
        if ($update){
            return redirect()->route('proveedor.index')
            ->with('mensajeW', 'Se actualizó el registro del proveedor correctamente');
        } 
    }

}

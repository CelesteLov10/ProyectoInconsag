<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    public function index(){
        //Campo busqueda
        $puestos = Puesto::query()
            ->when(request('search'), function($query){
            return $query->where('nombreCargo', 'LIKE', '%' .request('search') .'%');
            })->orderBy('id','desc')->paginate(10)->withQueryString(); 

        return view('puestoLaboral.index', compact('puestos'));
    }

    public function create(){
        return view('puestoLaboral.create');
    }

    public function store(Request $request){
        //validacion para cuando se agregue un puesto
        $this->validate($request, [
            'nombreCargo' => ['required','unique:puestos,nombreCargo','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u'],
            'sueldo'      => ['required','numeric','between: 7500.00, 20000.00'], // falta averiguar cual es el salario minimo y el maximo
            'descripcion' => ['required','min:10','max:150']
        ], [
            'nombreCargo.required'=> 'El nombre del cargo del puesto es requerido, no puede estar vacío.', 
            'nombreCargo.unique' => 'El nombre del puesto ingresado ya está en uso.', 
            'nombreCargo.regex' => 'El nombre del puesto no debe contener números y solo se permite un espacio entre palabras.' , 
            //'nombreCargo.regex' => 'El nombre del puesto no debe contener muchos espacios' , 

            'sueldo.required' => 'Debe ingresar el sueldo', 
            'sueldo.numeric' => 'El sueldo solo puede debe contener números.', 
            'sueldo.between' => 'El sueldo debe tener un rango de 7500 y 20000', 

            'descripcion' => 'La descripción del puesto es requerida.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

        ]);
        $input = $request->all();
        Puesto::create($input);

        /* $puesto->nombreCargo = $request->nombreCargo;
        $puesto->sueldo = $request->sueldo;
        $puesto->descripcion = $request->descripcion;
        
        $create = $puesto->save();
        
        if ($create){*/
            return redirect()->route('puestoLaboral.index')
            ->with('mensaje', 'Se guardó un nuevo puesto laboral correctamente');
        
        /** redireciona una vez enviado  */
    }

    public function show($id){
        //
    }
    
    // Metodo para que use la ruta de editar y lleve a la vista editar
    public function edit($id){
        $puesto = Puesto::findOrFail($id);
        return view('puestoLaboral.edit')->with('puesto', $puesto);
    }

    //Metodo para actualizar el registro
    public function update(Request $request, $id){ 
        //Validacion para la vista de actualizar un puesto
        $this->validate($request,[
            'nombreCargo' => ['required','unique:puestos,nombreCargo,'.$id.'id','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u'],
            'sueldo'      => ['required','numeric','between: 7500, 20000'], // falta averiguar cual es el salario minimo y el maximo
            'descripcion' => ['required','min:10','max:150'],
        ],[
            'nombreCargo.required'=> 'El nombre del cargo del puesto es requerido, no puede estar vacío.', 
            'nombreCargo.unique' => 'El nombre del puesto ingresado ya está en uso.', 
            'nombreCargo.regex' => 'El nombre del puesto no debe contener números y solo se permite un espacio entre palabras.' , 
            //'nombreCargo.regex' => 'El nombre del puesto no debe contener muchos espacios' , 

            'sueldo.required' => 'Debe ingresar el sueldo', 
            'sueldo.numeric' => 'El sueldo solo puede debe contener  números.', 
            'sueldo.between' => 'El sueldo debe tener un rango de 7500.00 y 20000.00', 

            'descripcion' => 'La descripción del puesto es requerida.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',
        ]);
        $puesto = Puesto::findOrFail($id);

        $puesto->nombreCargo = $request->input('nombreCargo');
        $puesto->sueldo = $request->input('sueldo');
        $puesto->descripcion = $request->descripcion;

        $update = $puesto->save();

        if ($update){
            return redirect()->route('puestoLaboral.index')
            ->with('mensajeW', 'Se actualizó el puesto laboral correctamente');
        }

    }
}

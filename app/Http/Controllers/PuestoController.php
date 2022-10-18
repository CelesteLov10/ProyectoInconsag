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
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            'nombreCargo' =>'required|unique:puestos|regex:/^[a-zA-Z\s]+$/u',
            'sueldo' => 'required|numeric|between:5000,20000',
            'descripcion' =>'required'
        ]);
        $puesto = new Puesto();

        $puesto->nombreCargo = $request->nombreCargo;
        $puesto->sueldo = $request->sueldo;
        $puesto->descripcion = $request->descripcion;
        
        $create = $puesto->save();
        
        if ($create){
            return redirect()->route('puestoLaboral.index')
            ->with('mensaje', 'Se guardó un nuevo puesto laboral correctamente');
        } 
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
    public function update(Request $request, $id, Puesto $puest){ 
        //Validacion para la vista de actualizar un puesto
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            //agregamos en elcampo  "unique:puestos,: el campo del nombreCargo y el id para que no haya problemas al momento de actualizar ya que son campos unicos
            'nombreCargo' =>'required|unique:puestos,nombreCargo,'.$id.'id|regex:/^[a-zA-Z\s]+$/u',
            'sueldo' => 'required|numeric',
            'descripcion' =>'required'
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

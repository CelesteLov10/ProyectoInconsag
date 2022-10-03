<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $puestos = Puesto::orderBy('id','desc')->paginate(10); 
        return view('puestoLaboral.index', compact('puestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('puestoLaboral.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //validacion para cuando se agregue un puesto
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            'nombreCargo' =>'required|unique:puestos|regex:/^[a-zA-Z\s]+$/u',
            'sueldo' => 'required|numeric',
            'descripcion' =>'required'
        ]);
        $puesto = new Puesto();

        $puesto->nombreCargo = $request->nombreCargo;
        $puesto->sueldo = $request->sueldo;
        $puesto->descripcion = $request->descripcion;
        
        $create = $puesto->save();
        
        if ($create){
            return redirect()->route('puestoLaboral.index')
            ->with('mensaje', 'Se guardó el puesto laboral correctamente');
        } 
        /** redireciona una vez enviado  */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Metodo para que use la ruta de editar y lleve a la vista editar
    public function edit($id)
    {
        //
        $puesto = Puesto::findOrFail($id);

        return view('puestoLaboral.edit')->with('puesto', $puesto);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //Metodo para actualizar el registro
    public function update(Request $request, $id)
    {
        //Validacion para la vista de actualizar un puesto
        $request->validate([
            // regex:/^[a-zA-Z\s]+$/u permite letras y espacios
            'nombreCargo' =>'required|unique:puestos|regex:/^[a-zA-Z\s]+$/u',
            'sueldo' => 'required|numeric',
            'descripcion' =>'required'
        ]);
        $puesto = Puesto::findOrFail($id);

        $puesto->nombreCargo = $request->nombreCargo;
        $puesto->sueldo = $request->sueldo;
        $puesto->descripcion = $request->descripcion;

        $create = $puesto->save();

        if ($create){
            return redirect()->route('puestoLaboral.index')
            ->with('mensajeW', 'Se actualizó el puesto laboral correctamente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

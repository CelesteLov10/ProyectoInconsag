<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empleado.createEmp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $empleado = new Empleado();

        $empleado->identidad = $request->identidad;
        $empleado->nombres = $request->nombres;
        $empleado->apellidos = $request->apellidos;
        $empleado->telefono = $request->telefono;
        $empleado->correo = $request->correo;
        $empleado->fechaNacimiento = $request->fechaNacimiento;
        $empleado->direccion = $request->direccion;
        $empleado->fechaIngreso = $request->fechaIngreso;
        
        $create = $empleado->save();
        
        if ($create){
            return redirect()->route('empleado.create')
            ->with('mensaje', 'Se guardó el empleado correctamente');
        } 
        /** redireciona una vez enviado  */
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
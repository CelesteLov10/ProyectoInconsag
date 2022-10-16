<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Models\Oficina;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
         //Campo busqueda
        $inventarios = Inventario::query()
        ->when(request('search'), function($query){
        return $query->where('nombreInv', 'LIKE', '%' .request('search') .'%');
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        
        $empleado = Empleado::all();
        $oficina = Oficina::all();
        return view('inventario.index', compact('inventarios', 'empleado', 'oficina'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();
        return view('inventario.create',compact('empleado', 'oficina'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inventario = new Inventario();

        $inventario->nombreInv = $request->nombreInv;
        $inventario->descripcion = $request->descripcion;
        $inventario->fecha = $request->fecha;
        $inventario->empleado_id = $request->empleado_id;
        $inventario->oficina_id = $request->oficina_id;
        
        $create = $inventario->save();
        
        if ($create){
            return redirect()->route('inventario.index')
            ->with('mensaje', 'Se guardó un nuevo inventario correctamente');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventario = Inventario::findOrFail($id);
        $oficina = Oficina::findOrFail($id);
        return view('inventario.show')->with('inventario', $inventario, $oficina);
   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $inventario = Inventario::findOrFail($id);
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();

        // $puesto = DB::table('puestos')->orderBy('name', 'asc')->list('name');
          
  
          return view('empleado.editEmp', compact('inventario', 'empleado','oficina'))
          ->with('empleado', $empleado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $inventario = Inventario::findOrFail($id);
      

        $inventario->nombreInv = $request->input('nombreInv');
        $inventario->descripcion = $request->descripcion;
        $inventario->fecha = $request->fecha;
        $inventario->empleado_id = $request->empleado_id;
        $inventario->oficina_id = $request->oficina_id;
        
        $update = $inventario->save();
        
        if ($update){
            return redirect()->route('inventario.index')
            ->with('mensajeW', 'Se actualizó el inventario correctamente');
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

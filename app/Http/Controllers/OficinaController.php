<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $inventario = Inventario::orderBy('nombreInv')->get();
        return view('oficina.create',compact('inventario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $oficina = new Oficina();

        $oficina->nombreDepto = $request->nombreDepto;
        $oficina->direccion= $request->direccion;
        $oficina->cantidadInv = $request->cantidadInv;
        $oficina->inventario_id = $request->inventario_id;
        
        $create = $oficina->save();
        
        if ($create){
            return redirect()->route('oficina.create')
            ->with('mensaje', 'Se guardó nueva oficina correctamente');
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
        //
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

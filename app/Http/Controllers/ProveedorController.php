<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            //Campo busqueda
            $proveedor = Proveedor::query()
                ->when(request('search'), function($query){
                return $query->where('nombreProveedor', 'LIKE', '%' .request('search') .'%')
                ->orWhere('nombreContacto', 'LIKE', '%' .request('search') .'%')
                ->orWhere('categoria', 'LIKE', '%' .request('search') .'%');
            })->orderBy('id','desc')->paginate(10)->withQueryString();

            return view('proveedor.index', compact('proveedor'));
        
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        Proveedor::create([
            'nombreProveedor'=>$request['nombreProveedor'],
            'nombreContacto'=>$request['nombreContacto'],
            'cargoContacto'=>$request['cargoContacto'],
            'direccion'=>$request['direccion'],
            'telefono' =>$request['telefono' ],
            'email'=>$request['email'], 
            
        ]);
        $input = $request->all();
        Proveedor::create($input);
            return redirect()->route('proveedor.index')
            ->with('mensaje', 'Se guardó un nuevo registro de proveedor correctamente');
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

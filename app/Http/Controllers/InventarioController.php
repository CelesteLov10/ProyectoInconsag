<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Models\Oficina;

class InventarioController extends Controller
{
    public function index(){
        //Campo busqueda
        $inventarios = Inventario::query()
            ->when(request('search'), function($query){
            return $query->where('nombreInv', 'LIKE', '%' .request('search') .'%')
            //Aqui es la tabla relacionada y abajo el nombre del campo que desea.
            ->orWhereHas('oficina', function($q){
                $q->where('nombreOficina','LIKE', '%' .request('search') .'%');
            })
            ->orWhereHas('empleado', function($q){
                $q->where('nombres','LIKE', '%' .request('search') .'%');
            });
            })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        
        $empleado = Empleado::all();
        $oficina = Oficina::all();
        return view('inventario.index', compact('inventarios', 'empleado', 'oficina'));
    }

    public function create(){   
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();
        return view('inventario.create',compact('empleado', 'oficina'));
    }

    public function store(Request $request){
        $inventario = new Inventario();

        $inventario->nombreInv = $request->nombreInv;
        $inventario->cantidad = $request->cantidad;
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

    public function show($id){
        $inventario = Inventario::findOrFail($id);
        //$oficina = Oficina::findOrFail($id); no se para que funciona , $oficina
        return view('inventario.show')->with('inventario', $inventario);
    }

    public function edit($id){
        $inventario = Inventario::findOrFail($id);
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();

        return view('inventario.edit', compact('inventario', 'empleado','oficina'))
        ->with('inventario', $inventario);
    }

    public function update(Request $request, $id){
        $inventario = Inventario::findOrFail($id);

        $inventario->nombreInv = $request->input('nombreInv');
        $inventario->cantidad = $request->cantidad;
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
}

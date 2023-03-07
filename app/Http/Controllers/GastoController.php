<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Gasto;
use Illuminate\Http\Request;

class GastoController extends Controller
{
    //
    public function index(){

        $gasto = Gasto::query()
        ->when(request('search'), function($query){
        return $query->where('nombreGastos', 'LIKE', '%' .request('search') .'%')
        ->orWhere('nombreEmpresa', 'LIKE', '%' .request('search') .'%')
        ->orWhere('fechaGastos', 'LIKE', '%' .request('search') .'%')
        //para que realice busquedas por el nombre del empleado
        ->orWhereHas('empleado', function($q){
            $q->where('nombres','LIKE', '%' .request('search') .'%');
        });
        })->orderBy('id','desc')->paginate(10)->withQueryString();
    
        return view('gasto.index', compact('gasto'));
        }
    
        public function create(){
            $gasto = Gasto::all();
            $empleado = Empleado::all();
        return view('gasto.create', compact('gasto', 'empleado'));
        }
    
        public function store(Request $request){
            $reglas = [
                'nombreGastos'   => 'required',
                'montoGastos' => 'required', 
                'nombreEmpresa' => 'required', 
                'fechaGastos' => 'required', 
                'descripcion' => 'required', 
                'empleado_id' => 'required', 
                'baucherRecibo'    => 'required',
            ];
            $mensaje =[
                'nombreGastos.required' => 'El nombre del bloque es requerido, no puede estar vacío. ',
               
    
                'baucherRecibo.required' => 'Debe seleccionar una imagen. ',
    
            ];
            $this->validate($request, $reglas, $mensaje);
    
            $gasto = new Gasto();
            if($request->hasFile('baucherRecibo') ){
                $file = $request->file('baucherRecibo');
                $destinationPath = 'public/imagenesGastos/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $request->file('baucherRecibo')->move($destinationPath, $filename);
                $gasto->baucherRecibo = $destinationPath . $filename;
            };
            $gasto->nombreGastos = $request->nombreGastos;
            $gasto->montoGastos = $request->montoGastos;
            $gasto->nombreEmpresa = $request->nombreEmpresa;
            $gasto->fechaGastos = $request->fechaGastos;
            $gasto->descripcion = $request->descripcion;
            $gasto->empleado_id = $request->empleado_id;
            $gasto->baucherRecibo = $request->baucherRecibo;
    
            $create = $gasto->save();
    
            if ($create){
                return redirect()->route('gasto.index')
                ->with('mensaje', 'Se guardó el registro del nuevo gasto correctamente');
            }
        }
        public function show($id){
            /*  $bloque = Bloque::findOrFail($id);
              $pago = Pago::all();
              $venta = Venta::all();
              $lotes = Lote::query()
          ->when(request('search'), function($query){
          return $query->where('nombreLote', 'LIKE', '%' .request('search') .'%');
          })->orderBy('id','desc')->paginate(10000000)->withQueryString();
              return view('bloque.show', compact('lotes'))->with('bloque', $bloque);*/
          }
    
}

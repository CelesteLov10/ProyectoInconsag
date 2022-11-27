<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Venta;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(){
        //Campo busqueda
        $ventas = Venta::query()
            ->when(request('search'), function($query){
            return $query->where('nombreCliente', 'LIKE', '%' .request('search') .'%')
            ->orWhere('formaVenta', 'LIKE', '%' .request('search') .'%')
            ->orWhere('fechaVenta', 'LIKE', '%' .request('search') .'%');
            })->orderBy('id','desc')->paginate(10)->withQueryString(); 

        return view('venta.index', compact('ventas'));
    }

    public function create(){ 

        $ventas = Venta::all();
        $cliente = Cliente::all();
        $bloques = Bloque::all();
        $lotes = Lote::all();
        return view('venta.create', compact('venta','cliente','bloques','lotes'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'cliente_id'       => ['required'],
            'bloque_id'       => ['required'],
            'lote_id'       => ['required'],
            'fechaVenta' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',],
            'valorTerreno' => ['numeric', 'min:1', 'regex:/^[0-9]{1,8}+$/'],
            'valorPrima' => ['numeric', 'min:1', 'regex:/^[0-9]{1,6}+$/', 'nullable'],
            'cantidadCuotas' => ['numeric', 'min:1', 'regex:/^[0-9]{1,5}+$/', 'nullable'],
            'valorCuotas' => ['numeric', 'min:1', 'regex:/^[0-9]{1,5}+$/', 'nullable'],
            'valorRestantePagar' => ['numeric', 'min:1', 'nullable'],

        ],[
            'cliente_id.required'=>'Debe seleccionar un cliente, no puede estar vacío.',
            'bloque_id.required'=>'Debe seleccionar un bloque, no puede estar vacío.',
            'lote_id.required'=>'Debe seleccionar un lote, no puede estar vacío.',

            'valorTerreno.numeric' => 'Solo se permite números enteros. Ejem. "12345678"',
            'valorTerreno.regex' => 'El valor es incorrecto. Ejem. "123"',
            'valorTerreno.min' => 'La cantidad de hora alquilada mínima es "1". ',

            'valorPrima.numeric' => 'Solo se permite números enteros. Ejem. "123456"',

            'cantidadCuotas.numeric' => 'Solo se permite números enteros. Ejem. "12345"',

            'valorCuotas.numeric' => 'Solo se permite números enteros. Ejem. "12345"',

            'valorRestantePaga.numeric' => 'Solo se permite números enteros. Ejem. "12345678"',

            'fechaVenta.required' => 'La fecha de venta no puede ir vacío.',
            'fechaVenta.regex' => 'Debe ser mayor de edad.',

        ]);
        $input = $request->all();
        
        Venta::create($input);
            return redirect()->route('venta.create')
            ->with('mensaje', 'Se guardó una nueva venta correctamente');
        
        /** redireciona una vez enviado  */
    }

    public function getLotes($id){
        $lotes = Lote::where('bloque_id', '=', $id)->get();
        return response()->json($lotes);
    }

    public function getLotess($id){
        $lotes = Lote::where('bloque_id', '=', $id)->get();
        return $lotes;
    }
}

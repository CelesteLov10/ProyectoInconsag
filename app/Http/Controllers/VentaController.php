<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Venta;
use Illuminate\Http\Request;
Barryvdh\DomPDF\ServiceProvider::class;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class VentaController extends Controller
{
    public function index(){
        //Campo busqueda
        $ventas = Venta::query()
            ->when(request('search'), function($query){
            return $query->where('formaVenta', 'LIKE', '%' .request('search') .'%')
            ->orWhere('fechaVenta', 'LIKE', '%' .request('search') .'%')
            ->orWhereHas('cliente', function($q){
                $q->where('nombreCompleto','LIKE', '%' .request('search') .'%');
        });
        })->orderBy('id','desc')->paginate(10)->withQueryString();

        $cliente = Cliente::all();
        return view('venta.index', compact('ventas','cliente'));
    
    //
}


    public function show($id){
        $bloques = Bloque::all();
        $lotes = Lote::all();
        $venta = Venta::findOrFail($id);
        $beneficiario = Beneficiario::all();
        $cliente = Cliente::all();
        return view('venta.show', compact('bloques', 'lotes','beneficiario','cliente'))->with('venta', $venta);
    }

    public function create(){ 

        $venta = Venta::all();
        $cliente = Cliente::all();
        $bloques = Bloque::all();
        $lotes = Lote::all();
        $beneficiarios = Beneficiario::all();
        return view('venta.create', compact('venta','cliente','bloques','lotes','beneficiarios'));
    }

    public function store(Request $request){

        $this->validate($request,[
            'cliente_id'       => ['required'],
            'bloque_id'       => ['required'],
            'lote_id'       => ['required'],
            'fechaVenta' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',],
            'diaPago' => ['numeric', 'min:1','max:31' ,'regex:/^[0-9]{1,2}+$/', 'nullable'],
            'valorPrima' => ['numeric', 'min:1', 'regex:/^[0-9]{1,6}+$/', 'nullable'],
            'cantidadCuotas' => ['numeric', 'min:1','regex:/^[0-9]{1,4}+$/', 'nullable'],
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

            'diaPago.numeric' => 'Solo se permite números enteros. Ejem. "1 o 31"',
            'diaPago.min' => 'El dia de pago mínimo es "1". ',

            'cantidadCuotas.numeric' => 'Solo se permite números enteros. Ejem. "12345"',

            'valorCuotas.numeric' => 'Solo se permite números enteros. Ejem. "12345"',

            'valorRestantePaga.numeric' => 'Solo se permite números enteros. Ejem. "12345678"',

            'fechaVenta.required' => 'La fecha de venta no puede ir vacío.',
            'fechaVenta.regex' => 'Debe ser mayor de edad.',

        ]);
        $input = $request->all();
        
        Venta::create($input);
            return redirect()->route('venta.index')
            ->with('mensaje', 'Se guardó una nueva venta correctamente');
        
        /** redireciona una vez enviado  */
    }
    
    public function contrato($id){
        $bloques = Bloque::all();
        $lotes = Lote::all();
        $venta = Venta::findOrFail($id);
        $pdf = PDF::loadView('venta.pdfContrato', compact('bloques','lotes','venta'));
        return $pdf -> stream();
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

<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Bloque;
use App\Models\Casa;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Pago;
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
}

    public function show($id){
        $bloques = Bloque::all();
        $lotes = Lote::where('status', 'vendido');
        $venta = Venta::findOrFail($id);
        $beneficiario = Beneficiario::all();
        $cliente = Cliente::all();
        $casa = Casa::all();

        return view('venta.show', compact('bloques', 'lotes', 'beneficiario','cliente', 'casa', 'venta'));
    }

    public function create(){ 

        $casa = Casa::all();
        $venta = Venta::all();
        $cliente = Cliente::get();
        $bloques = Bloque::all();
        $lotes = Lote::all();
        $beneficiarios = Beneficiario::all();

        return view('venta.create',compact('venta','cliente','bloques','lotes','beneficiarios', 'casa'))->with('venta', $venta);
    }

    public function store(Request $request){

        $this->validate($request,[
            'cliente_id'       => ['required'],
            'bloque_id'       => ['required'],
            'lote_id'       => ['required'],
            'beneficiario_id'       => ['required'],
            'valorTerreno'       => ['required'],

            'casa_id'       => ['nullable'],
          //  'valorCasa'       => ['nullable'],
            'total'       => ['required'],

            'fechaVenta' => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',],
            'valorPrima' => ['required_if:formaVenta,credito','numeric','max:valorTerreno' ,'regex:/^[0-9]{1,6}+$/', 'nullable'],
            'cantidadCuotas' => ['required_if:formaVenta,credito','numeric', 'min:10', 'max:240','regex:/^[0-9]{1,4}+$/', 'nullable'],
            'valorCuotas' => ['required_if:formaVenta,credito','numeric', 'min:1', 'nullable'],
            'valorRestantePagar' => ['required_if:formaVenta,credito','numeric', 'min:1', 'nullable'],

        ],[            

            'cliente_id.required'=>'Debe seleccionar un cliente, no puede estar vacío.',
            'bloque_id.required'=>'Debe seleccionar un bloque, no puede estar vacío.',
            'lote_id.required'=>'Debe seleccionar un lote, no puede estar vacío.',
            'beneficiario_id.required'=>'Debe seleccionar un beneficiario, no puede estar vacío.',

            'valorTerreno.numeric' => 'Solo se permite números enteros. Ejem. "12345678"',
            'valorTerreno.regex' => 'El valor es incorrecto. Ejem. "123"',
            'valorTerreno.min' => 'La cantidad de hora alquilada mínima es "1". ',

            'total.required'=>'Debe dar click en calcular antes de guardar',

            'status.required' => 'El estado del lote es requerido',

            'valorPrima.numeric' => 'Solo se permite números enteros. Ejem. "123456"',
            'valorPrima.max' => 'El valor de la prima no debe exceder el valor del terreno". ',

            'diaPago.numeric' => 'Solo se permite números enteros. Ejem. "1 o 31"',
            'diaPago.min' => 'El dia de pago mínimo es "1". ',

            'cantidadCuotas.numeric' => 'Solo se permite números enteros. Ejem. "12345"',
            'cantidadCuotas.min' => 'La cantidad de cuotas mínima es "120 meses". ',
            'cantidadCuotas.max' => 'La cantidad de cuotas máxima es "240 meses" ',

            'valorCuotas.numeric' => 'Solo se permite números enteros. Ejem. "12345"',

            'valorRestantePagar.numeric' => 'Solo se permite números enteros. Ejem. "12345678"',
            'valorRestantePagar.min' => 'El valor de la prima no debe exceder el valor del terreno',

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
        $casa = Casa::all();
        $venta = Venta::findOrFail($id);
        $pdf = PDF::loadView('venta.pdfContrato', compact('bloques','lotes','venta', 'casa'));
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

    public function getBeneficiarios($id){
        $beneficiarios = Beneficiario::where('cliente_id', '=', $id)->get();
        return response()->json($beneficiarios);
    }

    public function getBeneficiarioss($id){
        $beneficiarios = Beneficiario::where('cliente_id', '=', $id)->get();
        return $beneficiarios;
    }

    public function change_status(Venta $venta)
    {
        if ($venta->status == 'Pagando') {
            $venta->update(['status'=>'Cancelando']);
            return redirect()->back()->with('toast_success', '¡Estado cambiado con éxito!');
        } else {
            $venta->update(['status'=>'Pagando']);
            return redirect()->back()->with('toast_success', '¡Estado cambiado con éxito!');
        } 
    }

}

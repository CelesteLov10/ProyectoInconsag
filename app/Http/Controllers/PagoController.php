<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{

    public function index(Request $request){
        $busqueda= $request->search;
        $busqueda="";
        $bloques = Bloque::all();
        $pago = Pago::all();
        $lote = Lote::all();
        $cliente = Cliente::all();
        $venta = DB::select('call MostrarVentas(
            :nombrelote
            ,:bloque
            ,:cliente)', [

            "nombrelote" => $busqueda,
            "bloque" => $busqueda, 
            "cliente" => $busqueda
        ]);

    /*  $ventas = Venta::query()
    ->when(request('search'), function($query){
    return $query->where('formaVenta', 'LIKE', '%' .request('search') .'%')
    ->orWhereHas('lote', function($q){
        $q->where('nombreLote','LIKE', '%' .request('search') .'%');
    })
    ->orWhereHas('bloque', function($q){
        $q->where('nombreBloque','LIKE', '%' .request('search') .'%');
    })
        ->orWhereHas('cliente', function($q){
            $q->where('nombreCompleto','LIKE', '%' .request('search') .'%');
    });
    })->orderBy('id','desc')->paginate(30)->withQueryString();*/
        return view('pago.index', compact('lote', 'pago', 'venta', 'bloques', 'cliente', 'busqueda', 'request'));
    
    }

    // Metodo para mostrar pdf
    public function pdf ($id){
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago = Pago::all();
        $pago1 = Pago::findOrFail($id);
        $venta = Venta::findOrFail($id);
        $lote = Lote::all();
        $nuevoSaldo = $pago->sum('saldoEnCuotas');
        $pdf = PDF::loadView('pago.pdf', compact('bloques','cliente', 'venta','pago1','lote', 'pago'));
        return $pdf -> stream();
    }

    public function show($id){
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago = Pago::all();
        $pago1 = Pago::findOrFail($id);
        $venta = Venta::findOrFail($id);
        $lote = Lote::all();
        $nuevoSaldo = $pago->sum('saldoEnCuotas');
        return view('pago.show', compact('bloques','cliente', 'venta','pago1','lote'))->with('pago', $pago);

    }

    public function create($id)
    {
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago2 = Pago::all();
        $pago = Pago::findOrFail($id);
        $venta = Venta::findOrFail($id);
        $lote = Lote::all(); 
        $ventas = Venta::whereRaw('(SELECT sum(cantidadCuotasPagar) FROM pagos WHERE venta_id = ventas.id)')->get();
        
        //poner una condicion donde me diga que el id de venta sea igual al de pago sea igual al id

        return view('pago.create',compact('bloques','cliente', 'venta','lote','ventas','pago2'))->with('pago', $pago);
    }

    public function store(Request $request){
        $reglas = [

            'venta_id' => 'required',
            'cliente_id' => 'required',
            'lote_id' => 'required',
            'fechaPago' =>'required',
            'cantidadCuotasPagar' => 'required|numeric|min:1|max:6|regex:/^[0-9]{1,2}+$/u',
            'cuotaPagar' => 'required',
            'saldoEnCuotas' => 'required',
            'valorTerrenoPagar' => 'required|min:1|regex:/^[0-9]{1,40}/u',
            //'nuevoSaldo' => 'required',
    
        ];
        $mensaje =[

            'cantidadCuotasPagar.required' => 'La cantidad de cuotas no puede ir vacío.',
            'cantidadCuotasPagar.numeric' => 'La cantidad de cuotas debe contener sólo números.',
            'cantidadCuotasPagar.digits' => 'La cantidad de cuotas debe contener 8 dígitos.',
            'cantidadCuotasPagar.min' => 'La cantidad de cuotas debe ser 1 como minimo.',
            'cantidadCuotasPagar.max' => 'La cantidad de cuotas debe ser 6 como máximo.',
            'saldoEnCuotas.required' => 'El saldo en cuotas no puede ir vacío.',
            'saldoEnCuotas.required' => 'El saldo en cuotas no puede ir vacío.',
            'valorTerrenoPagar.min' => 'El saldo pendiente debe ser 1 como minimo.',
            'valorTerrenoPagar.regex' => 'El saldo pendiente no debe ser negativo.',

        ];
            $this->validate($request, $reglas, $mensaje);

            Pago::create([
                'venta_id'=>$request['venta_id'],
                'cliente_id'=>$request['cliente_id'],
                'lote_id'=>$request['lote_id'],
                'fechaPago'=>$request['fechaPago'],
                'cantidadCuotasPagar'=>$request['cantidadCuotasPagar'],
                'cuotaPagar' =>$request[ 'cuotaPagar' ],
                'valorTerrenoPagar'=>$request['valorTerrenoPagar'], 
                'saldoEnCuotas'=>$request['saldoEnCuotas'], 
                //'nuevoSaldo'=>$request['nuevoSaldo'], 
            ]);

            return redirect()->route('pago.index')
            //return view('pago.print', ['data' => $request->all()]);redirect()->route('pago.index');
            ->with('mensaje', 'Se guardó un nuevo registro de pago correctamente');
    }   


    public function resta(Request $request, $id)
    {
        $pago = Pago::findOrFail($id);
        $pago1 = Pago::find($pago->id);
        $pago1->valorTerrenoPagar -= $pago1->saldoEnCuotas;
        $pago1->saveOrFail();

        /*$pay = new Pago();
            $pay->venta_id= $request->input('venta_id');
            $pay->pago= $request->input('valorTerrenoPagar');

            $venta=Venta::where('id',$id)->first();
            $venta->valorRestantePagar-=$request->input('valorTerrenoPagar');
            $venta->save();
            $pay->save();*/
    }

    public function print($id){
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago = Pago::findOrFail($id);
        $venta = Venta::all();
        $lote = Lote::all(); 
        $pdf = PDF::loadView('pago.print', compact('bloques','cliente', 'pago','venta','lote'));
        return $pdf -> stream();
    }

  
}
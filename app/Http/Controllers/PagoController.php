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
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Php;

class PagoController extends Controller
{

    public function index(Request $request){
      /** con esto se llama al nombre del boton para buscar en el index */
        $busqueda= $request->search;
       //$busqueda="";
        $bloques = Bloque::all();
        $pago = Pago::all();
        $lote = Lote::all();
        $cliente = Cliente::all();
        /**condicion, si no hay nada en el campo de busqueda deberia traer todos los campos */
        #si le quitan un igual le aparece todos los campos en la vista, pero no les realizara la busqueda
        #si lo dejan como esta no mostrara los datos en el index, pero si las busquedas
        if ($busqueda == null) {
           // $venta = Venta::orderBy('id','desc')->paginate(30)->withQueryString();
           $venta = DB::select('call MostrarVentas(
            :nombrelote
            ,:bloque
            ,:cliente)', [

            "nombrelote"=>"",
            "bloque"=>"" , 
            "cliente"=>""
        ]);
        } else {
            # si se realiza una busqueda traera todos esos datos relacionados con la busqueda
            $venta = DB::select('call MostrarVentas(
                :nombrelote
                ,:bloque
                ,:cliente)', [
    
                "nombrelote" => $busqueda,
                "bloque" => $busqueda, 
                "cliente" => $busqueda
            ]);
    
        }
        
        return view('pago.index', compact('lote', 'pago', 'venta', 'bloques', 'cliente', 'busqueda'));
     //  dd($busqueda);
    
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
            'cuotaPagar' => 'required|numeric|min:1',
            'saldoEnCuotas' => 'required|regex:/^[0.000-9.000]{1,9}+$/u',
            'valorTerrenoPagar' => 'required|min:1|regex:/^[0-9]{1,40}/u',
            //'nuevoSaldo' => 'required',
    
        ];
        $mensaje =[

            'cantidadCuotasPagar.required' => 'La cantidad de cuotas es obligatoria, no puede estar vacío.',
            'cantidadCuotasPagar.numeric' => 'La cantidad de cuotas debe contener sólo números.',
            'cantidadCuotasPagar.min' => 'La cantidad de cuotas debe ser 1 como minimo.',
            'cantidadCuotasPagar.max' => 'La cantidad de cuotas debe ser 1 como máximo.',

            'saldoEnCuotas.required' => 'El saldo en cuotas es obligatorio, no puede estar vacío.',
            'saldoEnCuotas.required' => 'El saldo en cuotas es obligatorio, no puede estar vacío.',
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
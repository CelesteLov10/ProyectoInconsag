<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PagoController extends Controller
{

    public function index(){
        $bloques = Bloque::all();
        $pago = Pago::all();
        $lote = Lote::all();
        $cliente = Cliente::all();
        $venta = Venta::query()
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
    })->orderBy('id','desc')->paginate(10)->withQueryString();
        return view('pago.index', compact('lote', 'pago', 'venta'))->with('bloques', $bloques);
    
    }
    //

    public function show($id){
        $bloques = Bloque::all();
      //$lotes = Lote::all();
        $cliente = Cliente::all();
        $pago = Pago::all();
        $venta = Venta::findOrFail($id);
        $lote = Lote::all();
        $nuevoSaldo = $pago->sum('saldoEnCuotas');
        return view('pago.show', compact('bloques','cliente', 'pago', 'venta'))->with('lote', $lote);

    }

    public function create($id)
    {
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago = Pago::all();
        $venta = Venta::findOrFail($id);
        $lote = Lote::all(); 
        return view('pago.create',compact('bloques','cliente', 'pago', 'venta'))->with('lote', $lote);
    }

    public function store(Request $request){
        $reglas = [

            'venta_id' => 'required',
            'cliente_id' => 'required',
            'lote_id' => 'required',
            'fechaPago' =>'required',
            'cantidadCuotasPagar' => 'required',
            'cuotaPagar' => 'required',
            'valorTerrenoPagar' => 'required',
            'saldoEnCuotas' => 'required',
            //'nuevoSaldo' => 'required',
    
        ];
        $mensaje =[
            'nombreProveedor.required' => 'El nombre del proveedor es requerido, no puede estar vacío. ',
            'nombreProveedor.regex' => 'El nombre del proveedor solo permite un espacio entre los nombres
            y no se admiten números o caracteres especiales.',
            'nombreProveedor.unique' => 'El nombre del proveedor ya está en uso.',

            'nombreContacto.required' => 'El nombre del contacto es requerido, no puede estar vacío. ',
            'nombreContacto.regex' => 'Debe iniciar con mayúscula cada palabra, solo permite un espacio entre los nombres y no se admiten números.',

            'cargoContacto.required' => 'El cargo del contacto es requerido, no puede estar vacío. ',
            'cargoContacto.regex' => 'El cargo del contacto solo permite un espacio entre los nombres y no permite números.',

            'direccion' => 'La direccion es requerido, no puede estar vacío. ',
            'direccion.min' => 'La dirección es muy corta. Ingrese entre 10 y 150 caracteres',
            'direccion.max' => 'La dirección sobrepasa el límite de caracteres',

            'telefono.required' => 'El teléfono no puede ir vacío.',
            'telefono.numeric' => 'El teléfono debe contener sólo números.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono debe empezar sólo con los siguientes dígitos: "2", "3", "8", "9".',
            'telefono.unique' => 'El número de teléfono ya está en uso.',

            'email.required' => 'Debe ingresar el correo electrónico.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'categoria_id.required' => 'Debe seleccionar una categoría',

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

            /*$pay = new Pago();
            $pay->venta_id= $request->input('venta_id');
            $pay->pago= $request->input('valorTerrenoPagar');

            $venta=Venta::where('id',$id)->first();
            $venta->valorRestantePagar-=$request->input('valorTerrenoPagar');
            $venta->save();
            $pay->save();*/

            return redirect()->route('pago.index')
            //return view('pago.print', ['data' => $request->all()]);redirect()->route('pago.index');
            ->with('mensaje', 'Se guardó un nuevo registro de pago correctamente');
    }

    public function resta(Request $request, $id)
    {
        $pay = new Pago();
            $pay->venta_id= $request->input('venta_id');
            $pay->pago= $request->input('valorTerrenoPagar');

            $venta=Venta::where('id',$id)->first();
            $venta->valorRestantePagar-=$request->input('valorTerrenoPagar');
            $venta->save();
            $pay->save();
    }

    public function print($id){
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago = Pago::findOrFail($id);
        $venta = Venta::findOrFail($id);
        $lote = Lote::all(); 
        $pdf = PDF::loadView('pago.print', compact('bloques','cliente', 'pago','venta'));
        return $pdf -> stream();
    }

}

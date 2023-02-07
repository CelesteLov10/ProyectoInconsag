<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Http\Request;

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
      //  $lotes = Lote::all();
        $cliente = Cliente::all();
       $pago = Pago::all();
       $venta = Venta::findOrFail($id);
        $lote = Lote::all();
        $nuevoSaldo = $pago->sum('saldoEnCuotas');
        return view('pago.show', compact('bloques','cliente', 'pago', 'venta'))->with('lote', $lote);

    }

}

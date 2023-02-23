<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Cliente;
use App\Models\Liberado;
use App\Models\Lote;
use App\Models\Pago;
use App\Models\Venta;
use Carbon\Carbon;

use Illuminate\Http\Request;

class LiberadoController extends Controller
{
    public function index(Request $request){

        // $fecha = Carbon::now()->timestamp;
        // $fecha = now();

        $liberado = Liberado::all();
        $venta = Venta::all();
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago =Pago::all();
        $lote = Lote::query()
    ->when(request('search'), function($query){
    return $query->where('nombreLote','LIKE', '%' .request('search') .'%')
    ->orWhereHas('bloque', function($q){
        $q->where('nombreBloque','LIKE', '%' .request('search') .'%');
    })
        ->orWhereHas('cliente', function($q){
            $q->where('nombreCompleto','LIKE', '%' .request('search') .'%');
    });
    })->orderBy('id','desc')->paginate(10)->withQueryString();
        return view('liberado.index', compact('lote', 'cliente', 'venta', 'pago', 'bloques', 'liberado'));
    
    }
}

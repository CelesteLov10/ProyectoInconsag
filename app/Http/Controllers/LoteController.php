<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Lote;
use Illuminate\Http\Request;

class LoteController extends Controller
{
    //
    public function create(){  
        $bloque = Bloque::all(); 
        $lote = Lote::all();
        return view('lote.create', compact('lote', 'bloque'));
    }
public function store(Request $request){

        $lote = new Lote();

    $lote->numLote = $request->numLote;
    $lote->medidaLateralR = $request->medidaLateralR;
    $lote->medidaLateralL = $request->medidaLateralL;
    $lote->medidaEnfrente = $request->medidaEnfrente;
    $lote->medidaAtras = $request->medidaAtras;
    $lote->colindanciaN = $request->colindanciaN;
    $lote->colindanciaS = $request->colindanciaS;
    $lote->colindanciaE = $request->colindanciaE;
    $lote->colindanciaO = $request->colindanciaO;
    $lote->bloque_id = $request->bloque_id;

    $create = $lote->save();
    
    if ($create){
        return redirect()->route('bloque.index')
        ->with('mensaje', 'Se registrarón los lotes correctamente');
    } 
}
}

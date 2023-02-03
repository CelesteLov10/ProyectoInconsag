<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Lote;
use Illuminate\Http\Request;

class LoteVendidoController extends Controller
{
    public function index2(){
        $bloques = Bloque::all();
        $lotes = Lote::query()
    ->when(request('search'), function($query){
    return $query->where('nombreLote', 'LIKE', '%' .request('search') .'%')
    ->orWhereHas('bloque', function($q){
        $q->where('nombreBloque','LIKE', '%' .request('search') .'%');
    });
    })->orderBy('id','desc')->paginate(100)->withQueryString();
        return view('bloque.index2', compact('lotes'))->with('bloques', $bloques);
        }
}
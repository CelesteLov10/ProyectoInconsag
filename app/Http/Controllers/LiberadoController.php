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

        $cliente = Cliente::all();
        $pago = Pago::all();
        $lote = Lote::all();
        $venta = Venta::all();
        $bloques = Bloque::all();
        $liberado = Liberado::query()
        ->when(request('search'), function($query){
        return $query->where('nomBloque', 'LIKE', '%' .request('search') .'%')
        ->orWhere('nomLote', 'LIKE', '%' .request('search') .'%')
        ->orWhere('fecha', 'LIKE', '%' .request('search') .'%')
        ;
        })
        ->orderBy('id','desc')->paginate(10)->withQueryString();
        
        

        return view('liberado.index', compact('lote', 'cliente', 'venta', 'pago', 'bloques', 'liberado'));
    }

    public function create($id){
        $liberado = Liberado::all();
        $venta = Venta::findOrFail($id);
        $bloques = Bloque::all();
        $cliente = Cliente::all();
        $pago =Pago::all();
        $lote = Lote::all();

        return view('liberado.create', compact('lote', 'pago', 'cliente', 'bloques', 'liberado'))->with('venta', $venta);
    }
    

    public function store(Request $request){
    $this->validate($request,[
        'nomBloque'       => ['required'],
        'nomLote'       => ['required'],
        'nomCliente'       => ['required'],
        'fecha'       => ['required'],
        'descripcion'       => ['required','min: 7', 'max: 255'],
    ],[
        'nomBloque.required' => 'El nombre del bloque es requerido, no puede estar vacío.',
        'nomLote.required' => 'El nombre del lote es requerido, no puede estar vacío.',
        'nomCliente.required' => 'El nombre del cliente es requerido, no puede estar vacío.',
        'fecha.required' => 'La fecha es requerida, no puede estar vacía.',

        'descripcion.required' => 'La descripción es requerida, no puede estar vacía.',
        'descripcion.min' => 'La descripción debe tener al menos 7 caracteres.',
        'descripcion.max' => 'La descripción no puede tener mas de 255 caracteres.',

    ]);
    $input = $request->all();
    
        Liberado::create($input);
        return redirect()->route('liberado.index')
        ->with('mensaje', 'Se ha liberado el lote correctamente');
    }
}

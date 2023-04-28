<?php

namespace App\Http\Controllers;

use App\Models\Bloque;
use App\Models\Lote;
use Illuminate\Http\Request;
use mysqli;
use App\Http\Requests\crearLotesRequest;

class LoteController extends Controller
{
    //
    public function create(){
        $bloques = Bloque::whereRaw('(SELECT COUNT(*) FROM lotes WHERE bloque_id = bloques.id) < cantidadLotes')->get();
        $lotes = Lote::all();
    

        return view('lote.create')->with('bloques', $bloques)->with('lotes', $lotes);
    }
    

    public function store(Request $request){
    $reglas = [
        'bloque_id'   => 'required',
        'nombreLote' => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ0-9]+\s{0,1})+$/u',
        'status'    => 'required',
        'medidaLateralR'   => 'required|numeric|min:1.00|max:99999|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'medidaLateralL'   => 'required|numeric|min:1.00|max:99999|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'medidaEnfrente'   => 'required|numeric|min:1.00|max:99999|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'medidaAtras'   => 'required|numeric|min:1.00|max:99999|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'valorTerreno' => 'required|numeric|min:80000|regex:/^[0-9]{1,8}+$/',
        'colindanciaN'    => 'required',
        'colindanciaS'    => 'required',
        'colindanciaE'    => 'required',
        'colindanciaO'    => 'required',
    ];
    $mensaje =[

        'nombreLote.required' => 'El nombre del lote es obligatorio, no puede estar vacío. ',
        'nombreLote.regex' => 'El nombre del lote solo permite un espacio entre los nombres.',
        'nombreLote.unique' => 'El nombre del lote debe ser único.',

        'status' => 'El estado del lote es requerido',

        'bloque_id.required' => 'El nombre del bloque es obligatorio, no puede estar vacío. ',

        'medidaLateralR.required' => 'La medida lateral derecha es obligatoria, no puede estar vacío. ',
        'medidaLateralL.required' => 'La medida lateral izquierda es obligatoria, no puede estar vacío. ',
        'medidaEnfrente.required' => 'La medida de enfrente es obligatoria, no puede estar vacío. ',
        'medidaAtras.required' => 'La medida de atras es obligatoria, no puede estar vacío. ',

        'medidaLateralR.numeric' => 'La medida lateral derecha solo permite numeros.',
        'medidaLateralL.numeric' => 'La medida lateral izquierda solo permite numeros.',
        'medidaEnfrente.numeric' => 'La medida de enfrente solo permite numeros.',
        'medidaAtras.numeric' => 'La medida de atras solo permite numeros.',

        'colindanciaN.required'    => 'La colindancia norte es obligatoria, no puede estar vacío. ',
        'colindanciaS.required'    => 'La colindancia sur es obligatoria, no puede estar vacío. ',
        'colindanciaE.required'    => 'La colindancia este es obligatoria, no puede estar vacío. ',
        'colindanciaO.required'    => 'La colindancia oeste es obligatoria, no puede estar vacío. ',

        'valorTerreno.required' => 'El valor del terreno es obligatorio, no puede estar vacío.',
        'valorTerreno.numeric' => 'Solo se permite números enteros. Ejem. "12345678"',
        'valorTerreno.regex' => 'El valor es incorrecto. Ejem. "123"',
        'valorTerreno.min' => 'El valor mínimo del terreno es  "80000". ',

    ];
    $this->validate($request, $reglas, $mensaje);

   // dd($request);

   // $create = Lote::create($request->all());
        $lote = new Lote();

    $lote->bloque_id = $request->bloque_id;
    $lote->nombreLote = $request->nombreLote;
    $lote->status = $request->status;
    $lote->valorTerreno = $request->valorTerreno;
    $lote->medidaLateralR = $request->medidaLateralR;
    $lote->medidaLateralL = $request->medidaLateralL;
    $lote->medidaEnfrente = $request->medidaEnfrente;
    $lote->medidaAtras = $request->medidaAtras;
    $lote->colindanciaN = $request->colindanciaN;
    $lote->colindanciaS = $request->colindanciaS;
    $lote->colindanciaE = $request->colindanciaE;
    $lote->colindanciaO = $request->colindanciaO;

    $create = $lote->save();

    if ($create){
        return redirect()->route('bloque.index')
        ->with('mensaje', 'Se registró el lote correctamente');
       // return response()->json($create);
    }
    //si esta mal, lo regresara atras con lo que habia ingresado
   // return response()->json('No se pudieron ingresar los registros ');
}

/* YA NO SE NECESITA, PORQUE SE HACE CON EL TRIGGUER
public function change_status(Lote $lote)
{
    if ($lote->status == 'Disponible') {
        $lote->update(['status'=>'Vendido']);
        return redirect()->back();
    } else {
        $lote->update(['status'=>'Disponible']);
        return redirect()->back();
    } 
}*/


}


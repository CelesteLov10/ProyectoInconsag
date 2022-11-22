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
        $bloque = Bloque::all(); 
        $lote = Lote::all();
        return view('lote.create', compact('lote', 'bloque'));
    }
public function store(crearLotesRequest $request){

   // dd($request);

   // $create = Lote::create($request->all());
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
        ->with('mensaje', 'Se registró el lote correctamente');
       // return response()->json($create);
    } 
    //si esta mal, lo regresara atras con lo que habia ingresado
   // return response()->json('No se pudieron ingresar los registros ');
}

/*public function getLotes(){
    $lotes = json_decode($_POST['json'],true);
    //echo var_dump($lotes);
    require 'conexion.php';
    foreach ($lotes as $lote){
        $numLote = $lote['numLote'];
        $medidaLateralR = $lote['medidaLateralR'];
        $medidaLateralL = $lote['medidaLateralL'];
        $medidaEnfrente = $lote['medidaEnfrente'];
        $medidaAtras = $lote['medidaAtras'];
        $colindanciaN = $lote['colindanciaN'];
        $colindanciaS = $lote['colindanciaS'];
        $colindanciaE = $lote['colindanciaE'];
        $colindanciaO = $lote['colindanciaO'];

        $guardar = mysqli_query($con,"INSERT INTO lotes (
            numLote, medidaLateralR, medidaLateralL, medidaEnfrente, medidaAtras,
            colindanciaN, colindanciaS, colindanciaE, colindanciaO 
        ) VALUES('$numLote', '$medidaLateralR', '$medidaLateralL', '$medidaEnfrente', '$medidaAtras',
            '$colindanciaN', '$colindanciaS', '$colindanciaE', '$colindanciaO' )" );
    }
}*/


}

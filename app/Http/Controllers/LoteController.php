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
public function store(Request $request){

    $reglas = [


        'bloque_id'   => 'required',
        'numLote'    => 'required|numeric|min:1|regex:/^[0-9]{1,2}+$/u',
        'medidaLateralR'   => 'required|numeric|min:1.00|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'medidaLateralL'   => 'required|numeric|min:1.00|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'medidaEnfrente'   => 'required|numeric|min:1.00|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'medidaAtras'   => 'required|numeric|min:1.00|max:99999|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
        'colindanciaN'    => 'required',
        'colindanciaS'    => 'required',
        'colindanciaE'    => 'required',
        'colindanciaO'    => 'required',
        
    
    ];
    $mensaje =[
        'bloque_id.required' => 'El bloque es requerido, no puede estar vacío. ',
        'medidaLateralR.required' => 'La medida lateral derecha es requerida, no puede estar vacío. ',

        'medidaLateralL.required' => 'La medida lateral izquierda es requerida, no puede estar vacío. ',

        'medidaEnfrente.required' => 'La medida de enfrente es requerida, no puede estar vacío. ',

        'medidaAtras.required' => 'La medida de atras es requerida, no puede estar vacío. ',

        'medidaLateralR.numeric' => 'La medida lateral derecha solo permite numeros.',
        'medidaLateralL.numeric' => 'La medida lateral izquierda solo permite numeros.',
        'medidaEnfrente.numeric' => 'La medida de enfrente solo permite numeros.',
        'medidaAtras.numeric' => 'La medida de atras solo permite numeros.',
        'numLote.numeric' => 'El numero de lote solo permite numeros.',
        'numLote.required' => 'El numero de lote es requerido, no puede estar vacío. ',

        'colindanciaN.required'    => 'La colindancia norte es requerida, no puede estar vacío. ',
        'colindanciaS.required'    => 'La colindancia sur es requerida, no puede estar vacío. ',
        'colindanciaE.required'    => 'La colindancia este es requerida, no puede estar vacío. ',
        'colindanciaO.required'    => 'La colindancia oeste es requerida, no puede estar vacío. ',

    ];
    $this->validate($request, $reglas, $mensaje);

   // dd($request);

   // $create = Lote::create($request->all());
      $lote = new Lote();

    $lote->bloque_id = $request->bloque_id;
    $lote->numLote = $request->numLote;
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

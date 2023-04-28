<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Inventario;
use Illuminate\Http\Request;
use App\Models\Oficina;
use Illuminate\Support\Facades\DB;
Barryvdh\DomPDF\ServiceProvider::class;

// Importamos la libreria PDF de esta manera
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InventarioController extends Controller
{
    public function index(){
        //Campo busqueda
        $inventarios = Inventario::query()
            ->when(request('search'), function($query){
            return $query->where('nombreInv', 'LIKE', '%' .request('search') .'%')
            //Aqui es la tabla relacionada y abajo el nombre del campo que desea.
            ->orWhereHas('oficina', function($q){
                $q->where('nombreOficina','LIKE', '%' .request('search') .'%');
            })
            ->orWhereHas('empleado', function($q){
                $q->where('nombres','LIKE', '%' .request('search') .'%');
            });
            })->orderBy('id','desc')->paginate(100000)->withQueryString(); 
        
        $empleado = Empleado::all();
        $oficina = Oficina::all();
        return view('inventario.index', compact('inventarios', 'empleado', 'oficina'));
    }

    /*public function sear(Request $request){
        $sear=trim($request->get('search'));
        $otra=$request->all();
        $inventarios=DB::table('inventarios')
        ->where('nombreInv', 'LIKE', '%' .$sear.'%')
        ->orWhere('oficina','nombreOficina','LIKE', '%' .request('search') .'%')
        ->orWhere('empleado','nombres','LIKE', '%' .request('search') .'%')
        ->orderBy('id','desc')->paginate(10)->appends($otra);

        return view('inventario.index')->with('inventarios', $inventarios);
    }*/

    // Metodo para mostrar pdf
    public function pdf (request $id){

        // prueba con find
        //$inventarios = Inventario::find($id);


        // prueba atravez de una consulta sql que reciba el valor de la busqeuda

        /*$dato = $_GET['search'];
        $sql = "select * from inventarios, oficinas, empleados where 
            nombreInv = $dato or nombreOficina = $dato or nombres = $dato";
        $resultado = $conn->query($sql);
        $inventarios = $resultado->fetch_assoc();*/
        
        
        /*$dato = $_GET['search'];
        $inventarios = DB::select("select * from inventarios, oficinas, empleados where 
            nombreInv = $dato or nombreOficina = $dato or nombres = $dato");*/
        // Con esto imprime todos los registros de ese modelo "all()"
        $inventarios = Inventario::all();
        $empleado = Empleado::all();
        $oficina = Oficina::all();    

        // Aqui hacemos uso de la libreria PDF para que genere el documento pdf
        $pdf = PDF::loadView('inventario.pdf', compact('inventarios', 'empleado', 'oficina'));
        return $pdf -> stream();
        
    }
 
    public function create(){   
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();
        return view('inventario.create',compact('empleado', 'oficina'));
    }

    public function store(Request $request){

        $reglas = [

            'nombreInv'   => 'required|regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u',
            'cantidad'    => 'required|numeric|regex:/^[0-9]{1,4}+$/u|min:1',
            'precioInv'   => 'required|numeric|min:1.00|max:99999|regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/',
            'descripcion' => 'required|min:10|max:150',
            'fecha'       => 'required|regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u',
            'empleado_id' => 'required',
            'oficina_id'  => 'required',
    
        ];
        $mensaje =[
            'nombreInv.required' => 'El nombre del inventario es obligatorio, no puede estar vacío. ',
            'nombreInv.regex' => 'El nombre del inventario no permite numeros y solo permite un espacio entre los nombres.',
            'nombreInv.alpha' => 'En el nombre del inventario sólo se permite letras.',

            'cantidad.required' => 'La cantidad del inventario es obligatoria, no puede estar vacío.', 
            'cantidad.numeric' => 'En cantidad de inventario no se permiten letras.',
            'cantidad.regex' => 'No puede ingresar mas de 9999 artículos.',
            'cantidad.min' => 'La cantidad mínima de inventario no puede ser menor a 1.',


            'precioInv.required' => 'El precio del inventario es obligatorio, no puede estar vacío.',
            'precioInv.numeric'=> 'No se permiten letras o espacios vacíos.',
            'precioInv.min' => 'El precio del inventario no puede ser menor a L.1.00.',
            'precioInv.max' => 'El precio del inventario no puede ser mayor a L.99999.00.',
            'precioInv.regex' => 'El precio del inventario debe contener 1 o 2 cifras despues del punto (opcional).',

            'descripcion' => 'La descripción es obligatoria, no puede estar vacío. ',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'fecha.required' => 'La fecha de compra es obligatoria, no puede estar vacío.', 
            'fecha.regex' => 'No debe agregar mas datos a la fecha seleccionada', 

            'empleado_id.required' => 'El nombre del empleado que compró el inventario es obligatorio, no puede estar vacío.',

            'oficina_id.required' => 'El nombre de la oficina es obligatorio.'




        ];
        $this->validate($request, $reglas, $mensaje);

        Inventario::create([
            'nombreInv'=>$request['nombreInv'],
            'cantidad'=>$request['cantidad'],
            'precioInv'=>$request['precioInv'],
            'descripcion'=>$request['descripcion'],
            'fecha' =>$request[ 'fecha' ],
            'empleado_id'=>$request['empleado_id'], 
            'oficina_id'=>$request['oficina_id'], 
            
        ]);
            return redirect()->route('inventario.index')
            ->with('mensaje', 'Se guardó un nuevo inventario correctamente');
        
    }

    public function show($id){
        $inventario = Inventario::findOrFail($id);
        //$oficina = Oficina::findOrFail($id); no se para que funciona , $oficina
        return view('inventario.show')->with('inventario', $inventario);
    }

    public function edit($id){
        $inventario = Inventario::findOrFail($id);
        $empleado = Empleado::orderBy('nombres')->get();
        $oficina = Oficina::orderBy('nombreOficina')->get();

        return view('inventario.edit', compact('inventario', 'empleado','oficina'))
        ->with('inventario', $inventario);
    }

    public function update(Request $request, $id){

        $this->validate($request,[

            'nombreInv'   => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u'],
            'cantidad'    => ['required','numeric','regex:/^[0-9]{1,4}+$/u', 'min:1'],
            'precioInv'   => ['required','numeric','max:99999','min:1.00','regex:/^[0-9]{1,5}(\.[0-9]{1,2})?$/'],
            'descripcion' => ['required','min:10','max:150'],
            'fecha'       => ['required','regex:/^[0-9]{2}+-[0-9]{2}+-[0-9]{4}+$/u'],
            'empleado_id' => ['required'],
            'oficina_id'  => ['required'],
        ],[
            'nombreInv.required' => 'El nombre del inventario es obligatorio, no puede estar vacío. ',
            'nombreInv.alpha' => 'En el nombre del inventario sólo se permite letras.',
            'nombreInv.regex' => 'El nombre del inventario no permite numeros y solo permite un espacio entre los nombres.',

            'cantidad.required' => 'La cantidad del inventario es obligatoria, no puede estar vacío.', 
            'cantidad.numeric' => 'En cantidad de inventario no se permiten letras.',
            'cantidad.regex' => 'No puede ingresar mas de 9999 artículos.',
            'cantidad.min' => 'La cantidad mínima de inventario no puede ser menor a 1.',


            'precioInv.required' => 'El precio del inventario es obligatorio, no puede estar vacío.',
            'precioInv.numeric'=> 'No se permiten letras o espacios vacíos.',
            'precioInv.min' => 'El precio del inventario no puede ser menor a L.1.00.',
            'precioInv.max' => 'El precio del inventario no puede ser mayor a L.99999.00.',
            'precioInv.regex' => 'El precio del inventario debe contener 1 o 2 cifras despues del punto (opcional).',   

            'descripcion' => 'La descripción es obligatoria, no puede estar vacío. ',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'fecha.required' => 'La fecha de compra es obligatoria, no puede estar vacío.', 
            'fecha.regex' => 'No debe agregar más datos a la fecha seleccionada', 

            'empleado_id.required' => 'El nombre del empleado que compró el inventario es obligatorio, no puede estar vacío.',

            'oficina_id.required' => 'El nombre de la oficina es obligatorio.'

    
        ]);

        $inventario = Inventario::findOrFail($id);

        $inventario->nombreInv = $request->input('nombreInv');
        $inventario->cantidad = $request->cantidad;
        $inventario->precioInv = $request->precioInv;
        $inventario->descripcion = $request->descripcion;
        $inventario->fecha = $request->fecha;
        $inventario->empleado_id = $request->empleado_id;
        $inventario->oficina_id = $request->oficina_id;
        
        $update = $inventario->save();
        
        if ($update){
            return redirect()->route('inventario.index')
            ->with('mensajeW', 'Se actualizó el inventario correctamente');
        } 
    }
}

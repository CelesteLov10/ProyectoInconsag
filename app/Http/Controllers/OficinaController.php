<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Inventario;
use App\Models\Municipio;
use App\Models\Oficina;
use Illuminate\Http\Request;

class OficinaController extends Controller
{
    public function index(){
        //Campo busqueda
        $oficinas = Oficina::query()
            ->when(request('search'), function($query){
            return $query->where('nombreOficina', 'LIKE', '%' .request('search') .'%')
            ->orWhereHas('municipio', function($q){
                $q->where('nombreM','LIKE', '%' .request('search') .'%');
            });
        })->orderBy('id','desc')->paginate(10)->withQueryString(); 
        $inventario = Inventario::all();
    

        return view('oficina.index', compact('oficinas', 'inventario'));
    }
    

    public function show($id){
        $oficina = Oficina::findOrFail($id);
        return view('oficina.show')->with('oficina', $oficina);
    }
    public function create(){

        $departamentos = Departamento::all();
        $municipios = Municipio::all();
        return view('oficina.create', compact('departamentos', 'municipios'));

    }

    public function store(Request $request){

        $reglas = [

            'nombreOficina' => 'required|regex:/^([A-ZÁÉÍÓÚÑ]{1})([a-záéíóúñ]+\s{0,1}([0-9]{0,15}?))+$/u',
            'direccion'     => 'required|regex:/^.{10,150}$/u',//regex:/^(([A-ZÁÉÍÓÚÑ]{1})([a-záéíóúñ]+\s{0,1})?)(([A-ZÁÉÍÓÚÑ]{1})([a-záéíóúñ]+\s{0,1})?)(([A-ZÁÉÍÓÚÑ]{1})([a-záéíóúñ]+\s{0,1})?)(([A-ZÁÉÍÓÚÑ]{1})([a-záéíóúñ]+\s{0,1})?)
            'nombreGerente' => 'required|regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u',
            'telefono'      => 'required|numeric|digits:8|regex:/^[(2)(3)(8)(9)][0-9]/|unique:oficinas',
            'departamento_id'=> 'required|exists:departamentos,id',
            'municipio_id'=> 'required|exists:municipios,id',
    
        ];
        $mensaje = [
            'nombreOficina.required' =>'Debe escoger un nombre para la oficina, no puede estar vacío.',
            'nombreOficina.regex' =>'El nombre de la oficina debe iniciar con mayúscula y solo permite un espacio entre los nombres.',

            'direccion.required' =>'La dirección es obligatoria, no puede estar vacío.', 
            'direccion.regex' =>'La dirección permite mínimo 10 y máximo 150 palabras.',

            'nombreGerente.required' =>'El nombre del gerente es obligatorio, no puede estar vacío.', 
            'nombreGerente.regex' =>'Debe iniciar con mayúscula cada palabra, solo permite un espacio entre los nombres y no se admiten números.',

            'telefono.required' =>'El teléfono es obligatorio, no puede estar vacío.',
            'telefono.numeric' =>'El teléfono no puede contener letras.',
            'telefono.digits' =>'El teléfono debe contener 8 dígitos.',
            'telefono.regex' =>'El teléfono solo puede iniciar con los siguientes dígitos: 2, 3, 8 ó 9. ',

            'departamento_id.required' => 'Debe seleccionar un departamento, no puede estar vacío.',
            'departamento_id.exists'=> 'El departamento seleccionado no existe', 
            'municipio_id.required' => 'Debe seleccionar un municipio, no puede estar vacío.', 
            'municipio_id.exists'=> 'El municipio seleccionado no forma parte del departamento seleccionado.', 

        ];
        $this->validate($request, $reglas, $mensaje);


        $oficina = new Oficina();

        $oficina->nombreOficina = $request->nombreOficina;
        $oficina->direccion = $request->direccion;
        $oficina->nombreGerente = $request->nombreGerente;
        $oficina->telefono = $request->telefono;
        $oficina->departamento_id = $request->departamento_id;
        $oficina->municipio_id = $request->municipio_id;

        $create = $oficina->save();
        
        if ($create){
            return redirect()->route('oficina.index')
            ->with('mensaje', 'Se guardó el registro de la nueva oficina correctamente');
        } 
    }
    

        /* $conexion=mysqli_connect('localhost', 'root', '', 'proyectoInconsag');
        $departamento= $_POST['departamento'];
        $sql="SELECT id, nombreD, nombreM from  municipios where departamento_id = '$departamento'";
        $result= mysqli_query($conexion, $departamento);
        $cadena = "<label>Municipios</label> 
        <select id='lista2' name= 'lista2'>";

        while ($ver=mysqli_fetch_row($result)){
            $cadena= $cadena.'<option value='.$ver[0].'>'.utf8_encode($ver[2]).'</option>';
        }
        echo $cadena."</select>";*/
    
    public function edit($id){
        
        $oficina = Oficina::findOrFail($id);
        $departamentos = Departamento::orderBy('nombreD')->get();
        $municipios = Municipio::all();
        

        return view('oficina.edit', compact('departamentos', 'municipios'))->with('oficina', $oficina);
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            
            'nombreOficina' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1})([a-záéíóúñ]+\s{0,1}([0-9]{0,15}?))+$/u'],
            'direccion'     => ['required','regex:/^.{10,150}$/u'],
            'nombreGerente' => ['required','regex:/^([A-ZÁÉÍÓÚÑ]{1}[a-záéíóúñ]+\s{0,1})+$/u',],
            'telefono'      => ['required','numeric','digits:8','regex:/^[(2)(3)(8)(9)][0-9]/','unique:oficinas,telefono,'.$id.'id'],
            'departamento_id'=> ['required','exists:departamentos,id'],
            'municipio_id'=> ['required','exists:municipios,id'],
        ],[
            'nombreOficina.required' => 'Debe escoger un nombre para la oficina, no puede estar vacío.',
            'nombreOficina.regex' =>'El nombre de la oficina debe iniciar con mayúscula y solo permite un espacio entre los nombres.',


            'direccion.required' => 'La dirección es obligatoria, no puede estar vacío.', 
            'direccion.regex' => 'La dirección permite mínimo 10 y máximo 150 palabras.',

            'nombreGerente.required' => 'El nombre del gerente es obligatorio, no puede estar vacío.', 
            'nombreGerente.regex' => 'Debe iniciar con mayúscula cada palabra, solo permite un espacio entre los nombres y no se admiten números.',

            'telefono.required' =>  'El teléfono es obligatorio, no puede estar vacío.',
            'telefono.numeric' => 'El teléfono no puede contener letras.',
            'telefono.digits' => 'El teléfono debe contener 8 dígitos.',
            'telefono.regex' => 'El teléfono solo puede iniciar con los siguientes dígitos: 2, 3, 8 ó 9. ',

            'departamento_id.required' => 'Debe seleccionar un departamento, no puede estar vacío.',
            'departamento_id.exists'=> 'El departamento seleccionado no existe', 
            'municipio_id.required' => 'Debe seleccionar un municipio, no puede estar vacío.',
            'municipio_id.exists'=> 'El municipio seleccionado no forma parte del departamento seleccionado.', 


    
        ]);
        
        $oficina = Oficina::findOrFail($id);

        $oficina->nombreOficina= $request->input('nombreOficina');
        $oficina->direccion = $request->input('direccion');
        $oficina->nombreGerente = $request->input('nombreGerente');
        $oficina->telefono = $request->input('telefono');
        $oficina->departamento_id = $request->departamento_id;
        $oficina->municipio_id = $request->municipio_id;
        
        $update = $oficina->save();
        
        if ($update){
            return redirect()->route('oficina.index')
            ->with('mensajeW', 'Se actualizó el registro de la oficina correctamente');
        } 
    }

    public function getMunicipios($id){
        $municipios = Municipio::where('departamento_id', '=', $id)->get();
        return response()->json($municipios);
    }

    public function getMunicipioss($id){
        $municipios = Municipio::where('departamento_id', '=', $id)->get();
        return $municipios;
    }
}

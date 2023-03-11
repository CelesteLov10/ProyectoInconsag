<?php

namespace App\Http\Controllers;

use App\Models\Casa;
use App\Models\Image;
use App\Models\Constructora;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\File;

class CasaController extends Controller
{
    public function index(){
    $casa = Casa::query()
    ->when(request('search'), function($query){
    return $query->where('claseCasa', 'LIKE', '%' .request('search') .'%');
    })->orWhereHas('constructora', function($q){
        $q->where('nombreConstructora','LIKE', '%' .request('search') .'%');
    })->orderBy('id','desc')->paginate(10)->withQueryString();
    $constructora = Constructora::all();
    return view('casa.index', compact('casa', 'constructora'));
    }

    public function create(){
        $casa = Casa::all();
        $constructora = Constructora::all();
        return view('casa.create', compact('constructora'))->with('casa', $casa);
    }

    public function store(Request $request){
            $this->validate($request,[
                'claseCasa' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u','unique:casas'],
                'valorCasa' => ['required','min:100000', 'numeric'],
                'cantHabitacion' => ['required','numeric','min:1','max:5','regex:/^[0-9]{1,5}/u'],
                'descripcion' => ['required', 'min:10','max:150'],
                'constructora_id' => ['required'],
            
            ],[

            'claseCasa.required' => 'El nombre del modelo de la casa es obligatorio, no puede estar vacío.',
            'claseCasa.regex' => 'El nombre de la casa no permite números.',

            'valorCasa.required' => 'El valor de la casa es obligatorio, no puede estar vacío.',
            'valorCasa.numeric' => 'El valor de la casa debe contener sólo números.',
            'valorCasa.min' => 'El valor de la casa no debe ser menor de 100,000.',

            'cantHabitacion.required' => 'La cantidad de habitaciones es obligatorio, no puede estar vacío.',
            'cantHabitacion.numeric' => 'El valor de la casa debe contener sólo números.',
            'cantHabitacion.min' => 'El mínimo de habitaciones es 1.',
            'cantHabitacion.max' => 'La cantidad de habitaciones no debe de exceder de 5.',

            'descripcion.required' => 'La descripción es obligatoria, no puede estar vacío.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'constructora_id.required'=> 'La contructora es obligatoria, no puede estar vacío.',

            'subirCasa.required'=> 'La foto de la casa modelo es obligatoria, no puede estar vacío.',
            ]);

            $input = $request->all();
            // $casa = new Casa();
            // if($request->hasFile('subirCasa') ){
            //     $file = $request->file('subirCasa');
            //     $destinationPath = 'public/imagenes/';
            //     $filename = time() . '-' . $file->getClientOriginalName();
            //     $uploadSuccess = $request->file('subirCasa')->move($destinationPath, $filename);
            //     $casa->subirCasa = $destinationPath . $filename;
            // };

            $casa = new Casa([
                "claseCasa"=>$request->claseCasa,
                "valorCasa"=>$request->valorCasa,
                "cantHabitacion"=>$request->cantHabitacion,
                "descripcion"=>$request->descripcion,
                "constructora_id"=>$request->constructora_id,
            ]);
            $casa->save();

            if ($request->hasFile("images")) {
                $files=$request->file("images");
                foreach($files as $file){
                    $imageName=time().'_'.$file->getClientOriginalName();
                    $request['casa_id']=$casa->id;
                    $request['image']=$imageName;
                    $file->move(\public_path('/images'), $imageName);
                    Image::create($request->all());
                }
            }
            
            //Casa::create($input);
                return redirect()->route('casa.index')
                ->with('mensaje', 'Se guardó el registro de la nueva casa modelo correctamente');         
         /** redireciona una vez enviado  */
    }
    
    public function show($id){
        $casa = Casa::findOrFail($id);
        return view('casa.show', compact('casa'));
    }

    public function edit($id){
        $casa = Casa::findOrFail($id);
        $constructora = Constructora::all();
        $images = Image::findOrFail($id);
        return view('casa.edit', compact('constructora','images'))->with('casa', $casa);
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'claseCasa' => ['required','regex:/^([A-ZÁÉÍÓÚÑa-záéíóúñ]+\s{0,1})+$/u','unique:casas,claseCasa,'.$id.'id'],
            'valorCasa' => ['required','min:100000', 'numeric'],
            'cantHabitacion' => ['required','numeric','min:1','max:5','regex:/^[0-9]{1,5}/u'],
            'descripcion' => ['required', 'min:10','max:150'],
            'constructora_id' => ['required'],
        ],[
            'claseCasa.required' => 'El nombre del modelo de la casa es obligatorio, no puede estar vacío.',
            'claseCasa.regex' => 'El nombre de la casa no permite números.',

            'valorCasa.required' => 'El valor de la casa es obligatorio, no puede estar vacío.',
            'valorCasa.numeric' => 'El valor de la casa debe contener sólo números.',
            'valorCasa.min' => 'El valor de la casa no debe ser menor de 100,000.',

            'cantHabitacion.required' => 'La cantidad de habitaciones es obligatoria, no puede estar vacío.',
            'cantHabitacion.numeric' => 'El valor de la casa debe contener sólo números.',
            'cantHabitacion.min' => 'El mínimo de habitaciones es 1.',
            'cantHabitacion.max' => 'La cantidad de habitaciones no debe de exceder de 5.',

            'descripcion.required' => 'La descripción es obligatoria, no puede estar vacío.',
            'descripcion.min' => 'La descripción es muy corta. Ingrese entre 10 y 150 caracteres',
            'descripcion.max' => 'La descripción sobrepasa el límite de caracteres',

            'constructora_id.required'=> 'La contructora es obligatoria, no puede estar vacio',
            'subirCasa.required'=> 'La foto de la casa modelo es obligatoria, no puede estar vacio',
        ]);

        $casa = Casa::findOrFail($id);

        $casa->claseCasa = $request->input('claseCasa');
        $casa->valorCasa = $request->input('valorCasa');
        $casa->cantHabitacion = $request->input('cantHabitacion');
        $casa->descripcion = $request->input('descripcion');
        $casa->constructora_id = $request->input('constructora_id');
        

        if($request->hasFile("images")){
            $files=$request->file("images");
            foreach($files as $file){
                $imageName=time().'_'.$file->getClientOriginalName();
                $request["casa_id"]=$id;
                $request["image"]=$imageName;
                $file->move(\public_path("images"),$imageName);
                Image::create($request->all());
            }
        }
        $casa->save();

        return redirect()->route('casa.index')
            ->with('mensajeW', 'Se actualizó la casa correctamente');
    }

    public function deleteimage($id){
        $images = Image::findOrFail($id);
        if(File::exists("images/".$images->image)){
            File::delete("images/".$images->image);
        }
        Image::find($id)->delete();
        return back();
    }

}

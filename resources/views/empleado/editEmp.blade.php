@extends('layout.plantillaH')

@section('titulo', 'Actualizar empleado')
    
@section('contenido') 

    <h4 class=" text-center">
      <strong>Actualización de un empleado laboral</strong> 
      
    </h4>
</div>

<div class="container ">
    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary" >Actualización de Empleado
            <a class="btn btn-outline-info btn-sm justify-content-md-end "href="{{route('empleado.indexEmp')}}">Atrás</a>   
          </h6 > 
      </div >
    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
      <div class="col-60 bg-light p-5">   
    <form action="{{route('empleado.update', $empleado)}}" id="formu" class="empleado-actualizar" method="POST">
        <!-- metodo put para que guarde los cambios en la base de datos-->
        @method('put')

        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Identidad:</label>
        <div class="col-sm-5">
          <input type="text" autofocus class="form-control rounded-pill" 
          placeholder="Ingrese la identidad del empleado" name="identidad"
          value="{{old('identidad', $empleado->identidad)}}">
            @error('identidad')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombres:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese los nombres" name="nombres"
          value="{{old('nombres', $empleado->nombres)}}">
          @error('nombres')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Apellidos:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese los apellidos" 
          name="apellidos">{{old('apellidos', $empleado->apellidos)}}</textarea>
        @error('apellidos')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>



      
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese el teléfono" name="telefono"
          value="{{old('telefono', $empleado->telefono)}}">
          @error('telefono')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      
        <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Estado:</label>
        <div class="col-sm-5">
        <select class="form-select rounded-pill" name="estado">
            @foreach ($estado as $estados)
                <option value="{{old('nombreE',$estados->id)}}">{{$estados->nombreE}}</option>
            @endforeach
            @error('estado')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
    </select>
        </div>
        </div>
        

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Correo:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese el correo electrónico" 
          name="correo">{{old('correo', $empleado->correo)}}</textarea>
        @error('correo')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese la fecha de nacimiento" 
          name="fechaNacimiento">{{old('fechaNacimiento', $empleado->fechaNacimiento)}}</textarea>
        @error('fechaNacimiento')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>


      
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese la dirección" name="direccion"
          value="{{old('direccion', $empleado->direccion)}}">
          @error('direccion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de ingreso:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese la fecha de ingreso" 
          name="fechaIngreso">{{old('fechaIngreso', $empleado->fechaIngreso)}}</textarea>
        @error('fechaIngreso')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del cargo</label>
        <div class="col-sm-5">
        <select name="puesto_id" id="" class="form-select rounded-pill">
            @foreach ($puesto as $puestos)
            <option value="{{old('nombreCargo',$puestos->id)}}">{{$puestos->nombreCargo}}</option>
              
            @endforeach
            @error('nombreCargo')
            <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </select>
        </div>
          </div>
        
       
      
      <br>
      <br>

      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button type="submit" class="btn btn-outline-info" >
            Actualizar
          </button> 
      {{-- onclick="actualizar()"  --}}
    

          {{-- Boton para restablecer los valores de los campos --}}
          <button type="reset" form="formu" class="btn btn-outline-danger">
            Restablecer
          </button> 
          
        </div>
      </div>   
    </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
      {{-- formulario para edicion --}}
          <script>
            function empleadoEdit(id){
                var formData = new formData(document.getElementById('empleado'));
                formData.append('id', id);
                axios({
                    method : 'post', 
                    url: 'editEmp',
                    data: formData,
                    headers:{
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response){
                    var contentdiv = document.getElementById('mycontent');
                    empleado.id.value = response.data["id"];
                    empleado.nombres.value = response.data["nombres"];
                    empleado.apellidos.value = response.data["apellidos"];
                    empleado.telefono.value = response.data["telefono"];
                    empleado.correo.value = response.data["correo"];
                    empleado.direccion.value = response.data["direccion"];
                    empleado.fechaIngreso.value = response.data["fechaIngreso"];
                })
                .then(function(response){
                    var contentdiv = document.getElementById('mycontent');
                    contentdiv.innerHTML = response.data;
                })
                .catch(function(response){
                    console.log(response);
                })
            }

          </script>
@endsection 
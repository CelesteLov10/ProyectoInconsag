@extends('layout.plantillaH')

@section('titulo', 'Actualizar puesto')
    
@section('contenido') 

<div class="mb-5">
      <h4 class=" text-center">
        <strong>Actualización de un puesto laboral</strong> 
      </h4>
</div>

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('puestoLaboral.index')}}">Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-primary" >Actualización del puesto laboral </h5 > 
      </div >
    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
      <div class="col-60 bg-light p-5">   
    <form action="{{route('puestoLaboral.update', $puesto)}}" id="form1" class="puesto-actualizar" method="POST">
        <!-- metodo put para que guarde los cambios en la base de datos-->
        @method('put')

        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del cargo:</label>
        <div class="col-sm-5">
          <input type="text" autofocus class="form-control rounded-pill" 
          placeholder="Ingrese un cargo" name="nombreCargo"
          value="{{old('nombreCargo', $puesto->nombreCargo)}}">
            @error('nombreCargo')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Sueldo:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese una cantidad" name="sueldo"
          value="{{old('sueldo', $puesto->sueldo)}}" maxlength="7">
          @error('sueldo')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Descripción:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese una descripción" 
          name="descripcion">{{old('descripcion', $puesto->descripcion)}}</textarea>
        @error('descripcion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>
      <br>
      <br>

      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button class="btn btn-outline-info" onclick="actualizar()">
            Actualizar
          </button> 
      {{-- onclick="actualizar()"  --}}
    

          {{-- Boton para restablecer los valores de los campos --}}
          <button type="reset" form="form1" class="btn btn-outline-danger">
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
@endsection
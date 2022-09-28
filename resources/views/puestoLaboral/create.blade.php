@extends('layout.plantillaH')

@section('titulo', 'Nuevo Puesto')
    
@section('contenido')

<div class="mb-5">
    <h4 class=" text-center">
      <strong>Creación de un nuevo puesto laboral</strong> 
    </h4>
</div>
<div class="container ">
    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('puestoLaboral.store')}}" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre Cargo:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese un cargo" name="nombreCargo" value="{{old('nombreCargo')}}">
            @error('nombreCargo')
               <small>*{{$message}}</small>
            @enderror
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Sueldo:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese una cantidad" name="sueldo" value="{{old('sueldo')}}">
          @error('sueldo')
           <small>*{{$message}}</small>
          @enderror
        </div>
      </div>
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Descripcion:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" placeholder="Ingrese una descripcion" name="descripcion">
            {{old('descripcion')}}
         </textarea>
         @error('descripcion')
          <small>*{{$message}}</small>
         @enderror
        </div>
      </div>
      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button type="submit" class="btn btn-primary">Guardar</button> 
        </div>
      </div>  
    </form>
      </div>
    </div>
  </div>
@endsection
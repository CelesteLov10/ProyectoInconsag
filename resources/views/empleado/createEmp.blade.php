@extends('layout.plantillaH')

@section('titulo', 'Nuevo Empleado')
    
@section('contenido') 

<div class="mb-5">
    <h4 class=" text-center">
      <strong>Creación de un nuevo empleado</strong> 
    </h4>
</div>
<div class="container ">

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary" >Creación Empleado </h6 > 
      </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('empleado.store')}}" class="empleado-guardar" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Identidad:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese la identidad" name="identidad" value="{{old('identidad')}}">
            @error('identidad') value="{{old('identidad')}}">
               <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombres: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese los nombres" 
          name="nombres" value="{{old('nombres')}}">
          @error('nombres')
           <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Apellidos: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese los apellidos" 
          name="apellidos" value="{{old('apellidos')}}">
          @error('apellidos')
           <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el teléfono"
          name="telefono" value="{{old('telefono')}}">
         @error('telefono')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
         @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Correo: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el correo"
          name="correo" value="{{old('correo')}}">
         @error('correo')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
         @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de nacimiento: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese la fecha de nacimiento"
          name="fechaNacimiento" value="{{old('fechaNacimiento')}}">
         @error('fechaNacimiento')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
         @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese la dirección"
          name="direccion" value="{{old('direccion')}}">
         @error('direccion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
         @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de ingreso: </label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese la fecha de ingreso"
          name="fechaIngreso" value="{{old('fechaIngreso')}}">
         @error('fechaIngreso')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
         @enderror
        </div>
      </div>
      
      
      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button type="submit" class="btn btn-outline-info">Guardar</button> 
        </div>
      </div>  
    </form>
      </div>
    </div>
  </div>
@endsection
@section('js')
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
       {{-- Scrip de alert cuando se presione guardar 
           <script> 
              function guardar(){
                window.alert('El registro se guardó exitosamente');
                } 
           </script>
           --}}
@endsection
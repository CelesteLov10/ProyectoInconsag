@extends('layout.plantillaH')

@section('titulo', 'Nuevo proveedor')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
    
@section('contenido') 


<div class="mb-5">
    <h4 class=" text-center">
      <strong>Creación de un nuevo prooveedor</strong> 
    </h4>
</div>

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('proveedor.index')}}">Atrás</a>
</div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary">Creación de proveedor</h6 > 
      </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('proveedor.store')}}" class="proveedor-guardar" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}


      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del proveedor:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el nombre del proveedor" 
          name="nombres" value="{{old('nombres')}}" maxlength="40">
          @error('nombres')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del contacto:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el nombre del contacto" 
          name="apellidos" value="{{old('apellidos')}}" maxlength="40">
          @error('apellidos')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Cargo del contacto:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el cargo del contacto" 
          name="apellidos" value="{{old('apellidos')}}" maxlength="50">
          @error('apellidos')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>
      
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" maxlength="100" placeholder="Ingrese la dirección"
          name="direccion" value="">{{old('direccion')}}</textarea>
        @error('direccion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Ciudad:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese la ciudad"
          name="correo" value="{{old('correo')}}" maxlength="40">
        @error('correo')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el numero de teléfono"
          name="telefono" value="{{old('telefono')}}" maxlength="8">
        @error('telefono')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Correo:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el correo electrónico"
          name="correo" value="{{old('correo')}}" maxlength="40">
        @error('correo')
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
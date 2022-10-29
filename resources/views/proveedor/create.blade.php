@extends('layout.plantillaH')

@section('titulo', 'Nuevo proveedor')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
    
@section('contenido') 

<div>
  <div class="mb-5 m-5">
      <h2 class=" text-center">
        <strong>Registro de un nuevo proveedor</strong> 
      </h2>
  </div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('proveedor.index')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 bg-success bg-gradient" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white">Creación de proveedor</h5 > 
        </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('proveedor.store')}}" class="proveedor-guardar" method="POST">
          @csrf {{-- TOKEN INPUT OCULTO --}}


        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del proveedor:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('nombreProveedor') is-invalid @enderror" 
            placeholder="Ingrese el nombre del proveedor" 
            name="nombreProveedor" value="{{old('nombreProveedor')}}" maxlength="40">
            @error('nombreProveedor')
            <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del contacto:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('nombreContacto') is-invalid @enderror" 
            placeholder="Ingrese el nombre del contacto" 
            name="nombreContacto" value="{{old('nombreContacto')}}" maxlength="40">
            @error('nombreContacto')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Cargo del contacto:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('cargoContacto') is-invalid @enderror" 
            placeholder="Ingrese el cargo del contacto" 
            name="cargoContacto" value="{{old('cargoContacto')}}" maxlength="50">
            @error('cargoContacto')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Dirección:</label>
          <div class="col-sm-5">
            <textarea type="text" class="form-control rounded-pill  @error('direccion') is-invalid @enderror" 
            maxlength="150" placeholder="Ingrese la dirección"
            name="direccion" value="">{{old('direccion')}}</textarea>
          @error('direccion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Teléfono:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('telefono') is-invalid @enderror" 
            placeholder="Ingrese el numero de teléfono"
            name="telefono" value="{{old('telefono')}}" maxlength="8">
          @error('telefono')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Correo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('email') is-invalid @enderror" 
            placeholder="Ingrese el correo electrónico"
            name="email" value="{{old('email')}}" maxlength="40">
          @error('email')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
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
</div>
@endsection
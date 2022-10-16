@extends('layout.plantillaH')

@section('titulo', 'Nueva Oficina')
    
@section('contenido') 

<div class="mb-5">
    <h4 class=" text-center">
      <strong>Creación de una nueva oficina</strong> 
    </h4>
</div>
<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary"  href="{{route('puestoLaboral.index')}}">Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary" >Creación nueva oficina </h6 > 
      </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('oficina.store')}}" class="puesto-guardar" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre de la oficina:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el nombre que tendrá la oficina" name="nombreOficina" value="{{old('nombreOficina')}}">
            @error('nombreOficina')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Municipio:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el municipio que pertenece la oficina" 
          name="municipio" value="{{old('municipio')}}">
          @error('municipio')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" placeholder="Ingrese la dirección de la oficina " name="direccion">{{old('direccion')}}</textarea>
        @error('direccion')
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
@endsection
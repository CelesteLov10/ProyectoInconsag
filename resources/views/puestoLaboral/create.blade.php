@extends('adminlte::page')

@section('title', 'Nuevo puesto')

@section('content_header')
    <h1 class="blog-header-logo text-dark">Registro de un nuevo puesto laboral</h1>
    <hr>
@stop

@section('content')

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('puestoLaboral.index')}}">
        <i class="bi bi-box-arrow-in-left"></i>Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura">
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Creación puesto </h5 > 
        </div >

      <div class=" m-0 text-center align-items-center justify-content-center">
          <div class="bg-light p-5">
      <form action="{{route('puestoLaboral.store')}}" class="puesto-guardar" method="POST" autocomplete="off">
          @csrf {{-- TOKEN INPUT OCULTO --}}
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del cargo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('nombreCargo') is-invalid @enderror" 
            placeholder="Ingrese el nombre del cargo" name="nombreCargo" maxlength="50" value="{{old('nombreCargo')}}">
              @error('nombreCargo')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Sueldo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('sueldo') is-invalid @enderror" 
            placeholder="0.00" name="sueldo" value="{{old('sueldo')}}" maxlength="7">
            @error('sueldo')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Descripción:</label>
          <div class="col-sm-5">
            <textarea type="text" maxlength="150" class="form-control rounded-pill @error('descripcion') is-invalid @enderror" 
            placeholder="Ingrese una descripción del puesto" name="descripcion">{{old('descripcion')}}</textarea>
          @error('descripcion')
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop
@can('Admin.puestoLaboral.edit')
@extends('adminlte::page')

@section('title', 'Actualizar puesto')

@section('content_header')
        <h3 class="blog-header-logo text-dark">Actualización del puesto laboral</h3>
      <hr>
@stop

@section('content')
<div>
  
  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('puestoLaboral.index')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura">
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Actualización del puesto laboral </h5 > 
        </div >
      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">   
      <form action="{{route('puestoLaboral.update', $puesto)}}" id="form1" class="puesto-actualizar" method="POST" autocomplete="off">
          <!-- metodo put para que guarde los cambios en la base de datos-->
          @method('put')

          @csrf {{-- TOKEN INPUT OCULTO --}}
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del cargo:</label>
          <div class="col-sm-5">
            <input type="text" autofocus class="form-control rounded-pill @error('nombreCargo') is-invalid @enderror" 
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
            <input type="text" class="form-control rounded-pill @error('sueldo') is-invalid @enderror" 
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
            <textarea type="text" class="form-control rounded-pill @error('descripcion') is-invalid @enderror" 
            placeholder="Ingrese una descripción" maxlength="150"
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
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
@stop
@endcan
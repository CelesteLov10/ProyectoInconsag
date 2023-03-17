@extends('adminlte::page')

@section('title', 'Nuevo')

@section('content_header')
    <h1>Registro de un nuevo gasto</h1>
    <hr>
@stop

@section('content')

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('gasto.index')}}">
      <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
</div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 btaura" >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Registro de un nuevo gasto</h5 > 
      </div >

      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">
    <form action="{{route('gasto.store')}}" id="d" class="casa-guardar" method="POST" autocomplete="off"
      enctype="multipart/form-data">
        @csrf {{-- TOKEN INPUT OCULTO --}}
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del gasto:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('nombreGastos') is-invalid @enderror" 
          placeholder="Ingrese el nombre del gasto. Ejem. 'Papelería'" 
          name="nombreGastos" value="{{old('nombreGastos')}}" maxlength="50">
          @error('nombreGastos')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Monto del gasto:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill  @error('montoGastos') is-invalid @enderror" 
          placeholder="Ingrese el valor de la factura."
          name="montoGastos" value="{{old('montoGastos')}}" maxlength="4">
        @error('montoGastos')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre de la empresa:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill  @error('nombreEmpresa') is-invalid @enderror" 
          placeholder="Ingrese el nombre de la empresa. "
          name="nombreEmpresa" value="{{old('nombreEmpresa')}}" maxlength="50">
        @error('nombreEmpresa')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      
      <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Fecha del gasto:</label>
          <div class="col-sm-5">
              <input type="text" class="border border-0 form-control rounded-pill @error('fechaGastos') is-invalid @enderror" 
              maxlength="10" placeholder="Fecha actual"
              name="fechaGastos" autocomplete="off" value="<?php echo date("Y-m-d");?>" readonly=»readonly» style="background-color: rgba(206, 206, 206, 0)" > 
                  @error('fechaGastos')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Descripción:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill  @error('descripcion') is-invalid @enderror" 
          maxlength="150" placeholder="Ingrese la descripción del gasto"
          name="descripcion" value="">{{old('descripcion')}}</textarea>
        @error('descripcion')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row"> 
          <label class="col-sm-3 col-form-label">Nombre del empleado encargado:</label>
          <div class="col-sm-5">
          <select name="empleado_id" id="" class="form-select form-control rounded-pill  @error('empleado_id') is-invalid @enderror">
              <option value="" disabled selected>-- Seleccione un nombre de empleado --</option>
              @foreach ($empleado as $empleados)
              <option value="{{$empleados->id}}" 
                  {{old('empleado_id' , $empleados->nombres)==$empleados->id ? 'selected' : ''}}>{{$empleados->nombres}} {{$empleados->apellidos}}</option>
              @endforeach
          </select> 
          @error('empleado_id')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
      </div>
      <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Subir foto del recibo:</label>
          <div class="col-sm-5">
              <input accept="image/*" type="file" id="baucherRecibo" class="form-control rounded-pill  @error('baucherRecibo') is-invalid @enderror" 
                  name="baucherRecibo" value="{{old('baucherRecibo')}}" >
                  @error('baucherRecibo')
                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
                  <div ><small class="text-danger" id="myElement" ></small></div>
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
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    {{-- plugins para el calendario --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
@stop

@section('js')
      {{-- plugins para el calendario fechas jquery ui --}}
      <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
@stop


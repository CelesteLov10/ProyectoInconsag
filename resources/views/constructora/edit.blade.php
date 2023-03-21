@can('Admin.constructora.edit')
@extends('adminlte::page')

@section('title', 'Actualizar')

@section('content_header')
    <h1>Actualización de la constructora</h1>
    <hr>
@stop

@section('content')
<div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('constructora.index')}}">
        <i class="bi bi-box-arrow-in-left"></i>Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-black">Actualización de la constructora</h5 > 
        </div >
      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">   
      <form action="{{route('constructora.update', $constructoras)}}" id="formu" class="constructora-actualizar" method="POST" autocomplete="off">
          <!-- metodo put para que guarde los cambios en la base de datos-->
          @method('put')
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre de la Constructora:</label>
          <div class="col-sm-5">
            <input type="text" autofocus class="form-control rounded-pill @error('nombreConstructora') is-invalid @enderror" 
            placeholder="Ingrese el nombre de la constructora " name="nombreConstructora"
            value="{{old('nombreConstructora', $constructoras->nombreConstructora)}}"  maxlength="50">
              @error('nombreConstructora')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Dirección:</label>
            <div class="col-sm-5">
              <textarea type="text" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
              maxlength="150" placeholder="Ingrese la dirección" name="direccion"
              value="">{{old('direccion', $constructoras->direccion)}}</textarea>
              @error('direccion')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Teléfono:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
            placeholder="Ingrese el teléfono" name="telefono"
            value="{{old('telefono', $constructoras->telefono)}}" maxlength="8">
            @error('telefono')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Correo electrónico:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror" 
              maxlength="50" placeholder="Ingrese el correo electrónico" name="email"
              value="{{old('email', $constructoras->email)}}" >
              @error('email')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha del contrato:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fechaContrato') is-invalid @enderror" 
                maxlength="10" placeholder="Seleccione la fecha del contrato"
                name="fechaContrato" id="datepicker" autocomplete="off" value="{{old('fechaContrato', $constructoras->fechaContrato)}}">
            @error('fechaContrato')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
          </div>

        <div class="mb-3 row">
          <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-outline-warning" >Actualizar</button> 
        {{-- onclick="actualizar()"  --}}
            {{-- Boton para restablecer los valores de los campos --}}
            <button type="reset" form="formu" class="btn btn-outline-danger">Restablecer</button> 
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
    <link rel="stylesheet" href="/resources/demos/style.css">
@stop

@section('js')
    {{-- plugins para el calendario fechas jquery ui --}}
  <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


        {{-- calendario del segundo campo de fecha ingreso showOn: "both", buttonText: " " --}}
        <script>
          $( function() {
            $( "#datepicker" ).datepicker({
              dateFormat: "dd-mm-yy",
              changeMonth: true,
              changeYear: true,
              firstDay: 0,
                  monthNamesShort: ['Enero', 'Febrero', 'Marzo',
                  'Abril', 'Mayo', 'Junio',
                  'Julio', 'Agosto', 'Septiembre',
                  'Octubre', 'Noviembre', 'Diciembre'],
                  dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], 
                  
            });
          } );
        </script>
@stop
@endcan
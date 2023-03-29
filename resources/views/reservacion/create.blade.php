
@extends('adminlte::page')

@section('title', 'Nuevo')

@section('content_header')
    <h1>Registro de una nueva reservación</h1>
    <hr>
@stop

@section('content')

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('reservacion.index')}}">
      <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
</div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 btaura" >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Registro de una nueva reservación</h5 > 
      </div >

      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">
    <form action="{{route('reservacion.store')}}" id="d" class="reservacion-guardar" method="POST" autocomplete="off"
      enctype="multipart/form-data">
        @csrf {{-- TOKEN INPUT OCULTO --}}
    <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Nombre Cliente:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('nombreCliente') is-invalid @enderror" 
                    placeholder="Ingrese el nombre completo (ejem. Nataly Ximena Caballero Ferrera)" 
                    name="nombreCliente" value="{{old('nombreCliente')}}" maxlength="80">
                    @error('nombreCliente')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label  class="col-sm-3 col-form-label" for="identidadCliente">Identidad:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control  rounded-pill @error('identidadCliente') is-invalid @enderror"
                        maxlength="13" placeholder="ingrese el numero de identidad"
                            name="identidadCliente" id="identidadCliente" autocomplete="identidadCliente"
                        value="{{old('identidadCliente')}}" style="background-color: white">
                        @error('identidadCliente')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Teléfono:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
                    placeholder="Ingrese el número de teléfono"
                    name="telefono" value="{{old('telefono')}}" maxlength="8">
                    @error('telefono')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Correo electrónico:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill  @error('correoCliente') is-invalid @enderror" 
                    placeholder="Ingrese el correo electrónico. Ejem. 'pedro.perez@example.com'"
                    name="correoCliente" value="{{old('correoCliente')}}" maxlength="50">
                    @error('correoCliente')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Fecha Cita:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control rounded-pill @error('fechaCita') is-invalid @enderror" 
                        maxlength="10" placeholder="Seleccione la fecha de cita"
                        name="fechaCita" autocomplete="off" value="{{old('fechaCita')}}" id="datepicker"> 
                        @error('fechaCita')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Hora Cita:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control rounded-pill @error('horaCita') is-invalid @enderror" 
                        maxlength="10" placeholder="Seleccione la hora de cita"
                        name="horaCita" autocomplete="off" value="{{old('horaCita')}}" id="timepicker"> 
                        @error('horaCita')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
               
                   {{--<div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Encargado cita</label>
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
                </div> --}}

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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
@stop

@section('js')
      {{-- plugins para el calendario fechas jquery ui --}}
      <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
      <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

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
                maxDate: "2m",
                minDate: "-2m",
            });
            } );
        </script>
        <script>
          $( function() {
          $('#timepicker').timepicker({
      timeFormat: 'h:mm p',
      interval: 60,
      minTime: '08',
      maxTime: '6:00pm',
      defaultTime: '09',
      startTime: '08:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
  });
  } );
          </script>
@stop


  


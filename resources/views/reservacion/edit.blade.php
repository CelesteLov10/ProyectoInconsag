@can('Admin.reservacion.edit')
@extends('adminlte::page')

@section('title', 'Actualizar')

@section('content_header')
    <h1>Actualización de la reservación</h1>
    <hr>
@stop

@section('content')
<div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('reservacion.index')}}">
        <i class="bi bi-box-arrow-in-left"></i>Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-black">Actualización de la reservación</h5 > 
        </div >
      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">   
      <form action="{{route('reservacion.update', $reservacion)}}" id="formu" class="reservacion-actualizar" method="POST" autocomplete="off">
          <!-- metodo put para que guarde los cambios en la base de datos-->
          @method('put')
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre Cliente:</label>
          <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('nombreCliente') is-invalid @enderror" 
          placeholder="Ingrese el nombre completo (ejem. Nataly Caballero)" 
          name="nombreCliente" value="{{old('nombreCliente',$reservacion->nombreCliente)}}" maxlength="80">
          @error('nombreCliente')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
                </div>
                <div class="mb-3 row">
                    <label  class="col-sm-3 col-form-label" for="identidadCliente">Identidad:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control  rounded-pill @error('identidadCliente') is-invalid @enderror"
                        maxlength="13" placeholder="ingrese el número de identidad"
                            name="identidadCliente" id="identidadCliente" autocomplete="identidadCliente"
                            value="{{old('identidadCliente', $reservacion->identidadCliente)}}" style="background-color: white">
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
                    name="telefono" value="{{old('telefono', $reservacion->telefono)}}" maxlength="8">
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
                    name="correoCliente" value="{{old('correoCliente', $reservacion->correoCliente)}}" maxlength="50">
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
                        name="fechaCita" autocomplete="off" value="{{old('fechaCita', $reservacion->fechaCita)}}" id="datepicker"> 
                        @error('fechaCita')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Hora Cita:</label>
                  <div class="col-sm-5">
                        {{--<input type="hidden" class="form-control rounded-pill @error('horaCita') is-invalid @enderror" 
                      maxlength="7" placeholder="Seleccione la hora de cita"
                      name="horaCita" autocomplete="off" value="{{old('horaCita')}}" id="timepicker" > --}}
                      <select id="timepicker" class="form-control form-select rounded-pill @error('horaCita') is-invalid @enderror" 
                      name="horaCita" autocomplete="off" >
                      {{-- se muestra el registro guardado --}}
           <option value="{{$reservacion->horaCita}}" 
            {{old('horaCita' , $reservacion->horaCita)==$reservacion->horaCita ? 'selected' : ''}}>{{$reservacion->horaCita}}</option>
                          <option value="">seleccione la hora de la cita</option>{{-- Aquí no se como quitar eso cuando actualizo me lo muestra en las opciones del select--}}
                          <option value="09:00">9:00</option>
                          <option value="10:00">10:00</option>
                          <option value="11:00">11:00</option>
                          <option value="13:00">13:00</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                        </select>
                        @error('horaCita')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                     
                  </div>
              </div>

                {{--<div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Hora Cita:</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control rounded-pill @error('horaCita') is-invalid @enderror" 
                        maxlength="10" placeholder="Seleccione la hora de cita"
                        name="horaCita" autocomplete="off" value="{{old('horaCita', $reservacion->horaCita)}}" id="timepicker" > 
                        @error('horaCita')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>--}}
               
                {{--<div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Encargado cita</label>
                    <div class="col-sm-5">
                    <select name="empleado_id" id="" class="form-select form-control rounded-pill  @error('empleado_id') is-invalid @enderror">
                        <option value="" disabled selected>-- Seleccione un nombre de empleado --</option>
                        @foreach ($empleado as $empleados)
                        <option value="{{old('nombres', $empleados->id)}}"
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
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            maxDate: "1dd",
            minDate: "0m",
              
            });
            } );
        </script>
       {{-- <script>
          $( function() {
          $('#timepicker').timepicker({
      timeFormat: 'h:mm p',
      interval: 60,
      minTime: '08',
      maxTime: '6:00pm',
    
      startTime: '08:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
  });
  } );
          </script>--}}
          {{-- <script>
            const timepicker = document.getElementById("timepicker");
            
            // Deshabilitar opciones que no están permitidas
            for (let i = 0; i < timepicker.options.length; i++) {
              const option = timepicker.options[i];
              const value = option.value;
              const hour = parseInt(value.substring(0, 2), 10);
            
              if ((hour < 9 || hour >= 11) && (hour < 13 || hour >= 17)) {
                option.disabled = true;
              }
            }
            </script>--}}

           {{--ESTE SCRIPT SIRVE PARA QUE LAS HORAS QUE YA PASARON SE VAYAN QUITANDO DE LAS OPCIONES DISPONIBLES ACTUALES PARA HACER LA RESERVACION DE LA CITA--}}
            <script>
              function updateOptions() {
              var now = new Date();
              var hour = now.getHours();
              var select = document.getElementById("timepicker");
    
    // Iterar a través de las opciones del select y ocultar aquellas que ya han pasado
              for (var i = 0; i < select.options.length; i++) {
              var option = select.options[i];
              var optionHour = parseInt(option.value.split(":")[0]);
                if (optionHour < hour) {
                  option.style.display = "none";
                  } else {
                    option.style.display = "block";
                    }
                  }
                    }
  
  // Actualizar las opciones del select cada 5 minutos
         setInterval(updateOptions, 5 * 60 * 1000);
  
  // Ejecutar la función una vez al cargar la página
        updateOptions();
          </script>
@stop
@endcan

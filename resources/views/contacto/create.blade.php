@can('Admin.contacto.create')
@extends('adminlte::page')

@section('title', 'Nuevo')

@section('content_header')
    <h1>Nuevo mensaje</h1>
    <hr>
@stop

@section('content')

<div class="container ">


    {{-- encabezado  --}}
    <div class = " card shadow ab-4 btaura" >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Nuevo mensaje</h5 > 
      </div >

      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">
    <form action="{{route('contacto.store')}}" id="d" class="contacto-guardar" method="POST" autocomplete="off"
      enctype="multipart/form-data">
        @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fecha') is-invalid @enderror" 
                maxlength="10" placeholder="Fecha de su registro"
                name="fecha" autocomplete="off" value="<?php echo date("d-m-Y");?>" readonly style="background-color: rgba(206, 206, 206, 0)"> 
                  @error('fecha')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
        </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Nombres:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('nombre') is-invalid @enderror" 
                    placeholder="Ingrese su(s) nombre(s) (ejem. Linda María)" 
                    name="nombre" value="{{old('nombre')}}" maxlength="50">
                    @error('nombre')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Apellidos:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('apellido') is-invalid @enderror" 
                    placeholder="Ingrese su(s) apellido(s) (ejem. Rodríguez Nolasco)" 
                    name="apellido" value="{{old('apellido')}}" maxlength="50">
                    @error('apellido')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
         
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Teléfono:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
                    placeholder="Ingrese su número de teléfono"
                    name="telefono" value="{{old('telefono')}}" maxlength="8">
                    @error('telefono')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Correo electrónico:</label>
                    <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill  @error('correo') is-invalid @enderror" 
                    placeholder="Ingrese su correo electrónico. Ejem. 'pedro.perez@example.com'"
                    name="correo" value="{{old('correo')}}" maxlength="90">
                    @error('correo')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    </div>
                </div>

        

                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Mensaje:</label>
                    <div class="col-sm-5">
                        <textarea type="text" class="form-control rounded-pill @error('mensaje') is-invalid @enderror" 
                        maxlength="250" placeholder="Ingrese un mensaje personalizado." oninput="validateTextarea()" id="myTextarea"
                        name="mensaje" value="">{{old('mensaje')}}</textarea>
                    @error('mensaje')
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

<script>
  function validateTextarea() {
var textarea = document.getElementById("myTextarea");
var regex = /\.{2,}/g; // expresión regular para encontrar 2 o más puntos seguidos
if (regex.test(textarea.value)) {
textarea.value = textarea.value.replace(regex, "."); // reemplazar cualquier punto repetido con solo uno
}
}
</script>
@stop
@endcan


  


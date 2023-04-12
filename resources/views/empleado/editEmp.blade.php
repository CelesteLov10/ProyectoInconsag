@can('Admin.empleado.editEmp')
@extends('adminlte::page')

@section('title', 'Actualizar')

@section('content_header')
    <h1>Actualización de un empleado</h1>
    <hr>
@stop

@section('content')
  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('empleado.indexEmp')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Actualización del empleado</h5 > 
        </div >
      <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">   
      <form action="{{route('empleado.update', $empleado)}}" id="formu" class="empleado-actualizar" method="POST" autocomplete="off">
          <!-- metodo put para que guarde los cambios en la base de datos-->
          @method('put')
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Identidad:</label>
          <div class="col-sm-5">
            <input type="text" autofocus class="form-control rounded-pill @error('identidad') is-invalid @enderror" 
            placeholder="Ingrese la identidad del empleado" name="identidad"
            value="{{old('identidad', $empleado->identidad)}}"  maxlength="13">
              @error('identidad')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombres:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('nombres') is-invalid @enderror" 
            maxlength="30" placeholder="Ingrese los nombres" name="nombres"
            value="{{old('nombres', $empleado->nombres)}}" >
            @error('nombres')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>

        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Apellidos:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('apellidos') is-invalid @enderror" 
            maxlength="30" placeholder="Ingrese los apellidos" 
            name="apellidos" value="{{old('apellidos', $empleado->apellidos)}}">
          @error('apellidos')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Teléfono:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
            placeholder="Ingrese el teléfono" name="telefono"
            value="{{old('telefono', $empleado->telefono)}}" maxlength="8">
            @error('telefono')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Estado:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('estado') is-invalid @enderror" 
            placeholder="Ingrese el estado activo o inactivo"
            name="estado" value="{{old('estado', $empleado->estado)}}">
          @error('estado')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Correo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('correo') is-invalid @enderror" 
            maxlength="40" placeholder="Ingrese el correo electrónico" 
            name="correo" value="{{old('correo', $empleado->correo)}}">
          @error('correo')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fechaNacimieno') is-invalid @enderror" 
                maxlength="10" placeholder="Seleccione la fecha de nacimiento"
                name="fechaNacimiento" id="datepicker" autocomplete="off" value="{{old('fechaNacimiento', $empleado->fechaNacimiento)}}">
            @error('fechaNacimiento')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
          </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Dirección:</label>
          <div class="col-sm-5">
            <textarea type="text" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
            maxlength="150" placeholder="Ingrese la dirección" name="direccion"
            value="">{{old('direccion', $empleado->direccion)}}</textarea>
            @error('direccion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Fecha de ingreso:</label>
          <div class="col-sm-5">
              <input type="text" id="datepicker2" autocomplete="off" class="form-control rounded-pill @error('fechaIngreso') is-invalid @enderror" 
              maxlength="10" placeholder="Seleccione la fecha de ingreso"
              name="fechaIngreso" value="{{old('fechaIngreso', $empleado->fechaIngreso)}}">
          @error('fechaIngreso')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>
            
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del cargo:</label>
          <div class="col-sm-5">
          <select name="puesto_id" id="" class="form-select form-control rounded-pill @error('puesto_id') is-invalid @enderror">
              {{-- se muestra el registro guardado --}}
            <option value="{{$empleado->puesto_id}}" 
              {{old('puesto_id' , $empleado->puesto->nombreCargo)==$empleado->puesto->id ? 'selected' : ''}}>{{$empleado->puesto->nombreCargo}}</option>
                {{-- para que enliste los nombres del cargo --}}
                @foreach ($puesto as $puestos)
                <option value="{{old('nombreCargo', $puestos->id)}}"
                {{old('puesto_id' , $puestos->nombreCargo)==$puestos->id ? 'selected' : ''}}>{{$puestos->nombreCargo}}</option>
                @endforeach
          </select> 
          @error('puesto_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre de la oficina:</label>
          <div class="col-sm-5">
          <select name="oficina_id" id="" class="form-select form-control rounded-pill @error('oficina_id') is-invalid @enderror">
              {{-- se muestra el registro guardado --}}
            <option value="{{$empleado->oficina_id}}" 
              {{old('oficina_id' , $empleado->oficina->nombreOficina)==$empleado->oficina->id ? 'selected' : ''}}>{{$empleado->oficina->nombreOficina}}</option>
                {{-- para que enliste los nombres del cargo --}}
                @foreach ($oficina as $oficinas)
                <option value="{{old('nombreOficina', $oficinas->id)}}"
                {{old('oficina_id' , $oficinas->nombreOficina)==$oficinas->id ? 'selected' : ''}}>{{$oficinas->nombreOficina}}</option>
                @endforeach
          </select> 
          @error('puesto_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-outline-warning" >Actualizar </button> 
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
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    {{-- plugins para el calendario fechas jquery ui --}}
  <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script>
    var maximaFechaInicio = new Date();
    var minimoFechaInicio = new Date(maximaFechaInicio.getFullYear(), 
    maximaFechaInicio.getMonth(), maximaFechaInicio.getDate() -1000);
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
          yearRange: "-122:-18",
          maxDate: "-18Y",
          minDate: "-80Y"
    });
  } );
</script>
        {{-- calendario del segundo campo de fecha ingreso showOn: "both", buttonText: " " --}}
<script>
    $( function() {
      $( "#datepicker2" ).datepicker({
        dateFormat: "dd-mm-yy",
        firstDay: 0,
					monthNames: ['Enero', 'Febrero', 'Marzo',
					'Abril', 'Mayo', 'Junio',
					'Julio', 'Agosto', 'Septiembre',
					'Octubre', 'Noviembre', 'Diciembre'],
					dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          maxDate: "2m",
          minDate: "-2m",
      });//.datepicker("setDate", new Date());
    } );
</script>
@stop
@endcan
@extends('layout.plantillaH')

@section('titulo', 'Nuevo empleado')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@endsection
    
@section('contenido') 

<div class="mb-5">
    <h4 class=" text-center">
      <strong>Creación de un nuevo empleado</strong> 
    </h4>
</div>

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('empleado.indexEmp')}}">Atrás</a>
</div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary">Creación empleado</h6 > 
      </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('empleado.storeEmp')}}" class="empleado-guardar" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Identidad:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese la identidad" 
            name="identidad" value="{{old('identidad')}}">
            @error('identidad')
            <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombres:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese los nombres" 
          name="nombres" value="{{old('nombres')}}">
          @error('nombres')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Apellidos:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese los apellidos" 
          name="apellidos" value="{{old('apellidos')}}">
          @error('apellidos')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el numero de teléfono"
          name="telefono" value="{{old('telefono')}}">
        @error('telefono')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row form-group">
        <label class="col-sm-3 col-form-label">Estado:</label>
        <div class="col-sm-5 form">
          <select class="form-control form-select rounded-pill" name="estado">
            <option value="" disabled selected>-- Selecione un estado --</option>
            @foreach ($estados as $estado)
                <option value="{{$estado->id}}" 
                {{old('estado' , $estado->nombreE)==$estado->id ? 'selected' : ''}}>{{$estado->nombreE}}</option>
            @endforeach
          </select>
        @error('estado')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Correo:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el correo electrónico"
          name="correo" value="{{old('correo')}}">
        @error('correo')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Seleccione la fecha de nacimiento"
          name="fechaNacimiento" id="datepicker" autocomplete="off" value="{{old('fechaNacimiento')}}">
        @error('fechaNacimiento')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" placeholder="Ingrese la dirección"
          name="direccion" value="">{{old('direccion')}}</textarea>
        @error('direccion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de ingreso:</label>
        <div class="col-sm-5">
          <input type="text" id="datepicker2" autocomplete="off" class="form-control rounded-pill" placeholder="Seleccione la fecha de ingreso"
          name="fechaIngreso" value="{{old('fechaIngreso')}}">
        @error('fechaIngreso')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del cargo</label>
        <div class="col-sm-5">
        <select name="puesto_id" id="" class="form-select rounded-pill">
          <option value="" disabled selected>-- Selecione un cargo --</option>
            @foreach ($puesto as $puestos)
            <option value="{{$puestos->id}}" 
              {{old('puesto_id' , $puestos->nombreCargo)==$puestos->id ? 'selected' : ''}}>{{$puestos->nombreCargo}}</option>
            @endforeach
        </select> 
        @error('puesto_id')
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
					dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab']
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
          minDate: 0,
      });//.datepicker("setDate", new Date());
    } );
</script>
@endsection
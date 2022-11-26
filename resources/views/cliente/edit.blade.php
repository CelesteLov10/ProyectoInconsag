@extends('layout.plantillaH')

@section('titulo', 'Actualizar cliente')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('contenido') 
<div>
  <div class="mb-5 m-5">
      <h2 class=" text-center">
        <strong id="titulo">Actualización de un cliente</strong>  
      </h2>
  </div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('cliente.index')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 bg-success bg-gradient" >
        <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Actualización del cliente</h5 > 
        </div >
      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">   
      <form action="{{route('cliente.update', $cliente)}}" id="formu" class="cliente-actualizar" method="POST" autocomplete="off">
          <!-- metodo put para que guarde los cambios en la base de datos-->
          @method('put')
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Identidad:</label>
          <div class="col-sm-5">
            <input type="text" autofocus class="form-control rounded-pill @error('identidadC') is-invalid @enderror" 
            placeholder="Ingrese la identidad del cliente" name="identidadC"
            value="{{old('identidadC', $cliente->identidadC)}}"  maxlength="13">
              @error('identidadC')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre completo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('nombreCompleto') is-invalid @enderror" 
            maxlength="80" placeholder="Ingrese los nombres" name="nombreCompleto"
            value="{{old('nombreCompleto', $cliente->nombreCompleto)}}" >
            @error('nombreCompleto')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Teléfono:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
            placeholder="Ingrese el teléfono" name="telefono"
            value="{{old('telefono', $cliente->telefono)}}" maxlength="8">
            @error('telefono')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Dirección:</label>
          <div class="col-sm-5">
            <textarea type="text" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
            maxlength="150" placeholder="Ingrese la dirección" name="direccion"
            value="">{{old('direccion', $cliente->direccion)}}</textarea>
            @error('direccion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fechaNacimiento') is-invalid @enderror" 
                maxlength="10" placeholder="Seleccione la fecha de nacimiento"
                name="fechaNacimiento" id="datepicker" autocomplete="off" value="{{old('fechaNacimiento', $cliente->fechaNacimiento)}}">
            @error('fechaNacimiento')
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
                  yearRange: "-80:-18",
                  maxDate: "-18Y",
                  minDate: "-80Y"
            });
          } );
        </script>
@endsection 
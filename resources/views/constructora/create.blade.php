@extends('layout.plantillaH')

@section('titulo', 'Nueva constructora')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
@endsection
    
@section('contenido') 

  <div class="mb-5 m-5">
    <h3 class=" text-center">
      Registro de una nueva constructora
    </h3>
    <hr>
  </div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('venta.index')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white">Creación de una constructora</h5 > 
        </div >

        <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('constructora.store')}}" id="d" class="constructora-guardar" method="POST" autocomplete="off">
          @csrf {{-- TOKEN INPUT OCULTO --}}
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre de la constructora:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('nombreConstructora') is-invalid @enderror" 
            placeholder="Ingrese el nombre de la constructora. Ejem. 'Rios Larios S.A'" 
            name="nombreConstructora" value="{{old('nombreConstructora')}}" maxlength="50">
            @error('nombreConstructora')
            <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Dirección:</label>
          <div class="col-sm-5">
            <textarea type="text" class="form-control rounded-pill  @error('direccion') is-invalid @enderror" 
            maxlength="150" placeholder="Ingrese la dirección"
            name="direccion" value="">{{old('direccion')}}</textarea>
          @error('direccion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Teléfono:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('telefono') is-invalid @enderror" 
            placeholder="Ingrese el numero de teléfono. Ejem. 00000000"
            name="telefono" value="{{old('telefono')}}" maxlength="8">
          @error('telefono')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Correo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('email') is-invalid @enderror" 
            placeholder="Ingrese el correo electrónico. Ejem. 'john.smith@example.com'"
            name="email" value="{{old('email')}}" maxlength="50">
          @error('email')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Fecha de contrato:</label>
          <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('fechaContrato') is-invalid @enderror" 
              maxlength="10" placeholder="Seleccione la fecha del contrato de la constructora."
              name="fechaContrato" autocomplete="off" value="{{old('fechaContrato')}}" id="datepicker"> 
                @error('fechaContrato')
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
@endsection
@section('js')
    {{-- plugins para el calendario fechas jquery ui --}}
    <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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
@endsection
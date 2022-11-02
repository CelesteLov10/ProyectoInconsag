@extends('layout.plantillaH')

@section('titulo', 'Nueva maquinaria')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
<style>
    #mostrar{
        display: none;
    }

    #mostrarBoton{
        display: none;
    }
</style>
@endsection
    
@section('contenido') 

<div>
  <div class="mb-5 m-5">
      <h2 class=" text-center" >
        <strong id="titulo">Registro de una maquinaria</strong> 
      </h2>
  </div>


  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('maquinaria.index')}}"> 
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>


      {{-- encabezado  --}}
      <div class = " card shadow ab-4 bg-success bg-gradient" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Creación de maquinaria</h5> 
        </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('maquinaria.store')}}" id="p" class="maquinaria-guardar" method="POST">
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre de maquinaria:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('nombreMaquinaria') is-invalid @enderror" 
              placeholder="Ingrese el nombre de la maquinaria." 
              name="nombreMaquinaria" value="{{old('nombreMaquinaria')}}" maxlength="50">
              @error('nombreMaquinaria')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Modelo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('modelo') is-invalid @enderror" 
            placeholder="Ingrese el modelo." 
            name="modelo" value="{{old('modelo')}}" maxlength="30">
            @error('modelo')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Placa:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('placa') is-invalid @enderror" 
            placeholder="Ingrese el número de placa. Ejem. 'H" 
            name="placa" value="{{old('placa')}}" maxlength="8">
            @error('placa')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Cantidad:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill  @error('cantidaMaquinaria') is-invalid @enderror" 
                placeholder="Ingrese la cantidad de maquinaria. Ejem. 000" 
                    name="cantidadMaquinaria" value="{{old('cantidadMaquinaria')}}" maxlength="3">
                    @error('cantidadMaquinaria')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Descripción:</label>
            <div class="col-sm-5">
              <textarea type="text" class="form-control rounded-pill @error('descripcion') is-invalid @enderror" 
              maxlength="150" placeholder="Ingrese la descripción de la maquinaria."
              name="descripcion" value="">{{old('descripcion')}}</textarea>
            @error('descripcion')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
          </div>
        
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Fecha de compra:</label>
          <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('fechaCompra') is-invalid @enderror" 
              maxlength="10" placeholder="Seleccione la fecha de compra."
              name="fechaCompra" autocomplete="off" value="{{old('fechaCompra')}}" id="datepicker"> 
                @error('fechaCompra')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del proveedor:</label>
          <div class="col-sm-5">
          <select name="proveedor_id" id="" class="form-select rounded-pill @error('proveedor_id') is-invalid @enderror">
            <option value="" disabled selected>-- Selecione un proveedor --</option>
              @foreach ($proveedor as $proveedores)
              <option value="{{$proveedores->id}}" 
                {{old('proveedor_id' , $proveedores->nombreProveedor)==$proveedores->id ? 'selected' : ''}}>{{$proveedores->nombreProveedor}}</option>
              @endforeach
          </select> 
          @error('proveedor_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-2  form-check-inline">  
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="maquinariaPropia">
                    <label class="form-check-label" for="flexRadioDefault1">Maquinaria propia</label>
          </div>
          
          <div class="mb-3  form-check-inline"> 
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="maquinariaAlquilada">
                    <label class="form-check-label" for="flexRadioDefault1">Maquinaria Alquilada</label>
          </div>

          <div class="mb-3 row" id="mostrarBoton">
            <div class="offset-sm-3 col-sm-9">
              <button type="submit" class="btn btn-outline-info">Guardar</button> 
            </div>
          </div>  
        </form>
          </div>
        </div>
  
        {{--********************************* Maquinaria alquilada *********************************************************** --}}
          <div class="vh-50 row m-0 text-center align-items-center justify-content-center " id="mostrar">
            <div class="col-60 bg-light p-5">
        <form action="{{route('maquinaria.store')}}" id="p" class="maquinaria-guardar" method="POST">
            @csrf {{-- TOKEN INPUT OCULTO --}}
  
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre de maquinaria:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('nombreMaquinaria') is-invalid @enderror" 
                placeholder="Ingrese el nombre de la maquinaria." 
                name="nombreMaquinaria" value="{{old('nombreMaquinaria')}}" maxlength="50">
                @error('nombreMaquinaria')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
            </div>
          </div>
  
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Modelo:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('modelo') is-invalid @enderror" 
              placeholder="Ingrese el modelo." 
              name="modelo" value="{{old('modelo')}}" maxlength="30">
              @error('modelo')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>
  
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Placa:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('placa') is-invalid @enderror" 
              placeholder="Ingrese el número de placa. Ejem. 'H" 
              name="placa" value="{{old('placa')}}" maxlength="8">
              @error('placa')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>
  
          <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">Cantidad:</label>
              <div class="col-sm-5">
                  <input type="text" class="form-control rounded-pill  @error('cantidaMaquinaria') is-invalid @enderror" 
                  placeholder="Ingrese la cantidad de maquinaria. Ejem. 000" 
                      name="cantidadMaquinaria" value="{{old('cantidadMaquinaria')}}" maxlength="3">
                      @error('cantidadMaquinaria')
                      <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                      @enderror
              </div>
          </div>
  
          <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">Descripción:</label>
              <div class="col-sm-5">
                <textarea type="text" class="form-control rounded-pill @error('descripcion') is-invalid @enderror" 
                maxlength="150" placeholder="Ingrese la descripción de la maquinaria."
                name="descripcion" value="">{{old('descripcion')}}</textarea>
              @error('descripcion')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
              </div>
            </div>
          
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha de compra:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fechaCompra') is-invalid @enderror" 
                maxlength="10" placeholder="Seleccione la fecha de compra."
                name="fechaCompra" autocomplete="off" value="{{old('fechaCompra')}}" id="datepicker"> 
                  @error('fechaCompra')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
              </div>
          </div>
  
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre del proveedor:</label>
            <div class="col-sm-5">
            <select name="proveedor_id" id="" class="form-select rounded-pill @error('proveedor_id') is-invalid @enderror">
              <option value="" disabled selected>-- Selecione un proveedor --</option>
                @foreach ($proveedor as $proveedores)
                <option value="{{$proveedores->id}}" 
                  {{old('proveedor_id' , $proveedores->nombreProveedor)==$proveedores->id ? 'selected' : ''}}>{{$proveedores->nombreProveedor}}</option>
                @endforeach
            </select> 
            @error('proveedor_id')
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
@endsection

@section('js')
    {{-- plugins para el calendario fechas jquery ui 
          yearRange: "1960:2004",
          defaultDate: '01 ENE 2000',--}}
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
          minDate: "-2m"
    });
  } );
</script>

<script>
    var maquinariaAlquilada = document.getElementById("maquinariaAlquilada");

    maquinariaAlquilada.addEventListener("click",mostrar);
    //maquinariaAlquilada.addEventListener("click",ocultar);

    function mostrar(){
        document.getElementById('mostrar').style.display='block';
    }

    function ocultar(){
        document.getElementById('mostrar').style.display='none';
    }
</script>

<script>
    var maquinariaPropia = document.getElementById("maquinariaPropia");
    maquinariaPropia.addEventListener("click",mostrarBoton);
    
    function mostrarBoton(){
        document.getElementById('mostrarBoton').style.display='block';
    }
</script>

@endsection

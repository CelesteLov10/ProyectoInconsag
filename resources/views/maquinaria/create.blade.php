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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
      <form action="{{route('maquinaria.store')}}" id="form1" class="maquinaria-guardar" 
      name="formulario1" method="POST">
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
            placeholder="Ingrese el número de placa. Ejem. 'AAA0000'." 
            name="placa" value="{{old('placa')}}" maxlength="50">
            @error('placa')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        {{--<div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Cantidad de maquinaria:</label>
          <div class="col-sm-5">
              <input type="text" id="cantidad" class="form-control rounded-pill  @error('cantidad') is-invalid @enderror" 
              placeholder="Ingrese la cantidad de maquinaria alquilada. Ejem. 0000" 
                  name="cantidad" value="{{old('cantidad')}}" maxlength="4">
                  @error('cantidad')
                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
          </div>
        </div>--}}

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
          <label class="col-sm-3 col-form-label">Fecha de adquisición:</label>
          <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('fechaAdquisicion') is-invalid @enderror" 
              maxlength="10" placeholder="Seleccione la fecha de adquisición de la maquinaria."
              name="fechaAdquisicion" autocomplete="off" value="{{old('fechaAdquisicion')}}" id="datepicker"> 
                @error('fechaAdquisicion')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Nombre del proveedor:</label>
          <div class="col-sm-5">
          <select name="proveedor_id" id="" class="form-select rounded-pill @error('proveedor_id') is-invalid @enderror">
            <option value="" disabled selected>-- Seleccione un proveedor --</option>
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
      
        <div class="form-group">
            <div class="mb-2  form-check-inline">  
                        <input class="form-check-input" type="radio" name="maquinaria" 
                        id="maquinariaPropia" value="propia" {{ (old('maquinaria') == "propia") 
                        ? "checked" : ""}} onclick="Desplegar('mostrarBoton'); Contraer('mostrar')">
                        <label class="form-check-label" for="flexRadioDefault1">Maquinaria propia</label>
              </div>   
              <div class="mb-3  form-check-inline"> 
                        <input class="form-check-input" type="radio" name="maquinaria" 
                        id="maquinariaAlquilada" value="alquilada" {{ (old('maquinaria') == "alquilada") 
                        ? "checked" : ""}}  onclick="Desplegar('mostrar'); Contraer('mostrarBoton')">
                        <label class="form-check-label" for="flexRadioDefault1">Maquinaria alquilada</label>
              </div>
        </div>

        <div class="mb-3 row" id="mostrarBoton">
          <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-outline-info">Guardar</button> 
          </div>
        </div>  

         {{--********************************* Maquinaria alquilada *********************************************************** --}}

        <div class="vh-50 row m-0 text-center align-items-center justify-content-center " id="mostrar">
          <div class="col-60 bg-light p-1">

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label" id="cha">Cantidad de horas alquiladas:</label>
            <div class="col-sm-5">
                <input type="text" id="cantidadHoraAlquilada" class="form-control rounded-pill  @error('cantidadHoraAlquilada') is-invalid @enderror" 
                placeholder="Ingrese la cantidad de horas alquiladas. Ejem. 12" maxlength="2"
                    name="cantidadHoraAlquilada" value="{{old('cantidadHoraAlquilada')}}" oninput="calcularPago()">
                    @error('cantidadHoraAlquilada')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label" id="vph">Valor por hora:</label>
          <div class="col-sm-5">
              <input type="text" id="valorHora" class="form-control rounded-pill  @error('valorHora') is-invalid @enderror" 
              placeholder="Ingrese el precio del valor por hora. Ejem. 1850"
                  name="valorHora" value="{{old('valorHora')}}" maxlength="4" oninput="calcularPago()">
                  @error('valorHora')
                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
          </div>
        </div>

        {{--<div class="mb-3 row">
          <label class="col-sm-3 col-form-label" id="cma">Cantidad de maquinaria alquilada:</label>
          <div class="col-sm-5">
              <input id="cantidadAlquilada" type="number-integer" class="form-control rounded-pill  
              @error('cantidadAlquilada') is-invalid @enderror" 
              placeholder="Ingrese la cantidad de maquinaria alquilada. Ejem. 0000" 
                  name="cantidadAlquilada" value="{{old('cantidadAlquilada')}}" maxlength="4"
                  oninput="calcularPago()">
                  @error('cantidadAlquilada')
                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
          </div>
        </div>--}}
  
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label" id="tap">Total a pagar:</label>
          <div class="col-sm-5">
            <input id="totalPagar" type="text" class="form-control rounded-pill 
            @error('totalPagar') is-invalid @enderror"
              name="totalPagar" placeholder="Calculo automático del total a pagar."
               value="{{old('totalPagar')}}" readonly=»readonly»> 
                @error('totalPagar')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

          <div class="mb-3 row" >
            <div class="offset-sm-3 col-sm-9">
              <button type="submit" class="btn btn-outline-info" >Guardar</button> 
            </div>
          </div>  

        </form>
        </div>
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
          maxDate: 0,
          minDate: "-1m"
    });
  } );
</script>


<script>
  //Funciones para que al dar click en el otro radioBottom se oculte y muestre lo que hay en otro/
  window.onload = function(){
    var x = document.getElementById("maquinariaAlquilada").checked;
    var elemento = document.getElementById("mostrar");

    var y = document.getElementById("maquinariaPropia").checked;
    var elemento1 = document.getElementById("mostrarBoton");

    if (x) {
      elemento.style.display = 'block';
      }else if(y){
        elemento1.style.display = 'block';
    }
}
    function Desplegar(radiosb){ 
    var ver = document.getElementById(radiosb); 
    ver.style.display = "block"; 
    }
    function Contraer(radiosb){ 
    var ver = document.getElementById(radiosb); 
    ver.style.display = "none"; 
    }
</script>


<script>
  /*Funcion para que le salga el valor total que tendra que pagar por las horas alquiladas * el precio*/
try
  {function calcularPago(){
  
  var cantidadHoraAlquilada = document.getElementById('cantidadHoraAlquilada').value;
  var valorHora = document.getElementById('valorHora').value;
  //var cantidadAlquilada = document.getElementById('cantidadAlquilada').value;
  var totalPagar = document.getElementById('totalPagar');

  var resultado = cantidadHoraAlquilada * valorHora; //* cantidadAlquilada;

  totalPagar.value = resultado;

  }
  }catch (error) {throw error;}


</script>

@endsection
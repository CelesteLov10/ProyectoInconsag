@can('Admin.planilla.create')
@extends('adminlte::page')

@section('title', 'Registro de planilla')

@section('content_header')
    <h1>Registro de planilla</h1>
    <hr>
@stop

@section('content')

<div class="container ">
<div class="mb-3 text-end">
<a class="btn btn-outline-primary" href="{{route('planilla.index')}}">
    <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
</div>

    {{-- alerta de mensaje cuando se guardo correctamente --}}
    @if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
      {{ session('mensaje')}}
      <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- encabezado --}}
  <div class = "card shadow ab-4 btaura" >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Registrar empleado</h5> 
      </div >
  
      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('planilla.store')}}" class="planilla-guardar" method="POST" autocomplete="off">
          @csrf {{-- TOKEN INPUT OCULTO --}}

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fecha') is-invalid @enderror" 
                maxlength="10" placeholder="Fecha actual"
                name="fecha" autocomplete="off" value="<?php echo date("d-m-Y");?>" readonly style="background-color: rgba(206, 206, 206, 0)"> 
                  @error('fecha')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
        </div>

        {{-- INPUT DE PRUEBA --}}
        {{-- <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha:</label>
            <div class="col-sm-5">
                <input type="text" id="datepicker" class="form-control rounded-pill @error('fecha') is-invalid @enderror" 
                maxlength="10" placeholder="Fecha actual"
                name="fecha" autocomplete="off" value="{{old('fecha')}}" readonly style="background-color: rgba(206, 206, 206, 0)"> 
                  @error('fecha')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
        </div> --}}

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del empleado</label>
        <div class="col-sm-5">
        <select name="empleado_id" id="empleado" 
        class="form-select form-control rounded-pill @error('empleado_id') is-invalid @enderror" 
        onchange="f_obtener_datos()" onclick="calcularTotal()" onchange="document.getElementById('dias').focus()">   
            <option value="" disabled selected>-- Seleccione un empleado --</option>
            @foreach ($empleado as $empleados)
            @if ($empleados->estado == 'activo')
                <option value="{{$empleados->id}}"{{old('empleado_id') == $empleados->id ? 'selected' : ''}}>
                  {{$empleados['nombres']}} {{$empleados['apellidos']}}</option>
            @endif
           @endforeach
        </select> 
        @error('empleado_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
    </div>

   

  <div class="mb-3 row">
    <label  class="col-sm-3 col-form-label" for="identidad">Identidad del empleado:</label>
    <div class="col-sm-5">
        <input type="text" class="form-control  rounded-pill @error('identidad') is-invalid @enderror" required
            name="identidad" id="identidad" autocomplete="identidad"
        value="{{old('identidad')}}" readonly style="background-color: white">
    </div>
</div>

  <div class="mb-3 row">
    <label  class="col-sm-3 col-form-label" for="nombreCargo">Puesto laboral:</label>
    <div class="col-sm-5">
        <input type="text" class="form-control  rounded-pill @error('nombreCargo') is-invalid @enderror" required
            name="nombreCargo" id="nombreCargo" autocomplete="nombreCargo"
        value="{{old('nombreCargo')}}" readonly style="background-color: white">
    </div>
</div> 

  <div class="mb-3 row">
    <label  class="col-sm-3 col-form-label" for="sueldo">Sueldo:</label>
    <div class="col-sm-5">
        <input type="text" id="sueldo" class="form-control  rounded-pill @error('sueldo') is-invalid @enderror"
            style="background-color: white" name="sueldo" value="{{old('sueldo')}}" 
            maxlength="10" readonly>
            @error('sueldo')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
      @enderror
    </div>
</div> 

<div class="mb-3 row">
  <label class="col-sm-3 col-form-label">Días que trabajo:</label>
  <div class="col-sm-5">
      <input type="text" id="dias" class="form-control rounded-pill  @error('dias') is-invalid @enderror"
      placeholder="Ingrese la cantidad de días" 
          name="dias" value="{{old('dias')}}" maxlength="2" oninput="calcularTotal()" autofocus>
          @error('dias')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
    </div>
</div>

<div class="mb-3 row">
  <label class="col-sm-3 col-form-label">Total:</label>
  <div class="col-sm-5">
      <input type="text" id="total" class="form-control rounded-pill  @error('total') is-invalid @enderror" 
      placeholder="Total a pagar" 
          name="total" value="{{old('total')}}" maxlength="5" readonly=»readonly»>
          @error('total')
          <small class="text-danger invalid-feedback" ><strong>*</strong>{{$message}}</small>
          @enderror
  </div>
</div>

{{-- declare las variables aqui para que conservara la ubicacion el boton --}}

{{-- de esta manera se puede extraer los empleados activos --}}
@php $empactivos = 0; @endphp
@foreach ($empleado as $empleados)
@if ($empleados->estado == 'activo')
    <?php $empactivos = $empactivos + 1;?> 
@endif
@endforeach
                          
<?php $totale = 0;?>
<?php $canEmpleado = 0;?>

@foreach($planillas as $planilla)
<?php $totale = $totale + $planilla->total;?>
<?php $canEmpleado = $canEmpleado + 1?>
@endforeach

{{-- Condicion para que oculte y desactive el boton de agregar empleados --}}
@if ($canEmpleado == $empactivos)
      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9 text-end">
        <button hidden type="submit"  id="submit-and-print" class="btn btn-outline-info" disabled="true">Agregar empleado</button> 
        </div>
      </div>
@else
      <div class="mb-3 row">
          <div class="offset-sm-3 col-sm-9 text-end">
          <button type="submit"  id="submit-and-print" class="btn btn-outline-info">Agregar empleado</button> 
          </div>
      </div> 
@endif

        <br>

        <div class=" card shadow ab-4 btaura">
          <div class=" card-header py-3 ">
                  <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros" style="text-align: left"> 
                    Listado de la planilla
                      </h5>
                  <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros" style="text-align: left"> 
                    Fecha: <?php echo date("d-m-Y");?>
                  </h5>
          </div>
                <div class="col-60 bg-light p-5">
                    <table class="table border border-2 contorno-azul" id="tabla" style="text-align: left">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Identidad del empleado</th>
                                <th scope="col">Nombre del empleado</th>
                                <th scope="col">Puesto laboral</th>
                                <th scope="col">Sueldo</th>
                                <th scope="col">Dias que trabajo</th>
                                <th scope="col">Total</th>
                                <th scope="col">Eliminar registros</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                      @php
                      $fecha = date("d-m-Y");
                  @endphp
                        @foreach($planillas as $planilla)
                            <tr>
                                <td>{{$planilla->empleado->identidad}}</td>
                                <td>{{$planilla->empleado->nombres}}{{' '}}{{$planilla->empleado->apellidos}}</td>   
                                <td>{{$planilla->empleado->puesto->nombreCargo}}</td>
                                <td>{{$planilla->empleado->puesto->sueldo}}</td>
                                <td>{{$planilla->dias}}</td>
                                <td>{{number_format($planilla->total, 2)}}</td>
                                <td><a class="btn btn-outline-danger" onclick="eliminarRegistro()"
                                  href="{{route('planilla.eliminar', ['id' => $planilla->id])}}">
                                  Eliminar</a></td>
                                @endforeach
                        <tr>
                          <th scope="col">Total planilla:</th>
                          <td>{{number_format($totale, 2)}}</td>
                          {{-- <td>L. {{number_format($totale , 2)}}</td> --}}
                        </tr>
                        <tr>
                          <th scope="col">Total empleados:</th>
                          <td>{{$canEmpleado}}</td>
                          {{-- <td>{{$cantidadEmpleados}}</td> --}}
                        </tr>
                        
                        </tbody>
                    </table> 
                  <br>            
      </form>

      {{-- <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9 text-end">
          <button type="submit" onclick="eliminarTabla()" class="btn btn-outline-info">Limpiar tabla</button>                      
        </div>
      </div> --}}

      <form action="{{route('tablaplanilla.store')}}" class="tablaplanilla-guardar" method="POST" autocomplete="off">
        @csrf {{-- TOKEN INPUT OCULTO --}} 
      </div>
        </div>

        <br><br>
        {{-- Condicion para que active el boton de guardar planilla --}}
      @if ($canEmpleado == 0)
      
      <div class="mb-3 row">
        <div class="offset-sm-4 col-sm-9 text-end">
          <button type="submit" id="submit-and-print" class="btn btn-outline-info" hidden disabled="true">Guardar planilla</button>                      
        </div>
      </div>
          
          @else @if ($canEmpleado == $empactivos)
          
          <div class="mb-3 row">
            <div class="offset-sm-4 col-sm-9 text-end">
              <button type="submit" id="submit-and-print" class="btn btn-outline-info">Guardar planilla</button>                      
            </div>
          </div>
          @endif 
      @endif

        {{-- Los inputs estan ocultos para que no se muestren en 
        esta vista y su funcion solo es capturar el dato
        y almacenarlo en los campos de la "tablaplanillas" --}}
        
        <div class="mb-3 row">
          <label hidden class="col-sm-3 col-form-label">Total empleados:</label>
          <div class="col-sm-5">
              <input hidden type="text" id="canEmpleados" class="form-control rounded-pill  @error('canEmpleados') is-invalid @enderror" 
              placeholder="Total a pagar" 
                  name="canEmpleados" value="{{$canEmpleado}}" readonly=»readonly»>
                  @error('canEmpleados')
                  <small class="text-danger invalid-feedback" ><strong>*</strong>{{$message}}</small>
                  @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label hidden class="col-sm-3 col-form-label">Total planilla:</label>
          <div class="col-sm-5">
              <input hidden type="text" id="total" class="form-control rounded-pill  @error('totalp') is-invalid @enderror" 
              placeholder="Total a pagar" 
                  name="totalp" value="{{$totale}}" readonly=»readonly»>
                  @error('totalp')
                  <small class="text-danger invalid-feedback" ><strong>*</strong>{{$message}}</small>
                  @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label hidden class="col-sm-3 col-form-label">Fecha:</label>
          <div class="col-sm-5">
                  <input hidden type="text" class="form-control rounded-pill  @error('fechap') is-invalid @enderror" 
                  name="fechap" id="fechap" autocomplete="off" readonly value="{{$fecha}}" maxlength="10">
                  @error('fechap')
                      <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
              </div>
        </div>
      
      {{-- INPUT DE PRUEBA --}}
      {{-- <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha:</label>
        <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill  @error('fechap') is-invalid @enderror" 
                placeholder="Input de prueba para el registro de planilla" 
                name="fechap" id="datepicker2" autocomplete="off" value="{{$fecha}}" maxlength="10">
                @error('fechap')
                    <small class="text-danger invalid-feedback"><strong></strong>{{$message}}</small>
                @enderror
        </div>
      </div> --}}
      </form>
    </div>
  </div>
</div>
</div>
</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@stop

@section('js')
    {{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>

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
          maxDate: "6m",
          minDate: "0",
      });
      } );
  </script>

<script>
  $( function() {
      $( "#datepicker2" ).datepicker({
          dateFormat: "dd-mm-yy",
          changeMonth: true,
          changeYear: true,
          firstDay: 0,
      monthNamesShort: ['Enero', 'Febrero', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
      dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          maxDate: "6m",
          minDate: "0",
      });
      } );
  </script>

<script>

try
  {function calcularTotal(){

    var sueldo = parseFloat(document.getElementById('sueldo').value);
    var dias = parseInt(document.getElementById('dias').value) || 0;
    var total = document.getElementById('total');

    // en caso que la lic pida el mes real solo se aplica eso y en el controlador el max lo cambiamos a 31
    /*var diass = new Date(0).getDate();
    var resultado = sueldo / diass * dias; */

    var resultado = sueldo / 30 * dias; 
    resultado = resultado.toFixed(2);
    total.value = resultado;

  }
  }catch (error) {throw error;}

  
</script>

<script>
function f_obtener_datos() {
                var select = document.getElementById("empleado");
                var identidad = document.getElementById("identidad");
                var nombreCargo = document.getElementById("nombreCargo");
                var sueldo = document.getElementById("sueldo");
                var datos = select.value;

                @foreach ($empleado as $empleados)
                if (datos == {{$empleados->id}}) {
                    identidad.value = "{{$empleados->identidad}}"; 
                    nombreCargo.value = "{{$empleados->puesto->nombreCargo}}";
                    sueldo.value = "{{$empleados->puesto->sueldo}}";
                }
                @endforeach
            }
</script>

{{-- <script>
  function guardar_totales() {
          var tabla = document.getElementById("tabla")
          tabla.submit();
      }
</script> --}}

<script>
  $('#alert').fadeIn();     
  setTimeout(function() {
      $("#alert").fadeOut();           
  },5000);
</script>

{{-- <script>
function eliminarTabla() {
    if (confirm('¿Estás seguro de que deseas eliminar toda la tabla?')) {
        var tabla = document.getElementById('tabla');
        while (tabla.firstChild) {
            tabla.removeChild(tabla.firstChild);
        }
    }
}
</script> --}}

{{-- <script>
function eliminarRegistro() {
    if (confirm('¿Estás seguro de que deseas eliminar todos los registros?')) {
        fetch('{{route('planilla.eliminar', ['id'])}}', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }).then(response => {
            window.location.reload();
        });
    }
}
</script> --}}
@stop
@endcan
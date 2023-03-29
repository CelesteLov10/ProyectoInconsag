@can('Admin.planilla.index')
@extends('adminlte::page')

@section('title', 'Listado planilla')

@section('content_header')
    <h1>Listado de planillas</h1>
    <hr>
@stop

@section('content')
<div>
  <div class="mb-5 m-5">
  {{-- Campo de busqueda  --}}
<form method="GET" action="">
  <div class="container">
      <div class="vh-50 row text-center align-items-center justify-content-center">
          <div class="col-4 p-1 contorno-azul">
              <div class="input-group">
                    <input type="text" name="search" id="search" readonly onclick="encontrar()" class="form-control"
                    placeholder="Seleccione la fecha que desea buscar" value="{{request('search')}}"/>
                  <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                </div>
              </div>
          </div>
      </div>
  </div>    

  <div class="container ">
      <div class="mb-3 text-end">
          <a class="btn btn-outline-primary text-BLACK"  href="{{route('planilla.create')}}">Registrar planilla <i class="bi bi-file-plus"></i></a>
        </div>

        {{-- alerta de mensaje cuando se guardo correctamente --}}
      @if (session('mensaje'))
      <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
        {{ session('mensaje')}}
        {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert" aria-label="Close"></button> --}}
      </div>
    @endif
      
      {{-- encabezado --}}
          <div class = " card shadow ab-4 btaura" >
              <div class = " card-header py-3 " >
                <a href="{{route('planilla.index')}}" id="sinLinea">
                  <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Listado de planillas</h6></a> 
              </div >
      
      <div class="m-0 text-left align-items-center justify-content-center">
          <div class="bg-light p-5">
  
  <br>

  <div class="m-0 align-items-center justify-content-center ">
    <div class=" p-5">
        <table id="example" class="table table-striped table-bordered border-2 ">
            <thead class="">
          <tr>
              <th scope="col">Fecha:</th>
              <th scope="col">Número de empleados:</th>
              <th scope="col">Total de la planilla:</th>
              <th scope="col">Detalles de la planilla:</th>
              <th scope="col">Imprimir planilla:</th>

          </tr>
      </thead>

      <tbody>
        @forelse($tablaplanillas as $tablaplanilla)
              <tr>
                  <td>{{$tablaplanilla->fechap}}</td>
                  <td>{{$tablaplanilla->canEmpleados}}</td>
                  <td>{{number_format($tablaplanilla->totalp, 2)}}</td>
                  <td><a class="btn btn-outline-primary" 
                      href="{{route('tablaplanilla.show', ['id' => $tablaplanilla->id])}}">
                      Detalles</a></td>
                      <td><a class="btn btn-outline-warning" href="{{route('tablaplanilla.pdf', ['id' => $tablaplanilla->id])}}">
                        Imprimir</a></td>
              </tr>
              @empty
              <tr>
                <td col-span="4">No hay registros</td>
              </tr>
        @endforelse
      </tbody>
  </table>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
      {{-- cdn para el css de los emojis de fontawesomw --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


@stop

@section('js')
    {{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
<script>
    //extraiga los datos de la BD
    $('#search').autocomplete({
      source: function(request, response){
        $.ajax({
        url: "{{route('tablaplanilla.search')}}",
        dataType:'json',
          data: {
              term: request.term
          },
            success: function(data){
            response(data)
          }
        });
      }
    });
</script>

<script>
  $( function encontrar() {
      $("#search" ).datepicker({
          dateFormat: "dd-mm-yy",
          changeMonth: true,
          changeYear: true,
          firstDay: 0,
      monthNamesShort: ['Enero', 'Febrero', 'Marzo',
          'Abril', 'Mayo', 'Junio',
          'Julio', 'Agosto', 'Septiembre',
          'Octubre', 'Noviembre', 'Diciembre'],
      dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
          maxDate: "",
          minDate: "",
      });
      } );
  </script>

  {{-- Codigo para que el mensaje se cierre luego de 5 segundos pasar id al div --}}
<script>
  $('#alert').fadeIn();     
  setTimeout(function() {
      $("#alert").fadeOut();           
  },5000);
</script>

{{-- script para que muestre el datables en español, y que funcione el datables --}}
<script>
  $(document).ready(function() {
  $('#example').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
</script>
@stop
@endcan
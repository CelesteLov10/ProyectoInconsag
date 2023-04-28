@can('Admin.empleado.indexEmp')
@extends('adminlte::page')

@section('title', 'Listado')

@section('content_header')
    <h1>Listado de empleados</h1>
    <hr>
@stop

@section('content')
<style>
  strong {
 font-weight: bold;
}

table {
 background: #f5f5f5;
 border-collapse: separate;
 box-shadow: inset 0 1px 0 #fff;
 font-size: 15px;
 line-height: 24px;
 margin: 30px auto;
 text-align: left;
 width: 800px;
}

td {
 border-right: 1px solid #fff;
 border-left: 1px solid #e8e8e8;
 border-top: 1px solid #fff;
 border-bottom: 1px solid #e8e8e8;
 padding: 10px 15px;
 position: relative;
 transition: all 300ms;
}

td:first-child {
 box-shadow: inset 1px 0 0 #fff;
}

td:last-child {
 border-right: 1px solid #e8e8e8;
 box-shadow: inset -1px 0 0 #fff;
}


tr:last-of-type td {
 box-shadow: inset 0 -1px 0 #fff;
}

tr:last-of-type td:first-child {
 box-shadow: inset 1px -1px 0 #fff;
}

tr:last-of-type td:last-child {
 box-shadow: inset -1px -1px 0 #fff;
}

tbody:hover td {
 color: transparent;
 text-shadow: 0 0 3px #878686;
}

tbody:hover tr:hover td {
 color: #444;
 text-shadow: 0 1px 0 #fff;
}


</style>
<div>
{{-- Campo de busqueda
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row text-center align-items-center justify-content-center">
            <div class="col-7 p-1 contorno-azul">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control" autofocus
                      placeholder="Buscar por identidad, nombre o nombre del cargo" value="{{request('search')}}"/>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </div>
        </div>
    </div>    
  </form>
    --}}

  <div class="container">
 <div class="mb-3 text-end">
      <a class="btn btn-outline-primary text-BLACK" href="{{route('empleado.createEmp')}}">Nuevo empleado  <i class="bi bi-person-plus"></i></a>
  </div>
        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
          <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
            {{ session('mensaje')}}
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
          </div>
        @endif

        {{-- alerta de mensaje cuando se actualice un dato correctamente --}}
          @if (session('mensajeW'))
          <div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert" >
              {{ session('mensajeW')}}
              {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
          </div>
          @endif

      
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
              <a href="{{route('empleado.indexEmp')}}" id="sinLinea">
                <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Lista de empleados</h6 ></a> 
          </div >

          <div class="m-0 align-items-center justify-content-center ">
            <div class=" p-5">
                <table id="example" class="table table-striped table-bordered border-2 ">
                    <thead class="">
                      <tr>
                    <tr>
                      <th scope="col">Identidad</th>
                      <th scope="col">Nombres</th>
                      <th scope="col">Apellidos</th>
                      <th scope="col">Nombre del cargo</th>
                      <th scope="col">Estado</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Actualizar</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($empleados as $empleado)
                    <tr>
                      <td>{{$empleado->identidad}}</td>
                      <td>{{$empleado->nombres}}</td>
                      <td>{{$empleado->apellidos}}</td>
                      <td>{{$empleado->puesto->nombreCargo}}</td>
                      <td>{{$empleado->estado->nombreE}}</td>

                      <td><a class="btn btn-outline-primary" href="{{route('empleado.showEmp', ['id'=>$empleado->id])}}">
                        <i class="fa fa-eye"></i> 
                      </a></td>

                    <!-- <td><a class="btn btn-outline-success" 
                          href="{ {route('empleado.showEmp', ['id' => $empleado->id])}}">Ver</a>
                        </td>-->
                      <td><a class="btn btn-outline-warning" 
                        href="{{route('empleado.editEmp', ['id' => $empleado->id])}}">
                        <i class="fa fa-clipboard"></i>
                      </a>
                      </td>
                      @csrf
                    </tr>
                    @empty
                    <tr>
                  <td col-span="4">No hay registros</td>
                    </tr>
                  @endforelse
                    
                  </tbody>
                </table>
               {{-- {{$empleados->links()}} --}}
          </div>
      </div>
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
<script>src="https://code.jquery.com/jquery-3.5.1.js"</script>
<script> src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"</script>
<script> src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"</script>

<script>
    //extraiga los datos de la BD
    $('#search').autocomplete({
      source: function(request, response){
        $.ajax({
        url: "{{route('empleado.search')}}",
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
  {{-- Codigo para que el mensaje se cierre luego de 2 segundos pasar id al div --}}
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
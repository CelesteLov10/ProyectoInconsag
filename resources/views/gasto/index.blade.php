@can('Admin.gasto.index')
@extends('adminlte::page')

@section('title', ' Listado')

@section('content_header')
    <h1>Listado de gastos</h1>
    <hr>
@stop

@section('content')   
<div> 

  {{-- Campo de busqueda  --}}
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row text-center align-items-center justify-content-center">
            <div class="col-7 p-1 contorno-azul">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control" autofocus
                      placeholder="Buscar por nombre del gasto, nombre de la empresa, por fecha o nombre del empleado" value="{{request('search')}}"/>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </div>
        </div>
    </div>    
  </form>

  <div class="container">
    <div class="mb-3 text-end">
      {{--  <a class="btn glow-on-hover-main text-BLACK" href="{{route('inventario.pdf')}}" title="Imprimir PDF">PDF <i class="bi bi-printer text-BLACK"></i></a>--}}
      <a class="btn btn-outline-primary text-BLACK" href="{{route('gasto.create')}}">Nuevo gasto <i class="bi bi-cart-plus text-BLACK"></i></a>
  
    </div>
        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
          <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
            {{ session('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert" aria-label="Close"></button>
          </div>
        @endif

        {{-- alerta de mensaje cuando se actualice un dato correctamente --}}
        @if (session('mensajeW'))
        <div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert" >
          {{ session('mensajeW')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
            <a href="{{route('gasto.index')}}" id="sinLinea">
              <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Listado de gastos</h6></a> 
          </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center container">
          <div class="col-60 bg-light p-5">
              <table class="table border border-2 contorno-azul">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">Nombre del gasto</th>
                      <th scope="col">Nombre de la empresa</th>
                      <th scope="col">Fecha del gasto</th>
                      <th scope="col">Empleado</th>
                      <th scope="col">Detalle</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($gasto as $gasto)
                    <tr>
                      <td>{{$gasto->nombreGastos}}</td> 
                      <td>{{$gasto->nombreEmpresa}}</td>   
                      <td>{{$gasto->fechaGastos}}</td> 
                      <td>{{$gasto->empleado->nombres}}</td>     {{-- aqui vista show --}}
                      <td>
                        <a class="btn btn-outline-primary"
                          href="{{route('gasto.show', ['id' => $gasto->id])}}">
                          <i class="fa fa-eye"></i>
                        </a>
                    </td>
                    
                    @empty
                    <tr>
                      <td col-span="4">No hay registros</td>
                    </tr>
                  @endforelse
                    
                  </tbody>
                </table>
                {{-- {{$gasto->links()}} --}} 
          </div>
      </div>
  </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
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
      url: "{{route('inventario.search')}}",
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
  },2000);
</script>
@stop
@endcan
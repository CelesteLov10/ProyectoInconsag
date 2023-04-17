@can('Admin.venta.index')
@extends('adminlte::page')

@section('title', 'Listado')

@section('content_header')
    <h1>Listado de ventas</h1>
    <hr>
@stop

@section('content')
<div>

  {{-- Campo de busqueda 
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row text-center align-items-center justify-content-center">
            <div class="col-8 p-1 contorno-azul">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control" autofocus
                      placeholder="Buscar por nombre del cliente, forma de la venta o fecha de la venta" value="{{request('search')}}"/>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                    <a href="{{route('report.reports_day')}}" class="btn btn-outline-primary text-BLACK">
                      <i class="fa fa-calendar2-minus text-BLACK"></i>
                      Ventas por día
                  </a>
                  <a href="{{route('reports.reports_date')}}" class="btn btn-outline-primary text-BLACK">
                    <i class="fa fa-calendar3-range text-BLACK"></i>
                    Ventas por fecha
                </a>

                  </div> 
                </div>
              
            </div>
        
        </div>
      
    </div>    
  </form> --}}
  <div class="container ">
    <div class="mb-3 text-end">
      <a href="{{route('report.reports_day')}}" class="btn btn-outline-primary text-BLACK">
        <i class="fa fa-calendar2-minus text-BLACK"></i>
        Ventas por día
    </a>
    <a href="{{route('reports.reports_date')}}" class="btn btn-outline-primary text-BLACK">
      <i class="fa fa-calendar3-range text-BLACK"></i>
      Ventas por fecha
  </a>
      <a class="btn btn-outline-primary text-BLACK" href="{{route('venta.create')}}">Nueva venta<i class="bi bi-person-plus"></i></a>
    </div>
        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
          <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
            {{ session('mensaje')}}
          </div>
        @endif

        {{-- alerta de mensaje cuando se actualice un dato correctamente --}}
          @if (session('mensajeW'))
          <div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert" >
              {{ session('mensajeW')}}
          </div>
          @endif

      
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
              <a href="{{route('venta.index')}}" id="sinLinea">
                <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Lista las ventas</h6></a> 
          </div >

          <div class="m-0 align-items-center justify-content-center ">
            <div class=" p-5">
                <table id="example" class="table table-striped table-bordered border-2 ">
                    <thead class="">
                    <tr>
                      <th scope="col">Nombre del cliente</th>
                      <th scope="col">Forma de venta</th>
                      <th scope="col">Fecha de venta</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Imprimir contrato</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($ventas as $venta)
                    <tr>
                      <td>{{$venta->cliente->nombreCompleto}}</td>
                      <td>{{$venta->formaVenta}}</td>
                      <td>{{$venta->fechaVenta}}</td>

                      <td><a class="btn btn-outline-primary" 
                        href="{{route('venta.show', ['id'=>$venta->id])}}">
                        <i class="fa fa-eye"></i> 
                      </a></td>
                      <td><a class="btn btn-outline-warning" 
                        href="{{route('venta.contrato', ['id' =>$venta->id])}}">
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
        url: "{{route('venta.search')}}",
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

@extends('adminlte::page')

@section('title', 'Reporte de ventas por día')

@section('content_header')
    <h1>Reporte de ventas por día</h1>
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

  <div class="container">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary text-BLACK" href="{{route('reports.pdfReportDia')}}" title="Imprimir PDF">Imprimir reporte <i class="fa fa-printer"></i></a>
    </div>
    <div class="row">
      <div class="col-12 col-md-3 text-center">
          <span>Fecha de consulta: <b></b></span>
          <div class="form-group">
              <strong>{{\Carbon\Carbon::today()->format('d/m/Y')}}</strong>
          </div>
      </div>


      <div  class="col-12 col-md-3 text-center">
          <span>Cantidad de registros: <b></b></span>
          <div class="form-group">
              <strong>{{$ventas->count()}}</strong>
          </div>
      </div>
    
      <div  class="col-12 col-md-3 text-center">
          <span>Total de ingresos por prima: </span>
          <div class="form-group">
              <strong>{{$valorPrima}}</strong>
          </div>
      </div>
   

    </div>
    
    

      
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
             <a href="{{route('venta.index')}}" id="sinLinea">
                <h6 class = "n-font-weight-bold " title="Volver a todos los registros">Ventas por día</h6></a> 
          </div >

          <div class="m-0 align-items-center justify-content-center ">
            <div class=" p-5">
                <table id="example" class="table table-striped table-bordered border-2 ">
                    <thead class="">
                    <tr>
                      <th >Nombre del cliente</th>
                      <th>Forma de venta</th>
                      <th >Fecha de venta</th>
                      <th >Valor prima</th>
                    </tr>
                  </thead>
                  @if (isset($ventas))
                  <tbody>
                    @forelse($ventas as $venta)
                      <tr>
                        <td>{{$venta->cliente->nombreCompleto}}</td>
                        <td>{{$venta->formaVenta}}</td>
                        <td>{{$venta->fechaVenta}}</td>
                        <td>{{$venta->valorPrima}}</td>
  
                    
                        @csrf 
                      </tr>
                      @empty
                      <tr>
                    <td col-span="4">No hay registros</td>
                      </tr>
                    @endforelse
                      
                    </tbody>
                      
                  @endif
                 
                </table>
              {{--    { {$ventas->links()}}--}}
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
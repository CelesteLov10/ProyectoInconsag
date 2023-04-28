@extends('adminlte::page')

@section('title', 'Reporte de busqueda')

@section('content_header')
    <h1>Reporte de busqueda por fecha</h1>
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
  
  <div class="container">
    <div class="mb-3 text-end">
     {{-- <input type="hidden" name="ventas" value="{{ $ventas }}">
      <a href="{{route('reports.pdfReportFecha')}}">Imprimir parte nose</a> --}}
   
   {{--   <form method="POST" action="{{route('reports.pdfReportFecha')}}">
        @csrf
        <input type="hidden" name="busqueda[]" value="{{ $busqueda }}">
        <button type="submit">Imprimir</button>
      </form> --}}
      
     {{-- <a class="btn btn-outline-primary text-BLACK" onclick="imprimir()" title="Imprimir PDF">Imprimir reporte <i class="bi bi-printer"></i></a> --}}
    </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
              <a href="{{route('venta.index')}}" id="sinLinea">
                <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Regresar a ventas</h6></a> 
          </div >
         

          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <form action="{{route('report.report_results')}}" method="POST">
                        @csrf
                        <div class="row ">
                            <div class="col-12 col-md-3 text-center">
                                <span>Fecha inicial: </span>
                                <div class="form-group">
                                    <input name="fecha_ini" id="fecha_ini" class="btn btn-outline-primary text-BLACK" type="date" 
                                    value="{{old('fecha_ini')}}" 
                                    name="fecha_ini" id="fecha_ini">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-center">
                                <span>Fecha final: </span>
                                <div class="form-group">
                                    <input  name="fecha_fin" id="fecha_fin" class="btn btn-outline-primary text-BLACK" type="date" 
                                    value="{{old('fecha_fin')}}" 
                                    name="fecha_fin" id="fecha_fin">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-center mt-4">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-outline-primary text-BLACK">Consultar</button>
                                </div>
                            </div>
                            
                        <div class="col-12 col-md-2 text-center mt-4">
                              <div class="form-group">
                                <button class="btn btn-outline-primary text-BLACK" onclick="window.print()">Imprimir a PDF</button>
                              </div>
                          </div> 
                        
                            <div class="col-12 col-md-3 text-center">
                                <span>Total de ingresos por prima: <b> </b></span>
                                <div class="form-group">
                                    <strong>s/ {{$valorPrima}}</strong>
                                </div>
                            </div>
                          
                        </div>
                      </form>
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
                  @if (isset($busqueda))
                  <tbody>
                    @forelse($busqueda as $venta)
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
<script>
  //para que salga marcado en el calendario la fecha actual
    window.onload = function(){
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
          mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_fin').value=ano+"-"+mes+"-"+dia;
      }
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

{{-- <script> 
  function imprimir() {
      window.open('{{route('reports.pdfReportFecha')}}', '_blank');
  }
  {{-- </script> --}}
@stop
{{--  href="{{route('reports.pdfReportFecha')}}" --}}
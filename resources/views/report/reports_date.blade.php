@extends('adminlte::page')

@section('title', 'Reporte de ventas')

@section('content_header')
    <h1>Reporte de ventas por fecha</h1>
    <hr>
@stop

@section('content')
<div>
  
  <div class="container">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary text-BLACK" href="{{route('reports.pdfReportFecha')}}" title="Imprimir PDF">Imprimir reporte <i class="bi bi-printer"></i></a>
    </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
              <a href="{{route('venta.index')}}" id="sinLinea">
                <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Reporte de ventas</h6></a> 
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
                            {{-- <div class="input-daterange datepicker row align-items-center" data-date-format="d-m-y">
                              <div class="col">
                                  <div class="form-group">
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                          </div>
                                          <input class="form-control" placeholder="Fecha de inicio"
                                           type="text" value="{{ $start }}">
                                      </div>
                                  </div>
                              </div>
                              <div class="col">
                                  <div class="form-group">
                                      <div class="input-group">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                          </div>
                                          <input class="form-control" placeholder="Fecha final" 
                                          type="text" value="{{$end}}">
                                      </div>
                                  </div>
                              </div>
                          </div> --}}
                            <div class="col-12 col-md-2 text-center mt-4">
                                <div class="form-group">
                                   <button type="submit" class="btn btn-outline-primary text-BLACK">Consultar</button>
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
@stop
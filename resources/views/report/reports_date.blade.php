@extends('layout.plantillaH')

@section('titulo', 'Reporte de ventas')

@section('css')
    {{-- se necesita para el buscador --}}
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    
@endsection

@section('contenido') 

<div>
  <header class="blog-header py-3 mt-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-14 text-center">
          <h3 class="blog-header-logo text-dark">Reporte de ventas por fecha</h3>
        <hr>
      </div>
    </div>
  </header>
  </div>
  
  <div class="container">
    <div class="mb-3 text-end">
      <a class="btn glow-on-hover-main text-BLACK" href="{{route('reports.pdfReportFecha')}}" title="Imprimir PDF">Imprimir reporte <i class="bi bi-printer"></i></a>
    </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
             <a href="{{route('venta.index')}}" id="sinLinea">
                <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros">Reporte de ventas</h5 ></a> 
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
                                    <input class="btn glow-on-hover-main text-BLACK" type="date" 
                                    value="{{old('fecha_ini')}}" 
                                    name="fecha_ini" id="fecha_ini">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-center">
                                <span>Fecha final: </span>
                                <div class="form-group">
                                    <input class="btn glow-on-hover-main text-BLACK" type="date" 
                                    value="{{old('fecha_fin')}}" 
                                    name="fecha_fin" id="fecha_fin">
                                </div>
                            </div>
                            <div class="col-12 col-md-2 text-center mt-4">
                                <div class="form-group">
                                   <button type="submit" class="btn glow-on-hover-main text-BLACK">Consultar</button>
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

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center container">
          <div class="col-60 bg-light p-5">
              <table class="table border border-2 contorno-azul">
                  <thead class="thead-dark">
                    <tr>
                      <th >#</th>
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
                        <td>{{$venta->id}}</td>
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
@endsection

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
@endsection
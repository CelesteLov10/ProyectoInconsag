@extends('layout.plantillaH')

@section('titulo', 'Planillas')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
        Listado de planillas
        </h3>
        <hr>
    </div>

     {{-- Campo de busqueda  --}}
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row text-center align-items-center justify-content-center">
            <div class="col-7 p-1 contorno-azul">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control" autofocus
                      placeholder="Buscar por fecha de planilla" value="{{request('search')}}"/>
                    <button type="submit" class="btn glow-on-hover-bus"><i class="bi bi-search"></i></button>
                  </div>
                </div>
            </div>
        </div>
    </div>    

  

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn glow-on-hover-main text-BLACK" style="color: black" href="{{route('planilla.create')}}">Registrar planilla <i class="bi bi-file-plus"></i></a>
          </div>

        </div>
          {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
          {{ session('mensaje')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert" aria-label="Close"></button>
        </div>
      @endif
        </div>

        {{-- encabezado --}}
            <div class = " card shadow ab-4 btaura" >
                <div class = " card-header py-3 " >
                  <a href="{{route('planilla.index')}}" id="sinLinea">
                    <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros">Listado de planillas</h5 ></a> 
                </div >
        
        <div class="vh-50 row m-0 text-left align-items-center justify-content-center">
            <div class="col-60 bg-light p-5">
    
    <br>
    <table class="table border border-2 contorno-azul">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Fecha:</th>
                <th scope="col">Número de empleados:</th>
                <th scope="col">Total de la planilla:</th>
                {{-- <th scope="col">Detalles de la planilla:</th> --}}

            </tr>
        </thead>

        <tbody>
          @forelse($tablaplanillas as $tablaplanilla)
                <tr>
                    <td>{{$tablaplanilla->fechap}}</td>
                    <td>{{$tablaplanilla->canEmpleados}}</td>
                    <td>{{number_format($tablaplanilla->totalp, 2)}}</td>
                    {{-- <td><a class="btn btn-outline-warning" 
                        href="{{route('tablaplanilla.show', ['id' => $tablaplanilla->id])}}">
                        <i class="bi bi-eye"></i></a></td> --}}
                </tr>
                @endforelse 
                 
        </tbody>
    </table>
    {{$planilla->links()}}
    </div>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
<script>
    //extraiga los datos de la BD
    $('#search').autocomplete({
      source: function(request, response){
        $.ajax({
        url: "{{route('Tablaplanilla.search')}}",
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
@endsection
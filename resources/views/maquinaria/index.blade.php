@extends('layout.plantillaH')

@section('titulo', 'Listado maquinaria') 

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('contenido') 

<div> 
  {{-- Campo de busqueda  --}}
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row m-5 text-center align-items-center justify-content-center">
            <div class="col-7 p-2">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control"
                      placeholder="Buscar por nombre de maquinaria, proveedor o contacto" value="{{request('search')}}"/> 
                    <button type="submit" class="btn btn-outline-primary">
                      <i class="bi bi-search"></i>
                    </button>
                  </div>
                </div>
            </div>
        </div>
    </div>    
  </form>

  <div class="container ">

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

      <div class="mb-3 text-end">
        <a class="btn btn-outline-success text-right" href="{{route('maquinaria.pdf')}}">Imprimir <i class="bi bi-printer"></i></a>

          <a class="btn btn-outline-success text-right" href="{{route('maquinaria.create')}}">Nueva maquinaria <i class="bi bi-plus-square-dotted"></i></a>
      </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 bg-success bg-gradient" >
          <div class = " card-header py-3 " >
            <a href="{{route('maquinaria.index')}}" id="sinLinea">
              <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros">Lista de maquinaria</h5 ></a> 
          </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
              <table class="table border border-2 rounded-pill">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre de maquinaria</th>
                      <th scope="col">Maquinaria</th>
                      <th scope="col">Nombre del proveedor</th>
                      <th scope="col">Nombre del contacto</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Actualizar</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($maquinarias as $maquinaria)
                    <tr>
                      <td>{{$maquinaria->id}}</td>
                      <td>{{$maquinaria->nombreMaquinaria}}</td>  
                      <td>{{$maquinaria->maquinaria}}</td>  
                      <td>{{$maquinaria->proveedor->nombreProveedor}}</td> 
                      <td>{{$maquinaria->proveedor->nombreContacto}}</td> 
                     <td><a class="btn btn-outline-primary" 
                        href="{{route('maquinaria.show', ['id'=> $maquinaria->id])}}">
                        <i class="bi bi-eye"></i> </a></td> 
                      <td><a class="btn btn-outline-warning" 
                        href="{{route('maquinaria.edit', ['id' => $maquinaria->id])}}">
                        <i class="bi bi-pencil-square"></i></a></td>
                          @csrf
                    </tr>
                    @empty
                    <tr>
                      <td col-span="4">No hay registros</td>
                    </tr>
                  @endforelse
                 
                  </tbody>
                </table>
                {{$maquinarias->links()}}
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
      url: "{{route('maquinaria.search')}}",
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
@endsection
@extends('layout.plantillaH')

@section('titulo', 'Listado inventario') 

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('contenido') 

<div> 
  <header class="blog-header py-3 mt-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-14 text-center">
          <h3 class="blog-header-logo text-dark">Listado de inventarios</h3>
        <hr>
      </div>
    </div>
  </header>

  <div class="mb-3 text-end">
    <p style="display: inline">
      <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="bi bi-search"></i>
      </button>
    </p>
      <a class="btn btn-outline-primary" href="{{route('inventario.pdf')}}" title="Imprimir PDF">PDF <i class="bi bi-printer"></i></a>
      <a class="btn btn-outline-primary" href="{{route('inventario.create')}}">Nuevo inventario <i class="bi bi-plus-square-dotted"></i></a>
  </div>
  <div class="collapse mb-3 mt-3" id="collapseExample">
    <div class="card card-body p-2">
          {{-- Campo de busqueda  --}}
      <form method="GET" action="">
        <div class="container">
            <div class="vh-50 row text-center align-items-center justify-content-center">
                <div class="col-8 p-1 buscar">
                    <div class="input-group">
                          <input type="text" name="search" id="search"  class="form-control"
                          placeholder="Buscar por inventario, oficina o empleado" 
                          value="{{request('search')}}"/> 
                        <button type="submit" class="btn btn-outline-primary">
                          <i class="bi bi-search"></i> Buscar
                        </button>
                      </div>
                    </div>
                </div>
            </div>
        </div>    
      </form> 
    </div>
  </div>

  <div class="container">

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
            <a href="{{route('inventario.index')}}" id="sinLinea">
              <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros">Lista de inventario</h5 ></a> 
          </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
              <table class="table border border-2 rounded-pill">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Oficina</th>
                      <th scope="col">Empleado</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Actualizar</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($inventarios as $inventario)
                    <tr>
                      <td>{{$inventario->id}}</td>
                      <td>{{$inventario->nombreInv}}</td> 
                      <td>{{$inventario->cantidad}}</td>   
                      <td>{{$inventario->oficina->nombreOficina}}</td> 
                      <td>{{$inventario->empleado->nombres}}</td>     {{-- aqui vista show --}}
                      <td><a class="btn btn-outline-primary" href="{{route('inventario.show', ['id'=>$inventario->id])}}">
                        <i class="bi bi-eye"></i> </a></td>
                      <td><a class="btn btn-outline-warning" 
                        href="{{route('inventario.edit', ['id' => $inventario->id])}}"><i class="bi bi-pencil-square"></i></a></td>
                          @csrf           {{-- aqui vista edit --}}
                    </tr>
                    @empty
                    <tr>
                      <td col-span="4">No hay registros</td>
                    </tr>
                  @endforelse
                    
                  </tbody>
                </table>
                {{$inventarios->links()}}
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
@endsection

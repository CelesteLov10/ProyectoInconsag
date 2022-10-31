@extends('layout.plantillaH')

@section('titulo', 'Listado proveedores')

@section('css')
    {{-- se necesita para el buscador --}}
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
                        placeholder="Buscar por nombre de proveedor, nombre del contacto y categoria" 
                        value="{{request('search')}}"/> {{-- busca por nombre de proveedor, nombre del contacto y categoria --}}
                      <button type="submit" class="btn btn-outline-primary">
                        <i class="bi bi-search"></i>
                      </button>
                    </div>
                  </div>
              </div>
          </div>
      </div>    
    </form>  
  <div class="container">

        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
          <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
            {{ session('mensaje')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
          <a class="btn btn-outline-success text-right" href="{{route('proveedor.create')}}">Nuevo proveedor  <i class="bi bi-person-plus"></i></a>
      </div>
        {{-- encabezado style="text-decoration:none"--}}
        <div class = " card shadow ab-4 bg-success bg-gradient " >
          <div class = " card-header py-3 " >
              <a href="{{route('proveedor.index')}}" id="sinLinea">
                <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros" id="titulo">Lista de proveedores</h5 ></a> 
          </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
              <table class="table border border-2 rounded-pill">
                  <thead class="thead-dark">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre del proveedor</th>
                      <th scope="col">Nombre del contacto</th>
                      <th scope="col">Teléfono</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Detalle</th>
                      <th scope="col">Actualizar</th>
                    </tr>
                  </thead>
                  <tbody>
                  @forelse($proveedor as $proveedores)
                    <tr>
                      <td>{{$proveedores->id}}</td>
                      <td>{{$proveedores->nombreProveedor}}</td>
                      <td>{{$proveedores->nombreContacto}}</td>
                      <td>{{$proveedores->telefono}}</td>
                      <td>{{$proveedores->categoria->nombreCat}}</td>

                      <td><a class="btn btn-outline-primary" 
                        href="{{route('proveedor.show', ['id'=>$proveedores->id])}}">
                        <i class="bi bi-eye"></i>
                      </a></td>

                      <td><a class="btn btn-outline-warning" 
                        href="{{route('proveedor.edit', ['id' => $proveedores->id])}}">
                        <i class="bi bi-pencil-square"></i>
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
                {{$proveedor->links()}}
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
        url: "{{route('proveedor.search')}}",
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

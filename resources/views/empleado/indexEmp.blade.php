@extends('layout.plantillaH')

@section('titulo', 'Nuevo Puesto')

@section('css')
  <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 


<div class="mb-5">
    <h4 class=" text-center">
      <strong>Listado de empleados</strong> 
    </h4>   
</div>
  {{-- Campo de busqueda  --}}
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
            <div class="col-5 p-2">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control"
                      placeholder="Buscar"/> {{-- busca por identidad nombre empleado y nombre cargo --}}
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                  </div>
                </div>
            </div>
        </div>
    </div>    
  </form>
  
<div class="container ">

      {{-- alerta de mensaje cuando se guardo correctamente --}}
      @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" >
          {{ session('mensaje')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      {{-- alerta de mensaje cuando se actualice un dato correctamente --}}
        @if (session('mensajeW'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" >
            {{ session('mensajeW')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
        @endif

    <div class="mb-3 text-end">
        <a class="btn btn-outline-success text-right" href="{{route('empleado.createEmp')}}">Nuevo</a>
    </div>
      {{-- encabezado --}}
      <div class = " card shadow ab-4 " >
        <div class = " card-header py-3 " >
            <h6 class = "n-font-weight-bold text-primary"> Todos los empleados </h6 > 
        </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
            <table class="table border border-2 rounded-pill">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Identidad</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Actualizar</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($empleados as $empleado)
                  <tr>
                    <th>{{$empleado->identidad}}</th>
                    <td>{{$empleado->nombres}}</td>
                    <td>{{$empleado->apellidos}}</td>
                    <td>{{$empleado->telefono}}</td>
                    <td>{{$empleado->estado}}</td>
                    <td><a class="btn btn-outline-success" 
                        href="{{route('empleado.createEmp', ['id' => $empleado->id])}}">Ver</a>
                      </td>
                    <td><a class="btn btn-outline-warning" 
                      href="{{route('empleado.createEmp', ['id' => $empleado->id])}}">Actualizar</a>
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
              {{$empleados->links()}}
        </div>
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
        url: "{{route('empleado.search')}}",
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
@endsection
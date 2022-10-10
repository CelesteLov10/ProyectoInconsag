@extends('layout.plantillaH')

@section('titulo', 'Inventario') 
@section('contenido') 

<div class="mb-5">
    <h4 class=" text-center">
      <strong>Listado de inventario</strong> 
    </h4>
</div>
  

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
<!-- <div class="alert alert-success">
{ { session('mensaje')}}
</div>-->
<div class="alert alert-warning alert-dismissible fade show" role="alert" >
  {{ session('mensajeW')}}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

    <div class="mb-3 text-end">
        <a class="btn btn-outline-success text-right" href="{{route('inventario.create')}}">Nuevo</a>
    </div>
      {{-- encabezado --}}
      <div class = " card shadow ab-4 " >
        <div class = " card-header py-3 " >
            <h6 class = "n-font-weight-bold text-primary" > Todos los inventarios </h6 > 
        </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
            <table class="table border border-2 rounded-pill">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre inventario</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Ver</th>
                    <th scope="col">Actualizar</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($inventarios as $inventario)
                  <tr>
                    <td>{{$inventario->id}}</td>
                    <td>{{$inventario->nombreInv}}</td>
                    <td>{{$inventario->cantidad}}</td>                    {{-- aqui vista show --}}
                    <td><a class="btn btn-outline-success" href="{{route('inventario.create', ['id'=>$inventario->id])}}">Ver</a></td>
                    <td><a class="btn btn-outline-warning" 
                      href="{{route('inventario.edit', ['id' => $inventario->id])}}">Actualizar</a></td>
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
@endsection

@extends('adminlte::page')

@section('title', 'Planilla')

@section('content_header')
    <h1>Listado planilla</h1>
@stop

@section('content')
<div>

     {{-- Campo de busqueda  --}}
  <form method="GET" action="">
    <div class="container">
        <div class="vh-50 row text-center align-items-center justify-content-center">
            <div class="col-7 p-1 contorno-azul">
                <div class="input-group">
                      <input type="text" name="search" id="search"  class="form-control" autofocus
                      placeholder="Buscar por fecha de planilla" value="{{request('search')}}"/>
                    <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
                  </div>
                </div>
            </div>
        </div>
    </div>    

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary text-BLACK"  href="{{route('planilla.create')}}">Registrar planilla <i class="bi bi-file-plus"></i></a>
          </div>

          {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
        <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
          {{ session('mensaje')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert" aria-label="Close"></button>
        </div>
      @endif
        
        {{-- encabezado --}}
            <div class = " card shadow ab-4 btaura" >
                <div class = " card-header py-3 " >
                  <a href="{{route('planilla.index')}}" id="sinLinea">
                    <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros">Listado de planillas</h5 ></a> 
                </div >
        
        <div class="m-0 text-left align-items-center justify-content-center">
            <div class="bg-light p-5">
    
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
          @foreach($tablaplanillas as $tablaplanilla)
                <tr>
                    <td>{{$tablaplanilla->fechap}}</td>
                    <td>{{$tablaplanilla->canEmpleados}}</td>
                    <td>{{number_format($tablaplanilla->totalp, 2)}}</td>
                    {{-- <td><a class="btn btn-outline-warning" 
                        href="{{route('tablaplanilla.show', ['id' => $tablaplanilla->id])}}">
                        <i class="bi bi-eye"></i></a></td> --}}
                </tr>
                @endforeach
                 
        </tbody>
    </table>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
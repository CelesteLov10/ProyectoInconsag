@extends('layout.plantillaH')

@section('titulo', 'Detalle de inventario')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 


<div class="mb-5">
    <h4 class=" text-center">
        <strong>Detalle de inventario</strong> 
    </h4>   
</div>

<div class="container ">
    <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('inventario.index')}}">Atrás</a>
    </div>
    {{-- encabezado --}}
    <div class = " card shadow ab-4 " >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-primary">Detalles de {{$inventario->nombreInv}}</h5 > 
        </div >

    <div class="vh-50 row m-0 text-left align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
<table class="table">
    <thead class="table-light">
        <tr>
            <th scope="col" class="col-md-4">Datos</th>
            <th scope="col">Información</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Nombre de inventario</th>
            <td>{{$inventario->nombreInv}}</td>    
        </tr>
        <tr>
            <th scope="row">Cantidad</th>
            <td>{{$inventario->cantidad}}</td>    
        </tr>
        <tr>
            <th scope="row">Descripción</th>
            <td>{{$inventario->descripcion}}</td>    
        </tr>
        <tr>
            <th scope="row">Fecha</th>
            <td>{{$inventario->fecha}}</td>    
        </tr>
        <tr>
            <th scope="row">Nombre completo del empleado</th>
            <td>{{$inventario->empleado->nombres}}{{' '}}{{$inventario->empleado->apellidos}}</td>    
        </tr>
        <tr>
            <th scope="row">Teléfono del empleado</th>
            <td>{{$inventario->empleado->telefono}}</td>    
        </tr>
        <tr>
            <th scope="row">Nombre oficina</th>
            <td>{{$inventario->oficina->nombreOficina}}</td>    
        </tr>
    </tbody>
</table>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
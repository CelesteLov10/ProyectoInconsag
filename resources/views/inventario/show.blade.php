@can('Admin.inventario.show')
@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1> Detalles del inventario</h1>
@stop

@section('content')
    
<div>
    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('inventario.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-black">Detalles de {{$inventario->nombreInv}}</h5 > 
            </div >

        <div class="m-0 text-left align-items-center justify-content-center">
            <div class=" bg-light p-5">
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
                <th scope="row">Precio del Inventario</th>
                <td>{{$inventario->precioInv}}</td>    
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
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@stop

@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@stop
@endcan
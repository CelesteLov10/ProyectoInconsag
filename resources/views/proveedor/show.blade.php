@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1>Detalles del proveedor</h1>
    <hr>
@stop

@section('content')

<div class="container ">
    <div class="mb-3 text-end" id="titulo">
        <a class="btn btn-outline-primary" href="{{route('proveedor.index')}}">
            <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>
    {{-- encabezado --}}
    <div class = " card shadow ab-4 btaura">
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold ">Detalles de {{$proveedor->nombreProveedor}}</h5 > 
        </div >

    <div class="m-0 text-left align-items-center justify-content-center">
        <div class="bg-light p-5">
<table class="table">
    <thead class="table-light">
        <tr>
            <th scope="col" class="col-md-4">Datos</th>
            <th scope="col">Información</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">Nombre del proveedor</th>
            <td>{{$proveedor->nombreProveedor}}</td>    
        </tr>
        <tr>
            <th scope="row">Nombre del contacto</th>
            <td>{{$proveedor->nombreContacto}}</td>    
        </tr>
        <tr>
            <th scope="row">Cargo del contacto</th>
            <td>{{$proveedor->cargoContacto}}</td>    
        </tr>
        <tr>
            <th scope="row">Teléfono</th>
            <td>{{$proveedor->telefono}}</td>    
        </tr>
        <tr>
            <th scope="row">Correo</th>
            <td>{{$proveedor->email}}</td>    
        </tr>
        <tr>
            <th scope="row">Dirección</th>
            <td>{{$proveedor->direccion}}</td>    
        </tr>
        <tr>
            <th scope="row">Categoría</th>
            <td>{{$proveedor->categoria->nombreCat}}</td>    
        </tr>
    
    </tbody>
</table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@stop

@section('js')
    {{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@stop
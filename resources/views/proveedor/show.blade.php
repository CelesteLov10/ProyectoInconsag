@extends('layout.plantillaH')

@section('titulo', 'Detalle de proveedor')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 


<div class="mb-5">
    <h4 class=" text-center">
        <strong>Detalle de proveedor</strong> 
    </h4>   
</div>

<div class="container ">
    <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('proveedor.index')}}">
            <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>
    {{-- encabezado --}}
    <div class = " card shadow ab-4 " >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-primary">Detalles de {{$proveedor->nombreProveedor}}</h5 > 
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
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
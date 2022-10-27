@extends('layout.plantillaH')

@section('titulo', 'Detalle de oficina')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
<div class="mb-5 m-5">
    <h2 class=" text-center">
        <strong>Detalle de oficina</strong> 
    </h2>   
</div>

<div class="container ">
    <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('oficina.index')}}">
            <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>
    {{-- encabezado --}}
    <div class = " card shadow ab-4 bg-success bg-gradient" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white">Detalles de {{$oficina->nombreOficina}}</h5 > 
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
            <th scope="row">Nombre de la oficina</th>
            <td>{{$oficina->nombreOficina}}</td>    
        </tr>
        <tr>
            <th scope="row">Municipio</th>
            <td>{{$oficina->municipio}}</td>    
        </tr>
        <tr>
            <th scope="row">Dirección</th>
            <td>{{$oficina->direccion}}</td>    
        </tr>
        <tr>
            <th scope="row">Nombre del gerente</th>
            <td>{{$oficina->nombreGerente}}</td>    
        </tr>
        <tr>
            <th scope="row">Teléfono del gerente</th>
            <td>{{$oficina->telefono}}</td>    
        </tr>
    
    </tbody>
</table>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
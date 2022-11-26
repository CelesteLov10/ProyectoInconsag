@extends('layout.plantillaH')

@section('titulo', 'Detalle de cliente')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h2 class=" text-center">
            <strong id="titulo">Detalle de cliente</strong> 
        </h2>   
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('cliente.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 bg-success bg-gradient " >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de {{$cliente->nombreCompleto}} </h5> 
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
                <th scope="row">Identidad</th>
                <td>{{$cliente->identidadC}}</td>    
            </tr>
            <tr>
                <th scope="row">Nombre completo</th>
                <td>{{$cliente->nombreCompleto}}</td>    
            </tr>
            <tr>
                <th scope="row">Teléfono</th>
                <td>{{$cliente->telefono}}</td>    
            </tr>
            <tr>
                <th scope="row">Dirección</th>
                <td>{{$cliente->direccion}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha de nacimiento</th>
                <td>{{$cliente->fechaNacimiento}}</td>    
            </tr>
        </tbody>
    </table>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
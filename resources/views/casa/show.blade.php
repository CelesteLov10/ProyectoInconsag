@extends('layout.plantillaH')

@section('titulo', 'Detalle de casa modelo')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
        Detalle de la casa modelo
        </h3>
        <hr>
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('casa.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de {{$casa->claseCasa}} </h5> 
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
                <th scope="row">Nombre del estilo de la casa:</th>
                <td>{{$casa->claseCasa}}</td>    
            </tr>
            <tr>
                <th scope="row">Valor de la casa:</th>
                <td>{{$casa->valorCasa}}</td>    
            </tr>
            <tr>
                <th>Cantidad de habitaciones:</th>
                <td>{{$casa->cantHabitacion}}</td>
            </tr>
            <tr>
                <th>Descripción:</th>
                <td>{{$casa->descripcion}}</td>
            </tr>
            <tr>
                <th>Nombre constructora:</th>
                <td>{{$casa->constructora->nombreConstructora}}</td>
            </tr>
            <tr>
                <th scope="row">Foto de la casa:</th>
                <td>
                   
                        <img src="{{asset($casa->subirCasa)}}" alt="foto"
                         class="img-fluid" width="395px" height="150px">
                  
                </td>    
            </tr>
        </tbody>
    </table>
    
    </div>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
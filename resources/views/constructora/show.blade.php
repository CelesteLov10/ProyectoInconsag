@can('Admin.constructora.show')
@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1>Detalles de la Constructora</h1>
    <hr>
@stop

@section('content')

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('constructora.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-black">Detalles de {{$constructora->nombreConstructora}} </h5> 
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
                <th scope="row">Nombre Constructora</th>
                <td>{{$constructora->nombreConstructora}}</td>    
            </tr>
            <tr>
                <th scope="row">Dirección</th>
                <td>{{$constructora->direccion}}</td>    
            </tr>
            <tr>
                <th scope="row">Teléfono</th>
                <td>{{$constructora->telefono}}</td>    
            </tr>
            <tr>
                <th scope="row">Correo electrónico</th>
                <td>{{$constructora->email}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha del Contrato</th>
                <td>{{$constructora->fechaContrato}}</td>    
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
    <script> console.log('Hi!'); </script>
@stop
@endcan
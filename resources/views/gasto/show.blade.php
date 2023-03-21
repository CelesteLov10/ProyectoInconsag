@can('Admin.gasto.show')
@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1>Detalles del gasto</h1>
    <hr>
@stop

@section('content')

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('gasto.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-black">Detalles del gasto {{$gasto->nombreGastos}} </h5 > 
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
                <th scope="row">Titulo del gasto</th>
                <td>{{$gasto->nombreGastos}}</td>    
            </tr>
            <tr>
                <th scope="row">Monto del gasto</th>
                <td>{{$gasto->montoGastos}}</td>    
            </tr>
            <tr>
                <th scope="row">Nombre de la empresa</th>
                <td>{{$gasto->nombreEmpresa}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha</th>
                <td>{{$gasto->fechaGastos}}</td>    
            </tr>
            <tr>
                <th scope="row">Descripción</th>
                <td>{{$gasto->descripcion}}</td>    
            </tr>
            <tr>
                <th scope="row">Empleado responsable</th>
                <td>{{$gasto->empleado->nombres}}{{$gasto->empleado->apellidos}}</td> 
            </tr>
            <tr>
                <th scope="row">Foto del bloque</th>
                <td>
                    <div class="card-header">
                        <img src="{{asset($gasto->baucherRecibo)}}" alt="foto" class="img-fluid" width="700px" height="150px">
                    </div>
                </td>    
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
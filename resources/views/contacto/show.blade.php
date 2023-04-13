@can('Admin.contacto.show')
@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <h1>Detalles del cliente</h1>
    <hr>
@stop

@section('content')
    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('contacto.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles del contacto </h5> 
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
                <th scope="row">Nombre(s)</th>
                <td>{{$contacto->nombre}}</td>    
            </tr>
            <tr>
                <th scope="row">Apellido(s)</th>
                <td>{{$contacto->apellido}}</td>    
            </tr>
            <tr>
                <th scope="row">Teléfono</th>
                <td>{{$contacto->telefono}}</td>    
            </tr>
            <tr>
                <th scope="row">Correo electrónico</th>
                <td>{{$contacto->correo}}</td>    
            </tr>
            <tr>
                <th scope="row">Mensaje</th>
                <td>{{$contacto->mensaje}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha de registro</th>
                <td>{{$contacto->fecha}}</td>    
            </tr>
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
     {{-- cdn para el css de los emojis de fontawesomw --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    {{-- plugins para el buscador jquery ui --}}
    <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@stop
@endcan

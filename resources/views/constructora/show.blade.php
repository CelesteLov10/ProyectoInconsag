@extends('layout.plantillaH')

@section('titulo', 'Detalle de la constructora')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div class="mb-5 m-5">
    <h3 class=" text-center">
      Detalles de la Constructora
    </h3>
    <hr>
</div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('constructora.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de {{$constructora->nombreConstructora}} </h5> 
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
                <th scope="row">Nombre Constructora</th>
                <td>{{$constructora->nombreConstructora}}</td>    
            </tr>
            <tr>
                <th scope="row">Dirección</th>
                <td>{{$constructora->direccion}}</td>    
            </tr>
            <tr>
                <th scope="row">Telefono</th>
                <td>{{$constructora->telefono}}</td>    
            </tr>
            <tr>
                <th scope="row">Email</th>
                <td>{{$constructora->email}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha del Contrato</th>
                <td>{{$constructora->fechaContrato}}</td>    
            </tr>
            
        </tbody>
    </table>
</div>
@endsection
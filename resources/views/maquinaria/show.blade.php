@extends('layout.plantillaH')

@section('titulo', 'Detalle de Maquinaria')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h2 class=" text-center">
            <strong>Detalle de Maquinaria</strong> 
        </h2>   
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('maquinaria.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 bg-success bg-gradient" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de la maquinaria {{$maquinaria->maquinaria}}</h5 > 
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
                <th scope="row">Nombre de maquinaria</th>
                <td>{{$maquinaria->nombreMaquinaria}}</td>    
            </tr>
            <tr>
                <th scope="row">Modelo</th>
                <td>{{$maquinaria->modelo}}</td>    
            </tr>
            <tr>
                <th scope="row">Placa</th>
                <td>{{$maquinaria->placa}}</td>    
            </tr>

            <tr>
                <th scope="row">Cantidad de Maquinaria</th>
                <td>{{$maquinaria->cantidadMaquinaria}}</td>    
            </tr>
            <tr>
                <th scope="row">Descripción</th>
                <td>{{$maquinaria->descripcion}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha de Adquisición</th>
                <td>{{$maquinaria->fechaAdquisicion}}</td>    
            </tr>
            <tr>
                <th scope="row">Cantidad Hora Alquilada</th>
                <td>{{$maquinaria->cantidadHoraAlquilada}}</td>    
            </tr>
            <tr>
                <th scope="row">valor por Hora</th>
                <td>{{$maquinaria->valorHora}}</td>    
            </tr>
            <tr>
                <th scope="row">total a Pagar</th>
                <td>{{$maquinaria->totalPagar}}</td>    
            </tr>
            <tr>
                <th scope="row">proveedor</th>
                <td>{{$maquinaria->proveedor_id}}</td>    
            </tr>
        </tbody>
    </table>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
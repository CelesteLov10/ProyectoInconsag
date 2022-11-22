@extends('layout.plantillaH')

@section('titulo', 'Detalle de bloque')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h2 class=" text-center">
            <strong id="titulo">Detalle de bloque</strong> 
        </h2>   
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('bloque.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 bg-success bg-gradient " >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de {{$bloque->nombreBloque}} </h5> 
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
                <th scope="row">Nombre del boque</th>
                <td>{{$bloque->nombreBloque}}</td>    
            </tr>
            <tr>
                <th scope="row">Cantidad de lotes</th>
                <td>{{$bloque->cantidadLotes}}</td>    
            </tr>
            <tr>
                <th scope="row">Foto del bloque</th>
                <td>
                    <div class="card-header">
                        <img src="{{asset($bloque->subirfoto)}}" alt="foto" class="img-fluid" width="700px" height="150px">
                    </div>
                </td>    
            </tr>
        </tbody>
    </table>
        {{-- TABLA NO RESPONSIVA... MUESTRA LOS LOTES DE UN BLOQUE --}}
    <table class="table border border-2 rounded-pill">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre del bloque</th>
                <th scope="col">Número de lote</th>
                <th scope="col">Medida lateral derecha:</th>
                <th scope="col">Medida lateral izquierda:</th>
                <th scope="col">Medida lateral enfrente:</th>
                <th scope="col">Medida lateral trasera:</th>
                <th scope="col">Colindancia Norte:</th>
                <th scope="col">Colindancia Sur:</th>
                <th scope="col">Colindancia Este:</th>
                <th scope="col">Colindancia Oeste:</th>
            </tr>
        </thead>
        <tbody>
        
        @forelse($lotes as $lote)
            @if($bloque->id == $lote->bloque_id)
                <tr>
                    <td>{{$lote->id}}</td>
                    <td>{{$lote->nombreBloque}}</td>
                    <td>{{$lote->numLote}}</td>
                    <td>{{$lote->medidaLateralR}}</td>
                    <td>{{$lote->medidaLateralL}}</td>
                    <td>{{$lote->medidaEnfrente}}</td>
                    <td>{{$lote->medidaAtras}}</td>
                    <td>{{$lote->colindanciaN}}</td>
                    <td>{{$lote->colindanciaS}}</td>
                    <td>{{$lote->colindanciaE}}</td>
                    <td>{{$lote->colindanciaO}}</td>
                        @csrf
                </tr>
                @endif
        
        @empty
        
            <tr>
                <td col-span="4">No hay registros</td>
            </tr>
        
        @endforelse
        
        </tbody>
    </table>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
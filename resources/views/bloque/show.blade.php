@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1> Detalle del bloque</h1>
    <hr>
@stop

@section('content')
<div>
    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('bloque.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de {{$bloque->nombreBloque}} </h5> 
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
                <th scope="row">Nombre del bloque</th>
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
    
    <br>
        {{-- TABLA NO RESPONSIVA... MUESTRA LOS LOTES DE UN BLOQUE --}}
    <table class="table border border-2 contorno-azul">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nombre de lote</th>
                <th scope="col">Estado</th>
                <th scope="col">Medida lateral derecha:</th>
                <th scope="col">Medida lateral izquierda:</th>
                <th scope="col">Medida lateral enfrente:</th>
                <th scope="col">Medida lateral trasera:</th>
                <th scope="col">Valor terreno:</th>
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
                    <td>{{$lote->nombreLote}}</td>

                    {{-- para cambiar el estado del lote--}}
                    @if ($lote->status == 'Vendido')
                    <td>
                        <a class="jsgrid-button btn btn-danger">
                            Vendido<i class="bi bi-check2-square"></i>
                        </a>
                        </td>  
                    @else
                    <td>
                        <a class="jsgrid-button btn btn-success">
                            Disponible<i class="bi bi-check2-square"></i>
                        </a>
                    </td>
                    @endif

                    <td>{{$lote->medidaLateralR}}</td>
                    <td>{{$lote->medidaLateralL}}</td>
                    <td>{{$lote->medidaEnfrente}}</td>
                    <td>{{$lote->medidaAtras}}</td>
                    <td>{{$lote->valorTerreno}}</td>
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
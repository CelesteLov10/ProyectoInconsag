@extends('layout.plantillaH')

@section('titulo', 'Detalle de bloque')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
        Detalle de pago del lote
        </h3>
        <hr>
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn g btn-outline-success" href="{{route('pago.create', ['id'=>$venta->id])}}"><i class="bi bi-currency-dollar"></i>Nuevo pago </a>

            <a class="btn btn-outline-primary" href="{{route('pago.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles de {{$venta->lote->nombreLote}} </h5> 
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
                <th scope="row">Nombre del lote</th>
                <td>{{$venta->lote->nombreLote}}</td>
            </tr>
            <tr>
                <th scope="row">Valor del lote</th>
                <td>{{$venta->lote->valorTerreno}}</td>
            </tr> 
            <tr>
                <th scope="row">Nombre del cliente</th>
                <td>{{$venta->cliente->nombreCompleto}}</td>
            </tr>
            <tr>
                <th scope="row">Saldo anterior</th>
                <td oninput="calcularSaldo()" id="valorRestantePagar">{{$venta->valorRestantePagar}}</td>
            </tr>
        </tbody>
    </table>
    
    <br>
        {{-- TABLA NO RESPONSIVA... MUESTRA LOS LOTES DE UN BLOQUE --}}
    <table class="table border border-2 contorno-azul">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Fecha pago:</th>
                <th scope="col">Cantidad cuotas pagadas:</th>
                <th oninput="calcularSaldo()" scope="col" id="cuotasPagadas">Total de cuotas pagadas:</th>    
                <th scope="col" id="nuevoSaldo">Nuevo saldo</th>
            </tr>
        </thead>
        
        
    </table>

    </div>
    
</div>

@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>

<script>
    try
    {function calcularSaldo(){
    var valorRestantePagar  = document.getElementById('valorRestantePagar').value;
    var cuotasPagadas = document.getElementById('cuotasPagadas').value;
    var nuevoSaldo = document.getElementById('nuevoSaldo');

    var resultado = valorRestantePagar - cuotasPagadas;

    nuevoSaldo.value = resultado;
        }
    }catch (error) {throw error;}
</script>
@endsection
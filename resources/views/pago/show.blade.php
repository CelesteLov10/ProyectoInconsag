@extends('layout.plantillaH')

@section('titulo', 'Detalle de bloque')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
        Listado de pago del lote
        </h3>
        <hr>
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn g btn-outline-success" href="{{route('pago.create', ['id'=>$pago1->id])}}"><i class="bi bi-currency-dollar"></i>Nuevo pago </a>

            <a class="btn btn-outline-primary" href="{{route('pago.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Listado de pago del {{$venta->lote->nombreLote}} </h5> 
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
                <th scope="row">Saldo despues de prima</th>
                <td  id="valorRestantePagar" oninput="calcularSaldo()">{{$venta->valorRestantePagar}}</td>
            </tr>
        
        </tbody>
    </table>
    
    <br>
        {{-- TABLA NO RESPONSIVA... MUESTRA LOS LOTES DE UN BLOQUE --}}
    <table class="table border border-2 contorno-azul">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Fecha pago:</th>
                <th scope="col">Cantidad cuotas pagadas:</th>
                <th>Total en cuotas</th>
                <th >Nuevo saldo</th>
                <th scope="col">Imprimir comprobante</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pago as $pagos)
            @if ($venta->id == $pagos->venta_id)
            <tr>
                <td>{{$pagos->fechaPago}}</td>
                <td>{{$pagos->cantidadCuotasPagar}}</td>
                <td id="saldoEnCuotas">{{$pagos->saldoEnCuotas}}</td>
                <td  id="nuevoSaldo2" oninput="calcularSaldo2()">{{$pagos->valorTerrenoPagar}}</td>
                <td ><a href="{{route('pago.print', ['id'=>$pagos->id])}}" class="btn btn-outline-warning"><i class="bi bi-filetype-pdf"></i></a></td>
            </tr>

            @endif
            @endforeach
        </tbody>
        <tr>
            <th scope="col" class="col-md-4">Total pagando o que queda debiendo</th>
            <td>Hola</td>
        </tr>
        
    </table>
    <table>
        {{--     <div  class="col-12 col-md-3 text-center">
                <span>Total de ingresos por cuota: </span>
                <div class="form-group">
                    <strong>{{$saldoEnCuotas}}</strong>
                </div>
            </div> --}}
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
    var saldoEnCuotas  = document.getElementById('saldoEnCuotas').value;
    var valorRestantePagar = document.getElementById('valorRestantePagar').value;

    var resultado =  valorRestantePagar - saldoEnCuotas;

    valorRestantePagar.value = resultado;
        }
    }catch (error) {throw error;}
</script>
<script>
    try{
        function calcularSaldo2(){
            var saldoEnCuotas = document.getElementById('saldoEnCuotas').value;
            var nuevoSaldo = document.getElementById('nuevoSaldo2');

            var resul = nuevoSaldo - saldoEnCuotas;

            nuevoSaldo.value = resul;
        }
    }catch (error){
        throw error;
    }
</script>
<script></script>
@endsection
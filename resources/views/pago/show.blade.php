@can('Admin.pago.show')
@extends('adminlte::page')

@section('title', 'Listado')

@section('content_header')
    <h1>Listado de pago del lote</h1>
    <hr>
@stop

@section('content')
<div>
    <?php $cantidadCu = 0?>

    <div class="container ">
        <div class="mb-3 text-end">

            {{-- Condicion para que muestre el boton deshabilitado en caso de cumplir todos los meses --}}
            @foreach ($pago as $pagos)
                @if ($venta->id == $pagos->venta_id)
                    <?php $cantidadCu = $cantidadCu + $pagos->cantidadCuotasPagar?>
                @endif
            @endforeach

            {{-- condicion --}}
            {{-- condicion --}}
            @if ($cantidadCu >= $venta->cantidadCuotas)
            {{-- si el lote, se termino de pagar. se activara este boton para que ya no lo deje seguir pagando cuotas --}}
            {{-- si el lote, se termino de pagar. se activara este boton para que ya no lo deje seguir pagando cuotas --}}
                    <button class="btn g btn-outline-success" disabled><i class="bi bi-currency-dollar"></i>Nuevo pago</button>
                    {{-- si se termino de pagar, el boton de liberar lote estara desactivado --}}
                    <td>
                        <button class="btn btn-outline-danger text-BLACK"  disabled="true">
                            Liberar lote <i  id="textnegro" class="bi bi-lock-fill"></i>
                        </button>
                    </td>
                    @else
                    {{-- si no se ha terminado de pagar el lote, aparecera el boton de 'nuevo pago' --}}
                    <a class="btn g btn-outline-success" href="{{route('pago.create', ['id'=>$pago1->id])}}" ><i class="bi bi-currency-dollar"></i>Nuevo pago </a>
                    {{-- si el cliente ya no quiere pagar el lote entonces se puede liberar.
                        o si no ha pagado el lote por mas de 3 meses entonces se podra liberar --}}
                    <td>
                        <a class="btn btn-outline-danger text-BLACK" href="{{route('liberado.create', ['id'=>$pago1->id])}}"><i class="bi bi-unlock-fill"></i> Liberar lote</a>
                    </td>
                    @endif
            <a class="btn btn-outline-primary" href="{{route('pago.index')}}"><i class="bi bi-box-arrow-in-left"></i> Atrás</a>

        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Listado de pago de {{$venta->lote->nombreLote}} </h5> 
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
                <th scope="row">Nombre del lote</th>
                <td>{{$venta->lote->nombreLote}}</td>
            </tr>
            <tr>
                <th scope="row">Valor del lote</th>
                <td>L. {{number_format($venta->lote->valorTerreno , 2)}}</td>
            </tr> 
            <tr>
                <th scope="row">Nombre del cliente</th>
                <td>{{$venta->cliente->nombreCompleto}}</td>
            </tr>
            <tr>
                <th scope="row">Saldo despues de prima</th>
                <td  id="valorRestantePagar" oninput="calcularSaldo()">L. {{number_format($venta->valorRestantePagar , 2)}}</td>
            </tr>
            <tr>
                <th scope="row">Imprimir pagos</th>
                <td><a class="btn glow-on-hover-main text-BLACK" href="{{route('pago.pdf', ['id'=>$pago1->id])}}" value="imprimir" title="Imprimir PDF"><i class="bi bi-printer text-BLACK"></i></a></td>
            </tr>
        </tbody>
    </table>
    
    <br>
        {{-- TABLA NO RESPONSIVA... MUESTRA LOS LOTES DE UN BLOQUE --}}
    <table class="table border border-2 contorno-azul">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Fecha pago:</th>
                <th scope="col">Cant. cuotas pagadas (meses):</th>
                <th scope="col">Total en cuotas</th>
                <th scope="col">Nuevo saldo</th>
                <th scope="col">Imprimir comprobante</th>
            </tr>
        </thead>
        <tbody>
            <?php $total = 0?> {{-- Se define la variable total--}}
            <?php $cantCuotas = 0?>
            @foreach ($pago as $pagos)
            @if ($venta->id == $pagos->venta_id)
            <tr>
                <td>{{$pagos->fechaPago}}</td>
                <td>{{$pagos->cantidadCuotasPagar}}</td>
                <td id="saldoEnCuotas">{{number_format($pagos->saldoEnCuotas, 2)}}</td>
                <?php $total = $total + $pagos->saldoEnCuotas ?>
                <?php $cantCuotas = $cantCuotas + $pagos->cantidadCuotasPagar?>
                <td  id="nuevoSaldo2" oninput="calcularSaldo2()">{{number_format($pagos->valorTerrenoPagar, 2)}}</td>
                <td ><a href="{{route('pago.print', ['id'=>$pagos->id])}}" class="btn btn-outline-warning"><i class="bi bi-filetype-pdf"></i></a></td>
            </tr>

            @endif
            @endforeach
        </tbody>
        <tr>
            <th scope="col" class="col-md-4">Total:</th>
            <td>{{number_format($cantCuotas )}} / {{$venta->cantidadCuotas}}</td>
            <td>L. {{number_format($total , 2)}}</td>
        </tr>
        <tr>
            <th scope="col" class="col-md-4">Saldo Pendiente</th>
            <td>L. {{number_format($venta->valorRestantePagar - $total, 2)}}</td>
        </tr>
        
    </table>
    <table>
    </table>

    </div>
    
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    {{--plugins para el buscador jquery ui --}}
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
@stop
@endcan
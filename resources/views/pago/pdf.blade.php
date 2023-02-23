<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pagos pdf</title>
    
    <style>
        table,td,th {
        border: 1px solid rgb(99, 99, 99);
        border-spacing: auto;
        border-collapse: collapse;
        table-layout: auto;
        margin: auto;
        text-align: center;
        }
    
        h2 {
        text-align: center;
        }
    </style>
</head>
<body>
    <h2>Listado de pagos de {{$venta->lote->nombreLote}} </h2>
    <div class="container">
        <table>
            <tr>
                <th scope="col">Fecha pago</th>
                <th scope="col">Cantidad cuotas pagadas</th>
                <th>Total en cuotas</th>
                <th >Nuevo saldo</th>
            </tr>
            <tbody>
            <?php $total = 0?>
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
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <br>
        <table>
            <tr>
                <th scope="col" class="col-md-4" style="text-align: left">Cantidad de cuotas pagadas:</th>
                <td style="text-align: right">{{number_format($cantCuotas )}} / {{$venta->cantidadCuotas}}</td>
            </tr>
            <tr>
                <th scope="col" class="col-md-4" style="text-align: left">Total de cuotas pagadas:</th>
                <td style="text-align: right">L. {{number_format($total , 2)}}</td>
            </tr>
            <tr>
                <th scope="col" class="col-md-4" style="text-align: left">Saldo Pendiente</th>
                <td style="text-align: right">L. {{number_format($venta->valorRestantePagar - $total, 2)}}</td>
            </tr>
        </table>
        <br>
    </div>
</body>
</html>
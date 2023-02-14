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
    <h2>Listado de pagos </h2>
    <div class="container">
        <table>
            <tr>
                <th scope="col">Fecha pago</th>
                <th scope="col">Cantidad cuotas pagadas</th>
                <th>Total en cuotas</th>
                <th >Nuevo saldo</th>
            </tr>
            <tbody>
                
                @foreach ($pago as $pagos)
            @if ($venta->id == $pagos->venta_id)
                <tr>
                    <td>{{$pagos->fechaPago}}</td>
                    <td>{{$pagos->cantidadCuotasPagar}}</td>
                    <td>{{$pagos->saldoEnCuotas}}</td>
                    <td>{{$pagos->valorTerrenoPagar}}</td>                
                </tr>
                @endif
                @endforeach
                
            </tbody>
        </table>
        <br>
    </div>
</body>
</html>
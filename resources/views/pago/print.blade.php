<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>

    <h2>RECIBO DE PAGO</h2>

    
    <h3>id: {{$venta->cliente->nombreCompleto}}</h3>
    <h3>id: {{$pago->id}}</h3>
    <h3>Fecha: {{$pago->fechaPago}}</h3>
    <h3>cuotaPagar: {{$pago->cuotaPagar}}</h3>
    <h3>aldoEnCuotas {{$pago->saldoEnCuotas}}</h3>
    <h3>alorTerrenoPagar {{$pago->valorTerrenoPagar}}</h3>
    <h3>uevoSaldo {{$pago->nuevoSaldo}}</h3>
</html>

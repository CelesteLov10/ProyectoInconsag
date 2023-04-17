<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte por fecha</title>
    
    <style>
        table{
            width: 100%;
        border-collapse: collapse; 
        }
        table,td,th {
        border: 1px solid rgb(99, 99, 99);
        border-spacing: auto;
        border-collapse: collapse;
        table-layout: auto;
        margin: auto;
        text-align: center;
        }
        th, td {
        padding: 5px;
        text-align: center;
    }
    
        h2 {
        text-align: center;
        }
    </style>

{{--<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    
    table, th, td {
        border: 1px solid black;
    }
    
    th, td {
        padding: 5px;
        text-align: left;
    }
</style>--}}
</head>
<body>
    <h2>Reporte por fecha </h2>
    <div class="container">
        <table>
                <tr>
                <th scope="row">Nombre del cliente</th>
                <th scope="col">Forma de venta</th>
                <th scope="row">Fecha de venta</th>
                </tr>
            <tbody>
            @forelse($ventas as $venta)
                <tr>
                    <td>{{$venta->cliente->nombreCompleto}}</td>
                    <td>{{$venta->formaVenta}}</td>
                    <td>{{$venta->fechaVenta}}</td>
                @csrf
                </tr>
                @empty
                <tr>
                <td col-span="4">No hay registros</td>
                </tr>
            @endforelse 
            </tbody>
        </table>
    </div>
</body>
</html>
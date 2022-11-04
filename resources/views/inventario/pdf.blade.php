<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventario pdf</title>
    
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
    <h2>Listado de inventario</h2>
    <div class="container">
        <table>
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Nombre de inventario</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Oficina</th>
                <th scope="col">Empleado</th>
                <th scope="col">Fecha</th>
                </tr>
            <tbody>
            @forelse($inventarios as $inventario)
                <tr>
                <td>{{$inventario->id}}</td>
                <td>{{$inventario->nombreInv}}</td> 
                <td>{{$inventario->cantidad}}</td>   
                <td>{{$inventario->precioInv}}</td> 
                <td>{{$inventario->oficina->nombreOficina}}</td> 
                <td>{{$inventario->empleado->nombres}}</td> 
                <td>{{$inventario->fecha}}</td> 
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
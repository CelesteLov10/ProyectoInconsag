@can('Admin.maquinaria.pdf')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maquinaria pdf</title>
    
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
    <h2>Listado de maquinaria</h2>
    <div class="container">
        <table>
                <tr>
                <th scope="row">No.</th> 
                <th scope="row">Nombre de maquinaria</th>
                <th scope="col">Maquinaria</th>
                <th scope="row">Placa</th>
                <th scope="row">Adquisición</th>
                <th scope="row">Proveedor</th>
                <th scope="row">Horas alquilada</th>
                <th scope="row">Valor hora</th>
                <th scope="row">Total a pagar</th>
                </tr>
            <tbody>
            @forelse($maquinarias as $maquinaria)
                <tr>
                    <td>{{$maquinaria->id}}</td>
                    <td>{{$maquinaria->nombreMaquinaria}}</td>
                    <td>{{$maquinaria->maquinaria}}</td>
                    <td>{{$maquinaria->placa}}</td>  
                    <td>{{$maquinaria->fechaAdquisicion}}</td>   
                    <td>{{$maquinaria->proveedor->nombreProveedor}}</td>
                    <td>{{$maquinaria->cantidadHoraAlquilada}}</td> 
                    <td>{{$maquinaria->valorHora}}</td> 
                    <td>{{$maquinaria->totalPagar}}</td>
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
@endcan
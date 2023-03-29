<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Imprimir planilla</title>
    
    <style>
        
        table,td,th {
        border: 1px solid rgb(99, 99, 99);
        border-spacing: auto;
        border-collapse: collapse;
        table-layout: auto;
        /* margin: auto; */
        align-content: center;
        font-size: auto;
        text-align: center;
        }

        h3 {
        text-align: center;
        }
    </style>
</head>
<body>

    <h3>Planilla del {{$tablaplanillas->fechap}}</h3>
    <div class="container">
        <table style="text-align: left">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Identidad del empleado</th>
                    <th scope="col">Nombre del empleado</th>
                    <th scope="col">Puesto laboral</th>
                    <th scope="col">Sueldo</th>
                    <th scope="col">Días que trabajo</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($detallesplanilla as $detallesplanillas)
            @if ($tablaplanillas->fechap == $detallesplanillas->fecha)
                <tr>
                  <td>{{$detallesplanillas->empleado->identidad}}</td>
                  <td>{{$detallesplanillas->empleado->nombres}}{{' '}}{{$detallesplanillas->empleado->apellidos}}</td>   
                  <td>{{$detallesplanillas->empleado->puesto->nombreCargo}}</td>
                  <td>{{$detallesplanillas->empleado->puesto->sueldo}}</td>
                  <td>{{$detallesplanillas->dias}}</td>
                  <td>{{number_format($detallesplanillas->total, 2)}}</td>
                </tr>
            @endif
            @endforeach
                 
            </tbody>

            </table>
            <br>
            <table>
            <tbody>
              <th style="text-align: left" scope="col">Total planilla:</th>
              <td>L. {{number_format($tablaplanillas->totalp, 2)}}</td>
            </tr>
            <tr>
              <th style="text-align: left" scope="col">Total empleados:</th>
              <td style="text-align: center">{{$tablaplanillas->canEmpleados}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

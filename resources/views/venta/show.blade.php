@extends('layout.plantillaH')

@section('titulo', 'Detalle de venta')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div class="mb-5 m-5">
    <h3 class=" text-center">
        Detalles venta
    </h3>
    <hr>
  </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('venta.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalle de venta {{$venta->formaVenta}}</h5 > 
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
            @if($venta->valorPrima == null)
                <tr>
                    <th scope="row">Nombre del cliente:</th>
                    <td>{{$venta->cliente->nombreCompleto}}</td>    
                </tr>
                <tr>
                    <th scope="row">Nombre del bloque:</th>
                    <td>{{$venta->bloque->nombreBloque}}</td>    
                </tr>
                <tr>
                    <th scope="row">Número del lote:</th>
                    <td>{{$venta->lote->numLote}}</td>    
                </tr>
            
                <tr>
                    <th scope="row">Valor del terreno:</th>
                    <td>{{$venta->valorTerreno}}</td>    
                </tr>
                <tr>
                    <th scope="row">Fecha venta:</th>
                    <td>{{$venta->fechaVenta}}</td>    
                </tr>
               
            @else
                <tr>
                    <th scope="row">Nombre del cliente:</th>
                    <td>{{$venta->cliente->nombreCompleto}}</td>   
                </tr>
                <tr>
                    <th scope="row">Nombre del bloque:</th>
                    <td>{{$venta->bloque->nombreBloque}}</td>       
                </tr>
                <tr>
                    <th scope="row">Número del lote:</th>
                    <td>{{$venta->lote->numLote}}</td>     
                </tr>
            
                <tr>
                    <th scope="row">Valor del terreno:</th>
                    <td>{{$venta->valorTerreno}}</td>    
                </tr>
                <tr>
                    <th scope="row">Fecha venta:</th>
                    <td>{{$venta->fechaVenta}}</td>    
                </tr>
                <tr>
                    <th scope="row">Valor prima:</th>
                    <td>{{$venta->valorPrima}}</td>    
                </tr>
                <tr>
                    <th scope="row">Cantidad de cuotas:</th>
                    <td>{{$venta->cantidadCuotas}}</td>    
                </tr>
                <tr>
                    <th scope="row">Valor cuota:</th>
                    <td>{{$venta->valorCuotas}}</td>    
                </tr>
             
                <tr>
                    <th scope="row">Valor restante a pagar:</th>
                    <td>{{$venta->valorRestantePagar}}</td>    
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
        

@section('js')

<script>
    
    if (document.getElementById('valorPrima') == ""){
        document.getElementById("cha").innerHTML = " ";
    }
    if (document.getElementById('cantidadCuotas') == ""){
        document.getElementById("vph").innerHTML = " ";
    }
    //if (document.getElementById('cantidadAlquilada') == ""){
    //    document.getElementById("cma").innerHTML = " ";
    //}
    if (document.getElementById('valorCuotas') == ""){
        document.getElementById("tap").innerHTML = " ";
    }
    if (document.getElementById('valorRestantePagar') == ""){
        document.getElementById("kio").innerHTML = " ";
    }
        
</script>

@endsection


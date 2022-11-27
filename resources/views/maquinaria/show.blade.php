@extends('layout.plantillaH')

@section('titulo', 'Detalle de Maquinaria')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div class="mb-5 m-5">
    <h3 class=" text-center">
        Detalles de la maquinaria
    </h3>
    <hr>
  </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('maquinaria.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalle de la maquinaria {{$maquinaria->maquinaria}}</h5 > 
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
            @if($maquinaria->cantidadHoraAlquilada == null)
                <tr>
                    <th scope="row">Nombre de maquinaria</th>
                    <td>{{$maquinaria->nombreMaquinaria}}</td>    
                </tr>
                <tr>
                    <th scope="row">Modelo</th>
                    <td>{{$maquinaria->modelo}}</td>    
                </tr>
                <tr>
                    <th scope="row">Placa</th>
                    <td>{{$maquinaria->placa}}</td>    
                </tr>
            
                <tr>
                    <th scope="row">Descripción</th>
                    <td>{{$maquinaria->descripcion}}</td>    
                </tr>
                <tr>
                    <th scope="row">Fecha de adquisición</th>
                    <td>{{$maquinaria->fechaAdquisicion}}</td>    
                </tr>
                <tr>
                    <th scope="row">Proveedor</th>
                    <td>{{$maquinaria->proveedor->nombreProveedor}}</td>    
                </tr>
            @else
                <tr>
                    <th scope="row">Nombre de maquinaria</th>
                    <td>{{$maquinaria->nombreMaquinaria}}</td>    
                </tr>
                <tr>
                    <th scope="row">Modelo</th>
                    <td>{{$maquinaria->modelo}}</td>    
                </tr>
                <tr>
                    <th scope="row">Placa</th>
                    <td>{{$maquinaria->placa}}</td>    
                </tr>
            
                <tr>
                    <th scope="row">Descripción</th>
                    <td>{{$maquinaria->descripcion}}</td>    
                </tr>
                <tr>
                    <th scope="row">Fecha de adquisición</th>
                    <td>{{$maquinaria->fechaAdquisicion}}</td>    
                </tr>
                <tr>
                    <th scope="row">Proveedor</th>
                    <td>{{$maquinaria->proveedor->nombreProveedor}}</td>    
                </tr>
                <tr>
                    <th scope="row">Cantidad de hora Alquilada</th>
                    <td>{{$maquinaria->cantidadHoraAlquilada}}</td>    
                </tr>
                <tr>
                    <th scope="row">Valor por hora</th>
                    <td>{{$maquinaria->valorHora}}</td>    
                </tr>
             
                <tr>
                    <th scope="row">Total a Pagar</th>
                    <td>{{$maquinaria->totalPagar}}</td>    
                </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
        

@section('js')

<script>
    
    if (document.getElementById('cantidadHorasAlquiladas') == ""){
        document.getElementById("cha").innerHTML = " ";
    }
    if (document.getElementById('valorHora') == ""){
        document.getElementById("vph").innerHTML = " ";
    }
    //if (document.getElementById('cantidadAlquilada') == ""){
    //    document.getElementById("cma").innerHTML = " ";
    //}
    if (document.getElementById('totalPagar') == ""){
        document.getElementById("tap").innerHTML = " ";
    }
        
</script>

@endsection


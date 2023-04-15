@can('Admin.maquinaria.show')
@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1>Detalles de la maquinaria</h1>
    <hr>
@stop

@section('content')
<style>
    strong {
   font-weight: bold;
 }
 
 
 table {
   background: #f5f5f5;
   border-collapse: separate;
   box-shadow: inset 0 1px 0 #fff;
   font-size: 15px;
   line-height: 24px;
   margin: 30px auto;
   text-align: left;
   width: 8000px;
 }
 
 th {
   background:
     linear-gradient(#1f1414, #5de0bd);
   border-left: 1px solid #555;
   border-right: 1px solid #777;
   border-top: 1px solid #555;
   border-bottom: 1px solid #333;
   box-shadow: inset 0 1px 0 #999;
   color: #fff;
   font-weight: bold;
   padding: 10px 15px;
   position: relative;
   text-shadow: 0 1px 0 #000;
 }
 
 th:after {
   background: linear-gradient(
     rgba(255, 255, 255, 0),
     rgba(255, 255, 255, 0.08)
   );
   content: "";
   display: block;
   height: 25%;
   left: 0;
   margin: 1px 0 0 0;
   position: absolute;
   top: 25%;
   width: 100%;
 }
 
 th:first-child {
   border-left: 1px solid #777;
   box-shadow: inset 1px 1px 0 #999;
 }
 
 th:last-child {
   box-shadow: inset -1px 1px 0 #999;
 }
 
 td {
   border-right: 1px solid #fff;
   border-left: 1px solid #e8e8e8;
   border-top: 1px solid #fff;
   border-bottom: 1px solid #e8e8e8;
   padding: 10px 15px;
   position: relative;
   transition: all 300ms;
 }
 
 td:first-child {
   box-shadow: inset 1px 0 0 #fff;
 }
 
 td:last-child {
   border-right: 1px solid #e8e8e8;
   box-shadow: inset -1px 0 0 #fff;
 }
 
 
 tr:last-of-type td {
   box-shadow: inset 0 -1px 0 #fff;
 }
 
 tr:last-of-type td:first-child {
   box-shadow: inset 1px -1px 0 #fff;
 }
 
 tr:last-of-type td:last-child {
   box-shadow: inset -1px -1px 0 #fff;
 }
 
 tbody:hover td {
   color: transparent;
   text-shadow: 0 0 3px #878686;
 }
 
 tbody:hover tr:hover td {
   color: #444;
   text-shadow: 0 1px 0 #fff;
 }
 
 
 </style>
<div class="mb-5 m-5">
    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('maquinaria.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-black">Detalle de la maquinaria {{$maquinaria->maquinaria}}</h5 > 
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
            @if($maquinaria->cantidadHoraAlquilada == null)
                <tr>
                    <td scope="row"><strong>Nombre de maquinaria</strong></td>
                    <td>{{$maquinaria->nombreMaquinaria}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Modelo</strong></td>
                    <td>{{$maquinaria->modelo}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Placa</strong></td>
                    <td>{{$maquinaria->placa}}</td>    
                </tr>
            
                <tr>
                    <td scope="row"><strong>Descripción</strong></td>
                    <td>{{$maquinaria->descripcion}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Fecha de adquisición</strong></td>
                    <td>{{$maquinaria->fechaAdquisicion}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Proveedor</strong></td>
                    <td>{{$maquinaria->proveedor->nombreProveedor}}</td>    
                </tr>
            @else
                <tr>
                    <td scope="row"><strong>Nombre de maquinaria</strong></td>
                    <td>{{$maquinaria->nombreMaquinaria}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Modelo</strong></td>
                    <td>{{$maquinaria->modelo}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Placa</strong></td>
                    <td>{{$maquinaria->placa}}</td>    
                </tr>
            
                <tr>
                    <td scope="row"><strong>Descripción</strong></td>
                    <td>{{$maquinaria->descripcion}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Fecha de adquisición</strong></td>
                    <td>{{$maquinaria->fechaAdquisicion}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Proveedor</strong></td>
                    <td>{{$maquinaria->proveedor->nombreProveedor}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Cantidad de hora Alquilada</strong></td>
                    <td>{{$maquinaria->cantidadHoraAlquilada}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Valor por hora</strong></td>
                    <td>{{$maquinaria->valorHora}}</td>    
                </tr>
                
                <tr>
                    <td scope="row"><strong>Total a Pagar</strong></td>
                    <td>{{$maquinaria->totalPagar}}</td>    
                </tr>
            @endif
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

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
@stop
@endcan
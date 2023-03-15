@extends('layout.plantillaH')

@section('titulo', 'Planillas')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
        Listado de planillas
        </h3>
        <hr>
    </div>

  

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn glow-on-hover-main text-BLACK" style="color: black" href="{{route('planilla.create')}}">Registrar planilla <i class="bi bi-file-plus"></i></a>
          </div>

        

        {{-- encabezado --}}
            <div class = " card shadow ab-4 btaura" >
                <div class = " card-header py-3 " >
                  <a href="{{route('planilla.index')}}" id="sinLinea">
                    <h5 class = "n-font-weight-bold text-white" title="Volver a todos los registros">Listado de planillas</h5 ></a> 
                </div >
        
        <div class="vh-50 row m-0 text-left align-items-center justify-content-center">
            <div class="col-60 bg-light p-5">
    
    <br>
    <table class="table border border-2 contorno-azul">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Fecha:</th>
                <th scope="col">Número de empleados:</th>
                <th scope="col">Total de la planilla:</th>
                {{-- <th scope="col">Detalles de la planilla:</th> --}}

            </tr>
        </thead>

        <tbody>
          @foreach($tablaplanillas as $tablaplanilla)
                <tr>
                    <td>{{$tablaplanilla->fechap}}</td>
                    <td>{{$tablaplanilla->canEmpleados}}</td>
                    <td>{{number_format($tablaplanilla->totalp, 2)}}</td>
                    {{-- <td><a class="btn btn-outline-warning" 
                        href="{{route('tablaplanilla.show', ['id' => $tablaplanilla->id])}}">
                        <i class="bi bi-eye"></i></a></td> --}}
                </tr>
                @endforeach    
        </tbody>
    </table>
    </div>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
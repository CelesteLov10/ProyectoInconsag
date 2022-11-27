@extends('layout.plantillaH')

@section('titulo', 'Detalle de empleado')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div class="mb-5 m-5">
    <h3 class=" text-center">
      Detalles del empleado
    </h3>
    <hr>
  </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('empleado.indexEmp')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalles del empleado {{$empleado->nombres}} {{$empleado->apellidos}} </h5 > 
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
            <tr>
                <th scope="row">Identidad</th>
                <td>{{$empleado->identidad}}</td>    
            </tr>
            <tr>
                <th scope="row">Nombres</th>
                <td>{{$empleado->nombres}}</td>    
            </tr>
            <tr>
                <th scope="row">Apellidos</th>
                <td>{{$empleado->apellidos}}</td>    
            </tr>
            <tr>
                <th scope="row">Teléfono</th>
                <td>{{$empleado->telefono}}</td>    
            </tr>
            <tr>
                <th scope="row">Estado</th>
                <td>{{$empleado->estado}}</td>    
            </tr>
            <tr>
                <th scope="row">Correo</th>
                <td>{{$empleado->correo}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha de nacimiento</th>
                <td>{{$empleado->fechaNacimiento}}</td>    
            </tr>
            <tr>
                <th scope="row">Dirección</th>
                <td>{{$empleado->direccion}}</td>    
            </tr>
            <tr>
                <th scope="row">Fecha de ingreso</th>
                <td>{{$empleado->fechaIngreso}}</td>    
            </tr>
            
            <tr>
                <th scope="row">Puesto</th>
                <td>{{$empleado->puesto->nombreCargo}}</td>
                
            </tr>
            <tr>
                <th scope="row">Sueldo</th>
                <td>{{$empleado->puesto->sueldo}}</td>
                
            </tr>
            <tr>
                <th scope="row">Descripción</th>
                <td>{{$empleado->puesto->descripcion}}</td>
            </tr> 
            <tr>
                <th scope="row">Oficina a la que pertenece</th>
                <td>{{$empleado->oficina->nombreOficina}}</td>
            </tr>
            <tr>
                <th scope="row">Municipio</th>
                <td>{{$empleado->oficina->municipio}}</td>
            </tr>
            <tr>
                <th scope="row">Dirección</th>
                <td>{{$empleado->oficina->direccion}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
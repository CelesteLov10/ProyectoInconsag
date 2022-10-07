@extends('layout.plantillaH')

@section('titulo', 'Detalle de Empleado')

@section('css')
  <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 


<div class="mb-5">
    <h4 class=" text-center">
      <strong>Detalle de Empleado</strong> 
    </h4>   
</div>
  
<div class="container ">
    <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('empleado.indexEmp')}}">Atrás</a>
    </div>
      {{-- encabezado --}}
      <div class = " card shadow ab-4 " >
        <div class = " card-header py-3 " >
            <h6 class = "n-font-weight-bold text-primary"> Detalle de Empleado </h6 > 
        </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
            <h1>Detalles de {{$empleado->nombres}} {{$empleado->apellidos}}</h1>
<br>
<table class="table">
    <thead class="table-light">
     <tr>
         <th scope="col">Campo</th>
         <th scope="col">Valor</th>
     </tr>
    </thead>
    <tbody>
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
            <th scope="row">Fecha de Ingreso</th>
            <td>{{$empleado->fechaIngreso}}</td>    
        </tr>
        
        <tr>
            <th scope="row">Puesto</th>
            <td>{{$empleado->puesto_id}}{{$empleado->nombreCargo}}</td>
            
        </tr>
        <tr>
            <th scope="row">Sueldo</th>
            <td>{{$empleado->sueldo}}</td>
            
        </tr>
        <tr>
            <th scope="row">Descripción</th>
            <td>{{$empleado->descripcion}}</td>
        </tr>
      
      
    </tbody>
  </table>
  
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>


@endsection
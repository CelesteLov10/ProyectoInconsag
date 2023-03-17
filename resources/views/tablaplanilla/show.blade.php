@extends('layout.plantillaH')

@section('titulo', 'Detalles de planilla')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
        Detalles de la planilla
        </h3>
        <hr>
    </div>

    <div class="container ">
      <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('planilla.index')}}">
            <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
       </div>
              <div class=" card shadow ab-4 btaura">
                <div class=" card-header py-3 ">
                        <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros" style="text-align: left"> 
                          Detalles de la planilla
                            </h5>
                        <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros" style="text-align: left"> 
                          Fecha: {{$tablaplanillas->fechap}}
                        </h5>
                </div>
                      <div class="col-60 bg-light p-5">
                          <table class="table border border-2 contorno-azul" id="tabla" style="text-align: left">
                              <thead class="thead-dark">
                                  <tr>
                                      <th scope="col">Identidad del empleado</th>
                                      <th scope="col">Nombre del empleado</th>
                                      <th scope="col">Puesto laboral</th>
                                      <th scope="col">Sueldo</th>
                                      <th scope="col">Dias que trabajo</th>
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

                                      @endif
                                      @endforeach

                              <tr>
                                <th scope="col">Total planilla:</th>
                                <td>L. {{number_format($tablaplanillas->totalp, 2)}}</td>
                              </tr>
                              <tr>
                                <th scope="col">Total empleados:</th>
                                <td>{{$tablaplanillas->canEmpleados}}</td>
                              </tr>
                              </tbody>
                          </table> 
                        <br>            
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
        
@section('js')
{{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
@endsection
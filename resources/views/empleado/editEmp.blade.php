@extends('layout.plantillaH')

@section('titulo', 'Actualizar empleado')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('contenido') 

    <h4 class=" text-center">
      <strong>Actualización de un empleado</strong>  
    </h4>
</div>

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('empleado.indexEmp')}}">Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
        <h6 class = "n-font-weight-bold text-primary">Actualización de Empleado</h6 > 
      </div >
    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
      <div class="col-60 bg-light p-5">   
    <form action="{{route('empleado.update', $empleado)}}" id="formu" class="empleado-actualizar" method="POST">
        <!-- metodo put para que guarde los cambios en la base de datos-->
        @method('put')
        @csrf {{-- TOKEN INPUT OCULTO --}}

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Identidad:</label>
        <div class="col-sm-5">
          <input type="text" autofocus class="form-control rounded-pill" 
          placeholder="Ingrese la identidad del empleado" name="identidad"
          value="{{old('identidad', $empleado->identidad)}}">
            @error('identidad')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombres:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese los nombres" name="nombres"
          value="{{old('nombres', $empleado->nombres)}}">
          @error('nombres')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>

      </div>
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Apellidos:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese los apellidos" 
          name="apellidos" value="{{old('apellidos', $empleado->apellidos)}}">
        @error('apellidos')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese el teléfono" name="telefono"
          value="{{old('telefono', $empleado->telefono)}}">
          @error('telefono')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Estado:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese activo o inactivo" name="estado"
          value="{{old('estado', $empleado->estado)}}">
          @error('estado')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Correo:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese el correo electrónico" 
          name="correo" value="{{old('correo', $empleado->correo)}}">
        @error('correo')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Fecha de nacimiento:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill" placeholder="Seleccione la fecha de nacimiento"
            name="fechaNacimiento" id="datepicker" autocomplete="off" value="{{old('fechaNacimiento', $empleado->fechaNacimiento)}}">
          @error('fechaNacimiento')
            <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese la dirección" name="direccion"
          value="">{{old('direccion', $empleado->direccion)}}</textarea>
          @error('direccion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Fecha de ingreso:</label>
        <div class="col-sm-5">
          <input type="text" id="datepicker2" autocomplete="off" class="form-control rounded-pill" 
          placeholder="Seleccione la fecha de ingreso"
          name="fechaIngreso" value="{{old('fechaIngreso', $empleado->fechaIngreso)}}">
        @error('fechaIngreso')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>
          
   
  

{{-- esta si creo --}}
<div class="mb-3 row">
  <label class="col-sm-3 col-form-label">Nombre del cargo</label>
  <div class="col-sm-5">
  <select name="puesto_id" id="" class="form-select rounded-pill">
            {{-- se muestra el registro guardado --}}
      <option value="{{$empleado->puesto_id}}" 
        {{old('puesto_id' , $empleado->puesto->nombreCargo)==$empleado->puesto->id ? 'selected' : ''}}>{{$empleado->puesto->nombreCargo}}</option>
            {{-- para que enliste los nombres del cargo --}}
        @foreach ($puesto as $puestos)
          <option value="{{old('nombreCargo', $puestos->id)}}"
            {{old('puesto_id' , $puestos->nombreCargo)==$puestos->id ? 'selected' : ''}}>{{$puestos->nombreCargo}}</option>
        @endforeach
  </select> 
  @error('puesto_id')
    <small class="text-danger"><strong>*</strong>{{$message}}</small>
  @enderror
  </div>
      </div>


      <br>
      <br>

      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button type="submit" class="btn btn-outline-info" >Actualizar </button> 
      {{-- onclick="actualizar()"  --}}
          {{-- Boton para restablecer los valores de los campos --}}
          <button type="reset" form="formu" class="btn btn-outline-danger">Restablecer</button> 
        </div>
      </div>   
    </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
{{-- plugins para el calendario fechas jquery ui --}}
  <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
    {{-- formulario para edicion --}}
   
@endsection 
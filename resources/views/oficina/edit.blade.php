@extends('layout.plantillaH')

@section('titulo', 'Actualizar oficina')
    
@section('contenido') 

<div class="mb-5">
      <h4 class=" text-center">
        <strong>Actualización de una oficina</strong> 
      </h4>
</div>

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('oficina.index')}}">Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary" >Actualización oficina </h6 > 
      </div >
    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
      <div class="col-60 bg-light p-5">   
    <form action="{{route('oficina.update', $oficina)}}" id="form1" class="oficina-actualizar" method="POST">
        <!-- metodo put para que guarde los cambios en la base de datos-->
        @method('put')

        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre de la oficina:</label>
        <div class="col-sm-5">
          <input type="text" autofocus class="form-control rounded-pill" 
          placeholder="Ingrese una oficina" name="nombreOficina"
          value="{{old('nombreOficina', $oficina->nombreOficina)}}">
            @error('nombreOficina')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Municipio:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" 
          placeholder="Ingrese un municipio" name="municipio"
          value="{{old('municipio', $oficina->municipio)}}">
          @error('municipio')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" class="form-control rounded-pill" 
          placeholder="Ingrese una dirección" 
          name="direccion">{{old('direccion', $oficina->direccion)}}</textarea>
        @error('direccion')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del gerente:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el gerente de la oficina" 
          name="nombreGerente" value="{{old('nombreGerente', $oficina->nombreGerente)}}">
          @error('nombreGerente')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill" placeholder="Ingrese el teléfono del gerente" 
          name="telefono" value="{{old('telefono', $oficina->telefono)}}">
          @error('telefono')
          <small class="text-danger"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button class="btn btn-outline-info" onclick="actualizar()">
            Actualizar
          </button> 
      {{-- onclick="actualizar()"  --}}
    
          {{-- Boton para restablecer los valores de los campos --}}
          <button type="reset" form="form1" class="btn btn-outline-danger">
            Restablecer
          </button> 
          
        </div>
      </div>   
    </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
@endsection
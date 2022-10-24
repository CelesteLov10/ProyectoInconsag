@extends('layout.plantillaH')

@section('titulo', 'Nueva Oficina')
    
@section('contenido') 

<div class="mb-5">
    <h4 class=" text-center">
      <strong>Registro de una nueva oficina</strong> 
    </h4>
</div>
<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary"  href="{{route('oficina.index')}}">
      <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
      <div class = " card-header py-3 " >
          <h6 class = "n-font-weight-bold text-primary" >Creación nueva oficina </h6 > 
      </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('oficina.store')}}" class="puesto-guardar" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre de la oficina:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('nombreOficina') is-invalid @enderror" 
            placeholder="Ingrese el nombre que tendrá la oficina" 
            name="nombreOficina" value="{{old('nombreOficina')}}" maxlength="50">
            @error('nombreOficina')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Municipio:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('municipio') is-invalid @enderror" 
          placeholder="Ingrese el municipio que pertenece la oficina" 
          name="municipio" value="{{old('municipio')}}" maxlength="40">
          @error('municipio')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" maxlength="100" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
          placeholder="Ingrese la dirección de la oficina " 
          name="direccion">{{old('direccion')}}</textarea>
        @error('direccion')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del gerente:</label>
        <div class="col-sm-5">
          <input type="text" maxlength="50" class="form-control rounded-pill @error('nombreGerente') is-invalid @enderror" 
          placeholder="Ingrese el gerente de la oficina" 
          name="nombreGerente" value="{{old('nombreGerente')}}">
          @error('nombreGerente')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" maxlength="8" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
          placeholder="Ingrese el teléfono del gerente" 
          name="telefono" value="{{old('telefono')}}">
          @error('telefono')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
          <button type="submit" class="btn btn-outline-info">Guardar</button> 
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
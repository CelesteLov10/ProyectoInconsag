@extends('layout.plantillaH')

@section('titulo', 'Nueva Oficina')

@section('css')
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection


@section('contenido') 
@inject('departamentos', 'App\Services\Departamentos')
<div>
<div class="mb-5 m-5">
    <h2 class=" text-center">
      <strong>Registro de una nueva oficina</strong> 
    </h2>
</div>
<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary"  href="{{route('oficina.index')}}">
      <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 bg-success bg-gradient" >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white" >Creación nueva oficina </h5 > 
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
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" maxlength="150" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
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
        <label for="departamento" class="col-sm-3 col-form-label">Departamento:</label>
        <div class="col-sm-6">
        <select id="departamento" name="departamento_id"  class="form-select rounded-pill{{ $errors->has('departamento_id') ? ' is-invalid' : '' }}" required>
            @foreach ($departamentos->get() as $index => $departamento)
            <option value="{{$index}}" 
              {{old('departamento_id') == $index ? 'selected' : '' }}>  {{ $departamento}}
            </option>
            @endforeach
        </select> 
        @error('departamento_id')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>
    
      <div class="mb-3 row">
        <label for="municipio" class="col-sm-3 col-form-label">Municipio:</label>
      
        <div class="col-sm-6">
            <select id="municipio" data-old="{{ old('municipio_id') }}" name="municipio_id"  class="form-select rounded-pill{{ $errors->has('municipio_id') ? ' is-invalid' : '' }}"
              required>
            </select>
      
            @error('municipio_id')
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
</div>
@endsection

@section('js')

        <script>
          $(document).ready(function(){
            $('#departamento').on('change', function(){
              var departamento_id = $(this).val();
              if($.trim(departamento_id) != '') {
                      //mandamos a llamra a la ruta "municipios"
                      $.get('municipios', {departamento_id: departamento_id}, function (municipios) {
                
                        $('#municipio').empty();//para borar lo que tenia
                        $('#municipio').append("<option value=''> selecione un carre</option>");                       // $("#state\\\").append("<option value='"+response[i].id+"'> "+response[i].name+"</option>");
                        $.each(municipios, function (index, value) {
                    $('#municipio').append("<option value='" + index +"'>" + value +"</option>");
                      })
                    });
                  }
                });
            });      
        </script>

@endsection
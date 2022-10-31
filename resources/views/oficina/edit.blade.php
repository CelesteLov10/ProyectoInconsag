@extends('layout.plantillaH')

@section('titulo', 'Actualizar oficina')
    
@section('contenido') 
<div>
<div class="mb-5 m-5">
      <h2 class=" text-center">
        <strong id="titulo">Actualización de una oficina</strong> 
      </h2>
</div>

<div class="container ">
  <div class="mb-3 text-end">
    <a class="btn btn-outline-primary" href="{{route('oficina.index')}}">
      <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 bg-success bg-gradient" >
      <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white" >Actualización de la oficina </h5 > 
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
          <input type="text" autofocus class="form-control rounded-pill @error('nombreOficina') is-invalid @enderror" 
          placeholder="Ingrese una oficina" name="nombreOficina"
          value="{{old('nombreOficina', $oficina->nombreOficina)}}" maxlength="50">
            @error('nombreOficina')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
        </div>
      </div>


      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Dirección:</label>
        <div class="col-sm-5">
          <textarea type="text" maxlength="150" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
          placeholder="Ingrese una dirección" 
          name="direccion">{{old('direccion', $oficina->direccion)}}</textarea>
        @error('direccion')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del gerente:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('nombreGerente') is-invalid @enderror" 
          placeholder="Ingrese el gerente de la oficina" 
          name="nombreGerente" value="{{old('nombreGerente', $oficina->nombreGerente)}}" maxlength="50">
          @error('nombreGerente')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Teléfono:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
          placeholder="Ingrese el teléfono del gerente" 
          name="telefono" value="{{old('telefono', $oficina->telefono)}}" maxlength="8">
          @error('telefono')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

 
 
      <div class="mb-3 row">
        <label for="departamento" class="col-sm-3 col-form-label">Departamento:</label>
        <div class="col-sm-5">
        <select id="departamento" name="departamento_id" class="form-select rounded-pill @error('departamento_id') is-invalid @enderror"
          onchange="cambiomunicipio(this.value)">
           {{-- se muestra el registro guardado --}}
            <option value="{{$oficina->departamento_id}}" 
              {{old('departamento_id' , $oficina->departamento->nombreD)==$oficina->departamento->id ? 'selected' : ''}}>{{$oficina->departamento->nombreD}}</option>
                {{-- para que enliste los nombres del cargo --}}
                @foreach ($departamentos as $index => $departamento)
                <option value="{{old('nombreD', $departamento->id)}}"
                {{old('departamento_id' , $departamento->nombreD)==$departamento->id ? 'selected' : ''}}>{{$departamento->nombreD}}</option>
                @endforeach
        </select> 
        @error('departamento_id')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
      </div>

    <input type="hidden" value="{{ old('municipio_id') }}" id="prueba">
      <div class="mb-3 row">
        <label for="municipio" class="col-sm-3 col-form-label">Municipio:</label>
        <div class="col-sm-5">
          <select id="municipio" name="municipio_id"  class="form-select rounded-pill @error('municipio_id') is-invalid @enderror">
           {{-- se muestra el registro guardado --}}
           <option value="{{$oficina->municipio_id}}" 
            {{old('municipio_id' , $oficina->municipio->nombreM)==$oficina->municipio->id ? 'selected' : ''}}>{{$oficina->municipio->nombreM}}</option>
           
            </select>
            @error('municipio_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>
    
      <div class="mb-3 row">
        <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-outline-warning">Actualizar</button> 
            <button type="reset" form="formu" class="btn btn-outline-danger">
                Restablecer</button> 
        </div>
    </div> 
          
        </div>
      </div>   
    </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>   

    <script>
      /*Peticion segun la ruta*/
function peticion(id){
let _token= "{{ csrf_token() }}";
$.ajax({
type: "POST",
url: "/getMunicipios/"+id,
data: {
  _token: _token},
  success: function(municipio) {
        if ((municipio.errors)) {
            alert('')
        } else {
            agregarSelect(municipio);            
        }
    },
});
}

function cargarselectmunicipio(iddpto, idmuni){
  if (idmuni===null) {
    
  } else {
let _token= "{{ csrf_token() }}";
$.ajax({
type: "POST",
url: "/getMunicipios/"+iddpto,
data: {
  _token: _token},
  success: function(municipio) {
        if ((municipio.errors)) {
            alert('')
        } else {
            agregarSelect(municipio); 
            $('#municipio').val(idmuni);           
        }
    },
});
  }
}
/* Metodo para mandar a llamar los municipios*/
function cambiomunicipio(id_departamento){
        peticion(id_departamento);
        }
function agregarSelect(municipio){
  $('#municipio').empty();
  $('#municipio').append("<option selected disabled value=''>{{$oficina->municipio->nombreM}}</option>"); 
  for (let i = 0; i < municipio.length; i++) {
    $('#municipio').append("<option value='"+ municipio[i].id+"'>"+municipio[i].nombreM+"</option>"); 
    
  }
}

      $(document).ready(function(){
        cargarselectmunicipio($('#departamento').val(),$('#prueba').val())
        });      
    </script>
@endsection
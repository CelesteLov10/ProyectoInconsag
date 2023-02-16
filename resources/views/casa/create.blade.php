@extends('layout.plantillaH')

@section('titulo', 'Nueva Casa modelo')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
@endsection
    
@section('contenido') 

  <div class="mb-5 m-5">
    <h3 class=" text-center">
      Registro de nueva casa modelo
    </h3>
    <hr>
  </div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('constructora.index')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
  </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white">Creación de una casa modelo</h5 > 
        </div >

        <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('casa.store')}}" id="d" class="casa-guardar" method="POST" autocomplete="off">
          @csrf {{-- TOKEN INPUT OCULTO --}}
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Clase de casa:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('claseCasa') is-invalid @enderror" 
            placeholder="Ingrese el nombre de la clase de casa. Ejem. 'A'" 
            name="claseCasa" value="{{old('claseCasa')}}" maxlength="50">
            @error('claseCasa')
            <small class="text-danger"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Valor de la casa:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('valorCasa') is-invalid @enderror" 
            placeholder="Ingrese el valor de la casa modelo."
            name="valorCasa" value="{{old('valorCasa')}}" maxlength="8">
          @error('valorCasa')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Cantidad de habitaciones:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill  @error('cantHabitacion') is-invalid @enderror" 
            placeholder="Ingrese la cantidad de habitaciones. "
            name="cantHabitacion" value="{{old('cantHabitacion')}}" maxlength="2">
          @error('cantHabitacion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Descripción:</label>
          <div class="col-sm-5">
            <textarea type="text" class="form-control rounded-pill  @error('descripcion') is-invalid @enderror" 
            maxlength="150" placeholder="Ingrese la descripción de la casa"
            name="descripcion" value="">{{old('descripcion')}}</textarea>
          @error('descripcion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre de la constructora:</label>
            <div class="col-sm-5">
            <select name="constructora_id" id="" class="form-select rounded-pill @error('constructora_id') is-invalid @enderror">
              <option value="" disabled selected>-- Seleccione una constructora --</option>
                @foreach ($constructora as $constructoras)
                <option value="{{$constructoras->id}}" 
                  {{old('constructora_id' , $constructoras->nombreConstructora)==$constructoras->id ? 'selected' : ''}}>{{$constructoras->nombreConstructora}}</option>
                @endforeach
            </select> 
            @error('constructora_id')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Subir foto de casa modelo:</label>
            <div class="col-sm-5">
                <input accept="image/*" type="file" id="subirCasa" class="form-control rounded-pill  @error('subirCasa') is-invalid @enderror" 
                    name="subirCasa" value="{{old('subirCasa')}}" >
                    @error('subirCasa')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    <div ><small class="text-danger" id="myElement" ></small></div>
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
    {{-- plugins para el calendario fechas jquery ui --}}
    <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

@endsection


@extends('layout.plantillaH')

@section('titulo', 'Actualizar Casas Modelos')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
@endsection

@section('contenido') 
<div>
  <div class="mb-5 m-5">
    <h3 class=" text-center">
      Actualización de casas modelos
    </h3>
    <hr>
</div>

  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('casa.index')}}">
        <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>

      {{-- encabezado  /images/{{$img->image}}--}}
      <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
          <h5 class = "n-font-weight-bold text-white">Actualización de la casa modelo</h5 > 
        </div>
      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">   
      <form action="{{route('casa.update', $casa)}}" id="formu" class="casa-actualizar" method="POST" autocomplete="off" enctype="multipart/form-data">
          <!-- metodo put para que guarde los cambios en la base de datos-->
          @method('put')
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Clase de Casa:</label>
          <div class="col-sm-5">
            <input type="text" autofocus class="form-control rounded-pill @error('claseCasa') is-invalid @enderror" 
            placeholder="Ingrese el tipo de la clase de casa" name="claseCasa"
            value="{{old('claseCasa', $casa->claseCasa)}}"  maxlength="50">
              @error('claseCasa')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Valor de casa modelo:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('valorCasa') is-invalid @enderror" 
            maxlength="8" placeholder="Ingrese el valor de la casa" name="valorCasa"
            value="{{old('valorCasa', $casa->valorCasa)}}" >
            @error('valorCasa')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Cantidad de Habitaciones:</label>
          <div class="col-sm-5">
            <input type="text" class="form-control rounded-pill @error('cantHabitacion') is-invalid @enderror" 
            placeholder="Ingrese la cantidad de habitaciones" name="cantHabitacion"
            value="{{old('cantHabitacion', $casa->cantHabitacion)}}" maxlength="2">
            @error('cantHabitacion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Descripción:</label>
          <div class="col-sm-5">
            <textarea type="text" class="form-control rounded-pill @error('descripcion') is-invalid @enderror" 
            maxlength="150" placeholder="Ingrese la descripción" name="descripcion"
            value="">{{old('descripcion', $casa->descripcion)}}</textarea>
            @error('descripcion')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre de la constructora:</label>
            <div class="col-sm-5">
            <select name="constructora_id" id="" class="form-select rounded-pill @error('constructora_id') is-invalid @enderror">
              <option value="{{$casa->constructora_id}}" 
                {{old('constructora_id' , $casa->constructora->nombres)==$casa->constructora->id ? 'selected' : ''}}>{{$casa->constructora->nombreConstructora}}</option>
                {{-- para que enliste los nombres del cargo --}}
                @foreach ($constructora as $constructoras)
                <option value="{{old('constructora_id', $constructoras->id)}}"
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
                <input accept="image/*" type="file" id="image" class="form-control rounded-pill  @error('image') is-invalid @enderror" 
                    name="images[]" multiple>
                    @error('image')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    <div ><small class="text-danger" id="myElement" ></small></div>
            </div>
        </div>

        <div class="mb-3 row">
          <div class="offset-sm-3 col-sm-9">
            <button type="submit" class="btn btn-outline-warning" >Actualizar</button> 
        {{-- onclick="actualizar()"  --}}
            {{-- Boton para restablecer los valores de los campos --}}
            <button type="reset" form="formu" class="btn btn-outline-danger">Restablecer</button> 
          </div>
        </div>   
      </form>
      
        <div class=" float-right">
            <div class="float-right ms-auto mb-2 mb-lg-0">
                @if (count($casa->images)>0)
                <h2>Imágenes</h2>
                @foreach ($casa->images as $img)
                <form action="/deleteimage/{{$img->id}}" method="post">
                  <button class="btn text-danger">X</button>
                    @csrf
                    @method('delete')
                </form>
                <img src="/images/{{$img->image}}" class="img-responsive" style="max-height: 100px; max-width:100px" alt="" srcset="">
                @endforeach
                @endif
            </div>
        </div>

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
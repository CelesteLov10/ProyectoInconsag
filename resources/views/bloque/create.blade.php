@extends('layout.plantillaH')

@section('titulo', 'Nuevo Bloque')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection

@section('contenido') 
<div>
    <div class="mb-5 m-5">
        <h2 class=" text-center">
        <strong id="titulo">Registro de nuevo bloque</strong> 
        </h2>
    </div>
    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('bloque.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>

        {{-- encabezado  --}}
        <div class = " card shadow ab-4 bg-success bg-gradient" >
            <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Creación nuevo bloque</h5 > 
        </div >
        <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('bloque.store')}}" class="bloque-guardar" method="POST">
          @csrf {{-- TOKEN INPUT OCULTO --}}

            <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">Nombre del bloque:</label>
              <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('nombreBloque') is-invalid @enderror" 
                placeholder="Ingrese el nombre del bloque. (ejem. bloque1)" 
                name="nombreBloque" value="{{old('nombreBloque')}}" maxlength="50">
                @error('nombreBloque')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
              </div>
            </div>
    
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Cantidad de Lotes:</label>
                <div class="col-sm-5">
                    <input type="number" id="cantidadLotes" class="form-control rounded-pill  @error('cantidadLotes') is-invalid @enderror" 
                    placeholder="Ingrese la cantidad de Lotes. Ejem. 1" 
                        name="cantidadLotes" value="{{old('cantidadLotes')}}" maxlength="4">
                        @error('cantidadLotes')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                        <div ><small class="text-danger" id="myElement" ></small></div>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Colindancia Norte:</label>
                <div class="col-sm-5">
                    <textarea type="text" id="colindanciaN" class="form-control rounded-pill  @error('colindanciaN') is-invalid @enderror" 
                    placeholder="Ingrese la colindancia norte del bloque." 
                        name="colindanciaN" value="{{old('colindanciaN')}}" maxlength="150"></textarea>
                        @error('colindanciaN')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                        <div ><small class="text-danger" id="myElement" ></small></div>
                        <br>
                    </div>
                    <div class="mb-3 row">
                      <label class="col-sm-3 col-form-label">Colindancia Sur:</label>
                     <div class="col-sm-5">
                       <textarea type="text" id="colindanciaS" class="form-control rounded-pill  @error('colindanciaS') is-invalid @enderror" 
                         placeholder="Ingrese la colindancia sur del bloque." 
                          name="colindanciaS" value="{{old('colindanciaS')}}" maxlength="150"></textarea>
                          @error('colindanciaS')
                             <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                           @enderror
                           <div ><small class="text-danger" id="myElement" ></small></div>
                    </div>
                  </div>
                <div class="mb-3 row">
               <label class="col-sm-3 col-form-label">Colindancia Este:</label>
               <div class="col-sm-5">
                <textarea type="text" id="colindanciaE" class="form-control rounded-pill  @error('colindanciaE') is-invalid @enderror" 
                placeholder="Ingrese la colindancia este del bloque. " 
                    name="colindanciaE" value="{{old('colindanciaE')}}" maxlength="150"></textarea>
                    @error('colindanciaE')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                    <div ><small class="text-danger" id="myElement" ></small></div>
             </div>
              </div>
             </div>
             <div class="mb-3 row">
              <label class="col-sm-3 col-form-label">Colindancia Oeste:</label>
             <div class="col-sm-5">
             <textarea type="text" id="colindanciaO" class="form-control rounded-pill  @error('colindanciaO') is-invalid @enderror" 
              placeholder="Ingrese la colindancia oeste del bloque" 
              name="colindanciaO" value="{{old('colindanciaO')}}" maxlength="150"></textarea>
              @error('colindanciaO')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
              <div ><small class="text-danger" id="myElement" ></small></div>
              </div>
              </div>
                 <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Subir Foto:</label>
                <div class="col-sm-5">
                    <input accept="image/*" type="file" id="subirfoto" class="form-control rounded-pill  @error('subirfoto') is-invalid @enderror" 
                        name="subirfoto" value="{{old('subirfoto')}}" >
                        @error('subirfoto')
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

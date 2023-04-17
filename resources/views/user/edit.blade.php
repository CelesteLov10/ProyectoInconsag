@can('Admin.user.edit')
@extends('adminlte::page')

@section('title', 'Actualizar')

@section('content_header')
    <h1>Asignar un rol</h1>
    <hr>
@stop

@section('content')
<div>
  
    <div class="container ">
      <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('user.index')}}">
          <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
      </div>
  
        {{-- encabezado  --}}
        <div class = " card shadow ab-4 btaura">
          <div class = " card-header py-3 " >
              <h5 class = "n-font-weight-bold text-white" >Actualización del usuario </h5 > 
          </div >
        <div class="m-0 text-center align-items-center justify-content-center">
          <div class="bg-light p-5">   
        <form action="{{route('user.update', $user)}}" id="form1" class="puesto-actualizar" method="POST" autocomplete="off">
            <!-- metodo put para que guarde los cambios en la base de datos-->
            @method('put')
  
            @csrf {{-- TOKEN INPUT OCULTO --}}
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre completo:</label>
            <div class="col-sm-5">
              <input type="text" autofocus class="form-control rounded-pill @error('name') is-invalid @enderror" 
              placeholder="Ingrese un nombre de usuario Ejem: 'Maria Lovo' " name="name" maxlength="50"
              value="{{old('name', $user->name)}}">
                @error('name')
                  <small class="text-danger"><strong>*</strong>{{$message}}</small>
                @enderror
            </div>
          </div>
  
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Correo electrónico:</label>
            <div class="col-sm-5">
              <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror" 
              placeholder="Ingrese un correo Ejem: 'Celestepc@gmail.com'" name="email"
              value="{{old('email', $user->email)}}" maxlength="50">
              @error('email')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

        <div class="mb-3 row">
          <label for="rol" class="col-sm-3 col-form-label">Rol</label>
          <div class="col-sm-5">
            <div class="form-group">
              <select class="form-control rounded-pill" id="rol" name="rol">
                  @foreach($roles as $rol)
                  <option value="{{ $rol->id }}" {{ old('rol', $user->roles()->first()->id) == $rol->id ? 'selected' : '' }}>{{ $rol->name }}</option>
                  @endforeach
              </select>
              @error('rol')
              <small class="text-danger"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
        </div>
      </div>
  
          <div class="mb-3 row">
            <div class="offset-sm-3 col-sm-9">
              <button class="btn btn-outline-info" onclick="actualizar()">
                Actualizar
              </button>         
  
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
  </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    
@stop
@endcan
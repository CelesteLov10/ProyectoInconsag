@extends('adminlte::page')

@section('title', 'Actualizar')

@section('content_header')
    <h1>Actualización del proveedor</h1>
    <hr>
@stop

@section('content')
<div>
    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('proveedor.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado  --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold">Actualización del proveedor </h5 > 
        </div >

    <div class="m-0 text-center align-items-center justify-content-center">
        <div class="bg-light p-5">
        <form action="{{route('proveedor.update', $proveedor)}}" id="formu"  method="POST" autocomplete="off">
            @method('put')
            @csrf {{-- TOKEN INPUT OCULTO --}}

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Nombre del proveedor:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('nombreProveedor') is-invalid @enderror" 
                        placeholder="Ingrese el nuevo nombre de proveedor" 
                        name="nombreProveedor" value="{{old('nombreProveedor', $proveedor->nombreProveedor)}}" maxlength="50">
                        @error('nombreProveedor')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Nombre del contacto:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('nombreContacto') is-invalid @enderror" 
                        placeholder="Ingrese el nuevo nombre de contacto" 
                        name="nombreContacto" value="{{old('nombreContacto', $proveedor->nombreContacto)}}" maxlength="50">
                        @error('nombreContacto')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Cargo del contacto:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('cargoContacto') is-invalid @enderror" 
                        placeholder="Ingrese el nuevo cargo de contacto" 
                        name="cargoContacto" value="{{old('cargoContacto', $proveedor->cargoContacto)}}" maxlength="50">
                        @error('cargoContacto')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Dirección:</label>
                <div class="col-sm-5">
                        <textarea type="text" class="form-control rounded-pill @error('direccion') is-invalid @enderror" 
                        placeholder="Ingrese una nueva descripción"
                        name="direccion" maxlength="150">{{old('direccion', $proveedor->direccion)}}</textarea>
                        @error('direccion')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Correo electrónico:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('email') is-invalid @enderror" 
                    maxlength="40" placeholder="Ingrese un nuevo correo electrónico" 
                    name="email" value="{{old('email', $proveedor->email)}}">
                @error('email')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Teléfono:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill @error('telefono') is-invalid @enderror" 
                    placeholder="Ingrese un nuevo teléfono" name="telefono"
                    value="{{old('telefono', $proveedor->telefono)}}" maxlength="8">
                    @error('telefono')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Categoría:</label>
                <div class="col-sm-5">
                <select name="categoria_id" id="" class="form-select form-control rounded-pill @error('categoria_id') is-invalid @enderror">
                    {{-- se muestra el registro guardado --}}
                    <option value="{{$proveedor->categoria_id}}" 
                    {{old('categoria_id' , $proveedor->categoria->nombreCat)==$proveedor->categoria->id ? 'selected' : ''}}>{{$proveedor->categoria->nombreCat}}</option>
                    {{-- para que enliste los nombres del cargo --}}
                    @foreach ($categoria as $categorias)
                    <option value="{{old('categoria_id', $categorias->id)}}"
                    {{old('categoria_id' , $categorias->nombreCat)==$categorias->id ? 'selected' : ''}}>{{$categorias->nombreCat}}</option>
                    @endforeach
                </select> 
                @error('categoria_id')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
                </div>
            </div>

            <div class="mb-3 row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-outline-warning">Actualizar</button> 
                <button type="reset" form="formu" class="btn btn-outline-danger">Restablecer</button> 
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
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
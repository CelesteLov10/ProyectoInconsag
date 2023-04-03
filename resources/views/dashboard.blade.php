@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Bienvenid.</p>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary text-BLACK" href="{{route('reservacion.create')}}">Nueva reservación <i class="bi bi-cart-plus text-BLACK"></i></a>
        
          </div>

        <div id="miCarrusel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./imagenes/fondo3.png" class="d-block w-100" alt="Imagen 1">
              </div>
              <div class="carousel-item">
                <img src="./imagenes/fondo3.png" class="d-block w-100" alt="Imagen 2">
              </div>
              <div class="carousel-item">
                <img src="./imagenes/fondo3.png" class="d-block w-100" alt="Imagen 3">
              </div>
            </div>
          </div>

          <a class="carousel-control-prev" href="#miCarrusel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#miCarrusel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
          </a>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

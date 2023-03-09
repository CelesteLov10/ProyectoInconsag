@extends('layout.plantillaH')

@section('titulo', 'Planillas')


@section('css')
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('contenido')

    <div>
        <header class="blog-header py-3 mt-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-14 text-center">
                    <h3 class="blog-header-logo text-dark">Planilla de pagos</h3>
                    <hr>
                </div>
            </div>
        </header>

<br>

    <div class="container">
        <div class="mb-3 text-end">
            <a class="btn glow-on-hover-main text-BLACK" href="{{route('planilla.create')}}">Registrar planilla <i class="bi bi-file-plus"></i></a>
          </div>

        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                {{ session('mensaje')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- alerta de mensaje cuando se actualice un dato correctamente --}}
        @if (session('mensajeW'))
            <div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert">
                {{ session('mensajeW')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        
@endsection
@section('js')

  {{-- Codigo para que el mensaje se cierre luego de 2 segundos pasar id al div --}}
  <script>
    $('#alert').fadeIn();     
    setTimeout(function() {
        $("#alert").fadeOut();           
    },2000);
  </script>
@endsection
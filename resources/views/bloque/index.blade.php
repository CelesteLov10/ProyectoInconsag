@extends('adminlte::page')

@section('title', 'Listado terreno')

@section('content_header')
    <h1>Listado de terrenos</h1>
    <hr>
@stop

@section('content')
<div>
    {{-- Campo de busqueda  --}}
<form method="GET" action="">
<div class="container">
    <div class="vh-50 row text-center align-items-center justify-content-center">
        <div class="col-7 p-1 contorno-azul">
            <div class="input-group">
                  <input type="text" name="search" id="search" class="form-control" autofocus
                  placeholder="Buscar por nombre del bloque" value="{{request('search')}}"/>
                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
              </div>
            </div>
        </div>
    </div>
</div>    
</form>

<br><br>
<div class="container">
    <div class="mb-3 text-end">
        {{--<a class="btn glow-on-hover-main" href="{{route('lotevendido.index2')}}">Lotes vendidos <i
            class="bi bi-pencil-square"></i></a>--}}
        <a class="btn btn-outline-primary" href="{{route('bloque.create')}}">Nuevo bloque <i
                class="bi bi-plus-square-dotted"></i></a>
        <a class="btn btn-outline-primary" href="{{route('lote.create')}}">Agregar lote <i
                class="bi bi-plus-square-dotted"></i></a>
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

    {{-- encabezado --}}
    <div class=" card shadow ab-4 btaura">
        <div class=" card-header py-3 ">
            <a href="{{route('bloque.index')}}" id="sinLinea">
                <h6 class="n-font-weight-bold " title="Volver a todos los registros"> Lista de
                    bloques</h6></a>
        </div>

        <div class="vh-50 row m-0 text-center align-items-center justify-content-center container">
            <div class="col-60 bg-light p-5">
                <table class="table border border-2 contorno-azul">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nombre del bloque</th>
                        <th scope="col">Lotes Maximos</th>
                        <th scope="col">Lotes Asignados</th>
                        <th scope="col">Detalle bloque</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($bloques as $bloque)
                        @if($bloque->cantidadLotes == $bloque->lote()->count())
                            <td>{{$bloque->id}}</td>
                            <td>{{$bloque->nombreBloque}}</td>
                            <td>{{$bloque->cantidadLotes}}</td>
                            <td>{{$bloque->lote()->count()}}</td>
                            <td>
                                <a class="btn btn-outline-warning"
                                    href="{{route('bloque.show', ['id' => $bloque->id])}}">
                                    <i class="fa fa-clipboard"></i>
                                </a>
                            </td>
                        @else
                            <tr>
                                <td>{{$bloque->nombreBloque}}</td>
                                <td>{{$bloque->cantidadLotes}}</td>
                                <td>{{$bloque->lote()->count()}}</td>
                                {{-- <td><a class="btn btn-outline-success" href="{{route('lote.create', ['id'=> $bloque->id])}}">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </a>
                                </td> --}}
                                <td>
                                    <a class="btn btn-outline-primary"
                                        href="{{route('bloque.show', ['id' => $bloque->id])}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td col-span="4">No hay registros</td>
                        </tr>
                    @endforelse

                    </tbody>
                </table>
                {{$bloques->links()}}
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
        {{-- plugins para el buscador jquery ui --}}
        <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
        <script>src = "https://code.jquery.com/jquery-3.5.1.js"</script>
        <script> src = "https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"</script>
        <script> src = "https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"</script>
    
        <script>
            //extraiga los datos de la BD
            $('#search').autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{route('bloque.search')}}",
                        dataType: 'json',
                        data: {
                            term: request.term
                        },
                        success: function (data) {
                            response(data)
                        }
                    });
                }
            });
        </script>
    
        {{-- Codigo para que el mensaje se cierre luego de 2 segundos pasar id al div --}}
        <script>
            $('#alert').fadeIn();
            setTimeout(function () {
                $("#alert").fadeOut();
            }, 2000);
        </script>
@stop
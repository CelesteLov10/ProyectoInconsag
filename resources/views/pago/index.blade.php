@extends('layout.plantillaH')

@section('titulo', 'Listado de lotes vendidos')


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
                    <h3 class="blog-header-logo text-dark">Listado de lotes vendidos</h3>
                    <hr>
                </div>
            </div>
        </header>

        {{-- Campo de busqueda  --}}
<form method="GET" action="">
    <div class="container">
        <div class="vh-50 row text-center align-items-center justify-content-center">
            <div class="col-7 p-1 contorno-azul">
                <div class="input-group">
                        <input type="text" name="search" id="search" class="form-control" autofocus
                        placeholder="Buscar por nombre del bloque, nombre del lote ó nombre del cliente"
                         value="{{request('search')}}"/>
                    <button type="submit" class="btn glow-on-hover-bus"><i class="bi bi-search"></i></button>
                </div>
                </div>
            </div>
        </div>
    </div>    
</form>

<br>

    <div class="container">
        <div class="mb-3 text-end">
            <a class="btn glow-on-hover-main text-BLACK" href="{{route('liberado.index')}}">Ver lotes liberados <i class="bi bi-check-circle"></i></a>
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
                <a href="{{route('pago.index')}}" id="sinLinea">
                    <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros"> Lotes vendidos
                        </h5></a>
            </div>

            <div class="vh-50 row m-0 text-center align-items-center justify-content-center container" >
                <div class="col-60 bg-light p-5">
                    <table class="table border border-2 contorno-azul">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre del bloque</th>
                                <th scope="col">Nombre de lote</th>
                                <th scope="col">Nombre cliente</th>
                                <th scope="col">Estado del pago</th>
                                <th scope="col">Pagos</th>
                                <th scope="col">Liberar lote</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($venta as $ventas)
                            @if ($ventas->status == 'Vendido')
                                
                                <tr>
                                    <td>{{$ventas->nombreBloque}} </td>
                                    <td>{{$ventas->nombreLote}}</td>
                                    <td>{{$ventas->nombreCompleto}}</td>


                                @if ($ventas->validacion>=3)
                                <td>
                                    <a class="btn glow-on-main text-BLACK" id="borno">
                                    <i id="noCredit" class="bi bi-battery"></i></a>
                                </td>
                                @endif

                                @if($ventas->validacion==1 || $ventas->validacion==2)
                                <td>
                                    <a class="btn glow-on-main text-BLACK" id="botonEstado1">
                                    <i id="Medio" class="bi bi-battery-half"></i></a>
                                </td>

                                @endif

                                @if($ventas->validacion==0)
                                <td>
                                    <a class="btn glow-on-main text-BLACK" id="borsi">
                                    <i id="siCredit" class="bi bi-battery-full"></i></a>
                                </td>

                                @endif

                                
                                    @if ($ventas->formaVenta == 'credito'){{-- condicion que muestra el boton de pagos solo a los lotes vendidos al credito --}}
                                    <td><a class="btn glow-on-main text-BLACK" id="borsi"
                                        href="{{route('pago.show', ['id'=>$ventas->identificador])}}">
                                        <i class="bi bi-file-earmark-zip" id="siCredit"></i></a></td>
                                        {{-- Boton para liberar lote --}}
                                        <td>
                                            <a class="btn glow-on-hover-lib text-BLACK" href="{{route('liberado.create', ['id'=>$ventas->identificador])}}">
                                            <i id="textnegro" class="bi bi-key-fill">
                                            <i id="textnegro" class="bi bi-unlock-fill"></i></i></a>
                                        </td>
                                        @else
                                        <td>
                                            <button class="btn glow-on-main text-BLACK" id="borno" disabled="true">
                                            <i class="bi bi-file-lock" id="noCredit"></i>
                                            </button>
                                            </td>
                                            {{-- Boton para liberar lote --}}
                                        <td>
                                            <button class="btn glow-on-hover-lib text-BLACK" disabled href="{{route('liberado.create', ['id'=>$ventas->identificador])}}">
                                            <i id="textnegro" class="bi bi-key-fill" disabled>
                                            <i id="textnegro" class="bi bi-unlock-fill" disabled></i></i></button>
                                        </td>
                                        @endif

                                        @csrf
                                </tr>
                                
                                @endif
                        
                        @empty
                        
                            <tr>
                                <td col-span="4">No hay registros</td> 
                            </tr>
                        
                        
                        @endforelse
                        
                        </tbody>
                    </table>
                {{--   {{$ventas->links()}}--}}
                    </div>
                </div>
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
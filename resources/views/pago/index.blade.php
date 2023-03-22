@can('Admin.pago.index')
@extends('adminlte::page')

@section('title', 'Listado')

@section('content_header')
    <h1>Listado de lotes vendidos</h1>
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
                    placeholder="Buscar por nombre del bloque, nombre del lote ó nombre del cliente"
                        value="{{request('search')}}"/>
                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-search"></i></button>
            </div>
            </div>
        </div>
    </div>
</div>    
</form>
<style>
    .fa-volume-high{
        color: rgb(42, 209, 131)
    }
    .fa-volume-off{
        color: brown
    }
    .fa-volume-low{
        color: goldenrod
    }
    .fa-file-check{
        color: antiquewhite
    }
    .fa-clipboard-check{
        color: teal
    }
    .fa-clipboard-list{
        color: indianred
    }
</style>

<br>

<div class="container">
    <div class="mb-3 text-end">
        <a class="btn btn btn-outline-primary text-BLACK" href="{{route('liberado.index')}}">Ver lotes liberados <i class="bi bi-check-circle"></i></a>
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
                <h6 class="n-font-weight-bold" title="Volver a todos los registros"> Lotes vendidos
                    </h6></a>
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
                              
                                <i class="fa-solid fa-volume-off"></i>                                                          
                            </td>
                            @endif

                            @if($ventas->validacion==1 || $ventas->validacion==2)
                            <td>
                                
                                <i class="fa-solid fa-volume-low"></i>                                
                            </td>

                            @endif

                            @if($ventas->validacion==0)
                            <td>
                                <a class="btn text-BLACK" id="borsi">
                                    <i class="fa-solid fa-volume-high"></i>                                
                                </a>
                            </td>

                            @endif

                            
                                @if ($ventas->formaVenta == 'credito'){{-- condicion que muestra el boton de pagos solo a los lotes vendidos al credito --}}
                                <td>
                                    <a class="btn text-BLACK" id="borsi"
                                     href="{{route('pago.show', ['id'=>$ventas->identificador])}}">
                                    
                                     <i class="fa-solid fa-clipboard-list"></i>                                                                          
                                    </a>
                                </td>
                                    @else
                                    <td>
                                        <a class="btn text-BLACK">
                                            <i class="fa-solid fa-clipboard-check"></i>                                        
                                        </a>
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    {{-- cdn para el css de los emojis de fontawesomw --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />@stop

@section('js')
    
    {{-- Codigo para que el mensaje se cierre luego de 2 segundos pasar id al div --}}
    <script>
        $('#alert').fadeIn();     
        setTimeout(function() {
            $("#alert").fadeOut();           
        },2000);
    </script>
    {{-- script para que funcione los emojis de fontawesome --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stop
@endcan
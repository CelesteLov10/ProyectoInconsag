@extends('layout.plantillaH')

@section('titulo', 'Listado de lotes liberados')


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
                    <h3 class="blog-header-logo text-dark">Listado de lotes liberados</h3>
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
                      placeholder="Buscar por nombre del bloque, nombre del lote ó nombre del cliente" value="{{request('search')}}"/>
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
            <a class="btn glow-on-hover-main text-BLACK" href="{{route('pago.index')}}">Volver a lotes vendidos <i class="bi bi-reply"></i></a>
          </div>

        {{-- encabezado --}}
        <div class=" card shadow ab-4 btaura">
            <div class=" card-header py-3 ">
                <a href="{{route('liberado.index')}}" id="sinLinea">
                    <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros">Lotes liberados 
                        </h5></a>
            </div>

            <div class="vh-50 row m-0 text-center align-items-center justify-content-center container">
                <div class="col-60 bg-light p-5">
                    <table class="table border border-2 contorno-azul">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Nombre del bloque</th>
                                <th scope="col">Nombre de lote</th>
                                <th scope="col">Nombre cliente</th>
                                <th scope="col">Fecha en que se libero</th>
                                <th scope="col">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($liberado as $liberados)
                             <tr>
                                 <td>{{$liberados->nomBloque}}</td>
                                 <td>{{$liberados->nomLote}}</td>
                                 <td>{{$liberados->nomCliente}}</td>
                                 <td>{{$liberados->fecha}}</td>
                                 <td>{{$liberados->descripcion}}</td>
                             </tr>
                    
                             @empty
                             <tr>
                             <td col-span="4">No hay registros</td>
                             </tr>
                         @endforelse
                        </tbody>
                    </table>
           {{--   { {$venta->links()}}--}}
                    </div>
                </div>
                @endsection
                        
                @section('js')
                {{-- plugins para el buscador jquery ui --}}
                <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
                @endsection
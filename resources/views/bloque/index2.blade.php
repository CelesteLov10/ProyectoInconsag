@extends('layout.plantillaH')

@section('titulo', 'Listado de bloques')


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
                      <input type="text" name="search" id="search" class="form-control"
                      placeholder="Buscar por nombre del bloque o nombre del lote" value="{{request('search')}}"/>
                    <button type="submit" class="btn glow-on-hover-bus"><i class="bi bi-search"></i></button>
                  </div>
                </div>
            </div>
        </div>
    </div>    
  </form>

    <div class="container">
        <br>
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
                <a href="{{route('lotevendido.index2')}}" id="sinLinea">
                    <h5 class="n-font-weight-bold text-white" title="Volver a todos los registros"> Lotes vendidos
                        </h5></a>
            </div>

            <div class="vh-50 row m-0 text-center align-items-center justify-content-center container">
                <div class="col-60 bg-light p-5">
                    <table class="table border border-2 contorno-azul">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No. de bloque</th>
                                <th scope="col">Nombre del bloque</th>
                                <th scope="col">No. de lote</th>
                                <th scope="col">Nombre de lote</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Pagos</th>
                                {{--<th scope="col">Medida lateral derecha:</th>
                                <th scope="col">Medida lateral izquierda:</th>
                                <th scope="col">Medida lateral enfrente:</th>
                                <th scope="col">Medida lateral trasera:</th>
                                <th scope="col">Valor terreno:</th>
                                <th scope="col">Colindancia Norte:</th>
                                <th scope="col">Colindancia Sur:</th>
                                <th scope="col">Colindancia Este:</th>
                                <th scope="col">Colindancia Oeste:</th>--}}
                            </tr>
                        </thead>
                
                        <tbody>
                        @forelse($lotes as $lote)
                                @if ($lote->status == 'Vendido')
                                <tr>
                                    <td>{{$lote->bloque->id}}</td>
                                    <td>{{$lote->bloque->nombreBloque}}</td>
                                    <td>{{$lote->id}}</td>
                                    <td>{{$lote->nombreLote}}</td>
                                    @if ($lote->status == 'Disponible')
                                    <td>
                                        <a class="jsgrid-button btn btn-success">
                                           Disponible<i class="bi bi-check2-square" style="display:none"></i>
                                        </a>
                                        </td>  
                                       {{-- comment  @if ($lote->status == 'Pagando')
                                        <a href="{ {route('change.status.lotes', $lote)}}" class="jsgrid-button btn btn-info">
                                            Pagando<i class="bi bi-check2-square"></i>
                                         </a>
                                         @endif--}}
                                    @else
                                    <td>
                                    <a class="jsgrid-button btn btn-danger">
                                        Vendido<i class="bi bi-check2-square" style="display:none"></i>
                                     </a>
                                    </td>
                                    <td><a class="btn glow-on-hover-main text-BLACK">
                                        <i class="bi bi-pencil-square"></i>
                                      </a>
                                      </td>
                                    @endif
                                   
                
                                    {{--<td>{{$lote->medidaLateralR}}</td>
                                    <td>{{$lote->medidaLateralL}}</td>
                                    <td>{{$lote->medidaEnfrente}}</td>
                                    <td>{{$lote->medidaAtras}}</td>
                                    <td>{{$lote->valorTerreno}}</td>
                                    <td>{{$lote->colindanciaN}}</td>
                                    <td>{{$lote->colindanciaS}}</td>
                                    <td>{{$lote->colindanciaE}}</td>
                                    <td>{{$lote->colindanciaO}}</td>--}}
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
                    </div>
                </div>
                @endsection
                        
                @section('js')
                {{-- plugins para el buscador jquery ui --}}
                <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
                @endsection
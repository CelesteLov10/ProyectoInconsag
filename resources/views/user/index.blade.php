@can('Admin.user.index')

@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Listado de usuarios</h1>
    <hr>
@stop

@section('content')

    <div>

            <div class="container ">
            {{-- <div class="mb-3 text-end">
                <a class="btn btn-outline-primary text-BLACK" href="{{route('puestoLaboral.create')}}">Nuevo puesto <i class="bi bi-plus-square-dotted"></i></a>
            </div> --}}
                {{-- alerta de mensaje cuando se guardo correctamente --}}
                @if (session('mensaje'))
                    <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
                    {{ session('mensaje')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
        
                {{-- alerta de mensaje cuando se actualice un dato correctamente --}}
                @if (session('mensajeW'))
                <div class="alert alert-warning alert-dismissible fade show" id="alert" role="alert" >
                    {{ session('mensajeW')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
        
                {{-- encabezado --}}
                <div class = " card shadow ab-4 btaura">
                    <div class = " card-header py-3 " >
                    <a href="{{route('user.index')}}" id="sinLinea">
                        <h6 class = "" title="Volver a todos los registros"> Lista de los usuarios</h6 ></a> 
                    </div >
        
                <div class="m-0 align-items-center justify-content-center ">
                    <div class=" p-5">
                        <table id="example" class="table table-striped table-bordered border-2 ">
                            <thead class="">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Correo electrónico</th>
                                <th scope="col">Asignar rol</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($user as $users)
                            <tr>
                                <td>{{$users->id}}</td>
                                <td>{{$users->name}}</td>
                                <td>{{$users->email}}</td>
                                <td><a class="btn btn-outline-warning" 
                                    href="{{route('user.edit', ['id' => $users->id])}}">
                                    <i class="fa fa-clipboard"></i></a>
                                </td>
                                    @csrf
                            @empty
                            <tr>
                                <td col-span="4">No hay registros</td>
                            </tr>
                            @endforelse
                            
                            </tbody>
                        </table>
                            {{-- {{$puestos->links()}}  --}}
                    </div>
                </div>
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
{{-- Codigo para que el mensaje se cierre luego de 2 segundos pasar id al div --}}
<script>
    $('#alert').fadeIn();     
    setTimeout(function() {
        $("#alert").fadeOut();           
    },2000);
</script>

{{-- Para que funcione la DATATABLE --}}
<script>
$(document).ready(function () {
    $('#example').DataTable();
});
</script>
@stop
@endcan
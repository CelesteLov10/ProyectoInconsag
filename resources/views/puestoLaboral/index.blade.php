@extends('layout.plantillaH')

@section('titulo', 'Nuevo Puesto')
    
@section('contenido') 


<div class="mb-5">
    <h4 class=" text-center">
      <strong>Listado de puestos laborales</strong> 
    </h4>
</div>

<div class="container ">
    <div class="mb-3 text-end">
        <a class="btn btn-outline-success text-right" href="{{route('puestoLaboral.create')}}">Nuevo</a>
    </div>
    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
            <table class="table border border-2 rounded-pill">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Nombre Cargo</th>
                    <th scope="col">Sueldo</th>
                    <th scope="col">Actualizar</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($puestos as $puesto)
                  <tr>
                    <th>{{$puesto->nombreCargo}}</th>
                    <td>{{$puesto->sueldo}}</td>
                    {{--
                      {{route('puestoLaboral.edit',['id'=>$puesto->numPuesto])}} 
                      --}}
                    <td><a class="btn btn-outline-warning" 
                      href="{{route('puestoLaboral.edit', ['id' => $puesto->id])}}">Actualizar</a></td>
                        @csrf
                  </tr>
                  @empty
                   <tr>
                     <td col-span="4">No hay registros</td>
                   </tr>
                @endforelse
                  
                </tbody>
              </table>
              {{$puestos->links()}}
        </div>
    </div>
</div>
@endsection
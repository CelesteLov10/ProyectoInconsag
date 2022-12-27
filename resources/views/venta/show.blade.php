@extends('layout.plantillaH')

@section('titulo', 'Detalle de venta')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
@endsection

@section('contenido') 

<div class="mb-5 m-5">
    <h3 class=" text-center">
        Detalles venta
    </h3>
    <hr>
  </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-warning" id="agregar" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        href="{{route('beneficiario.edit', ['id' => $venta->id])}}">Editar beneficiario
                        <i class="bi bi-pencil-square"></i></a>
            <a class="btn btn-outline-primary" href="{{route('venta.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>
        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
                <h5 class = "n-font-weight-bold text-white">Detalle de venta {{$venta->formaVenta}}</h5 > 
            </div >

        <div class="vh-50 row m-0 text-left align-items-center justify-content-center">
            <div class="col-60 bg-light p-5">
    <table class="table">
        <thead class="table-light">
            <tr>
                <th scope="col" class="col-md-4">Datos</th>
                <th scope="col">Información</th>
            </tr>
        </thead>
        <tbody>
            @if($venta->valorPrima == null)
                <tr>
                    <th scope="row">Nombre del cliente:</th>
                    <td>{{$venta->cliente->nombreCompleto}}</td>    
                </tr>
                <tr>
                    <th scope="row">Nombre del bloque:</th>
                    <td>{{$venta->bloque->nombreBloque}}</td>    
                </tr>
                <tr>
                    <th scope="row">Nombre del lote:</th>
                    <td>{{$venta->lote->nombreLote}}</td>    
                </tr>
            
                <tr>
                    <th scope="row">Valor del terreno:</th>
                    <td>{{$venta->lote->valorTerreno}}</td>    
                </tr>
                <tr>
                    <th scope="row">Fecha venta:</th>
                    <td>{{$venta->fechaVenta}}</td>    
                </tr>
                <tr>
                    <th scope="row">Identidad beneficiario:</th>
                    <td>{{$venta->beneficiario->identidadBen}}</td>    
                </tr>
                <tr>
                    <th scope="row">Nombre beneficiario:</th>
                    <td>{{$venta->beneficiario->nombreCompletoBen}}</td>    
                </tr>
                <tr>
                    <th scope="row">Teléfono beneficiario:</th>
                    <td>{{$venta->beneficiario->telefonoBen}}</td>    
                </tr>
                <tr>
                    <th scope="row">Dirección beneficiario:</th>
                    <td>{{$venta->beneficiario->direccionBen}}</td>    
                </tr>
            @else
                <tr>
                    <th scope="row">Nombre del cliente:</th>
                    <td>{{$venta->cliente->nombreCompleto}}</td>   
                </tr>
                <tr>
                    <th scope="row">Nombre del bloque:</th>
                    <td>{{$venta->bloque->nombreBloque}}</td>       
                </tr>
                <tr>
                    <th scope="row">Nombre del lote:</th>
                    <td>{{$venta->lote->nombreLote}}</td>     
                </tr>
            
                <tr>
                    <th scope="row">Valor del terreno:</th>
                    <td>{{$venta->lote->valorTerreno}}</td>    
                </tr>
                <tr>
                    <th scope="row">Fecha venta:</th>
                    <td>{{$venta->fechaVenta}}</td>    
                </tr>
                <tr>
                    <th scope="row">Valor prima:</th>
                    <td>{{$venta->valorPrima}}</td>    
                </tr>
                <tr>
                    <th scope="row">Cantidad de cuotas:</th>
                    <td>{{$venta->cantidadCuotas}}</td>    
                </tr>
                <tr>
                    <th scope="row">Valor cuota:</th>
                    <td>{{$venta->valorCuotas}}</td>    
                </tr>
                <tr>
                    <th scope="row">Valor restante a pagar:</th>
                    <td>{{$venta->valorRestantePagar}}</td>    
                </tr>
                <tr>
                    <th scope="row">Identidad beneficiario:</th>
                    <td>{{$venta->beneficiario->identidadBen}}</td>    
                </tr>
                <tr>
                    <th scope="row">Nombre beneficiario:</th>
                    <td>{{$venta->beneficiario->nombreCompletoBen}}</td>    
                </tr>
                <tr>
                    <th scope="row">Teléfono beneficiario:</th>
                    <td>{{$venta->beneficiario->telefonoBen}}</td>    
                </tr>
                <tr>
                    <th scope="row">Dirección beneficiario:</th>
                    <td>{{$venta->beneficiario->direccionBen}}</td>    
                </tr>
            @endif
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualización de beneficiario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        
            <form action="{{route('beneficiario.update', $venta->beneficiario)}}" id="formu" class="puesto-actualizar" method="POST" autocomplete="off">
                @method('put')    
                @csrf {{-- TOKEN INPUT OCULTO --}}
                
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Identidad:</label>
                <div class="col-sm-7">
                <input type="text" class="form-control rounded-pill @error('identidadBen') is-invalid @enderror" 
                    placeholder="0000000000000" 
                    name="identidadBen" value="{{old('identidadBen', $venta->beneficiario->identidadBen)}}" required='required'
                    title="Ingrese un numero de identidad válido" maxlength="13">
                    @error('identidadBen')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Nombre completo:</label>
                <div class="col-sm-7">
                <input type="text" class="form-control rounded-pill @error('nombreCompletoBen') is-invalid @enderror" 
                placeholder="Ingrese el nombre completo (ejem. Pablo Jose Ramos Mendoza)" required='required'
                name="nombreCompletoBen" value="{{old('nombreCompletoBen', $venta->beneficiario->nombreCompletoBen)}}" maxlength="80">
                @error('nombreCompletoBen')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
                </div>
            </div>

            <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Teléfono:</label>
            <div class="col-sm-7">
                <input type="text" class="form-control rounded-pill @error('telefonoBen') is-invalid @enderror" 
                placeholder="00000000" required='required'
                name="telefonoBen" value="{{old('telefonoBen', $venta->beneficiario->telefonoBen)}}" maxlength="8">
            @error('telefonoBen')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
            </div>

            <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Dirección:</label>
            <div class="col-sm-7">
                <textarea type="text" class="form-control rounded-pill @error('direccionBen') is-invalid @enderror" 
                maxlength="150" placeholder="Ingrese la dirección" required='required'
                name="direccionBen" value="">{{old('direccionBen', $venta->beneficiario->direccionBen)}}</textarea>
            @error('direccionBen')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Nombre del cliente relacionado:</label>
                <div class="col-sm-7">
                <select name="cliente_id" id="" class="form-select rounded-pill @error('cliente_id') is-invalid @enderror" >
                    {{-- se muestra el registro guardado --}}
                    <option value="{{$venta->beneficiario->cliente_id}}" 
                        {{old('cliente_id' , $venta->cliente->nombreCompleto)==$venta->cliente->id ? 'selected' : ''}}>{{$venta->cliente->nombreCompleto}}</option>
                        @foreach ($cliente as $clientes)
                    <option value="{{$clientes->id}}" 
                        {{old('cliente_id' , $clientes->nombreCompleto)==$clientes->id ? 'selected' : ''}}>{{$clientes->nombreCompleto}}</option>
                    @endforeach
                    </select>
                @error('cliente_id')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
                    </div>
                </div>
            

            </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="reset" form="formu" class="btn btn-outline-danger">Restablecer</button>
                </form>
            </div>
        </div>
        </div>
    </div> {{-- cierre modal --}}

</div>

@endsection
        

@section('js')

<script>
    
    if (document.getElementById('valorPrima') == ""){
        document.getElementById("cha").innerHTML = " ";
    }
    if (document.getElementById('cantidadCuotas') == ""){
        document.getElementById("vph").innerHTML = " ";
    }
    //if (document.getElementById('cantidadAlquilada') == ""){
    //    document.getElementById("cma").innerHTML = " ";
    //}
    if (document.getElementById('valorCuotas') == ""){
        document.getElementById("tap").innerHTML = " ";
    }
    if (document.getElementById('valorRestantePagar') == ""){
        document.getElementById("kio").innerHTML = " ";
    }
        
</script>

@endsection


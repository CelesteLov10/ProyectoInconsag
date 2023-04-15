@can('Admin.venta.show')
@extends('adminlte::page')

@section('title', 'Detalle')

@section('content_header')
    <h1>Detalles venta</h1>
    <hr>
@stop

@section('content')
<style>
    strong {
   font-weight: bold;
 }
 
 
 table {
   background: #f5f5f5;
   border-collapse: separate;
   box-shadow: inset 0 1px 0 #fff;
   font-size: 15px;
   line-height: 24px;
   margin: 30px auto;
   text-align: left;
   width: 800px;
 }
 
 th {
   background:
     linear-gradient(#1f1414, #5de0bd);
   border-left: 1px solid #555;
   border-right: 1px solid #777;
   border-top: 1px solid #555;
   border-bottom: 1px solid #333;
   box-shadow: inset 0 1px 0 #999;
   color: #fff;
   font-weight: bold;
   padding: 10px 15px;
   position: relative;
   text-shadow: 0 1px 0 #000;
 }
 
 th:after {
   background: linear-gradient(
     rgba(255, 255, 255, 0),
     rgba(255, 255, 255, 0.08)
   );
   content: "";
   display: block;
   height: 25%;
   left: 0;
   margin: 1px 0 0 0;
   position: absolute;
   top: 25%;
   width: 100%;
 }
 
 th:first-child {
   border-left: 1px solid #777;
   box-shadow: inset 1px 1px 0 #999;
 }
 
 th:last-child {
   box-shadow: inset -1px 1px 0 #999;
 }
 
 td {
   border-right: 1px solid #fff;
   border-left: 1px solid #e8e8e8;
   border-top: 1px solid #fff;
   border-bottom: 1px solid #e8e8e8;
   padding: 10px 15px;
   position: relative;
   transition: all 300ms;
 }
 
 td:first-child {
   box-shadow: inset 1px 0 0 #fff;
 }
 
 td:last-child {
   border-right: 1px solid #e8e8e8;
   box-shadow: inset -1px 0 0 #fff;
 }
 
 
 tr:last-of-type td {
   box-shadow: inset 0 -1px 0 #fff;
 }
 
 tr:last-of-type td:first-child {
   box-shadow: inset 1px -1px 0 #fff;
 }
 
 tr:last-of-type td:last-child {
   box-shadow: inset -1px -1px 0 #fff;
 }
 
 tbody:hover td {
   color: transparent;
   text-shadow: 0 0 3px #878686;
 }
 
 tbody:hover tr:hover td {
   color: #444;
   text-shadow: 0 1px 0 #fff;
 }
 
 
 </style>

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
                <h5 class = "n-font-weight-bold text-black">Detalle de venta {{$venta->formaVenta}}</h5 > 
            </div>

        <div class="m-0 text-left align-items-center justify-content-center">
            <div class="bg-light p-5">
    <table class="table">
        <thead class="table-light">
            <tr>
                <th scope="col" class="col-md-4">Datos</th>
                <th scope="col">Información</th>
            </tr>
        </thead>
        <tbody>
            
            {{-- si se vendio un lote al contado y sin casa --}}
            @if ($venta->casa_id == null)
            @if($venta->valorPrima == null)
            <tr>
                <td scope="row"><strong> Identidad del cliente:</strong></td>
                <td>{{$venta->cliente->identidadC}}</td>    
            </tr>
                <tr>
                    <td scope="row"><strong>Nombre del cliente:</strong></td>
                    <td>{{$venta->cliente->nombreCompleto}}</td>   
                </tr>
                <tr>
                    <td scope="row"><strong>Teléfono del cliente:</strong></td>
                    <td>{{$venta->cliente->telefono}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Identidad del beneficiario:</strong></td>
                    <td>{{$venta->beneficiario->identidadBen}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Nombre del beneficiario:</strong></td>
                    <td>{{$venta->beneficiario->nombreCompletoBen}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Teléfono del beneficiario:</strong></td>
                    <td>{{$venta->beneficiario->telefonoBen}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Nombre del bloque:</strong></td>
                    <td>{{$venta->bloque->nombreBloque}}</td>       
                </tr>
                <tr>
                    <td scope="row"><strong>Nombre del lote:</strong></td>
                    <td>{{$venta->lote->nombreLote}}</td>     
                </tr>
                <tr>
                    <td scope="row"><strong>Valor del terreno:</strong></td>
                    <td>{{$venta->lote->valorTerreno}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Fecha venta:</strong></td>
                    <td>{{$venta->fechaVenta}}</td>    
                </tr>
            <tr>
                <td scope="row"><strong>Total pagado:</strong></td>
                <td>{{$venta->total}}</td>    
            </tr> 
            {{-- si se vendio un lote al credito y sin casa --}}
        @else
        <tr>
            <td scope="row"><strong>Identidad del cliente:</strong></td>
            <td>{{$venta->cliente->identidadC}}</td>    
        </tr>
            <tr>
                <td scope="row"><strong>Nombre del cliente:</strong></td>
                <td>{{$venta->cliente->nombreCompleto}}</td>   
            </tr>
            <tr>
                <td scope="row"><strong>Teléfono del cliente:</strong></td>
                <td>{{$venta->cliente->telefono}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Identidad del beneficiario:</strong></td>
                <td>{{$venta->beneficiario->identidadBen}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Nombre del beneficiario:</strong></td>
                <td>{{$venta->beneficiario->nombreCompletoBen}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Teléfono del beneficiario:</strong></td>
                <td>{{$venta->beneficiario->telefonoBen}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Nombre del bloque:</strong></td>
                <td>{{$venta->bloque->nombreBloque}}</td>       
            </tr>
            <tr>
                <td scope="row"><strong>Nombre del lote:</strong></td>
                <td>{{$venta->lote->nombreLote}}</td>     
            </tr>
            <tr>
                <td scope="row"><strong>Fecha venta:</strong></td>
                <td>{{$venta->fechaVenta}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor del terreno:</strong></td>
                <td>{{$venta->lote->valorTerreno}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor prima:</strong></td>
                <td>{{$venta->valorPrima}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Cantidad de cuotas:</strong></td>
                <td>{{$venta->cantidadCuotas}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor cuota:</strong></td>
                <td>{{$venta->valorCuotas}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor restante a pagar:</strong></td>
                <td>{{$venta->valorRestantePagar}}</td>    
            </tr>

        @endif 
        {{-- si se vendio un lote al contado y con casa --}}
            @else
            @if($venta->valorPrima == null)
            <tr>
                <td scope="row"><strong>Identidad del cliente:</strong></td>
                <td>{{$venta->cliente->identidadC}}</td>    
            </tr>
                <tr>
                    <td scope="row"><strong>Nombre del cliente:</strong></td>
                    <td>{{$venta->cliente->nombreCompleto}}</td>   
                </tr>
                <tr>
                    <td scope="row"><strong>Teléfono del cliente:</strong></td>
                    <td>{{$venta->cliente->telefono}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Identidad del beneficiario:</strong></td>
                    <td>{{$venta->beneficiario->identidadBen}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Nombre del beneficiario:</strong></td>
                    <td>{{$venta->beneficiario->nombreCompletoBen}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Teléfono del beneficiario:</strong></td>
                    <td>{{$venta->beneficiario->telefonoBen}}</td>    
                </tr>
                <tr>
                    <td scope="row"><strong>Nombre del bloque:</strong></td>
                    <td>{{$venta->bloque->nombreBloque}}</td>       
                </tr>
                <tr>
                    <td scope="row"><strong>Nombre del lote:</strong></td>
                    <td>{{$venta->lote->nombreLote}}</td>     
                </tr>
                <tr>
                    <td scope="row"><strong>Valor del terreno:</strong></td>
                    <td>{{$venta->lote->valorTerreno}}</td>    
                </tr>
                <tr>
                    <td><strong>Estilo de casa:</strong></td>
                    <td>{{$venta->casa->claseCasa}}</td>
                </tr>
                <tr>
                    <td><strong>Valor de la casa:</strong></td>
                    <td>{{$venta->casa->valorCasa}}</td>
                </tr>
                <tr>
                    <td><strong>Cantidad de habitaciones:</strong></td>
                    <td>{{$venta->casa->cantHabitacion}}</td>
                </tr>
                <tr>
                    <td scope="row"><strong>Fecha venta:</strong></td>
                    <td>{{$venta->fechaVenta}}</td>    
                </tr>
            <tr>
                <td scope="row"><strong>Total a pagar:</strong></td>
                <td>{{$venta->total}}</td>    
            </tr> 

        {{-- si se vendio un lote al credito y con casa --}}
        @else
        <tr>
            <td scope="row"><strong>Identidad del cliente:</strong></td>
            <td>{{$venta->cliente->identidadC}}</td>    
        </tr>
            <tr>
                <td scope="row"><strong>Nombre del cliente:</strong></td>
                <td>{{$venta->cliente->nombreCompleto}}</td>   
            </tr>
            <tr>
                <td scope="row"><strong>Teléfono del cliente:</strong></td>
                <td>{{$venta->cliente->telefono}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Identidad del beneficiario:</strong></td>
                <td>{{$venta->beneficiario->identidadBen}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Nombre del beneficiario:</strong></td>
                <td>{{$venta->beneficiario->nombreCompletoBen}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Teléfono del beneficiario:</strong></td>
                <td>{{$venta->beneficiario->telefonoBen}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Nombre del bloque:</strong></td>
                <td>{{$venta->bloque->nombreBloque}}</td>       
            </tr>
            <tr>
                <td scope="row"><strong>Nombre del lote:</strong></td>
                <td>{{$venta->lote->nombreLote}}</td>     
            </tr>
            <tr>
                <td scope="row"><strong>Valor del terreno:</strong></td>
                <td>{{$venta->lote->valorTerreno}}</td>    
            </tr>
            <tr>
                <td><strong>Estilo de casa:</strong></td>
                <td>{{$venta->casa->claseCasa}}</td>
            </tr>
            <tr>
                <td><strong>Valor de la casa:</strong></td>
                <td>{{$venta->casa->valorCasa}}</td>
            </tr>
            <tr>
                <td><strong>Cantidad de habitaciones:</strong></td>
                <td>{{$venta->casa->cantHabitacion}}</td>
            </tr>
            <tr>
                <td scope="row"><strong>Fecha venta:</strong></td>
                <td>{{$venta->fechaVenta}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor prima:</strong></td>
                <td>{{$venta->valorPrima}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Cantidad de cuotas:</strong></td>
                <td>{{$venta->cantidadCuotas}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor cuota:</strong></td>
                <td>{{$venta->valorCuotas}}</td>    
            </tr>
            <tr>
                <td scope="row"><strong>Valor restante a pagar:</strong></td>
                <td>{{$venta->valorRestantePagar}}</td>    
            </tr>
        @endif
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
                <select name="cliente_id" id="" class="form-select form-control rounded-pill @error('cliente_id') is-invalid @enderror" >
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

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
{{-- PARA QUE FUNCINE EL MODAL --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

@stop
@endcan
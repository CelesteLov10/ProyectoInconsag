@can('Admin.liberado.create')
@extends('adminlte::page')

@section('title', 'Liberación del lote')

@section('content_header')
    <h1> Liberación del lote {{$venta->lote->nombreLote}}</h1>
    <hr>
@stop

@section('content')
<div>
  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('pago.index')}}">
        <i class="bi bi-box-arrow-in-left"></i>Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 btaura">
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-black" >Liberación del lote</h5 > 
        </div >
        
      <div class="m-0 text-center align-items-center justify-content-center">
          <div class="bg-light p-5">
      <form action="{{route('liberado.store')}}" class="liberado-guardar" method="POST" autocomplete="off">
          @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
            <label  class="col-sm-3 col-form-label" for="nomCliente">Nombre del cliente:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control  rounded-pill @error('nomCliente') is-invalid @enderror" required
                    name="nomCliente" id="nomCliente" autocomplete="nomCliente"
                value="{{$venta->cliente->nombreCompleto}}" readonly style="background-color: white">
            </div>
        </div>

        <div class="mb-3 row">
            <label  class="col-sm-3 col-form-label" for="nomBloque">Nombre del bloque:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control  rounded-pill @error('nomBloque') is-invalid @enderror" required
                    name="nomBloque" id="nomBloque" autocomplete="nomBloque"
                value="{{$venta->bloque->nombreBloque}}" readonly style="background-color: white">
            </div>
        </div>
            
        <div class="mb-3 row">
            <label  class="col-sm-3 col-form-label" for="nomLote">Nombre del lote:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control  rounded-pill @error('nomLote') is-invalid @enderror" required
                    name="nomLote" id="nomLote" autocomplete="nomLote"
                value="{{$venta->lote->nombreLote}}" readonly style="background-color: white">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fecha') is-invalid @enderror" 
                maxlength="10" placeholder="Fecha actual"
                name="fecha" autocomplete="off" value="<?php echo date("Y-m-d");?>" readonly=»readonly» style="background-color: rgba(206, 206, 206, 0)"> 
                  @error('fecha')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
        </div>
        


        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Descripción:</label>
            <div class="col-sm-5">
              <textarea type="text" class="form-control rounded-pill @error('descripcion') is-invalid @enderror" 
              maxlength="255" placeholder="Describa el motivo de la liberación del lote."
              name="descripcion" value="">{{old('descripcion')}}</textarea>
            @error('descripcion')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>
        
        <div class="mb-3 row">
            <div class="offset-sm-3 col-sm-9">
            <button type="submit"  id="submit-and-print" class="btn btn-outline-info">Guardar</button> 
            </div>
        </div> 
      </form>
        </div>
      </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
 {{-- cdn para el css de los emojis de fontawesomw --}}
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stop
@endcan
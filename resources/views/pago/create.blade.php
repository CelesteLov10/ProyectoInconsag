@extends('layout.plantillaH')

@section('titulo', 'Nuevo pago')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
@endsection
    
@section('contenido') 

    <div class="mb-5 m-5">
        <h3 class=" text-center">
            Nuevo pago de lote <strong>{{$venta->lote->nombreLote}}</strong>
        </h3>
        <hr>
    </div>

    <div class="container ">
        <div class="mb-3 text-end">
        <a class="btn btn-outline-primary" href="{{route('pago.index')}}">
            <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 btaura" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white">Registro pago</h5 > 
    </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('pago.store')}}" class="proveedor-guardar" method="POST" autocomplete="off">
        @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Número de venta:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('venta_id') is-invalid @enderror" 
                    placeholder="Ingrese el nuevo nombre de proveedor" 
                    name="venta_id" value="{{old('venta_id', $venta->id)}}" maxlength="50">
                    @error('venta_id')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre de cliente:</label>
            <div class="col-sm-5">
            <select name="cliente_id" id="" class="form-select rounded-pill @error('cliente_id') is-invalid @enderror">
                {{-- se muestra el registro guardado --}}
                <option value="{{$venta->cliente->id}}" 
                {{old('cliente_id' , $venta->cliente->nombreCompleto)==$venta->cliente->id ? 'selected' : ''}}>{{$venta->cliente->nombreCompleto}}</option>
            </select> 
            @error('cliente_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>
            
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre de lote:</label>
            <div class="col-sm-5">
            <select name="lote_id" id="" class="form-select rounded-pill @error('lote_id') is-invalid @enderror">
                {{-- se muestra el registro guardado --}}
                <option value="{{$venta->lote->id}}" 
                {{old('lote_id' , $venta->lote->nombreLote)==$venta->lote->id ? 'selected' : ''}} readonly=»readonly»>{{$venta->lote->nombreLote}}</option>
            </select> 
            @error('lote_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha de pago:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fechaPago') is-invalid @enderror" 
                maxlength="10" placeholder="Fecha actual"
                name="fechaPago" autocomplete="off" value="<?php echo date("Y-m-d");?>" readonly=»readonly» > 
                    @error('fechaPago')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Cantidad de cuotas:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('cantidadCuotasPagar') is-invalid @enderror" 
                maxlength="10" placeholder="Ingrese la cantidad de cuotas." id="cantidadCuotasPagar"
                name="cantidadCuotasPagar" autocomplete="off" value="{{old('cantidadCuotasPagar')}}" oninput="calcularPago1()" > 
                    @error('cantidadCuotasPagar')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Valor de la cuota:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('cuotaPagar') is-invalid @enderror" 
                maxlength="10" placeholder="Ingrese la cantidad de cuotas." id="cuotaPagar"
                name="cuotaPagar" autocomplete="off" value="{{old('cuotaPagar', $venta->valorCuotas)}}" readonly=»readonly» oninput="calcularPago1()"> 
                    @error('cuotaPagar')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Saldo en cuotas:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('saldoEnCuotas') is-invalid @enderror" 
                maxlength="10" placeholder="Saldo en cuotas." id="saldoEnCuotas"
                name="saldoEnCuotas" autocomplete="off" value="{{old('saldoEnCuotas', $venta->saldoEnCuotas)}}"  readonly=»readonly» > 
                    @error('saldoEnCuotas')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Valor del terreno:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('valorTerrenoPagar') is-invalid @enderror" 
                maxlength="10" placeholder="Ingrese la cantidad de cuotas." id="valorTerrenoPagar"
                name="valorTerrenoPagar" autocomplete="off" value="{{old('valorTerrenoPagar', $venta->valorTerreno)}}" readonly=»readonly» oninput="calcularPago1()"> 
                    @error('valorTerrenoPagar')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nuevo saldo:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('nuevoSaldo') is-invalid @enderror" 
                maxlength="10" placeholder="Saldo restante a pagar." id="nuevoSaldo"
                name="nuevoSaldo" autocomplete="off" value="{{old('nuevoSaldo', $venta->nuevoSaldo)}}" readonly=»readonly»> 
                    @error('nuevoSaldo')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>
        
        
        <div class="mb-3 row">
            <div class="offset-sm-3 col-sm-9">
            <button type="submit"  id="submit-and-print" class="btn btn-outline-info">Guardar e imprimir</button> 
            </div>
        </div>  
    </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
try
    {function calcularPago1(){
    
    var cantidadCuotasPagar = document.getElementById('cantidadCuotasPagar').value;
    var cuotaPagar = document.getElementById('cuotaPagar').value;
    var saldoEnCuotas = document.getElementById('saldoEnCuotas');
    var valorTerrenoPagar = document.getElementById('valorTerrenoPagar').value;
    var nuevoSaldo = document.getElementById('nuevoSaldo');

    var resultado = cantidadCuotasPagar * cuotaPagar; 
    saldoEnCuotas.value = resultado;

    valorTerrenoPagar -= resultado; 
    nuevoSaldo.value = valorTerrenoPagar;
    //document.getElementById('valorTerrenoPagar').innerHTML = resultado2;

    }
    }catch (error) {throw error;}
</script>

<script>
    document.getElementById('submit-and-print').addEventListener('click', function (event) {
        event.preventDefault();
        document.forms[0].submit();
        window.open('{{route('pago.print', ['id' =>$venta->id])}}', '_blank');
    });
</script>
@endsection

@extends('layout.plantillaH')

@section('titulo', 'Nuevo inventario')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
{{-- Plugins de mascara para inputs --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
@endsection

@section('contenido') 
<div>
    <div class="mb-5 m-5">
        <h3 class=" text-center">
            Registro de un nuevo inventario
        </h3>
        <hr>
      </div>

    <div class="container ">
        <div class="mb-3 text-end">
            <a class="btn btn-outline-primary" href="{{route('inventario.index')}}">
                <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
        </div>

        {{-- encabezado  --}}
        <div class = " card shadow ab-4 btaura">
            <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Creación inventario</h5 > 
        </div >

        <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
            <div class="col-60 bg-light p-5">
        <form action="{{route('inventario.store')}}" method="POST" autocomplete="off">
            @csrf {{-- TOKEN INPUT OCULTO --}}

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Nombre inventario:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill  @error('nombreInv') is-invalid @enderror" 
                        placeholder="Ingrese el nombre del inventario. Ejem. 'sillas'" 
                        name="nombreInv" value="{{old('nombreInv')}}" maxlength="50">
                        @error('nombreInv')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Cantidad:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill  @error('cantidad') is-invalid @enderror" 
                    placeholder="Ingrese la cantidad de inventario. Ejem. 0000" 
                        name="cantidad" value="{{old('cantidad')}}" maxlength="4">
                        @error('cantidad')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Precio del inventario:</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill  @error('precioInv') is-invalid @enderror" 
                        placeholder="Ingrese el precio del inventario. Ejem. '0.00' ó '0' " 
                        name="precioInv" id="precioInv" value="{{old('precioInv')}}" maxlength="8">
                        @error('precioInv')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Descripción:</label>
                <div class="col-sm-5">
                        <textarea type="text" class="form-control rounded-pill  @error('descripcion') is-invalid @enderror" 
                        placeholder="Ingrese una descripción"
                        name="descripcion" maxlength="150">{{old('descripcion')}}</textarea>
                        @error('descripcion')
                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Fecha:</label>
                <div class="col-sm-5">
                        <input type="text" class="form-control rounded-pill  @error('fecha') is-invalid @enderror" 
                        placeholder="Seleccione la fecha de compra del inventario" 
                        name="fecha" id="datepicker" autocomplete="off" value="{{old('fecha')}}" maxlength="10">
                        @error('fecha')
                            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                        @enderror
                    </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Nombre del empleado</label>
                <div class="col-sm-5">
                <select name="empleado_id" id="" class="form-select rounded-pill  @error('empleado_id') is-invalid @enderror">
                    <option value="" disabled selected>-- Selecione un nombre de empleado --</option>
                    @foreach ($empleado as $empleados)
                    <option value="{{$empleados->id}}" 
                        {{old('empleado_id' , $empleados->nombres)==$empleados->id ? 'selected' : ''}}>{{$empleados->nombres}}</option>
                    @endforeach
                </select> 
                @error('empleado_id')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Nombre de la oficina</label>
                <div class="col-sm-5">
                <select name="oficina_id" id="" class="form-select rounded-pill  @error('oficina_id') is-invalid @enderror">
                    <option value="" disabled selected>-- Selecione una oficina --</option>
                    @foreach ($oficina as $oficinas)
                    <option value="{{$oficinas->id}}" 
                        {{old('oficina_id' , $oficinas->nombreOficina)==$oficinas->id ? 'selected' : ''}}>{{$oficinas->nombreOficina}}</option>
                    @endforeach
                </select> 
                @error('oficina_id')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
                </div>
            </div>
            <div class="mb-3 row">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-outline-info">Guardar</button> 
            </div>
        </div>  
        </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    {{-- plugins para el calendario fechas jquery ui --}}
    <script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script> 
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
$( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true,
        firstDay: 0,
		monthNamesShort: ['Enero', 'Febrero', 'Marzo',
				'Abril', 'Mayo', 'Junio',
				'Julio', 'Agosto', 'Septiembre',
				'Octubre', 'Noviembre', 'Diciembre'],
		dayNamesMin: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
        maxDate: "2m",
        minDate: "-2m",
    });
    } );
</script>
@endsection
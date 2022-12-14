@extends('layout.plantillaH')

@section('titulo', 'Nueva venta')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
{{-- plugins para el calendario --}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- <link rel="stylesheet" href="/resources/demos/style.css">-->
<style>
    #mostrar{
        display: none;
    }

    #mostrarBoton{
        display: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@endsection
    
@section('contenido') 
@inject('bloques', 'App\Services\Bloques')
<div>

    <div class="mb-5 m-5">
        <h3 class=" text-center">
            Registro de una venta
        </h3>
        <hr>
    </div>

    <div class="container ">
        
        <div class="mb-3 text-end">
            {{-- Boton parte del modal --}}
            <button type="button" class="btn btn-outline-warning" id="agregar" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Agregar beneficiario
            </button>
        <a class="btn btn-outline-primary" href="{{route('venta.index')}}"> 
            <i class="bi bi-box-arrow-in-left"></i> Atrás</a>
    </div>

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 btaura">
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Creación de una venta</h5> 
        </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
            <form action="{{route('venta.store')}}" id="form1" class="venta-guardar" name="formulario1" method="POST" autocomplete="off">
            @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label" for="cliente_id">Cliente</label>
            <div class="col-sm-5">
            <select class="form-select rounded-pill @error('cliente_id') is-invalid @enderror" data-live-search="true" name="cliente_id" id="cliente_id" >
                lang="es">
                <option value="" data-icon="fas fa-user-tie" disabled selected>Buscar cliente</option>
                @foreach ($cliente as $clientes)
                    <option value="{{ $clientes->id }}"  {{old('cliente_id' , $clientes->nombreCompleto)==$clientes->id ? 'selected' : ''}}>{{ $clientes->nombreCompleto }}</option>
                @endforeach
            </select>
            @error('cliente_id')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
        @enderror
        </div>
    </div>

        <div class="mb-3 row">
            <label for="bloque" class="col-sm-3 col-form-label">Bloque:</label>
            <div class="col-sm-5">
            <select id="bloque" name="bloque_id" class="form-select rounded-pill @error('bloque_id') is-invalid @enderror"
                onchange="cambiolote(this.value)">
                @foreach ($bloques->get() as $index => $bloque)
                <option value="{{$index}}" 
                    {{old('bloque_id') == $index ? 'selected' : '' }}>  {{ $bloque}}
                </option>
                @endforeach
            </select> 
            @error('bloque_id')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>
    
        <input type="hidden" value="{{ old('lote_id') }}" id="prueba">
            <div class="mb-3 row">
            <label for="lote" class="col-sm-3 col-form-label">Lote:</label>
            <div class="col-sm-5">
                <select name="lote_id" id="lote"
                        class="form-select rounded-pill @error('lote_id') is-invalid @enderror"
                        onchange="f_obtener_lotes()">
                    <option value="" disabled selected>-- Seleccione un lote --</option>
                    @foreach ($lotes as $lote)
                        <option
                            value="{{ $lote->id }}" {{ old('lote_id') == $lote->id ? 'selected' : '' }}>{{$lote['nombreLote']}}</option>
                    @endforeach
                </select>
            @error('lote_id')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label  class="col-sm-3 col-form-label" for="valorTerreno">Valor del lote</label>
            <div class="col-sm-5">
                <input type="text" class="form-control  rounded-pill @error('valorTerreno') is-invalid @enderror" required
                    name="valorTerreno" id="valorTerreno" autocomplete="valorTerreno" placeholder="Precio del lote"
                value="{{old('valorTerreno')}}" readonly style="background-color: white">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre del beneficiario:</label>
            <div class="col-sm-5">
            <select name="beneficiario_id" id="" class="form-select rounded-pill @error('beneficiario_id') is-invalid @enderror" >
                <option value="" disabled selected>-- Seleccione un beneficiario --</option>
                @foreach ($beneficiarios as $beneficiario)
                    <option value="{{$beneficiario->id}}" 
                        {{old('beneficiario_id' , $beneficiario->nombreCompletoBen)==$beneficiario->id ? 'selected' : ''}}>{{$beneficiario->nombreCompletoBen}}</option>
                    @endforeach
                </select>
            @error('beneficiario_id')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Fecha de venta:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill @error('fechaVenta') is-invalid @enderror" 
                maxlength="10" placeholder="Seleccione la fecha de venta."
                name="fechaVenta" autocomplete="off" value="{{old('fechaVenta')}}" id="datepicker"> 
                @error('fechaVenta')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="mb-2  form-check-inline">  
                        <input class="form-check-input" type="radio" name="formaVenta" id="contado" value="contado" {{ (old('formaVenta') == "contado") ? "checked" : ""}} onclick="Desplegar('mostrarBoton'); Contraer('mostrar')">
                        <label class="form-check-label" for="flexRadioDefault1">Contado</label>
            </div>   
            <div class="mb-3  form-check-inline"> 
                        <input class="form-check-input" type="radio" name="formaVenta" id="credito" value="credito" {{ (old('formaVenta') == "credito") ? "checked" : ""}}  onclick="Desplegar('mostrar'); Contraer('mostrarBoton')">
                        <label class="form-check-label" for="flexRadioDefault1">Crédito</label>
            </div>
        </div>

        <div class="mb-3 row" id="mostrarBoton">
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-outline-info">Guardar</button> 
            </div>
        </div>  

         {{--********************************* FORMA DE VENTA CRÉDITO *********************************************************** --}}

        <div class="vh-50 row m-0 text-center align-items-center justify-content-center " id="mostrar">
            <div class="col-60 bg-light p-1">

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Valor de la prima:</label>
            <div class="col-sm-5">
                <input type="text" id="valorPrima" class="form-control rounded-pill  @error('valorPrima') is-invalid @enderror"
                placeholder="Ingrese el valor de la prima. Ejem. 123456" 
                    name="valorPrima" value="{{old('valorPrima')}}" maxlength="6" oninput="calcularPago()">
                    @error('valorPrima')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Cantidad de cuotas:</label>
            <div class="col-sm-5">
                <input type="text" id="cantidadCuotas" class="form-control rounded-pill  @error('cantidadCuotas') is-invalid @enderror"
                placeholder="Ingrese la cantidad de cuotas. Ejem. 000" 
                name="cantidadCuotas" value="{{old('cantidadCuotas')}}" maxlength="3" oninput="calcularPago()">
                @error('cantidadCuotas')
                    <small class="text-danger invalid-feedback" ><strong>*</strong>{{$message}}</small>
                @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Valor de la cuota:</label>
            <div class="col-sm-5">
                <input type="text" id="valorCuotas" class="form-control rounded-pill  @error('valorCuotas') is-invalid @enderror" 
                placeholder="Valor de las cuotas." 
                    name="valorCuotas" value="{{old('valorCuotas')}}" maxlength="5" readonly=»readonly»>
                    @error('valorCuotas')
                    <small class="text-danger invalid-feedback" ><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Valor restante a pagar:</label>
            <div class="col-sm-5">
                <input type="text" id="valorRestantePagar" class="form-control rounded-pill  @error('valorRestantePagar') is-invalid @enderror" 
                placeholder="Valor restante a pagar" 
                    name="valorRestantePagar" value="{{old('valorRestantePagar')}}" maxlength="6" readonly=»readonly»>
                    @error('valorRestantePagar')
                    <small class="text-danger invalid-feedback" ><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row" >
            <div class="offset-sm-3 col-sm-9">
                <button type="submit" class="btn btn-outline-info" onclick="validacion()">Guardar</button> 
            </div>
        </div>  

        </form>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Registro de beneficiario</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
        
            <form action="{{route('beneficiario.store')}}" id="p" class="beneficiario-guardar" method="POST" autocomplete="off">
                @csrf {{-- TOKEN INPUT OCULTO --}}
                
            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Identidad:</label>
                <div class="col-sm-7">
                <input type="text" class="form-control rounded-pill @error('identidadBen') is-invalid @enderror" 
                    placeholder="0000000000000" 
                    name="identidadBen" value="{{old('identidadBen')}}" required='required'
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
                name="nombreCompletoBen" value="{{old('nombreCompletoBen')}}" maxlength="80">
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
                name="telefonoBen" value="{{old('telefonoBen')}}" maxlength="8">
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
                name="direccionBen" value="">{{old('direccionBen')}}</textarea>
            @error('direccionBen')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
            </div>

            <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Nombre del cliente relacionado:</label>
            <div class="col-sm-7">
            <select name="cliente_id" id="" class="form-select rounded-pill @error('cliente_id') is-invalid @enderror" required='required'>
                <option value="" disabled selected>-- Seleccione un cliente --</option>
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
            <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
            </div>
        </div>
        </div>
    </div> {{-- cierre modal --}}

    </div>
</div>
@endsection

@section('js')
    {{-- plugins para el calendario fechas jquery ui 
            yearRange: "1960:2004",
            defaultDate: '01 ENE 2000',--}}
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
            maxDate: "0",
            minDate: "-1m"
        });
    } 
    );
</script>

<script>
  //Funciones para que al dar click en el otro radioBottom se oculte y muestre lo que hay en otro/
window.onload = function(){
    var x = document.getElementById("credito").checked;
    var elemento = document.getElementById("mostrar");

    var y = document.getElementById("contado").checked;
    var elemento1 = document.getElementById("mostrarBoton");
    
    /*Condicion que al estar checkeado un radioboton, aun recargado, permanezaca visible el div seleccionado*/
    if (x){
        elemento.style.display = 'block';
        }else if(y) {
        elemento1.style.display = 'block';
        }  
}
    
//Funciones que permiten ocultar y desplegar los divs correspondientes al dar click en los radiobotones
    function Desplegar(radiosb){ 
    var ver = document.getElementById(radiosb); 
    ver.style.display = "block"; 
    }
    function Contraer(radiosb){ 
    var ver = document.getElementById(radiosb); 
    ver.style.display = "none"; 
    }
</script>

<script>
  /*Funcion para que le salga el valor total que tendra que pagar por las horas alquiladas * el precio*/
try
    {function calcularPago(){
    
    var valorTerreno = document.getElementById('valorTerreno').value;
    var valorPrima = document.getElementById('valorPrima').value;
    var cantidadCuotas = document.getElementById('cantidadCuotas').value;
    var valorRestantePagar = document.getElementById('valorRestantePagar');
    var valorCuotas = document.getElementById('valorCuotas');

    var resultado = valorTerreno - valorPrima; 
    valorRestantePagar.value = resultado;

    var resultado2 =  resultado/cantidadCuotas; 
    valorCuotas.value = resultado2;

    }
    }catch (error) {throw error;}
</script>

<script>
        /*Peticion segun la ruta*/
        function peticion(id){
        let _token= "{{ csrf_token() }}";
        $.ajax({
        type: "POST",
        url: "/getLotes/"+id,
        data: {
        _token: _token},
        success: function(lote) {
            if ((lote.errors)) {
                alert('')
            } else {
                agregarSelect(lote);            
            }
        },
        });
        }

        function cargarselectmunicipio(idbloq, idlot){
        if (idlot===null) {
        
        } else {
        

        let _token= "{{ csrf_token() }}";
        $.ajax({
        type: "POST",
        url: "/getLotes/"+idbloq,
        data: {
        _token: _token},
        success: function(lote) {
            if ((lote.errors)) {
                alert('')
            } else {
                agregarSelect(lote); 
                $('#lote').val(idlot); 
               // $('#valorTerreno').val(lote.valorTerreno); NO ME DABAEL OLD EN Valorterreno         
            }
            },
            });
                }
        }
        /* Metodo para mandar a llamar los municipios*/
        function cambiolote(id_bloque){
            peticion(id_bloque);
            }
            function agregarSelect(lote){
            $('#lote').empty();
            $('#lote').append("<option selected disabled value=''>-- Seleccione un lote --</option>"); 
            for (let i = 0; i < lote.length; i++) {
            $('#lote').append("<option value='"+ lote[i].id+"'>"+lote[i].nombreLote+"</option>"); 

        
            }
        }

            $(document).ready(function(){
            cargarselectmunicipio($('#bloque').val(),$('#prueba').val())
                });  
                
</script>
<script>
    function f_obtener_lotes() {
                    var select = document.getElementById("lote");
                    var valor = select.value;

                    @foreach ($lotes as $lote)
                    if (valor == {{$lote->id}}) {
                        var input = document.getElementById("valorTerreno");
                        input.value = "{{$lote->valorTerreno}}";
                    }
                    @endforeach

                }
</script>
<script>
    //Scrip necesario para el modal
        window.onload = function(){
        var myModal = document.getElementById('modalBene').;
        var myInput = document.getElementById('identidadBen');
        /*
        var boton = document.getElementById('agregar');
        boton.addEventListener("click", agregar);
        */
    
        myModal.addEventListener('shown.bs.modal', function () {
            myInput.focus()
            event.stopPropagation();
        }); 
    }
</script>
@endsection

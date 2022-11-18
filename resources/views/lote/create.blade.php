@extends('layout.plantillaH')

@section('titulo', 'Nuevo lote')
    
@section('contenido') 
<div>
  <div class="mb-5 m-5">
      <h2 class=" text-center">
        <strong id="titulo">Registro de lotes para el bloque</strong> 
      </h2>
  </div>
  <div class="container ">
    <div class="mb-3 text-end">
      <a class="btn btn-outline-primary" href="{{route('bloque.index')}}">
        <i class="bi bi-box-arrow-in-left"></i>Atrás "este no"</a>
    </div>
    

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 bg-success bg-gradient" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Registro de lotes </h5 > 
        </div >

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
      <form action="{{route('lote.store')}}" class="lote-guardar" method="POST">
          @csrf {{-- TOKEN INPUT OCULTO --}}
          
        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Número de lote:</label>
          <div class="col-sm-5">
            <input type="number" id="numLote" class="form-control rounded-pill @error('numLote') is-invalid @enderror" 
            placeholder="Ingrese el número de lote" name="numLote" maxlength="1" value="{{old('numLote')}}">
              @error('numLote')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Medida lateral derecha:</label>
          <div class="col-sm-5">
            <input type="number" id="medidaLateralR" class="form-control rounded-pill @error('medidaLateralR') is-invalid @enderror" 
            placeholder="0.00" name="medidaLateralR" value="{{old('medidaLateralR')}}" maxlength="5" >
            @error('medidaLateralR')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Medida lateral izquierda:</label>
            <div class="col-sm-5">
              <input type="number" id="medidaLateralL" class="form-control rounded-pill @error('medidaLateralL') is-invalid @enderror" 
              placeholder="0.00" name="medidaLateralL" value="{{old('medidaLateralL')}}" maxlength="5" >
              @error('medidaLateralL')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Medida lateral enfrente:</label>
            <div class="col-sm-5">
              <input type="number" id="medidaEnfrente" class="form-control rounded-pill @error('medidaEnfrente') is-invalid @enderror" 
              placeholder="0.00" name="medidaEnfrente" value="{{old('medidaEnfrente')}}" maxlength="5">
              @error('medidaEnfrente')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Medida lateral trasera:</label>
            <div class="col-sm-5">
              <input type="number" id="medidaAtras" class="form-control rounded-pill @error('medidaAtras') is-invalid @enderror" 
              placeholder="0.00" name="medidaAtras" value="{{old('medidaAtras')}}" maxlength="5" >
              @error('medidaAtras')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

      

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Colindancia Norte:</label>
            <div class="col-sm-5">
                <textarea type="text" id="colindanciaN" class="form-control rounded-pill  @error('colindanciaN') is-invalid @enderror" 
                placeholder="Ingrese la colindancia norte del bloque." 
                    name="colindanciaN" value="{{old('colindanciaN')}}" maxlength="150"></textarea>
                    @error('colindanciaN')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                  </div>
                </div>

                <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Colindancia Sur:</label>
                 <div class="col-sm-5">
                   <textarea type="text" id="colindanciaS" class="form-control rounded-pill  @error('colindanciaS') is-invalid @enderror" 
                     placeholder="Ingrese la colindancia sur del bloque." 
                      name="colindanciaS" value="{{old('colindanciaS')}}" maxlength="150"></textarea>
                      @error('colindanciaS')
                         <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                       @enderror
                      
                </div>
              </div>

            <div class="mb-3 row">
           <label class="col-sm-3 col-form-label">Colindancia Este:</label>
           <div class="col-sm-5">
            <textarea type="text" id="colindanciaE" class="form-control rounded-pill  @error('colindanciaE') is-invalid @enderror" 
            placeholder="Ingrese la colindancia este del bloque. " 
                name="colindanciaE" value="{{old('colindanciaE')}}" maxlength="150"></textarea>
                @error('colindanciaE')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
         </div>
         </div>

         <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Colindancia Oeste:</label>
         <div class="col-sm-5">
         <textarea type="text" id="colindanciaO" class="form-control rounded-pill  @error('colindanciaO') is-invalid @enderror" 
          placeholder="Ingrese la colindancia oeste del bloque" 
          name="colindanciaO" value="{{old('colindanciaO')}}" maxlength="150"></textarea>
          @error('colindanciaO')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
          </div>
          </div>

      
        <div class="mb-3 row">
          <div class="offset-sm-3 col-sm-9">
            <button type="button" id="agregar" class="btn btn-outline-info">Agregar</button> 
            <button type="button" id="guardar" class="btn btn-outline-info">Guardar</button> 

          </div>
        </div>  
      </form>
        </div>
      </div>
    </div>
</div>



<div class="col-12 m-5" id="lotess">
  <div class="title">Registro lotes</div>
  <table class="table table-bordered" id="lista">
     <tr>
      <td>Lote #</td>
      <td>Derecha</td>
      <td>Izquierda</td>
      <td>Enfrente</td>
      <td>Trasera</td>
      <td>Norte</td>
      <td>Sur</td>
      <td>Este</td>
      <td>Oeste</td>
     </tr>
  </table>
</div>

@endsection

@section('js')
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  /*Script para tener el*/
  var boton = document.getElementById('agregar');
  var guardar = document.getElementById('guardar');
  var lista = document.getElementById('lista');
  var cantlotes = document.getElementById('cantidadLotes');
  var data=[];
  /*cuenta cuantos se han ingresados*/
  var cant = 0;

  boton.addEventListener("click", agregar);
  guardar.addEventListener("click", save);
 
  /*No tiene parametros por eso va vacio (no se que significa)*/
  function agregar(){
    var numLote = parseFloat(document.getElementById('numLote').value);
    var medidaLateralR = parseFloat(document.getElementById('medidaLateralR').value);
    var medidaLateralL = parseFloat(document.getElementById('medidaLateralL').value);
    var medidaEnfrente = parseFloat(document.getElementById('medidaEnfrente').value);
    var medidaAtras = parseFloat(document.getElementById('medidaAtras').value);
    var colindanciaN = document.getElementById('colindanciaN').value;
    var colindanciaS = document.getElementById('colindanciaS').value;
    var colindanciaE = document.getElementById('colindanciaE').value;
    var colindanciaO = document.getElementById('colindanciaO').value;

    //agregar ese elemento al arreglo
    data.push(
      {
      "id":cant,
      "numLote":numLote,
      "medidaLateralR":medidaLateralR,
      "medidaLateralL":medidaLateralL,
      "medidaEnfrente":medidaEnfrente,
      "medidaAtras":medidaAtras,
      "colindanciaN":colindanciaN,
      "colindanciaS":colindanciaS,
      "colindanciaE":colindanciaE,
      "colindanciaO":colindanciaO
       }
    );
    var id_row = 'row'+cant;
    var fila = '<tr id=' + id_row +'><td>'+ numLote +'</td><td>'+ medidaLateralR + ' </td><td>'+ medidaLateralL + '</td><td>' + medidaEnfrente + '</td><td>' + medidaAtras + '</td><td>' + colindanciaN + '</td><td>' + colindanciaS + '</td><td>' + colindanciaE + '</td><td>' +colindanciaO + '</td></tr>';
            //JQuery
            //agregar a la tabla
            $("#lista").append(fila);
            //si no hay nada en la lista que muestre vacio
            $("#numLote").val('');
            $("#medidaLateralR").val('');
            $("#medidaLateralL").val('');
            $("#medidaEnfrente").val('');
            $("#medidaAtras").val('');
            $("#colindanciaN").val('');
            $("#colindanciaS").val('');
            $("#colindanciaE").val('');
            $("#colindanciaO").val('');
            $("#numLote").focus();
            //cant controla la cantidad de lotes que se van a gregando
            cant++; 

  }

  /*funcion para guardar todo lo que se esta haciendo en la vista*/
  function save(){
    var json=JSON.stringify(data);
    $.ajax({
      type:"POST",
      url: "/getLotes",
      data: "json=" +json,
      success:function(resp){
        //una vez que se envio hace que la pagina se recargue
       location.reload();
       console.log(resp);
      }
    });
    console.log(json);
  }

</script>
@endsection
@extends('layout.plantillaH')

@section('titulo', 'Nuevo lote')
    
@section('contenido') 
<div>
      <div class="mb-5 m-5">
        <h2 class=" text-center">
            <strong id="titulo">Registro de terrenos</strong> 
        </h2>
      </div>

          <div class="container " style="display: none" id="bloque">
            <div class="mb-3 text-end">
              <a class="btn btn-outline-primary" href="{{route('bloque.index')}}">
                <i class="bi bi-box-arrow-in-left"></i>Atrás "este no"</a>
            </div>
            <div class = " card shadow ab-4 bg-success bg-gradient" >
              <div class = " card-header py-3 " >
              <h5 class = "n-font-weight-bold text-white" >Creación nuevo bloque</h5 > 
            </div >
      
      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('bloque.store')}}" class="bloque-guardar" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}
      <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Nombre del bloque:</label>
        <div class="col-sm-5">
          <input type="text" class="form-control rounded-pill @error('nombreBloque') is-invalid @enderror" 
          placeholder="Ingrese el nombre del bloque. (ejem. bloque1)" 
          name="nombreBloque" value="{{old('nombreBloque')}}" maxlength="50">
          @error('nombreBloque')
          <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
          @enderror
        </div>
      </div>

      <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Cantidad de Lotes:</label>
          <div class="col-sm-5">
              <input type="number" id="cantidadLotes" class="form-control rounded-pill  @error('cantidadLotes') is-invalid @enderror" 
              placeholder="Ingrese la cantidad de Lotes. Ejem. 1" 
                  name="cantidadLotes" value="{{old('cantidadLotes')}}" maxlength="4">
                  @error('cantidadLotes')
                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
          </div>
      </div>

      <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Subir Foto:</label>
          <div class="col-sm-5">
              <input accept="image/*" type="file" id="subirfoto" class="form-control rounded-pill  @error('subirfoto') is-invalid @enderror" 
                  name="subirfoto" value="{{old('subirfoto')}}" >
                  @error('subirfoto')
                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                  @enderror
                  <div ><small class="text-danger" id="myElement" ></small></div>
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

      {{-- REGISTRO BLOQUE--}}
      <div class = " card shadow ab-4 bg-success bg-gradient mt-3" id="lote" >
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
            <input type="text" class="form-control rounded-pill @error('numLote') is-invalid @enderror" 
            placeholder="Ingrese el número de lote" name="numLote" maxlength="1" value="{{old('numLote')}}">
              @error('numLote')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Medida lateral derecha:</label>
          <div class="col-sm-5">
            <input type="text" id="medidaLateralR" class="form-control rounded-pill @error('medidaLateralR') is-invalid @enderror" 
            placeholder="0.00" name="medidaLateralR" value="{{old('medidaLateralR')}}" maxlength="5" >
            @error('medidaLateralR')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Medida lateral izquierda:</label>
            <div class="col-sm-5">
              <input type="text" id="medidaLateralL" class="form-control rounded-pill @error('medidaLateralL') is-invalid @enderror" 
              placeholder="0.00" name="medidaLateralL" value="{{old('medidaLateralL')}}" maxlength="5" >
              @error('medidaLateralL')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Medida lateral enfrente:</label>
            <div class="col-sm-5">
              <input type="text" id="medidaEnfrente" class="form-control rounded-pill @error('medidaEnfrente') is-invalid @enderror" 
              placeholder="0.00" name="medidaEnfrente" value="{{old('medidaEnfrente')}}" maxlength="5">
              @error('medidaEnfrente')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Medida lateral trasera:</label>
            <div class="col-sm-5">
              <input type="text" id="medidaAtras" class="form-control rounded-pill @error('medidaAtras') is-invalid @enderror" 
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
            <button type="submit" class="btn btn-outline-info">Agregar</button> 
          </div>
        </div>  
      </form>
        </div>
      </div>
    </div>
</div>
@endsection

@section('js')
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
    window.onload = function(){
      var el = document.getElementById("t");
  el.addEventListener("click", modifyText, false);
      document.getElementById("form1").addEventListener('submit', (event)=>{
            event.preventDefault();   });

    var y = document.getElementById("maquinariaPropia").checked;
    var elemento1 = document.getElementById("mostrarBoton");
    
    /*Condicion que al estar checkeado un radioboton, aun recargado, permanezaca visible el div seleccionado*/
    if (x){
      elemento.style.display = 'block';
      }else if(y) {
        elemento1.style.display = 'block';
      }  
}
      </script>
@endsection


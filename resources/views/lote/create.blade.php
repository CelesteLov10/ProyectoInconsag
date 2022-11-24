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
        <i class="bi bi-box-arrow-in-left"></i>Atrás</a>
    </div>

      {{-- encabezado  --}}
      <div class = " card shadow ab-4 bg-success bg-gradient" >
        <div class = " card-header py-3 " >
            <h5 class = "n-font-weight-bold text-white" >Registro de lotes </h5 > 
        </div>

      <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
          <div class="col-60 bg-light p-5">
            {{-- onsubmit="event.preventDefault(); return saved()" --}}
      <form action="{{route('lote.store')}}" id="lotescrear"  class="lote-guardar" method="POST"  >
          @csrf {{-- TOKEN INPUT OCULTO --}}

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Bloque:</label>
            <div class="col-sm-5">
            <select name="bloque_id" id="bloque" class="form-select rounded-pill @error('bloque_id') is-invalid @enderror" onchange="llenar()">
              <option value="" disabled selected>-- Seleccione un bloque --</option>
                @foreach ($bloque as $bloques)
                <option value="{{$bloques->id}}" 
                  {{old('bloque_id' , $bloques->nombreBloque)==$bloques->id ? 'selected' : ''}}>{{$bloques->nombreBloque}}</option>
                @endforeach
            </select> 
            @error('bloque_id')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
            </div>
          </div>
          
          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Cantidad de lotes:</label>
            <div class="col-sm-5">
              <select id="cantidad" class="mi-selector form-select rounded-pill"
            data-show-subtext="true" data-live-search="true">
            @if(old('bloque'))
                    @foreach ($bloque as $p)
                        @if (old('bloque') == $p->id)
                            <option value="{{$bloques->id}}">{{$bloques->cantidadLotes}}</option>
                        @endif
                    @endforeach
                    @else
                    <option style="display:none" value="">Cantidad lotes</option>
                @endif
              </select>
            </div>
          </div>

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

        <div class="m-3">
          <h4 class=" text-center">
            <strong id="titulo">Medidas en metros</strong> 
          </h4>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Lateral derecha:</label>
          <div class="col-sm-5">
            <input type="number" id="medidaLateralR" class="form-control rounded-pill @error('medidaLateralR') is-invalid @enderror" 
            placeholder="0.00" name="medidaLateralR" value="{{old('medidaLateralR')}}" maxlength="5" >
            @error('medidaLateralR')
            <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
            @enderror
          </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Lateral izquierda:</label>
            <div class="col-sm-5">
              <input type="number" id="medidaLateralL" class="form-control rounded-pill @error('medidaLateralL') is-invalid @enderror" 
              placeholder="0.00" name="medidaLateralL" value="{{old('medidaLateralL')}}" maxlength="5" >
              @error('medidaLateralL')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Lateral enfrente:</label>
            <div class="col-sm-5">
              <input type="number" id="medidaEnfrente" class="form-control rounded-pill @error('medidaEnfrente') is-invalid @enderror" 
              placeholder="0.00" name="medidaEnfrente" value="{{old('medidaEnfrente')}}" maxlength="5">
              @error('medidaEnfrente')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Lateral trasera:</label>
            <div class="col-sm-5">
              <input type="number" id="medidaAtras" class="form-control rounded-pill @error('medidaAtras') is-invalid @enderror" 
              placeholder="0.00" name="medidaAtras" value="{{old('medidaAtras')}}" maxlength="5" >
              @error('medidaAtras')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

          <div class="m-3">
            <h4 class=" text-center">
              <strong id="titulo">Colindancias</strong> 
            </h4>
          </div>

          <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Norte:</label>
            <div class="col-sm-5">
                <textarea type="text" id="colindanciaN" class="form-control rounded-pill  @error('colindanciaN') is-invalid @enderror" 
                placeholder="Ingrese la colindancia norte del bloque." 
                    name="colindanciaN" value="" maxlength="150">{{old('colindanciaN')}}</textarea>
                    @error('colindanciaN')
                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                </div>
          </div>

            <div class="mb-3 row">
                  <label class="col-sm-3 col-form-label">Sur:</label>
                  <div class="col-sm-5">
                  <textarea type="text" id="colindanciaS" class="form-control rounded-pill  @error('colindanciaS') is-invalid @enderror" 
                    placeholder="Ingrese la colindancia sur del bloque." 
                      name="colindanciaS" value="" maxlength="150">{{old('colindanciaS')}}</textarea>
                    @error('colindanciaS')
                      <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                    @enderror
                      
                </div>
            </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Este:</label>
          <div class="col-sm-5">
              <textarea type="text" id="colindanciaE" class="form-control rounded-pill  @error('colindanciaE') is-invalid @enderror" 
              placeholder="Ingrese la colindancia este del bloque. " 
                name="colindanciaE" value="" maxlength="150">{{old('colindanciaE')}}</textarea>
                @error('colindanciaE')
                <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                @enderror
          </div>
        </div>

        <div class="mb-3 row">
          <label class="col-sm-3 col-form-label">Oeste:</label>
          <div class="col-sm-5">
            <textarea type="text" id="colindanciaO" class="form-control rounded-pill  @error('colindanciaO') is-invalid @enderror" 
              placeholder="Ingrese la colindancia oeste del bloque" 
              name="colindanciaO" value="" maxlength="150">{{old('colindanciaO')}}</textarea>
              @error('colindanciaO')
              <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
              @enderror
            </div>
          </div>

        <div class="mb-3 row">
          <div class="offset-sm-3 col-sm-9">
            <button type="submit" id="guardar" class="btn btn-outline-info">Guardar</button>
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

      <!-- <script>
        var boton = document.getElementById('bloque');
          boton.addEventListener("click", pasarValor);
      
      try
        {function pasarValor(){
        
        }
        }catch (error) {throw error;}
      
      </script>-->

      <script>
        function llenar() {
            $("#cantidad").find('option').not(':first').remove();
            var select = document.getElementById("bloque");
            var valor = select.value;
            var selectnw = document.getElementById("cantidad");
            @foreach($bloque as $p)
            if ({{$p -> id}} == valor) {
                // creando la nueva option
                var opt = document.createElement('option');
                // Añadiendo texto al elemento (opt)
                opt.innerHTML = "{{ $p->cantidadLotes }}";
                //Añadiendo un valor al elemento (opt)
                opt.value = "{{ $bloques->id }}";
                // Añadiendo opt al final del selector (sel)
                selectnw.appendChild(opt);
            }
            @endforeach
        }
    </script>

@endsection
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
            <div class=" card shadow ab-4 bg-success bg-gradient">
                <div class=" card-header py-3 ">
                    <h5 class="n-font-weight-bold text-white">Registro de lotes </h5>
                </div>

                <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
                    <div class="col-60 bg-light p-5">
                        {{-- onsubmit="event.preventDefault(); return saved()" --}}
                        <form action="{{route('lote.store')}}" id="lotescrear" class="lote-guardar" method="POST">
                            @csrf {{-- TOKEN INPUT OCULTO --}}

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Bloque:</label>
                                <div class="col-sm-5">
                                    <select name="bloque_id" id="bloque_id"
                                            class="form-select rounded-pill @error('bloque_id') is-invalid @enderror"
                                            onchange="f_obtener_lotes()">
                                        <option value="" disabled selected>-- Seleccione un bloque --</option>
                                        @foreach ($bloques as $bloque)
                                            <option
                                                value="{{ $bloque->id }}" {{ old('bloque_id') == $bloque->id ? 'selected' : '' }}>{{$bloque['nombreBloque']}}</option>
                                        @endforeach
                                    </select>
                                    @error('bloque_id')
                                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Lotes totales:</label>
                                <div class="col-sm-5">


                                    <input type="text"
                                           class="form-control  rounded-pill @error('cantidadLotes') is-invalid @enderror"
                                           id="cantidadLotes"
                                           name="cantidadLotes" value="{{ old('cantidadLotes') }}" required
                                           autocomplete="cantidadLotes"
                                           placeholder="Lotes totales"
                                           autofocus readonly
                                           style="background-color: white">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Nombre del lote:</label>
                                <div class="col-sm-5">
                                  <input type="text" id="nombreLote" class="form-control rounded-pill @error('nombreLote') is-invalid @enderror" 
                                  placeholder="Ingrese el nombre del lote" name="nombreLote" maxlength="10" value="{{old('nombreLote')}}">
                                    @error('nombreLote')
                                      <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                    @enderror
                                </div>
                              </div>
                              <div class="mb-3 row form-group">
                                <label class="col-sm-3 col-form-label">Estado:</label>
                                <div class="col-sm-5 form">
                                  <select class="form-control form-select rounded-pill @error('status') is-invalid @enderror" name="status">
                                    <option value="" disabled selected>-- Selecione un estado --</option>
                                    {{--  {{old('status' , $status->nombreE)==$status->id ? 'selected' : ''}} --}}
                                    @foreach ($lotes as $lote)
                                        <option value="{{$lote->status}}" 
                                        >{{$lote->status}}</option>
                                    @endforeach
                                  </select>
                                @error('status')
                                  <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                @enderror
                                </div>
                              </div>
                      

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Valor del terreno:</label>
                                <div class="col-sm-5">
                                    <input type="text" id="valorTerreno" class="form-control rounded-pill  @error('valorTerreno') is-invalid @enderror" 
                                    placeholder="Ingrese el valor del terreno. Ejem. 1000000" 
                                        name="valorTerreno" value="{{old('valorTerreno')}}" maxlength="8">
                                        @error('valorTerreno')
                                        <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                        @enderror
                                </div>
                            </div>
                              <br>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Medida lateral derecha:</label>
                                <div class="col-sm-5">
                                    <input type="number" id="medidaLateralR"
                                           class="form-control rounded-pill @error('medidaLateralR') is-invalid @enderror"
                                           placeholder="0.00" name="medidaLateralR" value="{{old('medidaLateralR')}}"
                                           maxlength="5">
                                    @error('medidaLateralR')
                                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Medida lateral izquierda:</label>
                                <div class="col-sm-5">
                                    <input type="number" id="medidaLateralL"
                                           class="form-control rounded-pill @error('medidaLateralL') is-invalid @enderror"
                                           placeholder="0.00" name="medidaLateralL" value="{{old('medidaLateralL')}}"
                                           maxlength="5">
                                    @error('medidaLateralL')
                                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Medida lateral enfrente:</label>
                                <div class="col-sm-5">
                                    <input type="number" id="medidaEnfrente"
                                           class="form-control rounded-pill @error('medidaEnfrente') is-invalid @enderror"
                                           placeholder="0.00" name="medidaEnfrente" value="{{old('medidaEnfrente')}}"
                                           maxlength="5">
                                    @error('medidaEnfrente')
                                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Medida lateral trasera:</label>
                                <div class="col-sm-5">
                                    <input type="number" id="medidaAtras"
                                           class="form-control rounded-pill @error('medidaAtras') is-invalid @enderror"
                                           placeholder="0.00" name="medidaAtras" value="{{old('medidaAtras')}}"
                                           maxlength="5">
                                    @error('medidaAtras')
                                    <small class="text-danger invalid-feedback"><strong>*</strong>{{$message}}</small>
                                    @enderror
                                </div>
                            </div>


                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Colindancia Norte:</label>
                                <div class="col-sm-5">
                <textarea type="text" id="colindanciaN"
                          class="form-control rounded-pill  @error('colindanciaN') is-invalid @enderror"
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
                   <textarea type="text" id="colindanciaS"
                             class="form-control rounded-pill  @error('colindanciaS') is-invalid @enderror"
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
            <textarea type="text" id="colindanciaE"
                      class="form-control rounded-pill  @error('colindanciaE') is-invalid @enderror"
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
         <textarea type="text" id="colindanciaO"
                   class="form-control rounded-pill  @error('colindanciaO') is-invalid @enderror"
                   placeholder="Ingrese la colindancia oeste del bloque"
                   name="colindanciaO" value="{{old('colindanciaO')}}" maxlength="150"></textarea>
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
                    @foreach($bloques as $bloque)
                    if ({{$bloque -> id}} == valor) {
                        // creando la nueva option
                        var opt = document.createElement('option');
                        // Añadiendo texto al elemento (opt)
                        opt.innerHTML = "{{ $bloque->cantidadLotes }}";
                        //Añadiendo un valor al elemento (opt)
                        opt.value = "{{ $bloque->id }}";
                        // Añadiendo opt al final del selector (sel)
                        selectnw.appendChild(opt);
                    }
                    @endforeach
                }

                function f_obtener_lotes() {
                    var select = document.getElementById("bloque_id");
                    var valor = select.value;

                    @foreach ($bloques as $bloque)
                    if (valor == {{$bloque->id}}) {
                        var input = document.getElementById("cantidadLotes");
                        input.value = "{{$bloque->cantidadLotes}}";
                    }
                    @endforeach

                }

            </script>

@endsection

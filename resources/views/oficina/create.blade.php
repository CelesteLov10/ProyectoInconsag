@extends('layout.plantillaH')

@section('titulo', 'Nuevo oficina')
    
@section('contenido') 

<div class="mb-5">
    <h4 class=" text-center">
    <strong>Creación de nueva oficina</strong> 
    </h4>
</div>
<div class="container ">

    {{-- encabezado  --}}
    <div class = " card shadow ab-4 " >
        <div class = " card-header py-3 " >
        <h6 class = "n-font-weight-bold text-primary">Creación oficina</h6 > 
    </div >

    <div class="vh-50 row m-0 text-center align-items-center justify-content-center">
        <div class="col-60 bg-light p-5">
    <form action="{{route('oficina.store')}}" method="POST">
        @csrf {{-- TOKEN INPUT OCULTO --}}

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Departamento:</label>
            <div class="col-sm-5">
                <input type="text" class="form-control rounded-pill" placeholder="Ingrese un nombre de departamento" 
                    name="nombreDepto" value="{{old('nombreDepto')}}">
                    @error('nombreDepto')
                    <small class="text-danger"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Dirección:</label>
            <div class="col-sm-5">
                    <textarea type="text" class="form-control rounded-pill" placeholder="Ingrese una direccion"
                    name="direccion">{{old('direccion')}}</textarea>
                    @error('direccion')
                    <small class="text-danger"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Cantidad:</label>
            <div class="col-sm-5">
                    <input type="text" class="form-control rounded-pill" placeholder="Ingrese cantidad de inventario" 
                    name="cantidadInv" value="{{old('cantidadInv')}}">
                    @error('cantidadInv')
                    <small class="text-danger"><strong>*</strong>{{$message}}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Nombre del inventario</label>
            <div class="col-sm-5">
            <select name="inventario_id" id="" class="form-select rounded-pill">
                <option value="" disabled selected>-- Selecione una opción--</option>
                @foreach ($inventario as $inventarios)
                <option value="{{$inventarios->id}}">{{$inventarios->id}}-{{$inventarios->nombreInv}}</option>
                @endforeach
            </select> 
            @error('inventario_id')
                <small class="text-danger"><strong>*</strong>{{$message}}</small>
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
@endsection
@section('js')<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
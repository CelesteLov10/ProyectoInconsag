@can('Admin.contacto.index')
@extends('adminlte::page')

@section('title', ' Listado')

@section('content_header')
    <h1>Listado de mensajería</h1>
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
<div> 



  <div class="container">
    <div class="mb-3 text-end">
  
    </div>
        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensaje'))
          <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
            {{ session('mensaje')}}
          </div>
        @endif

      

        {{-- encabezado --}}
        <div class = " card shadow ab-4 btaura" >
          <div class = " card-header py-3 " >
            <a href="{{route('contacto.index')}}" id="sinLinea">
              <h6 class = "n-font-weight-bold" title="Volver a todos los registros">Listado de mensajería</h6></a> 
          </div >

          <div class="m-0 align-items-center justify-content-center ">
            <div class=" p-5">
                <table id="example" class="table table-striped table-bordered border-2 ">
                    <thead class="">
                    <tr>
                      <th scope="col">Fecha de registro</th>
                      <th scope="col">Nombre(s)</th>
                      <th scope="col">Apellido(s)</th>
                      <th scope="col">Teléfono</th>
                      <th scope="col">Detalle</th>
                    </tr>
                  </thead>
                  <tbody>
            @forelse($contactos as $contacto)
            <tr>
            <td>{{$contacto->fecha}}</td>
            <td>{{$contacto->nombre}}</td>
            <td>{{$contacto->apellido}}</td>
            <td>{{$contacto->telefono}}</td>
            <td><a class="btn btn-outline-primary" 
                href="{{route('contacto.show', ['id'=>$contacto->id])}}">
                <i class="fa fa-eye"></i> </a></td> 
                </a></td>
                @csrf
            </tr>
            @empty
            <tr>
            <td col-span="4">No hay registros</td>
            </tr>
        @endforelse
                    
                  </tbody>
                </table>
                {{-- {{$contactos->links()}} --}} 
          </div>
      </div>
  </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}">
  {{-- cdn para el css de los emojis de fontawesomw --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@stop

@section('js')
    {{-- plugins para el buscador jquery ui --}}
<script src="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
<script>src="https://code.jquery.com/jquery-3.5.1.js"</script>
<script> src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"</script>
<script> src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"</script>



{{-- Codigo para que el mensaje se cierre luego de 5 segundos pasar id al div --}}
<script>
  $('#alert').fadeIn();     
  setTimeout(function() {
      $("#alert").fadeOut();           
  },5000);
</script>

{{-- script para que muestre el datables en español, y que funcione el datables --}}
<script>
  $(document).ready(function() {
  $('#example').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    }
  });
});
</script>
@stop
@endcan


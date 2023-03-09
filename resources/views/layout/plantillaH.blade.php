<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- css --}}
    <link rel="stylesheet" type="text/css" href="{{asset('estilos.css')}}"> <!--El asset es un archivo que se encuentra en la web que puede ser utilizado
    esto es para que todas las plantillas tengan el mismo estilo-->
    {{-- ICONS BOOTSTRAP --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    {{-- ALERTS SWEET --}}
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <title>@yield('titulo')</title>
  
    @yield('css')

    <style>
    /*MODO OSCURO*/
  

    .dark-mode{
    background-color: black;
    color: white;
    
}
    </style>
</head>

<body>

  <div class="d-flex justify-content-between">                                                                                   {{-- ancho y alto de menu vertical --}}
    <div class="d-flex flex-column flex-shrink-0  justify-content-between p-3 m-0 text-white bg-dark rounded-end" style="width: 15%; height: auto">
      <a href="/" class="d-flex align-items-center text-white text-decoration-none">
          <span class="m-2"><i class="bi bi-house-fill text-light"></i></span>
          <span class="fs-5 text-light">Menú principal</span>
      </a>
      <hr>
      <ul class="nav nav-pills flex-column mb-auto list-group">
          <li class="nav-item">
          <a href="{{route('puestoLaboral.index')}}" 
              class="nav-link link-light list-group-item list-group-item-action list-group-item-dark" aria-current="page">
              <span class="p-2"><i class="bi bi-person-lines-fill text-white"></i></span>
              Puesto laboral
          </a>
          </li>
          <li>
          <a href="{{route('oficina.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-building text-white"></i></span>
              Oficina
          </a>
          </li>
          <li>
            <a href="{{route('empleado.indexEmp')}}" 
            class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                <span class="p-2"><i class="bi bi-person-circle text-white"></i></span>
                Empleados
            </a>
            </li>
          <li>
          <a href="{{route('inventario.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-stack text-white"></i></span>
              Inventario
          </a>
          </li>
          <li>
          <a href="{{route('proveedor.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-bag-dash-fill text-white"></i></span>
              Proveedor
          </a>
          </li>
          <li>
          <a href="{{route('maquinaria.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-truck-front-fill text-white"></i></span>
              Maquinaria
          </a>
          </li>
          <li>
            <a href="{{route('bloque.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                <span class="p-2"><i class="bi bi-bricks text-white"></i></span>
                Bloques y lotes
            </a>
            </li>
            <li>
                <a href="{{route('pago.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                    <span class="p-2"><i class="bi bi-clipboard-data text-white"></i></span>
                    Lotes vendidos
                </a>
                </li>
            <li>
            <a href="{{route('cliente.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                <span class="p-2"><i class="bi bi-person-fill text-white"></i></span>
                Clientes
            </a>
            </li>
            <li>
                <a href="{{route('venta.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                    <span class="p-2"><i class="bi bi-save-fill text-light"></i></span>
                    Ventas
                </a>
             </li>
           <!--  <li>
                <a href="{ {route('report.reports_day')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                    <span class="p-2"><i class="bi bi-calendar2-minus text-light"></i></span>
                    Reportes por día
                </a>
             </li>
             <li>
                <a href="{ {route('reports.reports_date')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                    <span class="p-2"><i class="bi bi-calendar2-minus text-light"></i></span>
                    Reportes por fecha
                </a>
             </li>
            -->
             {{-- 
                <li class="nav-item">
              <a class="nav-link link-light list-group-item list-group-item-action list-group-item-dark " 
              data-toggle="collapse" href="#page-layouts1" aria-expanded="false"
              aria-controls="page-layouts">
              <span class="p-2"><i class="bi bi-calendar2-minus text-light"></i></span> Reportes
              </a>
             <div class="collapse" id="page-layouts1">
              <ul class="nav flex-column sub-menu">
                @can('reports.day')
                <li class="nav-item ">
                    
                    <a class="nav-link" href="{{route('report.reports_day')}}">Reportes por día</a>
                </li>
                @endcan
                @can('reports.date')
                <li class="nav-item">
                    <a class="nav-link" href="{{route('reports.reports_date')}}">Reportes por fecha</a>
                </li>
                @endcan
                </ul>
                </div>
            </li>             
                --}}
                <li>
                    <a href="{{route('constructora.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                        <span class="p-2"><i class="bi bi-archive-fill text-light"></i></span>
                        Constructoras
                    </a>
                 </li>
                 <li>
                    <a href="{{route('casa.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                        <span class="p-2"><i class="bi bi-house-fill text-light"></i></span>
                        Casas modelos
                    </a>
                 </li>

                 <li>
                    <a href="{{route('gasto.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                        <span class="p-2"><i class="bi bi-cart4 text-light"></i></span>
                        Gastos
                    </a>
                 </li>
                 <li>
                    <a href="{{route('planilla.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
                        <span class="p-2"><i class="bi bi-file-spreadsheet text-light"></i></span> 
                        Planillas
                    </a>
                 </li>
      </ul>
      
      {{--<button class="btn-hover glow-on-hover" onclick="darkMode()">Modo oscuro</button>--}}
      <hr>
      <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
        {{-- <img src="./imagenes/inconsag.svg" alt="" width="32" height="32" class="rounded-circle me-2"> --}}
        <strong class=" bi bi-person-fill text-light" style="margin-left: 10%"> Login</strong>          </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
          <li><a class="dropdown-item" href="#">New project...</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
          <li><a class="dropdown-item" href="#">Profile</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
      </div>
  </div>
                                      {{-- ancho y alto del div de todas las vistas --}}
    <main class="text-white bg-light" style="width: 85%; height: cover; opacity: 0.75">      
        @yield('contenido')
    </main>
</div>

      <div>
        <footer class="align-items-center py-3 my-4 mb-0 border-top">
          <p id= "par" class="col-md-7 mb-0 text-muted">©copyright 2022 CCFS</p>
        </footer>
      </div>
      
      {{-- jquery --}}
      <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      {{-- PARA QUE FUNCIONE EL DROPDOWN TOGGLE --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
      
      @yield('js')

      <script>
        function darkMode() {
          var element = document.div;
          element.classList.toggle("dark-mode");
        }
      </script>
      
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    {{-- css --}}
    <link rel="stylesheet" type="text/css" href="{{asset('estilos.css')}}"> <!--El asset es un archivo que se encuentra en la web que puede ser utilizado
    esto es para que todas las plantillas tengan el mismo estilo-->
    {{-- ICONS BOOTSTRAP --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>@yield('titulo')</title>
    {{-- cdn para los select dependientes --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    @yield('css')
</head>

<body>

  <div class="d-flex justify-content-between ">                                                                                   {{-- ancho y alto de menu vertical --}}
    <div class="d-flex flex-column flex-shrink-0  justify-content-between p-3 m-0 text-white bg-dark bg-gradient rounded-end" style="width: 275px; height: 1350px">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-4 me-md-auto text-white text-decoration-none">
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
          <a href="{{route('empleado.indexEmp')}}" 
          class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-person-circle text-white"></i></span>
              Empleados
          </a>
          </li>
          <li>
          <a href="{{route('oficina.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-building text-light"></i></span>
              Oficina
          </a>
          </li>
          <li>
          <a href="{{route('inventario.index')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-stack text-light"></i></span>
              Inventario
          </a>
          </li>
          <li>
          <a href="{{route('proveedor.create')}}" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-bag-dash-fill text-light"></i></span>
              Proveedor
          </a>
          </li>
          <li>
          <a href="#" class="nav-link link-light list-group-item list-group-item-action list-group-item-dark">
              <span class="p-2"><i class="bi bi-truck-front-fill text-light"></i></span>
              Maquinaria
          </a>
          </li>
      </ul>
      <hr>
      <div class="dropdown">
          <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="./imagenes/inconsag.svg" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong class="text-light">Login</strong>
          </a>
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
    <main class="d-flex flex-column flex-shrink-0  justify-content-start p-0 m-0  text-white bg-light bg-gradient rounded" style="width: 85%; height: 70%">
      @yield('contenido')
    </main>
</div>

      <div id="footer">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 mb-0 border-top">
          <p id= "par" class="col-md-7 mb-0 text-muted ">©copyright 2022 CCFS</p>
        </footer>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      {{-- PARA QUE FUNCIONE EL DROPDOWN TOGGLE --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      @yield('js')
      
</body>
</html>

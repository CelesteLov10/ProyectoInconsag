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

    
    @yield('css')


</head>
<body>
      <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
          <a href="{{route('menuPrincipal')}}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
              <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
            </svg>
            <svg class="bi me-2" width="5" height="32">
              <use xlink:href="#bootstrap">
              </use>
            </svg>
            <span class="fs-4" _msthash="1127126" _msttexthash="316940">
              INCONSAG
            </span>
          </a>
          <ul class="nav nav-pills">
            <li class="nav-item">
              <a href="#" class="nav-link" _msthash="1281800" _msttexthash="418782">
                Contactos
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link" _msthash="1281982" _msttexthash="107419">
                Acerca de
              </a>
            </li>
          </ul>
        </header>
      </div>

      <main class="flex-shrink-0">
      @yield('contenido')
      </main>


      <div id="footer">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 mb-0 border-top">
          <p id= "par" class="col-md-7 mb-0 text-muted ">©copyright 2022 CCFS</p>
        </footer>
      </div>
      
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      @yield('js')
      
</body>
</html>

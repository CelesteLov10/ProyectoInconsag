@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
<style>
  @keyframes ejemplo {
    from {opacity: 0;}
    to {opacity: 1;}
  }
  .an {
    animation-name: ejemplo;
    animation-duration: 5s;
  }

  @keyframes slidein {
    from {
      opacity: 0;
      margin-left: 100%;
      width: 300%
    }

    to {
      opacity: 1;
      margin-left: 0%;
      width: 100%;
    }
  }

  .ani {
    animation-duration: 3s;
    animation-name: slidein;
  }  
    
  header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #21606d;
    color: #fff;
    padding: 10px;
  }

  .logo img {
    max-height: 50px;
  }

  #nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
  }

  .list {
      display: inline-block;
    }

  nav a {
      color: #fff;
      display: inline-block;
      padding: 10px;
      text-decoration: none;
  }

  nav a:hover {
    background-color: #eaeaea;
  }

</style>
@stop

@section('content')
        {{-- alerta de mensaje cuando se guardo correctamente --}}
        @if (session('mensajeContacto'))
          <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert" >
            {{ session('mensajeContacto')}}
          {{--  <button type="button" class="btn-close" data-bs-dismiss="alert" id="alert" aria-label="Close"></button> --}}
          </div>
        @endif
    <div class="p-6" style="margin:0%">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" id="alert" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <header>
          <div>
            <img src="./imagenes/logo_dashboard.png" alt="loguito" style="width:200px; height:40px; list-style:none">
            {{-- <h1 style="text-align: center; font-size:30px; color:rgb(176, 214, 255); 
            margin-left:20px; margin-top:5px">
              <b class="an">INCONSAG</b>
              </h1>           --}}
          </div>
          <nav>
              <ul id="nave" style="list-style: none; margin: 0; padding: 0; text-align: center;">
                <li class="list">
                <a href="#ubicacion" style="border-right: white solid 2px">
                  <span>UBICACIÓN</span>
                </a>
                </li>
                <li class="list">
                  <a href="#quienessomos" style="border-right: white solid 2px">
                    <span>QUIÉNES SOMOS</span>
                  </a>
                </li>
                <li class="list">
                  <a href="#contactanos">
                    <span>CONTÁCTANOS</span>
                  </a>
                </li>
              </ul>
          </nav>
        </header>

        <div style="background-color: black">
          <div id="miCarrusel" class="carousel slide p-6" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <video class="d-block w-100" alt="Video 1" style="width: 16in; height: 7in" autoplay muted>
                  <source src="./imagenes/video1.mp4">
                </video>
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(1).jpg" class="d-block w-100" alt="Imagen 1" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(2).jpg" class="d-block w-100" alt="Imagen 4" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(3).jpg" class="d-block w-100" alt="Imagen 5" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(4).jpg" class="d-block w-100" alt="Imagen 6" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(5).jpg" class="d-block w-100" alt="Imagen 7" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(6).jpg" class="d-block w-100" alt="Imagen 9" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(7).jpg" class="d-block w-100" alt="Imagen 10" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(8).jpg" class="d-block w-100" alt="Imagen 11" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(9).jpg" class="d-block w-100" alt="Imagen 12" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/(10).jpg" class="d-block w-100" alt="Imagen 13" 
                  style="width: 16in; height: 7in">
                </div>
              </div>
              <a class="carousel-control-prev" href="#miCarrusel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="carousel-control-next" href="#miCarrusel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
              </a>
            </div>
          </div> 

  {{--Debajo del carrusel--}}
  <div class="col-50 p-5" style="margin:0%; background-color:black">
    <section style="margin-left:5%; margin-right:5%">

      {{-- MAPA GOOGLE --}}
      <div class="column mcb-column mcb-item-0jh0gveal one column_fancy_heading">
        <h2 id="ubicacion" style="color:white; text-align: left;">
          Ubicación <i class="fa fa-map-pin" style="color:red"></i></h2>
          <div id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
            <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
                var setting = {
                  "height":500,
                  "width":1080,
                  "zoom":16,
                  "queryString":"Residencial Valle del Sauce, La Paz, Honduras",
                  "place_id":"ChIJwb7v7USDZY8RTVNxrpfpAMQ",
                  "satellite":true,
                  "centerCoord":[14.31090187873376,-87.65863363477482],
                  "cid":"0xc400e997ae71534d",
                  "lang":"es",
                  "cityUrl":"/honduras/comayagua-64822",
                  "cityAnchorText":"Mapa de Comayagua, Honduras",
                  "id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                  "embed_id":"914454"};
                var d = document;
                var s = d.createElement('script');
                s.src = 'https://1map.com/js/script-for-user.js?embed_id=914454';
                s.async = true;
                s.onload = function (e) {
                  window.OneMap.initMap(setting)
                };
                var to = d.getElementsByTagName('script')[0];
                to.parentNode.insertBefore(s, to);
              })();</script><a href="https://1map.com/es/map-embed">1 Map</a>
              <p style="color:azure">A 15 minutos de palmerola.</p></div>
      </div>

      <br><br><br>
      <hr style="background:white;">
      <br>

      {{-- INFORMACION DE LA EMPRESA --}}
      <div class="ani">
        <h2 id="quienessomos" style="color:white; text-align: center;"><b>Quiénes Somos</b></h2>
          <p style="color:azure; text-align:justify; font-size:20px">
            Inmobiliaria y constructora Sauceda Galindo INCONSAG de R.L de C.V. Nace para satisfacer 
            las necesidades habitacionales de la región, ofreciendo el mejor servicio de atención, los
            mejores terrenos y la mejor calidad de vida para ti.
          </p>
          <div class="text-center">
          <img src="./imagenes/logoFondoNegro.jpg" alt="logoNegro">
          <p class="text-light">Logo de la empresa.</p>
          </div>
      </div>

      <br>
      <br>

      <div class="ani">
        <h2 id="mision" style="color:rgb(0, 238, 255); text-align: center;">Misión</h2>
          <p style="color:azure; text-align:justify; font-size:20px">
            Construir desarrollos habitacionales con la infraestructura y equipamiento 
            urbano necesarios, para mejorar cualitativamente el nivel de vida de nuestros 
            clientes, utilizando insumos de la mejor calidad y personal altamente calificado.
          </p>
      </div>

      <br>
      <br>

      <div class="ani">
        <h2 id="vision" style="color:rgb(0, 238, 255); text-align: center;">Visión</h2>
          <p style="color:azure; text-align:justify; font-size:20px">
            Mantenerse como una organización líder en el desarrollo de viviendas en la zona 
            central del país ofreciendo siempre excelencia en todos nuestros procesos y resultados.
          </p>
      </div>

      <br><br>

    <div class="ani">
    <h2 style="color:rgb(255, 255, 255); text-align: center;"><b>Valores</b></h2>
      <br>

      <div>
        <nav>
          <ul style="list-style: none; margin: 0; padding: 0; text-align: center;">
          <li style="margin-right:1%" class="list">
          <span style="color:azure; text-align:justify; font-size:20px; margin: 5px; padding:5px 
          border-radius:20px"><b>• Transparencia</b></span>
          </li>
          <li style="margin-right:1%" class="list">
            <span style="color:azure; text-align:justify; font-size:20px; margin: 5px; padding:5px
            border-radius:20px"><b>• Honestidad</b></span>
          </li>
          <li style="margin-right:1%" class="list">
            <span style="color:azure; text-align:justify; font-size:20px; margin: 5px; padding:5px
            border-radius:20px"><b>• Respeto</b></span>
          </li>
          <li style="margin-right:1%" class="list">
            <span style="color:azure; text-align:justify; font-size:20px; margin: 5px; padding:5px
            border-radius:20px"><b>• Trabajo en equipo</b></span>
          </li>
          <li class="list">
            <span style="color:azure; text-align:justify; font-size:20px; margin: 5px; padding:5px
            border-radius:20px"><b>• Responsabilidad</b></span>
          </li>
          </ul>
        </nav>				
      </div>
      
    </div>

      <br><br>
      <hr style="background:white;">
      <br>

      {{-- ATENCION AL CLIENTE --}}
      <div class="ani">
        <h2 id="contactanos" style="color:white; text-align: center;">Contáctanos</h2>
          <p style="color:azure; text-align:justify; font-size:20px">
            La inmobiliaria Inconsag pone a la disposición de todos sus clientes 
            el servicio de consultas atravez de las siguientes opciones.</p>
            <br>
            
        <nav>
          <ul style="list-style: none; margin: 0; padding: 0; text-align: center;">
            <li style="margin-right:3%" class="list">
        <div>
          <p style="color:rgb(255, 255, 255); font-size:20px">WhatsApp 
            <a type="submit" id="submit-and-print" href="https://wa.link/k87nr5" 
              class="btn btn-outline-success" style="height:37px; width:40px">
              <i class="fa-brands fa-whatsapp"></i>
            </a>                      
          </p>
        </div>
            </li>
            <li style="margin-right:3%" class="list">
        <div>
          <p style="color:rgb(255, 255, 255); font-size:20px">Facebook 
            <a type="submit" id="submit-and-print" 
              href="https://www.facebook.com/profile.php?id=100090029844815&mibextid=ZbWKwL" 
              class="btn btn-outline-info" style="height:37px; width:40px">
              <i class="fa-brands fa-facebook"></i>
            </a>                      
          </p>
        </div>
            </li>
            <li class="list">
          <div>
            <p style="color:rgb(255, 255, 255); font-size:20px">Correo
              <a type="submit" id="submit-and-print" href="mailto:inconsaghn2022@gmail.com" 
                class="btn btn-outline-danger" style="height:37px; width:41px">
                <i class="fa fa-envelope"></i>
              </a>                      
            </p>
          </div>
            </li>
        </ul>
        </nav>

        <br>

        {{-- HORARIOS DE ATENCION --}}
        <h5 style="color:rgb(255, 243, 215);">Horarios de atención.</h5>
        <p class="text-light" style="margin: 0%">Lunes-viernes: 8am-4pm</p>
        <p class="text-light">Sábado-domingo: 8am-12pm</p> 
    </section>
  </div>

  {{-- FOOTER --}}
    <footer class="align-items-center py-3 my-7 mb-0 border-top" 
      style="background-color: black">
      <p class="text-muted" style="text-align: center; font-size:18px">
        © 2022 Todos Los Derechos Reservados || CCFS.
      </p>
    </footer>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{asset('vendor/jquery-ui-1.13.2/jquery-ui.min.css')}}"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  {{-- cdn para el css de los emojis de fontawesomw --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stop

@section('js')
    <script> console.log('Hi!'); </script>

    {{-- FUNCION QUE PERMITE REPRODUCIR EL VIDEO NUEVAMENTE --}}
    <script>
      var videos = document.querySelectorAll('#miCarrusel video');
      videos.forEach(function(video) {
        video.addEventListener('ended', function() {
          // con esto el video se reproduce otra vez al haber finalizado
          video.currentTime = 0;
          video.play();
        });
      });
    </script>

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

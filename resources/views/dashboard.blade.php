@extends('adminlte::page')

@section('title', 'Dashboard')

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
    background-color: #1d4461;
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

  nav li {
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
    <div class="p-6" style="margin:0%">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <header>
          <div>
            <h1 style="text-align: center; font-size:30px; color:rgb(176, 214, 255); 
            margin-left:20px; margin-top:5px">
              <b class="an">Lotificadora INCONSAG</b>
              </h1>          
          </div>
          <nav>
              <ul id="nave" style="list-style: none; margin: 0; padding: 0; text-align: center;">
                <li>
                <a href="#ubicacion" style="border-right: white solid 2px">
                  <span>UBICACIÓN</span>
                </a>
                </li>
                <li>
                  <a href="#quienessomos" style="border-right: white solid 2px">
                    <span>QUIÉNES SOMOS</span>
                  </a>
                </li>
                <li>
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
                  <img src="./imagenes/0.jpg" class="d-block w-100" alt="Imagen 1" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/1.jpg" class="d-block w-100" alt="Imagen 2" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/2.jpg" class="d-block w-100" alt="Imagen 3" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/3.jpg" class="d-block w-100" alt="Imagen 4" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/4.jpg" class="d-block w-100" alt="Imagen 5" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/5.jpg" class="d-block w-100" alt="Imagen 6" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/loti1.jpg" class="d-block w-100" alt="Imagen 7" 
                  style="width: 16in; height: 7in">
                </div>
                <div class="carousel-item">
                  <img src="./imagenes/loti2.jpg" class="d-block w-100" alt="Imagen 8" 
                  style="width: 16in; height: 7in">
                </div>
              </div>
              <a class="carousel-control-prev" href="#miCarrusel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="carousel-control-next" href="#miCarrusel" role="button" data-slide="next" >
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
          <div class="centrado" id="wrapper-9cd199b9cc5410cd3b1ad21cab2e54d3">
            <div id="map-9cd199b9cc5410cd3b1ad21cab2e54d3"></div><script>(function () {
                var setting = {
                "height":457,
                "width":708,
                "zoom":17,
                "queryString":"UNAH-TEC Danlí, Danlí, Honduras",
                "place_id":"ChIJuekEdvBpbo8R67s8Mba-0SY",
                "satellite":false,
                "centerCoord":[13.993218253957401,-86.56962469999999],
                "cid":"0x26d1beb6313cbbeb",
                "lang":"es",
                "cityUrl":"/honduras/danli-467803",
                "cityAnchorText":"Mapa de Danli, Honduras",
                "id":"map-9cd199b9cc5410cd3b1ad21cab2e54d3",
                "embed_id":"911662"
                };
                var d = document;
                var s = d.createElement('script');
                s.src = 'https://1map.com/js/script-for-user.js?embed_id=911662';
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
            Quiénes Somos es el punto de mira para muchos de tus clientes, de hecho 
            las estadísticas confirman que es una de las páginas más visitadas de 
            una web porque es la que más habla de ti o de tu empresa y permite a 
            los usuarios descubrir tu "rostro", algo fundamental para aumentar la 
            credibilidad de tu marca.
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
            La misión de una empresa es el motivo por el que existe dicha empresa, 
            su razón de ser. Indica la actividad que realiza la empresa. 
            Suele plasmarse en una declaración escrita (una frase o un párrafo) 
            que refleja la razón de ser de la empresa.
          </p>
      </div>

      <br>
      <br>

      <div class="ani">
        <h2 id="vision" style="color:rgb(0, 238, 255); text-align: center;">Visión</h2>
          <p style="color:azure; text-align:justify; font-size:20px">
            La visión de una empresa describe el objetivo que espera lograr en 
            un futuro. Se trata de la expectativa ideal de lo que quiere alcanzar 
            la organización, indicando además cómo planea conseguir sus metas.
          </p>
      </div>

      <br><br>

    <div class="ani">
    <h2 style="color:rgb(255, 255, 255); text-align: center;"><b>Valores</b></h2>
      <br>

      <div>
        <nav>
          <ul style="list-style: none; margin: 0; padding: 0; text-align: center;">
          <li style="margin-right:1%">
          <span style="color:azure; text-align:justify; font-size:20px; padding: 10px; 
          border:rgb(0, 238, 255) solid 2px; border-radius:20px">Transparencia</span>
          </li>
          <li style="margin-right:1%">
            <span style="color:azure; text-align:justify; font-size:20px; padding: 10px; 
            border:rgb(0, 238, 255) solid 2px; border-radius:20px">Honestidad</span>
          </li>
          <li style="margin-right:1%">
            <span style="color:azure; text-align:justify; font-size:20px; padding: 10px; 
            border:rgb(0, 238, 255) solid 2px; border-radius:20px">Respeto</span>
          </li>
          <li style="margin-right:1%">
            <span style="color:azure; text-align:justify; font-size:20px; padding: 10px; 
            border:rgb(0, 238, 255)solid 2px; border-radius:20px">Trabajo en equipo</span>
          </li>
          <li>
            <span style="color:azure; text-align:justify; font-size:20px; padding: 10px; 
            border:rgb(0, 238, 255) solid 2px; border-radius:20px">Responsabilidad</span>
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
            <li style="margin-right:3%">
        <div>
          <p style="color:rgb(255, 255, 255); font-size:20px">WhatsApp 
            <a type="submit" id="submit-and-print" href="https://wa.link/y2rtgb" 
              class="btn btn-outline-success" style="height:37px; width:40px">
              <i class="fa-brands fa-whatsapp"></i>
            </a>                      
          </p>
        </div>
            </li>
            <li style="margin-right:3%">
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
            <li>
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
        <p class="text-light" style="margin: 0%">Lunes-viernes: 8am-6pm</p>
        <p class="text-light">Sábado-domingo: 9am-12pm</p> 
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
    
@stop

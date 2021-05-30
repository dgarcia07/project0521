<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
   <link rel="icon" type="image/png" sizes="96x96" href="../../assets/img/favicon.png">
   <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

   <title>Serempre | Daniel García</title>

   <!-- Canonical SEO -->
   <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-pro"/>

   <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
   <meta name="viewport" content="width=device-width" />

   <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">

   <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
   <link href="{{asset('assets/css/paper-dashboard.css')}}" rel="stylesheet" />
   <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />
   <link href="{{asset('assets/css/home.css')}}" rel="stylesheet" />
</head>

<body style="background-image: url({{'images/wallpaper.jpg'}});">
   <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand text-dark" href="/">
         <img src="{{asset('images/serempre.png')}}" alt="Serempre" class="w-25">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
         <ul class="navbar-nav mr-auto">

         </ul>
         <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
               @if (Route::has('login'))
                  <li class="nav-item">
                     <a class="nav-link btn btn-primary" href="{{ route('login') }}">Iniciar sesión</a>
                  </li>
               @endif

               @if (Route::has('register'))
                  <li class="nav-item">
                     <a class="nav-link btn btn-primary" href="{{ route('register') }}">Registro</a>
                  </li>
               @endif
            @else
               <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-primary" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                     {{ Auth::user()->name }}
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                     <a href="{{ route('home.index') }}" class="dropdown-item">Inicio</a>
                     <a class="dropdown-item" href="{{ route('logout') }}"onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                     </form>
                  </div>
               </li>
            @endguest
         </ul>
      </div>
   </nav>

   <div class="wrapper">
      <div class="full-page login-page" data-color="" data-image="../../assets/img/background/background-2.jpg">
         <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
         <div class="content">
            @yield('content')
         </div>
      </div>
   </div>

   <script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
   <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
   <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
   <script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
   <!-- Chart JS -->
   <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
   <!--  Notifications Plugin    -->
   <script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
   <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
   <script src="{{asset('assets/js/paper-dashboard.min.js')}}" type="text/javascript"></script>
</body>
</html>

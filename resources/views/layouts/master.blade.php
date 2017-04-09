<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Agence</title>

  {{-- CSS --}}
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
  <link rel="stylesheet" href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}">
  <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ asset('select2/css/select2.css') }}" rel="stylesheet"> 
</head>
<body>
  <nav>
    <div class="nav-wrapper grey lighten-5">
      <a href="#" class="brand-logo right"><img src="{{ asset('img/logo.gif') }}" id="logo" alt="agence"></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Agence</a></li>
        <li><a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> Projetos</a></li>
        <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Administrativo</a></li>
        <li class="active"><a href="{{ URL::to('/') }}"><i class="fa fa-users" aria-hidden="true"></i> Comercial</a></li>
        <li><a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Financeiro</a></li>
        <li><a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Usuario</a></li>
        <li><a href="#"><i class="fa fa-times" aria-hidden="true"></i> Salir</a></li>
      </ul>
      <ul id="nav-mobile" class="side-nav">
        <li><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Agence</a></li>
        <li><a href="#"><i class="fa fa-check-square-o" aria-hidden="true"></i> Projetos</a></li>
        <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Administrativo</a></li>
        <li class="active"><a href="{{ URL::to('/') }}"><i class="fa fa-users" aria-hidden="true"></i> Comercial</a></li>
        <li><a href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Financeiro</a></li>
        <li><a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Usuario</a></li>
        <li><a href="#"><i class="fa fa-times" aria-hidden="true"></i> Salir</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>

  <main class="mn-inner">
      <div class="row">
          <div class="col s12">
          <br>
              <div class="page-title"><a href="{{ URL::to('/') }}" class="waves-effect waves-grey btn m-b-xs" style="color: white !important;">Por Consultor</a> <a class="waves-effect waves-grey btn white m-b-xs">Por Cliente</a></div>
          
          </div> 
          <div class="col s12 m12 l12">
              <div class="card">
                  <div class="card-content">
                      <div class="row" id="table-agence">   
                          
                          @yield('content')
                      
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </main>
  {{-- SCRIPTS --}}
  <script src="{{ asset('js/jquery-3.2.0.min.js') }}"></script>
  <script src="{{ asset('js/materialize.js') }}"></script>
  <script src="{{ asset('js/init.js') }}"></script>
  <script src="{{ asset('select2/js/select2.min.js') }}"></script>
  <script src="{{ asset('pages/form-select2.js') }}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
        $('select').material_select();
        $('img').fadeIn(4000);
        $( ".mn-inner" ).slideDown(1000);
    });
  </script>
  </body>
</html>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="{{ asset('site/style.css') }}">
  <meta charset="utf-8">
  <title>EventosJá</title>
  <link rel="shortcut icon" href="{{ asset('img/logo2.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>  
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  

</head>

<body>

  <div class="container-fluid h-100">
    <div class="row h-100">
      <div class="col-2 hidden-md-down bg-dark" style="margin: 0px">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark text-center" style="width: 280px;">
          <img src="{{ asset('img/logo2.png') }}">
          <h1 style="color: #fff">Eventos Já</h1>
          <hr>
          <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
              <a href="/" class="nav-link active" aria-current="page">
                Home
              </a>
            </li>
          </ul>
          <hr>
        </div>
      </div>
      <div class="col-10 " style="width: 100%; margin: 0px; padding: 0px; background-color: #d9ddde">
        <nav class="navbar navbar-light bg-white" style=" border-bottom: solid 1px #bfc1c5">
          <div class="container-fluid">
            <span class="navbar-text">
              O melhor gerenciador de eventos :D
            </span>
          </div>
        </nav>
        <div class="p-5">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  @yield('js')
  <script src="{{ asset('site/jquery.js') }}"></script>
  <script src="{{ asset('site/bootstrap.js') }}"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

</body>

</html>

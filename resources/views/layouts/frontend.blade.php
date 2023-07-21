
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Panel</title>

    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}" />
    <link href="{{asset('css/jquery.alerts.min.css')}}" rel="stylesheet" />
   
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .container{
        margin-left: auto !important;
      }
      .btn-custom{
        width: 100%;
      }
      .col-sm-12{
        padding-right: 0%; 
        padding-left: 0px;
      }
      

    </style>


    <script src="{{asset('js/bootstrap.js')}}"></script>

  </head>
  <body>
    
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">
            <img class="" src="{{asset('images/logo.png')}}" alt="" width="200" >
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <div class="container-fluid">
        <div class="row">
            
            <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-md-4">
                <main class="container">
                    @yield('content')
                </main>
            </main>
        </div>
    </div>
  </body>
</html>

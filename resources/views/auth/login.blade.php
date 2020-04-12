<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    SIMAK | Login page
  </title>
  <!-- Favicon -->
  <link href="{{ asset('public/template/assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('public/template/assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/template/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{ asset('public/template/assets/css/argon-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
</head>
<style>
  @media only screen and (max-width:991px){
      .mm{
          margin-top: 3rem !important;
      }
  }

  /* @media only screen and (min-width:000px){

  } */
</style>

<body>
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md bg-primary navbar-dark p-1">
      <div class="container px-0">
        {{-- <marquee behavior="" direction=""> --}}
        <a class="navbar-brand" href="">
          <h2 class="text-white py-1 my-1 ml-3">SIMAK APPS</h2>
        </a>
      {{-- </marquee> --}}
      </div>
    </nav>
    <!-- Header -->
    <div class="header py-7 py-lg-8">
      
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0 mm mt--3">
            <div class="card-body px-lg-5 py-lg-4">
                  <div class="col-md text-center">
                    <img src="{{ asset('public/template/assets/img/brand/dm.png') }}" class="mb-4 text-center" width="45%" alt="">
                  </div>
              
              <h2 class="text-center">Form Login</h2>
              <div class="text-center text-muted mb-4">
                {{-- <small>SIMAK APPS @php echo date('Y') @endphp</small> --}}
              </div>
              
              @if ($message = Session::get('failed'))
                <div class="alert alert-danger alert-sm alert-dismissible fade show" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                  <small><i class="fas fa-exclamation-triangle" style="padding-right: 3%;"></i>{{ $message }}</small>
                </div>
              @endif
              
              <form action="/simak/postlogin" method="post" role="form">
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" name="email" placeholder="Email" type="email">
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control" name="password" placeholder="Password" type="password">
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block my-2">Login</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © @php
                  echo date('Y');
              @endphp <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="{{asset('public/template/assets/js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('public/template/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Argon JS   -->
  <script src="{{asset('public/template')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
</body>

</html>
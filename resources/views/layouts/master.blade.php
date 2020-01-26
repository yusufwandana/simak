<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    @yield('title')
  </title>
  @yield('meta')
  <!-- Favicon -->
  <link href="{{ asset('public/template/assets/img/brand/favicon.png') }}" rel="icon" type="image/png">
  {{-- Datatables --}}
  <link href="{{ asset('public/datatables/dataTables.bootstrap4.min.css') }}" rel="icon" type="image/png">
  <link href="{{ asset('public/datatables/datatables.min.css') }}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{ asset('public/template/assets/js/plugins/nucleo/css/nucleo.css') }}" rel="stylesheet" />
  <link href="{{ asset('public/template/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  {{-- Editable --}}
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/jqueryui-editable/css/jqueryui-editable.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
  <!-- CSS Files -->
  <link href="{{ asset('public/template/assets/css/argon-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
</head>
  <style>
      .gambir{
          width: 65%;
      }
      .kata{
          display: none;
      }
      @media only screen and (max-width:425px){
          .gambir{
              display: none;
          }

          .kata{
              display: inline;
          }
      }

      /* @media only screen and (min-width:000px){

      } */
  </style>
<body>
    @include('layouts.includes._sidebar')
  <div class="main-content">
      
    <!-- Navbar -->
    @include('layouts.includes._navbar')
    <!-- End Navbar -->

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        @yield('dashboard')
    </div>
      @yield('content')
  </div>
  <!--   Core   -->
  <script src="{{ asset('public/template/assets/js/plugins/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('public/template/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <!--   Optional JS   -->
  <script src="{{ asset('public/template/assets/js/plugins/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('public/template/assets/js/plugins/chart.js/dist/Chart.extension.js') }}"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
  <!--   Argon JS   -->
  <script src="{{ asset('public/template/assets/js/argon-dashboard.min.js?v=1.1.0') }}"></script>
  <script src="{{ asset('public/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('public/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/datatables/dataTables.bootstrap4.min.js') }}"></script>
  @yield('customjs')
  
  {{-- <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script> --}}
  {{-- <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script> --}}
</body>

</html>
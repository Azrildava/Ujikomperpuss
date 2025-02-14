<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SeoDash Free Bootstrap Admin Template by Adminmart</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('user/assets/images/logos/seodashlogo.png')}}" />
  <link rel="stylesheet" href="{{asset('user/assets/css/styles.min.css')}}" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    @include('layouts.frontend.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('layouts.frontend.navbar')
      <!--  Header End -->
      <div class="container-fluid">
        @yield('content')
        {{-- footer --}}
        @include('layouts.frontend.footer')
        {{-- end footer --}}
      </div>
    </div>
  </div>
  <script src="{{asset('user/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('user/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('user/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{asset('user/assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{asset('user/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('user/assets/js/app.min.js')}}"></script>
  <script src="{{asset('user/assets/js/dashboard.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js')}}"></script>
</body>

</html>

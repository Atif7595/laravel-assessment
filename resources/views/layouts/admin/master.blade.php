<!doctype html>
<html lang="en">

@include('layouts.admin.head')
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
      @include('layouts.admin.sidebar')
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
    @include('layouts.admin.header')
      <!--  Header End -->
     @yield('content')
    </div>
  </div>
  @stack('script')
  <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets/js/sidebarmenu.js')}}"></script>
  <script src="{{ asset('assets/js/app.min.js')}}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets/libs/simplebar/dist/simplebar.js')}}"></script>
  <script src="{{ asset('assets/js/dashboard.js')}}"></script>
</body>

</html>

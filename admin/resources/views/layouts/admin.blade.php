<!DOCTYPE html>

@yield('vars')

<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{!! config('system_config.system.company_name') !!}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/bower_components/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/bower_components/dist/css/adminlte.min.css">
</head>
<body class="{!! config('system_config.system.body_class') !!}">
<div id="app" class="wrapper">

  <!-- Navbar -->
  @include('layouts.admin-parts.admin-navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.admin-parts.admin-sidebar')
  <!-- /.Main Sidebar Container -->
  
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
            @include('layouts.admin-parts.page-header')

            @include('layouts.admin-parts.page-breadcrumbs')

        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">

      @yield('content')

      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
  @include('layouts.admin-parts.admin-control-sidebar')
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  @include('layouts.admin-parts.admin-footer')
  <!-- /.Main Footer -->
  
</div>

<!-- jQuery -->
<script src="/bower_components/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/bower_components/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/bower_components/dist/js/adminlte.min.js"></script>

<script src="/bower_components/plugins/chart.js/Chart.min.js"></script>

<script src="{{ asset('js/app.js') }}" defer></script>

{{-- @include('layouts.admin-parts.admin-toasts') --}}
</body>
</html>

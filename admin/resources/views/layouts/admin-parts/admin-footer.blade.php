<footer class="main-footer">
  <!-- To the right -->
  <div class="float-right d-none d-sm-inline">
    Sys Load: (
      <b><single-value
            endpoint="{{ Route('loadavg1m') }}"
            interval="1000"
          ></single-value></b>
     / <b><single-value
            endpoint="{{ Route('loadavg5m') }}"
            interval="1000"
          ></single-value></b>
     / <b><single-value
            endpoint="{{ Route('loadavg15m') }}"
            interval="1000"
          ></single-value></b> )
    Sys Time: <b><single-value
            endpoint="{{ Route('systemtime') }}"
            interval="1000"
          ></single-value></b>
    App Mem: <b><single-value
            endpoint="{{ Route('memoryused') }}"
            interval="10000"
          ></single-value>mb</b>
  </div>
  <!-- Default to the left -->
  <strong>Copyright &copy; {{ date('Y') }} <a href="#">{!! config('system_config.system.company_name') !!}</a>.</strong> All rights reserved.
</footer>
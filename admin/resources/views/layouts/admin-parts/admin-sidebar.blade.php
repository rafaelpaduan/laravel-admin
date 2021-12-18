<aside class="{!! config('system_config.system.sidebar_class') !!}">
    <!-- Brand Logo -->
    <a href="{{ Route('home') }}" class="brand-link">
      <img src="{!! config('system_config.system.logo_img') !!}" alt="" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{!! config('system_config.system.logo_text') !!}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{!! config('system_config.user.default_img') !!}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      @include('layouts.admin-parts.sidebar-menu')

    </div>
    <!-- /.sidebar -->
  </aside>
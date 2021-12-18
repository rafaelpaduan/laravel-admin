<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
        <!-- <span class="badge badge-danger navbar-badge">3</span> -->
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class=" card-widget widget-user ">
              <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                <h5 class="widget-user-desc">Founder &amp; CEO</h5>
              </div>
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{!! config('system_config.user.default_img') !!}" alt="User Avatar">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-6 border-right">
                    <div class="description-block">
                        <button type="button" class="btn btn-warning btn-block"><i class="fas fa-edit"></i> Perfil</button>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="description-block">
                        <button type="button" class="btn btn-danger btn-block"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Sair</button>
                        
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                        </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
    </ul>
</li>
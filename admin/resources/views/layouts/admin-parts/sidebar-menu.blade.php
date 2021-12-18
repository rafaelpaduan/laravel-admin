    
    @php
      function setActive($item){

        if(route($item, [], false) == ("/" . Route::current()->uri)){

          return "active";
        }
      }
    @endphp
    
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">NAVEGAÇÃO</li>
          <li class="nav-item">
            <a href="{{ Route('home') }}" class="nav-link {{ setActive("home") }}">
              <i class="nav-icon fas fa-house-user"></i>
              <p>Home</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('usuarios.index') }}" class="nav-link {{ setActive("usuarios.index") }}">
              <i class="nav-icon fas fa-users"></i>
              <p>Usuários</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ Route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>Parceiros</p>
            </a>
          </li>
          <li class="nav-header">ADMINISTRAÇÃO</li>
          <li class="nav-item">
            <a href="{{ Route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Permissões</p>
            </a>
          </li>
        </ul>
    </nav>

    {{-- {{ dd(Route::current()->uri) }} --}}

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand logo-brand" href="#">
      <img height="44" title="PokeparadaLogo" src="https://upload.wikimedia.org/wikipedia/commons/3/39/Pokeball.PNG">
      LaPokeparada
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('account') ?>">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('users') ?>">Usuarios</a>
            </li>
            
            <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
              <li class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="text-capitalize">Productos</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                  <a class="dropdown-item" href="<?= site_url('productos') ?>">Productos</a>
                  <a class="dropdown-item" href="<?= site_url('unidades') ?>">Unidades</a>
                  <a class="dropdown-item" href="<?= site_url('categorias') ?>">Catalogo</a>
                </div>
              </li>
            </ul>

            <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
              <li class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="text-capitalize">Ventas</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                  <a class="dropdown-item" href="<?= site_url('productos') ?>">Ventas</a>
                  <a class="dropdown-item" href="<?= site_url('unidades') ?>">Unidades</a>
                  <a class="dropdown-item" href="<?= site_url('unidades') ?>">Catalogo</a>
                </div>
              </li>
            </ul>

            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('calculator') ?>">Calcular IVA</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('users/logs') ?>">Estadisticas</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('settings') ?>">Configuraciones</a>
            </li>
          </ul> 

        <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
          <li class="nav-item dropdown">
            <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="text-capitalize">Administrador</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
              <a class="dropdown-item" href="<?= site_url('profile') ?>">Cuenta</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= site_url('logout') ?>">Cerrar Sesion &rarr;</a>
            </div>
          </li>
        </ul>
        
    </div>
</nav>

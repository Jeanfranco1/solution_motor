<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="escritorio.php" class="nav-link"> <i class="fas fa-home"></i> Home</a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" data-toggle="modal" data-target="#modal-contacto-desarrollador" class="nav-link"><i class="fas fa-user-secret"></i> Contacto</a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="navbar-search" href="#" role="button">
        <i class="fas fa-search">sasassas</i>
      </a>
      <div class="navbar-search-block">
        <form class="form-inline">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </li> -->

    <!-- Messages Dropdown Menu -->
    <li class="nav-item dropdown ">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <img src="../dist/docs/all_trabajador/perfil/<?php echo $_SESSION['imagen']; ?>" class="user-image img-circle" alt="User Image" width="30" onerror="this.src='../dist/svg/user_default.svg';"> 
             
        <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-info">
            <h3 class="widget-user-username"><?php echo $_SESSION['nombre']; ?></h3>
            <h5 class="widget-user-desc"><?php echo $_SESSION['cargo']; ?></h5>
          </div>
          <div class="widget-user-image">
            <img class="img-circle elevation-2" src="../dist/docs/all_trabajador/perfil/<?php echo $_SESSION['imagen']; ?>" alt="User Avatar" onerror="this.src='../dist/svg/user_default.svg';" />
          </div>
          <div class="card-footer">
            <span class="dropdown-item dropdown-header">Info personal</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-address-card"></i>
              <?php echo $_SESSION['tipo_documento']; ?>: <?php echo $_SESSION['num_documento']; ?>               
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-phone-alt"></i> Telefono: <?php echo $_SESSION['telefono']; ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope"></i> Email: <?php echo $_SESSION['email']; ?>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer"> <small>Más informacion cominicarse con el administrador </small>  </a>
            <!-- /.row -->
            <a href="../ajax/usuario.php?op=salir" class="btn btn-danger btn-block">Cerrar sesion</a>
          </div>
        </div>
        <!-- /.widget-user -->
        
      </div>
    </li>
    <!-- Pantalla completa -->
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <!-- FIN Pantalla completa -->

    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li> -->
  </ul>
</nav>
<!-- /.navbar -->

<header class="main-header">
  <style type="text/css">
    #class_imagenlogo a:hover {
      background-color: #114887;

    }
  </style>
  <!-- Logo -->
  <a href="../index.php" class="logo" id="class_imagenlogo" style="background-color: #114887; padding: 5px;">
    <img src="../Plantilla/dist/img/fav2.jpg" style="object-fit: cover; max-height: 50px;">
</a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button #367fa9 paso a #969d9c-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class=" user-menu" id="refres_add" style="display: none;">
          <a><i class="fa fa-spin fa-refresh"></i>
          </a>

        </li>

        <li class="dropdown user user-menu">

          <a href="../../web/index.php" target="_blank"><i class="fa fa-home"></i>Home
          </a>

        </li>
        <li class="dropdown user user-menu">
          <input type="text" name="" id="YearActualActivo" hidden>
          <input type="text" name="" id="tex_YearActual_" hidden>
          <a href="../index.php" class="dropdown-toggle" data-toggle="dropdown"><i class="fa  fa-flag-oe"></i><strong
              id="nombreYearactivo"></strong>
          </a>

        </li>

        <!-- Notifications: style can be found in dropdown.less -->

        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-"></span>

          </a>
          <ul class="dropdown-menu" style="border-radius: 5px">
            <li>
              <!-- inner menu: contains the actual data -->
              <ul class="menu">
                <li>
                  <a href="#">
                    <center>
                <li class="header">No tienes Notificaciones</li>
                </center>
                </a>
            </li>
          </ul>
        </li>
        <li class="footer"><a href="#">...</a>
        </li>
      </ul>
      </li>


      <li class="dropdown user user-menu"><a class="app-nav__item" href="#" data-toggle="dropdown"
          aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i>
        </a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right"
          style="width: 150px;height:250px;border-radius: 5px;box-shadow: 0px 0px 10px 6px #0001;"><br>
          <center>
            <img class="img-circle" alt="User Image" style="width: 50px;height:50px;filter: hue-rotate(45deg);"
              src="../imagenes/usuarios/images.png"><br>
            <p style=" margin: 0;
    font-size: 1.5rem;
    font-weight: 700;">
              <?php echo $_SESSION['S_ROL']; ?>
            </p>
            <p>
              <?php echo $_SESSION['S_USER']; ?>
            </p>
          </center>
          <div class="container">

          </div><br>
          <div class="container">
            <li class="dropdown-item"
              onclick="cargar_contenido('contenido_principal','prerfil/vista_perfil_usuarios.php')"
              style="cursor: pointer; cursor: pointer;width: 123px;display: flex;align-items: center;justify-content: center;font-size: 1.5rem;font-weight: 700;color: #3c8dbc;">
              <i class="fa fa-user fa-lg"></i>
              &nbsp;&nbsp; Mi Perfil
            </li>
          </div><br>
          <div class="container">
            <div class="col-lg-12">
              <li class="dropdown-item">
                <a class=""
                  style="border-radius: 5px;background:#3894c9; cursor: pointer;display: flex;width: 100px;color: white;align-items: center;justify-content: center;padding: 0.5rem;text-transform: uppercase;font-weight: 700;"
                  href="../controlador/usuario/controlador_cerrar_session.php"><i
                    class="fa fa-sign-out"></i>&nbsp;&nbsplogout</a>


              </li>
            </div>
          </div><br>

        </ul>
      </li>

      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"></a>
      </li>
      </ul>
    </div>
  </nav>
</header>
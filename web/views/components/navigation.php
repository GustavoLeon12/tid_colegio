<?php
require_once './components/form_admision.php';
?>

<nav class="menu-superior navbar navbar-expand-lg navbar-light  top-menu "
  style="position: sticky; top: 0; z-index: 1000;">
  <div class="container">
    <a class="navbar-brand logo2" href="../views/index.php"><img src="../img/LOGO.png" alt="Logo" width="100"></a>
    <ul class="d-flex align-items-center justify-content-center list-unstyled mb-0">
      <li class="me-2"><i class="fas fa-envelope"></i> Correo: colegiooriontarma@gmail.com</li>
      <span class="text-center" style="color: #ccc;">|</span>
      <li class="mx-2"><i class="fas fa-phone"></i> Telefono: 954016787</li>
      <a>
        <style>
          .aplica-ya {
            background-color: #ff4a4a;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            animation: pulse 1.5s infinite;
            transition: background-color 0.3s ease;
          }

          .aplica-ya:hover {
            background-color: #ff2424;
          }

          @keyframes pulse {

            0%,
            100% {
              transform: scale(1);
            }

            50% {
              transform: scale(1.1);
            }
          }
        </style>
        <button class="aplica-ya open-form-admision">APLICA YA</button>
      </a>
    </ul>
  </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-light top-menu sticky-top second-navbar"
  style="position: sticky; z-index: 999;">
  <div class="container">
    <a class="navbar-brand logo p-0" href="#"><img src="../img/LOGO.png" alt="Logo" width="100"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#megaMenuNav"
      aria-controls="megaMenuNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mega-menu-collapse" id="megaMenuNav">
      <ul class="navbar-nav navbar-nav__container">
        <div class="navbar-nav__first">
          <li class="nav-item ">
            <a class="en" href="../views/index.php">Inicio</a>
          </li>
          <li class="nav-item ">
            <a class="en" href="../views/ninstitucion.php">Nuestra institución</a>
          </li>
          <li class="nav-item ">
            <a class="en">Niveles <i class="fas fa-caret-down"></i></a>
            <ul class=" sub-menu">
              <li>
                <a class="inicial" style="font-size: 13px;">Inicial</a>
              </li>
              <li>
                <a class="primaria" style="font-size: 13px;">Primaria</a>
              </li>
              <li>
                <a class="secundaria" style="font-size: 13px;">Secundaria</a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a class="en" href="../views/noticias.php">Noticias</a>
          </li>
          <li class="nav-item mega-menu-link ">
            <a class="en" href="../views/contacto.php">Contacto</a>
          </li>
          <li class="nav-item dropdown position-static ">
            <a class="en mega-menu-link" href="#" id="megaMenuDropdown">
              Explorador
            </a>
            <div class="container dropdown-menu mega-menu show" id="megaMenuDropdownActive">
              <div class="row">
                <div class="col-md-4">
                  <section class="secciones-enlaces  text-white ">
                    <h6>COMUNICATE</h6>
                    <hr>
                    <a href="../views/noticias.php">Eventos y Noticias</a>
                    <hr>
                    <a href="../views/calendario.php">Calendario Escolar</a>
                    <hr>
                    <a href="../views/admision.php">Niveles</a>
                    <hr>

                  </section>
                </div>

                <div class="col-md-4">
                  <section class="secciones-enlaces  text-white ">
                    <h6>OTRAS PAGINAS</h6>
                    <hr>
                    <a href="../views/reglamentacion.php">Reglamentacion</a>
                    <hr>
                    <a href="../views/personal.php">Personal Docente</a>
                    <hr>
                    <a href="../views/galeria.php">Galeria</a>
                    <hr>

                  </section>
                </div>

                <div class="col-md-4 " style="padding: 0px;">
                  <section class="secciones-enlaces  text-white " id="menu-desktop">
                    <h6>NOTICIAS</h6>
                    <hr>
                    <a href="../dashboard/crear_noticia.php">Crear noticia</a>
                    <hr>
                    <a href="./noticias.php">Ver noticias </a>
                    <hr>
                    <a href="../dashboard/administrar_noticias.php">Administrar</a>

                  </section>
                </div>
              </div>
            </div>
          </li>
        </div>
        <div class="navbar-nav__second">
          <a href="./acceder.php" target="_blank"><i class="fas fa-lock"></i> Administrar página web</a>
        </div>
      </ul>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-lg navbar-light bg-light menu-secundary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><img src="../img/LOGO.png" alt="" width="100"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav" id="menu-mobile">
        <li class="nav-item">
          <a class="nav-link" href="./index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./ninstitucion.php">Nuestra institución</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="nivelesDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            NIVELES
          </a>
          <ul class="dropdown-menu" aria-labelledby="nivelesDropdown">
            <li><a class="dropdown-item inicial">Inicial</a></li>
            <li><a class="dropdown-item primaria">Primaria</a></li>
            <li><a class="dropdown-item secundaria">Secundaria</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contacto.php">Contacto</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="paginasDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Paginas
          </a>
          <ul class="dropdown-menu" aria-labelledby="paginasDropdown">
            <li><a class="dropdown-item" href="./personal.php">Personal Docente</a></li>
            <li><a class="dropdown-item" href="./galeria.php">Galeria</a></li>
            <li><a class="dropdown-item" href="./noticias.php">Eventos y Noticias</a></li>
            <li><a class="dropdown-item" href="./reglamentacion.php">Reglamentacion</a></li>
            <li><a class="dropdown-item" href="./calendario.php">Calendario Escolar</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./noticias.php">Ver noticias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../dashboard/crear_noticia.php">Crear noticias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../dashboard/administrar_noticias.php">Administrar noticias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./acceder.php" target="_blank">Administrar página web</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
  // Función para obtener el valor de una cookie
  function getCookie(cookieName) {
    const name = cookieName + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');

    for (let i = 0; i < cookieArray.length; i++) {
      let cookie = cookieArray[i].trim();
      if (cookie.indexOf(name) == 0) {
        return cookie.substring(name.length, cookie.length);
      }
    }
    return null;
  }

  // Función para eliminar una cookie
  function deleteCookie(cookieName) {
    document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  }

  // Función para actualizar los menús según el estado de la sesión
  function updateSessionOptions() {
    const id = getCookie("id");
    // Buscar los enlaces de admin (incluye ambos destinos posibles)
    const adminLinks = document.querySelectorAll("a[href='./acceder.php'], a[href='./dashboard/index.php']");

    if (id !== null) {
      // Usuario logueado → dirigir a dashboard/index.php
      adminLinks.forEach(link => {
        link.textContent = "Administrar página web";
        link.href = "./dashboard/index.php";
        link.classList.remove("close__session");
      });
    } else {
      // Usuario no logueado → dirigir a acceder.php
      adminLinks.forEach(link => {
        link.textContent = "Administrar página web";
        link.href = "./acceder.php";
        link.classList.remove("close__session");
      });
    }
  }

  // Función para proteger rutas
  function protectedRoutes() {
    const rutaActual = window.location.pathname;
    const rutasRedireccionar = ["administrar_noticias.php", "crear_noticia.php"];
    const route = "./acceder.php";

    const redirigir = rutasRedireccionar.some((palabraClave) => {
      return rutaActual.includes(palabraClave);
    });

    if (redirigir && getCookie("id") == null) {
      window.location.href = route;
    }
  }

  // Manejador de eventos para cerrar sesión
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("close__session")) {
      e.preventDefault();
      deleteCookie("id");
      updateSessionOptions(); // Actualizar el menú después de cerrar sesión
      window.location.href = "./index.php"; // Redirigir a la página principal
    }
  });

  // Actualizar las opciones del menú al cargar la página
  document.addEventListener("DOMContentLoaded", () => {
    updateSessionOptions();
    protectedRoutes();

    // Ajustar dinámicamente el top de la segunda navbar y eliminar la línea blanca
    const firstNavbar = document.querySelector('.menu-superior');
    const secondNavbar = document.querySelector('.second-navbar');
    if (firstNavbar && secondNavbar) {
      const firstHeight = firstNavbar.offsetHeight;
      secondNavbar.style.top = firstHeight + 'px';
      secondNavbar.style.marginTop = '0';
      firstNavbar.style.marginBottom = '0';
    }
  });

  // Código para el mega menú
  const megaMenuDropdown = document.getElementById("megaMenuDropdown");
  const megaMenuDropdownActive = document.getElementById("megaMenuDropdownActive");
  megaMenuDropdownActive.classList.remove("show");
  megaMenuDropdown.addEventListener("click", (e) => {
    e.preventDefault();
    megaMenuDropdownActive.classList.toggle("show");
  });
</script>
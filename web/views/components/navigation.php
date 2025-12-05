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
          .mega-menu {
            min-width: 500px;
            /* Ancho mínimo para evitar compresión excesiva */
            width: auto;
            /* Permite que se ajuste al contenido, pero con min-width */
            padding: 12px 0;
            /* Padding vertical para espacio adicional */
            background-color: #1e3a8a;
            /* Fondo consistente */
            position: absolute;
            /* Garantiza posicionamiento absoluto */
            left: 50%;
            /* Centra horizontalmente desde el borde izquierdo */
            transform: translateX(50%);
            /* Corrige la posición al centro del botón */
          }

          .secciones-enlaces {
            padding: 10px;
            /* Aumentado padding para más espacio interno */
          }

          .secciones-enlaces h6 {
            margin-bottom: 15px;
            /* Más espacio debajo del título */
            font-size: 1rem;
            /* Fuente más grande para mejor legibilidad */
          }

          .secciones-enlaces a {
            display: block;
            margin-bottom: 15px;
            /* Más espacio entre enlaces */
            text-decoration: none;
            color: white;
            font-size: 0.9rem;
            /* Tamaño de fuente base */
          }

          .secciones-enlaces hr {
            margin: 10px 0;
            /* Más espacio vertical entre líneas */
            border: 0;
            height: 1px;
            /* Línea más gruesa */
            background-color: #ddd;
            /* Color más claro para contraste */
          }

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

          /* Media Queries para responsividad */
          @media (max-width: 991px) {
            .mega-menu {
              min-width: 300px;
              /* Reduce el ancho mínimo en pantallas pequeñas */
              left: 0;
              /* Ajusta al borde izquierdo en pantallas pequeñas */
              transform: none;
              /* Desactiva el centrado en pantallas pequeñas */
              width: 100%;
              /* Ocupa todo el ancho disponible */
            }
          }

          /* Asegura que el dropdown no dependa de hover */
          .dropdown-menu {
            display: none;
            /* Oculto por defecto */
          }

          .dropdown-menu.show {
            display: block;
            /* Muestra cuando Bootstrap agrega .show con tap */
          }

          /* Desactiva hover en móviles (usa media query para touch) */
          @media (hover: none) {

            /* Para dispositivos touch */
            .dropdown:hover .dropdown-menu {
              display: none;
              /* Evita que hover accidental muestre el menú */
            }
          }

          /* Corrige animación: Usa transición suave en .show, sin hover */
          .dropdown-menu {
            opacity: 0;
            transition: opacity 0.3s ease;
          }

          .dropdown-menu.show {
            opacity: 1;
          }

          /* Para las clases personalizadas: Elimina animaciones dependientes de hover */
          .inicial,
          .primaria,
          .secundaria {
            opacity: 1 !important;
            /* Fuerza visibilidad siempre */
            transition: none;
            /* Desactiva animaciones que rompan */
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
          <li class="nav-item dropdown" id="explorador-item"> <!-- Añadido ID para referencia -->
            <a class="en mega-menu-link" href="#" id="megaMenuDropdown">
              Explorador
            </a>
            <div class="dropdown-menu mega-menu" id="megaMenuDropdownActive">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <section class="secciones-enlaces text-white">
                      <h6>COMUNICATE</h6>
                      <hr>
                      <a href="../views/noticias.php">Noticias</a>
                      <hr>
                      <a href="../views/calendario.php">Calendario Escolar</a>
                      <hr>
                      <a href="../views/admision.php">Niveles</a>
                      <hr>
                    </section>
                  </div>
                  <div class="col-md-6">
                    <section class="secciones-enlaces text-white">
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
                </div>
              </div>
            </div>
          </li>
        </div>
        <div class="navbar-nav__second">
          <a href="./acceder.php" target="_blank"><i class="fas fa-lock"></i> Administrar Noticias</a>
          <a href="../../sistema/" target="_blank"><i class="fas fa-school"></i>
            Sistema Orion</a>

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
            <li><a class="dropdown-item" href="#">Inicial</a></li> <!-- Agrega href válido o maneja con JS -->
            <li><a class="dropdown-item" href="#">Primaria</a></li>
            <li><a class="dropdown-item" href="#">Secundaria</a></li>
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
            <li><a class="dropdown-item" href="./noticias.php">Noticias</a></li>
            <li><a class="dropdown-item" href="./reglamentacion.php">Reglamentacion</a></li>
            <li><a class="dropdown-item" href="./calendario.php">Calendario Escolar</a></li>
          </ul>
        </li>
        <!-- Enlaces de noticias eliminados -->
        <li class="nav-item">
          <a class="nav-link" href="./acceder.php" target="_blank">Administrar Noticias</a>
          <a class="nav-link" href="../../sistema/" target="_blank"><i class="fas fa-school"></i> Sistema Orion</a>
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
    const adminLinks = document.querySelectorAll("a[href='./acceder.php'], a[href='./dashboard.php']");

    if (id !== null) {
      // Usuario logueado → dirigir a dashboard/index.php
      adminLinks.forEach(link => {
        link.textContent = "Administrar Noticias";
        link.href = "./dashboard.php";
        link.classList.remove("close__session");
      });
    } else {
      // Usuario no logueado → dirigir a acceder.php
      adminLinks.forEach(link => {
        link.textContent = "Administrar Noticias";
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

  document.addEventListener("DOMContentLoaded", () => {
    // Asegurarse de que no haya clase show inicial
    megaMenuDropdownActive.classList.remove("show");

    // Manejar el clic para abrir/cerrar el mega menú
    megaMenuDropdown.addEventListener("click", (e) => {
      e.preventDefault();
      megaMenuDropdownActive.classList.toggle("show");
    });

    // Cerrar el mega menú si se hace clic fuera
    document.addEventListener("click", (e) => {
      if (!megaMenuDropdown.contains(e.target) && !megaMenuDropdownActive.contains(e.target)) {
        megaMenuDropdownActive.classList.remove("show");
      }
    });
  });
</script>
// sidebar.js - Lógica extraída de dashboard.php para reutilización
document.addEventListener("DOMContentLoaded", function () {
  // Elementos DOM
  const toggleButton = document.getElementById('toggle-sidebar');
  const externalToggle = document.getElementById('external-toggle');
  const sidebar = document.querySelector('.admin-sidebar');
  const content = document.getElementById('content');

  // Actualizar icono del botón basado en el estado de la sidebar
  function updateToggleIcon() {
    const icon = sidebar.classList.contains('visible') ? 'fa-times' : 'fa-bars';
    if (toggleButton) toggleButton.innerHTML = `<i class="fas ${icon}"></i>`;
    if (externalToggle) externalToggle.innerHTML = `<i class="fas ${icon}"></i>`;
  }

  // Inicializar estado de la sidebar basado en el tamaño de pantalla
  function initializeSidebar() {
    if (window.innerWidth <= 768) {
      sidebar.classList.add('hidden');
      sidebar.classList.remove('visible');
      if (content) content.classList.add('full-width');
      if (externalToggle) externalToggle.style.display = 'block';
    } else {
      sidebar.classList.remove('hidden');
      sidebar.classList.add('visible');
      if (content) content.classList.remove('full-width');
      if (externalToggle) externalToggle.style.display = 'none';
    }
    updateToggleIcon();
  }

  // Toggle de sidebar
  function toggleSidebar() {
    sidebar.classList.toggle('hidden');
    sidebar.classList.toggle('visible');
    if (content) content.classList.toggle('full-width');
    if (externalToggle) externalToggle.style.display = sidebar.classList.contains('visible') ? 'none' : 'block';
    updateToggleIcon();
  }

  // Eventos
  if (toggleButton) toggleButton.addEventListener('click', toggleSidebar);
  if (externalToggle) externalToggle.addEventListener('click', toggleSidebar);

  // Cerrar sidebar en móvil al clickear un enlace
  document.querySelectorAll('.admin-sidebar a').forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 768) {
        sidebar.classList.add('hidden');
        sidebar.classList.remove('visible');
        if (content) content.classList.add('full-width');
        if (externalToggle) externalToggle.style.display = 'block';
        updateToggleIcon();
      }
    });
  });

  // Ajustar en resize de ventana
  window.addEventListener('resize', initializeSidebar);

  // Inicializar
  initializeSidebar();

  // Funciones de cookies y cierre de sesión (globales)
  window.getCookie = function (cookieName) {
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
  };

  window.deleteCookie = function (cookieName) {
    document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
  };

  window.protectedRoutes = function () {
    const rutaActual = window.location.pathname;
    const rutasRedireccionar = ["dashboard.php", "administrar_noticias.php", "crear_noticia.php"];
    const route = "./acceder.php";
    if (rutasRedireccionar.some(palabraClave => rutaActual.includes(palabraClave)) && window.getCookie("id") == null) {
      window.location.href = route;
    }
  };

  // Cierre de sesión
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("close__session")) {
      e.preventDefault();
      window.deleteCookie("id");
      window.location.href = "./index.php";
    }
  });

  // Ejecutar protectedRoutes al cargar
  protectedRoutes();
});
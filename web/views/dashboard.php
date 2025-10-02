<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Dashboard</title>
  <style>
    body {
      margin: 0;
      font-family: var(--font-primary, 'Poppins', sans-serif);
      background-color: #f4f4f9;
    }
    .dashboard-container {
      display: flex;
      min-height: 100vh;
      position: relative;
    }
    .admin-sidebar {
      width: 250px;
      background-color: #06426a;
      color: white;
      padding: 20px;
      min-height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      transform: translateX(0);
      transition: transform 0.3s ease, width 0.5s ease;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }
    .admin-sidebar.hidden {
      transform: translateX(-100%);
    }
    .admin-sidebar img {
      width: 150px;
      margin-bottom: 20px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .admin-sidebar ul {
      list-style: none;
      padding: 0;
      flex-grow: 1;
    }
    .admin-sidebar li {
      margin-bottom: 10px;
    }
    .admin-sidebar a {
      color: white;
      text-decoration: none;
      font: normal normal 700 0.9rem/1.5rem var(--font-primary);
      display: flex;
      align-items: center;
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    .admin-sidebar a i {
      margin-right: 10px;
    }
    .admin-sidebar a:hover {
      background-color: #083b5e;
    }
    .toggle-sidebar {
      background-color: #083b5e;
      color: white;
      border: none;
      padding: 8px 12px;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 5px;
      margin-top: auto;
      margin-left: auto;
      margin-right: 10px;
      transition: background-color 0.3s, border-radius 0.5s;
    }
    .toggle-sidebar:hover {
      background-color: #0c7bc6; /* Brighter blue from navigation.php */
      border-radius: 8px;
    }
    .external-toggle {
      background-color: #06426a;
      color: white;
      border: none;
      padding: 8px 12px;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 5px;
      position: fixed;
      top: 10px;
      left: 10px;
      z-index: 1100;
      display: none;
      transition: background-color 0.3s, border-radius 0.5s;
    }
    .external-toggle:hover {
      background-color: #0c7bc6;
      border-radius: 8px;
    }
    .content {
      margin-left: 250px;
      padding: 20px;
      flex-grow: 1;
      transition: margin-left 0.3s ease;
    }
    .content.full-width {
      margin-left: 0;
    }
    .news-section, .calendar-section {
      margin-bottom: 40px;
    }
    .news-section h2, .calendar-section h2 {
      font-family: 'EB Garamond', serif;
      color: #06426a;
    }
    .news-card {
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      padding: 15px;
      margin-bottom: 20px;
    }
    .calendar-placeholder {
      background-color: white;
      border-radius: 10px;
      padding: 20px;
      text-align: center;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    /* Media queries for responsiveness */
    @media (max-width: 1400px) {
      .admin-sidebar {
        width: 240px;
      }
      .content {
        margin-left: 240px;
      }
    }
    @media (max-width: 1200px) {
      .admin-sidebar {
        width: 220px;
      }
      .content {
        margin-left: 220px;
      }
    }
    @media (max-width: 992px) {
      .admin-sidebar {
        width: 200px;
      }
      .content {
        margin-left: 200px;
      }
    }
    @media (max-width: 768px) {
      .admin-sidebar {
        width: 250px;
        transform: translateX(-100%);
      }
      .admin-sidebar.visible {
        transform: translateX(0);
      }
      .content {
        margin-left: 0;
      }
      .external-toggle {
        display: block;
      }
    }
    @media (max-width: 500px) {
      .admin-sidebar {
        width: 100%;
      }
      .news-card {
        padding: 10px;
      }
    }
  </style>
</head>
<body>
  <div class="dashboard-container">
    <button class="external-toggle" id="external-toggle"><i class="fas fa-bars"></i></button>
    <?php include './components/sidebar.php'; ?>
    <div class="content" id="content">
      <section class="news-section">
        <h2>Últimas Noticias</h2>
        <div class="news-card">
          <h5>Noticia de Ejemplo 1</h5>
          <p>Este es un ejemplo de una noticia. Aquí se mostrarán las noticias creadas desde administrar_noticias.php.</p>
          <small>Publicado: 01/10/2025</small>
        </div>
        <div class="news-card">
          <h5>Noticia de Ejemplo 2</h5>
          <p>Otro ejemplo de noticia para el dashboard.</p>
          <small>Publicado: 30/09/2025</small>
        </div>
      </section>
      <section class="calendar-section">
        <h2>Calendario Escolar</h2>
        <div class="calendar-placeholder">
          <p>Espacio reservado para el calendario escolar. Integrar con un widget o API de calendario (ej. FullCalendar).</p>
        </div>
      </section>
    </div>
  </div>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../lib/WOW/WOW.min.js"></script>
  <script>
    // Toggle sidebar logic
    const toggleButton = document.getElementById('toggle-sidebar');
    const externalToggle = document.getElementById('external-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    const content = document.getElementById('content');

    // Update button icon based on sidebar state
    function updateToggleIcon() {
      const icon = sidebar.classList.contains('visible') ? 'fa-times' : 'fa-bars';
      toggleButton.innerHTML = `<i class="fas ${icon}"></i>`;
      externalToggle.innerHTML = `<i class="fas ${icon}"></i>`;
    }

    // Initialize sidebar state based on screen size
    if (window.innerWidth <= 768) {
      sidebar.classList.add('hidden');
      sidebar.classList.remove('visible');
      content.classList.add('full-width');
      externalToggle.style.display = 'block';
    } else {
      sidebar.classList.remove('hidden');
      sidebar.classList.add('visible');
      content.classList.remove('full-width');
      externalToggle.style.display = 'none';
    }
    updateToggleIcon();

    // Toggle sidebar on button click
    [toggleButton, externalToggle].forEach(button => {
      button.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        sidebar.classList.toggle('visible');
        content.classList.toggle('full-width');
        externalToggle.style.display = sidebar.classList.contains('visible') ? 'none' : 'block';
        updateToggleIcon();
      });
    });

    // Close sidebar on mobile when clicking a link
    document.querySelectorAll('.admin-sidebar a').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
          sidebar.classList.add('hidden');
          sidebar.classList.remove('visible');
          content.classList.add('full-width');
          externalToggle.style.display = 'block';
          updateToggleIcon();
        }
      });
    });

    // Adjust sidebar on window resize
    window.addEventListener('resize', () => {
      if (window.innerWidth <= 768) {
        sidebar.classList.add('hidden');
        sidebar.classList.remove('visible');
        content.classList.add('full-width');
        externalToggle.style.display = 'block';
      } else {
        sidebar.classList.remove('hidden');
        sidebar.classList.add('visible');
        content.classList.remove('full-width');
        externalToggle.style.display = 'none';
      }
      updateToggleIcon();
    });

    // Session management from navigation.php
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

    function deleteCookie(cookieName) {
      document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    }

    function protectedRoutes() {
      const rutaActual = window.location.pathname;
      const rutasRedireccionar = ["dashboard.php", "administrar_noticias.php", "crear_noticia.php"];
      const route = "./acceder.php";
      if (rutasRedireccionar.some(palabraClave => rutaActual.includes(palabraClave)) && getCookie("id") == null) {
        window.location.href = route;
      }
    }

    document.addEventListener("DOMContentLoaded", () => {
      protectedRoutes();
    });

    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("close__session")) {
        e.preventDefault();
        deleteCookie("id");
        window.location.href = "./index.php";
      }
    });
  </script>
</body>
</html>
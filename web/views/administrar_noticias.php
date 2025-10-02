<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Orion - Administrar Noticias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./../css/style.css">
  <link rel="stylesheet" href="./../css/query.css">
  <link rel="stylesheet" href="./../css/noticias.css">
  <link rel="stylesheet" href="./../css/globals.css">
  <link rel="stylesheet" href="./../css/administrar_noticias.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.bubble.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="./../js/animaciones.js"></script>
  <link rel="shortcut icon" href="./../img/LOGO.png" type="image/x-icon">
  <style>
    body { margin: 0; font-family: Arial, sans-serif; }
    .dashboard { display: flex; min-height: 100vh; }
    .sidebar {
      width: 220px; background: #343a40; color: white; padding: 20px 10px;
    }
    .sidebar h2 { font-size: 18px; margin-bottom: 20px; text-align: center; }
    .sidebar a {
      display: block; padding: 10px; margin: 5px 0;
      color: white; text-decoration: none; border-radius: 5px;
    }
    .sidebar a:hover { background: #495057; }
    .content { flex-grow: 1; background: #f8f9fa; padding: 20px; }
    .header {
      background: #fff; padding: 15px; margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    @media (max-width: 768px) {
      .dashboard { flex-direction: column; }
      .sidebar { width: 100%; }
      .content { padding: 10px; }
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <!-- Incluir el componente del menú -->

    <!-- Content -->
    <div class="content">
      <div class="header">
        <h3>Administrar Noticias</h3>
        <p>Edita, elimina o visualiza las noticias de la comunidad educativa.</p>
      </div>

      <div class="container">
        <section class="section">
          <h3>Edita, elimina o mira noticias</h3>
          <p class="section__text" style="text-align:justify;">
            Descubre un mundo de noticias, eventos y blogs. Mantente informado, participa y comparte experiencias. 
            Únete a nuestra comunidad educativa y sé parte de cada historia que construimos juntos. 
            ¡Bienvenido a un espacio lleno de aprendizaje y logros!
          </p>
          <div class="loader__box" id="loader">
            <?php require "./components/loader.php"; ?>
            <h4>Cargando...</h4>
          </div>
          <div id="noticias"></div>
        </section>
      </div>
    </div>
  </div>

  <?php require_once './components/modal_delete.php'; ?>
  <?php require_once './components/modal_update.php'; ?>

  <script>
    const $noticias = document.getElementById("noticias");
    const $loader = document.getElementById("loader");

    async function obtenerNoticias() {
      const myForm = new FormData();
      myForm.append("modulo_noticia", "obtener-privado");
      const URL = "./../ajax/noticia_ajax.php";
      $noticias.style.display = "none";
      $loader.style.display = "grid";

      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        });
        if (!res.ok) {
          throw new Error(`HTTP error! Status: ${res.status}`);
        }
        const json = await res.json();
        console.log("Respuesta de noticia_ajax.php:", json); // Depuración
        if (!Array.isArray(json) || json.length === 0) {
          paintNoData();
        } else {
          paintData(json);
        }
      } catch (err) {
        console.error("Error en obtenerNoticias:", err); // Depuración
        $noticias.innerHTML = `
          <div class="notfound__notices">
            <i class="fas fa-exclamation-circle"></i>
            <p>Error al cargar las noticias: ${err.message}</p>
          </div>`;
      } finally {
        $noticias.style.display = "grid";
        $loader.style.display = "none";
      }
    }

    function paintNoData() {
      $noticias.innerHTML = `
        <div class="notfound__notices">
          <img src="../img/not_found_notices.svg" alt="No noticias"/>
          <p>Lamentablemente, no pudimos encontrar ninguna noticia o evento</p>
        </div>`;
    }

    function formatearFecha(fechaHora) {
      const fecha = new Date(fechaHora);
      if (isNaN(fecha)) {
        return "Fecha inválida";
      }
      const dia = fecha.getDate().toString().padStart(2, '0');
      const mes = (fecha.getMonth() + 1).toString().padStart(2, '0');
      const anio = fecha.getFullYear();
      return `${dia}/${mes}/${anio}`;
    }

    function paintData(data) {
      $noticias.innerHTML = ''; // Limpiar contenido previo
      data.forEach((item) => {
        if (!item.id || !item.titulo || !item.usuario || !item.fechaCreacion) {
          console.warn("Datos incompletos para noticia:", item); // Depuración
          return;
        }
        $noticias.innerHTML += `
          <div class="noticia">
            <span>Creado por <b>${item.usuario}</b></span>
            <div class="noticia__info">
              <h3>${item.titulo}</h3>
              <img src="../img/${item.imagen || 'default.jpg'}" alt="avatar">
            </div>
            <div class="noticia__info noticia__info__external">
              <div class="noticia__info noticia__info__calendar">
                <i class="far fa-calendar"></i>
                <p>${formatearFecha(item.fechaCreacion)}</p>
              </div>
              <div class="noticia__actions">
                <button class="openModalUpdate" data-id="${item.id}"><i class="fas fa-pencil-alt"></i> Editar</button>
                <button class="openModalDelete" data-id="${item.id}"><i class="fas fa-trash-alt"></i> Eliminar</button>
              </div>
            </div>
          </div>`;
      });
    }

    obtenerNoticias();
  </script>
  <script src="./../js/bootstrap.min.js"></script>
  <script src="./../js/main.js"></script>
</body>
</html>
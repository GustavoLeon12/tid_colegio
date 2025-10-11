<?php
// administrar_noticias.php - Corregido para cargar noticias y manejar modal personalizado
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Orion - Administrar Noticias</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/animaciones.css">
  <link rel="stylesheet" href="../css/sidebar.css">
  <link rel="stylesheet" href="../css/administrar_noticias.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.bubble.css">
  <link rel="stylesheet" href="https://cdn.quilljs.com/1.3.6/quill.snow.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.7.1/katex.min.js"></script>
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
</head>

<body>
  <?php
  require_once './components/modal_delete.php';
  require_once './components/modal_update.php';
  ?>
  <div class="dashboard-container">
    <button class="external-toggle" id="external-toggle"><i class="fas fa-bars"></i></button>
    <?php require_once './components/sidebar.php'; ?>
    <div class="content" id="content">
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
  <script>
    const $noticias = document.getElementById("noticias");
    const $loader = document.getElementById("loader");
    const $modalUpdate = document.getElementById("modal-update");
    const $contentUpdate = document.getElementById("content-principal-update");
    const $loaderUpdate = document.getElementById("state-update");
    const $loaderUpdateII = document.getElementById("loader-update-text");
    const $buttonUpdate = document.getElementById("button-update");
    const $checkedInput = document.getElementById("flexCheckChecked");
    const $titleUpdate = document.getElementById("title-update");
    const $imageCurrent = document.getElementById("image-update");
    const $contentUpdateEditor = document.getElementById("editor-container");
    const $faceUpdate = document.getElementById("input-file-update");
    const $closeUpdate = document.getElementById("close-update");
    const $categorias = document.getElementById("categorias");
    const $errorUpdate = document.getElementById("error-update");
    let contentNoticeUpdate = "";
    let idCategoria = 0;
    let selectCategoria = 0;

    // Inicializar Quill
    const toolbarOptions = [
      [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
      ['bold', 'italic', 'underline'],
      ['blockquote', 'code-block'],
      [{ 'list': 'ordered' }, { 'list': 'bullet' }],
      [{ 'color': [] }, { 'background': [] }],
      [{ 'align': [] }],
    ];
    const quill = new Quill('#editor-container', {
      modules: { toolbar: toolbarOptions },
      readOnly: false,
      placeholder: 'Escribe una noticia...',
      theme: 'snow'
    });

    // Obtener cookie
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

    async function obtenerNoticias() {
      const myForm = new FormData();
      myForm.append("modulo_noticia", "obtener-privado");
      const URL = "../ajax/noticia_ajax.php";
      $noticias.style.display = "none";
      $loader.style.display = "grid";

      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        });
        if (!res.ok) {
          throw new Error(`Error HTTP: ${res.status}`);
        }
        const json = await res.json();
        console.log("Respuesta de noticia_ajax.php:", json);
        if (json === false || !Array.isArray(json) || json.length === 0) {
          paintNoData();
        } else {
          paintData(json);
        }
      } catch (err) {
        console.error("Error en obtenerNoticias:", err);
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
          <img src="../img/not_found_notices.svg" alt="No hay noticias disponibles"/>
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
      $noticias.innerHTML = '';
      data.forEach((item) => {
        if (!item.id || !item.titulo || !item.usuario || !item.fechaCreacion) {
          console.warn("Datos incompletos para noticia:", item);
          return;
        }
        const imagen = item.portada ? `<?= $GLOBALS['images_user'] ?? '../img/' ?>${item.portada}` : '../img/default.jpg';
        $noticias.innerHTML += `
          <div class="noticia">
            <span>Creado por <b>${item.usuario}</b></span>
            <div class="noticia__info">
              <h3>${item.titulo}</h3>
              <img src="${imagen}" alt="Imagen de ${item.titulo}">
            </div>
            <div class="noticia__info noticia__info__external">
              <div class="noticia__info__calendar">
                <i class="far fa-calendar"></i>
                <p>${formatearFecha(item.fechaCreacion)}</p>
              </div>
              <div class="noticia__actions">
                <button class="openModalUpdate" data-id="${item.id}" aria-label="Editar noticia ${item.titulo}"><i class="fas fa-pencil-alt"></i> Editar</button>
                <button class="openModalDelete" data-id="${item.id}" aria-label="Eliminar noticia ${item.titulo}"><i class="fas fa-trash-alt"></i> Eliminar</button>
              </div>
            </div>
          </div>`;
      });
    }

    async function obtenerNoticia(id) {
      $contentUpdate.style.display = "none";
      $loaderUpdateII.style.display = "block";
      const URL = `../ajax/noticia_ajax.php?id=${id}`;
      try {
        const res = await fetch(URL);
        if (!res.ok) {
          throw new Error(`Error HTTP: ${res.status}`);
        }
        const json = await res.json();
        console.log("Datos de la noticia:", json);
        if (json === false) {
          throw new Error("No se encontró ninguna noticia");
        }
        paintNotice(json);
      } catch (error) {
        $contentUpdate.innerHTML = `
          <div class="box__error">
            <i class="fas fa-exclamation-circle"></i>
            <h4>Opps! Sucedió un error</h4>
            <p>${error}</p>
          </div>`;
      } finally {
        $contentUpdate.style.display = "block";
        $loaderUpdateII.style.display = "none";
      }
    }

    function paintNotice(data) {
      const editor = document.querySelector(".ql-editor");
      editor.innerHTML = data.descripcion || "";
      $titleUpdate.value = data.titulo || "";
      $imageCurrent.src = `<?= $GLOBALS['images'] ?? '../img/' ?>${data.portada || 'default.jpg'}`;
      selectCategoria = data.categoria || "";
      idCategoria = data.fkCategoria || "";
      $categorias.value = data.fkCategoria || "";
      $checkedInput.checked = data.importante === "1";
    }

    async function obtenerCategorias() {
      const URL = "../ajax/categoria_ajax.php?categoriasPrivado";
      try {
        const res = await fetch(URL);
        if (!res.ok) {
          throw new Error(`Error HTTP: ${res.status}`);
        }
        const json = await res.json();
        console.log("Categorías:", json);
        $categorias.innerHTML = "";
        paintCategories(json, idCategoria);
      } catch (error) {
        $categorias.innerHTML = `<option disabled>Error: ${error}</option>`;
        console.error("Error al obtener categorías:", error);
      }
    }

    function paintCategories(data, id) {
      let selected = "";
      data.forEach((item) => {
        selected = item.id == id ? "selected" : "";
        $categorias.innerHTML += `<option value="${item.id}" ${selected}>${item.nombre}</option>`;
      });
    }

    async function updateNotice() {
      const myForm = new FormData($contentUpdate);
      const id = localStorage.getItem("NOTICE-ID");
      if (!id) {
        $errorUpdate.textContent = "ID de noticia no válido.";
        return;
      }
      contentNoticeUpdate = quill.root.innerHTML;
      myForm.append("modulo_noticia", "actualizar");
      myForm.append("title", $titleUpdate.value);
      myForm.append("contentNotice", contentNoticeUpdate);
      myForm.append("category", selectCategoria);
      myForm.append("id", id);
      myForm.append("autor", getCookie("id") || "0"); // Fallback si no hay cookie

      // Manejar la imagen
      const fileInput = document.getElementById("input-file-update");
      if (fileInput.files[0]) {
        myForm.append("image", fileInput.files[0]); // Enviar archivo si se seleccionó
      } else {
        myForm.append("keep_image", "true"); // Indicar mantener la imagen actual
      }

      const URL = "../ajax/noticia_ajax.php";
      $contentUpdate.style.display = "none";
      $loaderUpdate.style.display = "grid";
      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        });
        // Depurar la respuesta cruda
        const text = await res.text();
        console.log("Respuesta cruda del servidor:", text);
        if (!res.ok) {
          throw new Error(`Error HTTP: ${res.status} - ${text}`);
        }
        // Intentar parsear como JSON
        let json;
        try {
          json = JSON.parse(text);
        } catch (e) {
          throw new Error(`Respuesta no es JSON válido: ${text}`);
        }
        console.log("Respuesta parseada:", json);
        if (json.status === 200) {
          $modalUpdate.classList.remove("active-modal-update");
          localStorage.removeItem("NOTICE-ID");
          window.location.reload(); // Recarga la página
        } else {
          $errorUpdate.textContent = json.message || "Error al actualizar la noticia";
        }
      } catch (error) {
        $errorUpdate.textContent = "Error: " + error.message;
        console.error("Error al actualizar noticia:", error);
      } finally {
        $contentUpdate.style.display = "grid";
        $loaderUpdate.style.display = "none";
      }
    }

    function validator() {
      const titleValue = $titleUpdate.value;
      const contentLength = quill.getLength();
      if (titleValue.trim().length === 0) {
        $errorUpdate.textContent = "El campo título no debe de estar vacío.";
        return false;
      } else if (contentLength < 100) {
        $errorUpdate.textContent = "La noticia debe de tener más contenido.";
        return false;
      }
      return true;
    }

    // Manejo de eventos
    document.addEventListener("click", async (e) => {
      const button = e.target.closest(".openModalUpdate, .openModalDelete, .custom__modal__close");
      if (button) {
        if (button.classList.contains("openModalUpdate")) {
          const id = button.dataset.id;
          if (id) {
            localStorage.setItem("NOTICE-ID", id);
            $modalUpdate.classList.add("active-modal-update");
            await obtenerNoticia(id);
            await obtenerCategorias();
          }
        } else if (button.classList.contains("openModalDelete")) {
          const id = button.dataset.id;
          const modal = document.querySelector("#modalDelete");
          if (modal) {
            const idInput = modal.querySelector('[name="noticia_id"]');
            if (idInput) idInput.value = id;
            $('#modalDelete').modal('show');
          } else {
            console.error("Modal #modalDelete no encontrado");
          }
        } else if (button.classList.contains("custom__modal__close")) {
          $modalUpdate.classList.remove("active-modal-update");
          localStorage.removeItem("NOTICE-ID"); // Limpia el ID almacenado
        }
      }
    });

    $categorias.addEventListener("change", (e) => {
      selectCategoria = $categorias.value;
    });

    $buttonUpdate.addEventListener("click", async (e) => {
      e.preventDefault();
      if (validator()) {
        await updateNotice();
      }
    });

    $faceUpdate.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          $imageCurrent.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    obtenerNoticias();
  </script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/animaciones.js"></script>
  <script src="../js/sidebar.js"></script>
</body>

</html>
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
      <div class="reportes-section mt-4">
        <h4>Generar Reportes</h4>
        <div class="reportes-buttons">
          <button class="btn btn-danger" id="generarPdf">
            <i class="fas fa-file-pdf"></i> Descargar PDF
          </button>
          <button class="btn btn-success" id="generarExcel">
            <i class="fas fa-file-excel"></i> Descargar Excel
          </button>
        </div>
        <div class="filtros-pdf mt-3">
          <div class="row">
            <div class="col-md-4">
              <label for="filtro-categoria-pdf" class="form-label"><strong>Filtrar por categoría:</strong></label>
              <select class="form-select" id="filtro-categoria-pdf">
                <option value="todas">Todas las categorías</option>
                <!-- Las categorías se cargarán dinámicamente -->
              </select>
            </div>
            <div class="col-md-4">
              <label for="filtro-estado" class="form-label"><strong>Filtrar por estado:</strong></label>
              <select class="form-select" id="filtro-estado">
                <option value="todas">Todas las noticias</option>
                <option value="importantes">Solo importantes</option>
                <option value="normales">Solo normales</option>
              </select>
            </div>
            <div class="col-md-4">
              <label for="filtro-fecha" class="form-label"><strong>Ordenar por fecha:</strong></label>
              <select class="form-select" id="filtro-fecha">
                <option value="recientes">Más recientes primero</option>
                <option value="antiguas">Más antiguas primero</option>
              </select>
            </div>
          </div>
          <div class="mt-3">
            <button class="btn btn-outline-primary btn-sm" id="aplicarFiltros">
              <i class="fas fa-filter"></i> Aplicar Filtros
            </button>
            <button class="btn btn-outline-secondary btn-sm" id="limpiarFiltros">
              <i class="fas fa-broom"></i> Limpiar Filtros
            </button>
          </div>
          <div class="mt-2">
            <small class="text-muted" id="contador-noticias">Mostrando 0 noticias</small>
          </div>
        </div>
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

    // Variables globales para filtros
    let noticiasOriginales = [];
    let noticiasFiltradas = [];
    let filtrosActivos = {
      categoria: 'todas',
      estado: 'todas',
      fecha: 'recientes'
    };

    // Inicializar Quill
    const toolbarOptions = [
      [{
        'header': [1, 2, 3, 4, 5, 6, false]
      }],
      ['bold', 'italic', 'underline'],
      ['blockquote', 'code-block'],
      [{
        'list': 'ordered'
      }, {
        'list': 'bullet'
      }],
      [{
        'color': []
      }, {
        'background': []
      }],
      [{
        'align': []
      }],
    ];
    const quill = new Quill('#editor-container', {
      modules: {
        toolbar: toolbarOptions
      },
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

    // ========== FUNCIONALIDAD DE FILTROS Y REPORTES ==========

    // Función para cargar categorías en los filtros
    async function cargarCategoriasFiltros() {
      const $filtroCategoria = document.getElementById("filtro-categoria-pdf");
      const URL = "../ajax/noticia_ajax.php?modulo=categorias-con-conteo";

      try {
        const res = await fetch(URL);
        if (!res.ok) throw new Error(`Error HTTP: ${res.status}`);
        const categorias = await res.json();

        $filtroCategoria.innerHTML = '<option value="todas">Todas las categorías</option>';
        categorias.forEach(categoria => {
          $filtroCategoria.innerHTML +=
            `<option value="${categoria.id}">${categoria.nombre} (${categoria.total_noticias})</option>`;
        });
      } catch (error) {
        console.error("Error al cargar categorías para filtros:", error);
        $filtroCategoria.innerHTML = '<option value="todas">Todas las categorías</option>';
      }
    }

    // Función para aplicar filtros
    function aplicarFiltros() {
      let noticiasFiltradas = [...noticiasOriginales];

      // Filtrar por categoría
      if (filtrosActivos.categoria !== 'todas') {
        noticiasFiltradas = noticiasFiltradas.filter(noticia =>
          noticia.fkCategoria == filtrosActivos.categoria
        );
      }

      // Filtrar por estado (importante)
      if (filtrosActivos.estado === 'importantes') {
        noticiasFiltradas = noticiasFiltradas.filter(noticia =>
          noticia.importante === "1" || noticia.importante === 1
        );
      } else if (filtrosActivos.estado === 'normales') {
        noticiasFiltradas = noticiasFiltradas.filter(noticia =>
          noticia.importante === "0" || noticia.importante === 0
        );
      }

      // Ordenar por fecha
      noticiasFiltradas.sort((a, b) => {
        const fechaA = new Date(a.fechaCreacion);
        const fechaB = new Date(b.fechaCreacion);
        return filtrosActivos.fecha === 'recientes' ?
          fechaB - fechaA : fechaA - fechaB;
      });

      return noticiasFiltradas;
    }

    // Función para actualizar la vista con los filtros aplicados
    function actualizarVistaConFiltros() {
      noticiasFiltradas = aplicarFiltros();
      paintData(noticiasFiltradas);
      actualizarContadorNoticias();
    }

    // Función para actualizar el contador de noticias
    function actualizarContadorNoticias() {
      const $contador = document.getElementById("contador-noticias");
      const total = noticiasOriginales.length;
      const mostrando = noticiasFiltradas.length;

      if (total === mostrando) {
        $contador.textContent = `Mostrando todas las ${total} noticias`;
      } else {
        $contador.textContent = `Mostrando ${mostrando} de ${total} noticias (filtradas)`;
      }
    }

    // Función para generar PDF
    async function generarPDF() {
      const $btnPdf = document.getElementById("generarPdf");
      const categoriaSeleccionada = document.getElementById("filtro-categoria-pdf").value;
      const estadoSeleccionado = document.getElementById("filtro-estado").value;

      // Validar que hay noticias para exportar
      if (noticiasFiltradas.length === 0) {
        showErrorMessage("No hay noticias para exportar con los filtros actuales");
        return;
      }

      // Mostrar estado de carga
      $btnPdf.classList.add('btn-loading');
      $btnPdf.disabled = true;
      const originalText = $btnPdf.innerHTML;
      $btnPdf.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando PDF...';

      try {
        const myForm = new FormData();
        myForm.append("modulo_noticia", "generar-pdf");
        myForm.append("categoria", categoriaSeleccionada);
        myForm.append("estado", estadoSeleccionado);
        myForm.append("noticias_ids", JSON.stringify(noticiasFiltradas.map(n => n.id)));

        const URL = "../ajax/noticia_ajax.php";
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        });

        if (!res.ok) throw new Error(`Error HTTP: ${res.status}`);

        const blob = await res.blob();

        // Crear enlace de descarga
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = `reporte-noticias-${new Date().toISOString().split('T')[0]}.pdf`;
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);

        showSuccessMessage("PDF generado y descargado correctamente");

      } catch (error) {
        console.error("Error al generar PDF:", error);
        showErrorMessage("Error al generar el PDF: " + error.message);
      } finally {
        $btnPdf.classList.remove('btn-loading');
        $btnPdf.disabled = false;
        $btnPdf.innerHTML = originalText;
      }
    }

    // Función para generar Excel - VERSIÓN CORREGIDA
    async function generarExcel() {
      const $btnExcel = document.getElementById("generarExcel");
      const categoriaSeleccionada = document.getElementById("filtro-categoria-pdf").value;
      const estadoSeleccionado = document.getElementById("filtro-estado").value;

      // Validar que hay noticias para exportar
      if (noticiasFiltradas.length === 0) {
        showErrorMessage("No hay noticias para exportar con los filtros actuales");
        return;
      }

      // Mostrar estado de carga
      $btnExcel.classList.add('btn-loading');
      $btnExcel.disabled = true;
      const originalText = $btnExcel.innerHTML;
      $btnExcel.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generando Excel...';

      try {
        const myForm = new FormData();
        myForm.append("modulo_noticia", "generar-excel");
        myForm.append("categoria", categoriaSeleccionada);
        myForm.append("estado", estadoSeleccionado);
        myForm.append("noticias_ids", JSON.stringify(noticiasFiltradas.map(n => n.id)));

        const URL = "../ajax/noticia_ajax.php";
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        });

        // Verificar si la respuesta es exitosa
        if (!res.ok) {
          // Intentar leer el error como JSON
          const errorText = await res.text();
          let errorMessage = `Error HTTP: ${res.status}`;

          try {
            const errorJson = JSON.parse(errorText);
            errorMessage = errorJson.message || errorMessage;
          } catch (e) {
            // Si no es JSON, usar el texto plano
            if (errorText) {
              errorMessage = errorText;
            }
          }

          throw new Error(errorMessage);
        }

        // Verificar el content-type para asegurarnos que es Excel
        const contentType = res.headers.get('content-type');
        if (!contentType || !contentType.includes('spreadsheet')) {
          const errorText = await res.text();
          console.error('Respuesta inesperada:', errorText);
          throw new Error('El servidor no devolvió un archivo Excel válido');
        }

        // Obtener el blob
        const blob = await res.blob();

        // Verificar que el blob no esté vacío
        if (blob.size === 0) {
          throw new Error('El archivo Excel generado está vacío');
        }

        // Crear enlace de descarga con extensión CORRECTA
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.style.display = 'none';
        a.href = url;
        a.download = `reporte-noticias-${new Date().toISOString().split('T')[0]}.xlsx`; // ✅ .xlsx CORRECTO
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);
        document.body.removeChild(a);

        showSuccessMessage("Excel generado y descargado correctamente");

      } catch (error) {
        console.error("Error al generar Excel:", error);
        showErrorMessage("Error al generar el Excel: " + error.message);
      } finally {
        $btnExcel.classList.remove('btn-loading');
        $btnExcel.disabled = false;
        $btnExcel.innerHTML = originalText;
      }
    }

    // Función para mostrar mensajes de error
    function showErrorMessage(message) {
      const errorDiv = document.createElement('div');
      errorDiv.className = 'alert alert-danger alert-dismissible fade show';
      errorDiv.style.position = 'fixed';
      errorDiv.style.top = '20px';
      errorDiv.style.right = '20px';
      errorDiv.style.zIndex = '10000';
      errorDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
      document.body.appendChild(errorDiv);

      setTimeout(() => {
        if (errorDiv.parentNode) {
          errorDiv.parentNode.removeChild(errorDiv);
        }
      }, 5000);
    }

    // ========== FUNCIONES ORIGINALES ACTUALIZADAS ==========

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

        // Guardar noticias originales para filtros
        noticiasOriginales = Array.isArray(json) ? json : [];
        noticiasFiltradas = [...noticiasOriginales];

        if (noticiasOriginales.length === 0) {
          paintNoData();
        } else {
          paintData(noticiasFiltradas);
          actualizarContadorNoticias();
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
      actualizarContadorNoticias();
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
      const basePath = '/tid_colegio/img/web/'; // Ruta directa

      if (data.length === 0) {
        paintNoData();
        return;
      }

      data.forEach((item) => {
        if (!item.id || !item.titulo || !item.usuario || !item.fechaCreacion) {
          console.warn("Datos incompletos para noticia:", item);
          return;
        }

        let imagen = '../img/default.jpg';
        if (item.portada) {
          if (item.portada.includes('http')) {
            imagen = item.portada;
          } else {
            imagen = `${basePath}${item.portada}`;
          }
        }

        // Agregar badge para noticias importantes
        const importanteBadge = item.importante === "1" ?
          '<span class="badge bg-warning float-end"><i class="fas fa-star"></i> Importante</span>' : '';

        $noticias.innerHTML += `
      <div class="noticia">
        <span>Creado por <b>${item.usuario}</b></span>
        <div class="noticia__info">
          <h3>${item.titulo} ${importanteBadge}</h3>
          <img src="${imagen}" alt="Imagen de ${item.titulo}" 
               onerror="this.src='../img/default.jpg'">
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

      const basePath = 'http://localhost/tid_colegio/img/web/';
      let imagePath = '';

      if (data.portada) {
        if (data.portada.includes('http')) {
          imagePath = data.portada;
        } else {
          imagePath = `${basePath}${data.portada}`;
        }
      } else {
        imagePath = '../img/default.jpg';
      }

      console.log('Intentando cargar imagen desde:', imagePath);
      $imageCurrent.src = imagePath;

      $imageCurrent.onerror = function() {
        console.warn('Error al cargar la imagen:', imagePath);
        const altPath = `../img/web/${data.portada}`;
        console.log('Intentando ruta alternativa:', altPath);
        $imageCurrent.src = altPath;

        $imageCurrent.onerror = function() {
          console.warn('También falló la ruta alternativa:', altPath);
          this.src = '../img/default.jpg';
        };
      };

      $imageCurrent.onload = function() {
        console.log('Imagen cargada correctamente desde:', imagePath);
      };

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
      const myForm = new FormData();
      const id = localStorage.getItem("NOTICE-ID");

      if (!id) {
        $errorUpdate.textContent = "ID de noticia no válido.";
        return;
      }

      contentNoticeUpdate = quill.root.innerHTML;

      myForm.append("modulo_noticia", "actualizar");
      myForm.append("title", $titleUpdate.value);
      myForm.append("contentNotice", contentNoticeUpdate);
      myForm.append("category", $categorias.value);
      myForm.append("id", id);
      myForm.append("autor", getCookie("id") || "0");
      myForm.append("importante", $checkedInput.checked ? "1" : "0");

      const fileInput = document.getElementById("input-file-update");
      if (fileInput.files[0]) {
        myForm.append("image", fileInput.files[0]);
        console.log("Enviando nueva imagen:", fileInput.files[0].name);
      } else {
        myForm.append("keep_image", "true");
        console.log("Manteniendo imagen actual");
      }

      const URL = "../ajax/noticia_ajax.php";
      $contentUpdate.style.display = "none";
      $loaderUpdate.style.display = "grid";
      $errorUpdate.textContent = "";

      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        });

        const text = await res.text();
        console.log("Respuesta del servidor:", text);

        if (!res.ok) {
          throw new Error(`Error HTTP: ${res.status}`);
        }

        let json;
        try {
          json = JSON.parse(text);
        } catch (e) {
          throw new Error(`Respuesta no es JSON válido: ${text}`);
        }

        console.log("Respuesta parseada:", json);

        if (json.status === 200 || json.success === true) {
          closeUpdateModal();
          showSuccessMessage("Noticia actualizada correctamente");

          setTimeout(() => {
            obtenerNoticias();
          }, 500);

        } else {
          throw new Error(json.message || "Error desconocido al actualizar");
        }

      } catch (error) {
        console.error("Error al actualizar noticia:", error);
        $errorUpdate.textContent = "Error: " + error.message;

        $contentUpdate.style.display = "grid";
        $loaderUpdate.style.display = "none";
      }
    }

    // Función para mostrar mensaje de éxito
    function showSuccessMessage(message) {
      const successDiv = document.createElement('div');
      successDiv.className = 'alert alert-success alert-dismissible fade show';
      successDiv.style.position = 'fixed';
      successDiv.style.top = '20px';
      successDiv.style.right = '20px';
      successDiv.style.zIndex = '10000';
      successDiv.innerHTML = `
    ${message}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  `;
      document.body.appendChild(successDiv);

      setTimeout(() => {
        if (successDiv.parentNode) {
          successDiv.parentNode.removeChild(successDiv);
        }
      }, 3000);
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

    // ========== EVENT LISTENERS ==========

    // Manejo de eventos originales
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
          closeUpdateModal();
        }
      }
    });

    $categorias.addEventListener("change", (e) => {
      selectCategoria = $categorias.value;
    });

    $buttonUpdate.addEventListener("click", async (e) => {
      e.preventDefault();
      e.stopPropagation();

      if (validator()) {
        $buttonUpdate.disabled = true;
        $buttonUpdate.textContent = "Actualizando...";

        await updateNotice();

        setTimeout(() => {
          $buttonUpdate.disabled = false;
          $buttonUpdate.textContent = "Actualizar";
        }, 2000);
      }
    });

    $faceUpdate.addEventListener("change", function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          $imageCurrent.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });

    // Función para cerrar el modal correctamente
    function closeUpdateModal() {
      $modalUpdate.classList.remove("active-modal-update");
      localStorage.removeItem("NOTICE-ID");

      $titleUpdate.value = "";
      quill.root.innerHTML = "";
      $errorUpdate.textContent = "";

      const fileInput = document.getElementById("input-file-update");
      fileInput.value = "";
    }

    // Event listeners para filtros y reportes
    document.addEventListener("DOMContentLoaded", function() {
      // Cargar categorías en los filtros
      cargarCategoriasFiltros();

      // Botón aplicar filtros
      const $aplicarFiltros = document.getElementById("aplicarFiltros");
      if ($aplicarFiltros) {
        $aplicarFiltros.addEventListener("click", function() {
          filtrosActivos.categoria = document.getElementById("filtro-categoria-pdf").value;
          filtrosActivos.estado = document.getElementById("filtro-estado").value;
          filtrosActivos.fecha = document.getElementById("filtro-fecha").value;
          actualizarVistaConFiltros();
        });
      }

      // Botón limpiar filtros
      const $limpiarFiltros = document.getElementById("limpiarFiltros");
      if ($limpiarFiltros) {
        $limpiarFiltros.addEventListener("click", function() {
          document.getElementById("filtro-categoria-pdf").value = "todas";
          document.getElementById("filtro-estado").value = "todas";
          document.getElementById("filtro-fecha").value = "recientes";

          filtrosActivos = {
            categoria: 'todas',
            estado: 'todas',
            fecha: 'recientes'
          };

          actualizarVistaConFiltros();
        });
      }

      // Botón generar PDF
      const $generarPdf = document.getElementById("generarPdf");
      if ($generarPdf) {
        $generarPdf.addEventListener("click", generarPDF);
      }

      // Botón generar Excel
      const $generarExcel = document.getElementById("generarExcel");
      if ($generarExcel) {
        $generarExcel.addEventListener("click", generarExcel);
      }

      // Aplicar filtros automáticamente al cambiar selects
      const $filtroCategoria = document.getElementById("filtro-categoria-pdf");
      if ($filtroCategoria) {
        $filtroCategoria.addEventListener("change", function() {
          filtrosActivos.categoria = this.value;
          actualizarVistaConFiltros();
        });
      }

      const $filtroEstado = document.getElementById("filtro-estado");
      if ($filtroEstado) {
        $filtroEstado.addEventListener("change", function() {
          filtrosActivos.estado = this.value;
          actualizarVistaConFiltros();
        });
      }

      const $filtroFecha = document.getElementById("filtro-fecha");
      if ($filtroFecha) {
        $filtroFecha.addEventListener("change", function() {
          filtrosActivos.fecha = this.value;
          actualizarVistaConFiltros();
        });
      }
    });

    // Actualizar el evento del botón cerrar
    $closeUpdate.addEventListener("click", closeUpdateModal);

    // También cerrar modal al hacer clic fuera de él
    $modalUpdate.addEventListener("click", function(e) {
      if (e.target === this) {
        closeUpdateModal();
      }
    });

    // Inicializar
    obtenerNoticias();
  </script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../js/sidebar.js"></script>
</body>

</html>
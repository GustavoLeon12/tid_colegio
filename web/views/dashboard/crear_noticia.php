<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Orion - Crear Noticia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/query.css">
  <link rel="stylesheet" href="../../css/noticias.css">
  <link rel="stylesheet" href="../../css/animaciones.css">
  <link rel="stylesheet" href="../../css/crear-noticia.css">
  <link rel="stylesheet" href="../../css/globals.css">
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
  <script src="../../js/animaciones.js"></script>
  <link rel="shortcut icon" href="../../img/LOGO.png" type="image/x-icon">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    .dashboard {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 220px;
      background: #343a40;
      color: white;
      padding: 20px 10px;
    }

    .sidebar h2 {
      font-size: 18px;
      margin-bottom: 20px;
      text-align: center;
    }

    .sidebar a {
      display: block;
      padding: 10px;
      margin: 5px 0;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .sidebar a:hover {
      background: #495057;
    }

    .content {
      flex-grow: 1;
      background: #f8f9fa;
      padding: 20px;
    }

    .header {
      background: #fff;
      padding: 15px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
      .dashboard {
        flex-direction: column;
      }

      .sidebar {
        width: 100%;
      }

      .content {
        padding: 10px;
      }
    }
  </style>
</head>

<body>
  <div class="dashboard">
    <!-- Incluir el componente del menú -->
    <?php include './sidebar.php'; ?>

    <!-- Content -->
    <div class="content">
      <div class="header">
        <h3>Crear Noticia</h3>
        <p>Crea una fabulosa noticia para compartir con la comunidad educativa.</p>
      </div>

      <div class="container">
        <article class="article__divider">
          <section>
            <div class="create__blog__introduction">
              <h2>Crea una fabulosa noticia</h2>
              <p style="text-align:justify">
                Tu espacio para dar vida a noticias, eventos y blogs que reflejen el vibrante espíritu de nuestra comunidad educativa. Aquí, puedes compartir logros, experiencias y anuncios importantes de manera sencilla. Solo sigue los pasos intuitivos, agrega imágenes vibrantes y conecta con nuestra audiencia de manera significativa. ¡Haz que cada palabra cuente y celebremos juntos nuestros éxitos! 🌟📰
              </p>
            </div>
            <form class="create__blog" id="form" enctype="multipart/form-data" method="post">
              <div class="create__blog__title --image">
                <label for="input-file">Elige una imagen de portada:</label>
                <input type="file" name="image" id="input-file" class="form-control" accept="image/*">
              </div>
              <div class="create__blog__title mt-3">
                <label for="title">Escribe un título:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Escribe un título...">
              </div>
              <div class="create__blog__title mt-3">
                <label for="category">Selecciona una categoría:</label>
                <select class="form-select" aria-label="Select category" id="categorias" name="category">
                </select>
              </div>
              <label class="mt-3">Escribe tu artículo:</label>
              <div class="create__blog__editor">
                <div id="editor-container"></div>
              </div>
              <div class="form-check mt-3">
                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="importante">
                <label class="form-check-label m-0 --label--special" for="flexCheckChecked">
                  ¿Esto es importante?
                </label>
              </div>
              <div class="create__blog__actions">
                <input id="submit" type="submit" value="Publicar" class="mt-3 button__post">
              </div>
              <span id="error"></span>
            </form>
          </section>
          <?php require_once '../components/modal_categoria.php'; ?>
        </article>
      </div>
    </div>
  </div>

  <img id="imagenMostrada">

  <script>
    const $inputFile = document.getElementById("input-file");
    const $title = document.getElementById("title");
    const $buttonSubmit = document.getElementById("submit");
    const $form = document.getElementById("form");
    const $categorias = document.getElementById("categorias");
    const $error = document.getElementById("error");
    let contentNotice = "";

    async function obtenerCategorias() {
      const URL = "../../ajax/categoria_ajax.php?categoriasPrivado";
      try {
        const res = await fetch(URL);
        if (!res.ok) {
          throw new Error(`HTTP error! Status: ${res.status}`);
        }
        const json = await res.json();
        console.log("Categorías:", json);
        paintCategories(json);
      } catch (error) {
        console.error("Error al obtener categorías:", error);
        $categorias.innerHTML += `<b>Surgió un error: ${error.message}</b>`;
      }
    }

    async function crearNoticia(data) {
      const URL = "../../ajax/noticia_ajax.php";
      $buttonSubmit.setAttribute("disabled", "true");
      $buttonSubmit.value = "Creando...";
      try {
        const res = await fetch(URL, {
          method: "POST",
          body: data
        });
        const json = await res.json();
        return json;
      } catch (error) {
        console.log(error);
        return {
          message: "Error en el servidor",
          status: 500
        };
      } finally {
        $buttonSubmit.removeAttribute("disabled");
        $buttonSubmit.value = "Publicar";
      }
    }

    function paintCategories(data) {
      data.forEach((item) => {
        $categorias.innerHTML += `<option value="${item.id}">${item.nombre}</option>`;
      });
    }

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
      placeholder: 'Escribe una noticia...',
      theme: 'snow'
    });

    $buttonSubmit.addEventListener("click", async (e) => {
      e.preventDefault();
      contentNotice = quill.root.innerHTML;
      const idUser = getCookie("id");
      const myForm = new FormData($form);
      myForm.append("contentNotice", contentNotice);
      myForm.append("modulo_noticia", "crear");
      myForm.append("user", `${idUser}`);
      const isOk = validator();
      if (isOk) {
        const rsp = await crearNoticia(myForm);
        console.log(rsp);
        if (rsp.status === 200) {
          activeModal();
          activeTimer();
        } else {
          toError();
          activeModal();
          activeTimer();
        }
      }
    });

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

    function validator() {
      const titleValue = $title.value;
      const imageValue = $inputFile.files;
      const contentLength = quill.getLength();
      if (titleValue.trim().length === 0) {
        $error.textContent = "El campo título no debe de estar vacío.";
        return false;
      } else if (imageValue.length === 0) {
        $error.textContent = "La portada no debe de estar vacía.";
        return false;
      } else if (contentLength < 100) {
        $error.textContent = "La noticia debe de tener al menos 100 caracteres.";
        return false;
      } else {
        return true;
      }
    }

    obtenerCategorias();
  </script>
  <script src="../../js/bootstrap.min.js"></script>
  <script src="../../js/main.js"></script>
  <script src="../../lib/WOW/WOW.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/query.css">
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="stylesheet" href="../css/administrar_noticias.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
  <script src="../js/animaciones.js"></script>
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <title>Colegio Orion - Administrar</title>
</head>

<body>
  <?php
  require_once './components/navigation.php';
  ?>
  <?php
  require_once './components/modal_delete.php';
  ?>
  <?php
  require_once './components/modal_update.php';
  ?>
  <main>
    <section class="section">
      <h3>Edita, elimina o mira noticias</h3>
      <p class="section__text" style="text-align:justify;">Descubre un mundo de noticias, eventos y blogs. Mantente informado, participa y 
        comparte experiencias. Únete a nuestra comunidad educativa y sé parte de cada historia que construimos juntos. 
        ¡Bienvenido a un espacio lleno de aprendizaje y logros!</p>
      <div class="loader__box" id="loader">
        <?php
        require "./components/loader.php"
          ?>
        <h4>Cargando...</h4>
      </div>
      <div id="noticias">
      </div>
    </section>
  </main>
  <div class="footer">
    <?php
    require_once './components/footer.php'
      ?>
  </div>
  <script>
    const $noticias = document.getElementById("noticias")
    const $loader = document.getElementById("loader")
    async function obtenerNoticias()
    {
      const myForm = new FormData()
      myForm.append("modulo_noticia", "obtener-privado")
      const URL = "../ajax/noticia_ajax.php"
      $noticias.style.display = "none"
      $loader.style.display = "grid"

      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        })
        const json = await res.json();

        (json.length == false) ? paintNoData() : paintData(json)
      } catch (err) {
        $noticias.innerHTML += `
        <div class="notfound__notices">
        <i class="fas fa-exclamation-circle"></i>
          <p>Error: ${err}</p>
        </div>
      `
      } finally {
        $noticias.style.display = "grid"
        $loader.style.display = "none"
      }

    }

    function paintNoData()
    {
      $noticias.innerHTML += `
    <div class="notfound__notices">
      <img src="../img/not_found_notices.svg"/>
      <p>Lamentablemente, no pudimos encontrar ninguna noticia o evento</p>
    </div>
    `
    }

    function formatearFecha(fechaHora)
    {
      const fecha = new Date(fechaHora);
      const dia = fecha.getDate();
      const mes = fecha.getMonth() + 1;
      const anio = fecha.getFullYear();
      const fechaFormateada = dia + '/' + mes + '/' + anio;
      return fechaFormateada;
    }

    function paintData(data)
    {
      data.forEach((item) =>
      {
        $noticias.innerHTML += `
        <div class="noticia">
            <span>Creado por <b>${item.usuario}</b></span>
          <div class="noticia__info">
            <h3>${item.titulo}</h3>
            <img src="<?= $GLOBALS['images_user'] ?>${item.imagen}" alt="avatar">
          </div>
          <div class="noticia__info noticia__info__external">
            <div class="noticia__info noticia__info__calendar">
              <i class="far fa-calendar"></i>
              <p>${formatearFecha(item.fechaCreacion)}</p>
            </div>
            <div class="noticia__actions">
              <button class="openModalUpdate" data-id="${item.id}"><i class="fas fa-pencil-alt "></i>Editar</button>
              <button class="openModalDelete" data-id="${item.id}"><i class="fas fa-trash-alt"></i>Eliminar</button>
            </div>
          </div>
        </div>
      `
      })
    }
    obtenerNoticias()
  </script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>
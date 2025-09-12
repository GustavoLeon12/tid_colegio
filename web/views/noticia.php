<?php
require '../../global.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/lib/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/animaciones.css">
  <link rel="stylesheet" href="../css/crear-noticia.css">
  <link rel="stylesheet" href="../css/noticia.css">
  <link rel="stylesheet" href="../css/globals.css">
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
  <title>Colegio Orion - Noticia</title>
</head>

<body>

  <?php
include './components/navigation.php';
?>

  <main>
    <article>
      <div id="loader" class="loader__box">
        <?php
          require "./components/loader.php"
        ?>
        <h4>Cargando...</h4>

      </div>
    </article>
    <article id="content__notice">
      <section class="header__section">
        <div class="header__section__text">
          <img id="image" src="" alt="front-page">
          <h3 id="title"></h3>
        </div>
      </section>
      <section class="content__section mt-5">
        <span>
          <h3 id="titleI"></h3>
          <div id="content" class="mt-5 mb-5">
          </div>
          <div id="disqus_thread"></div>
          <script>
          /**
           *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
           *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
          /*
          var disqus_config = function () {
          this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
          this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
          };
          */
          (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
              s = d.createElement('script');
            s.src = 'https://education-app.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
          })();
          </script>
          <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
              Disqus.</a></noscript>
        </span>
        <?php require_once './components/carta_noticias.php'?>
      </section>
    </article>

  </main>

  <div class="footer">
    <?php
include './components/footer.php'
?>
  </div>

  <script>
  const $title = document.getElementById("title")
  const $titleI = document.getElementById("titleI")
  const $content = document.getElementById("content")
  const $image = document.getElementById("image")
  const $contentNotice = document.getElementById("content__notice")
  const $loader = document.getElementById("loader")

  async function obtenerNoticia() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    $contentNotice.style.display = "none"
    if (id !== null) {
      const URL = "../ajax/noticia_ajax.php?id=" + id
      try {
        const res = await fetch(URL)
        const json = await res.json()
        if (json === false) {
          throw new Error("No se encontro al ningún blog")
        }
        painNotice(json)
        $contentNotice.style.display = "block"
      } catch (error) {
        $contentNotice.style.display = "block"
        $contentNotice.innerHTML =
          `<div class="box__error"><i class="fas fa-exclamation-circle"></i><h4>Opps! Sucedio un error</h4><p>${error}</p></div>`
      } finally {
        $loader.style.display = "none"
      }
    } else {
      window.location.href = "./noticias.php";
    }
  }

  function painNotice(data) {
    $title.innerHTML = data.titulo
    $titleI.innerHTML = data.titulo
    $content.innerHTML = data.descripcion
    $image.src =  `<?=$GLOBALS['images']?>${data.portada}`
  }
  document.addEventListener("DOMContentLoaded", () => {
    obtenerNoticia()
  })
  </script>

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
  <script src="../lib/WOW/WOW.min.js"></script>
</body>

</html>
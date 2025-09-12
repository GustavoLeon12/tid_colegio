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
  <link rel="stylesheet" href="../css/noticias.css">
  <link rel="stylesheet" href="../css/globals.css">
  <link rel="shortcut icon" href="../img/LOGO.png" type="image/x-icon">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <title>Colegio Orion - Noticias</title>
</head>

<body style="background-color: rgb(235, 235, 235);">
  <?php
  require_once './components/navigation.php';
  ?>
  <div class="banner-noticias d-flex justify-content-center align-items-center">
    <div class="dark-container content text-center text-white">
      <h3 class="text-center">Conoce nuestras ultimas actualizaciones <br> en noticias y eventos</h3>
      <p>Explora</p>
    </div>
  </div>

  <div class="container mt-3">
    <div class="text-center pb-2">
      <p class="section-title px-5">
        <span class="px-2" style="background-color: rgb(235, 235, 235); font-weight:bold;">NOTICIAS Y EVENTOS</span>
      </p>
    </div>
    <div class="row">
      <div class="col-md-10" id="noticias">



      </div>
      <div class="col-md-2">
        <span href="#" id="loader-categoria-algo" class="list-group-item list-group-item-action">
          <?php
          require './components/loader.php'
            ?>
          Cargando...
        </span>
        <div class="list-group" id="categorias">
          <a href="#" class="list-group-item list-group-item-action active" data-categoria="todas">Categorias</a>
          <a href="#" class="list-group-item list-group-item-action" data-categoria="333">Todos</a>
        </div>
      </div>
    </div>
  </div>

  <?php
  require_once './components/footer.php'
    ?>

  <script>

  </script>
  <script>
    const $noticias = document.getElementById('noticias')
    const $categorias = document.getElementById("categorias")
    const $loaderCategorias = document.getElementById("loader-categoria-algo")
    let data = []

    function eliminarEtiquetasHTML(cadenaHTML)
    {
      return cadenaHTML.replace(/<[^>]*>/g, '');
    }

    function formatearFecha(fechaHora)
    {
      const fecha = new Date(fechaHora);
      const dia = fecha.getDate();
      const mes = fecha.getMonth() + 1;
      const anio = fecha.getFullYear();
      const fechaFormateada = dia + '-' + mes + '-' + anio;
      return fechaFormateada;
    }

    async function obtenerNoticias()
    {
      const myForm = new FormData()
      myForm.append("modulo_noticia", "obtener")
      const URL = "../ajax/noticia_ajax.php"
      try {
        const res = await fetch(URL, {
          method: "POST",
          body: myForm
        })
        const json = await res.json();
        data = json
        if (json.length == 0) {
          paintNoData()
        } else {
          paintData(json)
        }
      } catch (err) {
        paintNoData()
      }
    }

    function paintNoData()
    {
      $noticias.innerHTML += `
    <div class="notfound__notices">
      <img src="../img/not_found_notices.svg"/>
      <p>Lamentablemente, no pudimos encontrar ninguna noticia o evento</p>
      <span>. Te invitamos a explorar otras secciones o ajustar los criterios de búsqueda para obtener información más relevante. Si tienes alguna pregunta específica, no dudes en ponerte en contacto con nosotros para recibir asistencia personalizada.</span>
    </div>
    `
    }

    function paintData(data)
    {
      data.forEach((item) =>
      {
        $noticias.innerHTML += `
              <div class="noticia-principal d-flex categoria-politica" id="notice-card" data-set="${item.id}">
                <div class="noticia-pagina">
                  <img class="imagen-noticicia" src="<?= $GLOBALS['images'] ?>${item.portada}" alt="">
                </div>
                <div class="noticia-descipcion">
                  <h5>${item.titulo}<p style="font-size: 10px; color: gray; text-transform: uppercase;">-${item.categoria}-</p>
                  </h5>
                  <p class="noticia-descipcion__nostyle">${eliminarEtiquetasHTML(item.descripcion.substring(0, 140))}...</p>
                  <p class="fecha-noti" style="font-size: 11px; color: gray;"><i class="far fa-clock"></i>
                    ${formatearFecha(item.fechaCreacion)}</p>
                </div>
              </div>
              `
      })
    }
    document.addEventListener('click', e =>
    {
      if (e.target.id == "notice-card") {
        const id = e.target.getAttribute("data-set")
        window.location.href = `./noticia.php?id=${id}`;
      }
    })
    async function obtenerCategorias()
    {
      const URL = "../ajax/categoria_ajax.php?categorias"
      try {
        $loaderCategorias.style.display = "block"
        const res = await fetch(URL)
        const json = await res.json()
        paintCategories(json)
      } catch (error) {
        $categorias.innerHTML += "<b>Surgio un error: </b>" + error
      } finally {
        $loaderCategorias.style.display = "none"
      }
    }

    function paintCategories(data)
    {
      data.forEach(categoria =>
      {
        $categorias.innerHTML += `
        <a href="#" class="list-group-item list-group-item-action" data-categoria=${categoria.id}>${categoria.nombre}</a>
        `
      })
    }
    document.addEventListener("DOMContentLoaded", (e) =>
    {
      obtenerNoticias()
      obtenerCategorias()
    })
    document.addEventListener("click", (e) =>
    {
      const category = e.target.getAttribute("data-categoria")
      if (category === "333") {
        $noticias.innerHTML = ""
        if (data.length == 0) {
          paintNoData()
        } else {
          paintData(data)
        }
      } else if (category !== null) {
        const filterData = data.filter(item => item.fkCategoria === category)
        $noticias.innerHTML = ""
        if (filterData.length == 0) {
          paintNoData()
        } else {
          paintData(filterData)
        }
      }
    })
  </script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/main.js"></script>
</body>

</html>
<?php
require '../../global.php';
?>
<style>
.section__extra {
  width: 100%;
  box-shadow: 0px 0px 2px 2px #0001;
  background-color: white;
  border-radius: 0.3rem;
  height: 400px;
  overflow: auto;
  padding: 0.5rem 1rem;
}

.section__extra h2 {
  margin: 0;
  font: normal normal 700 1rem/2rem var(--bs-font-sans-serif);
  margin: 1rem 0;
}

.section__extra a {
  width: 100%;
  display: flex;
  border: none;
  outline: none;
  justify-content: start;
  align-items: center;
  padding: 0;
  gap: 1rem;
  background-color: rgba(0, 0, 0, 0.03);
  transition: 0.3s;
  border-radius: 0.3rem;
  margin-top: 1rem;
  overflow: hidden;
  text-decoration: none;
  color: #333;
}

.section__extra a:hover,
.section__extra a:focus {
  background-color: rgba(0, 0, 0, 0.15);
}

.section__extra span {
  width: 60%;
  display: grid;
}

.section__extra p {
  font: normal normal 400 0.7rem/1rem var(--bs-font-sans-serif);
  overflow: hidden;
  text-align: left;
  text-overflow: ellipsis;
  margin: 0;
  color: #0008;
}

.section__extra h4 {
  font: normal normal 700 0.8rem/1rem var(--bs-font-sans-serif);
  white-space: nowrap;
  overflow: hidden;
  text-align: left;
  margin: 0;
  text-overflow: ellipsis;
}

.section__extra img {
  width: 80px;
  height: 80px;
  object-fit: cover;
}
</style>
<div class="section__extra" id="extra">
  <h2>Noticias y eventos: </h2>
  <div class="loader__box" id="card-loader">
    <?php
          require "./components/loader.php"
        ?>
    <h4>Cargando...</h4>
  </div>
  <div id="noticias"></div>
</div>

<script>
const $noticias = document.getElementById("noticias")
const $cardLoader = document.getElementById("card-loader")
async function obtenerNoticias() {
  const myForm = new FormData()
  myForm.append("modulo_noticia", "obtener")
  const URL = "../ajax/noticia_ajax.php"
  $noticias.style.display = "none"
  $cardLoader.style.display = "grid"

  try {
    const res = await fetch(URL, {
      method: "POST",
      body: myForm
    })
    const json = await res.json();
    (json.length == false) ? paintNoData(): paintData(json)
  } catch (err) {
    $noticias.innerHTML += `
      <div class="notfound__notices">
      <i class="fas fa-exclamation-circle"></i>
        <p>Error: ${err}</p>
      </div>
    `
  } finally {
    $noticias.style.display = "block"
    $cardLoader.style.display = "none"
  }
}

function eliminarEtiquetasHTML(cadenaHTML) {
  return cadenaHTML.replace(/<[^>]*>/g, '');
}

function paintNoData() {
  $noticias.innerHTML += `
    <div class="notfound__notices">
      <img src="../img/not_found_notices.svg"/>
      <p>Lamentablemente, no pudimos encontrar ninguna noticia o evento</p>
    </div>
    `
}

function paintData(data) {
  data.forEach((item) => {
    $noticias.innerHTML += `
        <a href="./noticia.php?id=${item.id}">
          <img src="<?=$GLOBALS['images']?>${item.portada}" alt="image">
          <span>
            <h4>${item.titulo}</h4>
          </span>
        </a>
              `
  })
}

document.addEventListener("DOMContentLoaded", () => {
  obtenerNoticias()
})
</script>
<?php
require '../../../global.php';
?>

<style>
#noticias {
  display: grid;
  grid-template-columns: repeat(auto-fill, 500px);
  padding: 2rem;
  gap: 2rem;
}

.noticia-principal {
  display: grid;
  justify-content: start;
  gap: 2rem;
  background: white;
  border-radius: 1rem;
  overflow: hidden;
  grid-template-columns: 30% 65%;
  grid-template-rows: 15rem;
  border: 1px solid #0001;
  max-width: 500px;
  transition: 0.3s;
  cursor: pointer
}

.noticia-descipcion {
  padding: 2rem 1rem;
  pointer-events: none
}

.noticia-descipcion h5 {
  font-size: 1.7rem;
  font-weight: 700;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  width: 300px;
  pointer-events: none
}

.noticia-principal img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  pointer-events: none
}

.noticia-principal:hover,
.noticia-principal:focus {
  background: #0001;
  box-shadow: none;
}

.modal__noticia {
  width: 100%;
  height: 100vh;
  position: fixed;
  display: grid;
  place-items: end;
  overflow: hidden;
  background: #0007;
  opacity: 0;
  visibility: hidden;
  transition: 0.3s;
  z-index: 5000;
  left: 0;
  top: 0;
}

.modal__noticia__activo {
  opacity: 1;
  visibility: visible;
}

.modal__noticia__contenido {
  width: 100%;
  background: white;
  border-radius: 0.3rem;
  padding: 2rem 2rem;
  height: 90%;
  overflow: auto;
}

.modal__noticia__contenido img {
  width: 100%;
  height: 350px;
  object-fit: cover;
  margin-top: 2rem;
  border-radius: 0.5rem;
}

.modal__noticia__contenido h1 {
  font-size: 2rem;
  font-weight: 700;
}

.modal__noticia__contenido p {
  opacity: 0.7;
}

.modal__noticia__contenido span {
  max-width: 720px;
  width: 100%;
  margin: 0 auto;
  display: block;
}

.noticia-cerrar {
  display: flex;
  justify-content: end;
  align-items: center;
}


.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
  margin: 4rem auto;
}

.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}

.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  background: #000;
  margin: -4px 0 0 -4px;
}

.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}

.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px;
}

.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}

.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px;
}

.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}

.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px;
}

.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}

.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px;
}

.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}

.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px;
}

.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}

.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px;
}

.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}

.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px;
}

.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}

.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px;
}

@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}


.notfound__notices {
  width: 100%;
  display: grid;
  place-items: center;
  max-width: 400px;
  margin: 4rem auto;
}

.notfound__notices p {
  margin-top: 1rem;
  text-align: center;
  font: normal normal 700 2rem/2rem 'Open Sans', sans-serif;
}

.notfound__notices span {
  text-align: center;
  opacity: 0.7;
}

#noticia-loader,
#noticias-cargador {
  text-align: center;
}
</style>

<div class="modal__noticia">
  <div class="modal__noticia__contenido" id="noticia">
    <div id="noticia-contenido">
      <span>

        <div class="noticia-cerrar">
          <button class="notice-card-close btn btn-primary">CERRAR</button>
        </div>
        <img id="noticia-portada" src="" alt="image">
        <h1 id="noticia-titulo"></h1>
        <p id="noticia-descripcion"></p>
      </span>
    </div>
    <div id="noticia-loader">
      <div class="lds-roller">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12">
  <div class="box box-warning" id="content">
    <div class="box-header with-border" id="Titulo_Center">
      <h5 class="box-title"><strong>Comunicados oficiales - <?php echo date('Y'); ?></strong></h5>
    </div>
    <div id="noticias">

    </div>
    <div id="noticias-cargador">
      <div class="lds-roller">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
async function obtenerNoticias() {
  const $contenido = document.getElementById("noticias")
  const $cargador = document.getElementById("noticias-cargador")
  const URL = "../controlador/comunicados/controlador_comunicados.php"
  $contenido.style.display = "none"
  $cargador.style.display = "block"

  try {
    const res = await fetch(URL)
    const json = await res.json();
    if (json['data'].length == 0) {
      paintNoData()
    } else {
      paintData(json['data'])
    }
    $contenido.style.display = "grid"
  } catch (err) {
    $contenido.style.display = "block"
    paintNoData()
  } finally {

    $cargador.style.display = "none"

  }

}

async function obtenerNoticia(id) {
  const $loader = document.getElementById("noticia-loader")
  const $content = document.getElementById("noticia-contenido")
  const URL = "../controlador/comunicados/controlador_comunicado.php?id=" + id
  $loader.style.display = "block"
  $content.style.display = "none"
  try {
    const res = await fetch(URL)
    const json = await res.json();
    painNotice(json['data'][0])
  } catch (err) {
    console.log(err)
  } finally {
    $loader.style.display = "none"
    $content.style.display = "block"
  }
}

function eliminarEtiquetasHTML(cadenaHTML) {
  return cadenaHTML.replace(/<[^>]*>/g, '');
}

function formatearFecha(fechaHora) {
  const fecha = new Date(fechaHora);
  const dia = fecha.getDate();
  const mes = fecha.getMonth() + 1;
  const anio = fecha.getFullYear();
  const fechaFormateada = dia + '-' + mes + '-' + anio;
  return fechaFormateada;
}

function paintNoData() {
  const $noticias = document.getElementById("noticias")
  $noticias.innerHTML += `
    <div class="notfound__notices">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-zoom-exclamation" width="100" height="100" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /><path d="M10 13v.01" /><path d="M10 7v3" /></svg>
      <p>Lamentablemente, no pudimos encontrar ninguna noticia o evento</p>
      <span>Te invitamos a explorar otras secciones o ajustar los criterios de búsqueda para obtener información más relevante. Si tienes alguna pregunta específica, no dudes en ponerte en contacto con nosotros para recibir asistencia personalizada.</span>
    </div>
    `
}

function paintData(data) {
  const $noticias = document.getElementById("noticias")
  data.forEach((item) => {
    $noticias.innerHTML += `
              <div class="noticia-principal d-flex categoria-politica" id="notice-card" data-set="${item.id}">
                <div class="noticia-pagina">
                  <img class="imagen-noticicia" src="<?=$GLOBALS['images']?>${item.portada}" alt="portada">
                </div>
                <div class="noticia-descipcion">
                  <h5>${item.titulo}<p style="font-size: 10px; color: gray; text-transform: uppercase;">-${item.categoria}-</p>
                  </h5>
                  <p class="noticia-descipcion__nostyle">${eliminarEtiquetasHTML(item.descripcion.substring(0, 100))}...</p>
                  <p class="fecha-noti" style="font-size: 11px; color: gray;"><i class="far fa-clock"></i>
                    ${formatearFecha(item.fechaCreacion)}</p>
                </div>
              </div>
              `
  })
}

function painNotice(data) {
  const $titulo = document.getElementById("noticia-titulo")
  const $descripcion = document.getElementById("noticia-descripcion")
  const $portada = document.getElementById("noticia-portada")
  $titulo.innerHTML = data.titulo
  $descripcion.innerHTML = data.descripcion
  $portada.src = `<?=$GLOBALS['images']?>${data.portada}`
}
document.addEventListener("click", (e) => {
  const $modal = document.querySelector(".modal__noticia")
  if (e.target.id == "notice-card") {
    $modal.classList.toggle("modal__noticia__activo")
    const id = e.target.dataset.set
    obtenerNoticia(id)
  } else if (e.target.className.includes("notice-card-close")) {
    $modal.classList.toggle("modal__noticia__activo")
  }
})
obtenerNoticias()
</script>
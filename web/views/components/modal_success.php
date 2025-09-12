<style>
  .container__modal {
    background-color: #0005;
    width: 100%;
    height: 100vh;
    position: fixed;
    left: 0;
    top: 0;
    z-index: 5000;
    overflow: auto;
    display: grid;
    place-items: center;
    opacity: 0;
    visibility: hidden;
    transition: 0.3s
  }

  .custom__modal {
    width: 100%;
    max-width: 400px;
    border-radius: 0.5rem;
    padding: 2rem 3rem;
    background-color: white;
    display: grid;
    place-items: center;
    position: relative;
    overflow: hidden;
  }

  .modal__circle {
    padding: 1rem;
    border-radius: 15rem;
    display: grid;
    place-items: center;
    place-content: center;
    background-color: rgb(68, 148, 68);
  }

  .modal__circle svg {
    size: 100px;
    color: white;
    stroke-width: 4;
  }

  .custom__modal h4 {
    text-align: center;
    margin-top: 1.5rem;
    font: normal normal 700 1rem/1.2rem "Poppins";
  }

  .custom__modal p {
    font: normal normal 400 0.8rem/1rem "Poppins";
    text-align: center;
    margin-top: 0.5rem;
    opacity: 0.7;
  }

  .modal__decorator {
    position: absolute;
    width: 100%;
    height: 4px;
    border-radius: 1rem;
    background-color: rgb(68, 148, 68);
    top: 0;
    left: 0;
    transition: 0.3s
  }
</style>

<div class="container__modal" id="modal_success">
  <div class="custom__modal">
    <div class="modal__decorator" id="progress"></div>
    <div class="modal__circle" id="modal_success_icon">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24"
        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
        stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M5 12l5 5l10 -10" />
      </svg>
    </div>
    <h4 id="modal_success_title">El comunicado fue creado existosamente</h4>
    <p id="modal_success_text">Lo redireccionaremos en 5 segundos</p>
  </div>
</div>

<script>
  const $progressBar = document.getElementById("progress")
  const $modalSuccess = document.getElementById("modal_success")
  const $modalTitle = document.getElementById("modal_success_title")
  const $modalText = document.getElementById("modal_success_text")
  const $modalIcon = document.getElementById("modal_success_icon")
  let widthProgress = 100;
  let counter = 5 / 0.1;
  let interval;

  function activeTimer()
  {
    interval = setInterval(() =>
    {
      $progressBar.style.width = `${widthProgress}%`
      widthProgress = widthProgress - 1
      if (widthProgress === 0) {
        clearInterval(interval)
        window.location.href = "./noticias.php";
      }
    }, counter)
  }

  function activeModal()
  {
    $modalSuccess.style.opacity = "1"
    $modalSuccess.style.visibility = "visible"
  }

  function toError()
  {
    $progressBar.style.background = "#dc3545"
    $modalTitle.innerHTML = "Lamentablemente sucedió un error"
    $modalText.innerHTML = "Sucedió un gran error cuando se intentaba crear una noticia, vuélvelo a intentar más tarde, si el error persiste, reporta este problema, gracias."
    $modalIcon.style.background = "#dc3545"
    $modalIcon.innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle-filled" width="24"
          height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path
            d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z"
            stroke-width="0" fill="currentColor" />
        </svg>
  `
  }
</script>
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
  transition: 0.3s;
  visibility: hidden;
  opacity: 0;
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
  background: #dc3545;
  color: white
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

.modal__actions {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  gap: 0.5rem;

}

.modal__actions button {
  padding: 0.3rem 1rem;
  border-radius: 0.5rem;
  font: normal normal 400 0.8rem/1.5rem var(--font-primary);
  border: none;
  transition: 0.3s
}


.modal__actions button:last-child {
  background: #dc3545;
  color: white
}

.modal__actions button:hover,
.modal__actions button:focus {
  filter: brightness(0.8);
}

.active-modal-delete {
  visibility: visible !important;
  opacity: 1 !important;
}

#content-principal {
  display: grid;
  place-items: center;
  place-content: center
}

.loader__initial {
  display: none;
}
</style>

<div class="container__modal" id="modal-delete">
  <div class="custom__modal">
    <div id="content-principal">
      <div class="modal__circle">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-alert-circle-filled" width="24"
          height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path
            d="M12 2c5.523 0 10 4.477 10 10a10 10 0 0 1 -19.995 .324l-.005 -.324l.004 -.28c.148 -5.393 4.566 -9.72 9.996 -9.72zm.01 13l-.127 .007a1 1 0 0 0 0 1.986l.117 .007l.127 -.007a1 1 0 0 0 0 -1.986l-.117 -.007zm-.01 -8a1 1 0 0 0 -.993 .883l-.007 .117v4l.007 .117a1 1 0 0 0 1.986 0l.007 -.117v-4l-.007 -.117a1 1 0 0 0 -.993 -.883z"
            stroke-width="0" fill="currentColor" />
        </svg>
      </div>
      <h4>¿Seguro que quieres eliminar la noticia?</h4>
      <p>Esta acción es permanente</p>
      <div class="modal__actions">
        <button class="openModalDelete">Cancelar</button><button id="button-delete">Eliminar</button>
      </div>
    </div>
    <div class="loader__box loader__initial" id="state-delete">
      <?php
          require "./components/loader.php"
        ?>
      <h4>Eliminando...</h4>
    </div>
  </div>
</div>

<script>
const $modalDelete = document.getElementById("modal-delete")
const $contentDelete = document.getElementById("content-principal")
const $loaderDelete = document.getElementById("state-delete")
const $buttonDelete = document.getElementById("button-delete")

document.addEventListener("click", (e) => {
  if (e.target.className.includes("openModalDelete")) {
    $modalDelete.classList.toggle("active-modal-delete")
    const dataId = e.target.getAttribute("data-id")
    if (dataId !== null) {
      localStorage.setItem("NOTICE-ID", `${dataId}`)
    }
  }
})
async function removeNotice() {
  const myForm = new FormData()
  const id = localStorage.getItem("NOTICE-ID")
  myForm.append("modulo_noticia", "eliminar")
  myForm.append("id", id)
  const URL = "../ajax/noticia_ajax.php"
  $contentDelete.style.display = "none"
  $loaderDelete.style.display = "grid"

  try {
    const res = await fetch(URL, {
      method: "POST",
      body: myForm
    })
    const json = await res.json()
    $modalDelete.classList.remove("active-modal-delete")
    window.location.href = "./administrar_noticias.php"
  } catch (error) {
    $contentDelete.innerHTML = " <b>Sucedio un error, intentalo más tarde. </b>"
    setTimeout(() => {
      window.location.href = "./administrar_noticias.php"
    }, 3000);
  } finally {
    $contentDelete.style.display = "grid"
    $loaderDelete.style.display = "none"
  }
}
$buttonDelete.addEventListener("click", async (e) => {
  await removeNotice()
})
</script>
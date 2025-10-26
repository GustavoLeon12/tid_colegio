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

  .custom__modal__close {
    position: absolute;
    width: 30px;
    height: 30px;
    display: grid;
    place-items: center;
    border: none;
    background-color: #0005;
    border-radius: 5rem;
    top: 0.5rem;
    right: 0.5rem;
  }

  .custom__modal__close i {
    font-size: 16px;
    color: white;
    pointer-events: none;
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

  .active-modal-update {
    visibility: visible;
    opacity: 1;
  }

  #content-principal {
    display: grid;
    place-items: center;
    place-content: center
  }

  .--edit {
    max-width: 600px;
    max-height: 600px;
    overflow-y: auto
  }

  .loader__initial {
    display: none;
  }

  #title--edit {
    margin-top: 0.5rem;
    margin-bottom: 1.5rem;
  }

  #editor-container img {
    width: 100%
  }

  .modal__actions--edit {
    margin-top: 1rem;
    justify-content: end;
  }

  .modal__actions--edit button:last-child {
    background: #215595;
    color: white;
  }

  .create__blog__title label {
    font: normal normal 700 0.7rem/1.5rem var(--font-primary);
    text-transform: uppercase;
  }

  .create__blog__title input,
  .create__blog__title select {
    font: normal normal 400 0.8rem/1.5rem var(--font-primary);
    opacity: 0.7;
  }

  .--circle-edit {
    width: 3rem;
    height: 3rem;
    background-color: #0d6efd;
    margin: 0 auto;
  }

  .--circle-edit svg {
    stroke-width: 3;
  }

  .image--edit {
    width: 100%;
    height: 15rem;
    object-fit: cover;
    border-radius: 1rem;
    margin-bottom: 1rem;
  }

  .--label--special {
    text-align: left !important;
    position: relative;
    top: 0.1rem;
  }

  #error-update {
    font: normal normal 700 0.8rem/1rem var(--font-primary);
    color: #dc3545;
  }
</style>

<div class="container__modal" id="modal-update">
  <div class="custom__modal --edit">
    <button class="custom__modal__close" id="close-update">
      <i class="fa fa-times" aria-hidden="true"></i>
    </button>
    <div class="loader__box loader__initial" id="loader-update-text">
      <?php
      require "./components/loader.php"
        ?>
      <h4>Cargando...</h4>
    </div>
    <form id="content-principal-update" enctype="multipart/form-data" method="post">

      <div class="modal__circle --circle-edit">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24"
          viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none" stroke-linecap="round"
          stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
          <path d="M16 5l3 3" />
        </svg>
      </div>
      <h4 id="title--edit">Actualiza tu noticia</h4>
      <img src="" id="image-update" class="image--edit">

      <div class="create__blog__title --image">
        <label for="input-file">Ingresa una imagen si quieres cambiar la imagen actual :</label>
        <input type="file" name="image" id="input-file-update" class="form-control" accept="image/*">
      </div>
      <div class="create__blog__title mt-3">
        <label for="title">Escribe un titulo:</label>
        <input type="text" name="title" id="title-update" class="form-control" placeholder="Escribe un titulo..."
          max="200">
      </div>
      <div class="create__blog__title mt-3">
        <label for="category">Selecciona una categoria:</label>
        <select class="form-select" aria-label="Select category" id="categorias" name="category">
        </select>
      </div>
      <div class="create__blog__title">
        <label class="mt-3">Escribe tu articulo:</label>
        <div class="create__blog__editor">
          <div id="editor-container">
          </div>
        </div>
      </div>
      <div class="form-check mt-3 create__blog__title">
        <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="importante">
        <p class="form-check-label m-0 --label--special " for="flexCheckChecked">
          ¿Esto es importante?
        </p>
      </div>
      <span id="error-update"></span>
      <div class="modal__actions modal__actions--edit">
        <button class="openModalUpdate" id="close-update">Cancelar</button><button
          id="button-update">Actualizar</button>
      </div>
    </form>
    <div class="loader__box loader__initial" id="state-update">
      <?php
      require "./components/loader.php"
        ?>
      <h4>Actualizando...</h4>
    </div>
  </div>
</div>
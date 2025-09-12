<style>
  .nav-product {
    display: flex;
  }
  .modal__create__container__categoria {
    background: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
    max-width: 80%;
    width: 100%;
    height: max-content;
    max-height: 720px;
    overflow: auto;
  }
  .modal__create__container__marca{
    background: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
    max-width: 80%;
    width: 100%;
    height: max-content;
    max-height: 720px;
    overflow: auto;
  }
  .modal__create__container{
    background: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
    max-width: 80%;
    width: 100%;
    height: max-content;
    max-height: 720px;
    overflow: auto;
  }

  .modal__create__bg__categoria {
    width: 100%;
    height: 100vh;
    overflow: auto;
    position: fixed;
    background: #0003;
    z-index: 5000000000;
    display: grid;
    place-items: center;
    padding: 1rem 2rem;
    left: 0;
    top: 0;
    transition: 0.3s;

  }

  .modal__create__bg__marca {
    width: 100%;
    height: 100vh;
    overflow: auto;
    position: fixed;
    background: #0003;
    z-index: 5000000000;
    display: grid;
    place-items: center;
    padding: 1rem 2rem;
    left: 0;
    top: 0;
    transition: 0.3s;

  }
  .modal-active {
    visibility: hidden;
    opacity: 0;
  }

  .modalmarca-active {
    visibility: hidden;
    opacity: 0;
  }


  .container {
    display: none;
  }

  @media (min-width: 770px) {
    .container {
      display: block;
      width: 230px;
    }

    .modal__create__bg__marca {
      grid-template-columns: 230px auto;
    }
    .modal__create__bg__categoria {
      grid-template-columns: 230px auto;
    }


    
  }

  .title {
    background-color: #252b3d;
    width: 100%;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .title p {
    margin: 0;
    color: #fff;
    font-weight: bold
  }

  .title button {
    border-radius: 5rem;
    display: grid;
    place-items: center;
    border: none;
    background-color: #fff2;
    width: 30px;
    height: 30px;
  }

  .title i {
    color: white;
  }

  .input__container label {
    font-weight: 400;
  }

  .input__container {
    margin-bottom: 1rem;
  }

  .input__container label span {
    color: #FE4164;
  }

  .add-padding {
    padding: 3rem;
  }

</style>

<script type="text/javascript" src="../js/categoria_producto.js?rev=<?php echo time(); ?>"></script>
<script type="text/javascript" src="../js/marca_producto.js?rev=<?php echo time(); ?>"></script>

<div class="modal__create__bg__categoria modal-active" id="modal">
  <div class="container">

  </div>
  <div class="modal__create__container__categoria">
    <div class="title">
      <p>Nueva categoria</p>
      <button onclick="closeModal()">
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
    </div>
    <div class="modal__form">
      <input type="hidden" id="txt_id">
      <div class="input__container">
        <label for="nombre">Nombre <span>*</span></label>
        <input type="text" id="descripcion-categoria" class="form-control" required />
      </div>

      <div class="input__container">
        <label for="detalle">Detalle <span>*</span></label>
        <input type="text" id="detalle-categoria" class="form-control" required />
      </div>

      <div class="input__container">
        <label for="create">Fecha creación <span>*</span></label>
        <input value="<?= date('d/m/y') ?>" type="text" id="fh_creacion-categoria" class="form-control" disabled="true"
          required />
      </div>

    
        <div class="modal__create__buttons">
          <div class="modal__create__buttons__container">
            <button class="btn btn-danger" onclick="cancelarCategoria()">Cancelar</button>
            <button class="btn btn-primary" onclick="registrarCategoria()">Registrar</button>
          </div>
        </div>
      
      
    </div>
  </div>
</div>

<div class="modal__create__bg__marca modalmarca-active " id="modalmarca">
  <div class="container">

  </div>
  <div class="modal__create__container__marca ">
    <div class="title">
      <p>Nueva marca</p>
      <button onclick="switchModalMarca()">
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
    </div>
    <div class="modal__form">
      <input type="hidden" id="txt_id">
      <div class="input__container">
        <label for="nombre">Nombre <span>*</span></label>
        <input type="text" id="descripcion-marca" class="form-control" required />
      </div>

      <div class="input__container">
        <label for="create">Fecha creación <span>*</span></label>
        <input value="<?= date('d/m/y') ?>" type="text" id="fh_creacion-marca" class="form-control" disabled="true"
          required />
      </div>
      <div class="modal__create__buttons">
        <div class="modal__create__buttons__container">
          <button class="btn btn-danger" onclick="cancelarMarca()">Cancelar</button>
          <button class="btn btn-primary" onclick="registrarMarca()">Registrar</button>
        </div>
      </div>
    </div>
  </div>
  </div>
<script>

  function closeModal()
  {
    const $modal = document.getElementById("modal")
    $modal.classList.toggle("modal-active")
  }
  function switchModalMarca()
  {
    const $modal = document.getElementById("modalmarca")
    $modal.classList.toggle("modalmarca-active")
  }
  

 

</script>
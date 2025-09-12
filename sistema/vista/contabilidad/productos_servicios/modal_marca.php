<style>
  .nav-product {
    display: flex;
  }

  .modal-active {
    visibility: hidden;
    opacity: 0;
  }

  .modal__create__bg {
    width: 100%;
    height: 100vh;
    overflow: auto;
    position: fixed;
    background: #0003;
    z-index: 50000;
    display: grid;
    place-items: center;
    padding: 1rem 2rem;
    left: 0;
    top: 0;
    transition: 0.3s;
  }

  .container {
    display: none;
  }

  @media (min-width: 770px) {
    .container {
      display: block;
      width: 230px;
    }

    .modal__create__bg {
      grid-template-columns: 230px auto;
    }
  }

  .modal__create__container {
    background: #fff;
    border-radius: 0.5rem;
    overflow: hidden;
    max-width: 80%;
    width: 100%;
    height: max-content;
    max-height: 720px;
    overflow: auto;
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

  .modal__form {
    padding: 2rem;
  }

  .modal__create__buttons {
    width: 100%;
    display: flex;
    justify-content: end;
    margin-top: 2rem;
  }

  .modal__create__buttons__container {
    display: flex;
    gap: 1rem;
  }

  .add-padding {
    padding: 3rem;
  }
</style>

<script type="text/javascript" src="../js/marca_producto.js?rev=<?php echo time(); ?>"></script>

<div class="modal__create__container ">
    <div class="title">
      <p>Nueva marca</p>
      <button onclick="switchModal()">
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
    </div>
    <div class="modal__form">
      <input type="hidden" id="txt_id">
      <div class="input__container">
        <label for="nombre">Nombre <span>*</span></label>
        <input type="text" id="descripcion" class="form-control" required />
      </div>

      <div class="input__container">
        <label for="create">Fecha creación <span>*</span></label>
        <input value="<?= date('d/m/y') ?>" type="text" id="fh_creacion" class="form-control" disabled="true"
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
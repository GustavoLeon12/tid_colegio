<style>
  .form-venta {
    padding: 3rem 2rem;
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
</style>

<script type="text/javascript" src="../js/venta.js?rev=<?php echo time(); ?>"></script>

<div class="modal__create__bg " id="modal">
  <div class="container"></div>
  <div class="modal__create__container ">
    <div class="title">
      <p>Agregar producto o servicio</p>
      <button onclick="switchModal()">
        <i class="fa fa-times" aria-hidden="true"></i>
      </button>
    </div>
    <div class="modal__form">
      <div class="row">
        <input type="hidden" id="txt_id">
        <div class="input__container">
          <label for="producto">Producto/Servicio<span>*</span></label>
          <select name="producto" id="producto" class="form-control">
            <option value="1">Valor 1</option>
            <option value="2">Valor 1</option>
            <option value="3">Valor 1</option>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="input__container col-">
          <label for="create">Fecha creación <span>*</span></label>
          <input value="<?= date('d/m/y') ?>" type="text" id="fh_creacion" class="form-control" disabled="true"
            required />
        </div>
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

<div class="col-md-12">
  <div class="box box-warning" id="content">
    <div class="box-header with-border" id="Titulo_Center">
      <h5 class="box-title"><strong>Nueva venta</strong></h5>
    </div>
    <div class="form-venta">
      <div class="row">
        <div class="col-xs-4">
          <label for="vendedor">Vendedor</label>
          <select name="vendedor" class="form-control" id="vendedor">
            <option value="1">Administrador</option>
            <option value="1">Administrador</option>
            <option value="1">Administrador</option>
          </select>
          <br>
        </div>
        <div class="col-xs-4">
          <label for="fech-emision">Fecha emisión</label>
          <input type="date" class="form-control" name="fech-emision" id="fech-emision">
        </div>
        <div class="col-xs-4">
          <label for="fech-vencimiento">Fecha vencimiento</label>
          <input type="date" class="form-control" name="fech-vencimiento" id="fech-vencimiento">
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <label for="comprobante">Tipo comprobante</label>
          <select class="form-control" name="comprobante" id="comprobante">
            <option value="FACTURA">Factura electrónica</option>
            <option value="BOLETA">Boleta</option>
          </select>
          <br>
        </div>

        <div class="col-xs-4">
          <label for="serie">Serie</label>
          <select class="form-control" name="serie" id="serie">
            <option value="B001">B001</option>
            <option value="F001">F001</option>
          </select>
          <br>
        </div>

        <div class="col-xs-4">
          <label for="moneda">Moneda</label>
          <select class="form-control" name="moneda" id="moneda">
            <option value="PEN">Soles</option>
            <option value="USD">Dolares</option>
          </select>
          <br>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <label for="cambio">Tipo de cambio</label>
          <input type="number" name="cambio" id="cambio" class="form-control">
          <br>
        </div>

        <div class="col-xs-4">
          <label for="operacion">Tipo de operación</label>
          <input type="number" name="operacion" id="operacion" class="form-control">
          <br>
        </div>
        <div class="col-xs-4">
          <label for="cliente">Cliente</label>
          <select class="form-control" name="cliente" id="cliente">
            <option value="1">Cliente 1</option>
            <option value="2">Cliente 2</option>
          </select>
          <br>
        </div>
      </div>
      <div class="row">
        <button class="btn btn-info">Registrar producto o servicio</button>
      </div>

      <div>
        <table id="table_select">
          <thead>
            <tr>
              <th>N°</th>
              <th>Descripción</th>
              <th>Unidad</th>
              <th>Cantidad</th>
              <th>Valor U.</th>
              <th>Precio U.</th>
              <th>Subtotal</th>
              <th>Total</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>

      </div>

      <div>
        <button class="btn btn-danger">Cancelar</button>
        <button class="btn btn-primary">Generar nueva venta</button>
      </div>

    </div>
  </div>
</div>


<script>
  function switchModal() {
    const $modal = document.getElementById("modal")
    $modal.classList.toggle("modal-active")
  }
</script>
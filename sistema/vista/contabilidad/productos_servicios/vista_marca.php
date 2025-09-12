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
<?php
  require ("marca.php")
?>

<div class="col-md-12">
  <div class="box box-warning" id="content">
    <div class="box-header with-border nav-product" id="Titulo_Center">
      <h5 class="box-title"><strong>Litado de marcas</strong></h5>
      <button class="btn btn-primary" onclick="switchModal()"> <i class="fa fa-plus" aria-hidden="true"></i>
        Nuevo </button>
    </div>
    <div class="add-padding">
      <div class="form-group">
        <div class="row">
          <div class="col-xs-4 clasbtn_exportar">
            <div class="input-group" id="btn-place"></div>
          </div>

          <div class="col-md-6 pull-right">
            <div class="alin_global">
              <input type="text" class="global_filter form-control " id="global_filter"
                placeholder="Ingresar dato a buscar" style=" width: 100%">
            </div>
          </div>


        </div>
      </div>
      <table id="tabla_data" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Nombre</th>
            <th>Fecha creación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<script>
  function switchModal()
  {
    const $modal = document.getElementById("modal")
    $modal.classList.toggle("modal-active")
  }
  $(document).ready(function ()
  {
    listar_marca();
  });
</script>
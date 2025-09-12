<?php
session_start();
?>

<script type="text/javascript" src="../js/caja.js?rev=<?php echo time(); ?>"></script>

<div class="col-md-4">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">REGISTRAR NUEVA CAJA  </h3>
      <!-- /.box-tools -->
      <style type="text/css">
        #tabla_categoria {
          border: 1px solid #ffffff;
          border-radius: 10px;
          background-color: #f5f7f7;
        }
      </style>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <input type="hidden" value="" id="id">
      <div class="col-lg-12">
        <label for="montoInicial">Monto inicial</label>
        <input type="text" class="form-control" id="montoInicial" placeholder="Ingresa el monto inicial"><br>
      </div>
      <div class="col-lg-12">
        <label for="apertura">Apertura</label>
        <input type="text" class="form-control" id="apertura" placeholder="Ingrese el monto de apertura"><br>
      </div>
      <div class="col-lg-12">
        <label for="cierre">Cierre</label>
        <input type="text" class="form-control" id="cierre" placeholder="Ingrese monto de cierre"><br>
      </div>
      <div class="col-lg-12">
        <label for="montoFinal">Monto Final</label>
        <input type="text" class="form-control" id="montoFinal" placeholder="Ingrese el monto final"><br>
      </div>
      <div class="col-lg-12">
        <label for="montoReferencial">Monto Referencial</label>
        <input type="text" class="form-control" id="montoReferencial" placeholder="Ingrese el monto referencial"><br>
      </div>
      <div class="col-lg-12">
        <label for="codSucursal">Código sucursal</label>
        <select id="codSucursal" class="form-control"></select>
      </div>
      <input type="hidden" id="usuario" value="<?= $_SESSION["S_IDENTYTI"] ?>">

    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-sm" onclick="registrar()"><i
          class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
      <button type="button" class="btn btn-default btn-sm" onclick="limpiar()"><i
          class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>




<div class="col-md-8">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">CAJA</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
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
      <table id="table_select" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Monto inicial</th>
            <th>Apertura</th>
            <th>Cierre</th>
            <th>Monto Final</th>
            <th>Monto Referencial</th>
            <th>Estado</th>
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
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>



<script>
  $(document).ready(function ()
  {
    listar();
  });
</script>
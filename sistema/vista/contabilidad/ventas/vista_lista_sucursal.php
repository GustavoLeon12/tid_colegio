<script type="text/javascript" src="../js/sucursal.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-4">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">REGISTRAR NUEVO ESTABLECIMIENTO</h3>
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
        <label for="">Código sucursal</label>
        <input type="text" class="form-control" id="codigoSucursal" placeholder="Ingrese código sucursal"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Denominación</label>
        <input type="text" class="form-control" id="denominacion" placeholder="Ingrese denominación"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Dirección</label>
        <input type="text" class="form-control" id="direccion" placeholder="Ingrese dirección"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Ubigeo</label>
        <select name="ubigeo" id="ubigeo" class="form-control">
          <?php
          require '../../alumno/options_ubigeo.php'
            ?>
        </select>
        <br>
      </div>
      <div class="col-lg-12">
        <label for="">Código SUNAT</label>
        <input type="text" class="form-control" id="codigoSunat" placeholder="Ingrese código SUNAT"><br>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="activo">
        <label class="form-check-label" for="activo">Activado</label>
      </div>

    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-sm" onclick="registrarSucursal()"><i
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
      <h3 class="box-title">BIENVENIDO CONTENIDO DE SUCURSAL</h3>

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
            <th>Código sucursal</th>
            <th>Denominación</th>
            <th>Dirección</th>
            <th>Ubigeo</th>
            <th>Código SUNAT</th>
            <th>Activo</th>
            <th>Acción</th>
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
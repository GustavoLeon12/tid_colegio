<script type="text/javascript" src="../js/categoria.js?rev=<?php echo time(); ?>"></script>


<div class="col-md-4">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">REGISTRAR NUEVA CATEGORIA</h3>
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
      <div class="col-lg-12">
        <label>Fecha Registro</label>
        <div class=" input-group">
          <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
          </div>
          <input type="text" id="txtfecharegistro" name="txtfecharegistro" readonly
            style="color: rgb(25,25,51); background-color: rgb(255,255,255);solid 5px;color:#9B0000; text-align:center;font-weight: bold; border-radius: 5px;"
            class="form-control"><br>
        </div><br>
      </div>

      <div class="col-lg-12">
        <input type="text" name="" id="txt_id" hidden>
        <label for="">C&oacute;digo</label>
        <input type="text" class="form-control" id="codigocat" placeholder="Ingrese codigo"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Nombre</label>
        <input type="text" class="form-control" id="txt_nom_cat" placeholder="Ingrese nombre"><br>
      </div>


    </div>
    <div class="modal-footer">
      <button class="btn btn-primary btn-sm" onclick="Registrar_cat()"><i
          class="fa fa-check"><b>&nbsp;Registrar</b></i></button>
      <button type="button" class="btn btn-default btn-sm" onclick="LimpiarRegistroCat()"><i
          class="fa fa-close"><b>&nbsp;Cerrar</b></i></button>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>




<div class="col-md-8">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">BIENVENIDO CONTENIDO DE CATEGORIA</h3>

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
      <table id="tabla_categoria" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>Orden</th>
            <th>Código</th>
            <th>Nombre</th>

            <th>Acci&oacute;n</th>
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
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>



<script>
  $(document).ready(function ()
  {
    $("#refres_add").hide();
    var f = new Date();
    txtfecharegistro.value = f.getFullYear() + "-" + (f.getMonth() + 1) + "-" + f.getDate();

    $('.js-example-basic-single').select2();
    listar_cat();

    $("#modal_regist_cat").on('shown.bs.modal', function ()
    {
      $("#txt_nom_cat").focus();
    });


  });
</script>
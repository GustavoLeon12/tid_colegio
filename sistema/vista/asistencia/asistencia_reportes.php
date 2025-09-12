<script type="text/javascript" src="../js/asistencia.js?rev=<?php echo time(); ?>"></script>
<script>
  Listar_combo_gradosAsistencia_by()
</script>
<div class="col-md-12">
  <div class="box box-warning ">
    <div class="box-header with-border">
      <h3 class="box-title" style="text-align: center;">
        <center>REPORTES DE ASIATENCIAS DE ALUMNOS</center>
      </h3>
    </div>
    <input type="hidden" id="nivelIdHidden">
    <input type="hidden" id="gradoIdHidden">
    <input type="hidden" id="seccionIdHidden">
    <!-- /.box-header -->
    <div class="box-body">
      <div class="box-body">
        <div class="row">
          <div class="col-md-3">
            <label>Seleccione Grado</label>
            <select class="js-example-basic-single form-control"  name="state" id="cbm_grado_by" style="width:100%;"
              onchange="ShowSelectedBy();">
            </select>
          </div>
          <div class="col-md-3">
            <label>Nivel</label>
            <input type="text" name="" id="txt_nivelId" hidden>

            <input type="text" name="" class="form-control" id="txt_nivel_nivel" disabled>

          </div>
          <div class="col-md-3">
            <label>Sección</label>
            <input type="text" name="" class="form-control" id="text_seccion" disabled>
          </div>


        </div>
        <div class="row">
          <div class="col-xs-3">
            <label for="">Fecha Inicio</label>
            <input type="date" class="form-control" id="reportFechainicio" placeholder=""
              style="border-radius: 5px;"><br>
          </div>
          <div class="col-xs-3">
            <label for="">Fecha Final</label>
            <div class="alin_global">
              <input type="date" class="form-control" id="reportFechafin" placeholder="" style="border-radius: 5px;">
              &nbsp;
              <button onclick="Estraer_Lista_Range_Alum();" class="btn " type="submit" name="search"
                id="but_alin_global" class="btn btn-flat"
                style="font-size: 10px; background-color: #3894c9; color: white">
                <em class="fa fa-search"></em>
              </button>
            </div>

          </div>


        </div>
        <div class="row">
          <div class="col-xs-4">
            <div class="input-group">
              <label for="">Filtrar búsqueda</label>
              <input type="text" class="global_filter form-control" id="global_filter"
                placeholder="Ingresar dato a buscar" style="border-radius: 5px; width: 100%">
            </div>
            <br>

          </div>

        </div>
        <table id="table_alumno" class="display responsive nowrap" style="width:100%">
          <thead>
            <tr>
              <th>N°</th>
              <th>Apellidos</th>
              <th>Nombres</th>
              <th>Fechas</th>
              <th>Estado</th>
              <th>Indicador</th>

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


            </tr>
          </tfoot>
        </table>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function ()
  {
    $("#refres_add").hide();
  });
</script>
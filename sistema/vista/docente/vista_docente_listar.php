<style>
  .input__search {
    position: relative;
    overflow: hidden;
  }

  .input__search button {
    position: absolute;
    right: 0;
    top: 0;
    border: none;
    height: 100%;
    border-radius: 0.5rem;
    transition: 0.3s
  }

  .input__search button:hover {
    filter: brightness(0.8);
  }

  .lds-dual-ring {
    display: inline-block;
    width: 16px;
    height: 16px;
  }

  .lds-dual-ring:after {
    content: " ";
    display: block;
    width: 16px;
    height: 16px;
    margin: 2px 0 0 0;
    border-radius: 50%;
    border: 2px solid #333;
    border-color: #333 transparent #333 transparent;
    animation: lds-dual-ring 1.2s linear infinite;
  }

  @keyframes lds-dual-ring {
    0% {
      transform: rotate(0deg);
    }

    100% {
      transform: rotate(360deg);
    }
  }

  .error__dni {
    color: #dd4b39;
    font-weight: 600;
    font-style: italic;
  }
</style>
<script src="../js/obtener_por_dni.js"></script>
<script type="text/javascript" src="../js/docentes.js?rev=<?php echo time(); ?>"></script>
<div class="col-md-12" id="div_tabla_docente">
  <div class="box box-warning ">
    <style type="text/css">
      #tabla_docente {
        border: 1px solid #ffffff;
        border-radius: 10px;
        background-color: #f5f7f7;
      }
    </style>
    <div class="box-body">
      <div class="row">
        <div class="col-xs-4 clasbtn_exportar">
          <div class="alin_global">
            <div class="input-group" id="btn-place"></div>
          </div>
        </div>
        <div class="col-xs-1">
        </div>
        <div class="col-xs-7 pull-right">
          <div class="alin_global">
            <input type="text" class="global_filter form-control " id="global_filter"
              placeholder="Ingresar dato a buscar" style=" width: 100%">&nbsp;&nbsp;<button
              onclick="Abrir_Modal_Registro();" class="btn-sm" id="but_alin_global">
              <em class="glyphicon glyphicon-plus"></em>
            </button>
          </div>
        </div>
      </div><br>
      <table id="tabla_docente" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>DNI</th>
            <th>Nivel</th>
            <th>Telefono</th>
            <th>Tipo</th>
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


<div class="col-md-12" id="div_docenteRegitrer" style="display: none;">
  <div class="box box-warning ">
    <div class="box-header with-border titulosclass" id="Titulo_Center">
      <h5 class="box-title" style="text-align: center;"><strong><label id="regiterEdit"></label> de Docentes</strong>
      </h5>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="remove" title="" data-original-title="Remove"
          onclick="canselar_Registro();">
          <em class="fa fa-close"></em>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="col-xs-12">
        <div class="row">
          <div class="col-md-3">
            <label>Nombres</label>
            <input type="text" id="id_docente" hidden>
            <input type="text" name="" class="form-control" id="txt_docnombre" onkeypress="return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
          </div>
          <div class="col-md-3">
            <label>Apellidos</label>
            <input type="text" name="" class="form-control" id="txt_apedocente" onkeypress="return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
          </div>
          <div class="col-md-3">
            <label for="">Tipo de documento</label>
            <div class="input__search">
              <select name="tp_docu" id="tp_docu" class="form-control"
                onchange="elegirTipoDocu('tp_docu','btn-id-docente')">
                <option value="1">DNI</option>
                <option value="4">Carnet de extranjeria</option>
                <option value="6">RUC</option>
                <option value="7">Pasaporte</option>
              </select>
            </div>
          </div>
          <div id="cont_dniem_error" class="form-group">
            <div class="col-md-3">
              <label>DNI-Docente</label>
              <div class="input__search">
                <input type="number" name="" class="form-control" id="txt_dni_docente">
                <button id="btn-id-docente"
                  onclick="consultarDNI('btn-id-docente','txt_dni_docente', 'txt_apedocente', 'txt_docnombre',)">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                    <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2" />
                    <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                    <path d="M8 11h4" />
                    <path d="M8 15h3" />
                    <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                    <path d="M18.5 19.5l2.5 2.5" />
                  </svg>
                </button>
              </div>
              <span class="error__dni"></span>
            </div>

          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>E-mail</label>
            <input type="email" name="" class="form-control" id="txt_email"
              onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)"><br>
          </div>
          <div class="col-md-3">
            <label>Teléfono</label>
            <input type="number" id="id_colegio" hidden>

            <input type="text" name="" class="form-control" id="txt_telefo"><br>
          </div>
          <div class="col-md-3">
            <div id="cont_codigo_error" class="form-group">
              <label>Código</label>

              <input type="number" name="" class="form-control" id="txt_codigo"><br>
            </div>
          </div>
          <div class="col-md-3">
            <label for="">Ubigeo</label>
            <div class="input__search">
              <select name="ubigeo" id="ubigeo" class="form-control">
                <?php
                require '../alumno/options_ubigeo.php'
                  ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label>Nivel(*)</label>
            <select class="js-example-basic-single" name="state" id="cbm_nivel" style="width:100%;">
            </select><br><br>
          </div>

          <div class="col-md-3">
            <label>Tipo-Docente</label>
            <select class="js-example-basic-single" name="state" id="cbm_tipo" style="width:100%;">
              <option value="">--Seleccione--</option>
              <option value="CONTRATADO">CONTRATADO</option>
              <option value="NOMBRADO">NOMBRADO</option>
            </select><br><br>
          </div>

          <div class="col-md-3">
            <label>Facebook</label>
            <input type="text" name="" value="" class="form-control" id="txt_facebook" />
          </div>

          <div class="col-md-3">
            <label>Foto</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*"><br>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <img class="loader" src="../Login/vendor/abc.gif" style="width: 50px;height:50px;display: none;">
        <button class="btn btn-primary btn-sm" id="button_resgist" onclick="Registro_Docentes();"><i
            class="fa fa-check"><b>&nbsp;Guardar</b></i></button>

        <button type="button" class="btn btn-default btn-sm" onclick="canselar_Registro()"><i
            class="fa fa-close"><b>&nbsp;Cancelar</b></i></button>
      </div>
    </div>

  </div>
</div>





<script>
  $(document).ready(function ()
  {
    $("#refres_add").hide();
    listar_docentesRegistrados();
    $('.js-example-basic-single').select2();
  });
</script>
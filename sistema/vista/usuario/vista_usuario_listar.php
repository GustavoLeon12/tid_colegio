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
<script type="text/javascript" src="../js/usuario.js?rev=<?php echo time(); ?>"></script>

<div class='col-lg-12' style='border-color: #f5c6cb;' id="tutotiales_Id">
  <div id='user_avisomanual' class='alert  sm' role='alert' style='color: #0e0102; background-color: #accbef;'><button
      type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    Para crear un nuevo usuario pues dirigiste a las siguiente vista solo da clik en. Gracias!!. &nbsp;<span
      class='label label-info'><em class="fa fa-plus"></em></span>&nbsp; Para activar o desactivar usuarios da clik en
    <span class='label label-defult'><em class="fa fa-eye"></em></span>

  </div>
</div>

<div class='col-lg-12' style='border-color: #f5c6cb; display: none' id='cret_avisomanual'>
  <div class='alert  sm' role='alert' style='color: #0e0102; background-color: #accbef;'><button type="button"
      class="close" data-dismiss="alert" aria-hidden="true">×</button>
    Para crear usuarios /perfiles seleccione el tipo de usuario que deseas crear luego presione en : <em
      class="fa fa-search"></em> para extraer su datos requerido pero..&nbsp; si deseas crear otro tipo de puedes
    ingresar los datos..&nbsp;Puedes genera la contraseña manual/automática presione en:<em class="fa fa-lock"></em>
    Para registra usuario seleccione en <em class="fa fa-check"></em>..Para cancelar la operacion precione en <em
      class="fa fa-times"></em> Gracias por su atencion..!

  </div>
</div>

<div class="col-md-12" id="DivTableAlumno" style="display: none;">
  <div class="box box-warning ">
    <form autocomplete="false" id="from" onsubmit="return false" action="#" enctype="multipart/form-data"
      onsubmit="return false">
      <div class="box-header with-border">
        <h3 class="box-title">Resgistro de nuevo usuario</h3>
        <div class="box-tools pull-right">

          <button type="button" class="btn btn-box-tool" data-widget="remove" title="" data-original-title="Remove"
            onclick="Limpiar_Registrar_Usuario()">
            <em class="fa fa-times"></em></button>&nbsp;
          <button type="button" class="btn btn-box-tool" data-widget="collapse" id="button_resgist"
            data-original-title="Collapse" onclick="Registrar_Usuario()">
            <em class="fa fa-check"></em></button>



        </div>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-xs-12">
            <div class="col-md-4">
              <label for="">Docente</label>
              <div class="alin_global">
                <select class="js-example-basic-single" name="state" id="cbm_docente" style="width:100%;">

                </select>&nbsp;&nbsp;<button onclick="Estraer_Datos_Docentes();" class="btn-sm" id="but_alin_global">
                  <em class="fa fa-search"></em>
                </button>
              </div>
              <br>
            </div>
            <div class="col-md-4">
              <label for="">Alumnos</label>
              <div class="alin_global">
                <select class="js-example-basic-single" name="state" id="cbm_alumno" style="width:100%;">

                </select>&nbsp;&nbsp;<button onclick="Estraer_Datos_Alumno();" class="btn-sm" id="but_alin_global">
                  <em class="fa fa-search"></em>
                </button>
              </div>
              <br>
            </div>
          </div>
          <br>
          <div class="col-xs-12">
            <div class="col-md-4">
              <label for="">Nombre</label>
              <input type="text" id="txt_dniUSU_golval" hidden="true"><br>
              <input type="text" class="form-control" id="txt_nombre" placeholder="Ingrese nombre" onkeypress="return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
            </div>


            <div class="col-md-4">
              <label for="">Apellidos</label>
              <input type="text" class="form-control" id="txt_apellido" placeholder="Ingrese apellido" onkeypress="return (event.charCode > 64 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||
             (event. charCode > 31 && event.charCode < 33)"><br>
            </div>

            <div class="col-md-4">
              <label for="">Usuario (Login)</label>
              <input type="text" class="form-control" id="txt_usuario" placeholder="Ingrese usuario"
                onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
             (event. charCode > 96 && event.charCode < 123)||(event. charCode >47 && event.charCode<58)||(event. charCode>44 && event. charCode<47)||(event. charCode==95)"><br>
            </div>
          </div>

          <div class="col-xs-12">
            <div class="col-md-4">
              <label for="">Contraseña generado</label>
              <div class="alin_global ">
                <div class="input-group" style="width: 100%">
                  <input type="password" class="form-control" id="contra"
                    onkeypress="return (event.charCode > 63 &&   event.charCode < 91) ||
                       (event. charCode > 96 && event.charCode < 123)||(event. charCode >34 && event.charCode<39)||(event. charCode>47 && event. charCode<58)||(event. charCode==42)">
                  <span class="input-group-btn">&nbsp;&nbsp;
                    <button onclick="mostrarPassword()" type="button" class="btn btn-secondary"><em id="iconoeyes"
                        class="fa fa-eye-slash"></em></button></span>
                </div>
                &nbsp;&nbsp;
                <button onclick="General_Contrasena_Alum();" type="button" class="btn btn-secondary"><em
                    class="fa fa-lock"></em></button>
              </div>

            </div>
            <div class="col-md-4">
              <label for="">Rol</label>
              <select class="js-example-basic-single" name="state" id="cbm_rol" style="width:100%;">

              </select><br><br>
            </div>
            <div class="col-md-4">
              <label for="">Imagen (Foto Perfil)</label>
              <!-- <div class="widget-user-image">
                <img class="img-circle" alt="User Image" id="perfil_mostrarimagen" width="50px" height="50px"
                  style="display: none">
              </div> -->
              <ul class="nav nav-stacked">
                <input type="file" class="form-control" id="perfil_seleccionararchivo"
                  accept="image/x-png,image/gif,image/jpeg" style="border-radius: 5px;"><br>
              </ul>
              <input type="hidden" name="image_hidden" id="image_hidden" value="">
            </div>

          </div>
          <div class="col-xs-12">
            <div class="col-md-4">
              <label for="">Tipo de documento</label>
              <div class="input__search">
                <select name="tp_docu" id="tp_docu" class="form-control" onchange="elegirTipoDocu('tp_docu','btn-id')">
                  <option value="1">DNI</option>
                  <option value="4">Carnet de extranjeria</option>
                  <option value="6">RUC</option>
                  <option value="7">Pasaporte</option>
                </select>
              </div>
            </div>
            <div class="col-xs-4">
              <label for="">N° DNI</label>
              <div class="input__search">
                <input type="number" class="form-control" id="txt_dni" placeholder="Ingrese DNI">
                <button id="btn-id" onclick="consultarDNI('btn-id','txt_dni', 'txt_apellido', 'txt_nombre',)">
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
            <br>
            <br>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<!-- /.box -->


<div class="col-md-12" id="div_tabla_usuario">
  <div class="box box-warning ">
    <style type="text/css">
      #tabla_usuario {
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
              onclick="AbrirModalRegistro();" class="btn-sm" id="but_alin_global">
              <em class="glyphicon glyphicon-plus"></em>
            </button>
          </div>
        </div>
      </div><br>
      <table id="tabla_usuario" class="display responsive nowrap" style="width:100%">
        <thead>
          <tr>
            <th>N°</th>
            <th>Usuario</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th>Estatus</th>
            <th>Act./Des.</th>
            <th>Quitar</th>
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
    $("#refres_add").hide();
    listar_usuario();
    $('.js-example-basic-single').select2();
  });

  function mostrarPassword()
  {
    var cambio = document.getElementById("contra");
    if (cambio.type == "password") {
      cambio.type = "text";
      $('#iconoeyes').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
    } else {
      cambio.type = "password";
      $('#iconoeyes').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
    }
  }

  document.getElementById("perfil_seleccionararchivo").addEventListener("change", () =>
  {
    $("#perfil_mostrarimagen").show();
    var archivoseleccionado = document.querySelector("#perfil_seleccionararchivo");
    var archivos = archivoseleccionado.files;
    var imagenPrevisualizacion = document.querySelector("#perfil_mostrarimagen");
    // Si no hay archivos salimos de la función y quitamos la imagen
    if (!archivos || !archivos.length) {
      imagenPrevisualizacion.src = "";
      return;
    }
    // Ahora tomamos el primer archivo, el cual vamos a previsualizar
    var primerArchivo = archivos[0];
    // Lo convertimos a un objeto de tipo objectURL
    var objectURL = URL.createObjectURL(primerArchivo);
    // Y a la fuente de la imagen le ponemos el objectURL
    imagenPrevisualizacion.src = objectURL;
  });
</script>
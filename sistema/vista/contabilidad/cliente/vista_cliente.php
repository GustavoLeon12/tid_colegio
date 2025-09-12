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

<script type="text/javascript" src="../js/cliente.js?rev=<?php echo time(); ?>"></script>
<script src="../js/obtener_por_dni.js"></script>

<div class="col-md-4">
  <div class="box box-warning ">
    <div class="box-header titulosclass" id="Titulo_Center">
      <h3 class="box-title">REGISTRAR NUEVO CLIENTE </h3>
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
        <label for="">Nombre</label>
        <input type="text" class="form-control" id="nombre" placeholder="Ingrese el nombre"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Apellido</label>
        <input type="text" class="form-control" id="apellido" placeholder="Ingrese el apellido"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Correo electronico</label>
        <input type="text" class="form-control" id="correo" placeholder="Ingrese el correo electronico"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Telefono</label>
        <input type="text" class="form-control" id="telefono" placeholder="Ingrese el número de telefono"><br>
      </div>

      <div class="col-lg-12">
        <label for="">Dirección</label>
        <input type="text" class="form-control" id="direccion" placeholder="Ingrese la dirección"><br>
      </div>
      <div class="col-lg-12">
        <label for="">Ubigeo</label>
        <select name="ubigeo" id="fkUbigeo" class="form-control">
          <?php
          require '../../alumno/options_ubigeo.php'
            ?>
        </select>
        <br>
      </div>
      <div class="col-lg-12">
        <label for="">Tipo de documento</label>
        <div class="input__search">
          <select name="tp_docu" id="fkTpDocu" class="form-control" onchange="elegirTipoDocu('fkTpDocu','btn-id-alumno')">
            <option value="1">DNI</option>
            <option value="4">Carnet de extranjeria</option>
            <option value="6">RUC</option>
            <option value="7">Pasaporte</option>
          </select>
        </div>
        <br>
      </div>
      <div class="col-lg-12">
        <label for="">N° DNI</label>
        <div class="input__search">
          <input type="number" class="form-control" id="documento" placeholder="Ingrese DNI">
          <button id="btn-id-alumno"
            onclick="consultarDNI('btn-id-alumno','documento', 'nombre', 'apellido',)">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24"
              height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
              stroke-linejoin="round">
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
      <div class="col-lg-12">
        <br>
        <label for="">Tipo </label>
        <div class="input__search">
          <select name="" id="tipo" class="form-control">
            <option value="CLIENTE">Cliente</option>
            <option value="PROVEEDOR">Proveedor</option>
          </select>
        </div>
      </div>
 

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
      <h3 class="box-title">CLIENTES</h3>

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
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Correo</th> 
            <th>Telefono</th>
            <th>Documento</th>
            <th>Dirección</th>
            <th>Tipo</th>
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
  $(document).ready(function () {
    listar();
  });
</script>
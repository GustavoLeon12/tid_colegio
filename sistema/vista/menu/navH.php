<?php
require '../../global.php';
?>
<script src="../js/helper.js"></script>
<style>
  .more-menu-li {
    width: 100%;
    padding-left: 2.5rem;
  }

  .more-menu-li a {
    width: 100%;
    display: block;
    padding: 0.5rem;

  }

  .pointer-events-none {
    pointer-events: none;
  }

  .menu-links-hidden {
    overflow: hidden;
    height: 0;
  }

  .menu-open-arrows {
    rotate: -90deg;
  }
</style>
<aside class="main-sidebar">


  <style type="text/css">
  </style>

  <!-- sidebar: style can be found in sidebar.less  style="position: fixed;"  color logo #31AFB4   -->
  <section class="sidebar WhateverYourNavIs"><br>
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">

        <?php
        $url = $GLOBALS['images_user'];
        if (!empty($_SESSION['S_FILE_IMG'])) {
          echo "<img class='img-circle img1' onerror='verificarImagen(" . '"img1"' . ")' alt='User Image' src='$url" . $_SESSION['S_FILE_IMG'] . "' alt='' style'width: 50px;height:50px'>";
        } else {
          echo "<img class='img-circle'  onerror='verificarImagen(" . '"img1"' . ")' alt='User Image' src='$url/images.png' alt='' style'width: 50px;height:50px'>";
        }

        ?>

        <?php //echo "<img class='img-circle' alt='User Image' src='../imagenes/usuarios/".$_SESSION['S_FILE_IMG']."' alt='' style'width: 50px;height:50px'>" ?>
      </div>
      <div class="pull-left info">
        <p>
          <?php echo $_SESSION['S_NOMBRE']; ?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form class="sidebar-form" onsubmit="return false">
      <div class="input-group">
        <input type="text" class="form-control" id="searchbar" autocomplete="false" onkeyup="search_SidebarMain()">
        <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
          </button>
        </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu " data-widget="tree">
      <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','dashboard/dashboard.php')">
            <i class="fa fa-check"></i> <span style="cursor: pointer;">Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i> 
            </span>
          </a>
      </li>
      <!-- <li class="header">MAIN NAVIGATION</li>-->
      <li class=" treeview">
        <a onclick="cargar_contenido('contenido_principal','comunicados/vista_comunicados.php')">
          <em class="fa fa-inbox"></em> <span style="cursor: pointer;">Comunicados</span>
          <span class="pull-right-container">
            <em class="fa fa-labtop"></em>
            <em class="fa fa-angle-left pull-right"></em>
          </span>
        </a>
      </li>
      <?php

      if ($_SESSION['S_ROL'] == 'ADMINISTRADOR') {
        ?>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','usuario/vista_usuario_listar.php')">
            <i class="fa fa-user"></i> <span style="cursor: pointer;">Usuario</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>


        <style type="text/css">
          .treeview-menu li a:hover {
            background-color: #114887;
            border-radius: 5px;
          }
        </style>

        <li class="treeview">
          <a>
            <i class=" fa   fa-cog"></i> <span style="cursor: pointer;">Acad&eacute;mico</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','configuracion/config_yearscolar.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i> Año Escolar</a></li>
              <!--<li><a onclick="cargar_contenido('contenido_principal','configuracion/vista_fase_periodo.php')" style="cursor: pointer;"><i class="fa fa-circle-o"></i>Fase & periodo</a></li>-->

              <li><a onclick="cargar_contenido('contenido_principal','configuracion/vista_fase_escolar.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Fase Escolar</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','configuracion/vista_periodoevaluacion.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Periodo Evaluación</a></li>


            </ul>
          </a>
        </li>
        

        <li class="treeview">
          <a>
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Materia</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','curso/vista_listar_curso.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Cursos</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','curso/vista_cargaActividad_curso.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Carga Acad&eacute;mico</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','curso/vista_categoria_curso.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Categorías de curso</a></li>

            </ul>
          </a>
        </li>
        <li class="treeview">
          <a>
            <i class="glyphicon glyphicon-time"></i> <span style="cursor: pointer;">Horas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','jornadas/vista_horas_academicos.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Horas Académicos</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','jornadas/vista_listar_horaio_clases25.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar horarios</a></li>


            </ul>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="glyphicon glyphicon-education"></i> <span style="cursor: pointer;">Alumnos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','matricula/vista_matricula.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Matr&iacute;cula</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','alumno/vista_listar_alumnos.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar Alumnos</a></li>

            </ul>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa fa-lightbulb-o"></i> <span style="cursor: pointer;">Grados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','grado/vista_listar_grado.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar grados</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','grado/vista_config_grados.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Configuracións</a></li>

            </ul>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa fa-calendar-minus-o"></i> <span style="cursor: pointer;">Pensiones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','pagos/vista_listar_pagos.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Listar Pagos</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','pagos/reporte_pagos_fehas.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Pagos Por fechas</a></li>
            </ul>
          </a>
        </li>
        <li class="treeview">
          <a>
            <i class="fa fa-pencil-square-o"></i> <span style="cursor: pointer;">Notas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','notas/vista_registro_notas.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Registro</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','notas/vista_reporte_notas.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Reportes Notas</a></li>
              <li><a onclick="cargar_contenido('contenido_principal','notas/vista_notas_periodos.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Notas Periodos</a></li>

            </ul>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa fa-users"></i> <span style="cursor: pointer;">Asistencias</span><span
              class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li class="">
                <a onclick="cargar_contenido('contenido_principal','asistencia/vista_asistencia.php')">
                  <em class="fa fa-circle-o"></em>
                  <span style="cursor: pointer;">Asistencia</span>

                </a>
              </li>
              <li class="treeview">
                <a onclick="cargar_contenido('contenido_principal','asistencia/asistencia_reportes.php')">
                  <i class="fa fa-circle-o "></i>
                  <span style="cursor: pointer;">Reportes</span>

                </a>
              </li>

            </ul>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa fa-male"></i> <span style="cursor: pointer;">Docentes</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li class="">
                <a onclick="cargar_contenido('contenido_principal','docente/vista_docente_listar.php')">
                  <em class="fa fa-circle-o"></em>
                  <span style="cursor: pointer;">Docentes</span>

                </a>
              </li>
              <li class="">
                <a onclick="cargar_contenido('contenido_principal','docente/vista_congif_docente.php')">
                  <em class="fa fa-circle-o"></em>
                  <span style="cursor: pointer;">Asignar Grados</span>

                </a>
              </li>

            </ul>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa  fa-suitcase"></i> <span style="cursor: pointer;">Boleta Notas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li><a onclick="cargar_contenido('contenido_principal','boletin/vista_evaluar_criterio.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o"></i>Criterio de Evaluación</a></li>

              <li><a onclick="cargar_contenido('contenido_principal','boletin/vista_listar_alumnos.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span
                    class="pull-right-container">
                    <small class="label pull-right bg-yellow">123</small>
                  </span></a></li>

              <li><a onclick="cargar_contenido('contenido_principal','boletin/vista_evaluacion_alfabetico.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span
                    class="pull-right-container">
                    <small class="label pull-right bg-yellow">ABC</small>
                  </span></a></li>


            </ul>
          </a>
        </li>

        <li class="treeview">
          <a onclick="cargar_contenido('contenido_principal','aula/vista_listar_aula.php')">
            <i class=" fa fa-flag"></i> <span style="cursor: pointer;">Aulas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
        <li class="treeview">
          <a onclick="cargar_contenido('contenido_principal','colegio/vista_colegio_data.php')">
            <i class=" fa fa-info-circle"></i> <span style="cursor: pointer;">Colegio</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
        <?php
      }
      ?>

      <?php

      if ($_SESSION['S_ROL'] == 'DOCENTE') {
        ?>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_grados.php')">
            <i class="fa fa-lightbulb-o"></i> <span style="cursor: pointer;">Grados</span>
            <span class="pull-right-container">
              <i class="fa fa-labtop"></i>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_carga_academico.php')">
            <i class="fa fa-briefcase"></i> <span style="cursor: pointer;">Carga Académico</span>
            <span class="pull-right-container">
              <i class="fa fa-labtop"></i>
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_notas_registro_docente.php')">
            <em class="fa fa-edit (aliase"></em> <span style="cursor: pointer;">Registro Notas</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_notas_report_docente.php')">
            <em class="fa fa-eye"></em> <span style="cursor: pointer;">Vizualizar Notas</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_notas_periodo_docente.php')">
            <em class="fa  fa-info-circle"></em> <span style="cursor: pointer;">Notas Periodo</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>

        <li class="treeview">
          <a>
            <i class="fa fa-users"></i> <span style="cursor: pointer;">Asistencias Clases</span><span
              class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">
              <li class="">
                <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_asistencia_Docente.php')">
                  <em class="fa fa-circle-o"></em>
                  <span style="cursor: pointer;">Asistencia</span>

                </a>
              </li>
              <li class="treeview">
                <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_report_asistencia_Docente.php')">
                  <i class="fa fa-circle-o "></i>
                  <span style="cursor: pointer;">Reportes</span>

                </a>
              </li>

            </ul>
          </a>
        </li>




        <li class="treeview">
          <a>
            <i class="fa  fa-suitcase"></i> <span style="cursor: pointer;">Libreta Notas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>

            <ul class="treeview-menu">


              <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_alumnos.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span
                    class="pull-right-container">
                    <small class="label pull-right bg-yellow">123</small>
                  </span></a></li>

              <li><a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_Notas_alfabetic.php')"
                  style="cursor: pointer;"><i class="fa fa-circle-o "></i>Evaluar Críterios <span
                    class="pull-right-container">
                    <small class="label pull-right bg-yellow">ABC</small>
                  </span></a></li>


            </ul>
          </a>
        </li>


        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','docenteSesion/vista_listar_horaio_clases25.php')">
            <em class=" glyphicon glyphicon-time"></em> <span style="cursor: pointer;">Horarios Clases</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>



        <?php
      }
      ?>

      <?php

      if ($_SESSION['S_ROL'] == 'ALUMNO') {
        ?>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_Notas_Alumno.php')">
            <em class="fa fa-pencil-square-o "></em> <span style="cursor: pointer;">Notas</span>
            <span class="pull-right-container">
              <em class="fa fa-labtop"></em>
              <em class="fa fa-angle-left pull-right"></em>
            </span>
          </a>
        </li>

        <li>
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/view_edit_horario_clases25.php')">
            <i class="glyphicon glyphicon-time"></i> <span style="cursor: pointer;">Horario clases</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_aula_clases.php')">
            <i class="fa fa-flag"></i> <span style="cursor: pointer;">Aula Clases</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>

        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_listar_pagos.php')">
            <i class="fa  fa-info-circle"></i> <span style="cursor: pointer;">Cuenta</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','alumnoSesion/vista_listar_cursos_alumno.php')">
            <i class="fa fa-book"></i> <span style="cursor: pointer;">Materias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>

            </span>
          </a>
        </li>


        <?php
      }
      ?>
      <?php
      if ($_SESSION['S_ROL'] == 'ADMINISTRADOR') {
        ?>
        <li class=" treeview">
          <a onclick="cargar_contenido('contenido_principal','contabilidad/vista_contabilidad.php')">
            <i class="fa fa-credit-card"></i> <span style="cursor: pointer;">Contabilidad</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a
                onclick="cargar_contenido('contenido_principal','contabilidad/vista_contabilidad.php')"
                style="cursor: pointer;" class="open-links"><i class="fa fa-shopping-bag pointer-events-none"></i> <span
                  class="pointer-events-none">Productos/Servicios</span> <span
                  class="pull-right-container pointer-events-none">
                  <i class="fa fa-angle-left pull-right"></i>
                </span></a>
              <div class="more-menu menu-links-hidden" id="more-menu">
              
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/productos_servicios/vista_productos_servicios.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Productos</span> </a>
                </div>
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/productos_servicios/servicios.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Servicios</span> </a>
                </div>
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/productos_servicios/vista_categoria.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Categorias</span> </a>
                </div>
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/productos_servicios/vista_marca.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Marcas</span> </a>
                </div>

              </div>
            </li>
            <li><a onclick="cargar_contenido('contenido_principal','contabilidad/vista_contabilidad.php')"
                style="cursor: pointer;" class="open-links"><i class="fa fa-money pointer-events-none"></i> <span
                  class="pointer-events-none">Compra y gasto</span> <span
                  class="pull-right-container pointer-events-none">
                  <i class="fa fa-angle-left pull-right"></i>
                </span></a>

              <div class="more-menu menu-links-hidden" id="more-menu">
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/compra_gasto/vista_compra.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Compra</span> </a>
                </div>
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/compra_gasto/vista_gasto.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Gasto</span> </a>
                </div>
              </div>
            </li>
            <li><a onclick="cargar_contenido('contenido_principal','contabilidad/vista_contabilidad.php')"
                style="cursor: pointer;" class="open-links"><i class="fa fa-bar-chart pointer-events-none"></i> <span
                  class="pointer-events-none">Ventas</span>
                <span class="pull-right-container pointer-events-none">
                  <i class="fa fa-angle-left pull-right"></i>
                </span></a>

              <div class="more-menu menu-links-hidden" id="more-menu">
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/ventas/vista_nuevo.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Nuevo</span> </a>
                </div>
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/ventas/vista_reportes.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Reporte de ventas</span> </a>
                </div>
                <div class="more-menu-li">
                  <a onclick="cargar_contenido('contenido_principal','contabilidad/ventas/vista_lista_sucursal.php')"
                    style="cursor: pointer;"><i class="fa fa-circle-o"></i> <span>Establecimiento</span> </a>
                </div>
              </div>
            </li>
            <li><a onclick="cargar_contenido('contenido_principal','contabilidad/cliente/vista_cliente.php')"
                style="cursor: pointer;"><i class="fa fa-users"></i> <span>Clientes</span> </a></li>
            <li><a onclick="cargar_contenido('contenido_principal','contabilidad/caja/vista_caja.php')"
                style="cursor: pointer;"><i class="fa fa-gg-circle"></i> <span>Caja</span> </a></li>
          </ul>
        </li>
        <?php
      }
      ?>
    </ul>

  </section>
  <!-- /.sidebar -->
</aside>

<script>
  document.addEventListener("click", (e) =>
  {
    console.log(e.target.className)
    if (e.target.className == "open-links") {
      console.log(e.target.lastElementChild)
      const $target = e.target.parentElement.lastElementChild
      const $targetArrow = e.target.lastElementChild

      $targetArrow.classList.toggle("menu-open-arrows")
      $target.classList.toggle("menu-links-hidden")
    }
  })
</script>
<?php
session_start();
if (!isset($_SESSION['S_IDUSUARIO'])) {
  header('Location: ../Login/index.php');
}

?>

<!DOCTYPE html>
<html>

<head>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
  google.charts.load('current', {packages: ['corechart']});
  google.charts.setOnLoadCallback(drawChart);
  ...
  </script>
  
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Orion | Home</title>
  <link rel="shortcut icon" href="../Plantilla/dist/img/favi2.jpg" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="../Plantilla/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../Plantilla/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons 
    <link rel="stylesheet" href="../Plantilla/bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="../Plantilla/dist/css/AdminLTE.min.css">
  <!-- color de la navegacion navV navH -->
  <link rel="stylesheet" href="../Plantilla/dist/css/skins/_all-skins.min.css">

  <!-- Morris chart -->

  <!-- Daterange picker -->


  <link rel="stylesheet" href="../Plantilla/plugins/DataTables/datatables.min.css">
  <link rel="stylesheet" type="text/css" href="../Plantilla/dist/css/checkbox.css">

  <!--booton imprimir-->

  <link rel="stylesheet" href="../Plantilla/plugins/select2/select2.min.css">




  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="shortcut icon" href="../imagenes/LOGOIMG122023135412.jpg" type="image/x-icon">
</head>


<style>
  .swal2-popup {
    font-size: 1.0.5em !important;
  }
</style>

<body id="body" class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <?php
    include('menu/navV.php');
    include('menu/navH.php');
    ?>



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <!-- Main content -->
      <section class="content">
        <div class="row" id="contenido_principal">
          <div class="col-md-12">
            <div class="box box-warning ">


              
              <!-- /.box-header -->
              
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <center>
            <div class="loader" hidden>
              <img src="../login/vendor/loader.gif" alt="" style="width: 100px;height:100px;">
            </div>
          </center>
        </div>
    </div>
    <!-- /modal del index -->


    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <a href="https://web.facebook.com/TIDHuancayo?_rdc=1&_rdr" target="_blank"><i class="fa fa-facebook-square"
            style="scale: 1.4; color: #1877F2"></i></a>&nbsp;&nbsp;&nbsp;
        <a href="https://api.whatsapp.com/send/?phone=51904221760&text&type=phone_number&app_absent=0"
          target="_blank"><i class="fa fa-whatsapp" style="scale: 1.6; color: #1877F2"></i></a>&nbsp;&nbsp;&nbsp;
        <b>Version</b> 1.1
      </div>
      <strong>Desarrollado por <a href="">TID</a>.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- ./wrapper -->


  <!-- jQuery 3 -->
  <script src="../Plantilla/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../Plantilla/bower_components/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    var idioma_espanol = {
      select: {
        rows: "%d fila seleccionada"
      },
      "sProcessing": "<span class='fa-stack fa-lg'>\n\
     <i class='fa fa-spinner fa-spin fa-stack-2x fa-fw'></i>\n\
     </span>&emsp;Procesando....",
      "sLengthMenu": "Mostrar _MENU_ registros",
      "sZeroRecords": "No se encontraron resultados",
      "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
      "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
      "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
      "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix": "",
      "sSearch": "Buscar:",
      "sUrl": "",
      "sInfoThousands": ",",
      "sLoadingRecords": "<b>No se encontron Ningun Registro</b>",
      "oPaginate": {
        "sFirst": "Primero",
        "sLast": "Último",
        "sNext": "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }

    function cargar_contenido(contenedor, contenido)
    {
      $("#refres_add").show();
      $("#" + contenedor).load(contenido);
      $("html").animate({
        scrollTop: $("#" + contenedor).offset().top
      }, "slow");
    }
    cargar_contenido('contenido_principal', 'dashboard/dashboard.php')
  </script>

  <!-- Bootstrap 3.3.7 -->
  <script src="../Plantilla/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



  <!-- Slimscroll -->

  <!-- FastClick -->

  <!-- AdminLTE App -->
  <script src="../Plantilla/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- AdminLTE for demo purposes -->

  <script src="../Plantilla/plugins/DataTables/datatables.min.js"></script>

  <!-- imprimir-->
  <script src="../Plantilla/plugins/DataTables//pdfmake-0.1.36/vfs_fonts.js"></script>

  <script src="../Plantilla/plugins/select2/select2.min.js"></script>
  <script src="../Plantilla/plugins/sweetalert2/sweetalert2.js"></script>

  <script src="../Login/dist/cryptojs-aes-format.js"></script>
  <script src="../Login/dist/cryptojs-aes.min.js"></script>
  <script src="../js/config.js"></script>

  <script type="text/javascript">
    $(document).ready(function ()
    {
      listar_combo_AnioActiveWiev();

    });

    function search_SidebarMain()
    {
      let input = document.getElementById('searchbar').value;
      input = input.toLowerCase();
      let x = document.getElementsByClassName('treeview');
      for (i = 0; i < x.length; i++) {

        if (!x[i].innerHTML.includes(input)) {
          x[i].style.display = "none";
        } else {
          x[i].style.display = "list-item";

        }
      }



    }

    //COMBO DE AÑO ESCOLAR
    function listar_combo_AnioActiveWiev()
    {
      $("#nombreYearactivo").html("<i class='fa fa-spin fa-refresh'></i>");
      $.ajax({
        "url": "../controlador/configuracion/configuracion_extrae_AnioActivo.php",
        type: 'POST'
      }).done(function (resp)
      {
        var data = JSON.parse(resp);
        if (data.length > 0) {
          $("#YearActualActivo").val(data[0]['id_year']);
          $("#nombreYearactivo").html(data[0]['yearScolar']);
          $("#tex_YearActual_").val(data[0]['yearScolar']);
        } else {
          var html = '';
          html += "<div class='' style='border-color: #f5c6cb; ' >";
          html +=
            "<div  class='alert  sm' role='alert' style='color: #721c24; background-color: #f8d7da;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
          html += "No se encontró ninguan año academico Aperturado ";
          html += "<strong> ! ACTIVO </strong> para este año !!";
          html += " </div>";
          html += "</div>";

          $("#Notificaciones_year").html(html);

        }

      })
    }
  </script>

</body>

</html>
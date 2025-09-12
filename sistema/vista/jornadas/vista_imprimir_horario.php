<?php 
ob_start();

if (!empty(($_GET['idhorario']) && ($_GET['idjornada']))) {

	$idjornada = htmlspecialchars($_GET['idjornada'],ENT_QUOTES,'UTF-8');
    $idhorario = htmlspecialchars($_GET['idhorario'],ENT_QUOTES,'UTF-8');
      $seccion = htmlspecialchars($_GET['seccionId'],ENT_QUOTES,'UTF-8');


	include_once '../../modelo/modelo_horario.php';
	$horario  = new  Horario();
  $data  =  $horario->Imprimir_horario_clases25($idhorario);
	$horas  =  $horario-> ListarHoras($idjornada); 

  $colegio=  $horario->Datos_colegio_horario_imprimir();


   $escudoImagen = "../../imagenes/".$colegio[0]['escudoPais'];
$escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));

$logoImagen = "../../imagenes/".$colegio[0]['logoColegio'];
$logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));
}

?>


<!DOCTYPE html>
<html>

<head>
  <title>View Horarios pdf</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../Plantilla/Dompdf/boostra4/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</head>

<body>

  <div class="col-md-12">
    <div class="box box-warning ">


      <div class="row" style="display: flex;">
        <div class="col-xs-12">
          <div class="col-xs-6" style="float:left;">
            <img src="<?php echo $escudoBase64 ?>" width="100">
          </div>
          <div class="col-xs-6" style="float: right;">
            <img src="<?php echo $logoBase64 ?>" width="100">
          </div>

        </div>
      </div>
      <h3 class="box-title">HORAIO DE CLASES -<?php  echo date('y'); ?> </h3>
      <p><?php  echo $colegio[0]['nameColegio'];?></p>



      <div class="box-body">
        <br>
        <table class="table table-bordered">
          <thead>
            <tr style=" background-color: #3894c9;color: #fff;text-align: center;">
              <th>GRADO </th>
              <th>NIVEL </th>
              <th>TURNO </th>
              <th>SECCIÓN </th>
              <th>AULA </th>
            </tr>
            <tr style="text-align: center;">
              <th><?php  echo $data[0]['gradonombre']; ?></th>
              <th><?php  echo $data[0]['nombreNivell']; ?></th>
              <th><?php  echo $data[0]['turno_nombre']; ?></th>
              <th><?php  echo $data[0]['seccionId'] ; ?></th>
              <th><?php  echo $data[0]['nombreaula'] ; ?></th>
            </tr>
          </thead>
        </table>
      </div>

      <div class="row">
        <div class="col-xs-12">
          <div class="box-body no-padding  table-responsive">

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>hora</th>
                  <th>Lunes</th>
                  <th>Martes</th>
                  <th>Miercoles</th>
                  <th>Jueves</th>
                  <th>Viernes</th>
                </tr>

                <?php foreach ($horas as $hora) { ?>
                <tr>
                  <td><?php echo $hora['Hora_inicio'] . ' - ' . $hora['hora_final']; ?></td>
                  <?php
                  for ($c = 1; $c <= 5; $c++) {

                    $datoscursos = $horario->mostratarHorario($c, $hora['HorJor_id'],$seccion);
                    
                    if (count($datoscursos)> 0) {
                      foreach ($datoscursos as $value) {
                        ?>
                  <td id="td<?php echo $hora['HorJor_id'] . $c; ?>" class="dropzone"
                    idhora="<?php echo $hora['HorJor_id']; ?>" iddia="<?php echo $c ?>"
                    idhorario="<?php echo $value['idtd'] ?>">&nbsp;<?php echo $value['nonbrecurso'] ?></td>
                  <?php
                      }
                    } else {
                      ?>
                  <td id="td<?php echo $hora['HorJor_id'] . $c; ?>" class="dropzone"
                    idhora="<?php echo $hora['HorJor_id']; ?>" iddia="<?php echo $c ?>" idhorario=""></td>
                  <?php
                    }
                  }
                  ?>
                </tr>
                <?php } ?>

              </thead>
            </table>

          </div>

        </div>
      </div>
    </div>
  </div>
  </div>


</body>

</html>



<?php 
$html=ob_get_clean();
//echo $html;


require_once '../../Plantilla/Dompdf/autoload.inc.php';
Use Dompdf\Dompdf;
$dompdf=new Dompdf();

$options = $dompdf->getOptions();
$dompdf = new Dompdf(array('enable_remote' => true));
$dompdf->setOptions($options);

$dompdf ->loadHtml($html);
$dompdf ->setPaper('letter');

//$dompdf ->setPaper('A4','landscape');

$dompdf ->render();

$dompdf ->stream("Repotre_.pdf" ,array('Attachment' => false ));

 ?>
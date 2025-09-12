
<?php 
ob_start();

$idalumno = htmlspecialchars($_GET["idalumno"],ENT_QUOTES,'UTF-8');
//$yearid = htmlspecialchars($_GET["yearid"],ENT_QUOTES,'UTF-8');

date_default_timezone_set('America/Lima');



require 'conexion_temporal.php';

//DATOS DEL ALUMNO
    $alumno = $conn->prepare("select idalumno,apellidos,alumnonombre,codigo,Id_grado,gradonombre,nombreNivell,matricula.seccion,nombreaula,turno_nombre,cargoPago,cargoMatricula from matricula
                    inner join  aula on aula.idaula = matricula.Id_aula
                    inner join  turnos on turnos.turno_id = matricula.Id_turno
                      inner join  niveles on niveles.idniveles = matricula.Id_nivls
                      inner join  alumno on alumno.idalumno = matricula.Id_alumno
                       inner join  grado on grado.idgrado = matricula.Id_grado 
                       where Id_alumno ='$idalumno' ");

    $alumno->execute();
    $alumno = $alumno->fetch();

//Datos  INSTITUCION
  $colegio = $conn->prepare("SELECT idColegio, nameColegio,  emailColegio, ubicacion, logoColegio, escudoPais,  ugel FROM colegio");

    $colegio->execute();
    $colegio = $colegio->fetch();

 $escudoImagen = "../../imagenes/".$colegio['escudoPais'];
$escudoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($escudoImagen));
$logoImagen = "../../imagenes/".$colegio['logoColegio'];
$logoBase64 = "data:image/png;base64," . base64_encode(file_get_contents($logoImagen));

 ?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="../../Plantilla/Dompdf/boostra4/bootstrap.min.css" integrity="" crossorigin="anonymous">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">  
</head>

<body class="app sidebar-mini">

  <div class="wrap">
    <!--Updated on 10/8/2016; fixed center alignment percentage-->
  </div>

  <div class="wrap">
    <!--Updated on 10/8/2016; fixed center alignment percentage-->
    <div class="container-fluid">
   

      <div class="row" style="display: flex;">
       <div class="col-xs-12" >
         <div class="col-xs-6" style="float:left;" >
       <img  src="<?php echo $escudoBase64?? ''  ?>" width="100">
     </div>
     <div class="col-xs-6" style="float: right;">
       <img src="<?php echo $logoBase64?? '' ?>" width="100">
     </div>

   </div>
 </div>

     <div class="box-1">
      <h5>LIBRETA DE MATRÍCULA DEL ESTUDIANTE -<?php echo date('Y')?></h5>
      <br><br><br>
      
      <table border="1" class="table table-bordered table-sm" style="border: 1px solid #33e3c7;"> 
        <tr>
          <td>UGEL</th>
            <td colspan="4"><?php echo $colegio['ugel']?? '' ?></td>
          </tr>
          <tr>
            <td colspan="4">I.E</td>
            <td ><?php echo $colegio['nameColegio']?? '' ?></td>
          </tr>
          <tr>
            <td rowspan="2">NIVEL</td>
            <td rowspan="2"><?php echo $alumno['nombreNivell'] ?></td>
            <td >GRADO</td>
            <td colspan="2"><?php echo $alumno['gradonombre'] ?></td>
          </tr>
          <tr>
            <td colspan="2">SECCION</td>
            <td colspan="1"><?php echo $alumno['seccion'] ?></td>
          </tr>
          <tr>
            <td colspan="4">CODIGO ESTUDIANTE</td>
            <td ><?php echo $alumno['codigo'] ?></td>
          </tr>
          <tr>
            <td colspan="4">APELLIDOS Y NOMBRES</td>
            <td ><?php echo $alumno['apellidos'].','.$alumno['alumnonombre'] ?></td>
          </tr>
          <tr>
            <td rowspan="2">PAGOS MENSUALES</td>
            <td rowspan="2"><?php echo $alumno['cargoPago'] ?></td>
            <td >AULAS</td>
            <td colspan="2"><?php echo $alumno['nombreaula'] ?></td>
          </tr>
          <tr>
            <td colspan="2">TURNO</td>
            <td colspan="1"><?php echo $alumno['turno_nombre'] ?></td>
          </tr>
          <tr>
            <td colspan="4">PAGO UNICO POR CONCEPTO DE MATRÍCULA</td>
            <td >s/. <?php echo $alumno['cargoMatricula'] ?></td>
          </tr>
        </table>
        <label>Fecha de matrícula: <?php  echo date('Y-m-d h:i:s A'); ?></label>

      </div>
    </div>
    <br>
    <br>
    <div class="container" style=" ">
        <?php
/*
* author: Código Root </>
* Mi blog: https://codigoroot.net/blog
*/ 
/*
date_default_timezone_set('America/Mexico_City');// Funcion de zona horaria para obtener la hora correcta

$DiayMes= date('l j F'); // Dia en inglés, en número y  mes en inglés
$DiadelAño = date('z'); //Número de dia del año
$Semana = date('W');  // Número de la semana del año
$Año= date('Y');  //Año en 4 digitos
$MesNumero = date('n'); // Número del mes en curso
$DiasMes= date('t'); // Dias del mes en curso
$Hora=date('h:i:s A'); // Hora actual con formato AM

echo "<br> Hoy es " . $DiayMes . " y es el día N° " . $DiadelAño . " del año " . $Año . " estamos en la semana número " . $Semana . " del mes número " . $MesNumero . " y este mes tiene " . $DiasMes . " días <br> Mientras escribo esto son las " . $Hora ;*/
 ?>
     
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


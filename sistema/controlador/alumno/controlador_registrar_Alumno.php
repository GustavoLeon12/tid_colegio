<?php
require '../../modelo/modelo_alumnos.php';
require '../../helper/save_user.php';

$MU = new Alumno();

$idalumno = htmlspecialchars($_POST['idalumnoedit'], ENT_QUOTES, 'UTF-8');
$apellp = htmlspecialchars($_POST['apellp'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nomb'], ENT_QUOTES, 'UTF-8');
$fechaN = htmlspecialchars($_POST['fechaN'], ENT_QUOTES, 'UTF-8');
$dni = htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8');
$telf = htmlspecialchars($_POST['telf'], ENT_QUOTES, 'UTF-8');
$codi = htmlspecialchars($_POST['codi'], ENT_QUOTES, 'UTF-8');
$sexo = htmlspecialchars($_POST['sex'], ENT_QUOTES, 'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
$tp_docu = htmlspecialchars($_POST['tp_docu'], ENT_QUOTES, 'UTF-8');
$ubigeo = htmlspecialchars($_POST['ubigeo'], ENT_QUOTES, 'UTF-8');
$image = "";
if (empty($_FILES)) {
    $image = "images.png";
} else {
    $image = saveImage();
}

$nom_pade = htmlspecialchars($_POST['nom_pade'], ENT_QUOTES, 'UTF-8');
$apell_pade = htmlspecialchars($_POST['apell_pade'], ENT_QUOTES, 'UTF-8');
$dni_pade = htmlspecialchars($_POST['dni_pade'], ENT_QUOTES, 'UTF-8');

$tp_docu_padre = htmlspecialchars($_POST['tp_docu_padre'], ENT_QUOTES, 'UTF-8');
$tp_docu_madre = htmlspecialchars($_POST['tp_docu_madre'], ENT_QUOTES, 'UTF-8');

$ubigeo_madre = htmlspecialchars($_POST['ubigeo_madre'], ENT_QUOTES, 'UTF-8');
$ubigeo_padre = htmlspecialchars($_POST['ubigeo_padre'], ENT_QUOTES, 'UTF-8');

$nom_madre = htmlspecialchars($_POST['nom_madre'], ENT_QUOTES, 'UTF-8');
$apell_madre = htmlspecialchars($_POST['apell_madre'], ENT_QUOTES, 'UTF-8');
$dni_madre = htmlspecialchars($_POST['dni_madre'], ENT_QUOTES, 'UTF-8');

$nom_cole = htmlspecialchars($_POST['nom_cole'], ENT_QUOTES, 'UTF-8');
$nom_direc = htmlspecialchars($_POST['nom_direc'], ENT_QUOTES, 'UTF-8');
$cole_codig = htmlspecialchars($_POST['cole_codig'], ENT_QUOTES, 'UTF-8');

$Existe = $MU->Verificar_Existencia($apellp, $nombre, $dni, $codi);
if ($Existe == 0) {

    $id_Alumno = $MU->Registrar_New_Alumno($idalumno, $apellp, $nombre, $fechaN, $dni, $telf, $codi, $sexo, $direccion, $tp_docu, $ubigeo, $image);

    $consulta = $MU->Registrar_New_Apoderados($id_Alumno, $nom_pade, $apell_pade, $dni_pade, $nom_madre, $apell_madre, $dni_madre, $nom_cole, $nom_direc, $cole_codig, $tp_docu_madre, $tp_docu_padre, $ubigeo_madre, $ubigeo_padre);

    echo $consulta;

} else {
    echo 100;
}

?>
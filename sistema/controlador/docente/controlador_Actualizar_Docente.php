<?php
require '../../modelo/modelo_docente.php';
require '../../helper/save_user.php';
$MU = new Docente();

$idDocente = htmlspecialchars($_POST['idDocente'], ENT_QUOTES, 'UTF-8');
$nombreDocente = htmlspecialchars($_POST['nombreDocente'], ENT_QUOTES, 'UTF-8');
$apellidDocente = htmlspecialchars($_POST['apellidDocente'], ENT_QUOTES, 'UTF-8');
$dniDocente = htmlspecialchars($_POST['dniDocente'], ENT_QUOTES, 'UTF-8');
$emailDocente = htmlspecialchars($_POST['emailDocente'], ENT_QUOTES, 'UTF-8');
$telfDocente = htmlspecialchars($_POST['telfDocente'], ENT_QUOTES, 'UTF-8');
$codigDocente = htmlspecialchars($_POST['codigDocente'], ENT_QUOTES, 'UTF-8');
$nivelDocente = htmlspecialchars($_POST['nivelDocente'], ENT_QUOTES, 'UTF-8');
$tipoDocente = htmlspecialchars($_POST['tipoDocente'], ENT_QUOTES, 'UTF-8');
$ubigeo = htmlspecialchars($_POST['ubigeo'], ENT_QUOTES, 'UTF-8');
$tipoDocumento = htmlspecialchars($_POST['tipoDocumento'], ENT_QUOTES, 'UTF-8');
$facebook = htmlspecialchars($_POST['facebook'], ENT_QUOTES, 'UTF-8');

$image = "";
if (empty($_FILES)) {
	$image = "images.png";
} else {
	$image = saveImage();
}

$result = $MU->Actualizar_Docente($nombreDocente, $apellidDocente, $dniDocente, $emailDocente, $telfDocente, $codigDocente, $nivelDocente, $tipoDocente, $idDocente, $ubigeo, $tipoDocumento, $image, $facebook);

echo $result;


?>
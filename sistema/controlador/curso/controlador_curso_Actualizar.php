<?php
require '../../modelo/modelo_curso.php';


$curso = new Curso();
$idcurso = htmlspecialchars($_POST['idcurso'], ENT_QUOTES, 'UTF-8');
$codigcurso = htmlspecialchars($_POST['codigocur'], ENT_QUOTES, 'UTF-8');
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');
$area = htmlspecialchars($_POST['area'], ENT_QUOTES, 'UTF-8');
$consulta = $curso->Update_Curso($idcurso, $codigcurso, $nombre, $tipo, $area);
echo $consulta;

?>
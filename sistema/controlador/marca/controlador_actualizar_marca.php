<?php
require '../../modelo/modelo_marca.php';

$marca = new ModeloMarca();

$idMarca = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');

$consulta = $marca->actualizarMarca($descripcion, $idMarca);
echo $consulta;

?>
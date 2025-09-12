<?php
require '../../modelo/modelo_marca.php';

$marca = new ModeloMarca();

$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$fechaCreacion = htmlspecialchars($_POST['fechaCreacion'], ENT_QUOTES, 'UTF-8');

$consulta = $marca->registrarMarca($descripcion, $fechaCreacion);
echo $consulta;

?>
<?php
require '../../modelo/modelo_categoria_producto.php';

$MM = new ModeloCategoria();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->actualizarCategorias($descripcion, $detalle, $id);
echo $consulta;

?>
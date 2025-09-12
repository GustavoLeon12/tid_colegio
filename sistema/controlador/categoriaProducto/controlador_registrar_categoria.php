<?php
require '../../modelo/modelo_categoria_producto.php';

$MM = new ModeloCategoria();

$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');
$fechaCreacion = htmlspecialchars($_POST['fechaCreacion'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->registrarCategorias($descripcion, $detalle, $fechaCreacion);
echo $consulta;

?>
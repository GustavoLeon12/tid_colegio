<?php
require '../../modelo/modelo_producto_servicio.php';

$MM = new ModeloProductoServicio();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->eliminarProducto($id);
echo $consulta;

?>
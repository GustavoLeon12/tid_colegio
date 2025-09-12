<?php
require '../../modelo/modelo_categoria_producto.php';

$MM = new ModeloCategoria();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->eliminarCategorias($id);
echo $consulta;

?>
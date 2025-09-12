<?php
require '../../modelo/modelo_marca.php';

$marca = new ModeloMarca();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$consulta = $marca->eliminarMarca($id);
echo $consulta;

?>
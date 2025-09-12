<?php
require '../../modelo/modelo_sucursal.php';

$MM = new ModeloSucursal();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->eliminarSucursal($id);
echo $consulta;

?>
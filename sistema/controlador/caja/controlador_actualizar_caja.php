<?php
require '../../modelo/modelo_caja.php';

$MM = new ModeloCaja();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$abierto = htmlspecialchars($_POST['abierto'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->actualizar($id, $abierto);
echo $consulta;

?>
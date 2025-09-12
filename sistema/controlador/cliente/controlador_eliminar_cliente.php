<?php
require '../../modelo/modelo_cliente.php';

$MM = new ModeloCliente();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->eliminar($id);
echo $consulta;

?>
<?php
require '../../modelo/modelo_sucursal.php';

$MM = new ModeloSucursal();

$id = htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8');
$codigoSucursal = htmlspecialchars($_POST['codigoSucursal'], ENT_QUOTES, 'UTF-8');
$denominacion = htmlspecialchars($_POST['denominacion'], ENT_QUOTES, 'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
$ubigeo = htmlspecialchars($_POST['ubigeo'], ENT_QUOTES, 'UTF-8');
$codigoSunat = htmlspecialchars($_POST['codigoSunat'], ENT_QUOTES, 'UTF-8');
$activo = htmlspecialchars($_POST['activo'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->actualizarSucursal($id, $codigoSucursal, $denominacion, $direccion, $ubigeo, $codigoSunat, $activo);
echo $consulta;

?>
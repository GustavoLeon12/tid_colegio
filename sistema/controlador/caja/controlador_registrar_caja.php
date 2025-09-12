<?php
require '../../modelo/modelo_caja.php';

$MM = new ModeloCaja();

$montoInicial = htmlspecialchars($_POST['montoInicial'], ENT_QUOTES, 'UTF-8');
$apertura = htmlspecialchars($_POST['apertura'], ENT_QUOTES, 'UTF-8');
$cierre = htmlspecialchars($_POST['cierre'], ENT_QUOTES, 'UTF-8');
$montoFinal = htmlspecialchars($_POST['montoFinal'], ENT_QUOTES, 'UTF-8');
$montoReferencial = htmlspecialchars($_POST['montoReferencial'], ENT_QUOTES, 'UTF-8');
$codSucursal = htmlspecialchars($_POST['codSucursal'], ENT_QUOTES, 'UTF-8');
$usuario = htmlspecialchars($_POST['usuario'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->registrar($montoInicial, $apertura, $cierre, $montoFinal, $montoReferencial, $codSucursal, $usuario);
echo $consulta;

?>
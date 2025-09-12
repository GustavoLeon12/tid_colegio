<?php
require '../../modelo/modelo_producto_servicio.php';

$marca = new ModeloProductoServicio();

$descripcion = htmlspecialchars($_POST['descripcion'], ENT_QUOTES, 'UTF-8');
$detalle = htmlspecialchars($_POST['detalle'], ENT_QUOTES, 'UTF-8');
$modelo = htmlspecialchars($_POST['modelo'], ENT_QUOTES, 'UTF-8');
$unidad = htmlspecialchars($_POST['unidad'], ENT_QUOTES, 'UTF-8');
$moneda = htmlspecialchars($_POST['moneda'], ENT_QUOTES, 'UTF-8');
$stockInicial = htmlspecialchars($_POST['stockInicial'], ENT_QUOTES, 'UTF-8');
$stockMinimo = htmlspecialchars($_POST['stockMinimo'], ENT_QUOTES, 'UTF-8');
$tipoFacturacion = htmlspecialchars($_POST['tipoFacturacion'], ENT_QUOTES, 'UTF-8');
$fechaVencimiento = htmlspecialchars($_POST['fechaVencimiento'], ENT_QUOTES, 'UTF-8');
$precioBaseUnitario = htmlspecialchars($_POST['precioBaseUnitario'], ENT_QUOTES, 'UTF-8');
$identificado = htmlspecialchars($_POST['identificado'], ENT_QUOTES, 'UTF-8');
$igvUnitario = htmlspecialchars($_POST['igvUnitario'], ENT_QUOTES, 'UTF-8');
$precioFinal = htmlspecialchars($_POST['precioFinal'], ENT_QUOTES, 'UTF-8');
$marcaId = htmlspecialchars($_POST['marcaId'], ENT_QUOTES, 'UTF-8');
$categoriaProductoId = htmlspecialchars($_POST['categoriaProductoId'], ENT_QUOTES, 'UTF-8');

$consulta = $marca->registrarProducto($descripcion, $detalle, $modelo, $unidad, $moneda, $stockInicial, $stockMinimo, $tipoFacturacion, $fechaVencimiento, $precioBaseUnitario, $identificado, $igvUnitario, $precioFinal, $marcaId, $categoriaProductoId);
echo $consulta;

?>
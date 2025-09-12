<?php
require '../../modelo/modelo_cliente.php';

$MM = new ModeloCliente();

$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
$apellido = htmlspecialchars($_POST['apellido'], ENT_QUOTES, 'UTF-8');
$correo = htmlspecialchars($_POST['correo'], ENT_QUOTES, 'UTF-8');
$telefono = htmlspecialchars($_POST['telefono'], ENT_QUOTES, 'UTF-8');
$documento = htmlspecialchars($_POST['documento'], ENT_QUOTES, 'UTF-8');
$direccion = htmlspecialchars($_POST['direccion'], ENT_QUOTES, 'UTF-8');
$fkUbigeo = htmlspecialchars($_POST['fkUbigeo'], ENT_QUOTES, 'UTF-8');
$fkTpDocu = htmlspecialchars($_POST['fkTpDocu'], ENT_QUOTES, 'UTF-8');
$tipo = htmlspecialchars($_POST['tipo'], ENT_QUOTES, 'UTF-8');

$consulta = $MM->registrar($nombre, $apellido, $correo, $telefono, $documento, $direccion, $fkUbigeo, $fkTpDocu, $tipo);
echo $consulta; 

?>
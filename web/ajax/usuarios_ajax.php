<?php
require_once '../controller/usuarios_controller.php';

$usuarios = new UsuariosController();

if(isset($_POST['modulo_usuario'])){
  if($_POST['modulo_usuario'] == "acceder"){
    $usuarios->accederUsuario();
  }
}
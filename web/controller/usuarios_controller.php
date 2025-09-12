<?php

require_once '../models/main_model.php';

class UsuariosController extends mainModel
{
  public function accederUsuario()
  {
    session_start();
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $query = "SELECT * FROM usuarios WHERE usu_usuario='$correo' AND rol_id='1'";
    $queryII = "SELECT * FROM usuarios WHERE usu_usuario='$correo'";

    $resultII = $this->ejecutarConsulta($queryII)->fetch(PDO::FETCH_ASSOC);
    if ($resultII == false) {
      echo json_encode(array("message" => "Este usuario no fue registrado en nuestro sistema.", "status" => 404));
      http_response_code(404);
      exit();
    }

    $result = $this->ejecutarConsulta($query)->fetch(PDO::FETCH_ASSOC);
    if ($result == false) {
      echo json_encode(array("message" => "El usuario ingresado no tiene permisos de administrador", "status" => 401));
      http_response_code(401);
      exit();
    }

    $access = password_verify($contrasena, $result['usu_contrasena']);
    header("Content-Type: application/json");

    if ($access == "1") {
      setcookie("id", $result['usu_id'], time() + 3600, "/");
      $some = $result['usu_id'];
      echo json_encode(array("message" => "El id del usuario es: $some", "status" => 203));
    } else {
      echo json_encode(array("message" => "Las credenciales que ingreso son incorrectas, vuelve a intentarlo", "status" => 401));
      http_response_code(401);
    }
  }
}
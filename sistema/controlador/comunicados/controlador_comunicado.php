<?php
  require_once('../../modelo/modelo_comunicados.php');
  $MV = new Modelo_Comunicados();
  $id = $_GET['id'];
  $json = $MV->obtenerComunicado($id);
  header("Content-Type: application/json");
  echo json_encode($json);
?>
<?php
  require_once('../../modelo/modelo_comunicados.php');
  $MV = new Modelo_Comunicados();
  $json = $MV->obtenerComunicados();
  header("Content-Type: application/json");
  echo json_encode($json);
?>
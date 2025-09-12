<?php
require_once '../models/main_model.php';
class PersonalController extends mainModel
{
  public function obtenerDocentes()
  {
    $query = "SELECT * FROM docentes";
    $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($result);
    header("Content-Type: application/json");
    echo $json;
  }
}
?>
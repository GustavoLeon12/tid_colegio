<?php
header('Content-Type: application/json');
require_once '../../models/main_model.php';

class EventoModel extends mainModel {
  public function eliminar($id){
    $conn=$this->conectar();
    $stmt=$conn->prepare("DELETE FROM calendario WHERE id=?");
    $stmt->execute([$id]);
  }
}
$data=json_decode(file_get_contents('php://input'),true);
$evento=new EventoModel();
$evento->eliminar($data['id']);
echo json_encode(['status'=>'deleted']);

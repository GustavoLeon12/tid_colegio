<?php
header('Content-Type: application/json');
require_once '../../models/main_model.php';

class EventoModel extends mainModel {
  public function actualizar($id,$titulo,$descripcion,$ubicacion,$color,$start,$end,$allDay) {
    $conn = $this->conectar();
    $stmt = $conn->prepare("UPDATE calendario 
      SET titulo=?,descripcion=?,ubicacion=?,color=?,fecha_inicio=?,fecha_fin=?,todo_dia=? 
      WHERE id=?");
    $stmt->execute([$titulo,$descripcion,$ubicacion,$color,$start,$end,$allDay,$id]);
  }
}
$data=json_decode(file_get_contents('php://input'),true);
$evento=new EventoModel();
$evento->actualizar(
  $data['id'],
  $data['titulo'],
  $data['descripcion'],
  $data['ubicacion'],
  $data['color'],
  $data['start'],
  $data['end'],
  $data['allDay']?1:0
);
echo json_encode(['status'=>'ok']);
?>
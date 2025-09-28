<?php
header('Content-Type: application/json');
require_once '../../models/main_model.php';

class EventoModel extends mainModel {
  public function insertar($titulo,$descripcion,$ubicacion,$color,$start,$end,$allDay) {
    $conn = $this->conectar();
    $stmt = $conn->prepare("INSERT INTO calendario (titulo,descripcion,ubicacion,color,fecha_inicio,fecha_fin,todo_dia)
                            VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$titulo,$descripcion,$ubicacion,$color,$start,$end,$allDay]);
    return $conn->lastInsertId();
  }
}
$data = json_decode(file_get_contents('php://input'), true);
$evento = new EventoModel();
$id = $evento->insertar(
  $data['titulo'],
  $data['descripcion'],
  $data['ubicacion'],
  $data['color'],
  $data['start'],
  $data['end'],
  $data['allDay']?1:0
);
echo json_encode(['id'=>$id]);
?>


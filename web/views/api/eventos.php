<?php
require_once '../../models/main_model.php';

class EventoModel extends mainModel {
  public function listar() {
    $conn = $this->conectar();
    $sql = "SELECT id, titulo, descripcion, fecha_inicio, fecha_fin, todo_dia, color FROM calendario WHERE estado='ACTIVO'";
    return $conn->query($sql);
  }
}

header('Content-Type: application/json');
$evento = new EventoModel();
$res = $evento->listar();

$eventos = [];
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
  $eventos[] = [
    'id' => $row['id'],
    'title' => $row['titulo'],
    'start' => $row['fecha_inicio'],
    'end' => $row['fecha_fin'],
    'allDay' => (bool)$row['todo_dia'],
    'backgroundColor' => $row['color'] ?: '#173f78',
    'extendedProps' => ['descripcion' => $row['descripcion']]
  ];
}
echo json_encode($eventos);
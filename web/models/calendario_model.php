<?php
require_once 'main_model.php';

class CalendarioModel extends mainModel {

  public function listarEventos($inicio = null, $fin = null) {
    $conexion = $this->conectar();
    $sql = "SELECT c.id, c.titulo, c.descripcion, c.fecha_inicio AS fecha_inicio, c.fecha_fin AS fecha_fin,
               c.todo_dia, c.color, c.ubicacion
            FROM calendario c
            LEFT JOIN grado g ON c.grado_id = g.idgrado
            LEFT JOIN aula a ON c.aula_id = a.idaula
            LEFT JOIN categorias cat ON c.categoria_id = cat.id";

    if ($inicio && $fin) {
      $sql .= " WHERE (c.fecha_inicio BETWEEN :inicio AND :fin) OR (c.fecha_fin BETWEEN :inicio AND :fin)";
      $stmt = $conexion->prepare($sql);
      $stmt->bindParam(':inicio', $inicio);
      $stmt->bindParam(':fin', $fin);
    } else {
      $stmt = $conexion->prepare($sql);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function crearEvento($data) {
    $conexion = $this->conectar();
    $sql = "INSERT INTO calendario 
            (titulo, descripcion, fecha_inicio, fecha_fin, todo_dia, ubicacion, categoria_id, usuario_id, grado_id, curso_id, aula_id, year_id, color)
            VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_fin, :todo_dia, :ubicacion, :categoria_id, :usuario_id, :grado_id, :curso_id, :aula_id, :year_id, :color)";
    
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([
      ':titulo' => $data['titulo'],
      ':descripcion' => $data['descripcion'] ?? null,
      ':fecha_inicio' => $data['fecha_inicio'],
      ':fecha_fin' => $data['fecha_fin'] ?? null,
      ':todo_dia' => $data['todo_dia'] ?? 0,
      ':ubicacion' => $data['ubicacion'] ?? null,
      ':categoria_id' => $data['categoria_id'] ?? null,
      ':usuario_id' => $data['usuario_id'] ?? null,
      ':grado_id' => $data['grado_id'] ?? null,
      ':curso_id' => $data['curso_id'] ?? null,
      ':aula_id' => $data['aula_id'] ?? null,
      ':year_id' => $data['year_id'] ?? null,
      ':color' => $data['color'] ?? null
    ]);
  }

  public function actualizarEvento($id, $data) {
    $conexion = $this->conectar();
    $sql = "UPDATE calendario SET 
              titulo=:titulo, descripcion=:descripcion, fecha_inicio=:fecha_inicio, fecha_fin=:fecha_fin,
              todo_dia=:todo_dia, ubicacion=:ubicacion, categoria_id=:categoria_id, grado_id=:grado_id,
              curso_id=:curso_id, aula_id=:aula_id, color=:color, estado=:estado
            WHERE id=:id";
    
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([
      ':titulo' => $data['titulo'],
      ':descripcion' => $data['descripcion'] ?? null,
      ':fecha_inicio' => $data['fecha_inicio'],
      ':fecha_fin' => $data['fecha_fin'] ?? null,
      ':todo_dia' => $data['todo_dia'] ?? 0,
      ':ubicacion' => $data['ubicacion'] ?? null,
      ':categoria_id' => $data['categoria_id'] ?? null,
      ':grado_id' => $data['grado_id'] ?? null,
      ':curso_id' => $data['curso_id'] ?? null,
      ':aula_id' => $data['aula_id'] ?? null,
      ':color' => $data['color'] ?? null,
      ':estado' => $data['estado'] ?? 'ACTIVO',
      ':id' => $id
    ]);
  }

  public function eliminarEvento($id) {
    $conexion = $this->conectar();
    $sql = "UPDATE calendario SET estado='INACTIVO' WHERE id=:id";
    $stmt = $conexion->prepare($sql);
    return $stmt->execute([':id' => $id]);
  }
}

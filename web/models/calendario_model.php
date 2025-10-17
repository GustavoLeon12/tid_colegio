<?php
require_once 'main_model.php'; // Ajusta ruta si necesario

class CalendarioModel extends mainModel {
    public function listarEventos() {
        $consulta = "SELECT 
            c.id, c.titulo, c.descripcion, c.fecha_inicio, c.fecha_fin, c.todo_dia, 
            c.ubicacion, c.categoria_id, COALESCE(cat.nombre, 'Sin categoría') AS categoria_nombre, 
            c.usuario_id, COALESCE(CONCAT(d.nombres, ' ', d.apellidos), 'Sin docente') AS docente_nombre,
            c.grado_id, COALESCE(g.nombre, 'Sin grado') AS grado_nombre,
            c.curso_id, COALESCE(cur.nombre, 'Sin curso') AS curso_nombre,
            c.aula_id, COALESCE(a.nombre, 'Sin aula') AS aula_nombre,
            c.year_id, COALESCE(y.anio, 'Sin año') AS year_anio,
            c.recurrente, c.regla_recurrencia, c.color, c.estado, 
            c.fecha_creacion AS created_at, c.fecha_actualizacion AS updated_at
            FROM calendario c
            LEFT JOIN categorias cat ON c.categoria_id = cat.id
            LEFT JOIN docentes d ON c.usuario_id = d.id_docente
            LEFT JOIN grado g ON c.grado_id = g.idgrado
            LEFT JOIN curso cur ON c.curso_id = cur.idcurso
            LEFT JOIN aula a ON c.aula_id = a.idaula
            LEFT JOIN yearscolar y ON c.year_id = y.id_year
            WHERE c.estado = 'ACTIVO' ORDER BY c.fecha_inicio DESC";
        $sql = $this->ejecutarConsultaSimple($consulta);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearEvento($data) {
        $sql = "INSERT INTO calendario (titulo, descripcion, fecha_inicio, fecha_fin, todo_dia, ubicacion, categoria_id, usuario_id, grado_id, curso_id, aula_id, year_id, recurrente, regla_recurrencia, color, estado, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $params = [
            $data['titulo'], $data['descripcion'], $data['fecha_inicio'], $data['fecha_fin'],
            $data['todo_dia'], $data['ubicacion'], $data['categoria_id'], $data['usuario_id'],
            $data['grado_id'], $data['curso_id'], $data['aula_id'], $data['year_id'],
            $data['recurrente'], $data['regla_recurrencia'], $data['color'], $data['estado']
        ];
        $this->ejecutarConsultaParam($sql, $params);
        return $this->conectar()->lastInsertId();
    }

    public function actualizarEvento($id, $data) {
        $sql = "UPDATE calendario SET titulo=?, descripcion=?, fecha_inicio=?, fecha_fin=?, todo_dia=?, ubicacion=?, categoria_id=?, usuario_id=?, grado_id=?, curso_id=?, aula_id=?, year_id=?, recurrente=?, regla_recurrencia=?, color=?, estado=?, updated_at=NOW() WHERE id=?";
        $params = [
            $data['titulo'], $data['descripcion'], $data['fecha_inicio'], $data['fecha_fin'],
            $data['todo_dia'], $data['ubicacion'], $data['categoria_id'], $data['usuario_id'],
            $data['grado_id'], $data['curso_id'], $data['aula_id'], $data['year_id'],
            $data['recurrente'], $data['regla_recurrencia'], $data['color'], $data['estado'], $id
        ];
        $this->ejecutarConsultaParam($sql, $params);
    }

    public function eliminarEvento($id) {
        $sql = "UPDATE calendario SET estado='INACTIVO', updated_at=NOW() WHERE id=?";
        $this->ejecutarConsultaParam($sql, [$id]);
    }

    public function obtenerEvento($id) {
        $sql = "SELECT * FROM calendario WHERE id=?";
        $stmt = $this->ejecutarConsultaParam($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function ejecutarConsultaSimple($consulta) {
        $conexion = $this->conectar();
        $sql = $conexion->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    protected function ejecutarConsultaParam($sql, $params) {
        $conexion = $this->conectar();
        $stmt = $conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
?>
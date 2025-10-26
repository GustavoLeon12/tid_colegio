<?php
require_once 'main_model.php'; // Ajusta ruta si necesario

class CalendarioModel extends mainModel
{
    public function listarEventos()
    {
        $consulta = "SELECT 
        c.id, 
        c.titulo, 
        c.descripcion, 
        c.fecha_inicio, 
        c.fecha_fin, 
        c.todo_dia, 
        c.ubicacion,
        c.usuario_id, 
        COALESCE(CONCAT(d.nombres, ' ', d.apellidos), 'Sin docente') AS docente_nombre,
        c.grado_id, 
        COALESCE(g.gradonombre, 'Sin grado') AS grado_nombre,
        c.curso_id, 
        COALESCE(cur.nonbrecurso, 'Sin curso') AS curso_nombre,
        c.aula_id, 
        COALESCE(a.nombreaula, 'Sin aula') AS aula_nombre,
        c.year_id, 
        COALESCE(y.yearScolar, 'Sin año escolar') AS year_anio,
        c.recurrente, 
        c.regla_recurrencia, 
        c.color, 
        c.estado, 
        c.fecha_creacion AS created_at, 
        c.fecha_actualizacion AS updated_at
    FROM calendario c
    LEFT JOIN docentes d ON c.usuario_id = d.id_docente
    LEFT JOIN grado g ON c.grado_id = g.idgrado
    LEFT JOIN curso cur ON c.curso_id = cur.idcurso
    LEFT JOIN aula a ON c.aula_id = a.idaula
    LEFT JOIN yearscolar y ON c.year_id = y.id_year
    WHERE c.estado = 'ACTIVO'
    ORDER BY c.fecha_inicio DESC";

        $sql = $this->ejecutarConsultaSimple($consulta);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener docentes
    public function obtenerDocentes()
    {
        $sql = "SELECT id_docente, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM docentes";
        $query = $this->ejecutarConsultaSimple($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener grados
    public function obtenerGrados()
    {
        $sql = "SELECT idgrado, gradonombre FROM grado WHERE gradostatus = 'ACTIVO'";
        $query = $this->ejecutarConsultaSimple($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener cursos
    public function obtenerCursos()
    {
        $sql = "SELECT idcurso, nonbrecurso FROM curso";
        $query = $this->ejecutarConsultaSimple($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener aulas
    public function obtenerAulas()
    {
        $sql = "SELECT idaula, nombreaula FROM aula";
        $query = $this->ejecutarConsultaSimple($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener años escolares
    public function obtenerYears()
    {
        $sql = "SELECT id_year, yearScolar FROM yearscolar WHERE stadoyear = 'ACTIVO'";
        $query = $this->ejecutarConsultaSimple($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function crearEvento($data)
    {
        $sql = "INSERT INTO calendario (titulo, descripcion, fecha_inicio, fecha_fin, todo_dia, ubicacion, usuario_id, grado_id, curso_id, aula_id, year_id, recurrente, regla_recurrencia, color, estado, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $params = [
            $data['titulo'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
            $data['todo_dia'],
            $data['ubicacion'],
            $data['usuario_id'],
            $data['grado_id'],
            $data['curso_id'],
            $data['aula_id'],
            $data['year_id'],
            $data['recurrente'],
            $data['regla_recurrencia'],
            $data['color'],
            $data['estado']
        ];
        $this->ejecutarConsultaParam($sql, $params);
        return $this->conectar()->lastInsertId();
    }

    public function actualizarEvento($id, $data)
    {
        $sql = "UPDATE calendario SET titulo=?, descripcion=?, fecha_inicio=?, fecha_fin=?, todo_dia=?, ubicacion=?, usuario_id=?, grado_id=?, curso_id=?, aula_id=?, year_id=?, recurrente=?, regla_recurrencia=?, color=?, estado=?, fecha_actualizacion=NOW() WHERE id=?";
        $params = [
            $data['titulo'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
            $data['todo_dia'],
            $data['ubicacion'],
            $data['usuario_id'],
            $data['grado_id'],
            $data['curso_id'],
            $data['aula_id'],
            $data['year_id'],
            $data['recurrente'],
            $data['regla_recurrencia'],
            $data['color'],
            $data['estado'],
            $id
        ];
        $this->ejecutarConsultaParam($sql, $params);
    }

    public function eliminarEvento($id)
    {
        $sql = "UPDATE calendario SET estado='INACTIVO', fecha_actualizacion=NOW() WHERE id=?";
        $this->ejecutarConsultaParam($sql, [$id]);
    }

    public function obtenerEvento($id)
    {
        $sql = "SELECT * FROM calendario WHERE id=?";
        $stmt = $this->ejecutarConsultaParam($sql, [$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function ejecutarConsultaSimple($consulta)
    {
        $conexion = $this->conectar();
        $sql = $conexion->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    protected function ejecutarConsultaParam($sql, $params)
    {
        $conexion = $this->conectar();
        $stmt = $conexion->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
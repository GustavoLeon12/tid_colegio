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
    WHERE c.estado IN ('ACTIVO', 'INACTIVO', 'CANCELADO')
    ORDER BY c.fecha_inicio DESC";

        $sql = $this->ejecutarConsultaSimple($consulta);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar eventos para FullCalendar
    public function listarEventosCalendario()
    {
        $consulta = "SELECT 
        id,
        titulo AS title,
        fecha_inicio AS start,
        fecha_fin AS end,
        color AS backgroundColor,
        color AS borderColor,
        'white' AS textColor,
        descripcion,
        ubicacion,
        recurrente,
        regla_recurrencia
    FROM calendario
    WHERE estado = 'ACTIVO'";

        $sql = $this->ejecutarConsultaSimple($consulta);
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener docentes
    public function obtenerDocentes()
    {
        try {
            $sql = "SELECT id_docente, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM docentes";
            $query = $this->ejecutarConsultaSimple($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en obtenerDocentes: " . $e->getMessage());
            return [];
        }
    }

    // Obtener grados
    public function obtenerGrados()
    {
        try {
            $sql = "SELECT idgrado, gradonombre FROM grado WHERE gradostatus = 'ACTIVO'";
            $query = $this->ejecutarConsultaSimple($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en obtenerGrados: " . $e->getMessage());
            return [];
        }
    }

    // Obtener cursos
    public function obtenerCursos()
    {
        try {
            $sql = "SELECT idcurso, nonbrecurso FROM curso";
            $query = $this->ejecutarConsultaSimple($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en obtenerCursos: " . $e->getMessage());
            return [];
        }
    }

    // Obtener aulas
    public function obtenerAulas()
    {
        try {
            $sql = "SELECT idaula, nombreaula FROM aula";
            $query = $this->ejecutarConsultaSimple($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en obtenerAulas: " . $e->getMessage());
            return [];
        }
    }

    // Obtener años escolares
    public function obtenerYears()
    {
        try {
            $sql = "SELECT id_year, yearScolar FROM yearscolar WHERE stadoyear = 'ACTIVO'";
            $query = $this->ejecutarConsultaSimple($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en obtenerYears: " . $e->getMessage());
            return [];
        }
    }

    // Listar eventos con filtros
    public function listarEventosFiltrados($params = [])
    {
        $consulta = "SELECT 
            c.id, c.titulo, c.descripcion, c.fecha_inicio, c.fecha_fin, c.ubicacion,
            c.usuario_id, COALESCE(CONCAT(d.nombres, ' ', d.apellidos), 'Sin docente') AS docente_nombre,
            c.grado_id, COALESCE(g.gradonombre, 'Sin grado') AS grado_nombre,
            c.curso_id, COALESCE(cur.nonbrecurso, 'Sin curso') AS curso_nombre,
            c.aula_id, COALESCE(a.nombreaula, 'Sin aula') AS aula_nombre,
            c.year_id, COALESCE(y.yearScolar, 'Sin año escolar') AS year_anio,
            c.recurrente, c.regla_recurrencia, c.color, c.estado, 
            c.fecha_creacion AS created_at, c.fecha_actualizacion AS updated_at
        FROM calendario c
        LEFT JOIN docentes d ON c.usuario_id = d.id_docente
        LEFT JOIN grado g ON c.grado_id = g.idgrado
        LEFT JOIN curso cur ON c.curso_id = cur.idcurso
        LEFT JOIN aula a ON c.aula_id = a.idaula
        LEFT JOIN yearscolar y ON c.year_id = y.id_year
        WHERE c.estado IN ('ACTIVO', 'INACTIVO', 'CANCELADO')";

        $where = [];
        $bindParams = [];

        if (!empty($params['usuario_id'])) {
            $where[] = "c.usuario_id = ?";
            $bindParams[] = $params['usuario_id'];
        }
        if (!empty($params['grado_id'])) {
            $where[] = "c.grado_id = ?";
            $bindParams[] = $params['grado_id'];
        }
        if (!empty($params['curso_id'])) {
            $where[] = "c.curso_id = ?";
            $bindParams[] = $params['curso_id'];
        }
        if (!empty($params['aula_id'])) {
            $where[] = "c.aula_id = ?";
            $bindParams[] = $params['aula_id'];
        }
        if (!empty($params['year_id'])) {
            $where[] = "c.year_id = ?";
            $bindParams[] = $params['year_id'];
        }
        if (!empty($params['fecha_inicio'])) {
            $where[] = "c.fecha_inicio >= ?";
            $bindParams[] = $params['fecha_inicio'] . ' 00:00:00';
        }
        if (!empty($params['fecha_fin'])) {
            $where[] = "c.fecha_inicio <= ?";
            $bindParams[] = $params['fecha_fin'] . ' 23:59:59';
        }

        if (!empty($where)) {
            $consulta .= " AND " . implode(' AND ', $where);
        }

        $consulta .= " ORDER BY c.fecha_inicio ASC";

        $stmt = $this->ejecutarConsultaParam($consulta, $bindParams);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function crearEvento($data)
    {
        // Convertir vacíos a NULL
        $data['usuario_id'] = $data['usuario_id'] !== "" ? $data['usuario_id'] : null;
        $data['grado_id']   = $data['grado_id']   !== "" ? $data['grado_id']   : null;
        $data['curso_id']   = $data['curso_id']   !== "" ? $data['curso_id']   : null;
        $data['aula_id']    = $data['aula_id']    !== "" ? $data['aula_id']    : null;

        $sql = "INSERT INTO calendario (titulo, descripcion, fecha_inicio, fecha_fin, ubicacion, usuario_id, grado_id, curso_id, aula_id, year_id, recurrente, regla_recurrencia, color, estado, fecha_creacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $params = [
            $data['titulo'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
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
        // Convertir vacíos a NULL
        $data['usuario_id'] = $data['usuario_id'] !== "" ? $data['usuario_id'] : null;
        $data['grado_id']   = $data['grado_id']   !== "" ? $data['grado_id']   : null;
        $data['curso_id']   = $data['curso_id']   !== "" ? $data['curso_id']   : null;
        $data['aula_id']    = $data['aula_id']    !== "" ? $data['aula_id']    : null;
        
        $sql = "UPDATE calendario SET titulo=?, descripcion=?, fecha_inicio=?, fecha_fin=?, ubicacion=?, usuario_id=?, grado_id=?, curso_id=?, aula_id=?, year_id=?, recurrente=?, regla_recurrencia=?, color=?, estado=?, fecha_actualizacion=NOW() WHERE id=?";
        $params = [
            $data['titulo'],
            $data['descripcion'],
            $data['fecha_inicio'],
            $data['fecha_fin'],
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
        $sql = "DELETE FROM calendario WHERE id = ?";
        $stmt = $this->ejecutarConsultaParam($sql, [$id]);
        return $stmt->rowCount() > 0;
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

    public function obtenerEstados()
    {
        try {
            $sql = "SHOW COLUMNS FROM calendario LIKE 'estado'";
            $stmt = $this->ejecutarConsultaSimple($sql);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                // Si no existe la columna o hay error, devolver valores por defecto
                return ['ACTIVO', 'INACTIVO', 'CANCELADO'];
            }

            // Extraemos los valores del ENUM (ejemplo: enum('ACTIVO','INACTIVO','CANCELADO'))
            if (preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches)) {
                $enumValues = explode("','", $matches[1]);
                return $enumValues;
            }

            // Si no se pudo parsear, devolver valores por defecto
            return ['ACTIVO', 'INACTIVO', 'CANCELADO'];
            
        } catch (Exception $e) {
            error_log("Error en obtenerEstados: " . $e->getMessage());
            return ['ACTIVO', 'INACTIVO', 'CANCELADO'];
        }
    }
}
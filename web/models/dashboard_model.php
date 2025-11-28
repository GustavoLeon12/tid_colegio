<?php
require_once __DIR__ . '/main_model.php';

class DashboardModel extends mainModel
{
    // Obtener total de noticias
    public function getTotalNoticias()
    {
        $query = "SELECT COUNT(*) as total FROM noticias";
        $result = $this->ejecutarConsulta($query)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Obtener total de eventos
    public function getTotalEventos()
    {
        $query = "SELECT COUNT(*) as total FROM calendario WHERE estado = 'ACTIVO'";
        $result = $this->ejecutarConsulta($query)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Obtener noticias por mes (últimos 12 meses)
    public function getNoticiasPorMes($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }
        
        $query = "SELECT 
                    MONTH(fechaCreacion) as mes,
                    MONTHNAME(fechaCreacion) as mes_nombre,
                    COUNT(*) as total
                  FROM noticias 
                  WHERE YEAR(fechaCreacion) = ?
                  GROUP BY MONTH(fechaCreacion), MONTHNAME(fechaCreacion)
                  ORDER BY MONTH(fechaCreacion)";
        
        $stmt = $this->conectar()->prepare($query);
        $stmt->execute([$year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener eventos por mes (últimos 12 meses)
    public function getEventosPorMes($year = null)
    {
        if (!$year) {
            $year = date('Y');
        }
        
        $query = "SELECT 
                    MONTH(fecha_inicio) as mes,
                    MONTHNAME(fecha_inicio) as mes_nombre,
                    COUNT(*) as total
                  FROM calendario 
                  WHERE YEAR(fecha_inicio) = ? AND estado = 'ACTIVO'
                  GROUP BY MONTH(fecha_inicio), MONTHNAME(fecha_inicio)
                  ORDER BY MONTH(fecha_inicio)";
        
        $stmt = $this->conectar()->prepare($query);
        $stmt->execute([$year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener noticias por categoría
    public function getNoticiasPorCategoria()
    {
        $query = "SELECT 
                    c.nombre as categoria,
                    COUNT(n.id) as total
                  FROM categorias c
                  LEFT JOIN noticias n ON c.id = n.fkCategoria
                  GROUP BY c.id, c.nombre
                  ORDER BY total DESC";
        
        return $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener eventos por estado
    public function getEventosPorEstado()
    {
        $query = "SELECT 
                    estado,
                    COUNT(*) as total
                  FROM calendario
                  GROUP BY estado
                  ORDER BY total DESC";
        
        return $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener últimas noticias
    public function getUltimasNoticias($limit = 5)
    {
        try {
            $limit = (int) $limit;
            if ($limit <= 0) $limit = 5;

            $query = "SELECT 
                    n.id,
                    n.titulo,
                    n.fechaCreacion,
                    c.nombre AS categoria,
                    n.importante
                  FROM noticias n
                  LEFT JOIN categorias c ON n.fkCategoria = c.id
                  ORDER BY n.fechaCreacion DESC
                  LIMIT $limit"; // LIMIT inyectado como entero seguro

            $stmt = $this->conectar()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return is_array($result) ? $result : [];
        } catch (Exception $e) {
            error_log("Error en getUltimasNoticias: " . $e->getMessage());
            return [];
        }
    }

    // Obtener próximos eventos
    public function getProximosEventos($limit = 5)
    {
        try {
            $limit = (int) $limit;
            if ($limit <= 0) $limit = 5;

            $query = "SELECT 
                    id,
                    titulo,
                    fecha_inicio,
                    fecha_fin,
                    ubicacion,
                    estado
                  FROM calendario
                  WHERE fecha_inicio >= NOW() AND estado = 'ACTIVO'
                  ORDER BY fecha_inicio ASC
                  LIMIT $limit";

            $stmt = $this->conectar()->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return is_array($result) ? $result : [];
        } catch (Exception $e) {
            error_log("Error en getProximosEventos: " . $e->getMessage());
            return [];
        }
    }


    // Obtener años disponibles para filtros
    public function getYearsDisponibles()
    {
        $query = "SELECT DISTINCT YEAR(fechaCreacion) as year 
                  FROM noticias 
                  UNION 
                  SELECT DISTINCT YEAR(fecha_inicio) as year 
                  FROM calendario
                  ORDER BY year DESC";
        
        return $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener noticias importantes
    public function getTotalNoticiasImportantes()
    {
        $query = "SELECT COUNT(*) as total FROM noticias WHERE importante = 1";
        $result = $this->ejecutarConsulta($query)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Obtener eventos recurrentes
    public function getTotalEventosRecurrentes()
    {
        $query = "SELECT COUNT(*) as total FROM calendario WHERE recurrente = 1 AND estado = 'ACTIVO'";
        $result = $this->ejecutarConsulta($query)->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
?>
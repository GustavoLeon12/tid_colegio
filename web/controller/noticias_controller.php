<?php
require_once __DIR__ . '/../models/main_model.php';
require_once __DIR__ . '/../../sistema/helper/save_image.php';

class NoticiasController extends mainModel
{
    public function crearNoticia()
    {
        $title = $_POST["title"] ?? '';
        $content = $_POST["contentNotice"] ?? '';
        $currentDate = date('Y-m-d H:i:s');
        $autor = $_POST['user'] ?? 0;
        $category = $_POST["category"] ?? 0;
        $importante = isset($_POST["importante"]) ? 1 : 0;
        $routeImage = saveImage();

        if ($routeImage === 'default.jpg' && !isset($_FILES['image'])) {
            $json = json_encode(['status' => 400, 'message' => 'No se subió ninguna imagen']);
            header("Content-Type: application/json");
            echo $json;
            exit;
        }

        // Validar fkCategoria
        $query = "SELECT id FROM categorias WHERE id = ?";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $category, PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt->fetch()) {
            $json = json_encode(['status' => 400, 'message' => 'Categoría no válida']);
            header("Content-Type: application/json");
            echo $json;
            exit;
        }

        $query = "INSERT INTO noticias (titulo, portada, descripcion, fechaCreacion, fkCategoria, fkUsuario, importante) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $routeImage, PDO::PARAM_STR);
        $stmt->bindParam(3, $content, PDO::PARAM_STR);
        $stmt->bindParam(4, $currentDate, PDO::PARAM_STR);
        $stmt->bindParam(5, $category, PDO::PARAM_INT);
        $stmt->bindParam(6, $autor, PDO::PARAM_INT);
        $stmt->bindParam(7, $importante, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $json = json_encode(['status' => 200, 'message' => '¡Noticia creada con éxito!', 'dir' => $routeImage]);
        } else {
            $json = json_encode(['status' => 500, 'message' => 'Error al crear la noticia: ' . $stmt->errorInfo()[2]]);
        }

        header("Content-Type: application/json");
        echo $json;
    }

    public function obtenerNoticias()
    {
        $query = "SELECT b.fkCategoria, b.id, b.fechaCreacion, b.titulo, b.portada, b.descripcion, u.usu_apellidos as usuario, c.nombre as categoria, b.importante 
                  FROM noticias b 
                  LEFT JOIN categorias c ON c.id = b.fkCategoria 
                  LEFT JOIN usuarios u ON u.usu_id = b.fkUsuario 
                  WHERE c.privado = 0";
        $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function obtenerNoticia()
    {
        $id = $_GET["id"] ?? 0;
        $query = "SELECT b.id, b.titulo, b.descripcion, b.portada, b.fkCategoria, b.importante, u.usu_apellidos as usuario 
                  FROM noticias b 
                  LEFT JOIN usuarios u ON u.usu_id = b.fkUsuario 
                  WHERE b.id = ?";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($result ?: false);
    }

    public function deleteNoticia()
    {
        $id = $_POST["id"] ?? 0;
        // Obtener la imagen actual para eliminarla
        $query = "SELECT portada FROM noticias WHERE id = ?";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        $portada = $stmt->fetch(PDO::FETCH_ASSOC)['portada'] ?? '';

        // Eliminar la imagen del servidor si no es default.jpg
        if ($portada && $portada !== 'default.jpg' && file_exists($GLOBALS['images_path'] . $portada)) {
            unlink($GLOBALS['images_path'] . $portada);
        }

        // Eliminar la noticia
        $query = "DELETE FROM noticias WHERE id = ?";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $json = json_encode(['status' => 200, 'message' => 'Noticia eliminada con éxito']);
        } else {
            $json = json_encode(['status' => 500, 'message' => 'Error al eliminar la noticia: ' . $stmt->errorInfo()[2]]);
        }

        header("Content-Type: application/json");
        echo $json;
    }

    public function updateNoticia()
    {
        $title = $_POST["title"] ?? '';
        $content = $_POST["contentNotice"] ?? '';
        $id = $_POST["id"] ?? 0;
        $category = $_POST["category"] ?? 0;
        $currentDate = date('Y-m-d H:i:s');
        $autor = $_POST['autor'] ?? 0;
        $importante = isset($_POST["importante"]) ? 1 : 0;
        $image = '';

        // Validar fkCategoria
        $query = "SELECT id FROM categorias WHERE id = ?";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $category, PDO::PARAM_INT);
        $stmt->execute();
        if (!$stmt->fetch()) {
            $json = json_encode(['status' => 400, 'message' => 'Categoría no válida']);
            header("Content-Type: application/json");
            echo $json;
            exit;
        }

        // Verificar si se subió una nueva imagen
        if (isset($_FILES["image"]) && $_FILES["image"]['error'] === UPLOAD_ERR_OK) {
            $image = saveImage();
            if ($image === 'default.jpg') {
                $json = json_encode(['status' => 500, 'message' => 'Error al subir la imagen']);
                header("Content-Type: application/json");
                echo $json;
                exit;
            }

            // Eliminar la imagen antigua
            $query = "SELECT portada FROM noticias WHERE id = ?";
            $stmt = $this->conectar()->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $oldImage = $stmt->fetch(PDO::FETCH_ASSOC)['portada'] ?? '';
            if ($oldImage && $oldImage !== 'default.jpg' && file_exists($GLOBALS['images_path'] . $oldImage)) {
                unlink($GLOBALS['images_path'] . $oldImage);
            }
        } else {
            // Mantener la imagen actual
            $query = "SELECT portada FROM noticias WHERE id = ?";
            $stmt = $this->conectar()->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            $image = $stmt->fetch(PDO::FETCH_ASSOC)['portada'] ?? 'default.jpg';
        }

        $query = "UPDATE noticias SET titulo = ?, portada = ?, descripcion = ?, fechaCreacion = ?, fkCategoria = ?, fkUsuario = ?, importante = ? WHERE id = ?";
        $stmt = $this->conectar()->prepare($query);
        $stmt->bindParam(1, $title, PDO::PARAM_STR);
        $stmt->bindParam(2, $image, PDO::PARAM_STR);
        $stmt->bindParam(3, $content, PDO::PARAM_STR);
        $stmt->bindParam(4, $currentDate, PDO::PARAM_STR);
        $stmt->bindParam(5, $category, PDO::PARAM_INT);
        $stmt->bindParam(6, $autor, PDO::PARAM_INT);
        $stmt->bindParam(7, $importante, PDO::PARAM_INT);
        $stmt->bindParam(8, $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $json = json_encode(['status' => 200, 'message' => 'Noticia actualizada con éxito', 'dir' => $image]);
        } else {
            $json = json_encode(['status' => 500, 'message' => 'Error al actualizar la noticia: ' . $stmt->errorInfo()[2]]);
        }

        header("Content-Type: application/json");
        echo $json;
    }

    public function obtenerNoticiasPrivado()
    {
        $query = "SELECT b.id, b.fechaCreacion, b.titulo, b.portada, b.descripcion, 
                     u.usu_apellidos as usuario, c.nombre as categoria, b.importante,
                     b.fkCategoria
              FROM noticias b 
              LEFT JOIN categorias c ON c.id = b.fkCategoria 
              LEFT JOIN usuarios u ON u.usu_id = b.fkUsuario 
              ORDER BY b.fechaCreacion DESC";

        $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function obtenerNoticiasFiltradas($categoria, $estado, $noticias_ids = [])
    {
        $query = "SELECT b.id, b.fechaCreacion, b.titulo, b.portada, b.descripcion, 
                     u.usu_apellidos as usuario, c.nombre as categoria, b.importante,
                     b.fkCategoria
              FROM noticias b 
              LEFT JOIN categorias c ON c.id = b.fkCategoria 
              LEFT JOIN usuarios u ON u.usu_id = b.fkUsuario 
              WHERE 1=1";

        $params = [];

        // Si se proporcionan IDs específicos, usar esos
        if (!empty($noticias_ids) && is_array($noticias_ids)) {
            $placeholders = str_repeat('?,', count($noticias_ids) - 1) . '?';
            $query .= " AND b.id IN ($placeholders)";
            $params = array_merge($params, $noticias_ids);
        } else {
            // Filtrar por categoría
            if ($categoria !== 'todas') {
                $query .= " AND b.fkCategoria = ?";
                $params[] = $categoria;
            }

            // Filtrar por estado importante
            if ($estado === 'importantes') {
                $query .= " AND b.importante = 1";
            } elseif ($estado === 'normales') {
                $query .= " AND b.importante = 0";
            }
        }

        // Ordenar por fecha
        if (empty($noticias_ids)) {
            $query .= " ORDER BY b.fechaCreacion DESC";
        }

        $stmt = $this->conectar()->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerCategoriasConConteo()
    {
        $query = "SELECT c.id, c.nombre, COUNT(b.id) as total_noticias
              FROM categorias c 
              LEFT JOIN noticias b ON c.id = b.fkCategoria 
              GROUP BY c.id, c.nombre 
              ORDER BY c.nombre";

        $result = $this->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
        header("Content-Type: application/json");
        echo json_encode($result);
    }

    public function generarExcel()
    {
        // DESACTIVAR ERRORES PERO NO LIMPIAR BUFFERS AQUÍ
        error_reporting(0);
        ini_set('display_errors', 0);

        $categoria = $_POST["categoria"] ?? 'todas';
        $estado = $_POST["estado"] ?? 'todas';
        $noticias_ids = json_decode($_POST["noticias_ids"] ?? '[]', true);

        // Validar que noticias_ids sea un array
        if (!is_array($noticias_ids)) {
            $noticias_ids = [];
        }

        try {
            // Obtener datos primero
            $noticias = $this->obtenerNoticiasFiltradas($categoria, $estado, $noticias_ids);

            // Verificar que hay datos
            if (empty($noticias)) {
                // Solo enviar error si no hay datos
                if (ob_get_length()) ob_clean();
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => false,
                    'message' => 'No hay noticias para generar el reporte'
                ]);
                exit;
            }

            // Incluir la clase del reporte
            require_once __DIR__ . '/../views/reportes/reporte_noticiaexcel.php';

            // Generar el reporte - DELEGAR COMPLETAMENTE
            $reporte = new ReporteNoticiaExcel($noticias, $categoria, $estado);
            $reporte->generar();
        } catch (Exception $e) {
            // SOLO en caso de error, limpiar y enviar JSON
            if (ob_get_length()) ob_clean();
            header('Content-Type: application/json');
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error al generar Excel: ' . $e->getMessage()
            ]);
            exit;
        }
    }
}

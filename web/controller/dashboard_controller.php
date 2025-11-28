<?php
require_once __DIR__ . '/../models/dashboard_model.php';

header('Content-Type: application/json; charset=utf-8');

$model = new DashboardModel();
$method = $_SERVER['REQUEST_METHOD'];
$accion = $_GET['accion'] ?? $_POST['accion'] ?? null;

try {
    // Obtener estadísticas generales
    if ($method === 'GET' && $accion === 'estadisticas_generales') {
        $data = [
            'total_noticias' => $model->getTotalNoticias(),
            'total_eventos' => $model->getTotalEventos(),
            'noticias_importantes' => $model->getTotalNoticiasImportantes(),
            'eventos_recurrentes' => $model->getTotalEventosRecurrentes()
        ];
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener noticias por mes
    if ($method === 'GET' && $accion === 'noticias_por_mes') {
        $year = $_GET['year'] ?? date('Y');
        $data = $model->getNoticiasPorMes($year);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener eventos por mes
    if ($method === 'GET' && $accion === 'eventos_por_mes') {
        $year = $_GET['year'] ?? date('Y');
        $data = $model->getEventosPorMes($year);
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener noticias por categoría
    if ($method === 'GET' && $accion === 'noticias_por_categoria') {
        $data = $model->getNoticiasPorCategoria();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener eventos por estado
    if ($method === 'GET' && $accion === 'eventos_por_estado') {
        $data = $model->getEventosPorEstado();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener últimas noticias
    if ($method === 'GET' && $accion === 'ultimas_noticias') {
        $limit = intval($_GET['limit'] ?? 5);
        $data = $model->getUltimasNoticias($limit);
        
        // Asegurar que siempre se devuelve un array
        if (!is_array($data)) {
            $data = [];
        }
        
        ob_end_clean();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener próximos eventos
    if ($method === 'GET' && $accion === 'proximos_eventos') {
        $limit = intval($_GET['limit'] ?? 5);
        $data = $model->getProximosEventos($limit);
        
        // Asegurar que siempre se devuelve un array
        if (!is_array($data)) {
            $data = [];
        }
        
        ob_end_clean();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Obtener años disponibles
    if ($method === 'GET' && $accion === 'years_disponibles') {
        $data = $model->getYearsDisponibles();
        
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    throw new Exception('Acción no válida.');

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
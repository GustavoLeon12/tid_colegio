<?php
require_once __DIR__ . '/../models/calendario_model.php';
header('Content-Type: application/json; charset=utf-8');

$model = new CalendarioModel();
$method = $_SERVER['REQUEST_METHOD'];
$accion = $_GET['accion'] ?? null;

$input = json_decode(file_get_contents('php://input'), true) ?? [];

try {
    // LISTAR EVENTOS
    if ($method === 'GET' && $accion === 'listar') {
        $eventos = $model->listarEventos();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // CREAR EVENTO
    if ($method === 'POST' && ($accion === 'crear' || empty($accion))) {
        if (empty($input['titulo']) || empty($input['fecha_inicio'])) {
            throw new Exception('Faltan datos obligatorios.');
        }

        $fechaInicio = new DateTime($input['fecha_inicio']);
        $fechaFin = !empty($input['fecha_fin']) ? new DateTime($input['fecha_fin']) : null;

        $data = [
            'titulo' => $input['titulo'],
            'descripcion' => $input['descripcion'] ?? '',
            'fecha_inicio' => $fechaInicio->format('Y-m-d H:i:s'),
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d H:i:s') : null,
            'todo_dia' => !empty($input['todo_dia']) ? 1 : 0,
            'ubicacion' => $input['ubicacion'] ?? '',
            'categoria_id' => $input['categoria_id'] ?? null,
            'usuario_id' => $input['usuario_id'] ?? null,
            'grado_id' => $input['grado_id'] ?? null,
            'curso_id' => $input['curso_id'] ?? null,
            'aula_id' => $input['aula_id'] ?? null,
            'year_id' => $input['year_id'] ?? null,
            'recurrente' => $input['recurrente'] ?? 0,
            'regla_recurrencia' => $input['regla_recurrencia'] ?? null,
            'color' => $input['color'] ?? '#173f78',
            'estado' => 'ACTIVO'
        ];

        $id = $model->crearEvento($data);
        echo json_encode(['success' => true, 'id' => $id]);
        exit;
    }

    // ACTUALIZAR EVENTO
    if ($method === 'POST' && $accion === 'actualizar') {
        if (empty($input['id'])) {
            throw new Exception('ID no proporcionado.');
        }

        $fechaInicio = !empty($input['fecha_inicio']) ? new DateTime($input['fecha_inicio']) : null;
        $fechaFin = !empty($input['fecha_fin']) ? new DateTime($input['fecha_fin']) : null;

        $data = [
            'titulo' => $input['titulo'] ?? '',
            'descripcion' => $input['descripcion'] ?? '',
            'fecha_inicio' => $fechaInicio ? $fechaInicio->format('Y-m-d H:i:s') : null,
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d H:i:s') : null,
            'todo_dia' => !empty($input['todo_dia']) ? 1 : 0,
            'ubicacion' => $input['ubicacion'] ?? '',
            'categoria_id' => $input['categoria_id'] ?? null,
            'usuario_id' => $input['usuario_id'] ?? null,
            'grado_id' => $input['grado_id'] ?? null,
            'curso_id' => $input['curso_id'] ?? null,
            'aula_id' => $input['aula_id'] ?? null,
            'year_id' => $input['year_id'] ?? null,
            'recurrente' => $input['recurrente'] ?? 0,
            'regla_recurrencia' => $input['regla_recurrencia'] ?? null,
            'color' => $input['color'] ?? '#173f78',
            'estado' => $input['estado'] ?? 'ACTIVO'
        ];

        $model->actualizarEvento($input['id'], $data);
        echo json_encode(['success' => true]);
        exit;
    }

    // ELIMINAR EVENTO
    if ($method === 'POST' && $accion === 'eliminar') {
        if (empty($input['id'])) {
            throw new Exception('ID no proporcionado.');
        }
        $model->eliminarEvento($input['id']);
        echo json_encode(['success' => true]);
        exit;
    }

    // OBTENER EVENTO POR ID
    if ($method === 'GET' && $accion === 'obtener') {
        if (empty($_GET['id'])) {
            throw new Exception('ID no proporcionado.');
        }
        $evento = $model->obtenerEvento($_GET['id']);
        echo json_encode($evento ?: ['error' => 'No encontrado']);
        exit;
    }

    // LISTAR DATOS DE COMBOS (categorías, grados, etc.)
    if ($method === 'GET' && $accion === 'combos') {
        $tipo = $_GET['tipo'] ?? '';
        $data = [];

        switch ($tipo) {
            case 'categorias':
                $data = $model->obtenerCategorias();
                break;
            case 'docentes':
                $data = $model->obtenerDocentes();
                break;
            case 'grados':
                $data = $model->obtenerGrados();
                break;
            case 'cursos':
                $data = $model->obtenerCursos();
                break;
            case 'aulas':
                $data = $model->obtenerAulas();
                break;
            case 'years':
                $data = $model->obtenerYears();
                break;
            default:
                throw new Exception('Tipo de combo no válido.');
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Si ninguna acción coincide
    throw new Exception('Acción o método no válido.');

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>

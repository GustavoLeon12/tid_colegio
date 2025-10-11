<?php
require_once __DIR__ . '/../models/calendario_model.php';
header('Content-Type: application/json; charset=utf-8');

$model = new CalendarioModel();
$method = $_SERVER['REQUEST_METHOD'];
$accion = $_GET['accion'] ?? null;

// Leer body JSON
$input = json_decode(file_get_contents('php://input'), true) ?? [];

try {
    // --- LISTAR EVENTOS (equivalente a eventos.php) ---
    if ($method === 'GET' || $accion === 'listar') {
        $eventos = $model->listarEventos();
        $data = [];

        foreach ($eventos as $row) {
            $data[] = [
                'id' => $row['id'],
                'title' => $row['titulo'],
                'start' => $row['fecha_inicio'],
                'end' => $row['fecha_fin'],
                'allDay' => (bool)$row['todo_dia'],
                'backgroundColor' => $row['color'] ?? '#173f78',
                'extendedProps' => [
                    'descripcion' => $row['descripcion'] ?? '',
                    'ubicacion' => $row['ubicacion'] ?? ''
                ]
            ];
        }

        echo json_encode($data);
        exit;
    }

    // --- INSERTAR EVENTO (equivalente a insertar_evento.php) ---
    if ($method === 'POST' && ($accion === 'crear' || empty($accion))) {
        if (empty($input['titulo']) || empty($input['start'])) {
            throw new Exception('Faltan datos obligatorios.');
        }

        $fechaInicio = new DateTime($input['start']);
        $fechaFin = !empty($input['end']) ? new DateTime($input['end']) : null;

        $data = [
            'titulo' => $input['titulo'],
            'descripcion' => $input['descripcion'] ?? '',
            'ubicacion' => $input['ubicacion'] ?? '',
            'color' => $input['color'] ?? '#173f78',
            'fecha_inicio' => $fechaInicio->format('Y-m-d H:i:s'),
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d H:i:s') : null,
            'todo_dia' => !empty($input['allDay']) ? 1 : 0
        ];

        $id = $model->crearEvento($data);
        echo json_encode(['success' => true, 'id' => $id]);
        exit;
    }

    // --- ACTUALIZAR EVENTO (equivalente a actualizar_evento.php) ---
    if ($method === 'POST' && $accion === 'actualizar') {
        if (empty($input['id'])) throw new Exception('ID no proporcionado.');

        $fechaInicio = !empty($input['start']) ? new DateTime($input['start']) : null;
        $fechaFin = !empty($input['end']) ? new DateTime($input['end']) : null;

        $data = [
            'titulo' => $input['titulo'] ?? '',
            'descripcion' => $input['descripcion'] ?? '',
            'ubicacion' => $input['ubicacion'] ?? '',
            'color' => $input['color'] ?? '#173f78',
            'fecha_inicio' => $fechaInicio ? $fechaInicio->format('Y-m-d H:i:s') : null,
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d H:i:s') : null,
            'todo_dia' => !empty($input['allDay']) ? 1 : 0
        ];

        $model->actualizarEvento($input['id'], $data);
        echo json_encode(['success' => true]);
        exit;
    }

    // --- ELIMINAR EVENTO (equivalente a eliminar_evento.php) ---
    if ($method === 'POST' && $accion === 'eliminar') {
        if (empty($input['id'])) throw new Exception('ID no proporcionado.');
        $model->eliminarEvento($input['id']);
        echo json_encode(['success' => true]);
        exit;
    }

    throw new Exception('Acción o método no válido.');

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

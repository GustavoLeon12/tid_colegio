<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Composer autoload
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once __DIR__ . '/../models/calendario_model.php';
header('Content-Type: application/json; charset=utf-8');

$model = new CalendarioModel();
$method = $_SERVER['REQUEST_METHOD'];
$accion = $_GET['accion'] ?? null;

$input = json_decode(file_get_contents('php://input'), true) ?? [];

try {
    // LISTAR EVENTOS
    if ($method === 'POST' && $accion === 'listar') {
        $eventos = $model->listarEventos();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // LISTAR EVENTOS SOLO PARA FULLCALENDAR
    if ($method === 'POST' && $accion === 'listar_calendario') {
        $eventos = $model->listarEventosCalendario();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // LISTAR ESTADOS DESDE ENUM
    if ($method === 'GET' && $accion === 'estados') {
        $data = $model->obtenerEstados();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // CREAR EVENTO
    if ($method === 'POST' && ($accion === 'crear' || empty($accion))) {
        if (empty($input['titulo']) || empty($input['fecha_inicio'])) {
            throw new Exception('Faltan datos obligatorios.');
        }

        $fechaInicio = new DateTime($input['fecha_inicio']);
        $fechaFin = !empty($input['fecha_fin']) ? new DateTime($input['fecha_fin']) : null;

        $estadoValido = in_array(($input['estado'] ?? 'ACTIVO'), ['ACTIVO', 'INACTIVO', 'CANCELADO'])
            ? $input['estado']
            : 'ACTIVO';

        $data = [
            'titulo' => $input['titulo'],
            'descripcion' => $input['descripcion'] ?? '',
            'fecha_inicio' => $fechaInicio->format('Y-m-d H:i:s'),
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d H:i:s') : null,
            'todo_dia' => !empty($input['todo_dia']) ? 1 : 0,
            'ubicacion' => $input['ubicacion'] ?? '',
            'usuario_id' => $input['usuario_id'] ?? null,
            'grado_id' => $input['grado_id'] ?? null,
            'curso_id' => $input['curso_id'] ?? null,
            'aula_id' => $input['aula_id'] ?? null,
            'year_id' => $input['year_id'] ?? null,
            'recurrente' => $input['recurrente'] ?? 0,
            'regla_recurrencia' => $input['regla_recurrencia'] ?? null,
            'color' => $input['color'] ?? '#173f78',
            'estado' => $estadoValido
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

        $estadoValido = in_array(($input['estado'] ?? 'ACTIVO'), ['ACTIVO', 'INACTIVO', 'CANCELADO'])
            ? $input['estado']
            : 'ACTIVO';

        $data = [
            'titulo' => $input['titulo'] ?? '',
            'descripcion' => $input['descripcion'] ?? '',
            'fecha_inicio' => $fechaInicio ? $fechaInicio->format('Y-m-d H:i:s') : null,
            'fecha_fin' => $fechaFin ? $fechaFin->format('Y-m-d H:i:s') : null,
            'todo_dia' => !empty($input['todo_dia']) ? 1 : 0,
            'ubicacion' => $input['ubicacion'] ?? '',
            'usuario_id' => $input['usuario_id'] ?? null,
            'grado_id' => $input['grado_id'] ?? null,
            'curso_id' => $input['curso_id'] ?? null,
            'aula_id' => $input['aula_id'] ?? null,
            'year_id' => $input['year_id'] ?? null,
            'recurrente' => $input['recurrente'] ?? 0,
            'regla_recurrencia' => $input['regla_recurrencia'] ?? null,
            'color' => $input['color'] ?? '#173f78',
            'estado' => $estadoValido
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

    // LISTAR DATOS DE COMBOS
    if ($method === 'GET' && $accion === 'combos') {
        $tipo = $_GET['tipo'] ?? '';
        $data = [];

        switch ($tipo) {
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

    // ENVIAR NOTIFICACIÓN PARA EVENTO EXISTENTE
    if ($method === 'POST' && $accion === 'enviar_notif') {
        if (empty($input['id'])) throw new Exception('ID no proporcionado.');
        $evento = $model->obtenerEvento($input['id']);
        if (!$evento) throw new Exception('Evento no encontrado.');

        if (!empty($input['notificacion'])) {
            $notif = $input['notificacion'];
            $dest = $notif['destinatarios'];
            $mensaje = "Evento: {$evento['titulo']}\nDescripción: {$evento['descripcion']}\nInicio: {$evento['fecha_inicio']}\nFin: " . ($evento['fecha_fin'] ?? 'N/A');

            foreach ($dest as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) continue;
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'quelionpc@gmail.com'; // Cambia
                    $mail->Password = 'kqeifrcxtlxcwubi'; // Cambia
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;
                    $mail->CharSet = 'UTF-8';
                    $mail->setFrom('quelionpc@gmail.com', 'Colegio Orion');
                    $mail->addAddress($email);
                    $mail->isHTML(false);
                    $mail->Subject = 'Evento en Calendario';
                    $mail->Body = $mensaje;
                    $mail->send();
                } catch (Exception $e) {
                    error_log("Error email a $email: {$mail->ErrorInfo}");
                }
            }
        }
        echo json_encode(['success' => true]);
        exit;
    }

    throw new Exception('Acción o método no válido.');

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
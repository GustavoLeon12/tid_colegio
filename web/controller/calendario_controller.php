<?php
require_once __DIR__ . '/../vendor/autoload.php';
ob_start(); 

use PHPMailer\PHPMailer\PHPMailer;
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

    // === ENVÍO DE NOTIFICACIÓN (CORREGIDO) ===
    if ($method === 'POST' && $accion === 'enviar_notif') {
        if (empty($input['id'])) {
            throw new Exception('ID no proporcionado.');
        }

        $evento = $model->obtenerEvento($input['id']);
        if (!$evento) {
            throw new Exception('Evento no encontrado.');
        }

        $enviados = 0;
        $errores = [];

        if (!empty($input['notificacion']['destinatarios'])) {
            $dest = $input['notificacion']['destinatarios'];
            $fechaInicio = date('d/m/Y H:i', strtotime($evento['fecha_inicio']));
            $fechaFin = $evento['fecha_fin'] ? date('d/m/Y H:i', strtotime($evento['fecha_fin'])) : 'N/A';
            $todoDia = $evento['todo_dia'] ? 'Sí' : 'No';

            foreach ($dest as $email) {
                $email = trim($email);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores[] = "Email inválido: $email";
                    continue;
                }

                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = 0;
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'quelionpc@gmail.com';
                    $mail->Password   = 'kqeifrcxtlxcwubi';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port       = 587;
                    $mail->CharSet    = 'UTF-8';

                    $mail->setFrom('quelionpc@gmail.com', 'Colegio Orion');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = "Notificación: {$evento['titulo']}";

                    $mail->Body = "
                    <div style='font-family:Arial,sans-serif;max-width:600px;margin:auto;border:1px solid #ddd;'>
                        <div style='background:#173f78;color:white;padding:15px;text-align:center;'>
                            <h2>NOTIFICACIÓN DE EVENTO</h2>
                        </div>
                        <div style='padding:20px;'>
                            <p><strong>Título:</strong> {$evento['titulo']}</p>
                            <p><strong>Descripción:</strong> " . nl2br($evento['descripcion']) . "</p>
                            <hr>
                            <h3>Detalles del Evento</h3>
                            <p><strong>Fecha Inicio:</strong> $fechaInicio</p>
                            <p><strong>Fecha Fin:</strong> $fechaFin</p>
                            <p><strong>Todo el Día:</strong> $todoDia</p>
                            <p><strong>Ubicación:</strong> {$evento['ubicacion']}</p>
                            <p><strong>Estado:</strong> {$evento['estado']}</p>
                            <p><strong>Color:</strong> <span style='background:{$evento['color']};color:white;padding:2px 5px;border-radius:3px;'>{$evento['color']}</span></p>
                        </div>
                        <div style='background:#f4f4f4;padding:10px;text-align:center;font-size:12px;'>
                            Calendario Escolar - Colegio Orion
                        </div>
                    </div>";

                    $mail->send();
                    $enviados++;
                } catch (Exception $e) {
                    $errores[] = "Fallo a $email: " . $e->getMessage();
                }
            }
        }

        ob_end_clean();
        if ($enviados > 0) {
            echo json_encode(['success' => true, 'enviados' => $enviados]);
        } else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'No se envió ningún email.',
                'errores' => $errores
            ]);
        }
        exit;
    }

    throw new Exception('Acción o método no válido.');

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
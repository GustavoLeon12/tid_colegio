<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/calendario_errors.log');

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../../lib/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once __DIR__ . '/../models/calendario_model.php';
header('Content-Type: application/json; charset=utf-8');

$model = new CalendarioModel();
$method = $_SERVER['REQUEST_METHOD'];
$accion = $_GET['accion'] ?? $_POST['accion'] ?? null;
$input = json_decode(file_get_contents('php://input'), true) ?? $_POST ?? [];

try {
    // LISTAR EVENTOS
    if ($method === 'POST' && $accion === 'listar') {
        $eventos = $model->listarEventos();
        ob_end_clean();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // LISTAR EVENTOS SOLO PARA FULLCALENDAR
    if ($method === 'POST' && $accion === 'listar_calendario') {
        $eventos = $model->listarEventosCalendario();
        ob_end_clean();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // LISTAR ESTADOS DESDE ENUM
    if (($method === 'GET' || $method === 'POST') && $accion === 'estados') {
        $data = $model->obtenerEstados();
        ob_end_clean();
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
        ob_end_clean();
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
        ob_end_clean();
        echo json_encode(['success' => true]);
        exit;
    }

    // ELIMINAR EVENTO
    if ($method === 'POST' && $accion === 'eliminar') {
        if (empty($input['id'])) {
            throw new Exception('ID no proporcionado.');
        }
        $model->eliminarEvento($input['id']);
        ob_end_clean();
        echo json_encode(['success' => true]);
        exit;
    }

    // OBTENER EVENTO POR ID
    if (($method === 'GET' || $method === 'POST') && $accion === 'obtener') {
        if (empty($_GET['id'] ?? $input['id'])) {
            throw new Exception('ID no proporcionado.');
        }
        $id = $_GET['id'] ?? $input['id'];
        $evento = $model->obtenerEvento($id);
        ob_end_clean();
        echo json_encode($evento ?: ['error' => 'No encontrado']);
        exit;
    }

    // LISTAR DATOS DE COMBOS
    if (($method === 'GET' || $method === 'POST') && $accion === 'combos') {
        $tipo = $_GET['tipo'] ?? $input['tipo'] ?? '';
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

        ob_end_clean();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // LISTAR FILTRADO PARA TABLA
    if ($method === 'POST' && $accion === 'listar_filtrado') {
        $eventos = $model->listarEventosFiltrados($input);
        ob_end_clean();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // === ENVÍO DE NOTIFICACIÓN ===
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

    // EXPORT PDF - VERSIÓN CORREGIDA
if ($method === 'POST' && $accion === 'export_pdf') {
    // Limpiar cualquier output buffer previo
    while (ob_get_level()) {
        ob_end_clean();
    }
    
    $params = $input;
    $eventos = $model->listarEventosFiltrados($params);
    
    // Incluir la librería TCPDF
    require_once __DIR__ . '/../../lib/TCPDF/tcpdf.php';
    
    // Clase personalizada para el reporte
    class ReporteCalendarioPDF extends TCPDF
    {
        private $eventos;
        private $filtros;

        public function __construct($eventos, $filtros)
        {
            parent::__construct('L', 'mm', 'A4', true, 'UTF-8', false);
            $this->eventos = $eventos;
            $this->filtros = $filtros;
            
            $this->SetCreator('Colegio Orion');
            $this->SetAuthor('Sistema Calendario');
            $this->SetTitle('Reporte de Eventos');
            $this->SetSubject('Export PDF');
            
            // Deshabilitar header y footer automáticos
            $this->setPrintHeader(false);
            $this->setPrintFooter(false);
            
            // Configurar márgenes
            $this->SetMargins(10, 15, 10);
            $this->SetAutoPageBreak(true, 15);
        }

        public function generarReporte()
        {
            $this->AddPage();
            $this->generarEncabezado();
            $this->generarInformacionReporte();
            
            if (empty($this->eventos)) {
                $this->generarMensajeSinDatos();
            } else {
                $this->generarTablaEventos();
                $this->generarResumenEstadistico();
            }
        }

        private function generarEncabezado()
        {
            // Título principal
            $this->SetFont('helvetica', 'B', 18);
            $this->SetTextColor(23, 63, 120); // Color del colegio #173f78
            $this->Cell(0, 8, 'COLEGIO ORION', 0, 1, 'C');
            
            $this->SetFont('helvetica', 'B', 14);
            $this->SetTextColor(80, 80, 80);
            $this->Cell(0, 7, 'REPORTE DE EVENTOS DEL CALENDARIO', 0, 1, 'C');

            // Línea decorativa
            $this->SetLineWidth(0.5);
            $this->SetDrawColor(23, 63, 120);
            $this->Line(10, $this->GetY() + 2, 287, $this->GetY() + 2);
            $this->Ln(5);
        }

        private function generarInformacionReporte()
        {
            $this->SetFont('helvetica', '', 9);
            $this->SetTextColor(0, 0, 0);
            
            // Fecha y total en una línea
            $this->Cell(140, 5, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 0, 'L');
            $this->Cell(137, 5, 'Total: ' . count($this->eventos) . ' eventos', 0, 1, 'R');
            
            // Filtros aplicados (si existen)
            $filtrosTexto = [];
            if (!empty($this->filtros)) {
                foreach ($this->filtros as $key => $value) {
                    if (!empty($value) && $value !== 'todas' && $value !== '') {
                        $filtrosTexto[] = ucfirst($key) . ': ' . $value;
                    }
                }
            }
            
            if (!empty($filtrosTexto)) {
                $this->SetFont('helvetica', 'I', 8);
                $this->SetTextColor(100, 100, 100);
                $this->Cell(0, 5, 'Filtros: ' . implode(' | ', $filtrosTexto), 0, 1, 'L');
            }
            
            $this->Ln(3);
        }

        private function generarMensajeSinDatos()
        {
            $this->SetFont('helvetica', 'I', 12);
            $this->SetTextColor(128, 128, 128);
            $this->Ln(20);
            $this->Cell(0, 10, 'No se encontraron eventos con los criterios aplicados', 0, 1, 'C');
        }

        private function generarTablaEventos()
        {
            // Anchos de columnas optimizados para A4 landscape (277mm útiles)
            $w = [
                'id' => 10,
                'titulo' => 38,
                'inicio' => 28,
                'fin' => 28,
                'todo_dia' => 15,
                'ubicacion' => 30,
                'docente' => 28,
                'grado' => 20,
                'curso' => 20,
                'aula' => 18,
                'year' => 12,
                'estado' => 18
            ];
            
            // Encabezado de la tabla
            $this->SetFont('helvetica', 'B', 8);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(23, 63, 120);
            
            $this->Cell($w['id'], 7, 'ID', 1, 0, 'C', true);
            $this->Cell($w['titulo'], 7, 'TÍTULO', 1, 0, 'C', true);
            $this->Cell($w['inicio'], 7, 'INICIO', 1, 0, 'C', true);
            $this->Cell($w['fin'], 7, 'FIN', 1, 0, 'C', true);
            $this->Cell($w['todo_dia'], 7, 'TODO DÍA', 1, 0, 'C', true);
            $this->Cell($w['ubicacion'], 7, 'UBICACIÓN', 1, 0, 'C', true);
            $this->Cell($w['docente'], 7, 'DOCENTE', 1, 0, 'C', true);
            $this->Cell($w['grado'], 7, 'GRADO', 1, 0, 'C', true);
            $this->Cell($w['curso'], 7, 'CURSO', 1, 0, 'C', true);
            $this->Cell($w['aula'], 7, 'AULA', 1, 0, 'C', true);
            $this->Cell($w['year'], 7, 'AÑO', 1, 0, 'C', true);
            $this->Cell($w['estado'], 7, 'ESTADO', 1, 1, 'C', true);

            // Contenido de la tabla
            $this->SetFont('helvetica', '', 7);
            $this->SetTextColor(0, 0, 0);
            
            $fill = false;
            $row_height = 6;

            foreach ($this->eventos as $evento) {
                // Control de salto de página
                if ($this->GetY() > 180) {
                    $this->AddPage();
                    $this->redibujarEncabezadoTabla($w);
                    $fill = false;
                }
                
                // Color de fondo alternado
                if ($fill) {
                    $this->SetFillColor(245, 245, 245);
                } else {
                    $this->SetFillColor(255, 255, 255);
                }
                
                // Datos de la fila
                $this->Cell($w['id'], $row_height, $evento['id'], 1, 0, 'C', $fill);
                
                $titulo = $this->truncarTexto($evento['titulo'], 40);
                $this->Cell($w['titulo'], $row_height, $titulo, 1, 0, 'L', $fill);
                
                $fechaInicio = date('d/m/Y H:i', strtotime($evento['fecha_inicio']));
                $this->Cell($w['inicio'], $row_height, $fechaInicio, 1, 0, 'C', $fill);
                
                $fechaFin = !empty($evento['fecha_fin']) ? date('d/m/Y H:i', strtotime($evento['fecha_fin'])) : '-';
                $this->Cell($w['fin'], $row_height, $fechaFin, 1, 0, 'C', $fill);
                
                $todoDia = $evento['todo_dia'] ? 'Sí' : 'No';
                $this->Cell($w['todo_dia'], $row_height, $todoDia, 1, 0, 'C', $fill);
                
                $ubicacion = $this->truncarTexto($evento['ubicacion'] ?? '', 30);
                $this->Cell($w['ubicacion'], $row_height, $ubicacion, 1, 0, 'L', $fill);
                
                $docente = $this->truncarTexto($evento['docente_nombre'] ?? '-', 25);
                $this->Cell($w['docente'], $row_height, $docente, 1, 0, 'L', $fill);
                
                $grado = $this->truncarTexto($evento['grado_nombre'] ?? '-', 18);
                $this->Cell($w['grado'], $row_height, $grado, 1, 0, 'L', $fill);
                
                $curso = $this->truncarTexto($evento['curso_nombre'] ?? '-', 18);
                $this->Cell($w['curso'], $row_height, $curso, 1, 0, 'L', $fill);
                
                $aula = $this->truncarTexto($evento['aula_nombre'] ?? '-', 16);
                $this->Cell($w['aula'], $row_height, $aula, 1, 0, 'L', $fill);
                
                $year = $evento['year_anio'] ?? '-';
                $this->Cell($w['year'], $row_height, $year, 1, 0, 'C', $fill);
                
                $this->Cell($w['estado'], $row_height, $evento['estado'], 1, 1, 'C', $fill);
                
                $fill = !$fill;
            }

            $this->Ln(5);
        }

        private function redibujarEncabezadoTabla($w)
        {
            $this->SetFont('helvetica', 'B', 8);
            $this->SetTextColor(255, 255, 255);
            $this->SetFillColor(23, 63, 120);
            
            $this->Cell($w['id'], 7, 'ID', 1, 0, 'C', true);
            $this->Cell($w['titulo'], 7, 'TÍTULO', 1, 0, 'C', true);
            $this->Cell($w['inicio'], 7, 'INICIO', 1, 0, 'C', true);
            $this->Cell($w['fin'], 7, 'FIN', 1, 0, 'C', true);
            $this->Cell($w['todo_dia'], 7, 'TODO DÍA', 1, 0, 'C', true);
            $this->Cell($w['ubicacion'], 7, 'UBICACIÓN', 1, 0, 'C', true);
            $this->Cell($w['docente'], 7, 'DOCENTE', 1, 0, 'C', true);
            $this->Cell($w['grado'], 7, 'GRADO', 1, 0, 'C', true);
            $this->Cell($w['curso'], 7, 'CURSO', 1, 0, 'C', true);
            $this->Cell($w['aula'], 7, 'AULA', 1, 0, 'C', true);
            $this->Cell($w['year'], 7, 'AÑO', 1, 0, 'C', true);
            $this->Cell($w['estado'], 7, 'ESTADO', 1, 1, 'C', true);
            
            $this->SetFont('helvetica', '', 7);
            $this->SetTextColor(0, 0, 0);
        }

        private function generarResumenEstadistico()
        {
            if (count($this->eventos) > 0) {
                $this->SetFont('helvetica', 'B', 10);
                $this->SetTextColor(23, 63, 120);
                $this->Cell(0, 6, 'RESUMEN ESTADÍSTICO', 0, 1);
                
                $this->SetFont('helvetica', '', 8);
                $this->SetTextColor(0, 0, 0);
                
                // Contar por estado
                $estados = [];
                $recurrentes = 0;
                $todoDia = 0;
                
                foreach ($this->eventos as $evento) {
                    $estado = $evento['estado'];
                    $estados[$estado] = isset($estados[$estado]) ? $estados[$estado] + 1 : 1;
                    
                    if ($evento['recurrente']) $recurrentes++;
                    if ($evento['todo_dia']) $todoDia++;
                }
                
                $this->Cell(0, 5, '• Distribución por estado:', 0, 1);
                foreach ($estados as $estado => $count) {
                    $this->Cell(10, 5, '', 0, 0);
                    $this->Cell(0, 5, '  - ' . $estado . ': ' . $count . ' evento(s)', 0, 1);
                }
                
                $this->Cell(0, 5, '• Eventos recurrentes: ' . $recurrentes, 0, 1);
                $this->Cell(0, 5, '• Eventos todo el día: ' . $todoDia, 0, 1);
            }
        }

        private function truncarTexto($texto, $maxLen)
        {
            $texto = trim($texto);
            if (strlen($texto) > $maxLen) {
                return substr($texto, 0, $maxLen - 3) . '...';
            }
            return $texto;
        }

        public function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('helvetica', 'I', 7);
            $this->SetTextColor(128, 128, 128);
            $this->Cell(0, 5, 'Sistema de Gestión - Colegio Orion', 0, 1, 'C');
            $this->Cell(0, 5, 'Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, 0, 'C');
        }
    }

    // Generar el PDF
    $pdf = new ReporteCalendarioPDF($eventos, $params);
    $pdf->generarReporte();
    
    // Enviar al navegador
    $pdf->Output('reporte_calendario_' . date('Ymd_His') . '.pdf', 'D');
    exit;
}

    // EXPORT EXCEL
    if ($method === 'POST' && $accion === 'export_excel') {
        $params = $input;
        $eventos = $model->listarEventosFiltrados($params);
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Título');
        $sheet->setCellValue('C1', 'Fecha Inicio');
        $sheet->setCellValue('D1', 'Fecha Fin');
        $sheet->setCellValue('E1', 'Docente');
        $sheet->setCellValue('F1', 'Grado');
        $sheet->setCellValue('G1', 'Curso');
        $sheet->setCellValue('H1', 'Aula');
        $sheet->setCellValue('I1', 'Año');
        $sheet->setCellValue('J1', 'Ubicación');
        $sheet->setCellValue('K1', 'Estado');
        $row = 2;
        foreach ($eventos as $evento) {
            $sheet->setCellValue('A' . $row, $evento['id']);
            $sheet->setCellValue('B' . $row, $evento['titulo']);
            $sheet->setCellValue('C' . $row, $evento['fecha_inicio']);
            $sheet->setCellValue('D' . $row, $evento['fecha_fin']);
            $sheet->setCellValue('E' . $row, $evento['docente_nombre']);
            $sheet->setCellValue('F' . $row, $evento['grado_nombre']);
            $sheet->setCellValue('G' . $row, $evento['curso_nombre']);
            $sheet->setCellValue('H' . $row, $evento['aula_nombre']);
            $sheet->setCellValue('I' . $row, $evento['year_anio']);
            $sheet->setCellValue('J' . $row, $evento['ubicacion']);
            $sheet->setCellValue('K' . $row, $evento['estado']);
            $row++;
        }
        ob_end_clean();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="calendario.xlsx"');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    throw new Exception('Acción o método no válido.');

} catch (Exception $e) {
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
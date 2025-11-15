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
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
                            <p><strong>Descripción:</strong> " . nl2br(htmlspecialchars($evento['descripcion'])) . "</p>
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

    // EXPORT PDF - VERSIÓN COMPLETAMENTE CORREGIDA
    if ($method === 'POST' && $accion === 'export_pdf') {
        // Limpiar todos los buffers
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        $params = $input;
        $eventos = $model->listarEventosFiltrados($params);
        
        require_once __DIR__ . '/../../lib/TCPDF/tcpdf.php';
        
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
                
                $this->setPrintHeader(false);
                $this->setPrintFooter(false);
                
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
                $this->SetFont('helvetica', 'B', 18);
                $this->SetTextColor(23, 63, 120);
                $this->Cell(0, 8, 'COLEGIO ORION', 0, 1, 'C');
                
                $this->SetFont('helvetica', 'B', 14);
                $this->SetTextColor(80, 80, 80);
                $this->Cell(0, 7, 'REPORTE DE EVENTOS DEL CALENDARIO', 0, 1, 'C');

                $this->SetLineWidth(0.5);
                $this->SetDrawColor(23, 63, 120);
                $this->Line(10, $this->GetY() + 2, 287, $this->GetY() + 2);
                $this->Ln(5);
            }

            private function generarInformacionReporte()
            {
                $this->SetFont('helvetica', '', 9);
                $this->SetTextColor(0, 0, 0);
                
                $this->Cell(140, 5, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 0, 'L');
                $this->Cell(137, 5, 'Total: ' . count($this->eventos) . ' eventos', 0, 1, 'R');
                
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
                // Anchos optimizados para A4 landscape
                $w = [
                    'id' => 8,
                    'titulo' => 35,
                    'descripcion' => 40,
                    'inicio' => 25,
                    'fin' => 25,
                    'ubicacion' => 28,
                    'docente' => 25,
                    'grado' => 18,
                    'curso' => 18,
                    'aula' => 15,
                    'year' => 10,
                    'estado' => 16
                ];
                
                $this->SetFont('helvetica', 'B', 7);
                $this->SetTextColor(255, 255, 255);
                $this->SetFillColor(23, 63, 120);
                
                $this->Cell($w['id'], 7, 'ID', 1, 0, 'C', true);
                $this->Cell($w['titulo'], 7, 'TÍTULO', 1, 0, 'C', true);
                $this->Cell($w['descripcion'], 7, 'DESCRIPCIÓN', 1, 0, 'C', true);
                $this->Cell($w['inicio'], 7, 'INICIO', 1, 0, 'C', true);
                $this->Cell($w['fin'], 7, 'FIN', 1, 0, 'C', true);
                $this->Cell($w['ubicacion'], 7, 'UBICACIÓN', 1, 0, 'C', true);
                $this->Cell($w['docente'], 7, 'DOCENTE', 1, 0, 'C', true);
                $this->Cell($w['grado'], 7, 'GRADO', 1, 0, 'C', true);
                $this->Cell($w['curso'], 7, 'CURSO', 1, 0, 'C', true);
                $this->Cell($w['aula'], 7, 'AULA', 1, 0, 'C', true);
                $this->Cell($w['year'], 7, 'AÑO', 1, 0, 'C', true);
                $this->Cell($w['estado'], 7, 'ESTADO', 1, 1, 'C', true);

                $this->SetFont('helvetica', '', 6.5);
                $this->SetTextColor(0, 0, 0);
                
                $fill = false;

                foreach ($this->eventos as $evento) {
                    if ($this->GetY() > 180) {
                        $this->AddPage();
                        $this->redibujarEncabezadoTabla($w);
                        $fill = false;
                    }
                    
                    $fillColor = $fill ? [245, 245, 245] : [255, 255, 255];
                    $this->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);
                    
                    $this->Cell($w['id'], 6, $evento['id'], 1, 0, 'C', true);
                    $this->Cell($w['titulo'], 6, $this->truncarTexto($evento['titulo'], 35), 1, 0, 'L', true);
                    $this->Cell($w['descripcion'], 6, $this->truncarTexto($evento['descripcion'] ?? '', 45), 1, 0, 'L', true);
                    $this->Cell($w['inicio'], 6, date('d/m/Y H:i', strtotime($evento['fecha_inicio'])), 1, 0, 'C', true);
                    $this->Cell($w['fin'], 6, !empty($evento['fecha_fin']) ? date('d/m/Y H:i', strtotime($evento['fecha_fin'])) : '-', 1, 0, 'C', true);
                    $this->Cell($w['ubicacion'], 6, $this->truncarTexto($evento['ubicacion'] ?? '', 28), 1, 0, 'L', true);
                    $this->Cell($w['docente'], 6, $this->truncarTexto($evento['docente_nombre'] ?? '-', 24), 1, 0, 'L', true);
                    $this->Cell($w['grado'], 6, $this->truncarTexto($evento['grado_nombre'] ?? '-', 17), 1, 0, 'L', true);
                    $this->Cell($w['curso'], 6, $this->truncarTexto($evento['curso_nombre'] ?? '-', 17), 1, 0, 'L', true);
                    $this->Cell($w['aula'], 6, $this->truncarTexto($evento['aula_nombre'] ?? '-', 14), 1, 0, 'L', true);
                    $this->Cell($w['year'], 6, $evento['year_anio'] ?? '-', 1, 0, 'C', true);
                    $this->Cell($w['estado'], 6, $evento['estado'], 1, 1, 'C', true);
                    
                    $fill = !$fill;
                }

                $this->Ln(5);
            }

            private function redibujarEncabezadoTabla($w)
            {
                $this->SetFont('helvetica', 'B', 7);
                $this->SetTextColor(255, 255, 255);
                $this->SetFillColor(23, 63, 120);
                
                $this->Cell($w['id'], 7, 'ID', 1, 0, 'C', true);
                $this->Cell($w['titulo'], 7, 'TÍTULO', 1, 0, 'C', true);
                $this->Cell($w['descripcion'], 7, 'DESCRIPCIÓN', 1, 0, 'C', true);
                $this->Cell($w['inicio'], 7, 'INICIO', 1, 0, 'C', true);
                $this->Cell($w['fin'], 7, 'FIN', 1, 0, 'C', true);
                $this->Cell($w['ubicacion'], 7, 'UBICACIÓN', 1, 0, 'C', true);
                $this->Cell($w['docente'], 7, 'DOCENTE', 1, 0, 'C', true);
                $this->Cell($w['grado'], 7, 'GRADO', 1, 0, 'C', true);
                $this->Cell($w['curso'], 7, 'CURSO', 1, 0, 'C', true);
                $this->Cell($w['aula'], 7, 'AULA', 1, 0, 'C', true);
                $this->Cell($w['year'], 7, 'AÑO', 1, 0, 'C', true);
                $this->Cell($w['estado'], 7, 'ESTADO', 1, 1, 'C', true);
                
                $this->SetFont('helvetica', '', 6.5);
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
                if (mb_strlen($texto) > $maxLen) {
                    return mb_substr($texto, 0, $maxLen - 3) . '...';
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

        $pdf = new ReporteCalendarioPDF($eventos, $params);
        $pdf->generarReporte();
        
        $pdf->Output('reporte_calendario_' . date('Ymd_His') . '.pdf', 'D');
        exit;
    }

    // EXPORT EXCEL - VERSIÓN MEJORADA CON DISEÑO
    if ($method === 'POST' && $accion === 'export_excel') {
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        $params = $input;
        $eventos = $model->listarEventosFiltrados($params);
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Configurar título del reporte
        $sheet->mergeCells('A1:K1');
        $sheet->setCellValue('A1', 'COLEGIO ORION - REPORTE DE EVENTOS');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('173F78');
        $sheet->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getRowDimension(1)->setRowHeight(25);
        
        // Información adicional
        $sheet->mergeCells('A2:K2');
        $sheet->setCellValue('A2', 'Fecha: ' . date('d/m/Y H:i:s') . ' | Total: ' . count($eventos) . ' eventos');
        $sheet->getStyle('A2')->getFont()->setSize(10)->setItalic(true);
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getRowDimension(2)->setRowHeight(18);
        
        // Encabezados
        $headers = ['ID', 'Título', 'Descripción', 'Fecha Inicio', 'Fecha Fin', 'Ubicación', 'Docente', 'Grado', 'Curso', 'Aula', 'Estado'];
        $col = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($col . '4', $header);
            $col++;
        }
        
        // Estilo de encabezados
        $sheet->getStyle('A4:K4')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A4:K4')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:K4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4472C4');
        $sheet->getStyle('A4:K4')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A4:K4')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getRowDimension(4)->setRowHeight(20);
        
        // Datos
        $row = 5;
        foreach ($eventos as $evento) {
            $sheet->setCellValue('A' . $row, $evento['id']);
            $sheet->setCellValue('B' . $row, $evento['titulo']);
            $sheet->setCellValue('C' . $row, $evento['descripcion']);
            $sheet->setCellValue('D' . $row, date('d/m/Y H:i', strtotime($evento['fecha_inicio'])));
            $sheet->setCellValue('E' . $row, !empty($evento['fecha_fin']) ? date('d/m/Y H:i', strtotime($evento['fecha_fin'])) : '-');
            $sheet->setCellValue('F' . $row, $evento['ubicacion'] ?? '');
            $sheet->setCellValue('G' . $row, $evento['docente_nombre'] ?? '-');
            $sheet->setCellValue('H' . $row, $evento['grado_nombre'] ?? '-');
            $sheet->setCellValue('I' . $row, $evento['curso_nombre'] ?? '-');
            $sheet->setCellValue('J' . $row, $evento['aula_nombre'] ?? '-');
            $sheet->setCellValue('K' . $row, $evento['estado']);
            
            // Estilo de fila alternada
            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':K' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
            }
            
            // Bordes
            $sheet->getStyle('A' . $row . ':K' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            
            // Alineación
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $row . ':E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('K' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            $row++;
        }
        
        // Ajustar anchos de columna
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(40);
        $sheet->getColumnDimension('D')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(18);
        $sheet->getColumnDimension('F')->setWidth(25);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(18);
        $sheet->getColumnDimension('K')->setWidth(15);
        
        // Ajustar altura de filas con contenido
        for ($i = 5; $i < $row; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1); // Auto-ajuste
        }
        
        // Footer con resumen
        $row += 2;
        $sheet->mergeCells('A' . $row . ':K' . $row);
        $sheet->setCellValue('A' . $row, 'Sistema de Gestión - Colegio Orion');
        $sheet->getStyle('A' . $row)->getFont()->setSize(9)->setItalic(true);
        $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('E7E6E6');
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="calendario_eventos_' . date('Ymd_His') . '.xlsx"');
        header('Cache-Control: max-age=0');
        
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
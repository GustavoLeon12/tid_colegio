<?php

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

// Exportaciones (PDF y Excel) primero para evitar problemas de headers
if ($method === 'POST' && ($accion === 'export_pdf' || $accion === 'export_excel')) {
    
    // Limpiar TODOS los buffers de salida
    while (ob_get_level()) {
        ob_end_clean();
    }
    
    // Exportar PDF
    if ($accion === 'export_pdf') {
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
                $this->Line(10, $this->GetY() + 2, 277, $this->GetY() + 2);
                $this->Ln(5);
            }

            private function generarInformacionReporte()
            {
                $this->SetFont('helvetica', '', 9);
                $this->SetTextColor(0, 0, 0);

                $this->Cell(140, 5, 'Fecha: ' . date('d/m/Y H:i:s'), 0, 0, 'L');
                $this->Cell(127, 5, 'Total: ' . count($this->eventos) . ' eventos', 0, 1, 'R');

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
                $w = [
                    'id' => 8,
                    'titulo' => 28,
                    'descripcion' => 35,
                    'inicio' => 20,
                    'fin' => 20,
                    'ubicacion' => 25,
                    'docente' => 23,
                    'grado' => 18,
                    'curso' => 18,
                    'aula' => 16,
                    'year' => 12,
                    'estado' => 18
                ];

                $totalWidth = array_sum($w);
                if ($totalWidth !== 277) {
                    $diferencia = 277 - $totalWidth;
                    $w['descripcion'] += $diferencia;
                }

                $this->SetFont('helvetica', 'B', 7);
                $this->SetTextColor(255, 255, 255);
                $this->SetFillColor(23, 63, 120);

                $this->Cell($w['id'], 7, 'ID', 1, 0, 'C', true);
                $this->Cell($w['titulo'], 7, 'TITULO', 1, 0, 'C', true);
                $this->Cell($w['descripcion'], 7, 'DESCRIPCION', 1, 0, 'C', true);
                $this->Cell($w['inicio'], 7, 'INICIO', 1, 0, 'C', true);
                $this->Cell($w['fin'], 7, 'FIN', 1, 0, 'C', true);
                $this->Cell($w['ubicacion'], 7, 'UBICACION', 1, 0, 'C', true);
                $this->Cell($w['docente'], 7, 'DOCENTE', 1, 0, 'C', true);
                $this->Cell($w['grado'], 7, 'GRADO', 1, 0, 'C', true);
                $this->Cell($w['curso'], 7, 'CURSO', 1, 0, 'C', true);
                $this->Cell($w['aula'], 7, 'AULA', 1, 0, 'C', true);
                $this->Cell($w['year'], 7, 'ANO', 1, 0, 'C', true);
                $this->Cell($w['estado'], 7, 'ESTADO', 1, 1, 'C', true);

                $this->SetFont('helvetica', '', 6.5);
                $this->SetTextColor(0, 0, 0);

                $fill = false;

                foreach ($this->eventos as $evento) {
                    if ($this->GetY() > 170) {
                        $this->AddPage();
                        $this->redibujarEncabezadoTabla($w);
                        $fill = false;
                    }

                    $fillColor = $fill ? [245, 245, 245] : [255, 255, 255];
                    $this->SetFillColor($fillColor[0], $fillColor[1], $fillColor[2]);

                    $textos = [
                        'id' => ['text' => (string)$evento['id'], 'width' => $w['id'], 'align' => 'C'],
                        'titulo' => ['text' => $this->truncarTextoParaCelda($evento['titulo'], $w['titulo']), 'width' => $w['titulo'], 'align' => 'L'],
                        'descripcion' => ['text' => $this->truncarTextoParaCelda($evento['descripcion'] ?? '', $w['descripcion']), 'width' => $w['descripcion'], 'align' => 'L'],
                        'inicio' => ['text' => date('d/m/Y H:i', strtotime($evento['fecha_inicio'])), 'width' => $w['inicio'], 'align' => 'C'],
                        'fin' => ['text' => !empty($evento['fecha_fin']) ? date('d/m/Y H:i', strtotime($evento['fecha_fin'])) : '-', 'width' => $w['fin'], 'align' => 'C'],
                        'ubicacion' => ['text' => $this->truncarTextoParaCelda($evento['ubicacion'] ?? '', $w['ubicacion']), 'width' => $w['ubicacion'], 'align' => 'L'],
                        'docente' => ['text' => $this->truncarTextoParaCelda($evento['docente_nombre'] ?? '-', $w['docente']), 'width' => $w['docente'], 'align' => 'L'],
                        'grado' => ['text' => $this->truncarTextoParaCelda($evento['grado_nombre'] ?? '-', $w['grado']), 'width' => $w['grado'], 'align' => 'L'],
                        'curso' => ['text' => $this->truncarTextoParaCelda($evento['curso_nombre'] ?? '-', $w['curso']), 'width' => $w['curso'], 'align' => 'L'],
                        'aula' => ['text' => $this->truncarTextoParaCelda($evento['aula_nombre'] ?? '-', $w['aula']), 'width' => $w['aula'], 'align' => 'L'],
                        'year' => ['text' => $evento['year_anio'] ?? '-', 'width' => $w['year'], 'align' => 'C'],
                        'estado' => ['text' => $evento['estado'], 'width' => $w['estado'], 'align' => 'C']
                    ];
                    
                    // Calcular altura máxima para esta fila
                    $alturaFila = $this->calcularAlturaFila($textos);

                    // Guardar posición inicial
                    $yInicial = $this->GetY();
                    $xInicial = 10;

                    // Dibujar todas las celdas
                    foreach ($textos as $key => $data) {
                        $this->SetXY($xInicial, $yInicial);
                        // Dibujar celda con fondo
                        $this->Cell($data['width'], $alturaFila, '', 1, 0, '', true);
                        // Escribir texto
                        $this->SetXY($xInicial, $yInicial);
                        $this->MultiCell($data['width'], 4, $data['text'], 0, $data['align'], true);
                        $xInicial += $data['width'];
                    }
                    // Mover a siguiente fila
                    $this->SetXY(10, $yInicial + $alturaFila);
                    $fill = !$fill;
                }

                $this->Ln(5);
            }

            private function calcularAlturaFila($textos)
            {
                $alturaMaxima = 6;
                foreach ($textos as $data) {
                    if (empty($data['text'])) continue;
                    $this->SetFont('helvetica', '', 6.5);
                    $numeroLineas = $this->calcularLineasTexto($data['text'], $data['width']);
                    $alturaTexto = $numeroLineas * 4;
                    if ($alturaTexto > $alturaMaxima) {
                        $alturaMaxima = $alturaTexto;
                    }
                }
                return min($alturaMaxima, 30);
            }

            private function calcularLineasTexto($texto, $anchoMaximo)
            {
                if (empty($texto)) return 1;
                $this->SetFont('helvetica', '', 6.5);
                $palabras = explode(' ', $texto);
                $lineaActual = '';
                $numeroLineas = 1;

                foreach ($palabras as $palabra) {
                    $lineaPrueba = $lineaActual . ($lineaActual ? ' ' : '') . $palabra;
                    $anchoLinea = $this->GetStringWidth($lineaPrueba);
                    if ($anchoLinea <= ($anchoMaximo - 2)) {
                        $lineaActual = $lineaPrueba;
                    } else {
                        $numeroLineas++;
                        $lineaActual = $palabra;
                    }
                }
                return $numeroLineas;
            }

            private function truncarTextoParaCelda($texto, $anchoColumna)
            {
                $texto = trim($texto);
                if (empty($texto)) return '';
                $this->SetFont('helvetica', '', 6.5);
                if ($this->GetStringWidth($texto) <= ($anchoColumna - 2)) {
                    return $texto;
                }
                $maxCaracteres = floor($anchoColumna * 3);
                if (mb_strlen($texto) > $maxCaracteres * 3) {
                    return mb_substr($texto, 0, $maxCaracteres * 3) . '...';
                }
                return $texto;
            }

            private function redibujarEncabezadoTabla($w)
            {
                $this->SetFont('helvetica', 'B', 7);
                $this->SetTextColor(255, 255, 255);
                $this->SetFillColor(23, 63, 120);

                $this->Cell($w['id'], 7, 'ID', 1, 0, 'C', true);
                $this->Cell($w['titulo'], 7, 'TITULO', 1, 0, 'C', true);
                $this->Cell($w['descripcion'], 7, 'DESCRIPCION', 1, 0, 'C', true);
                $this->Cell($w['inicio'], 7, 'INICIO', 1, 0, 'C', true);
                $this->Cell($w['fin'], 7, 'FIN', 1, 0, 'C', true);
                $this->Cell($w['ubicacion'], 7, 'UBICACION', 1, 0, 'C', true);
                $this->Cell($w['docente'], 7, 'DOCENTE', 1, 0, 'C', true);
                $this->Cell($w['grado'], 7, 'GRADO', 1, 0, 'C', true);
                $this->Cell($w['curso'], 7, 'CURSO', 1, 0, 'C', true);
                $this->Cell($w['aula'], 7, 'AULA', 1, 0, 'C', true);
                $this->Cell($w['year'], 7, 'ANO', 1, 0, 'C', true);
                $this->Cell($w['estado'], 7, 'ESTADO', 1, 1, 'C', true);

                $this->SetFont('helvetica', '', 6.5);
                $this->SetTextColor(0, 0, 0);
            }

            private function generarResumenEstadistico()
            {
                if (count($this->eventos) > 0) {
                    $this->SetFont('helvetica', 'B', 12);
                    $this->SetTextColor(23, 63, 120);
                    $this->Cell(0, 8, 'RESUMEN ESTADISTICO', 0, 1);
                    $this->Ln(2);

                    $estados = [];
                    $recurrentes = 0;
                    $eventosConDocente = 0;

                    foreach ($this->eventos as $evento) {
                        $estado = $evento['estado'];
                        $estados[$estado] = isset($estados[$estado]) ? $estados[$estado] + 1 : 1;
                        if (!empty($evento['recurrente'])) $recurrentes++;
                        if (!empty($evento['docente_nombre']) && $evento['docente_nombre'] !== '-') {
                            $eventosConDocente++;
                        }
                    }

                    $this->SetFont('helvetica', 'B', 9);
                    $this->SetTextColor(60, 60, 60);
                    $this->Cell(0, 6, 'Distribucion por Estado:', 0, 1);
                    $this->SetFont('helvetica', '', 8);

                    if (!empty($estados)) {
                        $maxEstado = max($estados);
                        foreach ($estados as $estado => $count) {
                            $porcentaje = round(($count / count($this->eventos)) * 100, 1);
                            $anchoBarra = ($count / $maxEstado) * 50;

                            $this->Cell(5, 5, '', 0, 0);
                            $this->Cell(25, 5, $estado . ':', 0, 0, 'L');
                            $this->Cell(30, 5, $count . ' (' . $porcentaje . '%)', 0, 0, 'L');
                            $this->SetFillColor(23, 63, 120);
                            $this->Cell($anchoBarra, 3, '', 0, 0, 'L', true);
                            $this->SetFillColor(255, 255, 255);
                            $this->Ln(5);
                        }
                    }

                    $this->Ln(2);
                    $this->SetFont('helvetica', 'B', 9);
                    $this->Cell(0, 6, 'Metricas Generales:', 0, 1);
                    $this->SetFont('helvetica', '', 8);
                    $this->Cell(80, 5, '- Eventos recurrentes: ' . $recurrentes, 0, 1);
                    $this->Cell(80, 5, '- Con docente asignado: ' . $eventosConDocente, 0, 1);
                    
                    $this->Ln(3);
                    $this->SetFont('helvetica', 'I', 8);
                    $this->SetTextColor(100, 100, 100);
                    $this->Cell(0, 5, 'Resumen generado el ' . date('d/m/Y H:i:s') . ' - ' . count($this->eventos) . ' eventos procesados', 0, 1);
                }
            }

            public function Footer()
            {
                $this->SetY(-15);
                $this->SetFont('helvetica', 'I', 7);
                $this->SetTextColor(128, 128, 128);
                $this->Cell(0, 5, 'Sistema de Gestion - Colegio Orion', 0, 1, 'C');
                $this->Cell(0, 5, 'Pagina ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, 0, 'C');
            }
        }

        $pdf = new ReporteCalendarioPDF($eventos, $params);
        $pdf->generarReporte();
        $pdf->Output('reporte_calendario_' . date('Ymd_His') . '.pdf', 'D');
        exit;
    }
    
    // Exportar execel
    if ($accion === 'export_excel') {
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

        // Encabezados de la tabla
        $headers = ['ID', 'Titulo', 'Descripcion', 'Fecha Inicio', 'Fecha Fin', 'Ubicacion', 'Docente', 'Grado', 'Curso', 'Aula', 'Estado'];
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
            $sheet->setCellValue('C' . $row, $evento['descripcion'] ?? '');
            $sheet->getStyle('C' . $row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue('D' . $row, date('d/m/Y H:i', strtotime($evento['fecha_inicio'])));
            $sheet->setCellValue('E' . $row, !empty($evento['fecha_fin']) ? date('d/m/Y H:i', strtotime($evento['fecha_fin'])) : '-');
            $sheet->setCellValue('F' . $row, $evento['ubicacion'] ?? '');
            $sheet->getStyle('F' . $row)->getAlignment()->setWrapText(true);
            $sheet->setCellValue('G' . $row, $evento['docente_nombre'] ?? '-');
            $sheet->setCellValue('H' . $row, $evento['grado_nombre'] ?? '-');
            $sheet->setCellValue('I' . $row, $evento['curso_nombre'] ?? '-');
            $sheet->setCellValue('J' . $row, $evento['aula_nombre'] ?? '-');
            $sheet->setCellValue('K' . $row, $evento['estado']);

            if ($row % 2 == 0) {
                $sheet->getStyle('A' . $row . ':K' . $row)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
            }

            $sheet->getStyle('A' . $row . ':K' . $row)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle('A' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $row . ':E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('K' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $row++;
        }

        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setAutoSize(false)->setWidth(50);
        $sheet->getColumnDimension('D')->setWidth(18);
        $sheet->getColumnDimension('E')->setWidth(18);
        $sheet->getColumnDimension('F')->setAutoSize(false)->setWidth(35);
        $sheet->getColumnDimension('G')->setWidth(25);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);
        $sheet->getColumnDimension('J')->setWidth(18);
        $sheet->getColumnDimension('K')->setWidth(15);

        for ($i = 5; $i < $row; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(-1);
            $sheet->getStyle('C' . $i)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
            $sheet->getStyle('F' . $i)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_TOP);
        }

        // Footer con resumen
        $row += 2;
        $sheet->mergeCells('A' . $row . ':K' . $row);
        $sheet->setCellValue('A' . $row, 'Sistema de Gestion - Colegio Orion');
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
}

// Establecer cabecera JSON
header('Content-Type: application/json; charset=utf-8');

try {
    // Listar todos los eventos
    if ($method === 'POST' && $accion === 'listar') {
        $eventos = $model->listarEventos();
        ob_end_clean();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Listar eventos solo para calendario fullcalendar
    if ($method === 'POST' && $accion === 'listar_calendario') {
        $eventos_base = $model->listarEventosCalendario();
        $eventos = [];
        foreach ($eventos_base as $evento) {
            if ($evento['recurrente'] && $evento['regla_recurrencia']) {
                $start_dt = new DateTime($evento['start']);
                $max_dt = clone $start_dt;
                $max_dt->modify('+2 months');

                // Parse RRULE simple
                preg_match('/FREQ=(\\w+)/', $evento['regla_recurrencia'], $freq_m);
                $freq = $freq_m[1] ?? 'WEEKLY';
                preg_match('/INTERVAL=(\\d+)/', $evento['regla_recurrencia'], $int_m);
                $interval = (int)($int_m[1] ?? 1);
                preg_match('/BYDAY=([\\w,]+)/', $evento['regla_recurrencia'], $by_m);
                $bydays = $by_m ? explode(',', $by_m[1]) : [];

                $current = clone $start_dt;
                while ($current <= $max_dt) {
                    $new_event = $evento;
                    $new_event['start'] = $current->format('Y-m-d H:i:s');
                    if ($evento['end']) {
                        $end_dt = new DateTime($evento['end']);
                        $diff = $start_dt->diff($end_dt);
                        $new_end = clone $current;
                        $new_end->add($diff);
                        $new_event['end'] = $new_end->format('Y-m-d H:i:s');
                    }
                    $eventos[] = $new_event;

                    // Avanzar según freq (lógica simple)
                    if ($freq == 'DAILY') {
                        $current->modify('+' . $interval . ' days');
                    } elseif ($freq == 'WEEKLY') {
                        if ($bydays) {
                            $weekday_map = ['MO' => 0, 'TU' => 1, 'WE' => 2, 'TH' => 3, 'FR' => 4, 'SA' => 5, 'SU' => 6];
                            $found = false;
                            for ($i = 0; $i < 7; $i++) {
                                $current->modify('+1 day');
                                if (in_array($current->format('N') - 1, array_map(function ($d) use ($weekday_map) {
                                    return $weekday_map[$d];
                                }, $bydays))) {
                                    $found = true;
                                    break;
                                }
                            }
                            if (!$found) $current->modify('+' . ($interval - 1) . ' weeks');
                        } else {
                            $current->modify('+' . $interval . ' weeks');
                        }
                    } elseif ($freq == 'MONTHLY') {
                        $current->modify('+' . $interval . ' months');
                    } elseif ($freq == 'YEARLY') {
                        $current->modify('+' . $interval . ' years');
                    } else {
                        break;
                    }
                }
            } else {
                $eventos[] = $evento;
            }
        }
        ob_end_clean();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Listar estados Enum
    if (($method === 'GET' || $method === 'POST') && $accion === 'estados') {
        $data = $model->obtenerEstados();
        ob_end_clean();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // Crear evento
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

    // Actualizar evento
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

    // Eliminar evento
    if ($method === 'POST' && $accion === 'eliminar') {
        if (empty($input['id'])) {
            ob_end_clean();
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'ID no proporcionado.']);
            exit;
        }

        try {
            $resultado = $model->eliminarEvento($input['id']);

            ob_end_clean();
            if ($resultado) {
                echo json_encode(['success' => true, 'message' => 'Evento eliminado correctamente']);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'No se pudo eliminar el evento']);
            }
            exit;
        } catch (Exception $e) {
            ob_end_clean();
            http_response_code(500);
            echo json_encode(['success' => false, 'message' => 'Error al eliminar: ' . $e->getMessage()]);
            exit;
        }
    }

    // Obtener evento por ID
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

    // Listar combos
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

    // Listar eventos con filtros
    if ($method === 'POST' && $accion === 'listar_filtrado') {
        $eventos = $model->listarEventosFiltrados($input);
        ob_end_clean();
        echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // envio de notificaciones por email
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
                            <p><strong>Ubicación:</strong> {$evento['ubicacion']}</p>
                            <p><strong>Estado:</strong> {$evento['estado']}</p>
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
    ob_end_clean();
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

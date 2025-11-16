<?php
// reporte_noticiaexcel.php - VERSIÓN SIMPLIFICADA Y CORREGIDA

// DESACTIVAR ERRORES COMPLETAMENTE
error_reporting(0);
ini_set('display_errors', 0);
ini_set('output_buffering', 0);

// LIMPIAR CUALQUIER BUFFER EXISTENTE
while (ob_get_level() > 0) {
    ob_end_clean();
}

// VERIFICAR SI LOS HEADERS YA FUERON ENVIADOS
if (headers_sent($filename, $linenum)) {
    die("Error: Headers ya enviados en $filename línea $linenum");
}

require_once __DIR__ . '/../../../lib/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ReporteNoticiaExcel
{
    private $noticias;
    private $categoria;
    private $estado;

    public function __construct($noticias, $categoria = 'todas', $estado = 'todas')
    {
        $this->noticias = $noticias;
        $this->categoria = $categoria;
        $this->estado = $estado;
    }

    public function generar()
    {
        // CREAR SPREADSHEET
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Reporte de Noticias');

        // Configurar propiedades
        $spreadsheet->getProperties()
            ->setCreator('Colegio Orion')
            ->setTitle('Reporte de Noticias')
            ->setDescription('Reporte generado automáticamente desde el sistema del Colegio Orion');

        // Aplicar estilos y contenido
        $this->aplicarEstilos($sheet);
        $this->escribirEncabezado($sheet);
        $this->escribirDatos($sheet);
        $this->escribirEstadisticas($sheet);

        // NOMBRE DEL ARCHIVO
        $filename = "reporte_noticias_" . date('Y-m-d_His') . ".xlsx";

        // ENVIAR HEADERS - ESTE ES EL ORDEN CORRECTO
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Pragma: no-cache');
        header('Expires: 0');

        // GENERAR Y ENVIAR
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    private function aplicarEstilos(&$sheet)
    {
        // Estilo para el título principal
        $tituloStyle = [
            'font' => [
                'bold' => true,
                'size' => 16,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2E86AB']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ]
        ];

        $sheet->getStyle('A1')->applyFromArray($tituloStyle);
    }

    private function escribirEncabezado(&$sheet)
    {
        // Título principal
        $sheet->mergeCells('A1:G1');
        $sheet->setCellValue('A1', 'COLEGIO ORION - REPORTE DE NOTICIAS');
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Información de filtros
        $filtroInfo = "Filtros aplicados: ";
        $filtros = [];

        if ($this->categoria !== 'todas') {
            $filtros[] = "Categoría específica";
        } else {
            $filtros[] = "Todas las categorías";
        }

        if ($this->estado !== 'todas') {
            $filtros[] = "Estado: " . ucfirst($this->estado);
        } else {
            $filtros[] = "Todos los estados";
        }

        $filtroInfo .= implode(", ", $filtros);

        $sheet->mergeCells('A2:G2');
        $sheet->setCellValue('A2', $filtroInfo);
        $sheet->getRowDimension(2)->setRowHeight(20);

        // Información de generación
        $sheet->mergeCells('A3:G3');
        $sheet->setCellValue('A3', 'Generado el: ' . date('d/m/Y H:i:s'));
        $sheet->getRowDimension(3)->setRowHeight(18);

        // Espacio
        $sheet->setCellValue('A4', '');
        $sheet->getRowDimension(4)->setRowHeight(5);
    }

    private function escribirDatos(&$sheet)
    {
        // Configurar anchos de columnas
        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(35);
        $sheet->getColumnDimension('C')->setWidth(20);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(12);
        $sheet->getColumnDimension('G')->setWidth(50);

        // Encabezados de columnas
        $headers = [
            'ID',
            'TÍTULO',
            'AUTOR',
            'FECHA',
            'CATEGORÍA',
            'IMPORTANTE',
            'DESCRIPCIÓN'
        ];

        $sheet->fromArray($headers, null, 'A5');

        // Estilo encabezados
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '06426A']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ]
        ];

        $sheet->getStyle('A5:G5')->applyFromArray($headerStyle);
        $sheet->getRowDimension(5)->setRowHeight(25);

        // Escribir datos
        $row = 6;
        foreach ($this->noticias as $noticia) {
            $descripcion = strip_tags($noticia['descripcion']);
            $descripcion = html_entity_decode($descripcion);

            if (strlen($descripcion) > 200) {
                $descripcion = substr($descripcion, 0, 200) . '...';
            }

            $data = [
                $noticia['id'],
                $noticia['titulo'],
                $noticia['usuario'],
                date('d/m/Y', strtotime($noticia['fechaCreacion'])),
                $noticia['categoria'],
                $noticia['importante'] == 1 ? 'SÍ' : 'NO',
                $descripcion
            ];

            $sheet->fromArray($data, null, "A$row");

            // Estilo datos
            $dataStyle = [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_TOP,
                    'wrapText' => true
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'DDDDDD']
                    ]
                ]
            ];

            $sheet->getStyle("A$row:G$row")->applyFromArray($dataStyle);

            if ($noticia['importante'] == 1) {
                $importantStyle = [
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'D32F2F']
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'FFEBEE']
                    ]
                ];
                $sheet->getStyle("A$row:G$row")->applyFromArray($importantStyle);
            }

            $sheet->getRowDimension($row)->setRowHeight(-1);
            $row++;
        }

        return $row;
    }

    private function escribirEstadisticas(&$sheet)
    {
        $totalNoticias = count($this->noticias);
        $noticiasImportantes = array_filter($this->noticias, function ($n) {
            return $n['importante'] == 1;
        });
        $totalImportantes = count($noticiasImportantes);

        $startRow = count($this->noticias) + 8;

        // Título de estadísticas
        $sheet->mergeCells("A{$startRow}:G{$startRow}");
        $sheet->setCellValue("A{$startRow}", "ESTADÍSTICAS DEL REPORTE");

        $sheet->getStyle("A{$startRow}")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => '2E86AB']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);

        $startRow++;

        // Total de noticias
        $sheet->setCellValue("A{$startRow}", "Total de noticias:");
        $sheet->setCellValue("B{$startRow}", $totalNoticias);
        $sheet->getStyle("A{$startRow}:B{$startRow}")->getFont()->setBold(true);

        $startRow++;

        // Noticias importantes
        $sheet->setCellValue("A{$startRow}", "Noticias importantes:");
        $sheet->setCellValue("B{$startRow}", $totalImportantes);

        $startRow++;

        // Porcentaje
        $porcentaje = $totalNoticias > 0 ? round(($totalImportantes / $totalNoticias) * 100, 2) : 0;
        $sheet->setCellValue("A{$startRow}", "Porcentaje de importantes:");
        $sheet->setCellValue("B{$startRow}", "{$porcentaje}%");

        $startRow += 2;

        // Firma
        $sheet->mergeCells("A{$startRow}:G{$startRow}");
        $sheet->setCellValue("A{$startRow}", "Reporte generado automáticamente por el Sistema del Colegio Orion");

        $sheet->getStyle("A{$startRow}")->applyFromArray([
            'font' => [
                'italic' => true,
                'color' => ['rgb' => '666666']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ]);
    }
}
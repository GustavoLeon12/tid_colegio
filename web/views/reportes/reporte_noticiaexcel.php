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
        $sheet->getColumnDimension('F')->setWidth(15);
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

        // Calcular estadísticas más completas
        $noticiasImportantes = array_filter($this->noticias, function ($n) {
            return $n['importante'] == 1;
        });
        $totalImportantes = count($noticiasImportantes);
        $totalNormales = $totalNoticias - $totalImportantes;

        // Calcular distribución por categoría
        $categorias_count = [];
        $categorias_importantes = [];

        foreach ($this->noticias as $noticia) {
            $cat = $noticia['categoria'];

            // Contar total por categoría
            $categorias_count[$cat] = isset($categorias_count[$cat]) ? $categorias_count[$cat] + 1 : 1;

            // Contar importantes por categoría
            if ($noticia['importante'] == 1) {
                $categorias_importantes[$cat] = isset($categorias_importantes[$cat]) ? $categorias_importantes[$cat] + 1 : 1;
            }
        }

        // Calcular porcentajes
        $porcentajeImportantes = $totalNoticias > 0 ? round(($totalImportantes / $totalNoticias) * 100, 1) : 0;
        $porcentajeNormales = $totalNoticias > 0 ? round(($totalNormales / $totalNoticias) * 100, 1) : 0;

        // Determinar fila de inicio para estadísticas
        $startRow = count($this->noticias) + 8;

        // ⚠️ ELIMINADO: NO redefinir los anchos de columna aquí
        // Los anchos ya están establecidos en escribirDatos()

        // Título principal de estadísticas - USAR COLUMNAS A-G
        $sheet->mergeCells("A{$startRow}:G{$startRow}");
        $sheet->setCellValue("A{$startRow}", "RESUMEN ESTADÍSTICO COMPLETO");

        $sheet->getStyle("A{$startRow}")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => '2E86AB']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E8F4F8']
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '2E86AB']
                ]
            ]
        ]);

        $sheet->getRowDimension($startRow)->setRowHeight(25);
        $startRow++;

        // ENCABEZADOS DE LA TABLA DE ESTADÍSTICAS GENERALES - USAR COLUMNAS A-G
        $sheet->mergeCells("A{$startRow}:G{$startRow}");
        $sheet->setCellValue("A{$startRow}", "ESTADÍSTICAS GENERALES");
        $sheet->getStyle("A{$startRow}")->applyFromArray([
            'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '06426A']],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
        ]);
        $startRow++;

        // ESTADÍSTICAS GENERALES - USAR COLUMNAS A, B, C, D (no redefinir anchos)
        $estadisticasGenerales = [
            ['Total de noticias/comunicados:', $totalNoticias, '100%', 'Todos los registros'],
            ['Noticias importantes:', $totalImportantes, $porcentajeImportantes . '%', 'Destacados'],
            ['Noticias normales:', $totalNormales, $porcentajeNormales . '%', 'Regulares'],
            [
                'Relación importantes/normales:',
                $totalNormales > 0 ? round($totalImportantes / $totalNormales, 2) . ':1' : 'N/A',
                '',
                'Proporción'
            ]
        ];

        foreach ($estadisticasGenerales as $index => $estadistica) {
            // Combinar celdas A y B para el texto descriptivo
            $sheet->mergeCells("A{$startRow}:B{$startRow}");
            $sheet->setCellValue("A{$startRow}", $estadistica[0]);

            $sheet->setCellValue("C{$startRow}", $estadistica[1]);
            $sheet->setCellValue("D{$startRow}", $estadistica[2]);

            // Estilo para filas
            $style = [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'DDDDDD']
                    ]
                ]
            ];

            // Estilo específico para celdas combinadas
            $textoStyle = [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'font' => ['bold' => $index == 0] // Solo bold para el total
            ];

            // Destacar filas importantes
            if ($index == 1) { // Fila de noticias importantes
                $style['font'] = ['bold' => true, 'color' => ['rgb' => 'D32F2F']];
                $style['fill'] = ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'FFEBEE']];
                $textoStyle['font'] = ['bold' => true, 'color' => ['rgb' => 'D32F2F']];
            } elseif ($index == 0) { // Fila de total
                $style['font'] = ['bold' => true];
                $style['fill'] = ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F5F5F5']];
                $textoStyle['font'] = ['bold' => true];
            }

            $sheet->getStyle("A{$startRow}:D{$startRow}")->applyFromArray($style);
            $sheet->getStyle("A{$startRow}:B{$startRow}")->applyFromArray($textoStyle);

            // Alinear valores al centro
            $sheet->getStyle("C{$startRow}:D{$startRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $startRow++;
        }

        $startRow++; // Espacio

        // ESTADÍSTICAS POR CATEGORÍA - USAR COLUMNAS A-G
        if (count($categorias_count) > 0) {
            $sheet->mergeCells("A{$startRow}:G{$startRow}");
            $sheet->setCellValue("A{$startRow}", "DISTRIBUCIÓN POR CATEGORÍA");
            $sheet->getStyle("A{$startRow}")->applyFromArray([
                'font' => ['bold' => true, 'size' => 12, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '06426A']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
            ]);
            $startRow++;

            // Encabezados de tabla por categoría
            $sheet->mergeCells("A{$startRow}:C{$startRow}");
            $sheet->setCellValue("A{$startRow}", "CATEGORÍA");
            $sheet->setCellValue("D{$startRow}", "TOTAL");
            $sheet->setCellValue("E{$startRow}", "IMPORTANTES");
            $sheet->setCellValue("F{$startRow}", "% IMPORTANTES");

            $sheet->getStyle("A{$startRow}:F{$startRow}")->applyFromArray([
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '2E86AB']],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'FFFFFF']
                    ]
                ]
            ]);

            $startRow++;

            // Datos por categoría
            $fill = false;
            foreach ($categorias_count as $categoria => $total) {
                $importantes_cat = $categorias_importantes[$categoria] ?? 0;
                $porcentaje_cat = $total > 0 ? round(($importantes_cat / $total) * 100, 1) : 0;

                // Combinar celdas A-C para el nombre de la categoría
                $sheet->mergeCells("A{$startRow}:C{$startRow}");
                $sheet->setCellValue("A{$startRow}", $categoria);

                $sheet->setCellValue("D{$startRow}", $total);
                $sheet->setCellValue("E{$startRow}", $importantes_cat);
                $sheet->setCellValue("F{$startRow}", $porcentaje_cat . '%');

                // Estilo alternado para mejor lectura
                $rowStyle = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'DDDDDD']
                        ]
                    ]
                ];

                // Estilo para texto de categoría (alineado a la izquierda)
                $categoriaStyle = [
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_LEFT,
                        'vertical' => Alignment::VERTICAL_CENTER
                    ]
                ];

                if ($fill) {
                    $rowStyle['fill'] = [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F9F9F9']
                    ];
                }

                $sheet->getStyle("A{$startRow}:F{$startRow}")->applyFromArray($rowStyle);
                $sheet->getStyle("A{$startRow}:C{$startRow}")->applyFromArray($categoriaStyle);

                $startRow++;
                $fill = !$fill;
            }

            $startRow++; // Espacio
        }

        // Texto de resumen ejecutivo - USAR TODAS LAS COLUMNAS A-G
        $resumenTexto = "";
        if ($totalNoticias > 0) {
            $categoriaMayoritaria = array_keys($categorias_count, max($categorias_count))[0];
            $totalCategoriaMayoritaria = $categorias_count[$categoriaMayoritaria];

            $resumenTexto = "El reporte contiene {$totalNoticias} publicaciones en total. ";
            $resumenTexto .= "La categoría '{$categoriaMayoritaria}' es la más representativa con {$totalCategoriaMayoritaria} publicaciones ({$porcentajeImportantes}% marcadas como importantes).";

            if ($porcentajeImportantes > 50) {
                $resumenTexto .= " Más de la mitad de las publicaciones son destacadas.";
            } else {
                $resumenTexto .= " La mayoría de las publicaciones son de tipo regular.";
            }
        } else {
            $resumenTexto = "No se encontraron publicaciones con los filtros aplicados.";
        }

        $sheet->mergeCells("A{$startRow}:G{$startRow}");
        $sheet->setCellValue("A{$startRow}", $resumenTexto);
        $sheet->getStyle("A{$startRow}")->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '228B22']
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F0FFF0']
            ]
        ]);

        $sheet->getRowDimension($startRow)->setRowHeight(35);
        $startRow += 2;

        // ⚠️ ELIMINADO: Código duplicado de firma final
        // SOLO DEJAR UNA FIRMA FINAL

        // FIRMA FINAL - USAR TODAS LAS COLUMNAS A-G
        $sheet->mergeCells("A{$startRow}:G{$startRow}");
        $sheet->setCellValue("A{$startRow}", "Reporte generado automáticamente - " . date('d/m/Y H:i:s'));
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

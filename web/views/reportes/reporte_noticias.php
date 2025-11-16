<?php
// Para Generar PDF

// Iniciar sesión para obtener los parámetros
session_start();

// Evitar output antes del PDF
if (ob_get_length()) ob_clean();

// Verificar que existan los parámetros necesarios
if (!isset($_SESSION['reporte_categoria']) || !isset($_SESSION['reporte_estado'])) {
    die("Error: Parámetros de sesión no encontrados. Vuelva a generar el reporte.");
}

// RUTA SIMPLIFICADA - usar rutas relativas
require_once '../../../lib/TCPDF/tcpdf.php';  // Desde web/views/reportes hasta lib/TCPDF
require_once __DIR__ . '/../../controller/noticias_controller.php'; // Desde web/views/reportes hasta web/controller

class ReporteNoticiasPDF extends TCPDF
{
    private $noticias;
    private $categoria;
    private $estado;

    public function __construct($noticias, $categoria, $estado)
    {
        parent::__construct('P', 'mm', 'A4', true, 'UTF-8', false);
        $this->noticias = $noticias;
        $this->categoria = $categoria;
        $this->estado = $estado;
        
        $this->SetCreator('Colegio Orion');
        $this->SetAuthor('Colegio Orion');
        $this->SetTitle('Reporte de Noticias');
        $this->SetSubject('Reporte de Noticias del Sistema');
        
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
        
        $this->generarReporte();
    }

    private function generarReporte()
    {
        $this->AddPage();
        $this->generarEncabezado();
        $this->generarInformacionReporte();
        
        if (empty($this->noticias)) {
            $this->generarMensajeSinDatos();
        } else {
            $this->generarTablaNoticias();
            $this->generarResumenEstadistico();
        }
        
        $this->generarPiePagina();
    }

    private function generarEncabezado()
    {
        // Título principal
        $this->SetFont('helvetica', 'B', 20);
        $this->SetTextColor(6, 66, 106);
        $this->SetY(20);
        $this->Cell(0, 10, 'COLEGIO ORION', 0, 1, 'C');
        
        $this->SetFont('helvetica', 'B', 16);
        $this->SetTextColor(80, 80, 80);
        $this->Cell(0, 8, 'REPORTE DE NOTICIAS Y COMUNICADOS', 0, 1, 'C');

        // Línea decorativa
        $this->SetLineWidth(1);
        $this->SetDrawColor(6, 66, 106);
        $this->Line(15, 40, 195, 40);
    }

    private function generarInformacionReporte()
    {
        $this->SetFont('helvetica', '', 10);
        $this->SetTextColor(0, 0, 0);
        $this->SetY(45);
        
        // Fecha y total
        $this->Cell(90, 6, 'Fecha de generación: ' . date('d/m/Y H:i:s'), 0, 0);
        $this->Cell(90, 6, 'Total: ' . count($this->noticias) . ' registros', 0, 1, 'R');
        
        // Filtros aplicados
        $this->Cell(90, 6, 'Categoría: ' . ($this->categoria !== 'todas' ? 'Específica' : 'Todas'), 0, 0);
        $this->Cell(90, 6, 'Estado: ' . ($this->estado !== 'todas' ? ucfirst($this->estado) : 'Todos'), 0, 1, 'R');

        $this->Ln(10);
    }

    private function generarMensajeSinDatos()
    {
        $this->SetFont('helvetica', 'I', 12);
        $this->SetTextColor(128, 128, 128);
        $this->Cell(0, 10, 'No se encontraron noticias con los filtros aplicados', 0, 1, 'C');
        $this->SetFont('helvetica', '', 10);
        $this->Cell(0, 8, 'Intente modificar los criterios de búsqueda', 0, 1, 'C');
    }

    private function generarTablaNoticias()
    {
        // Encabezado de la tabla
        $this->SetFont('helvetica', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(6, 66, 106);
        
        $this->Cell(10, 8, '#', 1, 0, 'C', true);
        $this->Cell(80, 8, 'TÍTULO', 1, 0, 'C', true);
        $this->Cell(30, 8, 'FECHA', 1, 0, 'C', true);
        $this->Cell(40, 8, 'AUTOR', 1, 0, 'C', true);
        $this->Cell(30, 8, 'CATEGORÍA', 1, 1, 'C', true);

        $this->SetFont('helvetica', '', 9);
        $this->SetTextColor(0, 0, 0);
        
        $fill = false;
        $row_height = 10;

        foreach ($this->noticias as $index => $noticia) {
            // Alternar colores de fondo
            if ($fill) {
                $this->SetFillColor(245, 245, 245);
            } else {
                $this->SetFillColor(255, 255, 255);
            }
            
            // Verificar si necesita nueva página
            if ($this->GetY() > 250) {
                $this->AddPage();
                $this->redibujarEncabezadoTabla();
                $fill = false;
            }
            
            // Número
            $this->Cell(10, $row_height, $index + 1, 1, 0, 'C', $fill);
            
            // Título
            $titulo = $noticia['titulo'];
            if ($noticia['importante'] == 1) {
                $titulo = "⭐ " . $titulo;
            }
            if (strlen($titulo) > 50) {
                $titulo = substr($titulo, 0, 50) . '...';
            }
            $this->Cell(80, $row_height, $titulo, 1, 0, 'L', $fill);
            
            // Fecha
            $fecha = date('d/m/Y', strtotime($noticia['fechaCreacion']));
            $this->Cell(30, $row_height, $fecha, 1, 0, 'C', $fill);
            
            // Autor
            $autor = $noticia['usuario'];
            if (strlen($autor) > 20) {
                $autor = substr($autor, 0, 20) . '...';
            }
            $this->Cell(40, $row_height, $autor, 1, 0, 'L', $fill);
            
            // Categoría
            $categoria_nombre = $noticia['categoria'];
            $this->Cell(30, $row_height, $categoria_nombre, 1, 1, 'C', $fill);
            
            $fill = !$fill;
        }

        $this->Ln(8);
    }

    private function redibujarEncabezadoTabla()
    {
        $this->SetFont('helvetica', 'B', 11);
        $this->SetTextColor(255, 255, 255);
        $this->SetFillColor(6, 66, 106);
        $this->Cell(10, 8, '#', 1, 0, 'C', true);
        $this->Cell(80, 8, 'TÍTULO', 1, 0, 'C', true);
        $this->Cell(30, 8, 'FECHA', 1, 0, 'C', true);
        $this->Cell(40, 8, 'AUTOR', 1, 0, 'C', true);
        $this->Cell(30, 8, 'CATEGORÍA', 1, 1, 'C', true);
        $this->SetFont('helvetica', '', 9);
        $this->SetTextColor(0, 0, 0);
    }

    private function generarResumenEstadistico()
    {
        if (count($this->noticias) > 0) {
            $this->SetFont('helvetica', 'B', 10);
            $this->SetTextColor(6, 66, 106);
            $this->Cell(0, 8, 'RESUMEN ESTADÍSTICO', 0, 1);
            
            $this->SetFont('helvetica', '', 9);
            $this->SetTextColor(0, 0, 0);
            
            // Contar noticias importantes
            $importantes = array_filter($this->noticias, function($noticia) {
                return $noticia['importante'] == 1;
            });
            
            // Agrupar por categoría
            $categorias_count = [];
            foreach ($this->noticias as $noticia) {
                $cat = $noticia['categoria'];
                $categorias_count[$cat] = isset($categorias_count[$cat]) ? $categorias_count[$cat] + 1 : 1;
            }
            
            $this->Cell(0, 6, '• Noticias importantes: ' . count($importantes), 0, 1);
            $this->Cell(0, 6, '• Noticias normales: ' . (count($this->noticias) - count($importantes)), 0, 1);
            
            if (count($categorias_count) > 0) {
                $this->Cell(0, 6, '• Distribución por categorías:', 0, 1);
                foreach ($categorias_count as $cat => $count) {
                    $this->Cell(10, 6, '', 0, 0);
                    $this->Cell(0, 6, '  - ' . $cat . ': ' . $count . ' noticia(s)', 0, 1);
                }
            }
        }
    }

    private function generarPiePagina()
    {
        $this->SetY(-20);
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(128, 128, 128);
        $this->Cell(0, 6, 'Sistema de Gestión Colegio Orion', 0, 1, 'C');
        $this->Cell(0, 6, 'Reporte generado automáticamente - Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(), 0, 0, 'C');
    }
}

// ========== PROCESAMIENTO DEL REPORTE ==========

// Obtener parámetros desde la sesión
$categoria = $_SESSION['reporte_categoria'] ?? 'todas';
$estado = $_SESSION['reporte_estado'] ?? 'todas';
$noticias_ids = json_decode($_SESSION['reporte_noticias_ids'] ?? '[]', true);

// Limpiar variables de sesión después de usarlas
unset($_SESSION['reporte_categoria']);
unset($_SESSION['reporte_estado']);
unset($_SESSION['reporte_noticias_ids']);

// Obtener datos de noticias
$noticiasController = new NoticiasController();
$noticias = $noticiasController->obtenerNoticiasFiltradas($categoria, $estado, $noticias_ids);

// Generar PDF
$pdf = new ReporteNoticiasPDF($noticias, $categoria, $estado);
$pdf->Output('reporte_noticias_' . date('Y-m-d_His') . '.pdf', 'D');
exit;
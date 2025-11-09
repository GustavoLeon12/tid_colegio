<?php
// test_tcpdf.php - VERSIÓN CORREGIDA
ob_clean(); // Limpiar cualquier buffer de salida
require_once 'lib/TCPDF/tcpdf.php';

// Crear PDF inmediatamente sin output previo
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, '✅ TCPDF funciona correctamente!', 0, 1, 'C');
$pdf->Output('test_tcpdf.pdf', 'I');
exit; // Terminar ejecución inmediatamente
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluye el archivo de autoload de Composer
require 'vendor/autoload.php'; // Asegúrate de que esta ruta sea correcta

// Crear instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage(); // Añadir una página

// Establecer fuente
$pdf->SetFont('Arial', 'B', 16);

// Añadir un título
$pdf->Cell(40, 10, 'Hola, mundo!'); // Crea una celda con el texto

// Salvar el PDF
$pdf->Output('I', 'test_pdf.pdf'); // 'I' para enviar el archivo al navegador

?>


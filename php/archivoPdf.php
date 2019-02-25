<?php

    include('../fpdf/fpdf.php');
    require_once 'cesta.php';
    require_once 'conexion.php';
    session_start();
    if($_SESSION['cesta']) {
        $datos = $_SESSION['cesta']->getListaArticulos();
    }
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->setFont('Arial', 'B', 14);
    $pdf->SetXY(70,25);
    $pdf->Cell(5, 5, 'Factura de Compra');
    $pdf->SetXY(15, 30);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(0, 30, 'KasterTool S.L.', 0, 0, 'R');
    $pdf->Cell(0, 40, 'c/madrid n39', 0, 0, 'R');
    $pdf->Cell(0, 50, '28943(Madrid)', 0, 0, 'R');
    
    $pdf->SetXY(20, 70);
    $pdf->Cell(45, 5, "Productos", 1);
    $pdf->Cell(35, 5, "tipo", 1);
    $pdf->Cell(35, 5, "Cantidad", 1);
    $pdf->Cell(35, 5, "Precio", 1);
    $pdf->Cell(35, 5, "Subtotal", 1);
    
    $total = 0;
    $y = 75;
    foreach($datos as $fila){
        $nombre = $fila['nombre'];
        $tipo = $fila['tipo'];
        $cantidad = $fila['cantidad'];
        $precio = $fila['precioProducto'];
        $subtotal = $precio * $cantidad;
        
        $total += $subtotal; 
        $pdf->SetXY(20, $y);
        $pdf->Cell(45, 5, "$nombre", 1);
        $pdf->Cell(35, 5, "$tipo", 1, 'R');
        $pdf->Cell(35, 5, "$cantidad", 1, 'R');
        $pdf->Cell(35, 5, "$precio", 1, 'R');
        $pdf->Cell(35, 5, "$subtotal", 1, 'R');
        $y += 5;
    }
    $pdf->SetXY(20, $y);
    $pdf->Cell(45, 5, "Total", 1);
    $pdf->Cell(105, 5, "$total", 1, 0, 'R');
    
    $pdf->Output();
    
?>

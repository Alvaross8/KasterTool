<?php

    include('../fpdf/fpdf.php');
    require_once 'cesta.php';
    require_once 'conexion.php';
    session_start();
    
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->setFont('Arial', 'B', 14);

    $resultado = $_SESSION['cesta']->getListaArticulos();
    $pdf->Cell(40,40, 'texto en pagina pdf');


    $pdf->Output();
    ?>


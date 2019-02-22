<?php
    require_once 'conexion.php';
    require_once 'cesta.php';
    session_start();

    $conexion = new Conexion();
    $accion = $_REQUEST['accion'];

    if($accion == 'annadir') {
        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $precioProducto = $_REQUEST['precioProducto'];
        $tipo = $_REQUEST['tipo'];
        $marca = $_REQUEST['marca'];
        $existencias = $_REQUEST['existencias'];
        $imagen = $_REQUEST['imagen'];
        $arrayArticulo = [$nombre, $descripcion, $precioProducto, $tipo, $marca, $existencias, $imagen];
        $_SESSION['cesta']->annadirArticulo($arrayArticulo);
        header('Location:verCesta.php');
    }

?>
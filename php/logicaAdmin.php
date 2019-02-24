<?php
    require_once 'conexion.php';
    require_once 'cesta.php';
    session_start();

    $conexion = new Conexion();

    if(isset($_REQUEST['annadir'])) {

        $nombre = $_REQUEST['nombre'];
        $descripcion = $_REQUEST['descripcion'];
        $precioProducto = $_REQUEST['precioProducto'];
        $tipo = $_REQUEST['tipo'];
        $marca = $_REQUEST['marca'];
        $imagen = '../images/' . $_REQUEST['imagen'];
        $existencias = $_REQUEST['existencias'];

        $conexion->insertarProducto($nombre, $descripcion, $precioProducto, $tipo, $marca, $imagen, $existencias);
    
    }else if (isset($_REQUEST['eliminarProducto'])){
        $nombre = $_REQUEST['nombre'];

        $conexion->eliminarProducto($nombre);

    }else if (isset($_REQUEST['eliminarUsuario'])) {
        $nombre = $_REQUEST['nombre'];

        $conexion->eliminarUsuario($nombre);
    }

    header('Location: ../html/manejoAdmin.html');
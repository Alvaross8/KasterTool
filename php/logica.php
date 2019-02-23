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

        $arrayArticulo = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precioProducto' => $precioProducto,
            'tipo' => $tipo,
            'marca' => $marca,
            'existencias' => $existencias,
            'imagen' => $imagen
        ];

        $_SESSION['cesta']->annadirArticulo($arrayArticulo);
        $conexion->restarExistencias($nombre);
        header('Location:portada.php');

    }else if($accion == 'eliminar') {
        $cod = $_REQUEST['cod'];
        $nombre = $_REQUEST['nombre'];

        $conexion->sumarExistencias($nombre);
        $_SESSION['cesta']->eliminarArticulo($cod);
        header('Location:verCesta.php');

    }else if($accion == 'comprar') {
        unset($_SESSION['cesta']);
        header('Location: portada.php');
    }

?>
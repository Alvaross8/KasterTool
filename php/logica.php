<?php
    require_once 'conexion.php';
    require_once 'cesta.php';
    session_start();

    $conexion = new Conexion();
    $accion = $_REQUEST['accion'];

    if($accion == 'annadir') {
        $nombre = $_REQUEST['nombre'];
        $precioProducto = $_REQUEST['precioProducto'];
        $tipo = $_REQUEST['tipo'];


        $arrayArticulo = [
            'nombre' => $nombre,
            'precioProducto' => $precioProducto,
            'tipo' => $tipo,
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

    }else if($accion == 'annadir2') {
        $nombre = $_REQUEST['nombre'];
        $precioProducto = $_REQUEST['precioProducto'];
        $tipo = $_REQUEST['tipo'];

        $arrayArticulo = [
            'nombre' => $nombre,
            'precioProducto' => $precioProducto,
            'tipo' => $tipo,
        ];

        $_SESSION['cesta']->annadirArticulo($arrayArticulo);
        $conexion->restarExistencias($nombre);
        header('Location: verCesta.php');


    }else if($accion == 'comprar') {
        unset($_SESSION['cesta']);
        header('Location: portada.php');
    }

?>
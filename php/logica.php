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
        $cesta = $_SESSION['cesta']->getListaArticulos();

        $articulo = [
            'nombre' => $nombre,
            'precioProducto' => $precioProducto,
            'tipo' => $tipo,
            'cantidad' => 1
        ];

        $contador = false;
        foreach($cesta as $indice => $fila) {
            if($fila['nombre'] == $articulo['nombre']){

                $articulo['cantidad'] = $fila['cantidad'] + 1;
                $articulo['precioProducto'] *= $articulo['cantidad'];
                $_SESSION['cesta']->sumarArticulos($indice, $articulo);
                $contador = true;
            }
        }
        if(!$contador) {
            $_SESSION['cesta']->annadirArticulo($articulo);
        }
        $conexion->restarExistencias($nombre);
        header('Location: portada.php');
        
        

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

        $articulo = [
            'nombre' => $nombre,
            'precioProducto' => $precioProducto,
            'tipo' => $tipo,
            'cantidad' => 1
        ];

        $cesta = $_SESSION['cesta']->getListaArticulos();
        $contador = false;
        foreach($cesta as $indice => $fila) {

            if($fila['nombre'] == $articulo['nombre']){
                
                $articulo['cantidad'] = $fila['cantidad'] + 1;
                $articulo['precioProducto'] *= $articulo['cantidad'];
                $_SESSION['cesta']->sumarArticulos($indice, $articulo);
                $contador = true;
            }
        }
        if(!$contador) {
            $_SESSION['cesta']->annadirArticulo($articulo);
        }
        $conexion->restarExistencias($nombre);
        header('Location: verCesta.php');


    }else if($accion == 'comprar') {
        header('Location: factura.php');
    }

?>
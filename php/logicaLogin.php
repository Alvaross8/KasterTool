<?php
    require_once 'conexion.php';
    require_once 'cesta.php';
    session_start();
    $conexion = new Conexion();

    if(isset($_REQUEST['botonLogin'])) {
        $nombre = $_REQUEST['nombre'];
        $passwd = $_REQUEST['passwd'];
        $resultado = $conexion->selectUsuarios();

        foreach($resultado as $fila) {
            if($fila['nombre'] == $nombre && $fila['contrasenna'] == $passwd) {
                if($nombre == 'admin' && $passwd == 'P@ssw0rd' ) {
                    header('Location: ../html/manejoAdmin.html');
                } 
            }

        }
    }

    if(isset($_REQUEST['botonLogon'])){
        $nombre = $_REQUEST['nombre'];
        $apellidos = $_REQUEST['apellidos'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['passwd'];
        $dni = $_REQUEST['dni'];
        $direccion = $_REQUEST['direccion'];
        $cp = $_REQUEST['cp'];

        $resultado = $conexion->selectUsuarios();
        $coincidencia = true;

        foreach($resultado as $fila){
            if($fila['email'] == $email) {
                $coincidencia = false;
            }
        }
        if($coincidencia) {
            $conexion->insertarUsuario($nombre, $apellidos, $email, $password, $dni, $direccion, $cp);
        }
        header('Location:portada.php');
    }
    

?>
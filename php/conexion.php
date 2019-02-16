<?php

    class Conexion {

        private $conexion;

        function __construct() {

            $this->conexion = mysqli_connect('localhost', 'root', '', 'KasterTool_db');

            if($this->conexion->connect_error) {
                die('error de conexion (' . $this->conexion->connect_errno .
                ')' . $this->conexion->connect_error);
            }
        }

        function insertarUsuario($nombre, $apellidos, $email, $contrasenna, $dni, $direccion, $codigo) {
            $consulta = "INSERT INTO USUARIOS (Nombre, Apellidos, Email, Contrsenna, Dni, Direccion, Codigo_postal) VALUES (?, ?, ?, ?, ?, ?, ?)";
            if($resultado = $this->conexion->prepare($consulta)) {
                $resultado->bind_param('ssssssi', $nombre, $apellido, $email, $contrasenna, $dni, $direccion, $codigo);
                $resultado->execute();

            }else {
                echo "mal";
            }
            $resultado->close();
        }


        function insertarProducto($nombre, $descripcion, $precio_producto, $imagen, $marca, $existencias, $tipo) {
            $consulta = "INSERT INTO PRODUCTOS (Nombre, Descripcion, Precio_producto, Imagen, Marca, Existencias, Tipo) VALUES (?, ?, ?, ?, ?, ?, ?)";
            if($resultado = $this->conexion->prepare($consulta)) {
                $resultado->bind_param('ssdssis', $nombre, $descripcion, $precio_producto, $imagen, $marca, $existencias, $tipo);
                $resultado->execute();

            }else {
                echo "mal";
            }
            $resultado->close();
        }


        function insertarPedido($email, $cantidad, $precio_producto, $precio_total, $fecha) {
            $consulta = "INSERT INTO PEDIDOS (Email, Cantidad, Precio_producto, Precio_total, Fecha) VALUES (?, ?, ?, ?, ?)";
            if($resultado = $this->conexion->prepare($consulta)) {
                $resultado->bind_param('sidds', $email, $cantidad, $precio_producto, $precio_total, $fecha);
                $resultado->execute();

            }else {
                echo "mal"; 
            }
            $resultado->close();
        }


        function selectArticulo() { // esta select solo es para mostrar todos los productos
            $consulta = $this->conexion->stmt_init();
            $consulta->prepare("SELECT * FROM PRODUCTOS");
            $consulta->execute();

            $resultado = $consulta->get_result();
            $arrayFin = array();

            while($fila = $resultado->fetch_assoc()) {
                $temp = [
                    'Nombre' => $fila['Nombre'],
                    'Descripcion' => $fila['Descripcion'],
                    'Precio_Producto' => $fila['Precio_Producto'],
                    'Tipo' => $fila['Tipo'],
                    'Marca' => $fila['Marca'],
                    'Imagen' => $fila['Imagen'],
                    'Existencias' => $fila['Existencias']
                ];

                array_push($arrayFin, $temp);
            }
            return $arrayFin;
        }
        
        function selectBuscador(){ // en este select mostramos en base a la busqueda y la pagina donde este el usuario
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("SELECT * FROM PRODUCTOS");
            $stmt->execute();

            $resultado = $stmt->get_result();
            $arrayFin = array();

            while($fila = $resultado->fetch_assoc()) {
                $temp = [
                    'Nombre' => $fila['Nombre'],
                    'Descripcion' => $fila['Descripcion'],
                    'Precio_Producto' => $fila['Precio_Producto'],
                    'Tipo' => $fila['Tipo'],
                    'Marca' => $fila['Marca'],
                    'Imagen' => $fila['Imagen'],
                    'Existencias' => $fila['Existencias']
                ];
                array_push($arrayFin, $temp);
            }
            return $arrayFin;
        }
        
    
        function cierreConexion() {
            $this->conexion->close(); 
        }
    }    
            
?>
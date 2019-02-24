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

        ////////////////////////////////////////////// PARTE DE INSERTAR ///////////////////////////////////////////////////////////////////////////
        function insertarUsuario($nombre, $apellidos, $email, $contrasenna, $dni, $direccion, $codigo) {
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("INSERT INTO USUARIOS (Nombre, Apellidos, Email, Contrasenna, Dni, Direccion, Codigo_Postal) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssssssi', $nombre, $apellidos, $email, $contrasenna, $dni, $direccion, $codigo);
            $stmt->execute();
        }


        function insertarProducto($nombre, $descripcion, $precio_producto, $imagen, $marca, $existencias, $tipo) {
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("INSERT INTO PRODUCTOS (Nombre, Descripcion, Preio_Producto, Tipo, Marca, Imagen, Existencias) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('ssdsssi', $nombre, $descripcion, $precio_producto, $imagen, $marca, $existencias, $tipo);
            $stmt->execute();
        }


        function insertarPedido($email, $cantidad, $precio_total, $fecha) {
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("INSERT INTO PEDIDOS (Email, Cantidad, PrecioTotal, Fecha) VALUES (?, ?, ?, ?)");
            $stmt->bind_param('siis', $email, $cantidad, $precio_total, $fecha);
            $stmt->execute();
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////


        ////////////////////////////////////////// UPDATES ////////////////////////////////////////////////////

        function restarExistencias($nombre){
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("UPDATE PRODUCTOS SET existencias = existencias - 1 where nombre = ?");
            $stmt->bind_param('s', $nombre);
            $stmt->execute();
        }

        function sumarExistencias($nombre){
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("UPDATE PRODUCTOS SET existencias = existencias + 1 where nombre = ?");
            $stmt->bind_param('s', $nombre);
            $stmt->execute();
        }


        /////////////////////////////////////////////////////////////////////////////////////////////////////


        //////////////////////////////////// LOS SELECT ////////////////////////////////////////////
        
        function selectArticulo() { // esta select solo es para mostrar todos los productos
            $consulta = $this->conexion->stmt_init();
            $consulta->prepare("SELECT * FROM PRODUCTOS where existencias > 0");
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

        function selectPagina($pagina) { // esta select solo es para mostrar cada pagina en su correspondiente
            $consulta = $this->conexion->stmt_init();
            $consulta->prepare("SELECT * FROM PRODUCTOS WHERE Tipo like ? and existencias > 0");
            $consulta->bind_param('s', $pagina);
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
        
        function selectBuscador($busqueda, $busqueda1){ // en este select mostramos en base a la busqueda en el home
            $buscar = '%' . $busqueda . '%';
            $buscar1 = '%' . $busqueda1 . '%';
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("SELECT * FROM PRODUCTOS where existencias > 0 and nombre like ? or tipo like ?");
            $stmt->bind_param('ss', $buscar, $buscar1);
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


        function selectBuscadorPagina($busqueda, $busqueda1){ // en este select mostramos en base a la busqueda y la pagina donde este el usuario
            $buscar = '%' . $busqueda . '%';
            $buscar1 = '%' . $busqueda1 . '%';
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("SELECT * FROM PRODUCTOS where existencias > 0 and nombre like ? and tipo like ?");
            $stmt->bind_param('ss', $buscar, $buscar1);
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

        function selectUsuarios(){ // en este select mostramos los usuarios
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("SELECT * FROM USUARIOS");
            $stmt->execute();
            
            $resultado = $stmt->get_result();
            $arrayFin = array();
    
            while($fila = $resultado->fetch_assoc()) {
                $temp = [
                    'nombre' => $fila['Nombre'],
                    'apellidos' => $fila['Apellidos'],
                    'email' => $fila['Email'],
                    'contrasenna' => $fila['Contrasenna'],
                    'dni' => $fila['Dni'],
                    'direccion' => $fila['Direccion'],
                    'codigo' => $fila['Codigo_Postal']
                ];
                array_push($arrayFin, $temp);
            }
            return $arrayFin;
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////
    

        ///////////////////////////////////////////// DELETES //////////////////////////////////////////////////

        function eliminarProducto($nombre) {
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("DELETE FROM  PRODUCTOS WHERE nombre = ?");
            $stmt->bind_param('s', $nombre);
            $stmt->execute();
        }


        function eliminarUsuario($nombre) {
            $stmt = $this->conexion->stmt_init();
            $stmt->prepare("DELETE FROM  USUARIOS WHERE nombre = ?");
            $stmt->bind_param('s', $nombre);
            $stmt->execute();
        }

        ///////////////////////////////////////////////////////////////////////////////////////////////////////
        function cierreConexion() {
            $this->conexion->close(); 
        }
    }    
            
?>
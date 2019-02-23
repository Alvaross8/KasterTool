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

        //////////////////////////////////// PARTE DE LOS SELECT ////////////////////////////////////////////
        
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
        //////////////////////////////////////////////////////////////////////////////////////////////////////////
    
        function cierreConexion() {
            $this->conexion->close(); 
        }
    }    
            
?>
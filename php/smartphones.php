<?php
    require_once 'conexion.php';
    require_once 'cesta.php';
    include('../inc/navBar.inc');
?>
        <article>
            <div id="divPadreArticle">
            <?php
                $conexion = new Conexion();

                if(isset($_REQUEST['botonBuscar'])){
                    $resultado = $conexion->selectBuscador();
                    foreach($resultado as $fila) {
                        echo '<div class="divsArticulos">
                            <p><img src="' . $fila['Imagen'] . '"></p>
                            <p>' . $fila['Nombre'] . '</p>
                            <p>' . $fila['Descripcion'] . '</p>
                            <p>' . $fila['Precio_Producto'] . '</p>
                            <p>' . $fila['Tipo'] . '</p>
                            <p>' . $fila['Marca'] . '</p>
                            <p>' . $fila['Existencias'] . '</p>
                            <p><a href="logica.php?accion=annadir&nombre=' . $fila['Nombre'] . '&descripcion=' . 
                            $fila['Descripcion'] . '&precioProducto=' . $fila['Precio_Producto'] . 
                            '&tipo=' . $fila['Tipo'] . '&marca=' . $fila['Marca'] . '&existencias=' . 
                            $fila['Existencias'] . '&imagen=' . $fila['Imagen'] . '"><button>Añadir</button></a></p>
                        </div>';
                    }
                }else {
                    $resultado = $conexion->selectArticulo();

                    foreach($resultado as $fila) {
                        echo '<div class="divsArticulos">
                            <p><img src="' . $fila['Imagen'] . '"></p>
                            <p>' . $fila['Nombre'] . '</p>
                            <p>' . $fila['Descripcion'] . '</p>
                            <p>' . $fila['Precio_Producto'] . '</p>
                            <p>' . $fila['Tipo'] . '</p>
                            <p>' . $fila['Marca'] . '</p>
                            <p>' . $fila['Existencias'] . '</p>
                            <p><a href="logica.php?accion=annadir&nombre=' . $fila['Nombre'] . '&descripcion=' . 
                            $fila['Descripcion'] . '&precioProducto=' . $fila['Precio_Producto'] . 
                            '&tipo=' . $fila['Tipo'] . '&marca=' . $fila['Marca'] . '&existencias=' . 
                            $fila['Existencias'] . '&imagen=' . $fila['Imagen'] . '"><button>Añadir</button></a></p>
                        </div>';
                    }
                }
            ?>
            </div>
        </article>
            <?php
                include('../inc/footer.inc');
            ?>
    </body>
</html>

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
                    $busqueda = $_REQUEST['buscar'];
                    $resultado = $conexion->selectBuscadorPagina($busqueda, 'smartphone');
                    if(count($resultado) > 0) {
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
                        echo '<h2>No tienes ningún producto con esa busqueda</h2>';
                    }   
                    
                }else {
                    $resultado = $conexion->selectPagina('smartphone');

                    foreach($resultado as $fila) {
                        echo '<div class="divsArticulos">
                                <p><img src="' . $fila['Imagen'] . '"></p>
                                <p>' . $fila['Nombre'] . '</p>
                                <p>' . $fila['Descripcion'] . '</p>
                                <p>' . $fila['Precio_Producto'] . '€</p>
                                <p>' . $fila['Tipo'] . '</p>
                                <p>' . $fila['Marca'] . '</p>
                                <p>' . $fila['Existencias'] . ' existencias</p>
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


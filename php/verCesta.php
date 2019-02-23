<?php
    include('../inc/navBarCesta.inc');
    require_once 'conexion.php';
    require_once 'cesta.php';
    session_start();
?>

    <article>
        <?php
            if(count($_SESSION['cesta']->getListaArticulos()) > 0) {
            ?>
                <div id="divPadreArticle">
                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                        </tr>
                    <?php
                        $conexion = new Conexion();
    
     
                            $resultado = $_SESSION['cesta']->getListaArticulos();
                            $precio = $_SESSION['cesta']->precioTotal();
    
                            foreach($resultado as $indice => $fila) {
                                echo '<tr>
                                    <td>' . $fila['nombre'] . '</td>
                                    <td>' . $fila['precioProducto'] . '</td>
                                    <td>' . $fila['tipo'] . '</td>
                                    <td><a href="logica.php?accion=eliminar&cod=' . $indice . '&nombre=' . $fila['nombre'] . '"><button>-</button></a><td>
                                    <td><a href="logica.php?accion=sumar&cod=' . $indice . '&nombre=' . $fila['nombre'] . '"><button>+</button></a><td>
                                </tr>';
                            }
                            echo '<tr>
                                <td>Precio Total</td>
                                <td>' . $precio . '</td>
                                </tr></table>';
                            echo '</div>';
                            echo '<a href="logica.php?accion=comprar" id="botonCompra"><button>Comprar</button></a>';
            }else {
        
                echo '<div id="divVacioCarro">';
                    echo '<h2>No tienes ningún producto en tu carrito</h2>';
                    echo '<a href="portada.php"><button>Volver</button></a>
                </div>';
            }
        ?>
    </article>
    <?php
        include('../inc/footer.inc');
    ?>
<?php
    require_once 'conexion.php';
    require_once 'cesta.php';
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="../css/cssFactura.css">
    </head>
    <body>
    <article>
        <h1>Factura de la Compra</h1>
            <div id="empresa">
                <p> KasterTool S.L.</p>
                <p>Álvaro Sánchez</p>
                <p>c/madrid nº39</p>
                <p>Madrid</p>
                <p>28943</p>
            </div>

                    <table>
                        <tr>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Tipo</th>
                            <th>Cantidad</th>
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
                                    <td>' . $fila['cantidad'] . '</td>
                                    
                                </tr>';
                            }
                            echo '<tr>

                                <td>Precio Total</td>
                                <td>' . $precio . '</td>
                                </tr></table>';

                            echo '<a href="archivoPdf.php"><button id="boton">Ver en PDF </button></a>';

        ?>
    </article>
    </body>
</html>
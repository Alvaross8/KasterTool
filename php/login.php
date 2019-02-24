    <?php
    include('../inc/navBarLogin.inc');

    ?>
    <body>
        <div id="general">
            <h1>Accede como Usuario</h1>
            <div id="container">
                <div id="login">
                    <form action="../php/logicaLogin.php">
                        <label for="User">User</label><br>
                        <input type="text" name="nombre"required><br>
                        <label for="passwd">Password</label><br>
                        <input type="password" name="passwd"required><br>
                        <br>
                        <input type="submit" name="botonLogin" value="Entrar">
                    </form>
                </div>
                    
                <div id="registro">
                    <form action="../php/logicaLogin.php">
                        <label for="nombre">Nombre</label><br>
                        <input type="text" name="nombre" required><br>

                        <label for="apellidos">Apellidos</label><br>
                        <input type="text" name="apellidos" required><br>

                        <label for="email">Email</label><br>
                        <input type="email" name="email" required><br>

                        <label for="passwd">Password</label><br>
                        <input type = "password" name="passwd" required><br>

                        <label for="Dni">Dni</label><br>
                        <input type="text" name="dni" required><br>

                        <label for="direccion">Direccion</label><br>
                        <input type="text" name="direccion" required><br>

                        <label for="cp">CP</label><br>
                        <input type="text" name="cp" required><br>
                        <br>
                        <input type="submit" name="botonLogon" value="Registrarse" id="boton">
                    </form>
                </div>   
            </div>
    </body>
</html>
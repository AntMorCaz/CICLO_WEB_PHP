<?php

    session_name("evaluacion");
    session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Login:</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>

   

    <?php
        include "./views/header.php";
        include "./views/menu.php";
    ?>


    <main>
        <form action="pagina_usuario.php" method="post">
            <fieldset>
                <label for="username">E-Mail/Usuario*</label>
                <input type="text" id="username" name="username" required placeholder="E-Mail/Usuario">

                <label for="password">Contraseña*</label>
                <input type="password" id="password" name="password" required placeholder="Contraseña">


                <input type="submit" value="Enviar" name="submit" class="button">

                <?php 

                    if(isset($_SESSION['error'])){
                    print "<span class='error'>$_SESSION[error]</span>";
                    }
                    if(isset($_COOKIE["Ultimo_usuario"]) && isset($_COOKIE["Ultimo_usuario_fecha"])){
                        print"<span class='exito'>Ultimo usuario: ".$_COOKIE['Ultimo_usuario']." fecha: ".$_COOKIE['Ultimo_usuario_fecha']."</span>";
                    }

                ?>
                <p>¿No tienes cuenta? <a href="formulario_registro.php">Registrate</a></p>
            </fieldset>
        </form>
    </main>
    <?php 
        include "./views/footer.php";
        session_destroy();
    ?>

</body>

</html>
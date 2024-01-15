<?php
session_name("usuario");
session_start();

require_once("Usuario.php");

if (!isset($_SESSION['usuario'])) {

    header("Location:index.php");
    exit();

}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>


    <?php
    include "./views/header.php";
    include "./views/menu.php";
    ?>

    <main>
        <?php

       
            print("<h3>Datos leidos de la BBDD</h3>");
            print("Nombre: " . $_SESSION['usuario']['nombre'] . " <br>");
            print("Contraseña: " . $_SESSION['usuario']['password'] . " <br>");
            print("Foto perfil: " . $_SESSION['usuario']['imagen'] . " <br>");


            print "<table>";
            print "<tr>";
            print "<th>Imagen</th>";
            print "<th>Nombre</th>";
            print "<th>Apellidos</th>";
            print "</tr>";
            print "<tr>";
            print "<td><img src='bbdd/" . $_SESSION['usuario']['imagen'] . "' alt='foto perfil' width='200'></td>";
            print "<td>" . $_SESSION['usuario']['nombre'] . "</td>";
            print "<td>" . $_SESSION['usuario']['apellidos'] . "</td>";
            print "</tr>";
            print "</table>";
        
        ?>
      

    </main>
    <?php
    include "./views/footer.php";
    ?>


</body>

</html>
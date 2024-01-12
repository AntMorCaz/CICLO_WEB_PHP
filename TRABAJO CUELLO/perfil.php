<?php
session_name("evaluacion");
session_start();

require_once("Usuario.php");

if (isset($_POST["submit"])) {

    $email = $_POST["username"];
    $password = $_POST["password"];
    $loginok = false;
    $json_url = "bbdd/data.json";
    $json = file_get_contents($json_url);
    $data = json_decode($json,true);
    $lista_usuarios = [];


    foreach($data as $dato) {
        
        $usuario = new Usuario;
        $usuario->nombre = $dato["nombre"];
        $usuario->apellidos = $dato["apellidos"];
        $usuario->telefono = $dato["telefono"];
        $usuario->usuario = $dato["usuario"];
        $usuario->password = $dato["password"];
        $usuario->imagen = $dato["imagen"];
        array_push($lista_usuarios, $usuario);
    }
    
    
    foreach($lista_usuarios as $usr){
        if($email == $usr->usuario && password_verify($password, $usr->password)){
            $loginok = true;
            $validado = $usr;
        }
    
        
    }

    if(!$loginok){
        $_SESSION['error'] = "Los datos introducidos no coinciden";
        header("Location:index.php");
        exit();
    }

}

else{
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

        if(isset($validado)){
          print("<h3>Datos leidos de la BBDD</h3>");
          print("Nombre: $validado->nombre <br>");
          print("Contraseña: $validado->password <br>");
          print("Foto perfil: $validado->imagen <br>");
      
      
          print "<table>";
          print "<tr>";
          print "<th>Imagen</th>";
          print "<th>Nombre</th>";
          print "<th>Apellidos</th>";
          print "</tr>";
          print "<tr>";
          print "<td><img src='bbdd/$validado->imagen' alt='foto perfil' width='200'></td>";
          print "<td>$validado->nombre</td>";
          print "<td>$validado->apellidos</td>";
          print "</tr>";
          print "</table>";
        }
    ?>
    <?php 
            
            if(isset($_SESSION)){
                session_destroy();
            }
            
            
            ?>
            
        </main>
        <?php 
        include "./views/footer.php";
    ?>
    
            
</body>
</html>
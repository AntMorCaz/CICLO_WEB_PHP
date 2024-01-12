<?php

//------------------------------SESION-----------------------------------
session_name("sesionEvaluación");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulario registro</title>
    <link rel="stylesheet" href="./css/estilos.css">
</head>

<body>

    

    <?php 
        include "./views/header.php";
        include "./views/menu.php";
    ?>

    <main>
        
        <form action="procesar_subida.php" method="post" enctype="multipart/form-data">
            
            <fieldset>
                <strong><label for="imagen">Imagen de perfil</label></strong>
                <span>1 Mb max</span>
                <input type="file" name="imagen" id="imagen">
                
                <?php
                    
                    if(isset($_SESSION['error']['imagen'])){
                            print "<span class='error'>".$_SESSION['error']['imagen']."</span>";
                    }
                    
                    if(isset($_SESSION['exito']['imagen'])){
                        print "<span class='exito'>".$_SESSION['exito']['imagen']."</span>";
                    }
                        
                    
                ?>
           </fieldset>
           <fieldset>
                <p><label for="firstname">Nombre</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Nombre">
                </p>
                <?php 
                
                    if(isset($_SESSION['error']['nombre'])){
                        print "<span class='error'>".$_SESSION['error']['nombre']."</span>";
                    }
                
                ?>

                <p><label for="lastname">Apellidos</label>
                    <input type="text" id="lastname" name="lastname" placeholder="Apellidos">


                </p>
                <?php 
                
                if(isset($_SESSION['error']['apellidos'])){
                    print "<span class='error'>".$_SESSION['error']['apellidos']."</span>";
                }
            
                ?>

                <p><label for="telephone">Teléfono</label>
                    <input type="number" name="telephone" id="telephone" placeholder="Teléfono">


                </p>
                <?php 
                
                if(isset($_SESSION['error']['telefono'])){
                    print "<span class='error'>".$_SESSION['error']['telefono']."</span>";
                }
            
                ?>
                <p><label for="username">E-mail*</label>
                    <input type="email" id="username" name="username" required placeholder="E-mail">

                </p>
                <?php 
                
                if(isset($_SESSION['error']['email'])){
                    print "<span class='error'>".$_SESSION['error']['nombre']."</span>";
                }
            
                ?>
                <p> <label for="password">Contraseña*</label>
                    <input type="password" id="password" name="password" required placeholder="Contraseña">

                </p>
                <?php 
                
                if(isset($_SESSION['error']['password'])){
                    print "<span class='error'>".$_SESSION['error']['password']."</span>";
                }
            
            ?>
                <p> <label for="password2">Repetir Contraseña*</label>
                    <input type="password" id="password2" name="password2" required placeholder="Repetir Contraseña">

                </p>
                <?php 
                
                if(isset($_SESSION['error']['password2'])){
                    print "<span class='error'>".$_SESSION['error']['password2']."</span>";
                }
                if (isset($_SESSION['exito']['registro'])) {
                    print "<span class='exito'>".$_SESSION['exito']['registro']."</span>";
                }
            ?>
                <p><strong>* Campos Requeridos</strong></p>

                <input type="submit" value="Registrarse" name="submit" class="button">

                <p>¿Tienes cuenta y no lo recordabas? <a href="index.php">Logueate</a></p>
            </fieldset>
        </form>
            
    </main>
    <?php 
        include "./views/footer.php";
        
    ?>
            <?php 
            
            if(isset($_SESSION)){
                session_destroy();
            }

            ?>
</body>

</html>
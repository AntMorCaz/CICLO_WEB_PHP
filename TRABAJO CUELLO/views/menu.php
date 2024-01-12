<nav>
    <ul>
        <li><a href="./index.php">Index</a></li>
        <li><a href="./formulario_registro.php">Registrarse</a></li>

        <?php
        
        
        
    

        
            
        if(isset($loginok) && $loginok){
             
            echo "<li style='margin-left: auto;margin-right:1rem'>Bienvenido:  <strong>".$validado->nombre." ".$validado->apellidos."</strong> </li>";
            echo "<li><a href='perfil.php'>Perfil</a></li>";
            echo "<li><a href='index.php'>Cerrar Sesión</a></li>";
            
        }
            
       
            
        ?>
    </ul>
</nav>
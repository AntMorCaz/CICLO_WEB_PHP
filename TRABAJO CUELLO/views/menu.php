<nav>
    <ul>
        <li><a href="./index.php">Index</a></li>
        <li><a href="./formulario_registro.php">Registrarse</a></li>

        <?php
        
        
        
    

        
            
        if(isset($_SESSION["usuario"])){
             
            echo "<li style='margin-left: auto;margin-right:1rem'>Bienvenido:  <strong>".$_SESSION["usuario"]["nombre"]." ".$_SESSION["usuario"]["apellidos"]."</strong> </li>";
            echo "<li><a href='perfil.php'>Perfil</a></li>";
            echo "<li><a href='index.php'>Cerrar Sesión</a></li>";
            
        }
            
       
            
        ?>
    </ul>
</nav>
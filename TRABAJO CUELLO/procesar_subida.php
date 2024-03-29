<?php

require_once("Usuario.php");

//-------------------ANALISIS PROCEDENCIA DATOS-------------------------------------
//comprobamos si hemos llegado aqui por el formulario

if (isset($_POST["submit"])) {


//------------------------------SESION-----------------------------------
    //creo sesion para devolver variables de error o de éxito a la pagina del formulario.
    session_name("sesionEvaluación");
    session_start();


//--------------------------DATOS USUARIO-----------------------------------
        //este mensaje creo que no da tiempo a verlo porque este archivo se ejecuta y devuelve a la pagina de formulario de datos.
        print("<h4>Guardando datos usuario en json...</h4><br>");
        
        $nombre = $_POST["firstname"];
        $apellidos = $_POST["lastname"];
        $telefono = $_POST["telephone"];
        $nombreusuario = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        
        if(isset($_FILES["imagen"]["name"])){
            
            $imagen = $_FILES["imagen"]["name"];

        }
        else{

            $imagen = "default.jpeg";
        }
        


//==========================COMPROBACIONES==================================================================

function validarNombre(){
    if($_POST["firstname"] == ""){
        return false;
    }
    return true;
}

function validarApellidos(){
    if($_POST["lastname"]==""){
        return false;
    }
    return true;
}

function validarEmail(){
    if(str_contains($_POST["username"],"@")){
        
        if(str_contains($_POST["username"],".")){
            if(strrpos($_POST["username"],".")>strrpos($_POST["username"],"@")){
                return true;
            }
        }

    }
    return false;
}

function validarRepeticionContraseña(){

    if($_POST["password"] != $_POST["password2"])
    {
        return false;
    }
    return true;

}

function validarContraseña(){

    if(strlen($_POST["password"])<6){
        return false;
    }

    return true;

}

function validarTelefono(){
    if($_POST["telephone"]=="" || !is_numeric($_POST["telephone"]) || strlen($_POST["telephone"])<9){
        return false;
    }
    return true;
}

//**************************DATOS IMAGEN
    //COPY PASTE del codigo de subir archivo y añado dos mensajes para saber si ha ido bien o mal la subida.
   if(isset($_FILES["imagen"]["name"])){
    $nombreFichero = $_FILES["imagen"]["name"];
    $tamBytes = $_FILES["imagen"]["size"];
    $tamKB = round($tamBytes / 1024);
    $rutaTemporal = $_FILES["imagen"]["tmp_name"];

    $ruta_subida = "bbdd/";

    $res = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_subida . $_FILES["imagen"]["name"]);

    if ($res) {
        $_SESSION['exito']['imagen'] = "Fichero Guardado correctamente";
    } 
    else {
        $_SESSION['errorimagen']['imagen'] = "Error al guardar fichero";
    }

}
//*************************NOMBRE
        //Compruebo que el usuario no pusiera un espacio en blanco unicamente

        if(!validarNombre()){
            $_SESSION['error']['nombre'] = "Introduce un nombre válido.";
        }


//***************************APELLIDOS
        //Compruebo que el usuario no pusiera un espacio en blanco unicamente

        if(!validarApellidos()){
            $_SESSION['error']['apellidos'] = "Introduce apellidos válidos.";
        }


//****************************TELEFONO
        //Compruebo que al menos sean 6 digitos en formato numérico
        if(!validarTelefono()){
            $_SESSION['error']['telefono'] = "Introduce un teléfono válido.";
        }


//****************************EMAIL/USUARIO
        //input tipo email valida automaticamente        
        if(!validarEmail()){
            $_SESSION['error']['email'] = "Introduce un email válido.";
        }
    

//***************************CONTRASEÑA REPETIDA
        //Comprobamos que la contraseña sea igual al repetir contraseña
        
        if(!validarRepeticionContraseña()){
            $_SESSION['error']['password2'] = "Las contraseñas no coinciden";
        }


//***************************CONTRASEÑA
        //Comprobamos que la contraseña se de al menos 6 dígitos
        if(!validarContraseña()){
            $_SESSION['error']['password'] = "La contraseña debe tener 6 caracteres o mas.";
        }



//fin del bloque de comprobacion de datos de formulario
    
    function altaUsuario(){

        $file = "bbdd/data.json";
        $lista_usuarios = [];
        $JsonData = file_get_contents("./{$file}", FILE_USE_INCLUDE_PATH);
        $lista_usuarios = json_decode($JsonData,true);
       
        //usuario nuevo
        $User = new Usuario;
        $User->nombre = $_POST["firstname"];
        $User->apellidos = $_POST["lastname"];
        $User->telefono = $_POST["telephone"];
        $User->usuario = $_POST["username"];
        $User->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $User->imagen = $_SESSION["usuario"]["imagen"];
        
        //array_push nuevo user
        array_push($lista_usuarios, $User);

        $json_lista_usuario = json_encode($lista_usuarios,JSON_PRETTY_PRINT);

        file_put_contents("bbdd/data.json", $json_lista_usuario);

        setcookie("Ultimo_usuario", $User->usuario, time() + 3600*24*10,"/");
        setcookie("Ultimo_usuario_fecha", date("d-m-Y H:i:s"), time()+3600*24*10,"/");
    }
//-----------------------JSON----------------------------------------------------
    //Si no se ha creado la variable de sesion error en ningun paso anterior entonces procedemos a guardar los datos en formato JSON
    if(!isset($_SESSION['error'])){
        altaUsuario();
        //un mensaje para que el usuario sepa que todo ha ido bien
        $_SESSION['exito']['registro'] = "Usuario Registrado Correctamente";
    }

    //session_destroy();
}


//Siempre volvemos a la pagina del formulario, pasando o no por las condiciones
//asi si entramos escribiendo la ruta en el navegador no obtenemos resultados no deseados
    
    header('Location:formulario_registro.php');
    exit();


?>
<?php

class Usuario
{
    public $nombre = "";
    public $apellidos = "";
    public $telefono = "";
    public $usuario = "";
    public $password = "";
    public $imagen = "";

    public function __construct()
    {
        $this->imagen = "default.png";
    }
}

?>
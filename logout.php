<?php

require_once "vendor/autoload.php";

//cierro sesion

\clases\Sesion::cerrarUsuario();

//redirecciono

    header("Location:index.php?seccion=home");
    die();

<?php
require_once 'configuraciones.php';
require_once 'arrays.php';
require_once 'funciones.php';

require_once 'vendor/autoload.php';

//doy de baja al usuario en la base de datos

\Clases\Usuario::darseBaja($_SESSION["usuario"]["email"]);
\Clases\Sesion::set("baja","Se <b>deshabilitó</b> la cuenta: <b>" . $_SESSION["usuario"]["email"]."</b>");

//redirecciono

header("Location:index.php?seccion=logout");
die();
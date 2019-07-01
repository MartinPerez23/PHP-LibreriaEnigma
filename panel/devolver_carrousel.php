<!-- archivo que devuelve la imagen al carrousel -->

<?php
require_once "../vendor/autoload.php";

//mando errores

if(empty($_POST["id"])):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","sin_imagen");
    header("Location: index.php?seccion=papelera");
    die();
endif;

$img = $_POST["id"];

//compruebo que exista la carpeta a mover

if(!is_dir("../panel/papelera/carrousel/$img")):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","error_imagen");
    header("Location: index.php?seccion=papelera");
    die();
endif;

//muevo carpeta de papelera a img/carrousel

rename("../panel/papelera/carrousel/$img","../img/carrousel/$img");

//redireccionando
\Clases\Sesion::start();
\Clases\Sesion::set("ok","imagen_movida");
\Clases\Sesion::set("img",$img);
header("Location:index.php?seccion=papelera");
die();

<!-- archivo que devuelve el libro a la galeria -->

<?php
require_once "../vendor/autoload.php";

//mando errores

if(empty($_POST["id"])):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","sin_libro");
    header("Location: index.php?seccion=papelera");
    die();
endif;

$libro = $_POST["id"];

//doy de alta el libro

\Clases\Galeria::darAltaLibro($libro);

//redireccionando
\Clases\Sesion::start();
\Clases\Sesion::set("ok","libro_movido");
\Clases\Sesion::set("lib",$libro);

header("Location:index.php?seccion=papelera");
die();

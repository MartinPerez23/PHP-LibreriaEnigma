<!-- archivo que envia un archivo a papelera -->

<?php

require_once("../configuraciones.php");
require_once("../funciones.php");

require_once "../vendor/autoload.php";

//compruebo error

if(empty($_POST["id"])):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","sin_libro");
    header("Location: index.php?seccion=papelera");
    die();
endif;

$nombre = $_POST["id"];

//si no existe la carpeta en panel/papelera/..  se crea.

    if(!is_dir("papelera")):
        mkdir("papelera");
        mkdir("papelera/libros");
        mkdir("papelera/carrousel");
    endif;


//deshabilito un libro
if (isset($_POST["lugar"])):

    \Clases\Galeria::darBajaLibro($nombre);

else:
    $directorio = "../img/carrousel/$nombre";
        if(!is_dir($directorio)):
            \Clases\Sesion::start();
            \Clases\Sesion::set("error","error_libro");
            header("Location: index.php?seccion=papelera");
            die();
        endif;

        rename($directorio,"../panel/papelera/carrousel/$nombre");
endif;
//redirecciono

if (isset($_POST["lugar"]))
{
    \Clases\Sesion::start();
    \Clases\Sesion::set("ok","libro_movido");
    \Clases\Sesion::set("lib","$nombre");
header("Location:index.php?seccion=lista_libros");
die();
}

\Clases\Sesion::start();
\Clases\Sesion::set("ok","La imagen ".$nombre." se envio a la papelera");
header("Location:index.php?seccion=lista_carrousel_home");
die();
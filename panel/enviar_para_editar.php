<?php
require_once("../configuraciones.php");
require_once("../funciones.php");

require_once "../vendor/autoload.php";

//mando datos a la seccion nuevo libro por un txt


//compruebo los datos recibidos
if (isset($_POST["id"])):
file_put_contents ("tmp.txt",$_POST["id"]);

else:

    //errores
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","sin_libro");
    header("Location:index.php?seccion=lista_libros");
endif;

//redirecciono

header("Location:index.php?seccion=nuevo_libro");
die();
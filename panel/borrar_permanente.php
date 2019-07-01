
<!-- archivo que borra permanentemente el carrousel seleccionado -->

<?php

//envio de errores

if(empty($_POST["id"])):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","sin_img");
    header("Location: index.php?seccion=papelera");
    die();
endif;

$nombre = $_POST["id"];

$dir="../panel/papelera/carrousel/$nombre";

if(!is_dir($dir)):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","error_img");
    header("Location: index.php?seccion=papelera");
    die();
endif;

//elimina archivos y despues la carpeta

$carpeta = opendir($dir);

while($archivo = readdir($carpeta)):

    if($archivo != "." && $archivo != ".."):

        unlink("$dir/$archivo");

    endif;

endwhile;

closedir($carpeta);

rmdir($dir);

//redireccionarndo a papelera

    \Clases\Sesion::start();
    \Clases\Sesion::set("ok","imagen_borrada");
    header("Location:index.php?seccion=papelera&ok=imagen_borrada&img=$nombre");
    die();



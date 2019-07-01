<?php
// archivo que procesa los datos mandados desde upload

require_once("../funciones.php");
require_once "../vendor/autoload.php";

//compruebo que exista la variable mandada por POST

if(empty($_POST["nombre"])){

    \Clases\Sesion::start();
    \Clases\Sesion::set("error","nombre");
    header("Location: index.php?seccion=nueva_img_carrousel");
    die();
}

//compruebo que el FILES no tenga errores y que exista
if(empty($_FILES["imagen"]) || $_FILES["imagen"]["error"] != 0 ){

    \Clases\Sesion::start();
    \Clases\Sesion::set("error","imagen");
    header("Location: index.php?seccion=nueva_img_carrousel");
}

$nombre_original = $_POST["nombre"];
$nombre = nombre_limpio($_POST["nombre"]);

//compruebo si existe la carpeta nueva

if(is_dir("../img/carrousel/$nombre")){

    \Clases\Sesion::start();
    \Clases\Sesion::set("error","existe");
    header("Location: index.php?seccion=nueva_img_carrousel");
    die();
}

mkdir("../img/carrousel/$nombre");

// gdlibrary

//cargo img

$imagenOriginal = subida_img($_FILES["imagen"]);

//anchos y altos de img y lienzo

$anchoOriginal = imagesx($imagenOriginal);
$altoOriginal = imagesy($imagenOriginal);

$anchoNuevo = 1200;

    if($anchoOriginal < $anchoNuevo)
    {
        $anchoNuevo = $anchoOriginal;
    }   
$altoNuevo = round(($anchoNuevo * $altoOriginal) / $anchoOriginal);

// creo lienzo

$imagenCopia = imagecreatetruecolor($anchoNuevo,$altoNuevo);

//si es png o gif le agrego comandos especiales para que el fondo no sea negro

img_png_gif($_FILES["imagen"],$imagenCopia);

//inserto la imagen al lienzo

imagecopyresampled($imagenCopia,$imagenOriginal,0,0,0,0,$anchoNuevo,$altoNuevo,$anchoOriginal,$altoOriginal);

//creo img final y la envio al directorio

creacion_img_carrousel($_FILES["imagen"],$imagenCopia,$nombre);
    
//saco la img de la memoria

imagedestroy($imagenCopia);

//fin gdlibrary

$nombre_original = trim(ucfirst(strtolower($nombre_original)));

//Le mando mensaje a la persona que todo funciono

\Clases\Sesion::start();
\Clases\Sesion::set("ok","img_cargada");
\Clases\Sesion::set("img",$nombre_original);
header("Location:index.php?seccion=lista_carrousel_home");
die();

<?php
// archivo que procesa los datos mandados desde upload

require_once("../funciones.php");
require_once "../vendor/autoload.php";

//compruebo que tengamos la variable POST nombre
if(empty($_POST["nombre"])){
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","nombre");
    header("Location: index.php?seccion=nuevo_libro");
    die();
}

//compruebo que no haya errores en el FILES y que exista
if(empty($_FILES["imagen"]) || $_FILES["imagen"]["error"] != 0 ){

    \Clases\Sesion::start();
    \Clases\Sesion::set("error","imagen");
    header("Location: index.php?seccion=nuevo_libro");
    die();
}

$nombre_original = $_POST["nombre"];
$nombre = nombre_limpio($_POST["nombre"]);

//compruebo que no exista ya el libro

if(\Clases\Galeria::existeLibro($nombre_original)){
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","existe");
    header("Location: index.php?seccion=nuevo_libro");
    die();
}

//creo la carpeta para guardar la imagen

if (!is_dir("../libros/$nombre"))
mkdir("../libros/$nombre");

// gdlibrary

//cargo img

$imagenOriginal = subida_img($_FILES["imagen"]);

//anchos y altos de img y lienzo

$anchoOriginal = imagesx($imagenOriginal);
$altoOriginal = imagesy($imagenOriginal);

$anchoNuevo = 450;

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

creacion_img($_FILES["imagen"],$imagenCopia,$nombre);
    
//saco la img de la memoria

imagedestroy($imagenCopia);

//fin gdlibrary

//pongo los valores del POST en variables
    $autor = $_POST["autor"];
    $editorial = $_POST["editorial"];

$extension = poner_png_jpg_gif($_FILES['imagen']);
$imagen = "libros/".$nombre."/".$nombre.".".$extension;
$nombre_original = trim(ucfirst(strtolower($nombre_original)));

//compruebo que no hayan errores en la subida de datos a la base de datos

\Clases\Galeria::crearLibro($nombre_original,$autor,$editorial,$imagen);

//mensaje de todo ok

\Clases\Sesion::start();
\Clases\Sesion::set("ok","libro_cargado");
\Clases\Sesion::set("lib",$nombre_original);

header("Location:index.php?seccion=lista_libros");
die();

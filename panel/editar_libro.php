<?php

// archivo que procesa los datos para editar un libro

require_once("../funciones.php");
require_once "../vendor/autoload.php";

//envio errores de errores

if(empty($_POST["id"])){
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","sin_libro");

    header("Location:index.php?seccion=nuevo_libro");
    die();
}

$libro = $_POST["id"];

//compruebo en la base de datos que no hayan nombres duplicados

if (gettype(\Clases\Galeria::libroPorNombre($libro)) == "String"):
    \Clases\Sesion::start();
    \Clases\Sesion::set("error","muchos_libros");
    header("location:index?secciones=nuevo_libro");
    die();
endif;

    $nombre_nuevo = nombre_limpio($_POST["nombre"]);
    $nombre_nuevo = nombre_original($_POST["nombre"]);

    //pongo los POST en variables
        $autor_nuevo =$_POST["autor"];
        $editorial_nuevo =$_POST["editorial"];

    //compruebo si agrego imagen o le pongo una default

    if(isset($_FILES["imagen"])):

        $extension = poner_png_jpg_gif($_FILES['imagen']);
        $imagen_nueva = "libros/".$nombre_nuevo."/".$nombre_nuevo.$extension;

        //muevo la imagen a la carpeta del libro -sin gdlibrary-

        move_uploaded_file($_FILES["imagen"]["tmp_name"],"../libros/$nombre_nuevo/$nombre_nuevo.$extension");
    else:
        //pongo una imagen por default
        $imagen_nueva = nombre_limpio($_POST["id"]);
        $imagen_nueva= "img/icono.png";
    endif;

\Clases\Galeria::editarLibro($libro,$nombre_nuevo,$autor_nuevo,$editorial_nuevo,$imagen_nueva);


    //redirecciono

    \Clases\Sesion::start();
    \Clases\Sesion::set("ok","libro_editado");
    \Clases\Sesion::set("lib",$libro);
header("Location:index.php?seccion=lista_libros");
die();

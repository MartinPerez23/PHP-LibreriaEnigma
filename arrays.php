<?php
require_once("funciones.php");

    if(!defined("ACCESO")){
        header("Location:../index.php?seccion=home");
    }

//Array para la barra de navegacion

$navbar[] = [
                "nombre" => "Home",
                "ruta" => "index.php?seccion=home"
            ];
$navbar[] = [
                "nombre" => "Formulario",
                "ruta" => "index.php?seccion=formulario"
            ];
$navbar[] = [
                "nombre" => "Galeria",
                "ruta" => "index.php?seccion=galeria"
            ];

//Array para carrousel en 2do parcial (ahora uso la clase Filesystem en el home directamente)
/*
$carpeta = "img/carrousel/";
$dir = opendir($carpeta);
$numero = 0;


while($img = readdir($dir)):
    if($img != "." && $img != ".."):

        if(!isset($fotos)) 
            $clase = "active";
        else $clase = "";

        $imagen = count(glob("$carpeta/$img/$img.*")) > 0 ? glob("$carpeta/$img/$img.*")[0] : "img/icono.png";          

        $fotos[] = [
                        "nombre" => nombre_original($img),
                        "ruta" => "$imagen",
                        "clase" => "$clase",
                        "numero"=>"numero($numero)"
                    ];

    endif;
endwhile;

closedir($dir);


Como creaba array en 1er parcial

$fotos [] = [
                "nombre" => "First slide",
                "clase" => "active",
                "numero" => "0",
                "ruta" => "img/carrousel/1.jpg"
            ];
$fotos [] = [
                "nombre" => "Second slide",
                "clase" => "",  
                "numero" => "1",
                "ruta" => "img/carrousel/2.jpg"
            ];
$fotos [] = [
                "nombre" => "Third slide",
                "clase" => "",
                "numero" => "2",
                "ruta" => "img/carrousel/3.jpg"
            ];  
$fotos [] = [
                "nombre" => "Fourth slide",
                "clase" => "",
                "numero" => "3",
                "ruta" => "img/carrousel/4.jpg"
            ];
$fotos [] = [
                "nombre" => "Fifth slide",
                "clase" => "",
                "numero" => "4",
                "ruta" => "img/carrousel/5.jpg"
            ];
*/


//Creo un Array para galeria a traves de files

$carpeta = "libros";
$dir = opendir($carpeta); 

while($libro = readdir($dir)):
    if($libro != "." && $libro != ".."):

        $imagen = count(glob("$carpeta/$libro/$libro.*")) > 0 ? glob("$carpeta/$libro/$libro.*")[0] : "img/icono.png";

        $autor = imprimir_contenido("$carpeta/$libro/autor.txt","autor");
        $editorial = imprimir_contenido("$carpeta/$libro/editorial.txt","editorial");

                

        $galeria[] = [
                        "nombre" => nombre_original($libro),
                        "ruta" => "$imagen",
                        "autor" => "$autor",
                        "editorial" => "$editorial"
                     ];

    endif;
endwhile;

closedir($dir);




/*

Como creaba array en 1er parcial

$galeria[] = [
                "nombre" => "La raíz de los males",
                "ruta" => "img/libros/1.png",
                "autor" => "Hugo Alconada Mon",
                "editorial" => "Planeta"
            ];

$galeria[] = [
                "nombre" => "Aquí hay dragones",
                "ruta" => "img/libros/2.png",
                "autor" => "Florencia Bonelli",
                "editorial" => "Suma"
            ];
$galeria[] = [
                "nombre" => "filosofía en 11 frases",
                "ruta" => "img/libros/3.png",
                "autor" => "Darío Sztajnszrajber",
                "editorial" => "Paidós"
            ];
$galeria[] = [
                "nombre" => "¡Salvese quien pueda!",
                "ruta" => "img/libros/4.png",
                "autor" => "Andrés Oppenheimer",
                "editorial" => "Debate"
            ];
$galeria[] = [
                "nombre" => "Caos, nadie puede decirte quién sos",
                "ruta" => "img/libros/5.png",
                "autor" => "Magalí Tajes",
                "editorial" => "Sudamericana"
            ];
$galeria[] = [
                "nombre" => "21 lecciones para el siglo XXI",
                "ruta" => "img/libros/6.png",
                "autor" => "Yuval Noah Harari",
                "editorial" => "Debate"
            ];
$galeria[] = [
                "nombre" => "Rota se camina igual",
                "ruta" => "img/libros/7.png",
                "autor" => "Lorena Pronsky",
                "editorial" => "Sur"
            ];
$galeria[] = [
                "nombre" => "La dieta del matabolismo acelerado",
                "ruta" => "img/libros/8.png",
                "autor" => "Haylie Pomroy",
                "editorial" => "Grijalbo"
            ];
$galeria[] = [
                "nombre" => "Gravity Falls",
                "ruta" => "img/libros/9.png",
                "autor" => "Alex Wisrch",
                "editorial" => "Disney"
            ];
$galeria[] = [
                "nombre" => "Putita golosa",
                "ruta" => "img/libros/10.png",
                "autor" => "Luciana Peker",
                "editorial" => "Sudna"
            ];
$galeria[] = [
                "nombre" => "Masones argentinos",
                "ruta" => "img/libros/11.png",
                "autor" => "Mariano Halmiton",
                "editorial" => "Planeta"
            ];
$galeria[] = [
                "nombre" => "Teoría King Kong",
                "ruta" => "img/libros/12.png",
                "autor" => "Virginie Despentes",
                "editorial" => "Literatura Random House"
            ];
$galeria[] = [
                "nombre" => "El cuento de la criada",
                "ruta" => "img/libros/13.png",
                "autor" => "Margaret Atwood",
                "editorial" => "Salamandra"
            ];
$galeria[] = [
                "nombre" => "Las hijas del capitán",
                "ruta" => "img/libros/14.png",
                "autor" => "María Dueñas",
                "editorial" => "Planeta"
            ];
$galeria[] = [
                "nombre" => "De animales a dioses",
                "ruta" => "img/libros/15.png",
                "autor" => "Yuval Noah Harari",
                "editorial" => "Debate"
            ];
*/

<?php

function mascomprados($entrada)
{
    
$array=array_rand($entrada,3);
    
    
//guardo los random en un array para recorrerlo
$libro[]=$entrada[$array[0]];
$libro[]=$entrada[$array[1]];
$libro[]=$entrada[$array[2]];

    
    
    echo "<div class='row'>";
        echo "<div class='col-12'>";
            echo "<h1 class='center-block'>Los 3 libros mas comprados del segundo son...</h1>";
        echo "</div>";
    echo "</div>";

foreach($libro as $arr):
    echo "<div class='col-6 col-md-4 my-4'>";
        echo "<div class='card-deck'>";
            echo "<div class='card border-success colortarjetas'>";
                echo "<div class='card-body'>";
                        echo "<a class='fancy_box' rel='grupo1' href='" . $arr["ruta"] . "'><img src='". $arr["ruta"]."' alt='".$arr["nombre"]."' class='img-fluid'></a>";
                        echo "<h4 class='card-title'>".$arr["nombre"]."</h4>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
    
endforeach;     
  }

//
function numero($numero)
{
    return ($numero+1);
}
// gdlibrary

function subida_img($imagen)
{
    switch($imagen["type"])
    {
                            case "image/jpeg": 
                                                return imagecreatefromjpeg($imagen["tmp_name"]);
                            break;
                            case "image/png": 
                                                return imagecreatefrompng($imagen["tmp_name"]);
                            break;
                            case "image/gif": 
                                                return imagecreatefromgif($imagen["tmp_name"]);
                            break;
    }
}

function img_png_gif($imagen,$imagenCopia)
{
 switch($imagen["type"])
 {
                        case "image/png":
                        case "image/gif":
                                            return imagesavealpha($imagenCopia,true).imagealphablending($imagenCopia,false);
                        break;
                        default: "";
                        break;
  }
}

function creacion_img($imagen,$imagenCopia,$nombre)
{
    switch($imagen["type"])
    {
                            case "image/jpeg": 
                                                return imagejpeg($imagenCopia,"../libros/$nombre/$nombre.jpg",70);
                            break;
                            case "image/png": 
                                                return imagepng($imagenCopia,"../libros/$nombre/$nombre.png",5,PNG_NO_FILTER);
                            break;
                            case "image/gif":
                                               return imagegif($imagenCopia,"../libros/$nombre/$nombre.gif",5);
                            break;
    }
}

function creacion_img_carrousel($imagen,$imagenCopia,$nombre)
{
    switch($imagen["type"])
    {
                            case "image/jpeg": 
                                                return imagejpeg($imagenCopia,"../img/carrousel/$nombre/$nombre.jpg",70);
                            break;
                            case "image/png": 
                                                return imagepng($imagenCopia,"../img/carrousel/$nombre/$nombre.png",5,PNG_NO_FILTER);
                            break;
                            case "image/gif":
                                               return imagegif($imagenCopia,"../img/carrousel/$nombre/$nombre.gif",5);
                            break;
    }
}

function poner_png_jpg_gif($imagen)
{
    switch($imagen["type"])
    {
                            case "image/jpeg": 
                                                return "jpg";
                            break;
                            case "image/png": 
                                                return "png";
                            break;
                            case "image/gif":
                                               return "gif";
                            break;
    }
}
// mostrar arrays

 function mostrar_array($arr,$print_r = true){

        echo "<pre>";
            if($print_r)
                print_r($arr);
            else
                var_dump($arr);
        echo "</pre>";

    }

//funciones para la barra de navegacion del panel

    
function sacar_php($string)
{
    $string = str_replace(".php","",$string);
    return($string);
}

function arrays_para_navbar_panel()
{
    $carp = "secciones";
    $direc = opendir($carp); 

    while($navbar2 = readdir($direc)):
        if($navbar2 != "." && $navbar2 != ".."):
                                                    $navbar2 = sacar_php($navbar2);
                                                    $navbar_panel[] = [
                                                                        "nombre" =>nombre_original($navbar2),
                                                                        "ruta" => "index.php?seccion=$navbar2"
                                                                      ];
        endif;
    endwhile;
    closedir($direc);
    
    return($navbar_panel);
}

//para limpiar Strings

function imprimir_contenido($ruta,$tipo)
{
    return file_exists($ruta) ? limpiar_string(file_get_contents($ruta)) : "Sin $tipo";
}

function limpiar_string($str)
{
    return nl2br(htmlentities(trim($str)));
}

function nombre_limpio($str)
{
    $nombre = strtolower($str);
    $nombre = trim($nombre);
    $nombre = str_replace(" ","_",$nombre);

    return $nombre;
}

function nombre_original($str)
{
    $nombre = str_replace("_"," ",$str);

    $nombre = ucwords($nombre);

    return $nombre;
}

function sacar_jpg_png_gif($string)
{
    $extension[] = ".jpg";
    $extension[] = ".png";
    $extension[] = ".gif";
    
    $string = str_replace($extension,"",$string);
    return($string);
}

//genero logs por errores en la base de datos

function generar_logs(Exception $exception){

    $debug = parse_ini_file('config.ini')["debug"];
    $log = parse_ini_file('config.ini')["env"];

    $mensaje = "<div style='color: #fff; background-color: #FF0000; padding: 15px;'><p><b style='color: #000;'>ERROR! </b>" . $exception->getMessage();

    $mensaje .= "<br> Hubo un <b style='color: #000;'>error</b> en la linea <b>". $exception->getLine(). "</b> del archivo <b>". $exception->getFile() . "</b></p>";

    $mensaje .= "<br> <b style='color: #000;'>Trace: </b><ul>";

    foreach($exception->getTrace() as $orden => $error ):

        $mensaje .= "<li><b style='color: #000;'>#$orden: </b> Clase <b>$error[class]</b> ejecutó el método <b>$error[function]</b> (<b>$error[file] - línea $error[line]</b>)</li>";

    endforeach;

    $mensaje .= "</ul></div>";


    // Generar un log
    if($log != "local"):
        // carpeta logs
        if(!is_dir("logs"))
            mkdir("logs");

        $log = date("d/m/Y H:i:s",time()) . " Metodo ". $_SERVER["REQUEST_METHOD"] ." - ". $_SERVER["REMOTE_ADDR"]. ":". $_SERVER["SERVER_PORT"] .": " . $exception->getMessage() . ". En la línea ". $exception->getLine() . " del archivo " . $exception->getFile() . " [ Trace:  " . $exception->getTraceAsString() . "] \n";

        file_put_contents("logs/errores.log", $log ,FILE_APPEND);
    endif;
    // Mostrar el mensaje en pantalla


    echo $debug ? $mensaje : null;
}

//para comprobar datos de algo

function dd($array, $print = true){
    echo "<pre>";
    if($print)
        print_r($array);
    else
        var_dump($array);
    echo "</pre>";
    die();
}
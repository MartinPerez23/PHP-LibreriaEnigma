<?php
require_once("configuraciones.php");
require_once("arrays.php");
require_once("funciones.php");

require_once 'vendor/autoload.php';

//Se fija que tenga nombre, password, email y genero como obligatorio

if(empty($_POST["nombre"]) || empty($_POST["email"]) || empty($_POST["generos"])|| empty($_POST["password"])){
    \Clases\Sesion::start();
   \Clases\Sesion::set("error","<strong>Error!</strong> Los campos <b>Nombre</b>, <b>Contraseña</b>, <b>Email</b> y <b>Género favorito</b> son obligatorios.");

    header("Location:index.php?seccion=formulario");
    die();
}

//pongo los datos del formulario en variables para exportarlos

$nombre = nombre_original(nombre_limpio($_POST["nombre"]));
$contraseña = $_POST["password"];
$contraseña = password_hash($contraseña,PASSWORD_DEFAULT);
$apellido = nombre_original(nombre_limpio($_POST["apellido"]));
$email = strtolower($_POST["email"]);

//compruebo que no exista el mail en la base de datos

if(!\Clases\Usuario::existeEmail($email)):

    \Clases\Sesion::start();
    \Clases\Sesion::set("error","<strong>Error!</strong> Ese <b>Email</b> ya existe.");

    header("Location:index.php?seccion=formulario");
    die();
endif;

//mando los comentarios

if(!empty($_POST["comentario"])&& isset($_POST["comentario"])):
$comentario = strtolower(limpiar_string($_POST["comentario"]));
else: $comentario= "Sin comentarios";
endif;

//pongo el checkbox en una variable para exportarla

$generos = serialize ($_POST["generos"]);

//Exporto las variables para tomarlas con Session

\Clases\Sesion::start();
\Clases\Sesion::set(["formulario" => "nombre"],$nombre);
\Clases\Sesion::set(["formulario" => "apellido"],$apellido);
\Clases\Sesion::set(["formulario" => "email"],$email);
\Clases\Sesion::set(["formulario" => "comentario"],$comentario);
\Clases\Sesion::set(["formulario" => "generos"],$generos);
\Clases\Usuario::crearUsuario($nombre,$apellido,$comentario,$email,$contraseña,$generos);

header("Location:index.php?seccion=formulario");
die();
<?php
    require_once 'configuraciones.php';
    require_once 'funciones.php';

    require_once 'vendor/autoload.php';

    //compruebo que los datos recibidos

   if(empty($_POST["email"]) || empty($_POST["password"])):
       \Clases\Sesion::start();
       \Clases\Sesion::set("error","Los campos email y password son obligatorios");
       header("Location:index.php?seccion=login");

       die();
   endif;

   $email = $_POST["email"];
   $password = $_POST["password"];

   //compruebo datos con la base de datos
   if(\Clases\Usuario::login($email,$password)):

       //habilito un usuario deshabilitado y le mando un mensaje

       if ($_SESSION["usuario"]["habilitado"] == 0):

            \Clases\Usuario::darseAlta($_SESSION["usuario"]["email"]);

            \Clases\Sesion::start();

            \Clases\Sesion::set("alta","Bienvenido de vuelta! Se <b>habilitó</b> la cuenta: <b>" . $_SESSION["usuario"]["email"]."</b>");
        endif;

        //redirecciono

       header("Location:index.php");
       die();

   else:

       //compruebo errores

       \Clases\Sesion::start();
       \Clases\Sesion::set("error","Los datos ingresados no son correctos");

       header("Location:index.php?seccion=login");
       die();
   endif;



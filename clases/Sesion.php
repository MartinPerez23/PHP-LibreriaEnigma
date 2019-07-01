<?php


namespace Clases;


class Sesion
{
    public static function start(){
        session_start();
    }

    public static function destroy(){

        session_destroy();
    }

    public static function cerrarUsuario(){

        unset($_SESSION["usuario"]);
    }

    public static function set($prop, $val){

        if(gettype($prop) == "array"):
            foreach($prop as $ind => $subind):
                $_SESSION[$ind][$subind] = $val;
            endforeach;
        else:
            $_SESSION[$prop] = $val;
        endif;
    }

    public static function haySesion($prop){
        if(!empty($prop) && isset($_SESSION[$prop]));
        return $_SESSION[$prop];

        return false;
    }

    public static function errores(){
        if (self::hayError()):
                $error = $_SESSION["error"];
                unset($_SESSION["error"]);
                if($error == "nombre"){
                    $mensaje = "El campo nombre es obligatorio";

                }elseif($error == "imagen"){
                    $mensaje = "Error! con la imagen";

                }elseif($error == "existe"){
                    $mensaje = "Lo que quiere dar de alta ya existe";

                }elseif($error == "sin_libro"){
                    $mensaje = "Error!! No selecciono ningun libro";

                }elseif($error == "error_libro"){
                    $mensaje = "El libro seleccionado no existe";

                }elseif($error == "muchos_libros"){
                    $mensaje = "Hay mas de un resultado para el libro seleccionado";

                }elseif($error == "sin_img"){
                    $mensaje = "Error! Seleccione una imagen a eliminar.";

                }elseif($error == "error_img"){
                    $mensaje = "La imagen seleccionado no existe.";

                }else
                    $mensaje = $error;

                $mensaje = <<<ALERT
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <p>
                        $mensaje
                    </p>
                </div>
ALERT;
            echo $mensaje;
        endif;
    }

    public static function ok(){
        if (self::hayOk()):
            $ok = $_SESSION["ok"];
            unset($_SESSION["ok"]);


            if($ok == "libro_cargado" && !empty($_SESSION["lib"])){
                $mensaje = "Se ha añadido un nuevo libro: ". ucfirst(nombre_original($_SESSION["lib"]));
                unset($_SESSION["lib"]);

            }elseif($ok == "libro_movido" && !empty($_SESSION["lib"])){
                $mensaje = "Se ha movido el libro: ". ucfirst(nombre_original($_SESSION["lib"])). " a la papelera.";
                unset($_SESSION["lib"]);

            }elseif($ok == "libro_editado" && !empty($_SESSION["lib"])){
                $mensaje = "Se ha editado el libro: ". ucfirst(nombre_original($_SESSION["lib"]));
                unset($_SESSION["lib"]);
            }
            elseif($ok == "sin_img"){
                $mensaje = "Error! Seleccione una imagen a eliminar.";

            }elseif($ok == "error_img"){
                $mensaje = "La imagen seleccionado no existe.";

            }elseif($ok == "imagen_movida" && !empty($_SESSION["img"])){
                $mensaje = "Se ha devuelto la imagen: ". ucfirst(nombre_original($_SESSION["img"]))." al carrousel";
                unset($_SESSION["img"]);

            }elseif($ok == "imagen_borrada" && !empty($_SESSION["img"])){
                $mensaje = "Se ha eliminado permanentemente la imagen: ". ucfirst(nombre_original($_SESSION["img"]));
                unset($_SESSION["img"]);

            }else{
                $mensaje = $ok;
            }
                $mensaje = <<<ALERT
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <p>
                       $mensaje
                    </p>
                </div>
ALERT;
                echo $mensaje;
        endif;
    }

    private static function hayOk(){
        return !empty($_SESSION["ok"]);
    }

    private static function hayError(){
        return !empty($_SESSION["error"]);
    }

    public static function hayUser(){

        return isset($_SESSION["usuario"]["email"]) ? true : false;
    }

    public static function user(){
        $usuario = $_SESSION["usuario"]["apellido"] ." ". $_SESSION["usuario"]["nombre"];
        return $usuario;
    }
}
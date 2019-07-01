<?php
/**
 * Created by PhpStorm.
 * User: Alumno
 * Date: 25/3/2019
 * Time: 16:24
 */

namespace Clases;

use Throwable;

class Exception extends \Exception
{

    private $debug;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->debug = parse_ini_file('config.ini')["debug"];

        parent::__construct($message, $code, $previous);
    }

    public function mostrarMensaje(){
        $mensaje = "<div style='color: #fff; background-color: #000; padding: 15px;'><p><b style='color: red;'>ERROR! </b>" . $this->message;

        $mensaje .= "<br> Hubo un <b style='color: red;'>error</b> en la linea <b>". $this->line . "</b> del archivo <b>". $this->file . "</b></p>";

        $mensaje .= "<br> <b style='color: red;'>Trace: </b><ul>";

        foreach($this->getTrace() as $orden => $error ):

            $mensaje .= "<li><b style='color: red;'>#$orden: </b> Clase <b>$error[class]</b> ejecutó el método <b>$error[function]</b> (<b>$error[file] - línea $error[line]</b>)</li>";

        endforeach;

        $mensaje .= "</ul></div>";


        return $this->debug ? $mensaje : null;

    }
}
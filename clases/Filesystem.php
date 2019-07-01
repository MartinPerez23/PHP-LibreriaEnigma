<?php


namespace Clases;


class Filesystem
{
    static public function getAll($carpeta){
        $recurso = self::opendir($carpeta);

        $datos = [];

        while($archivos = readdir($recurso)):
            if($archivos != "." && $archivos != ".."):
                $datos[] = $archivos;
            endif;
        endwhile;

        self::closedir($recurso);

        return $datos;
    }

    static private function opendir($ruta){
        return opendir($ruta);
    }


    static function closedir($recurso){
        closedir($recurso);
    }
}
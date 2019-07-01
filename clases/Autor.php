<?php


namespace Clases;


class Autor
{
    protected $id_autor;
    protected $nombre;

    public function __construct($id,$autor)
    {
        $this->id_autor = $id;
        $this->nombre = $autor;
    }

    /**
     * @return mixed
     */
    public function getIdAutor()
    {
        return $this->id_autor;
    }

    /**
     * @param mixed $id_autor
     */
    public function setIdAutor($id_autor)
    {
        $this->id_autor = $id_autor;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public static function getAll()
    {
        $query = "SELECT `id_autor`, `nombreCompleto`  
                FROM `autor`";

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        $todo = [];

        while($autor = $stmt->fetchObject()):

            $todo[] = self::setAttributes($autor);

        endwhile;

        return $todo;
    }
    private static function setAttributes($atributos){

        $autor = new Autor($atributos->id_autor,$atributos->nombreCompleto);

        return $autor;

    }
}
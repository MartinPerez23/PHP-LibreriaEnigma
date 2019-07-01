<?php


namespace Clases;


class Editorial
{
    protected $id_editorial;
    protected $nombre;

    public function __construct($id,$editorial)
    {
        $this->id_editorial = $id;
        $this->nombre = $editorial;
    }

    /**
     * @return mixed
     */
    public function getIdEditorial()
    {
        return $this->id_editorial;
    }

    /**
     * @param mixed $id_editorial
     */
    public function setIdEditorial($id_editorial)
    {
        $this->id_editorial = $id_editorial;
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
        $query = "SELECT `id_editorial`, `nombre`  
                FROM `editorial`";

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        $todo = [];

        while($editorial = $stmt->fetchObject()):

            $todo[] = self::setAttributes($editorial);

        endwhile;

        return $todo;
    }
    private static function setAttributes($atributos){

        $editorial = new Editorial($atributos->id_editorial,$atributos->nombre);

        return $editorial;

    }
}
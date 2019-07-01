<?php


namespace Clases;


class Galeria
{
    protected $id_libro;
    protected $nombre;
    protected $autor;
    protected $editorial;
    protected $imagen;
    protected $habilitado;
    protected $id_autor;
    protected $id_editorial;

    protected $atributos = [];


    public function __construct($id_libro,$nombre,$autor,$editorial,$imagen,$habilitado)
    {
        $this->id_libro = $id_libro;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->imagen = $imagen;
        $this->nombre = $nombre;
        $this->habilitado = $habilitado;

    }

    /**
     * @return mixed
     */
    public function getIdLibro()
    {
        return $this->id_libro;
    }

    /**
     * @param mixed $id_libro
     */
    public function setIdLibro($id_libro)
    {
        $this->id_libro = $id_libro;
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

    /**
     * @return mixed
     */
    public function getAutor()
    {
        return $this->autor;
    }

    /**
     * @param mixed $autor
     */
    public function setAutor($autor)
    {
        $this->autor = $autor;
    }

    /**
     * @return mixed
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * @param mixed $editorial
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @return mixed
     */
    public function getHabilitado()
    {
        return $this->habilitado;
    }

    /**
     * @param mixed $habilitado
     */
    public function setHabilitado($habilitado)
    {
        $this->habilitado = $habilitado;
    }

    /**
     * @return array
     */
    public function getAtributos()
    {
        return $this->atributos;
    }

    /**
     * @param array $atributos
     */
    public function setAtributos($atributos)
    {
        $this->atributos = $atributos;
    }

    public function __get($propiedad)
    {
        $this->checkPropiedad($propiedad);
    }

    public function checkPropiedad($prop){
        if(method_exists($this,"get". ucfirst($prop))){
            $getter = "get".ucfirst($prop);

            return $this->$getter();
        }else if(property_exists($this,$prop)){

            return $this->$prop;

        }else{
            if(array_key_exists($prop,$this->atributos)){
                return $this->atributos[$prop];
            }else{
                throw new Exception("Estás queriendo acceder a una propiedad <b>$prop</b> que no existe");
            }
        }

    }

    public function __set($propiedad, $valor)
    {
        if(method_exists($this,"set". ucfirst($propiedad))){
            $setter = "set".ucfirst($propiedad);

            $this->$setter($valor);

        }else{
            $this->atributos[$propiedad] = $valor;
        }


    }

    // tomo todos los datos de la base de datos y armo el objeto Galeria con los libros

    public static function libro($id_libro){
        $bd = BD::conectarseConBD();

        // HEREDOC
        $query = <<<QUERY
              SELECT l.`id_libro`, l.`nombre`, l.`imagen`, a.`nombreCompleto` as autor, e.`nombre`as editorial, l.`habilitado`  
                FROM `libro` as l
                INNER JOIN `editorial` as e on e.id_editorial = l.id_editorial_FK
                INNER JOIN `autor` as a on a.id_autor = l.id_autor_FK
                
                WHERE l.id_libro= :id_libro;
          
QUERY;

        $query = str_replace(":id_libro","'$id_libro'",$query);
        $stmt = $bd->prepare($query);
        $stmt->execute([$id_libro]);

        $data = $stmt->fetchObject();

        $libro = new Galeria($data->id_libro,$data->nombre,$data->autor,$data->editorial, $data->imagen, $data->habilitado);

        return $libro;
    }

    private static function setAttributes($atributos){

        $libro = new Galeria($atributos->id_libro,$atributos->nombre,$atributos->autor,$atributos->editorial, $atributos->imagen, $atributos->habilitado);
        $libro->setIdLibro($atributos->id_libro);

        return $libro;

    }

    public static function getAll(){

        $query = "SELECT l.`id_libro`, l.`nombre`, l.`imagen`, a.`nombreCompleto` as autor, e.`nombre`as editorial, l.`habilitado`  
                FROM `libro` as l
                INNER JOIN `editorial` as e on e.id_editorial = l.id_editorial_FK
                INNER JOIN `autor` as a on a.id_autor = l.id_autor_FK";

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        $todo = [];

        while($libro = $stmt->fetchObject()):

            $todo[] = self::setAttributes($libro);

        endwhile;

        return $todo;
    }

    public static function darBajaLibro($nombre)
    {
        $query = "UPDATE `libro` SET `habilitado` = '0' WHERE `nombre` = :nombre";

        $query = str_replace(":nombre","'$nombre'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }

    public static function darAltaLibro($nombre)
    {
        $query = "UPDATE `libro` SET `habilitado` = '1' WHERE `nombre` = :nombre";

        $query = str_replace(":nombre","'$nombre'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }

    public static function editarLibro($nombreViejo,$nombreNuevo,$autor,$editorial,$imagen)
    {
        $query = "UPDATE `libro` SET `nombre` = :nombreNuevo ,`imagen` = :imagen , `id_autor_FK`= :autor ,`id_editorial_FK`= :editorial WHERE `nombre` = :nombre";

        $buscar = [":nombreNuevo",":imagen",":autor",":editorial",":nombre"];
        $reemplazar = ["'$nombreNuevo'","'$imagen'",self::buscarAutor($autor),self::buscarEditorial($editorial),"'$nombreViejo'"];

        $query = str_replace($buscar,$reemplazar,$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }

    public static function buscarAutor($autor)
    {
        $query = "SELECT `id_autor`, `nombreCompleto`  
                FROM `autor`
                WHERE `nombreCompleto` = :autor ";

        $query = str_replace(":autor","'$autor'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() == 1):

            $data = $stmt->fetchObject();
            $data = $data->id_autor;

          return ($data);
        else:
            return false;
        endif;

    }

    public static function buscarEditorial($editorial)
    {
        $query = "SELECT `id_editorial`, `nombre`  
                FROM `editorial`
                WHERE `nombre` = :editorial ";

        $query = str_replace(":editorial","'$editorial'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() == 1):

            $dato = $stmt->fetchObject();
            $dato = $dato->id_editorial;

            return ($dato);
        else:
            return false;
        endif;

    }

    public static function libroPorNombre($nombre){

        $query = "SELECT l.`id_libro`, l.`nombre`, l.`imagen`, a.`nombreCompleto` as autor, e.`nombre`as editorial, l.`habilitado`  
                FROM `libro` as l
                INNER JOIN `editorial` as e on e.id_editorial = l.id_editorial_FK
                INNER JOIN `autor` as a on a.id_autor = l.id_autor_FK
                
                WHERE l.`nombre` = :nombre ";

        $query=str_replace(":nombre","'$nombre'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() == 1):
        while($libro = $stmt->fetchObject()):

            $todo = self::setAttributes($libro);

        endwhile;
            return $todo;
        endif;
        return "Error, mas de un elemento";
    }

    // pongo los libros deshabilitados que estan en la base de datos

    public static function papelera(){

        $query = "SELECT `habilitado`  
                FROM `libro`
                WHERE `habilitado`= '0' ";

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

         if ($stmt->rowCount()==0)
             return false;

         return true;
    }

    public static function existeLibro($nombre)
    {
        $query = "SELECT `id_libro`, `nombre`
                    FROM `libro` 
                    WHERE `nombre` = :nombre ";

        $query = str_replace(":nombre", "'$nombre'", $query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        if ($stmt->rowCount() == 1)
        return true;
        return false;
    }

    public static function crearLibro($nombre,$autor,$editorial,$imagen)
    {
        if (gettype(self::buscarAutor($autor)) == "boolean"):
            return "Error con el Autor, no esta en la Base de Datos";
        die();
        endif;

        if (gettype(self::buscarEditorial($editorial)) == "boolean"):
            return "Error con la editorial, no esta en la Base de Datos";
        die();
        endif;

        $query = "INSERT INTO `libro`(`nombre`, `imagen`, `id_autor_FK`, `id_editorial_FK`) VALUES ( :nombre , :imagen , :autor , :editorial )";

        $buscar = [":nombre",":imagen",":autor",":editorial"];
        $reemplazar = ["'$nombre'","'$imagen'",self::buscarAutor($autor),self::buscarEditorial($editorial)];

        $query = str_replace($buscar,$reemplazar,$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }
}
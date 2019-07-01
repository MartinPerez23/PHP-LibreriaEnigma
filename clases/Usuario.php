<?php


namespace Clases;


class Usuario
{
    protected $id_usuario;
    protected $nombre;
    protected $apellido;
    protected $email;
    protected $comentario;
    protected $genero_favorito;
    protected $admin;
    protected $habilitado;

    public function __construct($nombre, $apellido,$email,$comentario,$genero_favorito,$admin,$habilitado)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->comentario = $comentario;
        $this->genero_favorito = $genero_favorito;
        $this->admin = $admin;
        $this->habilitado = $habilitado;

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
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @param mixed $comentario
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    /**
     * @return mixed
     */
    public function getGeneroFavorito()
    {
        return $this->genero_favorito;
    }

    /**
     * @param mixed $genero_favorito
     */
    public function setGeneroFavorito($genero_favorito)
    {
        $this->genero_favorito = $genero_favorito;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
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

    public static function login($email, $password)
    {
        $query = "SELECT * FROM usuario WHERE email = ?";

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute([$email]);

        if($stmt->rowCount() == 0)
            return false;

        $usuario = $stmt->fetchObject();

        if(!password_verify($password,$usuario->password))
            return false;


        self::crearSesionUsuario($usuario);


        return true;

    }

    //compruebo en la base de datos que no haya emails duplicados

    public static function existeEmail($email)
    {

        $query = "SELECT * FROM usuario WHERE email = :email";

        $query = str_replace(":email","'$email'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute([$email]);

        if($stmt->rowCount() == 0)
            return true;

        return false;
    }

    public static function crearUsuario($nom,$ape,$com,$email,$pass,$gen)
    {
        $query = "INSERT INTO `usuario`(`nombre`, `apellido`, `comentario`, `email`, `password`, `genero_favorito`) VALUES ( :nom , :ape , :com , :email , :pass , :gen )";

        $buscar = [":nom",":ape",":com",":email",":pass",":gen"];
        $reemplazar = ["'$nom'","'$ape'","'$com'","'$email'","'$pass'","'$gen'"];

        $query = str_replace($buscar,$reemplazar,$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }

    private static function crearSesionUsuario($usuario)
    {
        Sesion::start();
        Sesion::set(["usuario" => "nombre"], $usuario->nombre);
        Sesion::set(["usuario" => "apellido"], $usuario->apellido);
        Sesion::set(["usuario" => "email"], $usuario->email);
        Sesion::set(["usuario" => "comentario"], $usuario->comentario);
        Sesion::set(["usuario" => "genero_favorito"], $usuario->genero_favorito);
        Sesion::set(["usuario" => "admin"], $usuario->admin);
        Sesion::set(["usuario" => "habilitado"], $usuario->habilitado);

    }

    //deshabilita un usuario

    public static function darseBaja($email)
    {
        $query = "UPDATE `usuario` SET `habilitado` = '0' WHERE `email` = :email";

        $query = str_replace(":email","'$email'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }

    //habilita un usuario

    public static function darseAlta($email)
    {
        $query = "UPDATE `usuario` SET `habilitado` = '1' WHERE `email` = :email";

        $query = str_replace(":email","'$email'",$query);

        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();
    }

    public static function getAll(){

        $query = "SELECT `nombre`, `apellido`, `comentario` , `email`, `habilitado`, `admin`, `genero_favorito`  
                FROM `usuario`";


        $bd = BD::conectarseConBD();

        $stmt = $bd->prepare($query);

        $stmt->execute();

        $todo = [];

        while($usuario = $stmt->fetchObject()):

            $todo[] = self::setAttributes($usuario);

        endwhile;

        return $todo;
    }

    private static function setAttributes($atributos){

        $usuario = new Usuario($atributos->nombre,$atributos->apellido,$atributos->email,$atributos->comentario, $atributos->genero_favorito,$atributos->admin, $atributos->habilitado);

        return $usuario;

    }
}
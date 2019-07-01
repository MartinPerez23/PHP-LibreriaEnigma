<?php


namespace clases;


class BD
{
    private static $bd;

    private function __construct(){}

    private static function connect(){
        $ini = parse_ini_file('config.ini',true);

        try{
            $host = $ini["BASEDEDATOS"]["host"];
            $dbName = $ini["BASEDEDATOS"]["bd"];
            $charset = $ini["BASEDEDATOS"]["charset"];
            $user = $ini["BASEDEDATOS"]["user"];
            $password = $ini["BASEDEDATOS"]["password"];

            self::$bd = new \PDO("mysql:host=$host;dbname=$dbName;charset=$charset",$user, $password);
        }catch (\PDOException $e){
            echo $e->getMessage();
            echo $e->getFile();

            die();
        }
    }

    public static function conectarseConBD(){
        if(empty(self::$bd))
            self::connect();

        return self::$bd;
    }
}
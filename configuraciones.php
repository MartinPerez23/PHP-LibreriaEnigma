<?php
//le digo donde esta el config.ini

$ini = parse_ini_file('config.ini',true);

// habilito errores
error_reporting(E_ALL);

ini_set('display_errors',$ini["debug"]);

//pongo la zona de horario

date_default_timezone_set("America/Argentina/Buenos_Aires");

// constante para ver si el usuario pasa por el index o no
define("ACCESO",true);

//aparecer "los 3 libros mas comprados en la semana" en galeria
$boolean=true;


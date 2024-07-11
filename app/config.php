<?php 

//Variables Globales
define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('PORT','3307');
define('BD','sistemadeventas');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR.";port=".PORT;
                              
try{
    $pdo = new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo "La conexion a la base de datos fue exitosa";
}catch(PDOException $e){
    echo "Error al conectarte a la base de datos";
}

$URL="http://localhost/www.sistemadeventas.com/";

date_default_timezone_set('America/Bogota');
$fechaHora = date("Y-m-d H:i:s");

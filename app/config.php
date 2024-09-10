<?php

// Definición de constantes para la conexión a la base de datos.
define('SERVIDOR', 'localhost');     // Nombre del servidor de base de datos
define('USUARIO', 'root');            // Usuario para la base de datos
define('PASSWORD', '');              // Contraseña para el usuario
define('PORT', '3307');              // Puerto del servidor de base de datos
define('BD', 'sistemadeventas');     // Nombre de la base de datos

// Configuración de la conexión a la base de datos
$servidor = "mysql:dbname=" . BD . ";host=" . SERVIDOR . ";port=" . PORT;

try {
    // Intento de conexión a la base de datos usando PDO
    $pdo = new PDO($servidor, USUARIO, PASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    //echo "La conexión a la base de datos fue exitosa";
} catch (PDOException $e) {
    // Mensaje de error en caso de fallo en la conexión
    echo "Error al conectarte a la base de datos";
}

// Definición de la URL base del sistema
$URL = "http://localhost/www.sistemadeventas.com/";

// Configuración de la zona horaria
date_default_timezone_set('America/Bogota');

// Obtención de la fecha y hora actual
$fechaHora = date("Y-m-d H:i:s");

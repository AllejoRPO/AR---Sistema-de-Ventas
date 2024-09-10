<?php

// Incluir el archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Iniciar la sesión
session_start();

// Verificar si la sesión del usuario está activa
if (isset($_SESSION['sesion_email'])) {
    // Destruir la sesión actual
    session_destroy();

    // Redirigir al usuario a la página de inicio
    header('Location: '.$URL.'/');
}
?>

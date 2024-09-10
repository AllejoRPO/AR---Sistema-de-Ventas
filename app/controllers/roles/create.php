<?php

// Incluir archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Obtener datos del formulario
$rol = $_POST['rol'];

// Preparar la sentencia SQL para insertar un nuevo rol en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_roles 
    (rol, fyh_creacion)
    VALUES (:rol, :fyh_creacion)
");

// Asignar valores a los parámetros de la consulta
$sentencia->bindParam(':rol', $rol);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

// Ejecutar la sentencia SQL y redirigir en función del resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el rol correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/roles');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error, no se registró el rol en la base de datos";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/roles/create.php');
}

?>

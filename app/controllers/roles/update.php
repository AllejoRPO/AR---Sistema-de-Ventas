<?php

// Incluir archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Obtener datos del formulario
$id_rol = $_POST['id_rol'];
$rol = $_POST['rol'];

// Preparar la consulta SQL para actualizar el rol en la base de datos
$sentencia = $pdo->prepare("
    UPDATE tb_roles 
    SET rol = :rol,
        fyh_actualizacion = :fyh_actualizacion 
    WHERE id_rol = :id_rol
");

// Asignar valores a los parámetros de la consulta
$sentencia->bindParam(':rol', $rol);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_rol', $id_rol);

// Ejecutar la sentencia SQL y redirigir en función del resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el rol correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/roles');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo actualizar el rol";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . '/roles/update.php?id=' . $id_rol);
}

?>

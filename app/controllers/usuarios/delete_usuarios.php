<?php

// Incluir archivo de configuración para establecer conexión con la base de datos
include ('../../config.php');

// Obtener el ID del usuario a eliminar
$id_usuario = $_POST['id_usuario'];

// Preparar la consulta SQL para eliminar el usuario
$sentencia = $pdo->prepare("DELETE FROM tb_usuarios WHERE id_usuario = :id_usuario");

// Asignar valor al parámetro de la consulta
$sentencia->bindParam(':id_usuario', $id_usuario);

// Ejecutar la sentencia SQL
if ($sentencia->execute()) {
    // Iniciar sesión y redirigir en caso de éxito
    session_start();
    $_SESSION['mensaje'] = "Se eliminó al usuario correctamente";
    $_SESSION['icono'] = "success";
    header('Location: ' . $URL . '/usuarios');
} else {
    // Manejo de error si la ejecución falla
    session_start();
    $_SESSION['mensaje'] = "Error al eliminar al usuario";
    $_SESSION['icono'] = "error";
    header('Location: ' . $URL . '/usuarios');
}

?>

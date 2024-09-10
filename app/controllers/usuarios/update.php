<?php

// Incluir archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Obtener datos del formulario
$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];
$rol = $_POST['rol'];

// Verificar si se proporciona una nueva contraseña
if ($password_user == "") {
    // No se proporciona una nueva contraseña, actualizar solo los datos del usuario
    if ($password_user == $password_repeat) {
        $sentencia = $pdo->prepare("
            UPDATE tb_usuarios 
            SET nombres = :nombres,
                email = :email,
                id_rol = :id_rol,
                fyh_actualizacion = :fyh_actualizacion 
            WHERE id_usuario = :id_usuario
        ");

        // Asignar valores a los parámetros de la consulta
        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $rol);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario);

        // Ejecutar la sentencia SQL y redirigir en función del resultado
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizó al usuario correctamente";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . '/usuarios');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar al usuario";
            $_SESSION['icono'] = "error";
            header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
        }
    } else {
        // Las contraseñas no coinciden
        session_start();
        $_SESSION['mensaje'] = "Error: las contraseñas no coinciden";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
    }
} else {
    // Se proporciona una nueva contraseña, actualizar los datos del usuario y la contraseña
    if ($password_user == $password_repeat) {
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);

        $sentencia = $pdo->prepare("
            UPDATE tb_usuarios 
            SET nombres = :nombres,
                email = :email,
                id_rol = :id_rol,
                password_user = :password_user,
                fyh_actualizacion = :fyh_actualizacion 
            WHERE id_usuario = :id_usuario
        ");

        // Asignar valores a los parámetros de la consulta
        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $rol);
        $sentencia->bindParam(':password_user', $password_user);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario);

        // Ejecutar la sentencia SQL y redirigir en función del resultado
        if ($sentencia->execute()) {
            session_start();
            $_SESSION['mensaje'] = "Se actualizó al usuario correctamente";
            $_SESSION['icono'] = "success";
            header('Location: ' . $URL . '/usuarios');
        } else {
            session_start();
            $_SESSION['mensaje'] = "Error al actualizar al usuario";
            $_SESSION['icono'] = "error";
            header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
        }
    } else {
        // Las contraseñas no coinciden
        session_start();
        $_SESSION['mensaje'] = "Error: las contraseñas no coinciden";
        $_SESSION['icono'] = "error";
        header('Location: ' . $URL . '/usuarios/update.php?id=' . $id_usuario);
    }
}
?>

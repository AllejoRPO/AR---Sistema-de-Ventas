<?php

// Incluir archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Obtener datos del formulario
$nombres = $_POST['nombres'];
$email = $_POST['email'];
$id_rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];

// Verificar si las contraseñas coinciden
if ($password_user === $password_repeat) {
    // Hash de la contraseña para almacenamiento seguro
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar un nuevo usuario
    $sentencia = $pdo->prepare("
        INSERT INTO tb_usuarios 
            (nombres, email, id_rol, password_user, fyh_creacion)
        VALUES 
            (:nombres, :email, :id_rol, :password_user, :fyh_creacion)
    ");

    // Asignar valores a los parámetros de la consulta
    $sentencia->bindParam(':nombres', $nombres);
    $sentencia->bindParam(':email', $email);
    $sentencia->bindParam(':id_rol', $id_rol);
    $sentencia->bindParam(':password_user', $password_user);
    $sentencia->bindParam(':fyh_creacion', $fechaHora);

    // Ejecutar la sentencia SQL
    if ($sentencia->execute()) {
        // Iniciar sesión y redirigir en caso de éxito
        session_start();
        $_SESSION['mensaje'] = "Se registró al usuario correctamente";
        header('location: ' . $URL . '/usuarios');
    } else {
        // Mensaje de error si la ejecución falla
        session_start();
        $_SESSION['mensaje'] = "Error al registrar al usuario";
        header('location: ' . $URL . '/usuarios/create.php');
    }
} else {
    // Mensaje de error si las contraseñas no coinciden
    session_start();
    $_SESSION['mensaje'] = "Error: las contraseñas no coinciden";
    header('location: ' . $URL . '/usuarios/create.php');
}

?>

<?php

include ('../../config.php');

$nombres = $_POST['nombres'];
$email = $_POST['email'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
$id_usuario = $_POST['id_usuario'];
$rol = $_POST['rol'];

if ($password_user==""){
    if($password_user == $password_repeat){
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia= $pdo->prepare("UPDATE tb_usuarios 
    SET nombres=:nombres,
        email=:email,
        id_rol=:id_rol,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario=:id_usuario");

        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $rol);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario );
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizó al usuario correctamente";
        $_SESSION['icono'] = "success";
        header('location: '.$URL.'/usuarios');
    }else{
        //echo "Error las contraseñas no coinciden";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no coinciden";
        $_SESSION['icono'] = "error";
        header('location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }

}else{
    if($password_user == $password_repeat){
        $password_user = password_hash($password_user, PASSWORD_DEFAULT);
        $sentencia= $pdo->prepare("UPDATE tb_usuarios 
    SET nombres=:nombres,
        email=:email,
        id_rol=:id_rol,
        password_user=:password_user,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_usuario=:id_usuario");

        $sentencia->bindParam(':nombres', $nombres);
        $sentencia->bindParam(':email', $email);
        $sentencia->bindParam(':id_rol', $rol);
        $sentencia->bindParam(':password_user', $password_user);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_usuario', $id_usuario );
        $sentencia->execute();
        session_start();
        $_SESSION['mensaje'] = "Se actualizó al usuario correctamente";
        $_SESSION['icono'] = "success";
        header('location: '.$URL.'/usuarios');
    }else{
        //echo "Error las contraseñas no coinciden";
        session_start();
        $_SESSION['mensaje'] = "Error las contraseñas no coinciden";
        $_SESSION['icono'] = "error";
        header('location: '.$URL.'/usuarios/update.php?id='.$id_usuario);
    }
}


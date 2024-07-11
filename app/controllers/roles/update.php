<?php

include ('../../config.php');

$id_rol = $_POST['id_rol'];
$rol = $_POST['rol'];

        $sentencia= $pdo->prepare("UPDATE tb_roles 
    SET rol=:rol,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_rol = :id_rol");

        $sentencia->bindParam(':rol', $rol);
        $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
        $sentencia->bindParam(':id_rol', $id_rol );

        if($sentencia->execute()){
            session_start();
            $_SESSION['mensaje'] = "Se actualizó el rol correctamente";
            $_SESSION['icono'] = "success";
            header('location: '.$URL.'/roles');
        }else{
            session_start();
            $_SESSION['mensaje'] = "No se pudo actualizar el rol";
            $_SESSION['icono'] = "error";
            header('location: '.$URL.'/roles/update.php?id='.$id_rol);
        }







<?php

session_start();
if (isset($_SESSION['sesion_email'])) {
    //echo "Si esta logueada la cuenta ".$_SESSION['sesion_email'];
    $email_sesion = $_SESSION['sesion_email'];
    $sql= "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
FROM tb_usuarios as us INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol WHERE email='$email_sesion'";
    $query=$pdo->prepare($sql);
    $query->execute();
    $usuarios=$query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usuarios as $usuarios) {
        $nombres_sesion=$usuarios['nombres'];
        $rol_sesion=$usuarios['rol'];
    }
}else{
    echo "No esta logueada la cuenta ";
    header('location: '.$URL.'/login/login.php');
}


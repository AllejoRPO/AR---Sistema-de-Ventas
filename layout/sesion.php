<?php

// Iniciar la sesión
session_start();

// Verificar si la sesión está activa
if (isset($_SESSION['sesion_email'])) {
    // La cuenta está logueada
    $email_sesion = $_SESSION['sesion_email'];

    // Consulta SQL para obtener datos del usuario logueado
    $sql= "SELECT us.id_usuario as id_usuario, us.nombres as nombres, us.email as email, rol.rol as rol 
           FROM tb_usuarios as us 
           INNER JOIN tb_roles as rol ON us.id_rol = rol.id_rol 
           WHERE email='$email_sesion'";

    // Preparar y ejecutar la consulta
    $query = $pdo->prepare($sql);
    $query->execute();

    // Obtener los resultados de la consulta
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

    // Almacenar los datos del usuario en variables
    foreach ($usuarios as $usuario) {
        $id_usuario_sesion = $usuario['id_usuario'];
        $nombres_sesion = $usuario['nombres'];
        $rol_sesion = $usuario['rol'];
    }
} else {
    // La cuenta no está logueada, redirigir al login
    echo "No está logueada la cuenta ";
    header('location: '.$URL.'/login/login.php');
    exit();
}
?>

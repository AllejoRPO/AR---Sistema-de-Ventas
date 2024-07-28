<?php

// Incluir el archivo de configuración para establecer conexión con la base de datos
include ('../../config.php');

// Obtener los datos del formulario
$email = $_POST['email'];
$password_user = $_POST['password_user'];

// Inicializar el contador
$contador = 0;

// Consulta SQL para verificar si el email existe en la base de datos
$sql = "SELECT * FROM tb_usuarios WHERE email = :email";
$query = $pdo->prepare($sql);
$query->bindParam(':email', $email);
$query->execute();

// Obtener los datos de los usuarios
$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

// Recorrer los resultados para verificar las credenciales
foreach ($usuarios as $usuario) {
    $contador++;
    $email_tabla = $usuario['email'];
    $nombres = $usuario['nombres'];
    $password_user_table = $usuario['password_user'];
}

// Verificar si el email existe y la contraseña es correcta
if ($contador > 0 && password_verify($password_user, $password_user_table)) {
    // Datos correctos, iniciar sesión
    session_start();
    $_SESSION['sesion_email'] = $email;
    header('Location: '.$URL.'/index.php');
} else {
    // Datos incorrectos, redirigir al formulario de login con mensaje de error
    session_start();
    $_SESSION['mensaje'] = "Error: datos incorrectos, vuelva a intentarlo";
    header('Location: '.$URL.'/login/login.php');
}
?>

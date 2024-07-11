<?php

include ('../../config.php');

$email=$_POST['email'];
$password_user =$_POST ['password_user'];


$contador = 0;
$sql="SELECT * FROM tb_usuarios WHERE email = '$email' ";
$query=$pdo->prepare($sql);
$query->execute();
$usuarios=$query->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as $usuarios) {
    $contador = $contador + 1;
    $email_tabla = $usuarios['email'];
    $nombres = $usuarios['nombres'];
    $password_user_table = $usuarios['password_user'];
}

if( ($contador > 0) && (password_verify($password_user, $password_user_table)) ){
    echo "Los datos son correctos";
    session_start();
    $_SESSION['sesion_email']=$email;
    header('Location: '.$URL.'/index.php');
}else{
    echo "Datos incorrectos, vuelva a intertarlo";
    session_start();
    $_SESSION["mensaje"]="Error datos incorrectos, vuelva a intertarlo";
    header('location:'.$URL.'/login/login.php');
}
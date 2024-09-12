<?php

// Incluir el archivo de configuración.
include ('../../config.php');

// Obtener los datos del formulario
$nombre_cliente = $_POST['nombre_cliente'];
$nit_ci_cliente = $_POST['nit_ci_cliente'];
$celular_cliente = $_POST['celular_cliente'];
$email_cliente = $_POST['email_cliente'];


// Preparar la consulta SQL para insertar el cliente en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_clientes 
        (nombre_cliente, nit_ci_cliente, celular_cliente, email_cliente, fyh_creacion)
    VALUES (:nombre_cliente, :nit_ci_cliente, :celular_cliente, :email_cliente, :fyh_creacion)
");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':nit_ci_cliente', $nit_ci_cliente);
$sentencia->bindParam(':celular_cliente', $celular_cliente);
$sentencia->bindParam(':email_cliente', $email_cliente);
$sentencia->bindParam(':fyh_creacion', $fechaHora); // Fecha y hora de creación

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {

    ?>
    <script>
        // Redirigir a la página de ventas
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
} else {

    session_start();
    $_SESSION['mensaje'] = "Error: no se registró el cliente en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de creación de ventas con un mensaje de error
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>


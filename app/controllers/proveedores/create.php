<?php

// Incluir el archivo de configuración para establecer conexión con la base de datos.
include ("../../config.php");

// Obtener los datos del formulario a través de GET
$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];

// Preparar la sentencia SQL para insertar un nuevo proveedor en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_proveedores 
    (nombre_proveedor, celular, telefono, empresa, email, direccion, fyh_creacion)
    VALUES (:nombre_proveedor, :celular, :telefono, :empresa, :email, :direccion, :fyh_creacion)
");

// Asignar valores a los parámetros de la consulta
$sentencia->bindParam(':nombre_proveedor', $nombre_proveedor);
$sentencia->bindParam(':celular', $celular);
$sentencia->bindParam(':telefono', $telefono);
$sentencia->bindParam(':empresa', $empresa);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':direccion', $direccion);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el proveedor correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        // Redirigir a la página de proveedores con un mensaje de éxito
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se registró el proveedor en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de proveedores con un mensaje de error
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
}
?>

<?php

// Incluir archivo de configuración para establecer conexión con la base de datos
include ("../../config.php");

// Obtener datos del formulario
$id_proveedor = $_GET['id_proveedor'];
$nombre_proveedor = $_GET['nombre_proveedor'];
$celular = $_GET['celular'];
$telefono = $_GET['telefono'];
$empresa = $_GET['empresa'];
$email = $_GET['email'];
$direccion = $_GET['direccion'];

// Preparar la sentencia SQL para actualizar el proveedor en la base de datos
$sentencia = $pdo->prepare("
    UPDATE tb_proveedores 
    SET nombre_proveedor = :nombre_proveedor,
        celular = :celular,
        telefono = :telefono,
        empresa = :empresa,
        email = :email,
        direccion = :direccion,
        fyh_actualizacion = :fyh_actualizacion 
    WHERE id_proveedor = :id_proveedor
");

// Asignar valores a los parámetros de la consulta
$sentencia->bindParam(':nombre_proveedor', $nombre_proveedor);
$sentencia->bindParam(':celular', $celular);
$sentencia->bindParam(':telefono', $telefono);
$sentencia->bindParam(':empresa', $empresa);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':direccion', $direccion);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_proveedor', $id_proveedor);

// Ejecutar la sentencia SQL y redirigir en función del resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el proveedor correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error no se actualizó el proveedor en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
}

?>
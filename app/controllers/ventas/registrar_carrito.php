<?php

// Incluir el archivo de configuración
include ('../../config.php');

// Obtener los datos del formulario
$nro_venta = $_GET['nro_venta'];
$id_producto = $_GET['id_producto'];
$cantidad = $_GET['cantidad'];

// Preparar la consulta SQL para insertar el producto en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_carrito 
        (nro_venta, id_producto, cantidad, fyh_creacion)
    VALUES (:nro_venta, :id_producto, :cantidad, :fyh_creacion)
");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':nro_venta', $nro_venta);
$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':fyh_creacion', $fechaHora); // Fecha y hora de creación

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {

    ?>
    <script>
        // Redirigir a la página de creación de ventas
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
} else {

    session_start();
    $_SESSION['mensaje'] = "Error: no se registró la venta en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de creación de ventas con un mensaje de error
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>


<?php

// Incluir el archivo de configuración
include ('../../config.php');

// Obtener los datos del formulario
$id_producto = $_GET['id_producto'];
$nro_compra = $_GET['nro_compra'];
$fecha_compra = $_GET['fecha_compra'];
$id_proveedor = $_GET['id_proveedor'];
$comprobante = $_GET['comprobante'];
$id_usuario = $_GET['id_usuario'];
$precio_compra = $_GET['precio_compra'];
$cantidad_compra = $_GET['cantidad_compra'];
$stock_total = $_GET['stock_total'];

$pdo->beginTransaction();

// Preparar la consulta SQL para insertar el producto en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_compras 
        (id_producto, nro_compra, fecha_compra, id_proveedor, comprobante, id_usuario, precio_compra, cantidad, fyh_creacion)
    VALUES (:id_producto, :nro_compra, :fecha_compra, :id_proveedor, :comprobante, :id_usuario, :precio_compra, :cantidad, :fyh_creacion)
");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':id_producto', $id_producto);
$sentencia->bindParam(':nro_compra', $nro_compra);
$sentencia->bindParam(':fecha_compra', $fecha_compra);
$sentencia->bindParam(':id_proveedor', $id_proveedor);
$sentencia->bindParam(':comprobante', $comprobante);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':cantidad', $cantidad_compra);
$sentencia->bindParam(':fyh_creacion', $fechaHora); // Fecha y hora de creación

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {

    // Preparar la sentencia SQL para actualizar el stock en la base de datos
    $sentencia = $pdo->prepare("
    UPDATE tb_almacen
    SET stock = :stock
    WHERE id_producto = :id_producto
    ");

    // Asignar valores a los parámetros de la consulta
    $sentencia->bindParam(':stock', $stock_total);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Se registró la compra correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        // Redirigir a la página de compras con un mensaje de éxito
        location.href = "<?php echo $URL; ?>/compras";
    </script>
    <?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error: no se registró la compra en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de creación de compras con un mensaje de error
        location.href = "<?php echo $URL; ?>/compras/create.php";
    </script>
    <?php
}
?>


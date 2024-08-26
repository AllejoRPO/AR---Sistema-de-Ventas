<?php
// Incluir el archivo de configuración
include ('../../config.php');

$id_compra = $_GET['id_compra'];
$id_producto = $_GET['id_producto'];
$cantidad_compra = $_GET['cantidad_compra'];
$stock_actual = $_GET['stock_actual'];

//echo $id_compra." - ".$id_producto." - ".$cantidad_compra." - ".$stock_actual;

$pdo->beginTransaction();

// Preparar la consulta SQL para insertar el producto en la base de datos
$sentencia = $pdo->prepare("DELETE FROM tb_compras WHERE id_compra = :id_compra");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':id_compra', $id_compra);

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {

    // Preparar la sentencia SQL para actualizar el stock en la base de datos
    $stock_nuevo = $stock_actual - $cantidad_compra;
    $sentencia = $pdo->prepare("UPDATE tb_almacen SET stock = :stock WHERE id_producto = :id_producto");

    // Asignar valores a los parámetros de la consulta
    $sentencia->bindParam(':stock', $stock_nuevo);
    $sentencia->bindParam(':id_producto', $id_producto);
    $sentencia->execute();

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Se eliminó la compra correctamente";
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
    $_SESSION['mensaje'] = "Error: no se elimino la compra en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de creación de compras con un mensaje de error
        location.href = "<?php echo $URL; ?>/compras";
    </script>
    <?php
}
?>
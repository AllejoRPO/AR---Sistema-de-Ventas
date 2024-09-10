<?php

// Incluir el archivo de configuración
include ('../../config.php');

$id_venta = $_GET['id_venta'];
$nro_venta = $_GET['nro_venta'];

$pdo->beginTransaction();

// Preparar la consulta SQL para eliminar la venta en la base de datos
$sentencia = $pdo->prepare("DELETE FROM tb_ventas WHERE id_venta = :id_venta");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':id_venta', $id_venta);

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {

    // Preparar la consulta SQL para eliminar el carrito en la base de datos
    $sentencia2 = $pdo->prepare("DELETE FROM tb_carrito WHERE nro_venta = :nro_venta");

    // Enlazar los parámetros a la consulta
    $sentencia2->bindParam(':nro_venta', $nro_venta);

    // Ejecutar la consulta e informar al usuario sobre el resultado
    $sentencia2->execute();

    $pdo->commit();

    // Iniciar sesión y guardar el mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Venta eliminada correctamente";
    $_SESSION['icono'] = "success";

    ?>
    <script>
        // Redirigir a la página de ventas
        location.href = "<?php echo $URL; ?>/ventas";
    </script>
    <?php

} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error: no se eliminó la venta en la base de datos";
    $_SESSION['icono'] = "error";

    ?>
    <script>
        // Redirigir a la página de creación de compras con un mensaje de error
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>

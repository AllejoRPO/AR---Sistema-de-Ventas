<?php
// Incluir el archivo de configuración
include ('../../config.php');

$id_carrito = $_POST['id_carrito'];

// Preparar la consulta SQL para eliminar la venta en la base de datos
$sentencia = $pdo->prepare("DELETE FROM tb_carrito WHERE id_carrito = :id_carrito");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':id_carrito', $id_carrito);

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
    $_SESSION['mensaje'] = "Error: no se elimino la venta en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de creación de compras con un mensaje de error
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>
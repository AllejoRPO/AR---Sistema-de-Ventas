<?php

// Incluir el archivo de configuración.
include ('../../config.php');

// Obtener el ID del producto a eliminar desde el formulario
$id_proveedor = $_GET['id_proveedor'];

// Preparar la consulta SQL para eliminar el producto
$sentencia = $pdo->prepare("DELETE FROM tb_proveedores WHERE id_proveedor = :id_proveedor");

// Enlazar el parámetro :id_producto a la consulta
$sentencia->bindParam(':id_proveedor', $id_proveedor);

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se elimino el proveedor correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        // Redirigir a la página de proveedores con un mensaje de éxito
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se elimino el proveedor en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de proveedores con un mensaje de error
        location.href = "<?php echo $URL; ?>/proveedores";
    </script>
    <?php
}
?>


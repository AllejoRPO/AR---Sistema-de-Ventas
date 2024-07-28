<?php

// Incluir el archivo de configuración
include ('../../config.php');

// Obtener el ID del producto a eliminar desde el formulario
$id_producto = $_POST['id_producto'];

// Preparar la consulta SQL para eliminar el producto
$sentencia = $pdo->prepare("DELETE FROM `tb_almacen` WHERE id_producto = :id_producto");

// Enlazar el parámetro :id_producto a la consulta
$sentencia->bindParam(':id_producto', $id_producto);

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {
    // Si la eliminación es exitosa, iniciar una sesión y establecer un mensaje de éxito
    session_start();
    $_SESSION['mensaje'] = "Se eliminó el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/almacen'); // Redirigir a la página de almacenamiento
} else {
    // Si ocurre un error, iniciar una sesión y establecer un mensaje de error
    session_start();
    $_SESSION['mensaje'] = "No se pudo eliminar el producto";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . '/almacen/delete.php?id=' . $id_producto); // Redirigir a la página de eliminación
}

?>

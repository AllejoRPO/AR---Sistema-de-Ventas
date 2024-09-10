<?php

// Incluir el archivo de configuración
include ('../../config.php');

// Obtener los datos del formulario
$id_producto = $_GET['id_producto'];
$stock_calculado = $_GET['stock_calculado'];

// Preparar la consulta SQL para actualizar el stock según venta en la base de datos
$sentencia = $pdo->prepare("UPDATE tb_almacen SET stock = :stock WHERE id_producto = :id_producto");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':stock', $stock_calculado);
$sentencia->bindParam(':id_producto', $id_producto);

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {
    echo "se actualizaron correctamente";
} else {
    echo "no se actualizaron correctamente";
}



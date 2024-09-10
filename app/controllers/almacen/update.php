<?php

// Incluir archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Obtener datos del formulario
$codigo = $_POST['codigo'];
$id_categoria = $_POST['id_categoria'];
$nombre = $_POST['nombre'];
$id_usuario = $_POST['id_usuario'];
$descripcion = $_POST['descripcion'];
$stock = $_POST['stock'];
$stock_minimo = $_POST['stock_minimo'];
$stock_maximo = $_POST['stock_maximo'];
$precio_compra = $_POST['precio_compra'];
$precio_venta = $_POST['precio_venta'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$id_producto = $_POST['id_producto'];
$image_text = $_POST['image_text'];

// Verificar si se ha subido una nueva imagen
if ($_FILES['image']['name'] != null) {
    // Generar nombre único para el archivo de imagen
    $nombreDelArchivo = date("Y-m-d-H-i-s");
    $image_text = $nombreDelArchivo . "__" . $_FILES['image']['name'];
    $location = "../../../almacen/img_productos/" . $image_text;

    // Mover archivo de imagen a la ubicación deseada
    move_uploaded_file($_FILES['image']['tmp_name'], $location);
} else {
    // No se ha subido una nueva imagen
}

// Preparar la sentencia SQL para actualizar el producto en la base de datos
$sentencia = $pdo->prepare("
    UPDATE tb_almacen 
    SET nombre = :nombre,
        descripcion = :descripcion,
        stock = :stock,
        stock_minimo = :stock_minimo,
        stock_maximo = :stock_maximo,
        precio_compra = :precio_compra,
        precio_venta = :precio_venta,
        fecha_ingreso = :fecha_ingreso,
        imagen = :imagen,
        id_usuario = :id_usuario,
        id_categoria = :id_categoria,
        fyh_actualizacion = :fyh_actualizacion 
    WHERE id_producto = :id_producto
");

// Asignar valores a los parámetros de la consulta
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':imagen', $image_text);
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':id_categoria', $id_categoria);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_producto', $id_producto);

// Ejecutar la sentencia SQL y redirigir en función del resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se actualizó el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/almacen');
} else {
    session_start();
    $_SESSION['mensaje'] = "No se pudo actualizar el producto";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . '/almacen/update.php?id=' . $id_producto);
}
?>

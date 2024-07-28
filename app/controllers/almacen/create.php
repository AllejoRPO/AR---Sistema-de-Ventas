<?php

// Incluir el archivo de configuración
include ('../../config.php');

// Obtener los datos del formulario
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

// Procesar la imagen
$image = $_FILES['image'];
$nombreDelArchivo = date("Y-m-d-H-i-s"); // Generar un nombre único para el archivo
$filename = $nombreDelArchivo . "__" . $image['name']; // Nombre completo del archivo
$location = "../../../almacen/img_productos/" . $filename; // Ruta de destino

// Mover el archivo subido al directorio de destino
move_uploaded_file($image['tmp_name'], $location);

// Preparar la consulta SQL para insertar el producto en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_almacen 
        (codigo, nombre, descripcion, stock, stock_minimo, stock_maximo, precio_compra, precio_venta, fecha_ingreso, imagen, id_usuario, id_categoria, fyh_creacion)
    VALUES (:codigo, :nombre, :descripcion, :stock, :stock_minimo, :stock_maximo, :precio_compra, :precio_venta, :fecha_ingreso, :imagen, :id_usuario, :id_categoria, :fyh_creacion)
");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':codigo', $codigo);
$sentencia->bindParam(':nombre', $nombre);
$sentencia->bindParam(':descripcion', $descripcion);
$sentencia->bindParam(':stock', $stock);
$sentencia->bindParam(':stock_minimo', $stock_minimo);
$sentencia->bindParam(':stock_maximo', $stock_maximo);
$sentencia->bindParam(':precio_compra', $precio_compra);
$sentencia->bindParam(':precio_venta', $precio_venta);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':imagen', $filename); // Nombre del archivo de imagen
$sentencia->bindParam(':id_usuario', $id_usuario);
$sentencia->bindParam(':id_categoria', $id_categoria);
$sentencia->bindParam(':fyh_creacion', $fechaHora); // Fecha y hora de creación

// Ejecutar la consulta y manejar el resultado
if ($sentencia->execute()) {
    session_start();
    $_SESSION['mensaje'] = "Se registró el producto correctamente";
    $_SESSION['icono'] = "success";
    header('location: ' . $URL . '/almacen');
} else {
    session_start();
    $_SESSION['mensaje'] = "Error: no se registró el producto en la base de datos";
    $_SESSION['icono'] = "error";
    header('location: ' . $URL . '/almacen/create.php');
}

?>

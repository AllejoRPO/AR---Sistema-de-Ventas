<?php

// Obtener el identificador del producto desde la URL
$id_producto_get = $_GET['id'];

// Consulta SQL para obtener los detalles del producto
$sql_productos = "
    SELECT *, 
           cat.nombre_categoria AS categoria, 
           u.email AS email, 
           u.id_usuario AS id_usuario
    FROM tb_almacen AS a 
    INNER JOIN tb_categorias AS cat ON a.id_categoria = cat.id_categoria
    INNER JOIN tb_usuarios AS u ON u.id_usuario = a.id_usuario 
    WHERE id_producto = :id_producto
";

// Preparar y ejecutar la consulta
$query_productos = $pdo->prepare($sql_productos);
$query_productos->bindParam(':id_producto', $id_producto_get, PDO::PARAM_INT); // Evita inyecciones SQL
$query_productos->execute();

// Obtener todos los resultados como un arreglo asociativo
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);

// Extraer los datos del producto
foreach ($productos_datos as $productos_dato) {
    $codigo = $productos_dato['codigo'];                 // Código del producto
    $nombre_categoria = $productos_dato['nombre_categoria']; // Nombre de la categoría del producto
    $nombre = $productos_dato['nombre'];                  // Nombre del producto
    $email = $productos_dato['email'];                    // Email del usuario asociado
    $id_usuario = $productos_dato['id_usuario'];           // ID del usuario asociado
    $descripcion = $productos_dato['descripcion'];        // Descripción del producto
    $stock = $productos_dato['stock'];                    // Stock actual del producto
    $stock_minimo = $productos_dato['stock_minimo'];      // Stock mínimo del producto
    $stock_maximo = $productos_dato['stock_maximo'];      // Stock máximo del producto
    $precio_compra = $productos_dato['precio_compra'];    // Precio de compra del producto
    $precio_venta = $productos_dato['precio_venta'];      // Precio de venta del producto
    $fecha_ingreso = $productos_dato['fecha_ingreso'];    // Fecha de ingreso del producto
    $imagen = $productos_dato['imagen'];                  // Imagen del producto
}
?>

<?php

// Preparar la consulta SQL para obtener todos los productos con información adicional
$sql_productos = "
    SELECT *, 
           cat.nombre_categoria AS categoria, 
           u.email AS email
    FROM tb_almacen AS a 
    INNER JOIN tb_categorias AS cat ON a.id_categoria = cat.id_categoria
    INNER JOIN tb_usuarios AS u ON u.id_usuario = a.id_usuario
";

// Preparar la consulta SQL utilizando PDO
$query_productos = $pdo->prepare($sql_productos);

// Ejecutar la consulta
$query_productos->execute();

// Obtener todos los resultados en forma de array asociativo
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);

?>

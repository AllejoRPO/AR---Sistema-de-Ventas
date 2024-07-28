<?php

// Preparar la consulta SQL para obtener todas las categorías
$sql_categorias = "SELECT * FROM tb_categorias";

// Preparar la consulta SQL utilizando PDO
$query_categorias = $pdo->prepare($sql_categorias);

// Ejecutar la consulta SQL
$query_categorias->execute();

// Obtener los datos de las categorías en formato de array asociativo
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);

?>

<?php

// Preparar la consulta SQL para obtener todoas las ventas con información adicional
$sql_ventas = "SELECT * FROM tb_ventas";

// Preparar la consulta SQL utilizando PDO
$query_ventas = $pdo->prepare($sql_ventas);

// Ejecutar la consulta
$query_ventas->execute();

// Obtener todos los resultados en forma de array asociativo
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);

?>
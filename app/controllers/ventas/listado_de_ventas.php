<?php

// Preparar la consulta SQL para obtener todoas los clientes con información adicional
$sql_ventas = "SELECT *, cli.nombre_cliente = nombre_cliente 
               FROM tb_ventas as ve INNER JOIN tb_clientes as cli ON cli.id_cliente = ve.id_cliente";

// Preparar la consulta SQL utilizando PDO
$query_ventas = $pdo->prepare($sql_ventas);

// Ejecutar la consulta
$query_ventas->execute();

// Obtener todos los resultados en forma de array asociativo
$ventas_datos = $query_ventas->fetchAll(PDO::FETCH_ASSOC);

?>
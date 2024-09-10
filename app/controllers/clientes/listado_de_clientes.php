<?php

// Preparar la consulta SQL para obtener todoas las ventas con información adicional.
$sql_clientes = "SELECT * FROM tb_clientes";

// Preparar la consulta SQL utilizando PDO
$query_clientes = $pdo->prepare($sql_clientes);

// Ejecutar la consulta
$query_clientes->execute();

// Obtener todos los resultados en forma de array asociativo
$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);

?>

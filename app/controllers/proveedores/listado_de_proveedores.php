<?php

// Preparar la consulta SQL para obtener todos los proveedores
$sql_proveedores = "SELECT * FROM tb_proveedores";

// Preparar y ejecutar la consulta
$query_proveedores = $pdo->prepare($sql_proveedores);
$query_proveedores->execute();

// Obtener todos los datos de los proveedores en un array asociativo
$proveedores_datos = $query_proveedores->fetchAll(PDO::FETCH_ASSOC);

?>

<?php

// Preparar la consulta SQL para obtener todos los roles de la base de datos
$sql_roles = "SELECT * FROM tb_roles";

// Preparar y ejecutar la consulta
$query_roles = $pdo->prepare($sql_roles);
$query_roles->execute();

// Obtener todos los datos de los roles en un array asociativo
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

?>

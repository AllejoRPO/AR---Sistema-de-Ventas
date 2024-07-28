<?php

// Obtener el ID del rol desde la URL
$id_rol_get = $_GET['id'];

// Preparar la consulta SQL para seleccionar el rol específico
$sql_roles = "SELECT * FROM tb_roles WHERE id_rol = :id_rol";
$query_roles = $pdo->prepare($sql_roles);

// Asignar el valor del ID del rol al parámetro de la consulta
$query_roles->bindParam(':id_rol', $id_rol_get, PDO::PARAM_INT);

// Ejecutar la consulta
$query_roles->execute();

// Obtener los datos del rol
$roles_datos = $query_roles->fetchAll(PDO::FETCH_ASSOC);

// Asignar los valores del rol a variables
foreach ($roles_datos as $roles_dato) {
    $rol = $roles_dato['rol'];
}

?>

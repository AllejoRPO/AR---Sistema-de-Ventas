<?php

// Preparar la consulta SQL para obtener datos de usuarios y sus roles
$sql_usuarios = "
    SELECT 
        us.id_usuario AS id_usuario, 
        us.nombres AS nombres, 
        us.email AS email, 
        rol.rol AS rol
    FROM tb_usuarios AS us
    INNER JOIN tb_roles AS rol ON us.id_rol = rol.id_rol
";

// Preparar la sentencia SQL
$query_usuarios = $pdo->prepare($sql_usuarios);

// Ejecutar la sentencia SQL
$query_usuarios->execute();

// Obtener todos los resultados en un array asociativo
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

?>

<?php

// Obtener el ID del usuario desde la URL.
$id_usuario_get = $_GET['id'];

// Preparar la consulta SQL para obtener los detalles del usuario y su rol
$sql_usuarios = "
    SELECT us.id_usuario AS id_usuario, 
           us.nombres AS nombres, 
           us.email AS email, 
           rol.rol AS rol 
    FROM tb_usuarios AS us 
    INNER JOIN tb_roles AS rol ON us.id_rol = rol.id_rol 
    WHERE us.id_usuario = :id_usuario
";

// Preparar la sentencia SQL
$query_usuarios = $pdo->prepare($sql_usuarios);

// Enlazar el parámetro del ID del usuario para evitar inyecciones SQL
$query_usuarios->bindParam(':id_usuario', $id_usuario_get, PDO::PARAM_INT);

// Ejecutar la consulta SQL
$query_usuarios->execute();

// Obtener todos los resultados de la consulta
$usuarios_datos = $query_usuarios->fetchAll(PDO::FETCH_ASSOC);

// Extraer los datos del usuario de los resultados
foreach ($usuarios_datos as $usuarios_dato) {
    $nombres = $usuarios_dato['nombres'];
    $email = $usuarios_dato['email'];
    $rol = $usuarios_dato['rol'];
}

?>

<?php

// Incluir el archivo de configuración para establecer conexión con la base de datos
include ("../../config.php");

// Obtener el nombre de la categoría desde la solicitud GET
$nombre_categoria = $_GET['nombre_categoria'];

// Preparar la sentencia SQL para insertar una nueva categoría en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_categorias 
    (nombre_categoria, fyh_creacion)
    VALUES (:nombre_categoria, :fyh_creacion)
");

// Asignar los valores a los parámetros de la sentencia SQL
$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_creacion', $fechaHora);

// Ejecutar la sentencia SQL e implementar redirección y mensaje de éxito o error
if ($sentencia->execute()) {
    // Iniciar la sesión para establecer variables de sesión
    session_start();
    $_SESSION['mensaje'] = "Se registró la categoría correctamente";
    $_SESSION['icono'] = "success";

    // Redirigir al usuario a la página de categorías utilizando JavaScript
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
} else {
    // Iniciar la sesión para establecer variables de sesión en caso de error
    session_start();
    $_SESSION['mensaje'] = "Error, no se registró la categoría en la base de datos";
    $_SESSION['icono'] = "error";

    // Redirigir al usuario a la página de categorías utilizando JavaScript
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}
?>

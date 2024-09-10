<?php

// Incluir el archivo de configuración para establecer conexión con la base de datos.
include ('../../config.php');

// Obtener el nombre de la categoría y el ID de la categoría desde la solicitud GET
$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];

// Preparar la sentencia SQL para actualizar una categoría en la base de datos
$sentencia = $pdo->prepare("
    UPDATE tb_categorias 
    SET nombre_categoria = :nombre_categoria,
        fyh_actualizacion = :fyh_actualizacion 
    WHERE id_categoria = :id_categoria
");

// Asignar los valores a los parámetros de la sentencia SQL
$sentencia->bindParam(':nombre_categoria', $nombre_categoria);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_categoria', $id_categoria);

// Ejecutar la sentencia SQL e implementar redirección y mensaje de éxito o error
if ($sentencia->execute()) {
    // Iniciar la sesión para establecer variables de sesión
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la categoría correctamente";
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
    $_SESSION['mensaje'] = "No se pudo actualizar la categoría";
    $_SESSION['icono'] = "error";

    // Redirigir al usuario a la página de categorías utilizando JavaScript
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}
?>

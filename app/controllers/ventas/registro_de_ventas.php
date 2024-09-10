<?php

// Incluir el archivo de configuración
include ('../../config.php');

// Obtener los datos del formulario
$nro_venta = $_GET['nro_venta'];
$id_cliente = $_GET['id_cliente'];
$total_a_cancelar = $_GET['total_a_cancelar'];

$pdo->beginTransaction();

// Preparar la consulta SQL para insertar el producto en la base de datos
$sentencia = $pdo->prepare("
    INSERT INTO tb_ventas 
        (nro_venta, id_cliente, total_pagado, fyh_creacion)
    VALUES (:nro_venta, :id_cliente, :total_pagado, :fyh_creacion)
");

// Enlazar los parámetros a la consulta
$sentencia->bindParam(':nro_venta', $nro_venta);
$sentencia->bindParam(':id_cliente', $id_cliente);
$sentencia->bindParam(':total_pagado', $total_a_cancelar);
$sentencia->bindParam(':fyh_creacion', $fechaHora); // Fecha y hora de creación

// Ejecutar la consulta e informar al usuario sobre el resultado
if ($sentencia->execute()) {

    $pdo->commit();

    session_start();
    $_SESSION['mensaje'] = "Se registró la venta correctamente";
    $_SESSION['icono'] = "success";
    ?>
    <script>
        // Redirigir a la página de compras con un mensaje de éxito
        location.href = "<?php echo $URL; ?>/ventas";
    </script>
    <?php
} else {

    $pdo->rollBack();

    session_start();
    $_SESSION['mensaje'] = "Error: no se registró la venta en la base de datos";
    $_SESSION['icono'] = "error";
    ?>
    <script>
        // Redirigir a la página de creación de compras con un mensaje de error
        location.href = "<?php echo $URL; ?>/ventas/create.php";
    </script>
    <?php
}
?>



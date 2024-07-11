<?php

include ('../../config.php');

$nombre_categoria = $_GET['nombre_categoria'];
$id_categoria = $_GET['id_categoria'];

$sentencia= $pdo->prepare("UPDATE tb_categorias 
    SET nombre_categoria=:nombre_categoria,
        fyh_actualizacion=:fyh_actualizacion 
    WHERE id_categoria = :id_categoria");

$sentencia->bindParam('nombre_categoria', $nombre_categoria);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_categoria', $id_categoria);

if($sentencia->execute()){
    session_start();
    $_SESSION['mensaje'] = "Se actualizó la categoría correctamente";
    $_SESSION['icono'] = "success";
    //header('location: '.$URL.'/roles');
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}else{
    session_start();
    $_SESSION['mensaje'] = "No se pudo actualizar la categoría";
    $_SESSION['icono'] = "error";
    //header('location: '.$URL.'/roles/update.php?id='.$id_rol);
    ?>
    <script>
        location.href = "<?php echo $URL;?>/categorias";
    </script>
    <?php
}

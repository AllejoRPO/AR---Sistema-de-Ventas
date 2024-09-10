<?php
// Verifica si hay un mensaje y un ícono en la sesión.
if (isset($_SESSION['mensaje']) && isset($_SESSION['icono'])) {
    // Asigna el mensaje y el ícono de la sesión a variables locales
    $respuesta = $_SESSION['mensaje'];
    $icono = $_SESSION['icono'];
    ?>
    <script>
        // Muestra una alerta con SweetAlert2
        Swal.fire({
            position: "top-end",            // Posición de la alerta
            icon: "<?php echo $icono; ?>",   // Tipo de ícono (por ejemplo, "error", "success")
            title: "<?php echo $respuesta; ?>", // Mensaje de la alerta
            showConfirmButton: false,       // No muestra el botón de confirmación
            timer: 2500                     // Duración de la alerta en milisegundos
        });
    </script>
    <?php
    // Limpia los datos de la sesión después de mostrarlos
    unset($_SESSION['mensaje']);
    unset($_SESSION['icono']);
}
?>

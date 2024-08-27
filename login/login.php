<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Ventas</title>

    <!-- Incluye la fuente de Google: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Incluye Font Awesome -->
    <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <!-- Incluye icheck bootstrap -->
    <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Incluye el estilo del tema AdminLTE -->
    <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Incluye la librería SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition login-page">
    <!-- Inicio del bloque de caja de inicio de sesión -->
    <div class="login-box">
        
        <!-- Inicio del bloque de verificación de sesión para mensajes -->
        <?php
        session_start();
        if (isset($_SESSION["mensaje"])) {
            $respuesta = $_SESSION["mensaje"]; ?>
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "error",
                    title: "<?php echo $respuesta; ?>",
                    showConfirmButton: false,
                    timer: 2000
                });
            </script>
            <?php
            // Elimina el mensaje de la sesión después de mostrarlo
            unset($_SESSION['mensaje']);
        }
        ?>
        <!-- Fin del bloque de verificación de sesión para mensajes -->

        <!-- Inicio del bloque de imagen del logo -->
        <center>
            <img src="https://png.pngtree.com/png-vector/20230108/ourmid/pngtree-ar-logo-design-free-vector-and-image-transparent-background-png-image_6554220.png" width="200px" alt="Logo">
        </center>
        <!-- Fin del bloque de imagen del logo -->

        <!-- Inicio del bloque de tarjeta de inicio de sesión -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../login/login.php" class="h1"><b>Sistema de</b> VENTAS</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Ingrese su información</p>

                <!-- Inicio del bloque de formulario de inicio de sesión -->
                <form action="../app/controllers/login/ingreso.php" method="post">
                    
                    <!-- Inicio del bloque de campo de correo electrónico -->
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del bloque de campo de correo electrónico -->

                    <!-- Inicio del bloque de campo de contraseña -->
                    <div class="input-group mb-3">
                        <input type="password" name="password_user" class="form-control" placeholder="Contraseña" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <!-- Fin del bloque de campo de contraseña -->

                    <hr>

                    <!-- Inicio del bloque de botón para iniciar sesión -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </div>
                    <!-- Fin del bloque de botón para iniciar sesión -->
                    
                </form>
                <!-- Fin del bloque de formulario de inicio de sesión -->

            </div>
            <!-- Fin del bloque del cuerpo de la tarjeta -->
        </div>
        <!-- Fin del bloque de tarjeta de inicio de sesión -->

    </div>
    <!-- Fin del bloque de caja de inicio de sesión -->

    <!-- Inicio del bloque de inclusión de scripts -->
    <!-- Incluye jQuery -->
    <script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

    <!-- Incluye Bootstrap 4 -->
    <script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Incluye la aplicación AdminLTE -->
    <script src="../public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
    <!-- Fin del bloque de inclusión de scripts -->

</body>
</html>

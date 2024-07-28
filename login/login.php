<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Ventas</title>

    <!-- Fuente de Google: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Estilo del tema -->
    <link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Librería SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="hold-transition login-page">

<!-- Caja de inicio de sesión -->
<div class="login-box">
    <!-- Verificación de sesión para mensajes -->
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
        unset($_SESSION['mensaje']);
    }
    ?>

    <!-- Imagen del logo -->
    <center>
        <img src="https://png.pngtree.com/png-vector/20230108/ourmid/pngtree-ar-logo-design-free-vector-and-image-transparent-background-png-image_6554220.png" width="200px" alt="Logo">
    </center>

    <!-- Tarjeta de inicio de sesión -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../login/login.php" class="h1"><b>Sistema de</b> VENTAS</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Ingrese su información</p>

            <!-- Formulario de inicio de sesión -->
            <form action="../app/controllers/login/ingreso.php" method="post">
                <!-- Campo de correo electrónico -->
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Correo electrónico" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>

                <!-- Campo de contraseña -->
                <div class="input-group mb-3">
                    <input type="password" name="password_user" class="form-control" placeholder="Contraseña" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Botón para iniciar sesión -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                </div>
            </form>

        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Aplicación AdminLTE -->
<script src="../public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

</body>
</html>

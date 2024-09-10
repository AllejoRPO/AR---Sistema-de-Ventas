<?php

// Incluir el archivo de configuración.
include ('../app/config.php');
// Fin del bloque de configuración

// Incluir el archivo de sesión
include ('../layout/sesion.php');
// Fin del bloque de sesión

// Incluir la primera parte del layout
include ('../layout/parte1.php');
// Fin del bloque de layout parte1

// Incluir el archivo que maneja la actualización de roles
include ('../app/controllers/roles/update_roles.php');
// Fin del bloque de actualización de roles

// Verificar si hay un mensaje en la sesión
if (isset($_SESSION["mensaje"])) {
    $respuesta = $_SESSION["mensaje"]; ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "<?php echo $respuesta; ?>",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    // Limpiar los mensajes de la sesión después de mostrarlos
    unset($_SESSION["mensaje"]);
    unset($_SESSION["icono"]);
}
// Fin del bloque de mensaje de sesión

?>

<!-- Content Wrapper. Contiene el contenido de la página -->
<div class="content-wrapper">
    <!-- Content Header (Encabezado de la página) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Edición de un rol</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content (Contenido principal) -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Edité la información del rol</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="../app/controllers/roles/update.php" method="post">
                                        <!-- Campo oculto para el ID del rol -->
                                        <div class="form-group">
                                            <input type="text" name="id_rol" value="<?php echo $id_rol_get; ?>" hidden>
                                            <label for="">Nombre del rol</label>
                                            <input type="text" name="rol" class="form-control"
                                                   placeholder="Escriba el nuevo rol..." value="<?php echo $rol;?>" required>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Incluir la segunda parte del layout -->
<?php include ('../layout/parte2.php'); ?>
<!-- Fin del bloque de layout parte2 -->

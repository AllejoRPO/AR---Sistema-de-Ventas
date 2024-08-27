<?php

// Incluir el archivo de configuración
include ('../app/config.php');
// Fin del bloque de configuración

// Incluir el archivo de sesión
include ('../layout/sesion.php');
// Fin del bloque de sesión

// Incluir la primera parte del layout
include ('../layout/parte1.php');
// Fin del bloque de layout parte1

// Incluir el listado de roles
include ('../app/controllers/roles/listado_de_roles.php');
// Fin del bloque de listado de roles

// Mostrar mensaje de sesión si existe
if (isset($_SESSION["mensaje"])) {
    $respuesta = $_SESSION["mensaje"]; ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "error",
            title: "<?php echo $respuesta;?>",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    // Eliminar los mensajes de sesión después de mostrarlos
    unset($_SESSION["mensaje"]);
    unset($_SESSION["icono"]);
}
// Fin del bloque de mensaje de sesión

?>

<!-- Contenedor de contenido. Contiene el contenido de la página -->
<div class="content-wrapper">
    <!-- Encabezado de contenido (Encabezado de la página) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de un nuevo usuario</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Contenido principal -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Registre la información del nuevo usuario</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Formulario para crear un nuevo usuario -->
                                    <form action="../app/controllers/usuarios/create.php" method="post">
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" placeholder="Escriba el nombre del nuevo usuario..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Escriba el email del nuevo usuario..." required>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rol del usuario</label>
                                            <select name="rol" id="" class="form-control">
                                                <?php
                                                // Listar los roles disponibles
                                                foreach ($roles_datos as $roles_dato){; ?>
                                                    <option value="<?php echo $roles_dato['id_rol'] ?>"><?php echo $roles_dato['rol'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="text" name="password_user" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Repita la contraseña</label>
                                            <input type="text" name="password_repeat" class="form-control">
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                    <!-- Fin del formulario para crear un nuevo usuario -->
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

<?php
// Incluir la segunda parte del layout
include ('../layout/parte2.php');
// Fin del bloque de layout parte2
?>

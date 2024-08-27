<?php

// Incluir el archivo de configuración
include ('../app/config.php');

// Incluir el archivo de sesión
include ('../layout/sesion.php');

// Incluir la primera parte del layout
include ('../layout/parte1.php');

// Incluir el controlador para actualizar la información del usuario
include ('../app/controllers/usuarios/update_usuario.php');

// Incluir el controlador para listar los roles disponibles
include ('../app/controllers/roles/listado_de_roles.php');

?>

<!-- Contenedor de contenido. Contiene el contenido de la página -->
<div class="content-wrapper">
    <!-- Encabezado de contenido (Encabezado de la página) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Actualizar datos del usuario</h1>
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
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Actualice la información del usuario</h3>

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
                                    <!-- Formulario para actualizar información del usuario -->
                                    <form action="../app/controllers/usuarios/update.php" method="post">
                                        <!-- Campo oculto para el ID del usuario -->
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_get; ?>" hidden>
                                        <!-- Campo para nombres del usuario -->
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" value="<?php echo $nombres; ?>" placeholder="Escriba el nombre del nuevo usuario..." required>
                                        </div>
                                        <!-- Campo para email del usuario -->
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Escriba el email del nuevo usuario..." required>
                                        </div>
                                        <!-- Campo para seleccionar el rol del usuario -->
                                        <div class="form-group">
                                            <label for="">Rol del usuario</label>
                                            <select name="rol" id="" class="form-control">
                                                <?php
                                                // Iterar sobre los roles disponibles para mostrarlos en el selector
                                                foreach ($roles_datos as $roles_dato) {
                                                    $rol_table = $roles_dato['rol'];
                                                    $id_rol = $roles_dato['id_rol']; ?>
                                                    <option value="<?php echo $id_rol; ?>" <?php if ($rol_table == $rol) { ?> selected="selected" <?php } ?>>
                                                        <?php echo $rol_table; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <!-- Campo para contraseña del usuario -->
                                        <div class="form-group">
                                            <label for="">Contraseña</label>
                                            <input type="text" name="password_user" class="form-control">
                                        </div>
                                        <!-- Campo para repetir la contraseña -->
                                        <div class="form-group">
                                            <label for="">Repita la contraseña</label>
                                            <input type="text" name="password_repeat" class="form-control">
                                        </div>
                                        <!-- Botones para cancelar o actualizar -->
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

<!-- Incluir mensajes y la segunda parte del layout -->
<?php include ('../layout/mensajes.php');?>
<?php include ('../layout/parte2.php');?>

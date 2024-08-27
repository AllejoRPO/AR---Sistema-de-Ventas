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

// Incluir el controlador para mostrar el usuario
include ('../app/controllers/usuarios/show_usuario.php');
// Fin del bloque de controlador de usuario

?>

<!-- Contenedor de contenido. Contiene el contenido de la página -->
<div class="content-wrapper">
    <!-- Encabezado de contenido (Encabezado de la página) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Eliminar el registro del usuario</h1>
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
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">¿Está seguro de eliminar al usuario?</h3>
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
                                    <!-- Formulario para eliminar un usuario -->
                                    <form action="../app/controllers/usuarios/delete_usuarios.php" method="post">
                                        <input type="text" name="id_usuario" value="<?php echo $id_usuario_get; ?>" hidden>
                                        <div class="form-group">
                                            <label for="">Nombres</label>
                                            <input type="text" name="nombres" class="form-control" value="<?php echo $nombres;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Email</label>
                                            <input type="email" name="email" class="form-control" value="<?php echo $email;?>" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Rol del usuario</label>
                                            <input type="text" name="rol" class="form-control" value="<?php echo $rol;?>" disabled>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </form>
                                    <!-- Fin del formulario para eliminar un usuario -->
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

<!-- Incluir el archivo de mensajes -->
<?php include ('../layout/mensajes.php'); ?>
<!-- Fin del bloque de mensajes -->

<!-- Incluir la segunda parte del layout -->
<?php include ('../layout/parte2.php'); ?>
<!-- Fin del bloque de layout parte2 -->

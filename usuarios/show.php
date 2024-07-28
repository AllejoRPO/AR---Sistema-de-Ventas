<?php

// Incluir el archivo de configuración
include ('../app/config.php');

// Incluir el archivo de sesión
include ('../layout/sesion.php');

// Incluir la primera parte del layout
include ('../layout/parte1.php');

// Incluir el controlador para mostrar la información del usuario
include ('../app/controllers/usuarios/show_usuario.php')

?>

<!-- Contenedor de contenido. Contiene el contenido de la página -->
<div class="content-wrapper">
    <!-- Encabezado de contenido (Encabezado de la página) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Información general del usuario</h1>
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
                            <h3 class="card-title">Información usuario</h3>

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
                                    <!-- Mostrar información del usuario -->
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
                                        <a href="index.php" class="btn btn-secondary">Volver</a>
                                    </div>
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

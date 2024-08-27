<?php

// Incluir archivos de configuración y otros necesarios
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');

// Incluir el controlador para cargar datos del producto
include ('../app/controllers/almacen/cargar_producto.php');

// Mostrar mensaje de sesión, si existe
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
    unset($_SESSION["mensaje"]);
    unset($_SESSION["icono"]);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <!-- Título de la página -->
                    <h1 class="m-0">Datos del producto <?php echo $nombre; ?> a eliminar</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <!-- Card para confirmar eliminación del producto -->
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">¿Está seguro de eliminar este producto?</h3>

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
                                    <!-- Formulario para eliminar el producto -->
                                    <form action="../app/controllers/almacen/delete.php" method="post">
                                        <!-- Campo oculto para el ID del producto -->
                                        <input type="text" name="id_producto" value="<?php echo $id_producto_get; ?>" hidden>

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <!-- Código del producto -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Código:</label>
                                                            <input type="text" class="form-control" value="<?php echo $codigo; ?>" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- Categoría del producto -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Categoría:</label>
                                                            <div style="display: flex">
                                                                <input type="text" class="form-control" value="<?php echo $nombre_categoria; ?>" disabled>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Nombre del producto -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Nombre del producto:</label>
                                                            <input type="text" name="nombre" value="<?php echo $nombre; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Usuario que creó el producto -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Usuario:</label>
                                                            <input type="text" class="form-control" value="<?php echo $email; ?>" disabled>
                                                        </div>
                                                    </div>

                                                    <!-- Descripción del producto -->
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="">Descripción del producto:</label>
                                                            <textarea name="descripcion" id="" cols="30" rows="1" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <!-- Información del stock y precios -->
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Stock:</label>
                                                            <input type="number" name="stock" value="<?php echo $stock; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Stock mínimo:</label>
                                                            <input type="number" name="stock_minimo" value="<?php echo $stock_minimo; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Stock máximo:</label>
                                                            <input type="number" name="stock_maximo" value="<?php echo $stock_maximo; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio compra:</label>
                                                            <input type="number" name="precio_compra" value="<?php echo $precio_compra; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Precio venta:</label>
                                                            <input type="number" name="precio_venta" value="<?php echo $precio_venta; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="">Fecha ingreso:</label>
                                                            <input type="date" name="fecha_ingreso" value="<?php echo $fecha_ingreso; ?>" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Imagen del producto -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="">Imagen del producto:</label>
                                                    <center>
                                                        <img src="<?php echo $URL."/almacen/img_productos/".$imagen;?>" width="100%" alt="">
                                                    </center>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <div class="form-group">
                                            <!-- Botones para cancelar o confirmar eliminación -->
                                            <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                            <button class="btn btn-danger"><i class="fa fa-trash"> Borrar producto</i></button>
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

<?php include ('../layout/parte2.php');?>

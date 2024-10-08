<?php

// Incluir archivo de configuración y otros archivos necesarios.
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');

// Incluir los controladores para obtener datos necesarios
include ('../app/controllers/almacen/listado_de_productos.php');
include ('../app/controllers/proveedores/listado_de_proveedores.php');
include ('../app/controllers/compras/cargar_compra.php');

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
                    <h1 class="m-0">Compra número <?php echo $nro_compra; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <!-- Row for main content -->
            <div class="row">
                
                <!-- Left Column -->
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la compra</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <!-- Product details -->
                                    <div class="row" style="font-size: 12px">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" id="id_producto" hidden>
                                                        <label for="">Código:</label>
                                                        <input type="text" class="form-control" value="<?php echo $codigo; ?>" id="codigo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Categoría:</label>
                                                        <input type="text" class="form-control" value="<?php echo $nombre_categoria; ?>"  id="categoria" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Nombre del producto:</label>
                                                        <input type="text" name="nombre" class="form-control" value="<?php echo $nombre_producto; ?>" id="nombre_producto" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Usuario:</label>
                                                        <input type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" id="usuario_producto" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label for="">Descripción del producto:</label>
                                                        <textarea name="descripcion" id="descripcion_producto" cols="30" rows="1" class="form-control" disabled><?php echo $descripcion; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock:</label>
                                                        <input type="number" name="stock" class="form-control" value="<?php echo $stock; ?>" id="stock" style="background-color: #ffcd00" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock mínimo:</label>
                                                        <input type="number" name="stock_minimo" class="form-control" value="<?php echo $stock_minimo; ?>" id="stock_minimo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Stock máximo:</label>
                                                        <input type="number" name="stock_maximo" class="form-control" value="<?php echo $stock_maximo; ?>" id="stock_maximo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio compra:</label>
                                                        <input type="number" name="precio_compra" class="form-control" value="<?php echo $precio_compra_producto; ?>" id="precio_compra" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Precio venta:</label>
                                                        <input type="number" name="precio_venta" class="form-control" value="<?php echo $precio_venta_producto; ?>" id="precio_venta" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <label for="">Fecha ingreso:</label>
                                                        <input type="date" name="fecha_ingreso" class="form-control" style="font-size: 10px" value="<?php echo $fecha_ingreso; ?>" id="fecha_ingreso" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Imagen del producto:</label>
                                                <center>
                                                    <img src="<?php echo $URL."/almacen/img_productos/".$imagen; ?>" id="img_producto" width="100%" alt="">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- Provider details -->
                                    <div style="display: flex">
                                        <h5>Datos del proveedor</h5>
                                    </div>
                                    <hr>
                                    <div class="container-fluid" style="font-size: 12px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="id_proveedor" hidden>
                                                    <label for="">Nombre del proveedor</label>
                                                    <input type="text" id="nombre_proveedor" class="form-control" value="<?php echo $nombre_proveedor; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Celular</label>
                                                    <input type="number" id="celular" class="form-control" value="<?php echo $celular_proveedor; ?>"  disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Teléfono</label>
                                                    <input type="number" id="telefono" class="form-control" value="<?php echo $telefono_proveedor; ?>"  disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Empresa</label>
                                                    <input type="text" id="empresa" class="form-control" value="<?php echo $empresa; ?>"  disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" id="email" class="form-control" value="<?php echo $email_proveedor; ?>"  disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Dirección</label>
                                                    <textarea name="" id="direccion" cols="30" rows="1" class="form-control" disabled><?php echo $direccion_proveedor; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="col-md-3">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Detalle de la compra</h3>

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
                                    <div class="form-group">
                                        <label for="">Número de la compra</label>
                                        <input type="text" value="<?php echo $id_compra_get; ?>" style="text-align: center" class="form-control" disabled>
                                        <input type="text" value="<?php echo $id_compra_get; ?>" id="nro_compra" hidden="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Fecha de la compra</label>
                                        <input type="date" class="form-control" value="<?php echo $fecha_compra; ?>"  id="fecha_compra"disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Comprobante de la compra</label>
                                        <input type="text" class="form-control" value="<?php echo $comprobante; ?>" id="comprobante" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Precio de la compra</label>
                                        <input type="text" class="form-control" value="<?php echo $precio_compra; ?>" id="precio_compra_controlador" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Cantidad de la compra</label>
                                        <input type="number" id="cantidad_compra"  style="text-align: center" class="form-control" value="<?php echo $cantidad; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" disabled>
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

<?php include ('../layout/parte2.php');?>

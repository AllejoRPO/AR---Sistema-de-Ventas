<?php

// Incluir archivo de configuración y otros archivos necesarios.
include ('../app/config.php'); // Inicio de inclusión de archivos
include ('../layout/sesion.php');
include ('../layout/parte1.php'); // Fin de inclusión de archivos

// Incluir los controladores para obtener datos necesarios
include ('../app/controllers/almacen/listado_de_productos.php'); // Inicio de inclusión de controladores
include ('../app/controllers/proveedores/listado_de_proveedores.php');
include ('../app/controllers/compras/cargar_compra.php'); // Fin de inclusión de controladores

// Mostrar mensaje de sesión, si existe
if (isset($_SESSION["mensaje"])) { // Inicio de manejo de mensaje de sesión
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
} // Fin de manejo de mensaje de sesión
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper"> <!-- Inicio del contenedor de contenido -->
    <!-- Content Header (Page header) -->
    <div class="content-header"> <!-- Inicio del encabezado del contenido -->
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Compra número <?php echo $nro_compra; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div> <!-- Fin del encabezado del contenido -->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content"> <!-- Inicio del contenido principal -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-danger"> <!-- Inicio de la tarjeta de eliminación -->
                                <div class="card-header">
                                    <h3 class="card-title">¿Esta seguro de eliminar la compra?</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;"> <!-- Inicio del cuerpo de la tarjeta -->
                                    <div class="row" style="font-size: 12px">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $id_producto_tabla; ?>" id="id_producto" hidden>
                                                        <label for="">Código:</label>
                                                        <input type="text" class="form-control" value="<?php echo $codigo; ?>" id="codigo" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="">Categoría:</label>
                                                        <input type="text" class="form-control" value="<?php echo $nombre_categoria; ?>" id="categoria" disabled>
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
                                </div> <!-- Fin del cuerpo de la tarjeta -->
                            </div> <!-- Fin de la tarjeta de eliminación -->
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-outline card-danger"> <!-- Inicio de la tarjeta de detalle de compra -->
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
                        <div class="card-body"> <!-- Inicio del cuerpo de la tarjeta de detalle de compra -->
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
                                        <input type="date" class="form-control" value="<?php echo $fecha_compra; ?>"  id="fecha_compra" disabled>
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-danger btn-block" id="btn_eliminar"><i class="fa fa-trash"></i> Eliminar</button>
                                    </div>
                                </div>
                                <div id="respuesta_delete"></div>
                                <script>
                                            $('#btn_eliminar').click(function () { // Inicio de manejo de eliminación
                                                var id_compra = '<?php echo $id_compra_get; ?>';
                                                var id_producto = $('#id_producto').val();
                                                var cantidad_compra = '<?php echo $cantidad; ?>';
                                                var stock_actual = '<?php echo $stock; ?>';

                                                Swal.fire({
                                                    title: '¿Está seguro de eliminar la compra?',   
                                                    icon: 'question',
                                                    showCancelButton: true,
                                                    confirmButtonColor: '#3085d6',
                                                    cancelButtonColor: '#d33',
                                                    confirmButtonText: 'Si deseo eliminar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        Swal.fire(
                                                            eliminar(),
                                                            'Compra eliminada',
                                                            'success'

                                                        )
                                                    }
                                                });

                                                function eliminar() { // Inicio de función de eliminación
                                                    var url = "../app/controllers/compras/delete.php";
                                                    $.get(url,{id_compra:id_compra,id_producto:id_producto,cantidad_compra:cantidad_compra,stock_actual:stock_actual},function (datos) {
                                                        $('#respuesta_delete').html(datos);
                                                    });
                                                } // Fin de función de eliminación
                                            }); // Fin de manejo de eliminación
                                        </script>
                            </div>
                        </div> <!-- Fin del cuerpo de la tarjeta de detalle de compra -->
                    </div> <!-- Fin de la tarjeta de detalle de compra -->
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div> <!-- Fin del contenido principal -->
    <!-- /.content -->
</div> <!-- Fin del contenedor de contenido -->
<!-- /.content-wrapper -->

<?php include ('../layout/parte2.php'); ?> <!-- Inicio de inclusión del pie de página -->

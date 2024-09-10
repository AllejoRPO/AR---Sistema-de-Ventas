<?php

// Incluir archivos de configuración y otros necesarios.
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');

// Incluir el controlador para obtener el listado de ventas
include ('../app/controllers/ventas/listado_de_ventas.php');

// Mostrar mensaje de sesión, si existe
if (isset($_SESSION["mensaje"])) {
    $respuesta = $_SESSION["mensaje"]; ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "<?php echo $respuesta; ?>",
            showConfirmButton: false,
            timer: 2500
        });
    </script>
    <?php
    unset($_SESSION["mensaje"]);
    unset($_SESSION["icono"]);
}
// Fin del bloque de mensaje de sesión
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de ventas realizadas</h1>
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
                    <div class=" card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Ventas registradas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th><center>Nro</center></th>
                                        <th><center>Nro de venta</center></th>
                                        <th><center>Producto</center></th>
                                        <th><center>Cliente</center></th>
                                        <th><center>Total pagado</center></th>
                                        <th><center>Acciones</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    // Ordenar datos de las ventas por número de venta
                                    $contador = 0;
                                    usort($ventas_datos, function($a, $b) {
                                        return $a['nro_venta'] <=> $b['nro_venta'];
                                    });
                                    foreach ($ventas_datos as $ventas_dato) {
                                        $id_venta = $ventas_dato['id_venta'];
                                        $id_cliente = $ventas_dato['id_cliente'];
                                        $contador = $contador + 1;
                                        ?>

                                        <tr>
                                            <td style="text-align: center"><?php echo $contador; ?></td>
                                            <td style="text-align: center"><?php echo $ventas_dato['nro_venta']; ?></td>
                                            <td style="text-align: center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#Modal_productos<?php echo $id_venta; ?>">
                                                    <i class="fa fa-shopping-basket"></i> Productos
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="Modal_productos<?php echo $id_venta; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #1bbed3">
                                                                <h5 class="modal-title" id="exampleModalLabel">Productos de la venta nro <?php echo $ventas_dato['nro_venta']; ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-sm table-hover table-striped">
                                                                        <thead>
                                                                        <tr>
                                                                            <th style="background-color: #e7e7e7; text-align: center">Número</th>
                                                                            <th style="background-color: #e7e7e7; text-align: center">Producto</th>
                                                                            <th style="background-color: #e7e7e7; text-align: center">Detalle</th>
                                                                            <th style="background-color: #e7e7e7; text-align: center">Cantidad</th>
                                                                            <th style="background-color: #e7e7e7; text-align: center">Precio Unitario</th>
                                                                            <th style="background-color: #e7e7e7; text-align: center">Precio SubTotal</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $contador_de_carrito = 0;
                                                                        $cantidad_total = 0;
                                                                        $precio_unitario_total = 0;
                                                                        $precio_total = 0;

                                                                        $nro_venta = $ventas_dato['nro_venta'];

                                                                        $sql_carrito = "SELECT *, pro.nombre as nombre_producto, pro.descripcion as descripcion, pro.precio_venta as precio_venta, pro.stock as stock, pro.id_producto as id_producto FROM tb_carrito as carr INNER JOIN tb_almacen as pro ON carr.id_producto = pro.id_producto WHERE nro_venta = '$nro_venta' ORDER BY id_carrito ASC ";

                                                                        // Preparar la consulta SQL utilizando PDO
                                                                        $query_carrito = $pdo->prepare($sql_carrito);

                                                                        // Ejecutar la consulta
                                                                        $query_carrito->execute();

                                                                        // Obtener todos los resultados en forma de array asociativo
                                                                        $carrito_datos = $query_carrito->fetchAll(PDO::FETCH_ASSOC);

                                                                        foreach ($carrito_datos as $carrito_dato){
                                                                            $id_carrito = $carrito_dato['id_carrito'];
                                                                            $contador_de_carrito = $contador_de_carrito + 1;
                                                                            $cantidad_total = $cantidad_total + $carrito_dato ['cantidad'];
                                                                            $precio_unitario_total = $precio_unitario_total + floatval($carrito_dato ['precio_venta']);
                                                                            ?>
                                                                            <tr>
                                                                                <td style="text-align: center">
                                                                                    <?php echo $contador_de_carrito; ?>
                                                                                    <input type="text" value="<?php echo $carrito_dato ['id_producto']; ?>" id="id_producto<?php echo $contador_de_carrito; ?>" hidden>
                                                                                </td>
                                                                                <td style="text-align: center"><?php echo $carrito_dato ['nombre_producto']; ?></td>
                                                                                <td style="text-align: center"><?php echo $carrito_dato ['descripcion']; ?></td>
                                                                                <td style="text-align: center">
                                                                                    <span id="cantidad_carrito<?php echo $contador_de_carrito; ?>"><?php echo $carrito_dato ['cantidad']; ?></span>
                                                                                    <input type="text" value="<?php echo $carrito_dato ['stock']; ?>" id="stock_de_inventario<?php echo $contador_de_carrito; ?>" hidden>
                                                                                </td>
                                                                                <td style="text-align: center"><?php echo $carrito_dato ['precio_venta']; ?></td>
                                                                                <td style="text-align: center">
                                                                                    <?php
                                                                                    $cantidad = floatval($carrito_dato ['cantidad']);
                                                                                    $precio_venta = floatval($carrito_dato ['precio_venta']);
                                                                                    echo $subtotal = $cantidad * $precio_venta;
                                                                                    $precio_total = $precio_total + $subtotal;
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <th colspan="3" style="background-color: #e7e7e7; text-align: right">Total: </th>
                                                                            <th style="text-align: center"><?php echo $cantidad_total; ?></th>
                                                                            <th style="text-align: center"><?php echo $precio_unitario_total; ?></th>
                                                                            <th style="text-align: center; background-color: #ffcd00"><?php echo $precio_total; ?></th>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#Modal_clientes<?php echo $id_venta; ?>">
                                                    <i class="fa fa-user"></i> <?php echo $ventas_dato ['nombre_cliente']; ?>
                                                </button>
                                                <!-- Modal para registrar clientes -->
                                                <div class="modal fade" id="Modal_clientes<?php echo $id_venta; ?>">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header" style="background-color: #67635c; color: #ffffff ">
                                                                <h4 class="modal-title">Cliente</h4>
                                                                <div style="width: 10px"></div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <?php
                                                            $sql_clientes = "SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente'";
                                                            $query_clientes = $pdo->prepare($sql_clientes);
                                                            $query_clientes->execute();
                                                            $clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($clientes_datos as $clientes_dato) {
                                                                $nombre_cliente = $clientes_dato['nombre_cliente'];
                                                                $nit_ci_cliente = $clientes_dato['nit_ci_cliente'];
                                                                $celular_cliente = $clientes_dato['celular_cliente'];
                                                                $email_cliente = $clientes_dato['email_cliente'];
                                                            }
                                                            ?>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="">Nombre del cliente</label>
                                                                    <input type="text" value="<?php echo $nombre_cliente; ?>" name="nombre_cliente" class="form-control" style="text-align: center" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Nit/CI del cliente</label>
                                                                    <input type="text" value="<?php echo $nit_ci_cliente; ?>" name="nit_ci_cliente" class="form-control" style="text-align: center" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Celular del cliente</label>
                                                                    <input type="text" value="<?php echo $celular_cliente; ?>" name="celular_cliente" class="form-control" style="text-align: center" disabled>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Correo del cliente</label>
                                                                    <input type="email" value="<?php echo $email_cliente; ?>" name="email_cliente" class="form-control" style="text-align: center" disabled>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: center">
                                                <button class="btn btn-success btn-block"><?php echo "$ ".$ventas_dato['total_pagado']; ?></button>
                                            </td>
                                            <td style="text-align: center">
                                                <a href="show.php?id_venta=<?php echo $id_venta; ?>" class="btn btn-info"><i class="fa fa-eye"></i> Ver</a>
                                                <a href="delete.php?id_venta=<?php echo $id_venta; ?>&nro_venta=<?php echo $nro_venta; ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar</a>
                                                <a href="factura.php?id_venta=<?php echo $id_venta; ?>&nro_venta=<?php echo $nro_venta; ?>" class="btn btn-success"><i class="fa fa-print"></i> Imprimir</a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                    </tfoot>
                                </table>
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

<script>
    $(function () {
        $("#example1").DataTable({
            /* Configuración de idioma para DataTable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Ventas",
                "infoEmpty": "Mostrando 0 a 0 de 0 Ventas",
                "infoFiltered": "(Filtrado de _MAX_ total Ventas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Ventas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* Fin de configuración de idioma */

            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,

            /* Configuración de botones para DataTable */
            buttons: [
                {
                    extend: 'collection',
                    text: 'Reportes',
                    orientation: 'landscape',
                    buttons: [
                        { text: 'Copiar', extend: 'copy' },
                        { extend: 'pdf' },
                        { extend: 'csv' },
                        { extend: 'excel' },
                        { text: 'Imprimir', extend: 'print' }
                    ]
                },
                { extend: 'colvis', text: 'Visor de columnas' }
            ],
            /* Fin de configuración de botones */
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

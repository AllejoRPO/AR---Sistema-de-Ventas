<?php
$id_venta_get = $_GET['id_venta'];
$nro_venta_get = $_GET['nro_venta'];

// Incluir archivo de configuración y otros archivos necesarios
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');

// Incluir los controladores para obtener datos necesarios
include ('../app/controllers/ventas/cargar_venta.php');
include ('../app/controllers/clientes/cargar_cliente.php');

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
                    <h1 class="m-0">Detalle de la venta nro <?php echo $nro_venta; ?> - ¿Está seguro/a de eliminar esta venta?</h1>
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
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-bag"></i> Venta número
                                <input type="text" style="text-align: center;" value="<?php echo $nro_venta; ?>" disabled></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
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
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-10">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-user-check"></i> Datos del cliente</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->

                        <?php
                        foreach ($clientes_datos as $clientes_dato){} {
                            $nombre_cliente = $clientes_dato['nombre_cliente'];
                            $nit_ci_cliente = $clientes_dato['nit_ci_cliente'];
                            $celular_cliente = $clientes_dato['celular_cliente'];
                            $email_cliente = $clientes_dato['email_cliente'];
                        }
                        ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <input type="text" id="id_cliente" hidden>
                                        <label for="">Nombre del cliente</label>
                                        <input type="text" value="<?php echo $nombre_cliente; ?>" class="form-control" id="nombre_cliente" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Nit/CI del cliente</label>
                                        <input type="text" value="<?php echo $nit_ci_cliente; ?>" class="form-control" id="nit_ci_cliente" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Celular del cliente</label>
                                        <input type="text" value="<?php echo $celular_cliente; ?>" class="form-control" id="celular_cliente" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Correo del cliente</label>
                                        <input type="text" value="<?php echo $email_cliente; ?>" class="form-control" id="email_cliente" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fa fa-shopping-cart"></i> Pago</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Monto cancelado</label>
                                <input type="text" class="form-control" style="text-align: center;background-color: #ffcd00"
                                       id="total_a_cancelar" value="<?php echo $precio_total; ?>" disabled>
                            </div>
                            <hr>
                            <div class="form-group">
                                <button id="btn_borrar_venta" class="btn btn-danger btn-block"><i class="fa fa-trash"></i> Borrar venta</button>
                                <div id="btn_resultado_borrar_venta"></div>
                            </div>
                            <script>
                                $('#btn_borrar_venta').click(function () {
                                    var id_venta = '<?php echo $id_venta_get; ?>';
                                    var nro_venta = '<?php echo $nro_venta_get; ?>';

                                    actualizar_stock();
                                    borrar_venta();

                                    function actualizar_stock () {

                                        var i = 1;
                                        var n = '<?php echo $contador_de_carrito; ?>';

                                        for ( i = 1; i <= n;i++){
                                            var a = '#stock_de_inventario'+i;
                                            var stock_de_inventario = $(a).val();

                                            var b = '#cantidad_carrito'+i;
                                            var cantidad_carrito = $(b).html();

                                            var c = '#id_producto'+i;
                                            var id_producto = $(c).val();

                                            var stock_calculado = parseFloat(parseInt(stock_de_inventario) + parseInt(cantidad_carrito));

                                            //alert(id_producto +" - "+ stock_de_inventario +" - "+ cantidad_carrito +" - "+ stock_calculado);

                                            var url2 = "../app/controllers/ventas/actualizar_stock.php";
                                            $.get(url2, {
                                                id_producto:id_producto, stock_calculado:stock_calculado
                                            }, function (datos) {
                                            });
                                        }
                                    }
                                    function borrar_venta () {
                                        var url = "../app/controllers/ventas/borrar_venta.php";
                                        $.get(url, {id_venta:id_venta, nro_venta:nro_venta
                                        }, function (datos) {
                                            $('#btn_resultado_borrar_venta').html(datos);
                                        });
                                    }
                                });
                            </script>
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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
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

            /* Fin de configuración de botones */
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#example2").DataTable({
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 clientes",
                "infoFiltered": "(Filtrado de _MAX_ total clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ clientes",
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
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy'
                }, {
                    extend: 'pdf',
                }, {
                    extend: 'csv',
                }, {
                    extend: 'excel',
                }, {
                    text: 'Imprimir',
                    extend: 'print'
                }]
            }, {
                extend: 'colvis',
                text: 'Visor de columnas'
            }],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<!-- Modal para registrar clientes -->
<div class="modal fade" id="modal-agregar_cliente">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #af8f0f; color: #ffffff ">
                <h4 class="modal-title">Nuevo cliente</h4>
                <div style="width: 10px"></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../app/controllers/clientes/guardar_clientes.php" method="post">
                    <div class="form-group">
                        <label for="">Nombre del cliente</label>
                        <input type="text" name="nombre_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nit/CI del cliente</label>
                        <input type="text" name="nit_ci_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Celular del cliente</label>
                        <input type="text" name="celular_cliente" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Correo del cliente</label>
                        <input type="email" name="email_cliente" class="form-control">
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-warning btn-block">Guardar cliente</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
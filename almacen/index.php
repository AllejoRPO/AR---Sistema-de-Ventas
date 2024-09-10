<?php

// Incluir archivos de configuración y otros necesarios.
include ('../app/config.php');
include ('../layout/sesion.php');
include ('../layout/parte1.php');

// Incluir el controlador para obtener el listado de productos
include ('../app/controllers/almacen/listado_de_productos.php');

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
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de productos</h1>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Productos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->

                        <!-- Card body -->
                        <div class="card-body">
                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th><center>Nro</center></th>
                                        <th><center>Código</center></th>
                                        <th><center>Categoría</center></th>
                                        <th><center>Imagen</center></th>
                                        <th><center>Nombre</center></th>
                                        <th><center>Descripción</center></th>
                                        <th><center>Stock</center></th>
                                        <th><center>Precio compra</center></th>
                                        <th><center>Precio venta</center></th>
                                        <th><center>Fecha registro</center></th>
                                        <th><center>Usuario</center></th>
                                        <th><center>Acciones</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $contador = 0; // Inicializa el contador
                                    foreach ($productos_datos as $productos_dato) {
                                        $id_producto = $productos_dato['id_producto']; ?>

                                        <tr>
                                            <td><?php echo ++$contador; ?></td>
                                            <td><?php echo $productos_dato['codigo']; ?></td>
                                            <td><?php echo $productos_dato['categoria']; ?></td>
                                            <td>
                                                <img src="<?php echo $URL."/almacen/img_productos/".$productos_dato['imagen']; ?>" width="50px" alt="">
                                            </td>
                                            <td><?php echo $productos_dato['nombre']; ?></td>
                                            <td><?php echo $productos_dato['descripcion']; ?></td>
                                            <?php
                                            $stock_actual = $productos_dato['stock'];
                                            $stock_minimo = $productos_dato['stock_minimo'];
                                            $stock_maximo = $productos_dato['stock_maximo'];
                                            if ($stock_actual < $stock_minimo) { ?>
                                                <td style="background-color: #d37f7f"><center><?php echo $productos_dato['stock']; ?></center></td>
                                            <?php
                                            } else if($stock_actual > $stock_maximo){ ?>
                                                <td style="background-color: #eada53"><center><?php echo $productos_dato['stock']; ?></center></td>
                                            <?php
                                            } else { ?>
                                                <td style="background-color: #71da89"><center><?php echo $productos_dato['stock']; ?></center></td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo $productos_dato['precio_compra']; ?></td>
                                            <td><?php echo $productos_dato['precio_venta']; ?></td>
                                            <td><?php echo $productos_dato['fecha_ingreso']; ?></td>
                                            <td><?php echo $productos_dato['email']; ?></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        <a href="show.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> Ver</a>
                                                        <a href="update.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i> Editar</a>
                                                        <a href="delete.php?id=<?php echo $id_producto; ?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Borrar</a>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                    ?>
                                    </tbody>
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

<!-- Script para inicializar y configurar DataTable -->
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

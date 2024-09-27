<?php

// Inicio del bloque de inclusión de archivos.
// Incluir el archivo de configuración
include ('../app/config.php');

// Incluir el archivo de sesión
include ('../layout/sesion.php');

// Incluir la primera parte del layout
include ('../layout/parte1.php');

// Incluir el controlador para listar los clientes
include ('../app/controllers/clientes/listado_de_clientes.php');
// Fin del bloque de inclusión de archivos

// Inicio del bloque para mostrar mensajes de sesión
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
    // Eliminar los mensajes de la sesión después de mostrarlos
    unset($_SESSION["mensaje"]);
    unset($_SESSION["icono"]);
}
// Fin del bloque para mostrar mensajes de sesión
?>

<!-- Inicio del bloque de contenedor de contenido -->
<div class="content-wrapper">

    <!-- Inicio del bloque de encabezado de contenido -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de clientes</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Fin del bloque de encabezado de contenido -->

    <!-- Inicio del bloque de contenido principal -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Clientes registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <!-- Inicio del bloque de tabla de clientes -->
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre del cliente</center></th>
                                    <th><center>Nit/CI del cliente</center></th>
                                    <th><center>Celular del cliente</center></th>
                                    <th><center>Email del cliente</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $contador = 0;
                                foreach ($clientes_datos as $clientes_dato) {
                                    $id_cliente = $clientes_dato['id_cliente'];
                                    ?>
                                    <tr style="text-align: center">
                                        <td><center><?php echo ++$contador; ?></center></td>
                                        <td><?php echo $clientes_dato['nombre_cliente']; ?></td>
                                        <td><?php echo $clientes_dato['nit_ci_cliente']; ?></td>
                                        <td><?php echo $clientes_dato['celular_cliente']; ?></td>
                                        <td><?php echo $clientes_dato['email_cliente']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                            <!-- Fin del bloque de tabla de clientes -->
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

<!-- Inicio del bloque de inclusión de la segunda parte del layout -->
<?php include ('../layout/parte2.php'); ?>
<!-- Fin del bloque de inclusión de la segunda parte del layout -->

<!-- Inicio del bloque de inicialización de DataTable -->
<script>
    $(function () {
        $("#example1").DataTable({
            // Configuración de paginación
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
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
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            // Configuración de botones
            buttons: [
                {
                    extend: 'collection',
                    text: 'Reportes',
                    buttons: [
                        { text: 'Copiar', extend: 'copy' },
                        { extend: 'pdf' },
                        { extend: 'csv' },
                        { extend: 'excel' },
                        { text: 'Imprimir', extend: 'print' }
                    ]
                },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<!-- Fin del bloque de inicialización de DataTable -->

<?php

// Incluye archivos de configuración y diseño
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');

// Incluye el controlador para listar categorías
include('../app/controllers/categorias/listado_de_categorias.php');

// Verifica si hay un mensaje en la sesión
if (isset($_SESSION["mensaje"])) {
    // Asigna el mensaje de la sesión a una variable
    $respuesta = $_SESSION["mensaje"]; ?>
    <script>
        // Muestra una alerta de éxito con SweetAlert2
        Swal.fire({
            position: "top-end",            // Posición de la alerta
            icon: "success",               // Tipo de ícono (éxito)
            title: "<?php echo $respuesta; ?>", // Mensaje de la alerta
            showConfirmButton: false,       // No muestra el botón de confirmación
            timer: 2500                     // Duración de la alerta en milisegundos
        });
    </script>
    <?php
    // Limpia los datos de la sesión después de mostrarlos
    unset($_SESSION["mensaje"]);
    unset($_SESSION["icono"]);
}
?>

<!-- Contenedor principal de contenido -->
<div class="content-wrapper">
    <!-- Encabezado del contenido -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de categorías
                        <!-- Botón para añadir una nueva categoría -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Añadir categoría
                        </button>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Contenido principal -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Categorías registradas</h3>
                            <div class="card-tools">
                                <!-- Botón para minimizar el card -->
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre de la categoría</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                // Inicializa el contador
                                $contador = 0;
                                // Recorre los datos de las categorías
                                foreach ($categorias_datos as $categorias_dato){
                                    $id_categoria = $categorias_dato['id_categoria'];
                                    $nombre_categoria = $categorias_dato['nombre_categoria']; ?>
                                    <tr>
                                        <td><center><?php echo $contador = $contador +1;?></center></td>
                                        <td><?php echo $categorias_dato['nombre_categoria'];?></td>
                                        <td>
                                            <center>
                                                <div class="btn-group">
                                                    <!-- Botón para editar una categoría -->
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_categoria; ?>">
                                                        <i class="fa fa-pencil-alt"></i> Editar
                                                    </button>

                                                    <!-- Modal para actualizar categorías -->
                                                    <div class="modal fade" id="modal-update<?php echo $id_categoria; ?>">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header" style="background-color: #28883b; color: #ffffff ">
                                                                    <h4 class="modal-title">Actualización de la categoría</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="">Nombre de la categoría</label>
                                                                                <input type="text" id="nombre_categoria<?php echo $id_categoria;?>" value="<?php echo $nombre_categoria; ?>" class="form-control">
                                                                                <small style="color: #990000; display: none" id="lbl_update<?php echo $id_categoria;?>">* Este campo es requerido</small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <!-- Botones para cancelar o actualizar -->
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-success" id="btn_update<?php echo $id_categoria;?>">Actualizar</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- /.modal -->

                                                    <!-- Script para manejar la actualización de categorías -->
                                                    <script>
                                                        $('#btn_update<?php echo $id_categoria; ?>').click(function () {
                                                            var nombre_categoria = $('#nombre_categoria<?php echo $id_categoria;?>').val();
                                                            var id_categoria = '<?php echo $id_categoria;?>';

                                                            if (nombre_categoria == "") {
                                                                $('#nombre_categoria<?php echo $id_categoria;?>').focus();
                                                                $('#lbl_update<?php echo $id_categoria;?>').css('display','block');
                                                            } else {
                                                                var url = "../app/controllers/categorias/update_de_categorias.php";
                                                                $.get(url, {nombre_categoria: nombre_categoria, id_categoria: id_categoria}, function (datos) {
                                                                    $('#respuesta_update<?php echo $id_categoria; ?>').html(datos);
                                                                });
                                                            }
                                                        });
                                                    </script>
                                                    <div id="respuesta_update<?php echo $id_categoria; ?>"></div>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombre de la categoría</center></th>
                                    <th><center>Acciones</center></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/parte2.php'); ?>

<!-- Script para inicializar el DataTable -->
<script>
    $(function () {
        $("#example1").DataTable({
            /* Configuración de idioma para DataTables */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorías",
                "infoEmpty": "Mostrando 0 a 0 de 0 Categorías",
                "infoFiltered": "(Filtrado de _MAX_ total Categorías)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorías",
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
            /* Configuración de botones para exportar datos */
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

<!-- Modal para registrar usuarios -->
<div class="modal fade" id="modal-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #177888; color: #ffffff ">
                <h4 class="modal-title">Creación de una nueva categoría</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Nombre de la categoría <b>*</b></label>
                            <input type="text" id="nombre_categoria" class="form-control">
                            <small style="color: #990000; display: none" id="lbl_create">* Este campo es requerido</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btn_create">Guardar categoría</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Script para manejar la creación de categorías -->
<script>
    $('#btn_create').click(function () {
        var nombre_categoria = $('#nombre_categoria').val();

        if (nombre_categoria == "") {
            $('#nombre_categoria').focus();
            $('#lbl_create').css('display', 'block');
        } else {
            var url = "../app/controllers/categorias/registro_de_categorias.php";
            $.get(url, {nombre_categoria: nombre_categoria}, function (datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
<div id="respuesta"></div>
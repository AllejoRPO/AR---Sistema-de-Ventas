<?php

include ('../app/config.php');
include ('../layout/sesion.php');

include ('../layout/parte1.php');
include ('../app/controllers/categorias/listado_de_categorias.php');

if (isset($_SESSION["mensaje"])) {
    $respuesta = $_SESSION["mensaje"]; ?>
    <script>
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "<?php echo $respuesta; ?>",
            showConfirmButton: false,
            timer: 2500
        })
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
                    <h1 class="m-0">Listado de categorías

                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Añadir categoría
                        </button>

                    </h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-7">
                    <div class="card-outline card-primary"">
                    <div class="card-header">
                        <h3 class="card-title">Categorías registradas</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" >
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
                            $contador = 0;
                            foreach ($categorias_datos as $categorias_dato){
                                $id_categoria = $categorias_dato['id_categoria'];
                                $nombre_categoria = $categorias_dato['nombre_categoria']; ?>
                                <tr>
                                    <td><center><?php echo $contador = $contador +1;?></center></td>
                                    <td><?php echo $categorias_dato['nombre_categoria'];?></td>
                                    <td>
                                        <center><div class="btn-group">
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update<?php echo $id_categoria; ?>">
                                                    <i class="fa fa-pencil-alt"></i> Editar
                                                </button>

                                                <!--Modal para actualizar categorias-->

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
                                                                            <input type="text" id="nombre_categoria<?php echo $id_categoria;?>"" value="<?php echo $nombre_categoria; ?>" class="form-control">
                                                                            <small style="color: #990000; display: none" id="lbl_update<?php echo $id_categoria;?>">* Este campo es requerido</small>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                <button type="button" class="btn btn-success" id="btn_update<?php echo $id_categoria;?>">Actualizar</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!-- /.modal -->
                                                <script>
                                                    $('#btn_update<?php echo $id_categoria; ?>').click(function () {

                                                        var nombre_categoria = $('#nombre_categoria<?php echo $id_categoria;?>').val();
                                                        var id_categoria = '<?php echo $id_categoria;?>';

                                                        if (nombre_categoria == "") {
                                                            $('#nombre_categoria<?php echo $id_categoria;?>').focus();
                                                            $('#lbl_update<?php echo $id_categoria;?>').css('display','block');
                                                        }else {
                                                            var url = "../app/controllers/categorias/update_de_categorias.php";
                                                            $.get(url,{nombre_categoria:nombre_categoria,id_categoria:id_categoria}, function (datos) {
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
            /* cambio de idiomas de datatable */
            "pageLength": 5,
            language: {
                "emptyTable": "No hay información",
                "decimal": "",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorías",
                "infoEmpty": "Mostrando 0 to 0 of 0 Categorías",
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
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            /* fin de idiomas */

            "responsive": true, "lengthChange": true, "autoWidth": false,

            /* Ajuste de botones */
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
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas'
                }
            ],
            /*Fin de ajuste de botones*/
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

<!--Modal para registrar usuarios-->

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
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btn_create">Guardar categoría</button>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $('#btn_create').click(function (){
        //alert("Guardar")
        var nombre_categoria = $('#nombre_categoria').val();

        if (nombre_categoria == "") {
            $('#nombre_categoria').focus();
            $('#lbl_create').css('display','block');
        }else {
            var url = "../app/controllers/categorias/registro_de_categorias.php";
            $.get(url,{nombre_categoria:nombre_categoria}, function (datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
<div id="respuesta"></div>






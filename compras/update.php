<?php

// Incluir archivo de configuración y otros archivos necesarios
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
                    <h1 class="m-0">Actualización de la compra</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Actualicé la información de la compra</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                    <!-- /.card-tools -->
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" style="display: block;">
                                    <div style="display: flex">
                                        <h5>Datos del producto</h5>
                                        <div style="width: 20px"></div>
                                        <button type="button" class="btn btn-success border-transparent" data-toggle="modal"
                                                data-target="#modal-buscar_producto">
                                            <i class="fa fa-search"></i>
                                            Buscar producto
                                        </button>
                                        <!-- Modal para buscar productos a comprar -->
                                        <div class="modal fade" id="modal-buscar_producto">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #0a4c98; color: #ffffff ">
                                                        <h4 class="modal-title">Busqueda del producto</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="example1" class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th><center>Nro</center></th>
                                                                <th><center>Seleccionar</center></th>
                                                                <th><center>Código</center></th>
                                                                <th><center>Categoría</center></th>
                                                                <th><center>Imagen</center></th>
                                                                <th><center>Nombre</center></th>
                                                                <th><center>Descripción</center></th>
                                                                <th><center>Stock</center></th>
                                                                <th><center>Precio compra</center></th>
                                                                <th><center>Precio venta</center></th>
                                                                <th><center>Fecha compra</center></th>
                                                                <th><center>Usuario</center></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $contador = 0;
                                                            foreach ($productos_datos as $productos_dato) {
                                                                $id_producto = $productos_dato['id_producto']; ?>

                                                                <tr>
                                                                    <td><?php echo ++$contador; ?></td>
                                                                    <td>
                                                                        <button href="" class="btn btn-outline-info" id="btn_seleccionar<?php echo $id_producto;?>">
                                                                            Seleccionar
                                                                        </button>
                                                                        <script>
                                                                            $('#btn_seleccionar<?php echo $id_producto;?>').click(function () {
                                                                                var id_producto = "<?php echo $productos_dato['id_producto'];?>";
                                                                                $('#id_producto').val(id_producto);

                                                                                var codigo = "<?php echo $productos_dato['codigo'];?>";
                                                                                $('#codigo').val(codigo);

                                                                                var categoria = "<?php echo $productos_dato['categoria'];?>";
                                                                                $('#categoria').val(categoria);

                                                                                var nombre = "<?php echo $productos_dato['nombre'];?>";
                                                                                $('#nombre_producto').val(nombre);

                                                                                var email = "<?php echo $productos_dato['email'];?>";
                                                                                $('#usuario_producto').val(email);

                                                                                var descripcion = "<?php echo $productos_dato['descripcion'];?>";
                                                                                $('#descripcion_producto').val(descripcion);

                                                                                var stock = "<?php echo $productos_dato['stock'];?>";
                                                                                $('#stock').val(stock);
                                                                                $('#stock_actual').val(stock);

                                                                                var stock_minimo = "<?php echo $productos_dato['stock_minimo'];?>";
                                                                                $('#stock_minimo').val(stock_minimo);

                                                                                var stock_maximo = "<?php echo $productos_dato['stock_maximo'];?>";
                                                                                $('#stock_maximo').val(stock_maximo);

                                                                                var precio_compra = "<?php echo $productos_dato['precio_compra'];?>";
                                                                                $('#precio_compra').val(precio_compra);

                                                                                var precio_venta = "<?php echo $productos_dato['precio_venta'];?>";
                                                                                $('#precio_venta').val(precio_venta);

                                                                                var fecha_ingreso = "<?php echo $productos_dato['fecha_ingreso'];?>";
                                                                                $('#fecha_ingreso').val(fecha_ingreso);

                                                                                var ruta_img = "<?php echo $URL."/almacen/img_productos/".$productos_dato['imagen'];?>";
                                                                                $('#img_producto').attr({src: ruta_img});

                                                                                $('#modal-buscar_producto').modal('toggle');

                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td><?php echo $productos_dato['codigo']; ?></td>
                                                                    <td><?php echo $productos_dato['categoria']; ?></td>
                                                                    <td>
                                                                        <img src="<?php echo $URL."/almacen/img_productos/".$productos_dato['imagen']; ?>" width="50px" alt="">
                                                                    </td>
                                                                    <td><?php echo $productos_dato['nombre']; ?></td>
                                                                    <td><?php echo $productos_dato['descripcion']; ?></td>
                                                                    <td><?php echo $productos_dato['stock']; ?></td>
                                                                    <td><?php echo $productos_dato['precio_compra']; ?></td>
                                                                    <td><?php echo $productos_dato['precio_venta']; ?></td>
                                                                    <td><?php echo $productos_dato['fecha_ingreso']; ?></td>
                                                                    <td><?php echo $productos_dato['email']; ?></td>
                                                                </tr>

                                                                <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                    </div>
                                    <hr>
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
                                                    <img src="<?php echo $URL."/almacen/img_productos/".$imagen; ?>" id="img_producto" width="70%" alt="">
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div style="display: flex">
                                        <h5>Datos del proveedor</h5>
                                        <div style="width: 20px"></div>
                                        <button type="button" class="btn btn-success border-transparent" data-toggle="modal"
                                                data-target="#modal-buscar_proveedor">
                                            <i class="fa fa-search"></i>
                                            Buscar proveedor
                                        </button>
                                        <!-- Modal para buscar proveedores en compras -->
                                        <div class="modal fade" id="modal-buscar_proveedor">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #0a4c98; color: #ffffff ">
                                                        <h4 class="modal-title">Busqueda del proveedor</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table id="example2" class="table table-bordered table-striped table-sm">
                                                            <thead>
                                                            <tr>
                                                                <th><center>Nro</center></th>
                                                                <th><center>Seleccionar</center></th>
                                                                <th><center>Nombre del proveedor</center></th>
                                                                <th><center>Celular</center></th>
                                                                <th><center>Teléfono</center></th>
                                                                <th><center>Empresa</center></th>
                                                                <th><center>Email</center></th>
                                                                <th><center>Dirección</center></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $contador = 0;
                                                            foreach ($proveedores_datos as $proveedores_dato){
                                                                $id_proveedor = $proveedores_dato['id_proveedor'];
                                                                $nombre_proveedor = $proveedores_dato['nombre_proveedor']; ?>
                                                                <tr>
                                                                    <td><center><?php echo $contador = $contador +1;?></center></td>
                                                                    <td>
                                                                        <button href="" class="btn btn-outline-info" id="btn_seleccionar_proveedor<?php echo $id_proveedor;?>">
                                                                            Seleccionar
                                                                        </button>
                                                                        <script>
                                                                            $('#btn_seleccionar_proveedor<?php echo $id_proveedor;?>').click(function () {
                                                                                var id_proveedor = '<?php echo $id_proveedor; ?>';
                                                                                $('#id_proveedor').val(id_proveedor);

                                                                                var nombre_proveedor = '<?php echo $nombre_proveedor; ?>';
                                                                                $('#nombre_proveedor').val(nombre_proveedor);

                                                                                var celular_proveedor = '<?php echo $proveedores_dato['celular']; ?>';
                                                                                $('#celular').val(celular_proveedor);

                                                                                var telefono_proveedor = '<?php echo $proveedores_dato['telefono']; ?>';
                                                                                $('#telefono').val(telefono_proveedor);

                                                                                var empresa_proveedor = '<?php echo $proveedores_dato['empresa']; ?>';
                                                                                $('#empresa').val(empresa_proveedor);

                                                                                var email_proveedor = '<?php echo $proveedores_dato['email']; ?>';
                                                                                $('#email').val(email_proveedor);

                                                                                var direccion_proveedor = '<?php echo $proveedores_dato['direccion']; ?>';
                                                                                $('#direccion').val(direccion_proveedor);

                                                                                $('#modal-buscar_proveedor').modal('toggle');

                                                                            });
                                                                        </script>
                                                                    </td>
                                                                    <td><?php echo $nombre_proveedor;?></td>
                                                                    <td>
                                                                        <a href="https://wa.me/+57<?php echo $proveedores_dato['celular'];?>" target="_blank" class="btn btn-outline-success border-transparent">
                                                                            <i class="fa fa-mobile-alt"></i>
                                                                            <?php echo $proveedores_dato['celular'];?></a>
                                                                    </td>
                                                                    <td><?php echo $proveedores_dato['telefono'];?></td>
                                                                    <td><?php echo $proveedores_dato['empresa'];?></td>
                                                                    <td><?php echo $proveedores_dato['email'];?></td>
                                                                    <td><?php echo $proveedores_dato['direccion'];?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            <!-- /.modal -->
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="container-fluid" style="font-size: 12px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="id_proveedor" value="<?php echo $id_proveedor_tabla; ?>" hidden>
                                                    <label for="">Nombre del proveedor</label>
                                                    <input type="text" id="nombre_proveedor" class="form-control" value="<?php echo $nombre_proveedor_tabla; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Celular</label>
                                                    <input type="number" id="celular" class="form-control" value="<?php echo $celular_proveedor; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Teléfono</label>
                                                    <input type="number" id="telefono" class="form-control" value="<?php echo $telefono_proveedor; ?>" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Empresa</label>
                                                    <input type="text" id="empresa" class="form-control" value="<?php echo $empresa; ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" id="email" class="form-control" value="<?php echo $email_proveedor; ?>" disabled>
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
                <div class="col-md-3">
                    <div class="card card-outline card-success">
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
                                        <input type="text" value="<?php echo $nro_compra; ?>" style="text-align: center" class="form-control" disabled>
                                        <input type="text" value="<?php echo $nro_compra; ?>" id="nro_compra" hidden="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Fecha de la compra</label>
                                        <input type="date" class="form-control" value="<?php echo $fecha_compra; ?>" id="fecha_compra">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Comprobante de la compra</label>
                                        <input type="text" class="form-control" value="<?php echo $comprobante; ?>" id="comprobante">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Precio de la compra</label>
                                        <input type="text" class="form-control" value="<?php echo $precio_compra; ?>" id="precio_compra_controlador">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Stock actual</label>
                                        <input type="text" id="stock_actual" style="background-color: #FFCD00FF; text-align: center" class="form-control" value="<?php echo $stock=$stock-$cantidad; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Stock total</label>
                                        <input type="text" id="stock_total" style="text-align: center" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Cantidad de la compra</label>
                                        <input type="number" id="cantidad_compra"  style="text-align: center" class="form-control" value="<?php echo $cantidad; ?>">
                                    </div>
                                    <script>
                                        $('#cantidad_compra').keyup(function () {
                                            sumacantidades();
                                        });
                                        sumacantidades();
                                        function sumacantidades (){
                                            //alert('estamos presionando el input');
                                            var stock_actual = $('#stock_actual').val();
                                            var stock_compra = $('#cantidad_compra').val();

                                            var total = parseInt(stock_actual) + parseInt(stock_compra);
                                            $('#stock_total').val(total);
                                        }
                                    </script>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Usuario</label>
                                        <input type="text" class="form-control" value="<?php echo $nombre_usuario; ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button class="btn btn-success btn-block" id="btn_actualizar_compra">Actualizar compra</button>
                                </div>
                            </div>
                            <script>
                                $('#btn_actualizar_compra').click(function () {
                                    var id_compra = <?php echo $id_compra; ?>;
                                    var id_producto = $('#id_producto').val();
                                    var nro_compra = $('#nro_compra').val();
                                    var fecha_compra = $('#fecha_compra').val();
                                    var id_proveedor = $('#id_proveedor').val();
                                    var comprobante = $('#comprobante').val();
                                    var id_usuario = '<?php echo $id_usuario_sesion;?>';
                                    var precio_compra = $('#precio_compra_controlador').val();
                                    var cantidad_compra = $('#cantidad_compra').val();
                                    var stock_total = $('#stock_total').val();

                                    if (id_producto == "") {
                                        $('#id_producto').focus();
                                        alert("Debe de llenar todos los campos");
                                    }else if(fecha_compra == ""){
                                        $('#fecha_compra').focus();
                                        alert("Debe de llenar todos los campos");
                                    }else if (comprobante == ""){
                                        $('#comprobante').focus();
                                        alert("Debe de llenar todos los campos");
                                    }else if (precio_compra == ""){
                                        $('#precio_compra_controlador').focus();
                                        alert("Debe de llenar todos los campos");
                                    }else if (cantidad_compra == ""){
                                        $('#cantidad_compra').focus();
                                        alert("Debe de llenar todos los campos");
                                    }
                                    else{
                                        var url = "../app/controllers/compras/update.php";
                                        $.get(url, {
                                            id_compra: id_compra,
                                            id_producto: id_producto,
                                            nro_compra: nro_compra,
                                            fecha_compra: fecha_compra,
                                            id_proveedor: id_proveedor,
                                            comprobante: comprobante,
                                            id_usuario: id_usuario,
                                            precio_compra: precio_compra,
                                            cantidad_compra: cantidad_compra,
                                            stock_total: stock_total
                                        }, function (datos) {
                                            $('#respuesta_update').html(datos);
                                        });
                                    }
                                });
                            </script>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div id="respuesta_update"></div>

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
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Proveedores",
                "infoEmpty": "Mostrando 0 a 0 de 0 Proveedores",
                "infoFiltered": "(Filtrado de _MAX_ total Proveedores)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Proveedores",
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



<?php

include('app/config.php'); // Incluye la configuración de la aplicación

include('layout/sesion.php'); // Incluye el archivo de sesión (manejo de sesiones de usuario)

include('layout/parte1.php'); // Incluye parte del layout específico (encabezados, menús, etc.)

include('app/controllers/usuarios/listado_de_usuarios.php'); // Incluye el controlador para listar usuarios

include('app/controllers/roles/listado_de_roles.php'); // Incluye el controlador para listar roles

include('app/controllers/categorias/listado_de_categorias.php'); // Incluye el controlador para listar las categprías

include('app/controllers/almacen/listado_de_productos.php'); // Incluye el controlador para listar los productos

include('app/controllers/proveedores/listado_de_proveedores.php'); // Incluye el controlador para listar los proveedores

?>

<script>
    // Función para mostrar el mensaje
    function mostrarMensaje() {
        Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Se ingresó de forma correcta al sistema",
            showConfirmButton: false,
            timer: 2500
        });
    }

    // Al cargar la página
    window.onload = function() {
        // Revisar si el mensaje ya se ha mostrado en esta sesión
        if (sessionStorage.getItem('mensajeMostrado') === 'true') {
            // El mensaje ya se ha mostrado, no hacer nada
        } else {
            // El mensaje no se ha mostrado, mostrarlo y actualizar la marca
            mostrarMensaje();
            sessionStorage.setItem('mensajeMostrado', 'true');
        }
    };

    // Función para eliminar el sessionStorage cuando se cierra la sesión
    function cerrarSesion() {
        sessionStorage.removeItem('mensajeMostrado');
    }
</script>

<!-- Content Wrapper. Contiene el contenido de la página -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido al Sistema de Ventas AR - <?php echo $rol_sesion; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            Contenido del sistema
            <br><br>

            <div class="row">

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <?php
                            // Contador de usuarios
                            $contador_de_usuarios = 0;
                            foreach ($usuarios_datos as $usuarios_dato) {
                                $contador_de_usuarios = $contador_de_usuarios + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_usuarios; ?></h3>
                            <p>Usuarios registrados</p>
                        </div>
                        <!-- Enlace para agregar usuario -->
                        <a href="<?php echo $URL; ?>/usuarios/create.php">
                            <div class="icon">
                                <i class="nav-icon fas fa-users"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/usuarios/" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-gray">
                        <div class="inner">
                            <?php
                            // Contador de roles
                            $contador_de_roles = 0;
                            foreach ($roles_datos as $roles_dato) {
                                $contador_de_roles = $contador_de_roles + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_roles; ?></h3>
                            <p>Roles registrados</p>
                        </div>
                        <!-- Enlace para agregar rol -->
                        <a href="<?php echo $URL; ?>/roles/create.php">
                            <div class="icon">
                                <i class="nav-icon fas fa-address-book"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/roles/" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <?php
                            // Contador de categorías
                            $contador_de_categorias = 0;
                            foreach ($categorias_datos as $categorias_dato) {
                                $contador_de_categorias = $contador_de_categorias + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_categorias; ?></h3>
                            <p>Categorías registradas</p>
                        </div>
                        <!-- Enlace para agregar categoría -->
                        <a href="<?php echo $URL; ?>/categorias">
                            <div class="icon">
                                <i class="nav-icon fas fa-tags"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/categorias" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-indigo">
                        <div class="inner">
                            <?php
                            // Contador de productos
                            $contador_de_productos = 0;
                            foreach ($productos_datos as $productos_dato) {
                                $contador_de_productos = $contador_de_productos + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_productos; ?></h3>
                            <p>Productos registrados</p>
                        </div>
                        <!-- Enlace para agregar producto -->
                        <a href="<?php echo $URL; ?>/almacen/create.php">
                            <div class="icon">
                                <i class="nav-icon fas fa-building"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/almacen" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <?php
                            // Contador de proveedores
                            $contador_de_proveedores = 0;
                            foreach ($proveedores_datos as $proveedores_dato) {
                                $contador_de_proveedores = $contador_de_proveedores + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_proveedores; ?></h3>
                            <p>Proveedores registrados</p>
                        </div>
                        <!-- Enlace para agregar proveedor -->
                        <a href="<?php echo $URL; ?>/proveedores">
                            <div class="icon">
                                <i class="nav-icon fas fa-truck"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/proveedores" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('layout/parte2.php'); ?>

<?php

// Inicio del bloque de inclusión de archivos de configuración y sesión.
include('app/config.php'); // Incluye la configuración de la aplicación
include('layout/sesion.php'); // Incluye el archivo de sesión (manejo de sesiones de usuario)
// Fin del bloque de inclusión de archivos de configuración y sesión

// Inicio del bloque de inclusión del layout y controladores
include('layout/parte1.php'); // Incluye parte del layout específico (encabezados, menús, etc.)

include('app/controllers/usuarios/listado_de_usuarios.php'); // Incluye el controlador para listar usuarios
include('app/controllers/roles/listado_de_roles.php'); // Incluye el controlador para listar roles
include('app/controllers/categorias/listado_de_categorias.php'); // Incluye el controlador para listar las categorías
include('app/controllers/almacen/listado_de_productos.php'); // Incluye el controlador para listar los productos
include('app/controllers/proveedores/listado_de_proveedores.php'); // Incluye el controlador para listar los proveedores
include('app/controllers/compras/listado_de_compras.php'); // Incluye el controlador para listar las compras
include('app/controllers/ventas/listado_de_ventas.php'); // Incluye el controlador para listar las ventas
include('app/controllers/clientes/listado_de_clientes.php'); // Incluye el controlador para listar los clientes
// Fin del bloque de inclusión del layout y controladores

?>

<script>
    // Inicio del bloque de funciones de JavaScript

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

    // Fin del bloque de funciones de JavaScript
</script>

<!-- Inicio del bloque de contenido principal -->
<div class="content-wrapper">
    <!-- Inicio del encabezado del contenido -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido al Sistema de Ventas AR - <?php echo $rol_sesion; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Fin del encabezado del contenido -->

    <!-- Inicio del contenido principal -->
    <div class="content">
        <div class="container-fluid">

            Contenido del sistema
            <br><br>

            <div class="row">

                <!-- Inicio del bloque de tarjeta de usuarios -->
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
                <!-- Fin del bloque de tarjeta de usuarios -->

                <!-- Inicio del bloque de tarjeta de roles -->
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
                <!-- Fin del bloque de tarjeta de roles -->

                <!-- Inicio del bloque de tarjeta de categorías -->
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
                <!-- Fin del bloque de tarjeta de categorías -->

                <!-- Inicio del bloque de tarjeta de productos -->
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
                <!-- Fin del bloque de tarjeta de productos -->

                <!-- Inicio del bloque de tarjeta de proveedores -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-gradient-navy">
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
                <!-- Fin del bloque de tarjeta de proveedores -->

                <!-- Inicio del bloque de tarjeta de compras -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-gradient-teal">
                        <div class="inner">
                            <?php
                            // Contador de compras
                            $contador_de_compras = 0;
                            foreach ($compras_datos as $compras_dato) {
                                $contador_de_compras = $contador_de_compras + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_compras; ?></h3>
                            <p>Compras registradas</p>
                        </div>
                        <!-- Enlace para agregar una compra -->
                        <a href="<?php echo $URL; ?>/compras/create.php">
                            <div class="icon">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/compras" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Fin del bloque de tarjeta de compras -->

                <!-- Inicio del bloque de tarjeta de ventas -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-gradient-cyan">
                        <div class="inner">
                            <?php
                            // Contador de ventas
                            $contador_de_ventas = 0;
                            foreach ($ventas_datos as $ventas_dato) {
                                $contador_de_ventas = $contador_de_ventas + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_ventas; ?></h3>
                            <p>Ventas registradas</p>
                        </div>
                        <!-- Enlace para agregar una venta -->
                        <a href="<?php echo $URL; ?>/ventas/create.php">
                            <div class="icon">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/ventas" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Fin del bloque de tarjeta de ventas -->

                <!-- Inicio del bloque de tarjeta de clientes -->
                <div class="col-lg-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <?php
                            // Contador de clientes
                            $contador_de_clientes = 0;
                            foreach ($clientes_datos as $clientes_dato) {
                                $contador_de_clientes = $contador_de_clientes + 1;
                            }
                            ?>
                            <h3><?php echo $contador_de_clientes; ?></h3>
                            <p>Clientes registrados</p>
                        </div>
                        <!-- Enlace para agregar un cliente -->
                        <a href="<?php echo $URL; ?>/clientes">
                            <div class="icon">
                                <i class="nav-icon fas fa-user-friends"></i>
                            </div>
                        </a>
                        <!-- Enlace para más información -->
                        <a href="<?php echo $URL; ?>/clientes" class="small-box-footer">
                            Más información <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <!-- Fin del bloque de tarjeta de clientes -->

            </div>
            <!-- Fin del bloque de tarjetas -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- Fin del contenido principal -->
</div>
<!-- Fin del bloque de contenido principal -->

<?php include('layout/parte2.php'); ?>

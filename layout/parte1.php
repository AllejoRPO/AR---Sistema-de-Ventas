<!DOCTYPE html>
<!--
Esta es una página de plantilla de la parte 1.
-->
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de ventas</title>

    <!-- Fuente de Google: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Iconos de Font Awesome -->
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Estilo del tema -->
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Librería de sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL;?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Barra de navegación -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Enlaces de la barra de navegación izquierda -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link">SISTEMA DE VENTAS AR</a>
            </li>
        </ul>

        <!-- Enlaces de la barra de navegación derecha -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Contenedor del Sidebar Principal -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Logo de la marca -->
        <a href="<?php echo $URL;?>" class="brand-link">
            <img src="<?php echo $URL;?>/public/images/ar.jpg" alt="Foto perfil" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Sistema de ventas AR</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Panel de usuario del Sidebar (opcional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="<?php echo $URL; ?>/usuarios/fotos/Alejo.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?php echo $nombres_sesion; ?></a>
                </div>
            </div>

            <!-- Menú del Sidebar -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Añadir iconos a los enlaces usando la clase .nav-icon con font-awesome o cualquier otra biblioteca de iconos -->

                    <!-- Usuarios -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/usuarios/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de usuarios</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/usuarios/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creación de usuarios</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Roles -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>
                                Roles
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/roles/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/roles/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creación de roles</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Categorías -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-tags"></i>
                            <p>
                                Categorías
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/categorias/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de categorías</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Almacén -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Almacén
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/almacen/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de productos</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/almacen/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creación de productos</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Compras -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                Compras
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/compras/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de compras</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/compras/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Creación de compras</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Proveedores -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-truck"></i>
                            <p>
                                Proveedores
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/proveedores/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de proveedores</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Ventas -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-shopping-basket"></i>
                            <p>
                                Ventas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/ventas/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de ventas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/ventas/create.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Realizar una venta</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Clientes -->
                    <li class="nav-item">
                        <a href="#" class="nav-link active">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Clientes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?php echo $URL; ?>/clientes/index.php" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de clientes</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Cerrar sesión -->
                    <li class="nav-item">
                        <a href="<?php echo $URL;?>/app/controllers/login/cerrar_sesion.php" class="nav-link" style="background-color: #990000">
                            <i class="nav-icon fas fa-door-closed"></i>
                            <p onclick="cerrarSesion()">
                                Cerrar sesión
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>


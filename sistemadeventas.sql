-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 11-09-2024 a las 23:57:21
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemadeventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_almacen`
--

CREATE TABLE `tb_almacen` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) DEFAULT NULL,
  `stock_maximo` int(11) DEFAULT NULL,
  `precio_compra` varchar(255) NOT NULL,
  `precio_venta` varchar(255) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `imagen` text DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_almacen`
--

INSERT INTO `tb_almacen` (`id_producto`, `codigo`, `nombre`, `descripcion`, `stock`, `stock_minimo`, `stock_maximo`, `precio_compra`, `precio_venta`, `fecha_ingreso`, `imagen`, `id_usuario`, `id_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'P-00001', 'Coca-Cola', '1,5 litros. No retornable', 46, 10, 100, '4500', '5000', '2024-07-15', '2024-07-15-16-29-18__Gaseosa-Coca-Cola-x-1.5-lt.png', 1, 1, '2024-07-15 16:29:18', '2024-07-17 14:43:43'),
(2, 'P-00002', 'Salchicha viena parrillada', '160gr. Lata por 7 unidades', 56, 10, 100, '3300', '4000', '2024-07-15', '2024-07-15-16-30-19__salchicha-zenu-parrillada-160gr.png', 1, 8, '2024-07-15 16:30:19', '2024-07-17 14:44:07'),
(6, 'P-00003', 'Arroz diana', '500gr. 1 bolsa', 46, 20, 70, '2800', '3400', '2024-07-18', '2024-07-18-08-01-52__arroz-diana-libra.png', 1, 2, '2024-07-18 08:01:52', '0000-00-00 00:00:00'),
(7, 'P-00004', 'Arroz diana con fibra', '500gr. 1 bolsa', 34, 10, 30, '3900', '4400', '2024-09-07', '2024-09-07-10-28-11__arroz-diana-fibra-bolsa-x-500-gramos.png', 1, 2, '2024-09-07 10:28:11', '0000-00-00 00:00:00'),
(8, 'P-00005', 'Whiskas gatos', 'Fillets Res. 85gr', 10, 10, 20, '2500', '2900', '2024-09-11', '2024-09-11-16-44-22__whiskas-res.png', 1, 7, '2024-09-11 16:44:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_carrito`
--

CREATE TABLE `tb_carrito` (
  `id_carrito` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_carrito`
--

INSERT INTO `tb_carrito` (`id_carrito`, `nro_venta`, `id_producto`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(14, 1, 2, 2, '2024-09-11 15:06:49', '0000-00-00 00:00:00'),
(15, 2, 2, 2, '2024-09-11 15:56:01', '0000-00-00 00:00:00'),
(16, 2, 7, 2, '2024-09-11 15:56:11', '0000-00-00 00:00:00'),
(17, 3, 8, 2, '2024-09-11 16:49:01', '0000-00-00 00:00:00'),
(18, 3, 7, 2, '2024-09-11 16:49:20', '0000-00-00 00:00:00'),
(19, 3, 1, 2, '2024-09-11 16:49:27', '0000-00-00 00:00:00'),
(20, 3, 2, 2, '2024-09-11 16:49:35', '0000-00-00 00:00:00'),
(21, 3, 6, 2, '2024-09-11 16:49:44', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_categorias`
--

CREATE TABLE `tb_categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_categorias`
--

INSERT INTO `tb_categorias` (`id_categoria`, `nombre_categoria`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'LIQUIDOS', '2024-07-10 14:33:11', '2024-07-10 14:33:11'),
(2, 'GRANOS', '2024-07-10 09:31:39', '0000-00-00 00:00:00'),
(3, 'MEDICAMENTOS', '2024-07-10 09:40:15', '0000-00-00 00:00:00'),
(4, 'FRUTAS Y VERDURAS', '2024-07-10 09:41:42', '2024-07-11 07:38:57'),
(5, 'CUIDADO DEL HOGAR', '2024-07-10 09:53:43', '0000-00-00 00:00:00'),
(6, 'CUIDADO DEL PERSONAL', '2024-07-10 10:47:30', '0000-00-00 00:00:00'),
(7, 'MASCOTAS', '2024-07-10 14:03:41', '0000-00-00 00:00:00'),
(8, 'ENLATADOS', '2024-07-10 14:05:42', '0000-00-00 00:00:00'),
(9, 'LACTEOS', '2024-07-11 07:40:13', '0000-00-00 00:00:00'),
(10, 'LICORES', '2024-07-11 12:04:22', '2024-07-11 12:05:04'),
(12, 'CARNES FRIAS', '2024-07-15 16:34:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_clientes`
--

CREATE TABLE `tb_clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(255) NOT NULL,
  `nit_ci_cliente` varchar(255) NOT NULL,
  `celular_cliente` varchar(50) NOT NULL,
  `email_cliente` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_clientes`
--

INSERT INTO `tb_clientes` (`id_cliente`, `nombre_cliente`, `nit_ci_cliente`, `celular_cliente`, `email_cliente`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Pamela Molina', '1040518401', '3136980177', 'pamelapandita@gmail.com', '2024-09-07 18:19:30', '2024-09-07 18:19:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_compras`
--

CREATE TABLE `tb_compras` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nro_compra` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `comprobante` varchar(255) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio_compra` varchar(50) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_compras`
--

INSERT INTO `tb_compras` (`id_compra`, `id_producto`, `nro_compra`, `fecha_compra`, `id_proveedor`, `comprobante`, `id_usuario`, `precio_compra`, `cantidad`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 7, 1, '2024-09-07', 3, 'Factura 000001', 1, '78000', 20, '2024-09-07 10:31:11', '2024-09-07 10:31:58'),
(2, 7, 2, '2024-09-07', 3, 'Factura 000002', 1, '78000', 20, '2024-09-07 10:46:41', '0000-00-00 00:00:00'),
(3, 8, 3, '2024-09-11', 4, 'Factura 000003', 1, '30000', 12, '2024-09-11 16:48:36', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_proveedores`
--

CREATE TABLE `tb_proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(255) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `empresa` varchar(255) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_proveedores`
--

INSERT INTO `tb_proveedores` (`id_proveedor`, `nombre_proveedor`, `celular`, `telefono`, `empresa`, `email`, `direccion`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Alejandro Restrepo', '3042068566', '2733187', 'Coca-Cola Company', 'alejandrorpo@gmail.com', 'calle 111 # 66 - 34', '2024-07-18 18:02:49', '2024-09-07 10:28:53'),
(2, 'Wilson Paniagua', '3217774455', '2558800', 'Zenú S.A.S', 'wilson@gmail.com', 'Calle 121 # 55 - 88', '2024-09-07 10:29:28', '0000-00-00 00:00:00'),
(3, 'Gloria Jiménez', '3136269867', '2733187', 'Diana S.A.S', 'gloria@gmail.com', 'Calle 67A # 11 - 22', '2024-09-07 10:30:10', '0000-00-00 00:00:00'),
(4, 'Ester Viloria', '3028370044', '4076622', 'Puppis S.A.S', 'esterpuppis@gmail.com', 'Carrera 44C # 77 - 91', '2024-09-11 16:46:41', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_roles`
--

CREATE TABLE `tb_roles` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_roles`
--

INSERT INTO `tb_roles` (`id_rol`, `rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'ADMINISTRADOR', '2024-07-09 15:20:03', '2024-07-09 15:20:03'),
(2, 'VENDEDOR', '2024-07-09 09:12:00', '2024-07-09 10:08:14'),
(3, 'CONTADOR', '2024-07-09 10:55:20', '0000-00-00 00:00:00'),
(4, 'TIENDA', '2024-07-09 11:50:02', '2024-07-11 12:02:25'),
(5, 'ALMACEN', '2024-07-11 12:02:58', '0000-00-00 00:00:00'),
(6, 'PROVEEDOR ALMACEN', '2024-07-12 14:58:53', '2024-07-12 14:59:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_user` text NOT NULL,
  `token` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `nombres`, `email`, `password_user`, `token`, `id_rol`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 'Alejandro Restrepo', 'alejandro@gmail.com', '$2y$10$4KA38VQpXOS3zrJx17sv4.axd9z5xTRgnqcrZrQZUVU1Zfzl8rKkC', '', 1, '2024-07-09 15:20:52', '2024-07-09 15:20:52'),
(2, 'Pamela Molina', 'pamelamolina@gmail.com', '$2y$10$4KA38VQpXOS3zrJx17sv4.axd9z5xTRgnqcrZrQZUVU1Zfzl8rKkC', '', 3, '2024-07-09 15:22:47', '2024-07-09 12:40:28'),
(3, 'Dulce Maria', 'dulcemaria@gmail.com', '$2y$10$UVIG.jbdjxIM/5vNr4LLT.N4t52I.7YRe0VYNrTUO.gXiPzXOwWPO', '', 4, '2024-07-09 11:06:57', '2024-07-09 12:27:15'),
(5, 'Oreo Restrepo Molina', 'oreo@gmail.com', '$2y$10$7T45KRa.ul/jENkTfPuIJuVJmbnZ1OVTpqKRV/IooAutg8MmMo6Ge', '', 4, '2024-07-11 12:01:27', '0000-00-00 00:00:00'),
(6, 'Gloria Arango', 'gloria@gmail.com', '$2y$10$HVRfOntA6MInk2v5WY8W8Oh.DD7PmRnxvpftFBpx2cWfW6yPO4lY6', '', 3, '2024-07-12 14:47:20', '2024-07-12 14:52:08'),
(7, 'Pedro Restrepo', 'pedro@gmail.com', '$2y$10$zrOBEg6T3P1r4YO9Kb7K8uuH28vMPngL0qkKdEvEGt6z33RWFbn6q', '', 4, '2024-07-12 14:55:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ventas`
--

CREATE TABLE `tb_ventas` (
  `id_venta` int(11) NOT NULL,
  `nro_venta` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total_pagado` int(11) NOT NULL,
  `fyh_creacion` datetime NOT NULL,
  `fyh_actualizacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tb_ventas`
--

INSERT INTO `tb_ventas` (`id_venta`, `nro_venta`, `id_cliente`, `total_pagado`, `fyh_creacion`, `fyh_actualizacion`) VALUES
(1, 1, 1, 8000, '2024-09-11 15:07:04', '0000-00-00 00:00:00'),
(2, 2, 1, 16800, '2024-09-11 15:56:31', '0000-00-00 00:00:00'),
(3, 3, 1, 39400, '2024-09-11 16:51:24', '0000-00-00 00:00:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_venta` (`nro_venta`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`) USING BTREE,
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `nro_venta` (`nro_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tb_clientes`
--
ALTER TABLE `tb_clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_roles`
--
ALTER TABLE `tb_roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD CONSTRAINT `tb_almacen_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_almacen_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_carrito`
--
ALTER TABLE `tb_carrito`
  ADD CONSTRAINT `tb_carrito_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  ADD CONSTRAINT `tb_compras_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `tb_proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `tb_almacen` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_compras_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tb_roles` (`id_rol`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `tb_ventas`
--
ALTER TABLE `tb_ventas`
  ADD CONSTRAINT `tb_ventas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `tb_clientes` (`id_cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_ventas_ibfk_2` FOREIGN KEY (`nro_venta`) REFERENCES `tb_carrito` (`nro_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

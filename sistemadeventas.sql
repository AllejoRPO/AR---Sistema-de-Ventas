-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 26-08-2024 a las 21:56:21
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
(1, 'P-00001', 'Coca cola sabor original', '1,5 litros. No retornable', 60, 50, 100, '4500', '5000', '2024-07-15', '2024-07-15-16-29-18__Gaseosa-Coca-Cola-x-1.5-lt.png', 1, 1, '2024-07-15 16:29:18', '2024-08-06 14:40:57'),
(2, 'P-00002', 'Salchicha viena parrillada', '160gr. Lata por 7 unidades', 52, 20, 50, '3300', '4000', '2024-07-15', '2024-07-15-16-30-19__salchicha-zenu-parrillada-160gr.png', 1, 8, '2024-07-15 16:30:19', '2024-07-17 14:44:07'),
(6, 'P-00003', 'Arroz diana con fibra', '500gr. 1 bolsa', 45, 30, 70, '3800', '4400', '2024-07-19', '2024-07-19-10-28-39__arroz-diana-fibra-bolsa-x-500-gramos.png', 1, 2, '2024-07-18 08:01:52', '2024-07-22 09:56:05'),
(7, 'P-00004', 'Arroz diana del blanco', '500gr. 1 bolsa', 30, 20, 50, '2400', '2900', '2024-08-26', '2024-08-26-10-40-11__arroz-diana-libra.png', 1, 2, '2024-08-26 10:40:11', '2024-08-26 13:44:34');

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
(1, 'Líquidos', '2024-07-10 14:33:11', '2024-07-22 09:53:18'),
(2, 'Granos', '2024-07-10 09:31:39', '2024-07-22 09:51:04'),
(3, 'Medicamentos', '2024-07-10 09:40:15', '2024-07-22 09:51:14'),
(4, 'Frutas y verduras', '2024-07-10 09:41:42', '2024-07-22 09:51:27'),
(5, 'Cuidado del hogar', '2024-07-10 09:53:43', '2024-07-22 09:51:38'),
(6, 'Cuidado personal', '2024-07-10 10:47:30', '2024-07-22 09:51:56'),
(7, 'Mascotas', '2024-07-10 14:03:41', '2024-07-22 09:52:08'),
(8, 'Enlatados', '2024-07-10 14:05:42', '2024-07-22 09:52:22'),
(9, 'Lácteos', '2024-07-11 07:40:13', '2024-07-22 09:53:00'),
(10, 'Licores', '2024-07-11 12:04:22', '2024-07-22 09:54:37'),
(12, 'Carnes frías', '2024-07-15 16:34:55', '2024-07-22 09:55:20');

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
(1, 1, 1, '2024-08-26', 1, 'Factura 000001', 1, '270000', 60, '2024-08-26 13:38:28', '0000-00-00 00:00:00'),
(2, 2, 2, '2024-08-26', 6, 'Factura 000002', 1, '171600', 52, '2024-08-26 13:39:24', '0000-00-00 00:00:00'),
(3, 6, 3, '2024-08-26', 8, 'Factura 000003', 1, '171000', 45, '2024-08-26 13:42:52', '0000-00-00 00:00:00'),
(4, 7, 4, '2024-08-26', 8, 'Factura 000004', 1, '72000', 30, '2024-08-26 13:43:37', '0000-00-00 00:00:00');

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
(1, 'Alejandro Rpo', '3232949929', '2733187', 'Coca-Cola Company', 'alejandro@gmail.com', 'Calle 111 # 66 - 34', '2024-07-18 18:02:49', '2024-08-26 10:45:26'),
(2, 'Pamela Pandita', '3136980177', '2733311', 'Cárnicos Fazán', 'pandita@gmail.com', 'Calle 69a crr 98 - 88', '2024-07-18 14:57:25', '2024-08-26 10:45:18'),
(6, 'Wilson Paniagua', '3234442299', '2738888', 'Zenú S.A.S', 'wilson@gmail.com', 'Calle 111 # 77 - 05', '2024-07-19 12:07:47', '2024-08-26 10:44:47'),
(7, 'Liliana Molina', '3234127600', '2665500', 'Fazán S.A.', 'lilimoli@gmail.com', 'Calle 134 # 55 - 00', '2024-07-19 12:17:27', '2024-08-26 10:44:38'),
(8, 'Gloria Jiménez', '3136269867', '2733187', 'Diana S.A.S', 'gloria@gmail.com', 'Calle 108 # 55- 09', '2024-08-26 10:43:58', '0000-00-00 00:00:00');

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
(1, 'Alejandro Restrepo', 'alejandro@gmail.com', '$2y$10$4KA38VQpXOS3zrJx17sv4.axd9z5xTRgnqcrZrQZUVU1Zfzl8rKkC', '', 1, '2024-07-09 15:20:52', '2024-07-26 13:27:23'),
(2, 'Pamela Molina', 'pamelamolina@gmail.com', '$2y$10$4KA38VQpXOS3zrJx17sv4.axd9z5xTRgnqcrZrQZUVU1Zfzl8rKkC', '', 3, '2024-07-09 15:22:47', '2024-07-09 12:40:28'),
(3, 'Dulce Maria', 'dulcemaria@gmail.com', '$2y$10$UVIG.jbdjxIM/5vNr4LLT.N4t52I.7YRe0VYNrTUO.gXiPzXOwWPO', '', 4, '2024-07-09 11:06:57', '2024-07-09 12:27:15');

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
-- Indices de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  ADD PRIMARY KEY (`id_categoria`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tb_categorias`
--
ALTER TABLE `tb_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tb_compras`
--
ALTER TABLE `tb_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tb_proveedores`
--
ALTER TABLE `tb_proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tb_almacen`
--
ALTER TABLE `tb_almacen`
  ADD CONSTRAINT `tb_almacen_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id_categoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_almacen_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

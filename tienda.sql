-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-06-2025 a las 04:34:55
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenes`
--

CREATE TABLE `ordenes` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `folio` varchar(20) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ordenes`
--

INSERT INTO `ordenes` (`id`, `usuario_id`, `folio`, `total`, `fecha`) VALUES
(1, 1, '7PFBIRJNSE3T01LGVWK4', '33.00', '2025-06-12 19:54:18'),
(2, 2, '8SC3XPK5WH2GMVE4L1UQ', '45.00', '2025-06-12 20:03:53'),
(3, 2, 'IZATNU0G3MRDVH6P9281', '21.00', '2025-06-12 20:06:08'),
(4, 2, '9HR1AO2QPK5ENY4LIFJZ', '21.00', '2025-06-12 20:17:44'),
(5, NULL, 'H785POI6ZDS3MU9BKENR', '10.00', '2025-06-12 20:21:17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_items`
--

CREATE TABLE `orden_items` (
  `id` int(11) NOT NULL,
  `orden_id` int(11) DEFAULT NULL,
  `producto_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orden_items`
--

INSERT INTO `orden_items` (`id`, `orden_id`, `producto_id`, `nombre`, `precio`, `cantidad`) VALUES
(1, 1, 1, 'Producto 1', '10.00', 1),
(2, 1, 2, 'Producto 2', '11.00', 1),
(3, 1, 3, 'Producto 3', '12.00', 1),
(4, 2, 1, 'Producto 1', '10.00', 1),
(5, 2, 2, 'Producto 2', '11.00', 1),
(6, 2, 3, 'Producto 3', '12.00', 2),
(7, 3, 1, 'Producto 1', '10.00', 1),
(8, 3, 2, 'Producto 2', '11.00', 1),
(9, 4, 1, 'Producto 1', '10.00', 1),
(10, 4, 2, 'Producto 2', '11.00', 1),
(11, 5, 1, 'Producto 1', '10.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `nombre_cliente` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `folio` varchar(20) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `imagen`) VALUES
(1, 'Producto 1', '10.00', 'prod1.jpg'),
(2, 'Producto 2', '11.00', 'prod1.jpg'),
(3, 'Producto 3', '12.00', 'prod1.jpg'),
(4, 'Producto 4', '13.00', 'prod1.jpg'),
(5, 'Producto 5', '14.00', 'prod1.jpg'),
(6, 'Producto 6', '15.00', 'prod1.jpg'),
(7, 'Producto 7', '16.00', 'prod1.jpg'),
(8, 'Producto 8', '17.00', 'prod1.jpg'),
(9, 'Producto 9', '18.00', 'prod1.jpg'),
(10, 'Producto 10', '19.00', 'prod1.jpg'),
(11, 'Producto 11', '20.00', 'prod1.jpg'),
(12, 'Producto 12', '21.00', 'prod1.jpg'),
(13, 'Producto 13', '22.00', 'prod1.jpg'),
(14, 'Producto 14', '23.00', 'prod1.jpg'),
(15, 'Producto 15', '24.00', 'prod1.jpg'),
(16, 'Producto 16', '25.00', 'prod1.jpg'),
(17, 'Producto 17', '26.00', 'prod1.jpg'),
(18, 'Producto 18', '27.00', 'prod1.jpg'),
(19, 'Producto 19', '28.00', 'prod1.jpg'),
(20, 'Producto 20', '29.00', 'prod1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(5) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `rol` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `rol`, `password`, `email`) VALUES
(1, 'Juanito Bananas Silva', 'Admin', '$2y$10$7d/16yuLyFPrVvIrkD0pUuOZBwGJkZqK2/bkpytKU9jnkmp1fDMtC', 'bananasmesilva@mail.com '),
(2, 'Chabelo Silva Mesta', 'Admin', '$2y$10$7d/16yuLyFPrVvIrkD0pUuOZBwGJkZqK2/bkpytKU9jnkmp1fDMtC', 'chabelo@mail.com ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- Indices de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `folio` (`folio`);

--
-- Indices de la tabla `orden_items`
--
ALTER TABLE `orden_items`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ordenes`
--
ALTER TABLE `ordenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `orden_items`
--
ALTER TABLE `orden_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

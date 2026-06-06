-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 06-06-2026 a les 16:06:23
-- Versió del servidor: 10.4.32-MariaDB
-- Versió de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de dades: `sweet_kingdom`
--

-- --------------------------------------------------------

--
-- Estructura de la taula `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `email`, `password`, `rol`) VALUES
(27, 'Alejandro', 'alejandrozambranofp@ibf.cat', 'informatica_1', 'usuario'),
(28, 'Alejandro', 'zambranoalecs@gmail.com', '$2y$10$EKuCsS8RCbrM9', 'usuario'),
(29, 'Alejandro', 'alejandrozt2704@gmail.com', '$2y$10$kOuvTgzGpMXkV', 'usuario'),
(30, 'Alejandro', 'lalejandrozt@gmail.com', '$2y$10$WnzNz.X7HnQQA', 'usuario'),
(31, 'Alejandrio', 'zalejandro048@gmail.com', '$2y$10$fDS36g9EJbHFp', 'usuario'),
(32, 'Alejandro', 'ttvzambranoalecs@gmail.com', '$2y$10$JL83uslr47typltFRlMAGulHq7.4vopZss8zGoFRcV4Aulr0b.9/y', 'usuario'),
(33, 'Alejandro', 'joseangle@gmail.com', '$2y$10$D47x5NDEjI0M/HtLUXx.x.RlozxK5CrZJrjUk5gxZiqpzWTpz6ddO', 'usuario'),
(35, 'Alejandro Zambrano', 'alejandro@gmail.com', '$2y$10$NzoGYMs9EEolLyo9Xv6l3OKgDZM3lE.WtOo19zL6LkvbIAW1DvLV2', 'admin'),
(36, 'alejandro27', 'ale@gmail.com', '$2y$10$m7QKl5WpUVbQ0tDgDyWMLe6BXAFYcpsisJsnNUU8T9TpwQbA8pwvq', 'usuario'),
(37, 'link', 'link@gmail.com', '$2y$10$EQFun9ErJxgDheE6b4adzekWMdUuWAeOUVMoQp9iYFkO.nJDCSuO2', 'usuario'),
(38, 'mario', 'mario@gmail.com', '$2y$10$TtJJvJOyY31Cg5s2R3G4XOk8p3VOsOrQ1MSCtxTxOqzL43ZKRumkS', 'usuario');

-- --------------------------------------------------------

--
-- Estructura de la taula `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `id_pedido`, `id_producto`, `cantidad`, `precio_unitario`, `subtotal`) VALUES
(1, 1, 1, 1, 22.00, 22.00),
(2, 1, 2, 1, 25.50, 25.50),
(3, 1, 10, 1, 18.00, 18.00),
(4, 1, 9, 1, 15.00, 15.00),
(5, 1, 11, 1, 29.90, 29.90),
(6, 2, 4, 1, 6.50, 6.50),
(7, 3, 7, 1, 3.50, 3.50),
(8, 3, 2, 1, 25.50, 25.50),
(9, 3, 3, 1, 4.50, 4.50),
(10, 3, 11, 1, 29.95, 29.95),
(11, 4, 1, 1, 22.00, 22.00),
(12, 4, 2, 1, 25.50, 25.50),
(13, 4, 5, 1, 3.90, 3.90),
(14, 5, 1, 3, 22.00, 66.00),
(15, 5, 6, 2, 8.00, 16.00),
(16, 5, 7, 1, 3.50, 3.50),
(17, 5, 8, 1, 7.00, 7.00),
(18, 5, 5, 1, 3.90, 3.90),
(19, 5, 10, 1, 18.00, 18.00),
(20, 5, 9, 1, 15.00, 15.00),
(21, 5, 4, 1, 6.50, 6.50),
(22, 5, 3, 1, 4.50, 4.50),
(23, 6, 16, 1, 221.99, 221.99),
(24, 7, 16, 1, 221.99, 221.99);

-- --------------------------------------------------------

--
-- Estructura de la taula `logs`
--

CREATE TABLE `logs` (
  `id_log` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `accion` varchar(255) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `logs`
--

INSERT INTO `logs` (`id_log`, `usuario`, `accion`, `fecha`) VALUES
(1, 'alejandro@gmail.com', 'Pedido confirmado con ID 1', '2026-05-30 09:07:01'),
(2, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 09:41:37'),
(3, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 09:41:40'),
(4, 'alejandro@gmail.com', 'Producto creado: Producto Test Admin', '2026-05-30 09:43:06'),
(5, 'alejandro@gmail.com', 'Producto eliminado con ID 12', '2026-05-30 09:44:24'),
(6, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 10:02:10'),
(7, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 10:02:14'),
(8, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 10:02:16'),
(9, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 10:02:19'),
(10, 'alejandro@gmail.com', 'Producto creado: alejandro', '2026-05-30 10:14:07'),
(11, 'alejandro@gmail.com', 'Producto eliminado con ID 13', '2026-05-30 10:14:15'),
(12, 'alejandro@gmail.com', 'Producto actualizado con ID 11', '2026-05-30 10:16:42'),
(13, 'ale@gmail.com', 'Pedido confirmado con ID 2', '2026-06-05 18:15:58'),
(14, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 2 a Preparando', '2026-06-05 18:27:51'),
(15, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 2 a Enviado', '2026-06-05 18:27:54'),
(16, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 2 a Entregado', '2026-06-05 18:27:57'),
(17, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 2 a Cancelado', '2026-06-05 18:27:59'),
(18, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 2 a Entregado', '2026-06-05 18:28:02'),
(19, 'link@gmail.com', 'Pedido confirmado con ID 3', '2026-06-05 19:27:00'),
(20, 'link@gmail.com', 'Pedido confirmado con ID 4', '2026-06-05 19:27:25'),
(21, 'alejandro@gmail.com', 'Producto creado: alejandro', '2026-06-05 19:28:33'),
(22, 'alejandro@gmail.com', 'Producto actualizado con ID 14', '2026-06-05 19:29:05'),
(23, 'alejandro@gmail.com', 'Producto eliminado con ID 14', '2026-06-05 19:29:21'),
(24, 'alejandro@gmail.com', 'Producto creado: alejandro', '2026-06-05 19:29:41'),
(25, 'alejandro@gmail.com', 'Producto eliminado con ID 15', '2026-06-05 19:30:20'),
(26, 'mario@gmail.com', 'Pedido confirmado con ID 5', '2026-06-05 20:39:08'),
(27, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 5 a Preparando', '2026-06-05 20:39:32'),
(28, 'alejandro@gmail.com', 'Producto creado: alejandro', '2026-06-05 20:39:51'),
(29, 'alejandro@gmail.com', 'Pedido confirmado con ID 6', '2026-06-05 20:40:27'),
(30, 'alejandro@gmail.com', 'Producto actualizado con ID 16', '2026-06-06 15:45:57'),
(31, 'alejandro@gmail.com', 'Pedido confirmado con ID 7', '2026-06-06 15:46:09');

-- --------------------------------------------------------

--
-- Estructura de la taula `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL,
  `estado` varchar(50) NOT NULL DEFAULT 'Confirmado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `fecha`, `total`, `estado`) VALUES
(1, 35, '2026-05-30 09:07:01', 110.40, 'Preparando'),
(2, 36, '2026-06-05 18:15:58', 6.50, 'Entregado'),
(3, 37, '2026-06-05 19:27:00', 63.45, 'Confirmado'),
(4, 37, '2026-06-05 19:27:25', 51.40, 'Confirmado'),
(5, 38, '2026-06-05 20:39:08', 140.40, 'Preparando'),
(6, 35, '2026-06-05 20:40:27', 221.99, 'Confirmado'),
(7, 35, '2026-06-06 15:46:09', 221.99, 'Confirmado');

-- --------------------------------------------------------

--
-- Estructura de la taula `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria` enum('Tartas','Cupcakes','Postres','Ofertas') DEFAULT 'Postres',
  `oferta` tinyint(1) DEFAULT 0,
  `stock` int(11) DEFAULT 10,
  `franquicia` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Bolcament de dades per a la taula `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria`, `oferta`, `stock`, `franquicia`) VALUES
(1, 'Kirby Dream Cake Pinker Edition', 'Tarta ultra esponjosa de color rosa con sabor a fresa silvestre.', 22.00, 'kirbycake.png', 'Tartas', 0, 10, NULL),
(2, 'Power Star Mario Galaxy cake', 'Tarta con forma de estrella y sabor a vainilla estelar.', 25.50, 'powerstarcake.png', 'Tartas', 0, 10, NULL),
(3, 'Donkey Kong Banana donuts', 'Donuts bañados en chocolate con crema de plátano tropical.', 4.50, 'dkbananadonuts.png', 'Postres', 0, 10, NULL),
(4, 'Metroid Crema Glass Edicion Especial Samus', 'Postre de cristal de azúcar con crema de menta y lima.', 6.50, 'metroidcremaglass.png', 'Postres', 0, 10, NULL),
(5, 'Bowser ChocoBrownie', 'Brownie de chocolate negro intenso con un toque picante de canela.', 3.90, 'bowserchocobrownie.png', 'Postres', 0, 10, NULL),
(6, 'Pikaflan Box', 'Caja con 4 flanes de vainilla con detalles de chocolate y mejillas de cereza.', 8.00, 'pikaflan.png', 'Postres', 0, 10, NULL),
(7, 'Mario Bros Sweet Roll', 'Rollito dulce relleno de nata y fresas del Reino Champiñón.', 3.50, 'mariosweetrol.png', 'Postres', 0, 10, NULL),
(8, 'The Legend of Zelda: Tears of the Kingdom Dessert', 'Postre místico con capas de chocolate blanco y té matcha.', 7.00, 'zeldatotkdessert.png', 'Postres', 0, 10, NULL),
(9, 'Power up Dessert Pack', 'Pack variado para recuperar energías: incluye donuts y brownies.', 15.00, 'powerupdessert.png', 'Ofertas', 0, 10, NULL),
(10, 'Animal Crossing Cozy cupcakes Pack', 'Pack de 6 cupcakes hogareños con decoraciones de frutas.', 18.00, 'animalcrossingcozycupcakes.png', 'Cupcakes', 0, 10, NULL),
(11, 'Link\'s Sweet Adventure Pack', 'El pack definitivo para aventureros con todos nuestros dulces estrella.', 29.95, 'linksweetadventure.png', 'Ofertas', 0, 10, ''),
(16, 'alejandro', 'Producto creado desde el panel admin', 221.99, 'logo_header.svg', 'Postres', 1, 0, 'mario');

--
-- Índexs per a les taules bolcades
--

--
-- Índexs per a la taula `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Índexs per a la taula `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Índexs per a la taula `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id_log`);

--
-- Índexs per a la taula `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Índexs per a la taula `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT per les taules bolcades
--

--
-- AUTO_INCREMENT per la taula `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT per la taula `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT per la taula `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la taula `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la taula `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restriccions per a les taules bolcades
--

--
-- Restriccions per a la taula `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedido` (`id_pedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`);

--
-- Restriccions per a la taula `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

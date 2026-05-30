-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Temps de generació: 30-05-2026 a les 10:05:24
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
(35, 'Alejandro Zambrano', 'alejandro@gmail.com', '$2y$10$SGScZlCVeB9.ILfqeM.R6uw5X/PZXyqak/jQq8Z9X3TEs7p0oe.U2', 'admin');

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
(5, 1, 11, 1, 29.90, 29.90);

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
(9, 'alejandro@gmail.com', 'Estado actualizado del pedido ID 1 a Preparando', '2026-05-30 10:02:19');

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
(1, 35, '2026-05-30 09:07:01', 110.40, 'Preparando');

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
(8, 'The Legend of Zelda; Tears of the Kingdom Dessert', 'Postre místico con capas de chocolate blanco y té matcha.', 7.00, 'zeldatotkdessert.png', 'Postres', 0, 10, NULL),
(9, 'Power up Dessert Pack', 'Pack variado para recuperar energías: incluye donuts y brownies.', 15.00, 'powerupdessert.png', 'Ofertas', 0, 10, NULL),
(10, 'Animal Crossing Cozy cupcakes Pack', 'Pack de 6 cupcakes hogareños con decoraciones de frutas.', 18.00, 'animalcrossingcozycupcakes.png', 'Cupcakes', 0, 10, NULL),
(11, 'Link\'s Sweet Adventure Pack', 'El pack definitivo para aventureros con todos nuestros dulces estrella.', 29.90, 'linksweetadventure.png', 'Ofertas', 0, 10, NULL);

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
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT per la taula `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la taula `logs`
--
ALTER TABLE `logs`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT per la taula `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la taula `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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

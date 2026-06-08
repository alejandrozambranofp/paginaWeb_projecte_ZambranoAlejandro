-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 08-06-2026 a las 16:22:51
-- Versión del servidor: 8.0.46
-- Versión de PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sweet_kingdom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_general_ci,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `categoria` enum('Tartas','Cupcakes','Postres','Ofertas') COLLATE utf8mb4_general_ci DEFAULT 'Postres',
  `oferta` tinyint(1) DEFAULT '0',
  `stock` int DEFAULT '10',
  `franquicia` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria`, `oferta`, `stock`, `franquicia`) VALUES
(1, 'Kirby Dream Cake Pinker Edition', 'Tarta ultra esponjosa de color rosa con sabor a fresa silvestre.', 22.00, 'kirbycake.png', 'Tartas', 0, 10, 'Kirby'),
(2, 'Power Star Mario Galaxy cake', 'Tarta con forma de estrella y sabor a vainilla estelar.', 25.50, 'powerstarcake.png', 'Tartas', 0, 10, 'Mario'),
(3, 'Donkey Kong Banana donuts', 'Donuts bañados en chocolate con crema de plátano tropical.', 4.50, 'dkbananadonuts.png', 'Postres', 0, 10, 'Donkey Kong'),
(4, 'Metroid Crema Glass Edicion Especial Samus', 'Postre de cristal de azúcar con crema de menta y lima.', 6.50, 'metroidcremaglass.png', 'Postres', 0, 10, 'Metroid'),
(5, 'Bowser ChocoBrownie', 'Brownie de chocolate negro intenso con un toque picante de canela.', 3.90, 'bowserchocobrownie.png', 'Postres', 0, 10, 'Mario'),
(6, 'Pikaflan Box', 'Caja con 4 flanes de vainilla con detalles de chocolate y mejillas de cereza.', 8.00, 'pikaflan.png', 'Postres', 0, 10, 'Pokemon'),
(7, 'Mario Bros Sweet Roll', 'Rollito dulce relleno de nata y fresas del Reino Champiñón.', 3.50, 'mariosweetrol.png', 'Postres', 0, 10, 'Mario'),
(8, 'The Legend of Zelda: Tears of the Kingdom Dessert', 'Postre místico con capas de chocolate blanco y té matcha.', 7.00, 'zeldatotkdessert.png', 'Postres', 0, 10, 'Zelda'),
(9, 'Power up Dessert Pack', 'Pack variado para recuperar energías: incluye donuts y brownies.', 15.00, 'powerupdessert.png', 'Ofertas', 0, 10, 'Mario'),
(10, 'Animal Crossing Cozy cupcakes Pack', 'Pack de 6 cupcakes hogareños con decoraciones de frutas.', 18.00, 'animalcrossingcozycupcakes.png', 'Cupcakes', 0, 10, 'Animal Crossing'),
(11, 'Link\'s Sweet Adventure Pack', 'El pack definitivo para aventureros con todos nuestros dulces estrella.', 29.95, 'linksweetadventure.png', 'Ofertas', 0, 10, 'Zelda'),
(16, 'alejandro', 'Producto creado desde el panel admin', 221.99, 'logo_header.svg', 'Postres', 1, 0, 'mario');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

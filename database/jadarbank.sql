-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 26-10-2022 a las 09:33:14
-- Versión del servidor: 8.0.30-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `jadarbank`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fena` date NOT NULL,
  `curp` varchar(19) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_client` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codPostal` int NOT NULL,
  `estado` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pais` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` bigint NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `num_client` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `status` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `name`, `fena`, `curp`, `img_client`, `domicilio`, `codPostal`, `estado`, `ciudad`, `pais`, `tel`, `email`, `pass`, `num_client`, `role`, `status`) VALUES
(1, 'Fatima Marin Meza', '2003-05-08', 'MAMF030508MJCrzta6', 'aaaa.jpg', 'Mi casa', 28865, 'Colima', 'Manzanillo', 'Mexico', 3143991293, 'fmarin0@gmail.com', '$2y$10$TLhVZTyFJ6LVlDxziG22z.zo/KJMML5tBfhKkpFuMXsSFNtbR2FhO', 'AC1', 'user', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int NOT NULL,
  `num_client` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `saldo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivo`
--

CREATE TABLE `ejecutivo` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fena` date NOT NULL,
  `curp` varchar(19) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img_client` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `domicilio` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `codPostal` int NOT NULL,
  `estado` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tel` bigint NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `num_empleado` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `role` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ejecutivo`
--

INSERT INTO `ejecutivo` (`id`, `name`, `fena`, `curp`, `img_client`, `domicilio`, `codPostal`, `estado`, `ciudad`, `pais`, `tel`, `email`, `pass`, `num_empleado`, `role`) VALUES
(1, 'Jesus Emmanuel Hernandez Torres', '2003-08-15', 'HETJ030815HDFRRSA3', 'pardo.jpg', 'Fraccionamiento valle paraiso valle de las granadas #279', 28865, 'Colima', 'Manzanillo', 'Mexico', 3143767148, 'jesus@gmail.com', '$2y$10$jKpxz88KkRtHq.xjrCxQ6u9D7vmR6JdKLWVY5pUVRJ0YmtPyDUBWO', 'AEJ1', 'admin'),
(2, 'Mitzi Fabiola R. Don Juan Ramos', '2003-10-10', 'RXRM031010MCMXMTA9', 'mitzi.jpg', 'Ancillas #506', 28869, 'Sinaloa', 'Mazatlan', 'Mexico', 3141249293, 'mrdonjuan@ucol.mx', '$2y$10$.fZBfjIwMi7PezMye7PLAOrZz2XfLHEi2xlrcRdOqrFf5LmVUFG3K', 'BEF2', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int NOT NULL,
  `num_cliente` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cant` float NOT NULL,
  `fecha` date NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int NOT NULL,
  `num_client` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `monto` float NOT NULL,
  `iteres` int NOT NULL,
  `plazo_meses` int NOT NULL,
  `fe_asignado` date NOT NULL,
  `fe_pago` date NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_cliente` (`num_client`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num_cliente` (`num_client`);

--
-- Indices de la tabla `ejecutivo`
--
ALTER TABLE `ejecutivo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_cliente` (`num_cliente`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_cliente` (`num_client`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejecutivo`
--
ALTER TABLE `ejecutivo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD CONSTRAINT `cuenta_ibfk_1` FOREIGN KEY (`num_client`) REFERENCES `cliente` (`num_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`num_cliente`) REFERENCES `cuenta` (`num_client`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`num_client`) REFERENCES `cuenta` (`num_client`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

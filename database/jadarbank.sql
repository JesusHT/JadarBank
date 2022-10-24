-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-10-2022 a las 20:27:52
-- Versión del servidor: 8.0.30-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jadarbank`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `fena` date DEFAULT NULL,
  `curp` varchar(19) DEFAULT NULL,
  `img_client` varchar(50) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `codPostal` int DEFAULT NULL,
  `estado` text,
  `municipio` text,
  `pais` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `tel` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `num_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `num_empleado` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int NOT NULL,
  `num_cliente` varchar(255) DEFAULT NULL,
  `saldo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivo`
--

CREATE TABLE `ejecutivo` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `edad` int DEFAULT NULL,
  `fena` date DEFAULT NULL,
  `curp` varchar(19) DEFAULT NULL,
  `img_client` varchar(50) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `codPostal` int DEFAULT NULL,
  `estado` text,
  `municipio` text,
  `pais` varchar(50) DEFAULT NULL,
  `tel` bigint DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `num_empleado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ejecutivo`
--

INSERT INTO `ejecutivo` (`id`, `name`, `edad`, `fena`, `curp`, `img_client`, `domicilio`, `codPostal`, `estado`, `municipio`, `pais`, `tel`, `email`, `pass`, `num_empleado`) VALUES
(1, 'Jesus Emmanuel Hernandez Torres', 19, '2003-08-15', 'HETJ030815HDFRRSA3', 'pardo.jpg', 'Fraccionamiento valle paraiso valle de las granadas #279', 28865, 'Colima', 'Manzanillo', 'Mexico', 3143767148, 'jesus@gmail.com', '$2y$10$jKpxz88KkRtHq.xjrCxQ6u9D7vmR6JdKLWVY5pUVRJ0YmtPyDUBWO', 'AEJ1'),
(2, 'Mitzi Fabiola R. Don Juan Ramos', 18, '2003-10-10', 'RXRM031010MCMXMTA9', 'mitzi.jpg', 'Ancillas #506', 28869, 'Sinaloa', 'Mazatlan', 'Mexico', 3141249293, 'mrdonjuan@ucol.mx', '$2y$10$.fZBfjIwMi7PezMye7PLAOrZz2XfLHEi2xlrcRdOqrFf5LmVUFG3K', 'BEF2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int NOT NULL,
  `num_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `cant` float NOT NULL,
  `fecha` date NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int NOT NULL,
  `num_cliente` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `monto` float NOT NULL,
  `iteres` int NOT NULL,
  `plazo_meses` int NOT NULL,
  `fe_asignado` date NOT NULL,
  `fe_pago` date NOT NULL,
  `saldo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_cliente` (`num_cliente`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `num_cliente` (`num_cliente`);

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
  ADD KEY `num_cliente` (`num_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`num_cliente`) REFERENCES `cuenta` (`num_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`num_cliente`) REFERENCES `cuenta` (`num_cliente`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `prestamos_ibfk_1` FOREIGN KEY (`num_cliente`) REFERENCES `cuenta` (`num_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

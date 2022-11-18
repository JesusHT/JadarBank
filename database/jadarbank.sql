-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 18-11-2022 a las 00:39:55
-- Versión del servidor: 8.0.31-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.8

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
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `fena` date NOT NULL,
  `curp` varchar(19) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img_client` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `domicilio` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `codPostal` int NOT NULL,
  `estado` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ciudad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pais` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tel` bigint NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `num_client` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `status` enum('activo','inactivo','pendiente') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `name`, `fena`, `curp`, `img_client`, `domicilio`, `codPostal`, `estado`, `ciudad`, `pais`, `tel`, `email`, `pass`, `num_client`, `role`, `status`) VALUES
(4, 'Jose Miguel Alvarado Gonzales', '2022-10-11', 'AMGJ030920HDFRRSA2', 'Asus.jpg', 'Fraccionamiento Valle Pariso calle valle de las granadas #279', 28865, 'Colima', 'Manzanillo', 'México', 3143767148, 'jose@gmail.com', '$2y$10$xfDI4hAu79C0t.pN5y1osupUmZ5D.rv5cwOtf6YFJu3aLOh8BFnii', 'AC1', 'user', 'activo'),
(5, 'Joel Gutierrez Domiguez', '2022-10-10', 'AfaGJ030920Hdsjk21', 'Asus.jpg', 'Fraccionamiento Valle Pariso calle valle de las granadas #279', 28899, 'Afghanistan', 'Baglan', 'Afganistán', 3143767148, 'joel@gmail.com', '$2y$10$KiFxILazbNKq7.HDeaYNpe5EAIj10qpwnEubH0WxzSnhSVK905HYS', 'AC5', 'user', 'activo'),
(6, 'Juanito El Huerfanito', '2022-11-21', 'AMGJ030920HDFRRSA2', 'Asus.jpg', 'Fraccionamiento Valle Pariso calle valle de las granadas #279', 28865, 'México', 'Albarrada', 'México', 3143767148, 'juan@gmail.com', '$2y$10$KvUMCbCHtHtsfSWAsSlnKu6KntFSljvmakzFSQsxtQAXnK1dgWRNe', 'AC7', 'user', 'inactivo'),
(10, 'Maria Guadalupe', '2002-01-08', 'AMGJ030920HDFRRSA2', 'prueba (copia).jpg', 'Fraccionamiento Valle Pariso calle valle de las granadas #279', 28865, 'Diber', 'Ali Hanit', 'Albania', 3143767148, 'mario12@gmail.com', '$2y$10$oQT83vztZkI1UnXpku5dX.yraTFFTHkqDmynkJBvlM7CC7alUsnPq', 'AC10', 'user', 'inactivo'),
(11, 'Jairo Preaciado Ayala', '2003-03-01', 'AMGJ030920HDFRRSA2', 'prueba (4.ª copia).jpg', 'Fraccionamiento Valle Pariso calle valle de las granadas #279', 28865, 'Berat', 'Agalli', 'Albania', 3143767148, 'jairo@gmail.com', '$2y$10$FcfuywP6r6YOhNjzz/1trepXYqccs67c5QcREli2Bxu.bb.FEDP0u', 'AC11', 'user', 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int NOT NULL,
  `num_client` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `num_cuenta` bigint NOT NULL,
  `saldo` double DEFAULT NULL,
  `credito` double NOT NULL,
  `usado` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `num_client`, `num_cuenta`, `saldo`, `credito`, `usado`) VALUES
(1, 'AC1', 111001123456789121, 10000, 2000, 0),
(2, 'AC5', 111001321205065539, 10000, 2000, 0),
(4, 'AC10', 111001877771473741, 0, 2000, 0),
(5, 'AC11', 111001824828154101, 0, 2000, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejecutivo`
--

CREATE TABLE `ejecutivo` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fena` date DEFAULT NULL,
  `curp` varchar(19) DEFAULT NULL,
  `img_client` varchar(50) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `codPostal` int DEFAULT NULL,
  `estado` text,
  `ciudad` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `pais` varchar(50) DEFAULT NULL,
  `tel` bigint DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `num_empleado` varchar(255) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL,
  `status` enum('activo','inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ejecutivo`
--

INSERT INTO `ejecutivo` (`id`, `name`, `fena`, `curp`, `img_client`, `domicilio`, `codPostal`, `estado`, `ciudad`, `pais`, `tel`, `email`, `pass`, `num_empleado`, `role`, `status`) VALUES
(1, 'Jesus Emmanuel Hernandez Torres', '2003-08-15', 'HETJ030815HDFRRSA3', 'pardo.jpg', 'Fraccionamiento valle paraiso valle de las granadas #279', 28865, 'Colima', 'Manzanillo', 'Mexico', 3143767148, 'jesus@gmail.com', '$2y$10$jKpxz88KkRtHq.xjrCxQ6u9D7vmR6JdKLWVY5pUVRJ0YmtPyDUBWO', 'AEJ1', 'admin', 'activo'),
(2, 'Mitzi Fabiola R. Don Juan Ramos', '2003-10-10', 'RXRM031010MCMXMTA9', 'mitzi.jpg', 'Ancillas #506', 28869, 'Sinaloa', 'Mazatlan', 'Mexico', 3141249293, 'mrdonjuan@ucol.mx', '$2y$10$.fZBfjIwMi7PezMye7PLAOrZz2XfLHEi2xlrcRdOqrFf5LmVUFG3K', 'BEF2', 'admin', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guardados`
--

CREATE TABLE `guardados` (
  `id` int NOT NULL,
  `num_client` varchar(50) NOT NULL,
  `clabeInterbancaria` bigint NOT NULL,
  `alias` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `num_client` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `num_prestamo` varchar(55) NOT NULL,
  `monto` float NOT NULL,
  `interes` float NOT NULL,
  `plazo` int NOT NULL,
  `fe_asignado` date NOT NULL,
  `status` enum('pendiente','pagado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
-- Indices de la tabla `guardados`
--
ALTER TABLE `guardados`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ejecutivo`
--
ALTER TABLE `ejecutivo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `guardados`
--
ALTER TABLE `guardados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

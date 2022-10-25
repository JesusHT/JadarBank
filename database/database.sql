-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 21-10-2022 a las 20:27:43
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
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fena` date NOT NULL,
  `curp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_client` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `codPostal` int NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `municipio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` bigint NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_client` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('activo','inactivo') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `fena`, `curp`, `img_client`, `domicilio`, `codPostal`, `estado`, `municipio`, `pais`, `tel`, `email`, `pass`, `num_client`, `role`, `status`) VALUES
(7, 'Jairo Preciado Ayala', '2003-08-15', 'HETJ030815HDFRRSA3', './img.jpg', 'Fraccionamiento valle paraiso', 28865, '', 'Manzanillo', 'Mexico', 3143767148, 'jesus@gmail.com', '$2y$10$FmeAx4vegR6qna8ILPDV5OhFhJmrlxJogYl146A8af6Zot4RwmaXa', 'AE815', 'admin', 'activo'),
(10, 'q1wertyuiop', '2004-12-06', '1234567890QWERTY', 'Asus.jpg', 'asdfghjk', 12345, 'Manzanillo', 'ASDFGHJ', 'sxsdfgh', 1234567890123456, 'asdfghjk@gmail.com', '$2y$10$NtPX34Bv47XMt/S4ObFKrOU0CVSr7arzttdjmOEGji5VyAx0Wy1.S', 'AC10', 'user', 'activo'),
(11, 'aaaaa', '2004-11-29', 'Q12W3E4R5T6Y7U8I', './img.jpg', 'aqswedrf', 12345, '', 'qaswedrft', 'q12we3rf', 1234567890, 'QWERTY@gmail.com', '$2y$10$8HZEpquXcAiubt7zs4EPru0xe0UtZwNYb.o30E8O0WzwVRyfwoipW', 'AC11', 'user', 'activo'),
(12, 'wretrytrehttg', '2004-12-14', 'ZXCVBNMASDFERWTQ', './img.jpg', 'cdfdergt', 55443, '', 'swdefrgt', 'defrgt', 1122334455, 'jairoqwerty@gmail.com', '$2y$10$/SFJiwiMiIsiNkwl7w9JAe3fPbJZfI2J.UFcLtAIxdzIaCtWclSMi', 'AC12', 'user', 'activo'),
(13, 'aqqaqaccc', '2004-12-23', 'QWEASDZXCRTYHGFV', './img.jpg', 'srxzxdtcfybhnj', 998, '', 'qarfcxytw', 'decbqbw', 1029384756, 'qaswedrfgthyuj@gmail.com', '$2y$10$2C9OB870Q9uZxq19KMX6h.iNvNVK0kkZRzNYn/IK/0L6a3nSL4BMS', 'AC13', 'user', 'activo'),
(14, 'aqqaqaqa', '2004-12-14', '1Q2W3E4R5T6Y7U8I', './img.jpg', 'qaswdvfgdb', 11111, '', 'htthreth', 'hthtererr', 1112223334, 'a@ucol.mx', '$2y$10$DbxuDq.EnUf1p.97Ung2vuAHUvhbAtyHC3aH601sOqBSmgpSKY/UK', 'AC14', 'user', 'activo'),
(15, 'ASUDBUA dsfgs', '2004-12-06', 'QQ', './img.jpg', 'aqswdefrgthy', 12345, '', 'wdfrgdthfj', 'ftyef', 1212343456, 'aq@ucol.mx', '$2y$10$4bJxlhW2a/dJpM9qNCIDDOEx6t0IRlNyxWgpK5pBVBXXk5cZXsaBu', 'AC15', 'user', 'activo'),
(16, 'qwadqwqf qwdqwd', '2004-12-07', 'AQSWDEFRGTHYJUKI', './img.jpg', 'aqswderbfhngmjf', 123312, '', 'qweqwda', 'aaaaa', 1112227689, 'qwasrf@ucol.mx', '$2y$10$V2WnYvdkp.bcf6asWQugaOvbNdP2sOazpwv9Ud0Wqt/xcbn9EBRBe', 'AC16', 'user', 'activo'),
(17, 'jairo pa', '2004-12-08', 'AQSWDEFRGTHYNHMJ', './img.jpg', 'qec', 55555, '', 'vwervew', 'nytnbdt', 1234567891, 'aqmk@ucol.mx', '$2y$10$5bZoevpZqyqwvmFIBkPCHONS1fIUNf6urw.BGEhWpr87s/KxxtXky', 'AC17', 'user', 'activo'),
(18, 'sera', '2004-12-08', 'AQSWDEFRGTHYUJKI', 'Asus.jpg', 'aqswedrfgt', 48987, 'Jalisco', 'Atoyac', 'Mexico', 1234567890, 'mjuy@gmail.com', '$2y$10$QOiUlwn4eYs7Idk9AbuNkeokVnAWoxg2cbkFQ2DRM3u0HfUTPb2fq', 'AC18', 'user', 'activo'),
(19, 'Jesus Hernandez', '2004-12-13', 'HETJ030815HDFRRSA3', 'Asus.jpg', 'Fraccionamiento valle paraiso', 28865, 'Colima', 'Manzanillo', 'Mexico', 3143767148, 'jesus123@gmail.com', '$2y$10$UnC0MvoKvTd27qB8QwwUkuTltX59gSz4W.8yK0I.Vp38N6ozZXO6C', 'AC19', 'user', 'activo'),
(20, 'Jose', '2022-10-11', 'HEIDKSLJLK', './DSADA', 'MI CASA', 1231, 'Colima', 'Manzanillo', 'Mexico', 1231412412, 'jesus111@gmail.com', '123103', 'B123', 'user', 'activo'),
(21, 'Mitzi Fabiola R. Don Juan Ramos', '2022-10-24', 'HETJ030815HDFRRSA3', '', 'Fraccionamiento valle paraiso', 28865, 'Guerrero', 'AtoyacdeAlvarez', 'Mexico', 124124, 'jesus43211gta@gmail.com', '', 'AC21', 'user', 'activo'),
(22, 'Jose', '2022-08-23', 'HETJ030815HDFRRSA3', '', 'Fraccionamiento valle paraiso', 28865, 'Guanajuato', 'Guanajuato', 'Mexico', 33472323, 'jose1@gmail.com', '$2y$10$s15Sh.GEIgOVCTotLduHIeVjGoDOnMdqKBtIxDB3q7/T2VIlrxTzS', 'AC22', 'user', 'activo'),
(23, 'Juan Pablo', '2003-02-10', 'HETJ030815HDFRRSA3', 'Asus.jpg', 'Fraccionamiento valle paraiso', 28865, 'Guerrero', 'AyutladelosLibres', 'Mexico', 123442423, 'juanp@gmail.com', '$2y$10$QAwI2ah3gq1VASaPT.sk5e6pkS.RU1ccEjAYYBdk8022zr73nNeYi', 'AC23', 'user', 'activo'),
(24, 'Enrique Rosales Busquets', '1950-10-09', '123456789123456789', '', 'naranjo 12', 8869, 'Durango', 'Inde', 'Mexico', 312134567, 'busquets@ucol.mx', '$2y$10$n7QwNUVT6xmW4ue4cBVWge5ykCYouGhm4lS8QQNsb2Z.87ffK2yi6', 'AC24', 'user', 'activo'),
(25, 'jairo preciado', '2004-12-01', 'PEAJ030129HNRYRA3', 'pardo.jpg', 'CASA VERDE 45', 48987, 'Jalisco', 'Ayutla', 'Mexico', 1234567890, 'jairo1243@gmail.com', '$2y$10$v6pp8fzeSpPLpNQZp8LWOOly.BDCoo8BxQGUt4FCliEv9eEyVYMa.', 'AC25', 'user', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

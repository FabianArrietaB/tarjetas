-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-08-2023 a las 01:08:54
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tarjetas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `porcentajes`
--

CREATE TABLE `porcentajes` (
  `id_porcentaje` int(11) NOT NULL,
  `por_tipo` varchar(50) NOT NULL,
  `por_mes` float NOT NULL,
  `por_tipR` varchar(50) NOT NULL,
  `por_AID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `porcentajes`
--

INSERT INTO `porcentajes` (`id_porcentaje`, `por_tipo`, `por_mes`, `por_tipR`, `por_AID`) VALUES
(1, 'VISA DEBITO', 0.0174, 'VISA', 'A0000000031010'),
(2, 'VISA CREDITO (CR)', 0.0174, 'VISA', 'A0000000031010'),
(3, 'VISA ELECTRON DEBITO (AH)', 0.0177, 'VISA', 'A0000000032010'),
(4, 'VISA ELECTRON CREDITO', 0.0174, 'VISA', ''),
(5, 'MASTERCARD CREDITO', 0.0184, 'MASTERCARD', ''),
(6, 'MAESTRO DEBITO (AH)', 0.0166, 'MASTERCARD', ''),
(7, 'MAESTRO CREDITO', 0.0184, 'MASTERCARD', ''),
(8, 'AMERICAN EXPRESSS AMEX', 0.026, 'VISA', ''),
(9, 'TARJETA EXITO - TUYA', 0.025, 'EXITO BANCO', ''),
(10, 'TARJETA OLIMPICA', 0.025, 'OLIMPICA BANCOLOMBIA', ''),
(11, 'MASTERCARD DEBITO', 0.0184, 'MASTERCARD', ''),
(12, 'VISA DEBIT', 0.0175, 'VISA', ''),
(13, 'DINNER CLUB', 0, 'DAVIVIENDA', ''),
(14, 'MAESTRO DEBITO (AH) CAJAMAG', 0.0184, 'MASTERCARD', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id_registro` int(11) NOT NULL,
  `id_operador` int(11) NOT NULL,
  `reg_numticket` varchar(50) NOT NULL,
  `reg_tipcuenta` int(11) NOT NULL,
  `reg_valor` float NOT NULL,
  `reg_iva` float NOT NULL,
  `reg_rtefte` float DEFAULT NULL,
  `reg_rteiva` float DEFAULT NULL,
  `reg_rteica` float DEFAULT NULL,
  `reg_comision` float DEFAULT NULL,
  `reg_tardesc` float DEFAULT NULL,
  `reg_banco` float DEFAULT NULL,
  `reg_diferencia` float DEFAULT NULL,
  `reg_fecope` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id_registro`, `id_operador`, `reg_numticket`, `reg_tipcuenta`, `reg_valor`, `reg_iva`, `reg_rtefte`, `reg_rteiva`, `reg_rteica`, `reg_comision`, `reg_tardesc`, `reg_banco`, `reg_diferencia`, `reg_fecope`) VALUES
(1, 1, '3053', 11, 90000, 14370, NULL, NULL, NULL, NULL, 5060, NULL, 84940, '2023-07-31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `porcentajes`
--
ALTER TABLE `porcentajes`
  ADD PRIMARY KEY (`id_porcentaje`);

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id_registro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `porcentajes`
--
ALTER TABLE `porcentajes`
  MODIFY `id_porcentaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

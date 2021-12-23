-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-12-2021 a las 12:48:42
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas_medicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `aprobado` enum('SI','NO','','') NOT NULL DEFAULT 'NO',
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `doctor_id`, `paciente_id`, `aprobado`, `fecha`, `hora`) VALUES
(1, 1, 1, 'SI', '2021-12-22', NULL),
(2, 1, 1, 'NO', '2021-12-22', NULL),
(3, 1, 10, 'NO', '0000-00-00', '17:34:00'),
(5, 1, NULL, 'NO', '0000-00-00', '17:34:00'),
(6, 1, NULL, 'NO', '2021-12-22', '17:34:00'),
(7, 1, 1, 'NO', '2021-12-22', '17:34:00'),
(8, 1, 1, 'SI', '2021-12-22', '17:34:00'),
(9, 1, NULL, 'SI', '0000-00-00', '00:00:00'),
(10, 1, NULL, 'NO', '0000-00-00', '00:00:00'),
(11, 1, NULL, 'NO', '0000-00-00', '00:00:00'),
(12, 1, NULL, 'NO', '0000-00-00', '00:00:00'),
(13, 1, NULL, 'NO', '0000-00-00', '00:00:00'),
(14, 1, NULL, 'NO', '0000-00-00', '00:00:00'),
(15, 1, NULL, 'NO', '0000-00-00', '00:00:00'),
(16, 1, 1, 'NO', '0000-00-00', '17:34:00'),
(17, 1, 1, 'NO', '0000-00-00', '17:34:00'),
(18, 1, NULL, 'NO', '2021-12-22', '17:34:00'),
(19, 1, 1, 'NO', '2021-12-22', '17:34:00'),
(20, 1, 1, 'NO', '2021-12-22', '17:34:00'),
(22, 1, 1, 'NO', '2021-12-22', '17:34:00'),
(23, 1, 1, 'NO', '2021-12-22', '17:34:00'),
(24, 1, 1, 'NO', '2021-12-23', '17:34:00'),
(25, 1, 1, 'NO', '2021-12-23', '17:34:00'),
(26, 1, 1, 'NO', '2021-12-23', '17:34:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id` int(11) NOT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id`, `cedula`, `nombre`) VALUES
(1, '151515', 'edgar molina'),
(2, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `cedula` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `nombre`, `cedula`) VALUES
(1, 'bamba', '18778540'),
(2, 'abraham', '18778541'),
(5, 'adgar', '13778543'),
(6, 'abraham', '18778543'),
(17, 'abraham', '1878854'),
(19, 'abraham', '187885'),
(20, 'abraham', '18788'),
(22, 'abraham', '1878'),
(32, 'abraham', '1878999');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

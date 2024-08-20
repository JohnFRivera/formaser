-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 03:16:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `formaserv2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id` bigint(20) NOT NULL,
  `identidad` bigint(20) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ficha` bigint(20) DEFAULT NULL,
  `programa` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT 'preinscrito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculado`
--

CREATE TABLE `matriculado` (
  `id` bigint(20) NOT NULL,
  `identidad` bigint(20) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `ficha` bigint(20) DEFAULT NULL,
  `programa` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_inscrito`
--

CREATE TABLE `pre_inscrito` (
  `id` bigint(20) NOT NULL,
  `tipo` varchar(11) DEFAULT NULL,
  `identidad` bigint(20) DEFAULT NULL,
  `poblacion` varchar(255) DEFAULT 'sin registrar',
  `ficha` bigint(20) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT 'sin registrar'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pre_inscrito`
--

INSERT INTO `pre_inscrito` (`id`, `tipo`, `identidad`, `poblacion`, `ficha`, `empresa`) VALUES
(45, 'CC', 8901234567, 'Desplazado', 108, 'sin registrar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `identidad` bigint(20) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `identidad`, `nombre`, `apellido`, `correo`, `password`) VALUES
(1, 1006318723, 'andres', 'alzate', 'kevin@gmail.com', '$2y$10$Gh0l1MZkP0zZu/rd.GKrs.V7XElEjet1hH55icDzuhFx8Uf5ClPva');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_inscripcion_ficha` (`ficha`);

--
-- Indices de la tabla `matriculado`
--
ALTER TABLE `matriculado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_matriculado_ficha` (`ficha`);

--
-- Indices de la tabla `pre_inscrito`
--
ALTER TABLE `pre_inscrito`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ficha` (`ficha`),
  ADD KEY `idx_pre_inscrito_identidad` (`identidad`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `matriculado`
--
ALTER TABLE `matriculado`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pre_inscrito`
--
ALTER TABLE `pre_inscrito`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

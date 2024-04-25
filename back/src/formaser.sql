-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2024 at 07:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `formaser`
--

-- --------------------------------------------------------

--
-- Table structure for table `inscripciones`
--

CREATE TABLE `inscripciones` (
  `Codigo_Ficha` bigint(20) NOT NULL,
  `Programa_Formacion` varchar(255) DEFAULT NULL,
  `Identificacion` bigint(20) DEFAULT NULL,
  `Nombre` varchar(350) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insripcionaspirantes`
--

CREATE TABLE `insripcionaspirantes` (
  `Identificacion` bigint(20) NOT NULL,
  `Tipo_Identificacion` varchar(150) DEFAULT NULL,
  `Codigo_Ficha` bigint(20) DEFAULT NULL,
  `Tipo_Poblacion` int(11) DEFAULT NULL,
  `Codigo_Empresa` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matriculas`
--

CREATE TABLE `matriculas` (
  `Codigo_Ficha` bigint(20) NOT NULL,
  `Programa_Formacion` varchar(255) DEFAULT NULL,
  `Identificacion` bigint(20) DEFAULT NULL,
  `Nombre` varchar(350) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipos_de_poblaciones`
--

CREATE TABLE `tipos_de_poblaciones` (
  `Id` int(11) NOT NULL,
  `Descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tipos_de_poblaciones`
--

INSERT INTO `tipos_de_poblaciones` (`Id`, `Descripcion`) VALUES
(1, 'ABANDONO O DESPOJO FORZADO DE TIERRAS'),
(2, 'ACTOS TERRORISTA/ATENTADOS/COMBATES/ENFRENTAMIENTOS/HOSTIGAMIENTOS'),
(3, 'ADOLESCENTE DESVINCULADO DE GRUPOS ARMADOS ORGANIZ'),
(4, 'ADOLESCENTE EN CONFLICTO CON LA LEY PENAL'),
(5, 'ADOLESCENTE TRABAJADOR'),
(6, 'AMENAZA'),
(7, 'ARTESANOS'),
(8, 'CAMPESINO'),
(9, 'DELITOS CONTRA LA LIBERTAD Y LA INTEGRIDAD SEXUAL EN DESARROLLO DEL CONFLICTO ARMADO'),
(10, 'DESAPARICIÓN FORZADA'),
(11, 'DESPLAZADOS DISCAPACITADOS'),
(12, 'DESPLAZADOS POR FENÓMENOS NATURALES CABEZA DE FAMI'),
(13, 'DESPLAZADOS POR LA VIOLENCIA'),
(14, 'DISCAPACIDAD INTELECTUAL'),
(15, 'DISCAPACIDAD AUDITIVA'),
(16, 'DISCAPACIDAD FÍSICA'),
(17, 'DISCAPACIDAD VISUAL'),
(18, 'DISCAPACIDAD PSICOSOCIAL'),
(19, 'DISCAPACIDAD MÚLTIPLE'),
(20, 'SORDOCEGUERA'),
(21, 'EMPRENDEDORES'),
(22, 'HERIDO'),
(23, 'HOMICIDIO / MASACRE'),
(24, 'INPEC'),
(25, 'JOVENES VULNERABLES'),
(26, 'MICROEMPRESAS'),
(27, 'MINAS ANTIPERSONAL MUNICIÓN SIN EXPLOTAR Y ARTEFACTO EXPLOSIVO IMPROVISADO'),
(28, 'MUJER CABEZA DE FAMILIA'),
(29, 'NINGUNA'),
(30, 'PERSONAS EN PROCESO DE REINTEGRACIÓN'),
(31, 'RECLUTAMIENTO FORZADO'),
(32, 'REMITIDOS POR EL CIE'),
(33, 'REMITIDOS POR EL PAL'),
(34, 'SECUESTRO'),
(35, 'SOBREVIVIENTES MINAS ANTIPERSONALES'),
(36, 'SOLDADOS CAMPESINOS'),
(37, 'TERCERA EDAD'),
(38, 'TORTURA'),
(39, 'VINCULACIÓN DE NIÑOS NIÑAS Y ADOLESCENTES A ACTIVIDADES RELACIONADAS CON GRUPOS ARMADOS'),
(40, 'DESPLAZADOS POR LA VIOLENCIA CABEZA DE FAMILIA');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `Identificacion` bigint(20) NOT NULL,
  `Nombre` varchar(255) DEFAULT NULL,
  `Apellido` varchar(255) DEFAULT NULL,
  `Correo` varchar(255) DEFAULT NULL,
  `password` varchar(10000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`Codigo_Ficha`);

--
-- Indexes for table `insripcionaspirantes`
--
ALTER TABLE `insripcionaspirantes`
  ADD PRIMARY KEY (`Identificacion`),
  ADD KEY `Tipo_Poblacion` (`Tipo_Poblacion`);

--
-- Indexes for table `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`Codigo_Ficha`);

--
-- Indexes for table `tipos_de_poblaciones`
--
ALTER TABLE `tipos_de_poblaciones`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Identificacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tipos_de_poblaciones`
--
ALTER TABLE `tipos_de_poblaciones`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `insripcionaspirantes`
--
ALTER TABLE `insripcionaspirantes`
  ADD CONSTRAINT `insripcionaspirantes_ibfk_1` FOREIGN KEY (`Tipo_Poblacion`) REFERENCES `tipos_de_poblaciones` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

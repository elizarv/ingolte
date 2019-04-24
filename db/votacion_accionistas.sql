-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2019 a las 18:15:13
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `votacion_accionistas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accionistas`
--

CREATE TABLE `accionistas` (
  `cedula` varchar(100) NOT NULL,
  `nombre` varchar(500) NOT NULL,
  `acciones` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidato`
--

CREATE TABLE `candidato` (
  `nombre` varchar(100) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lista`
--

CREATE TABLE `lista` (
  `fecha` year(4) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `fecha` year(4) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `representante_cc` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_voto`
--

CREATE TABLE `registro_voto` (
  `cedula` varchar(20) NOT NULL,
  `fecha` year(4) NOT NULL,
  `fecha_lista` year(4) DEFAULT NULL,
  `voto1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accionistas`
--
ALTER TABLE `accionistas`
  ADD PRIMARY KEY (`cedula`);

--
-- Indices de la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`cedula`,`numero`,`fecha`),
  ADD KEY `FK_id` (`fecha`,`numero`);

--
-- Indices de la tabla `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`fecha`,`numero`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`cedula`,`fecha`),
  ADD KEY `FK_rep` (`representante_cc`);

--
-- Indices de la tabla `registro_voto`
--
ALTER TABLE `registro_voto`
  ADD PRIMARY KEY (`cedula`,`fecha`),
  ADD KEY `fecha_lista` (`fecha_lista`,`voto1`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `FK_id` FOREIGN KEY (`fecha`,`numero`) REFERENCES `lista` (`fecha`, `numero`);

--
-- Filtros para la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD CONSTRAINT `FK_cc` FOREIGN KEY (`cedula`) REFERENCES `accionistas` (`cedula`),
  ADD CONSTRAINT `FK_rep` FOREIGN KEY (`representante_cc`) REFERENCES `accionistas` (`cedula`);

--
-- Filtros para la tabla `registro_voto`
--
ALTER TABLE `registro_voto`
  ADD CONSTRAINT `registro_voto_ibfk_1` FOREIGN KEY (`fecha_lista`,`voto1`) REFERENCES `lista` (`fecha`, `numero`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

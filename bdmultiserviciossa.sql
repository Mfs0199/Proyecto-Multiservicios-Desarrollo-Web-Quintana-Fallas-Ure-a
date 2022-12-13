-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2022 a las 00:35:40
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdmultiserviciossa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos_usuario`
--

CREATE TABLE `contactos_usuario` (
  `IDCONTACTO` int(11) NOT NULL,
  `NOMBRE` varchar(150) NOT NULL,
  `CORREO` varchar(100) NOT NULL,
  `ASUNTO` varchar(150) NOT NULL,
  `COMENTARIO` varchar(500) NOT NULL,
  `RESPUESTA` varchar(500) DEFAULT NULL,
  `FCREACION` datetime NOT NULL DEFAULT current_timestamp(),
  `IDUSUARIO_EDITA` int(11) DEFAULT NULL,
  `FMODIFICACION` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `IDSERVICIO` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`IDSERVICIO`, `NOMBRE`) VALUES
(1, 'Construcción'),
(2, 'Remodelación'),
(3, 'Mantenimientos preventivos y correctivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IDUSUARIO` int(11) NOT NULL,
  `NOMCOMPLETO` varchar(150) NOT NULL,
  `CORREO` varchar(100) NOT NULL,
  `TIPO_USUARIO` int(11) NOT NULL,
  `CLAVE` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IDUSUARIO`, `NOMCOMPLETO`, `CORREO`, `TIPO_USUARIO`, `CLAVE`) VALUES
(1, 'Melany Fallas Sevilla', 'melanyfallas8@gmail.com', 1, 'Password1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos_usuario`
--
ALTER TABLE `contactos_usuario`
  ADD PRIMARY KEY (`IDCONTACTO`),
  ADD KEY `FK_IDUSUARIO` (`IDUSUARIO_EDITA`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IDUSUARIO`),
  ADD UNIQUE KEY `CORREO` (`CORREO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos_usuario`
--
ALTER TABLE `contactos_usuario`
  MODIFY `IDCONTACTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IDUSUARIO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos_usuario`
--
ALTER TABLE `contactos_usuario`
  ADD CONSTRAINT `FK_IDUSUARIO` FOREIGN KEY (`IDUSUARIO_EDITA`) REFERENCES `usuarios` (`IDUSUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

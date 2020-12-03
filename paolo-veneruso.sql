-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-12-2020 a las 14:21:47
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `paolo-veneruso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polihorarioinstalaciones`
--

CREATE TABLE `polihorarioinstalaciones` (
  `id` int(11) NOT NULL,
  `dia_semana` tinyint(4) DEFAULT NULL,
  `hora_inicio` char(5) DEFAULT NULL,
  `hora_fin` char(5) DEFAULT NULL,
  `idInstalacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `polihorarioinstalaciones`
--

INSERT INTO `polihorarioinstalaciones` (`id`, `dia_semana`, `hora_inicio`, `hora_fin`, `idInstalacion`) VALUES
(1, 1, '9:00', '17:00', 1),
(2, 2, '9:00', '17:00', 1),
(3, 3, '9:00', '17:00', 1),
(4, 4, '7:00', '17:00', 1),
(5, 5, '9:00', '17:00', 1),
(6, 6, '9:00', '12:00', 1),
(7, 0, '9:00', '12:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliinstalaciones`
--

CREATE TABLE `poliinstalaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `precioHora` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliinstalaciones`
--

INSERT INTO `poliinstalaciones` (`id`, `nombre`, `descripcion`, `imagen`, `precioHora`) VALUES
(1, 'Piscina', 'Piscina olimpica de 10 carriles y 50 metros.', 'img/instalaciones/1.jpg', '5.30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polireservas`
--

CREATE TABLE `polireservas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliroles`
--

CREATE TABLE `poliroles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliroles`
--

INSERT INTO `poliroles` (`id`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Estándar'),
(3, 'Deshabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliusuarios`
--

CREATE TABLE `poliusuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasenya` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `borrado` enum('si','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliusuarios`
--

INSERT INTO `poliusuarios` (`id`, `usuario`, `contrasenya`, `email`, `nombre`, `apellido1`, `apellido2`, `dni`, `imagen`, `borrado`) VALUES
(1, 'admin', 'admin', 'admin@admin.admin', 'Paolo', 'Veneruso', 'Rodriguez', '77159467X', 'img/usuarios/admin.jpg', 'no'),
(3, 'admin23', 'admin23', 'admin@admin.admin23', 'adminf', 'admin', 'admins', '77159467X', 'img/usuarios/admin23.jpg', 'si'),
(4, 'admin234', 'admin234', 'admin@admin.assssssssssssssssssdmin23', 'admin', 'admind', 'admin', '77159467X', 'img/usuarios/admin234.jpg', 'no'),
(5, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/usuarios/admin.jpg', 'si'),
(6, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/usuarios/admin23.jpg', 'si'),
(7, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/usuarios/admin23.jpg', 'si'),
(8, 'Paolo', 'paolo', 'paolo@gmail.com', 'Paolo', 'Veneruso', 'RodrÃ­guez', '77159467X', 'img/usuarios/Paolo.jpg', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliusuariosroles`
--

CREATE TABLE `poliusuariosroles` (
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliusuariosroles`
--

INSERT INTO `poliusuariosroles` (`idUsuario`, `idRol`) VALUES
(1, 1),
(1, 2),
(3, 3),
(4, 1),
(4, 2),
(8, 1),
(8, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `polihorarioinstalaciones`
--
ALTER TABLE `polihorarioinstalaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poliinstalaciones`
--
ALTER TABLE `poliinstalaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `polireservas`
--
ALTER TABLE `polireservas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poliroles`
--
ALTER TABLE `poliroles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poliusuarios`
--
ALTER TABLE `poliusuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `poliusuariosroles`
--
ALTER TABLE `poliusuariosroles`
  ADD PRIMARY KEY (`idUsuario`,`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

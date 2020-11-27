-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2020 a las 22:44:02
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.2.33

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
  `hora_inicio` tinyint(4) DEFAULT NULL,
  `hora_fin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliusuarios`
--

INSERT INTO `poliusuarios` (`id`, `usuario`, `contrasenya`, `email`, `nombre`, `apellido1`, `apellido2`, `dni`, `imagen`) VALUES
(2, 'admin', 'admin2', 'admin@admin.admin2', 'Paolo', 'Veneruso', 'Rodríguez', '77159467X', 'img/admin.png'),
(3, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/admin2.jpg'),
(4, 'admin234', 'admin234', 'admin@admin.assssssssssssssssssdmin23', 'admin', 'admin', 'admin', '77159467X', 'img/admin234.jpg'),
(5, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/admin.jpg'),
(6, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/admin23.jpg'),
(7, 'admin23', 'admin23', 'admin@admin.admin23', 'admin', 'admin', 'admin', '77159467X', 'img/admin.jpg');

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
(1, 2);

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

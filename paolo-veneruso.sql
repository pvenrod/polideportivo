-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 08-12-2020 a las 21:33:41
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

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

DROP TABLE IF EXISTS `polihorarioinstalaciones`;
CREATE TABLE IF NOT EXISTS `polihorarioinstalaciones` (
  `id` int(11) NOT NULL,
  `dia_semana` tinyint(4) DEFAULT NULL,
  `hora_inicio` char(5) DEFAULT NULL,
  `hora_fin` char(5) DEFAULT NULL,
  `idInstalacion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `polihorarioinstalaciones`
--

INSERT INTO `polihorarioinstalaciones` (`id`, `dia_semana`, `hora_inicio`, `hora_fin`, `idInstalacion`) VALUES
(1, 1, '9:00', '17:00', 1),
(2, 2, '9:00', '17:00', 1),
(3, 3, '9:00', '17:00', 1),
(4, 4, '9:00', '17:00', 1),
(5, 5, '9:00', '17:00', 1),
(6, 6, '9:00', '17:00', 1),
(7, 7, '9:00', '17:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliinstalaciones`
--

DROP TABLE IF EXISTS `poliinstalaciones`;
CREATE TABLE IF NOT EXISTS `poliinstalaciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `precioHora` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliinstalaciones`
--

INSERT INTO `poliinstalaciones` (`id`, `nombre`, `descripcion`, `imagen`, `precioHora`) VALUES
(1, 'Piscina abierta', 'Piscina olimpica abierta de 10 carriles y 50 metros. Dispone de agua frÃ­a.', 'img/instalaciones/1.jpg', '5.40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `polireservas`
--

DROP TABLE IF EXISTS `polireservas`;
CREATE TABLE IF NOT EXISTS `polireservas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `horaInicio` time DEFAULT '00:00:00',
  `horaFin` time NOT NULL DEFAULT '00:00:00',
  `precio` decimal(6,2) DEFAULT NULL,
  `instalacion` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `polireservas`
--

INSERT INTO `polireservas` (`id`, `fecha`, `horaInicio`, `horaFin`, `precio`, `instalacion`, `usuario`) VALUES
(1, '2020-12-17', '09:00:00', '11:00:00', '10.80', 1, 1),
(2, '2020-12-17', '13:00:00', '14:00:00', '5.40', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliroles`
--

DROP TABLE IF EXISTS `poliroles`;
CREATE TABLE IF NOT EXISTS `poliroles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `poliroles`
--

INSERT INTO `poliroles` (`id`, `nombre`) VALUES
(1, 'Admin'),
(2, 'Estandar'),
(3, 'Deshabilitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliusuarios`
--

DROP TABLE IF EXISTS `poliusuarios`;
CREATE TABLE IF NOT EXISTS `poliusuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contrasenya` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido1` varchar(100) DEFAULT NULL,
  `apellido2` varchar(100) DEFAULT NULL,
  `dni` char(9) DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `borrado` enum('si','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
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
(8, 'Paolo', 'paolo', 'paolo@gmail.com', 'Paolo', 'Veneruso', 'RodrÃ­guez', '77159467X', 'img/usuarios/Paolo.jpg', 'si'),
(9, '', '', '', 'asd', '', '', '', 'img/usuarios/default.jpg', 'si'),
(10, 'Paolo', 'asd', 'pvenrod@gmail.com', 'Paolo', 'Veneruso', 'RodrÃ­guez', '22118827G', 'img/usuarios/Paolo.jpg', 'no'),
(11, 'rafared', 'rafa', 'rafared@gmail.com', 'Rafa', 'Rul', 'Piedra', '22991818H', 'img/usuarios/rafared.jpg', 'no'),
(12, 'penelopecruz', 'penelope', 'penelopecruz@gmail.com', 'Penelope', 'Cruz', '', '77181127X', 'img/usuarios/12.jpg', 'no');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poliusuariosroles`
--

DROP TABLE IF EXISTS `poliusuariosroles`;
CREATE TABLE IF NOT EXISTS `poliusuariosroles` (
  `idUsuario` int(11) NOT NULL,
  `idRol` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`,`idRol`)
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
(8, 2),
(9, 2),
(10, 3),
(11, 2),
(12, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

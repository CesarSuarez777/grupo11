-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-06-2018 a las 16:43:30
-- Versión del servidor: 5.7.21
-- Versión de PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `aventon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `IDorigen` int(10) NOT NULL,
  `IDdestino` int(10) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL,
  `calificacion` int(2) NOT NULL DEFAULT '0',
  `IDcalif` int(11) NOT NULL AUTO_INCREMENT,
  `aConductor` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`IDcalif`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calificaciones`
--

INSERT INTO `calificaciones` (`IDorigen`, `IDdestino`, `comentario`, `fecha`, `calificacion`, `IDcalif`, `aConductor`) VALUES
(114, 113, 'Buenisimo!', '2018-06-13 00:00:00', 1, 2, 1),
(114, 113, 'Muy buena onda ', '2018-06-20 00:00:00', 1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `nombre` varchar(100) NOT NULL,
  `IDCiudad` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDCiudad`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`nombre`, `IDCiudad`) VALUES
('Adolfo Gonzalez Chavez', 1),
('Adrogue', 2),
('Alberti', 3),
('Alejandro Korn', 4),
('America', 5),
('Arrecifes', 6),
('Avellaneda', 7),
('Ayacucho', 8),
('Azul', 9),
('Bahia Blanca', 10),
('Balcarce', 11),
('Banfield', 12),
('Baradero', 13),
('Necochea', 27),
('Berisso', 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

DROP TABLE IF EXISTS `pagos`;
CREATE TABLE IF NOT EXISTS `pagos` (
  `IDpago` int(50) NOT NULL AUTO_INCREMENT,
  `IDusuario_destino` int(50) NOT NULL,
  `IDusuario_origen` int(50) NOT NULL,
  `monto` double NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`IDpago`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulados_usuarios_viajes`
--

DROP TABLE IF EXISTS `postulados_usuarios_viajes`;
CREATE TABLE IF NOT EXISTS `postulados_usuarios_viajes` (
  `IDusuario` int(50) NOT NULL,
  `IDviaje` int(50) NOT NULL,
  `estado` int(3) NOT NULL DEFAULT '0' COMMENT '0-> pendiente, 1->aceptado, -1->rechazado',
  `IDusuario_viaje` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDusuario_viaje`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `postulados_usuarios_viajes`
--

INSERT INTO `postulados_usuarios_viajes` (`IDusuario`, `IDviaje`, `estado`, `IDusuario_viaje`) VALUES
(113, 54, 0, 18),
(113, 51, -1, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

DROP TABLE IF EXISTS `tarjetas`;
CREATE TABLE IF NOT EXISTS `tarjetas` (
  `numero` bigint(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `titular` varchar(50) NOT NULL,
  `codigo` int(3) NOT NULL,
  `IDtarjeta` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDtarjeta`)
) ENGINE=MyISAM AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarjetas`
--

INSERT INTO `tarjetas` (`numero`, `marca`, `fecha_vencimiento`, `titular`, `codigo`, `IDtarjeta`) VALUES
(1245124512451245, 'Visa', '2019-03-01', 'IGLESIAS FERNANDO', 321, 112),
(1234123412341234, 'Visa', '2019-01-01', 'PATRICIO ESTEVEZ', 654, 100),
(147852144125784, 'American Express', '2019-11-01', 'ROMINA ALBERDI', 987, 113);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `foto` longblob,
  `token` varchar(100) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  `penalizacion` int(20) NOT NULL DEFAULT '0',
  `penalizacion_acom` int(20) NOT NULL DEFAULT '0',
  `deuda` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellido`, `email`, `clave`, `fecha`, `foto`, `token`, `ID`, `borrado`, `penalizacion`, `penalizacion_acom`, `deuda`) VALUES
('Maria Lujan', 'Andersen', 'Lujan.andersen@gmail.com', 'lujancita', '1975-08-02', '', 'AKLSGNASLKGANSGKLANSLÑKDNASKLD506', 99, 0, 2, 0, 0),
('Patricio', 'Estevez', 'pato.estevez@gmail.com', 'patito', '1990-08-12', '', 'asgasgas6f5as4f65DS', 100, 0, 2, 0, 0),
('Fernando', 'Iglesias', 'fer.iglesias@gmail.com', 'fer1990', '1990-07-05', '', 'df1407442b9618b956494f27bfa68a19', 112, 0, 0, 0, 0),
('Romina', 'Alberdi', 'romi.albertdi@gmail.com', 'romina', '1988-02-13', '', '1dcb1c1cce4490ded59a34460a826ad0', 113, 0, 4, 0, 0),
('Pedro', 'Carballo', 'peter.c@gmail.com', 'pedro', '1998-04-08', '', '7d0128b1bd8d148181fafc491376733f', 114, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `Marca` varchar(100) NOT NULL,
  `Modelo` varchar(100) NOT NULL,
  `Patente` varchar(10) NOT NULL,
  `Asientos` int(20) NOT NULL,
  `IDvehiculo` int(100) NOT NULL AUTO_INCREMENT,
  `IDuser` int(11) NOT NULL,
  PRIMARY KEY (`IDvehiculo`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`Marca`, `Modelo`, `Patente`, `Asientos`, `IDvehiculo`, `IDuser`) VALUES
('Renault 12', '1999', 'ZPL695', 3, 5, 100),
('FIAT', '600', 'MOP111', 3, 15, 99),
('Fiat Punto', '2010', 'KLM123', 4, 6, 110),
('Maserati', '2016', 'KLQ568', 2, 17, 112),
('FIAT PUNTO', '2010', 'APO123', 4, 19, 113),
('FIAT PALIO', '2006', 'KOL980', 4, 20, 113),
('RENAULT KANGOO', '2009', 'MOD777', 6, 21, 113);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

DROP TABLE IF EXISTS `viajes`;
CREATE TABLE IF NOT EXISTS `viajes` (
  `IDviaje` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `IDvehiculo` int(50) NOT NULL,
  `IDconductor` int(50) NOT NULL,
  `llegada` datetime NOT NULL,
  `IDOrigen` int(11) NOT NULL,
  `IDDestino` int(11) NOT NULL,
  `Precio` double NOT NULL,
  `asientos_disponibles` int(5) NOT NULL,
  PRIMARY KEY (`IDviaje`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`IDviaje`, `fecha`, `hora`, `IDvehiculo`, `IDconductor`, `llegada`, `IDOrigen`, `IDDestino`, `Precio`, `asientos_disponibles`) VALUES
(54, '2018-12-31', '20:58:00', 5, 100, '2018-12-31 23:59:00', 1, 5, 1666.6666666667, 2),
(53, '2018-08-09', '12:00:00', 5, 100, '2018-08-09 16:00:00', 1, 6, 1500, 3),
(52, '2018-07-04', '12:00:00', 20, 113, '2018-07-04 14:30:00', 12, 28, 80, 4),
(51, '2018-12-12', '14:30:00', 5, 100, '2018-12-12 18:00:00', 10, 1, 250, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 27-06-2018 a las 19:22:30
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
-- Estructura de tabla para la tabla `ciudades`
--

DROP TABLE IF EXISTS `ciudades`;
CREATE TABLE IF NOT EXISTS `ciudades` (
  `nombre` varchar(100) NOT NULL,
  `IDCiudad` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDCiudad`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`nombre`, `IDCiudad`) VALUES
('Adolfo Gonzalez Chavez', 1),
('Adrogué', 2),
('Alberti', 3),
('Alejandro Korn', 4),
('América', 5),
('Arrecifes', 6),
('Avellaneda', 7),
('Ayacucho', 8),
('Azul', 9),
('Bahía Blanca', 10),
('Balcarce', 11),
('Banfield', 12),
('Baradero', 13),
('Baradero', 26);

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
  `IDusuario_viaje` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDusuario_viaje`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarjetas`
--

DROP TABLE IF EXISTS `tarjetas`;
CREATE TABLE IF NOT EXISTS `tarjetas` (
  `numero` bigint(20) NOT NULL,
  `marca` varchar(20) NOT NULL,
  `fecha_vencimiento` varchar(11) NOT NULL,
  `IDtarjeta` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`IDtarjeta`)
) ENGINE=MyISAM AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`nombre`, `apellido`, `email`, `clave`, `fecha`, `foto`, `token`, `ID`, `borrado`) VALUES
('Franco', 'Spaltro', 'franco@96', 'pedo', '1996-04-01', '', '5464257', 1, 0),
('Nicole', 'Lacoste', 'niquita_lacoste@gmail.com', 'niqui', '1996-07-16', '', '42432', 7, 0),
('Nicole Ivonne', 'Lacoste', 'nicolelacoste@hotmail.com.ar', '12345', '1996-07-16', '', '298305933', 8, 0),
('Maria Lujan', 'Andersen', 'Lujan.andersen@gmail.com', 'lujancita', '1975-08-02', '', 'AKLSGNASLKGANSGKLANSLÑKDNASKLD506', 99, 0),
('Patricio', 'Estevez', 'pato.estevez@gmail.com', 'patito', '1990-08-12', '', 'asgasgas6f5as4f65DS', 100, 0),
('Franco', 'Spaltro', 'franco@gmail.com', 'franco', '1996-07-03', 0x494d475f303635372e4a5047, '087ad07946326f989d05586967a7eb47', 110, 0),
('Franco', 'Spaltro', 'Francospaltro96@gmail.com', 'lol', '1996-07-03', 0x494d475f303635372e4a5047, 'd7f8a9dfbca0a2c08103f91a80827df9', 111, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`Marca`, `Modelo`, `Patente`, `Asientos`, `IDvehiculo`, `IDuser`) VALUES
('Ford', 'Taunus 1990', 'ABC123', 5, 9, 99),
('Renault 12', '1999', 'ZPL695', 3, 5, 100),
('Fiat', '1990', 'ANC789', 4, 10, 99),
('Fiat Punto', '2010', 'KLM123', 4, 6, 110);

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
  `Precio` int(30) NOT NULL,
  PRIMARY KEY (`IDviaje`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`IDviaje`, `fecha`, `hora`, `IDvehiculo`, `IDconductor`, `llegada`, `IDOrigen`, `IDDestino`, `Precio`) VALUES
(9, '2018-07-03', '01:00:00.000000', 9, 99, '2018-07-03 03:00:00', 1, 6, 300);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

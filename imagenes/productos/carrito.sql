-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2014 a las 23:20:22
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `juguetes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT '0',
  `fecha_carrito` datetime DEFAULT NULL,
  `transaccion_efectuada` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_carrito`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='carrito de compras' AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `idusuario`, `id_producto`, `cantidad`, `fecha_carrito`, `transaccion_efectuada`) VALUES
(10, 3, 22, 1, '2013-08-23 12:38:38', 0),
(9, 2, 84, 1, '2013-08-22 15:57:22', 0),
(40, 7, 111, 1, '2013-09-10 07:41:54', 22),
(7, 1, 34, 2, '2013-08-18 02:11:21', 1),
(11, 1, 39, 1, '2013-08-23 12:40:24', 1),
(12, 1, 39, 2, '2013-08-23 13:41:25', 2),
(13, 1, 3, 2, '2013-08-23 20:15:40', 2),
(14, 1, 39, 1, '2013-08-23 20:19:44', 3),
(15, 1, 39, 1, '2013-08-23 20:22:24', 4),
(16, 1, 3, 1, '2013-08-23 20:22:49', 5),
(17, 1, 4, 1, '2013-08-23 20:24:43', 6),
(18, 1, 34, 1, '2013-08-23 20:26:12', 7),
(19, 1, 39, 1, '2013-08-23 20:27:35', 8),
(20, 1, 3, 1, '2013-08-23 20:28:25', 9),
(21, 1, 39, 1, '2013-08-23 20:29:45', 10),
(22, 1, 3, 1, '2013-08-23 20:33:11', 11),
(23, 1, 3, 1, '2013-08-23 20:33:36', 12),
(24, 1, 4, 2, '2013-08-23 20:35:12', 13),
(25, 1, 30, 1, '2013-08-23 20:36:37', 14),
(26, 1, 39, 1, '2013-08-23 20:37:53', 15),
(27, 1, 2, 1, '2013-08-23 20:38:24', 16),
(28, 1, 3, 1, '2013-08-23 20:43:41', 17),
(29, 1, 101, 1, '2013-08-23 20:44:15', 18),
(30, 1, 39, 1, '2013-08-23 20:49:06', 19),
(31, 1, 30, 3, '2013-08-23 20:53:34', 20),
(32, 1, 5, 1, '2013-08-23 20:53:50', 20),
(33, 1, 100, 1, '2013-08-23 20:53:56', 20),
(34, 1, 2, 3, '2013-08-23 20:54:03', 20),
(35, 1, 99, 1, '2013-08-23 20:55:37', 21),
(36, 1, 88, 3, '2013-08-23 20:55:48', 21),
(37, 1, 101, 6, '2013-08-23 20:55:57', 21),
(38, 1, 3, 1, '2013-08-23 20:56:03', 21),
(39, 1, 100, 5, '2013-08-24 14:25:14', 0),
(41, 7, 78, 1, '2013-09-10 07:43:13', 22),
(42, 7, 13, 1, '2013-09-10 07:44:10', 22),
(43, 11, 165, 1, '2013-09-28 13:22:02', 0),
(44, 12, 20, 1, '2013-09-29 01:26:33', 23),
(45, 13, 8, 1, '2013-10-01 14:15:48', 0),
(46, 13, 11, 1, '2013-10-10 01:26:20', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

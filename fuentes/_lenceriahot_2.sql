-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2014 a las 12:02:24
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `lenceriahot`
--
CREATE DATABASE IF NOT EXISTS `lenceriahot` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `lenceriahot`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `banners_publicidad`
--

CREATE TABLE IF NOT EXISTS `banners_publicidad` (
  `id_banner` int(11) NOT NULL AUTO_INCREMENT,
  `nom_banner` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `img_banner` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_banner` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fechareg_banner` datetime DEFAULT NULL,
  `estado_banner` int(1) DEFAULT '0',
  `cate_banner` int(1) NOT NULL DEFAULT '0',
  `clicks_banners` int(16) DEFAULT '0',
  PRIMARY KEY (`id_banner`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `banners_publicidad`
--

INSERT INTO `banners_publicidad` (`id_banner`, `nom_banner`, `img_banner`, `url_banner`, `fechareg_banner`, `estado_banner`, `cate_banner`, `clicks_banners`) VALUES
(1, 'oferton', 'banner-1.png', 'http://www.hostcreat.com', '2013-12-05 00:00:00', 1, 2, 0),
(2, 'Banner-1', 'banner7_10.jpg', 'www.hostcreat.com', '2014-02-14 00:00:00', 1, 1, 0),
(3, 'Banner 2', 'banner7_11.jpg', 'look.com', '2014-02-13 00:00:00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE IF NOT EXISTS `carrito` (
  `id_carrito` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_talla` int(3) DEFAULT NULL,
  `id_color` int(2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT '0',
  `fecha_carrito` datetime DEFAULT NULL,
  `transaccion_efectuada` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_carrito`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='carrito de compras' AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_usuario`, `id_producto`, `id_talla`, `id_color`, `cantidad`, `fecha_carrito`, `transaccion_efectuada`) VALUES
(39, 1, 2, 2, 2, 1, '2014-03-02 16:58:33', 0),
(38, 1, 1, 1, 3, 1, '2014-03-02 16:57:46', 0),
(37, 1, 4, 0, 0, 1, '2014-03-02 16:57:17', 0),
(35, 2, 4, 0, 0, 2, '2014-03-02 15:01:18', 0),
(36, 2, 3, 0, 0, 1, '2014-03-02 15:43:18', 0),
(40, 1, 5, 3, 0, 1, '2014-03-02 17:01:36', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(15) NOT NULL AUTO_INCREMENT,
  `nom_cate` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `urlseo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desc_cate` text COLLATE utf8_spanish_ci,
  `img_cate` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_categoria` int(1) DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nom_cate`, `urlseo`, `desc_cate`, `img_cate`, `estado_categoria`, `clicks`) VALUES
(1, 'Mujer', 'mujer', 'esto es para mujeres y es editable con..', '12-33.jpg', 1, 41),
(2, 'Mujersota', 'mujersota', 'asdasd sad ', '12-33.jpg', 1, 17),
(3, 'Impactante', 'imapctante', 'es impactante', 'aaa.jpg', 1, 6),
(4, 'Coquetona', NULL, 'Coquetona', NULL, 1, 3),
(5, 'Banidosa', NULL, 'Banidosa', 'sss', 1, 0),
(6, 'Loca', NULL, 'sdsdasds', NULL, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `click_productos`
--

CREATE TABLE IF NOT EXISTS `click_productos` (
  `id_click` int(16) NOT NULL AUTO_INCREMENT,
  `id_producto` int(16) DEFAULT '0',
  `fecha_click` date DEFAULT NULL,
  `hora_click` time DEFAULT NULL,
  `url_referen` varchar(160) COLLATE utf8_spanish_ci DEFAULT '0',
  `navegador_click` text COLLATE utf8_spanish_ci,
  PRIMARY KEY (`id_click`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `click_productos`
--

INSERT INTO `click_productos` (`id_click`, `id_producto`, `fecha_click`, `hora_click`, `url_referen`, `navegador_click`) VALUES
(1, 2, '2014-02-21', '10:06:41', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(2, 4, '2014-02-21', '21:48:57', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(3, 4, '2014-02-21', '21:49:42', 'http://hotsecrets.lence/iniciar-sesion.php?accesscheck=sesion-productos.php?tokem=NA==', 'Sistema Operativo: Windows 7 Navegador: Google Chrome 32.0.1700.107 <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="600" HEIGHT="400" FRAMEBORDER="1"></iframe>'),
(4, 2, '2014-02-21', '21:51:36', 'http://hotsecrets.lence/detalle.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(5, 4, '2014-02-21', '22:29:55', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(6, 2, '2014-02-21', '22:35:47', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(7, 3, '2014-02-21', '22:48:37', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(8, 4, '2014-02-21', '22:52:46', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 32.0.1700.107<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(9, 3, '2014-02-22', '17:56:25', 'http://hotsecrets.lence/productos.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(10, 1, '2014-02-22', '18:25:31', 'http://hotsecrets.lence/productos.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(11, 3, '2014-02-23', '11:11:27', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(12, 4, '2014-02-23', '11:11:55', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(13, 1, '2014-02-23', '11:12:08', 'http://hotsecrets.lence/producto-subida-por-primera-vez.html', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(14, 3, '2014-02-23', '11:28:02', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(15, 3, '2014-02-23', '11:29:43', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(16, 1, '2014-02-23', '11:29:49', 'http://hotsecrets.lence/producto-producto-3.html', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(17, 3, '2014-02-23', '12:00:42', 'http://hotsecrets.lence/detalle.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(18, 3, '2014-02-23', '12:13:46', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(19, 4, '2014-02-23', '12:28:34', 'http://hotsecrets.lence/detalle.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(20, 1, '2014-02-23', '14:00:29', 'http://hotsecrets.lence/detalle.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(21, 4, '2014-02-23', '16:14:01', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(22, 1, '2014-02-23', '16:14:51', 'http://hotsecrets.lence/producto-subida-por-primera-vez.html', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(23, 2, '2014-02-24', '13:50:43', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(24, 3, '2014-02-24', '13:56:07', 'http://hotsecrets.lence/producto-Producto-2.html', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(25, 3, '2014-02-24', '23:20:30', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(26, 4, '2014-03-02', '15:01:16', 'http://hotsecrets.lence/index.php', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(27, 3, '2014-03-02', '15:43:15', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(28, 4, '2014-03-02', '16:57:06', 'http://hotsecrets.lence/todos-nuestros-productos', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(29, 1, '2014-03-02', '16:57:37', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(30, 3, '2014-03-02', '16:58:14', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(31, 2, '2014-03-02', '16:58:16', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(32, 1, '2014-03-02', '16:58:18', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(33, 4, '2014-03-02', '16:58:18', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(34, 5, '2014-03-02', '17:01:30', 'http://hotsecrets.lence/sub-categoria-chopinias/', 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>'),
(35, 5, '2014-03-02', '17:08:45', NULL, 'Sistema Operativo: Windows 7<br />  Navegador: Google Chrome 33.0.1750.117<br />  <iframe SRC="http://api.ipinfodb.com/v3/ip-city/?key=c948628e3a5ffa0154640bfb7624e21aa3c0db1039e5b5747fd8023230be4ef5&ip=127.0.0.1" WIDTH="200" HEIGHT="100" FRAMEBORDER="1"></iframe>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE IF NOT EXISTS `departamentos` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_depa` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_depa` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(1) DEFAULT '0',
  `pru` varchar(222) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id_departamento`, `nombre_depa`, `descripcion_depa`, `estado`, `pru`) VALUES
(1, 'Lima', 'Bla bla bla', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distritos`
--

CREATE TABLE IF NOT EXISTS `distritos` (
  `id_distrito` int(11) NOT NULL AUTO_INCREMENT,
  `nom_distrito` varchar(220) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_provincia` int(11) DEFAULT '0',
  `id_departamento` int(11) DEFAULT '0',
  `costo` varchar(9) COLLATE utf8_spanish_ci DEFAULT '0',
  PRIMARY KEY (`id_distrito`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `distritos`
--

INSERT INTO `distritos` (`id_distrito`, `nom_distrito`, `id_provincia`, `id_departamento`, `costo`) VALUES
(1, 'La Molina', 1, 1, '5'),
(2, 'La Victoria', 1, 1, '3'),
(3, 'Jesus Maria', 1, 1, '7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_productos`
--

CREATE TABLE IF NOT EXISTS `imagenes_productos` (
  `id_imagen_prod` int(16) NOT NULL AUTO_INCREMENT,
  `id_producto` int(11) DEFAULT NULL,
  `imagenes` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `posicion_imag` int(2) DEFAULT '0',
  PRIMARY KEY (`id_imagen_prod`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `imagenes_productos`
--

INSERT INTO `imagenes_productos` (`id_imagen_prod`, `id_producto`, `imagenes`, `posicion_imag`) VALUES
(7, 1, '1-1.jpg', 1),
(8, 1, '1-2.jpg', 2),
(9, 1, '1-3.jpg', 3),
(11, 1, '1-4.jpg', 4),
(12, 1, '7.jpg', 0),
(13, 2, '1-2.jpg', 0),
(14, 2, '1-4.jpg', 0),
(15, 4, '223..jpg', NULL),
(16, 4, '2.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ordenador`
--

CREATE TABLE IF NOT EXISTS `ordenador` (
  `id_ordenador` int(4) NOT NULL AUTO_INCREMENT,
  `nombre_ordenador` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido_ordenador` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email_ordenador` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuario_ordenador` varchar(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password_ordenador` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `repassword_ordenador` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `img_ordenador` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estao_ordenador` int(1) NOT NULL DEFAULT '0',
  `fecha_ordenador` date DEFAULT NULL,
  PRIMARY KEY (`id_ordenador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ordenador`
--

INSERT INTO `ordenador` (`id_ordenador`, `nombre_ordenador`, `apellido_ordenador`, `email_ordenador`, `usuario_ordenador`, `password_ordenador`, `repassword_ordenador`, `img_ordenador`, `estao_ordenador`, `fecha_ordenador`) VALUES
(1, 'Ronny', 'Cabrera', 'ronny_the_fly7@hotmail.com', 'ronnyfly2', '939d3aa4a2d840551137a8d9933e9af6', NULL, 'avatar-mini.jpg', 1, '2014-01-22'),
(2, 'Pamela', 'SinApellido', 'pamela@hotsecretsperu.com', 'pamela1234', '939d3aa4a2d840551137a8d9933e9af6', NULL, 'avatar-mini.jpg', 1, '2014-02-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nom_producto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_seo_producto` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_normal_producto` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_oferta_producto` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `oferta_producto` int(1) DEFAULT '0',
  `resumen_producto` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `detalle_producto` text COLLATE utf8_spanish_ci,
  `img_producto` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `composiciones` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `video_producto` text COLLATE utf8_spanish_ci,
  `stock` int(1) NOT NULL DEFAULT '0',
  `estado_producto` int(1) DEFAULT '0',
  `id_subcategoria` int(11) NOT NULL DEFAULT '0',
  `fecha_act_producto` datetime DEFAULT NULL,
  `fecha_reg_producto` datetime DEFAULT NULL,
  `clicks_producto` int(11) DEFAULT '0',
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nom_producto`, `url_seo_producto`, `precio_normal_producto`, `precio_oferta_producto`, `oferta_producto`, `resumen_producto`, `detalle_producto`, `img_producto`, `composiciones`, `video_producto`, `stock`, `estado_producto`, `id_subcategoria`, `fecha_act_producto`, `fecha_reg_producto`, `clicks_producto`) VALUES
(1, 'producto 1', 'producto-1', '50', '40', 1, 'cb.,h jvb cxg ,v bcxb vcjxh vj,xc', '<p>lkchvbdf jkhcxhvbj, hjxhcxj,hkjfcbhj,cvh cb vjghj,chxjgh ,fd.hgjkdhfg,fgj kflhjfilgjkh gfj jgkljh fkkkkkkkkkkkkkkkkl lfkhjgkfj gkhbl</p>', '1.jpg', '44', '<iframe width="70%" height="100%" src="//www.youtube.com/embed/xdlKfXeZx9s" frameborder="0" allowfullscreen></iframe>', 1, 1, 1, NULL, '2013-12-06 13:31:17', 7),
(2, 'Producto 2', 'Producto-2', '25.00', NULL, 0, 'jkzxv mb fj,hxj kgh dfjkghjkcvbh f\r\ndf gkjfklgjklhd', 'lkjg lkdjgldfjg kf\r\ngf gklfdj gkgjh\r\nhgjkgklhg jghklj', '2.jpg', '95% Polyester / 95% Polyester\n5% Spandex / 5%', '<iframe width="70%" height="100%" src="//www.youtube.com/embed/xdlKfXeZx9s" frameborder="0" allowfullscreen></iframe>', 1, 1, 1, NULL, '2013-12-13 11:25:00', 5),
(3, 'Producto-3', 'producto-3', '522.00', '306.00', 1, 'dsdasdsa', ' sadsadasd', '3.jpg', '95% Polyester / 95% Polyester\n5% Spandex / 5%', '<iframe width="70%" height="100%" src="//www.youtube.com/embed/xdlKfXeZx9s" frameborder="0" allowfullscreen></iframe>', 1, 1, 1, '2014-02-26 00:00:00', '2014-02-21 00:00:00', 11),
(4, 'Subida Por Primera Vez', 'subida-por-primera-vez', '25', '30', 1, 'Este es un producto de mela', '<p>Pruebon pe loco</p><p><strong>Tu Sabe que tiene que ser asi</strong></p><ol><li>Paque mas</li><li>lelele</li></ol>', '12.jpg', '95% Polyester / 95% Polyester\n5% Spandex / 5%', '<iframe width="70%" height="100%" src="//www.youtube.com/embed/xdlKfXeZx9s" frameborder="0" allowfullscreen></iframe>', 1, 1, 1, NULL, NULL, 10),
(5, 'Subidad', 'subidad', '25', '30', 1, 'Este es un producto de mela', '<p>Pruebon pe loco</p><p><strong>Tu Sabe que tiene que ser asi</strong></p><ol><li>Paque mas</li><li>lelele</li></ol>', '12.jpg', '95% Polyester / 95% Polyester\n5% Spandex / 5%', '<iframe width="70%" height="100%" src="//www.youtube.com/embed/xdlKfXeZx9s" frameborder="0" allowfullscreen></iframe>', 1, 1, 1, NULL, '2014-02-13 16:18:25', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_colores`
--

CREATE TABLE IF NOT EXISTS `productos_colores` (
  `id_color` int(11) NOT NULL AUTO_INCREMENT,
  `nom_color` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_color` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_color`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `productos_colores`
--

INSERT INTO `productos_colores` (`id_color`, `nom_color`, `precio_color`) VALUES
(1, 'Azul', '3.00'),
(2, 'Rojo', '2.00'),
(3, 'Verde', '5.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_tallas`
--

CREATE TABLE IF NOT EXISTS `productos_tallas` (
  `id_talla` int(2) NOT NULL AUTO_INCREMENT,
  `nom_talla` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio_talla` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_talla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `productos_tallas`
--

INSERT INTO `productos_tallas` (`id_talla`, `nom_talla`, `precio_talla`) VALUES
(1, 'S', '5.00'),
(2, 'M', '10.00'),
(3, 'XL', '15.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `id_provincia` int(11) NOT NULL AUTO_INCREMENT,
  `nom_prov` varchar(220) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desc_prov` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_departamento` int(11) DEFAULT '0',
  PRIMARY KEY (`id_provincia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id_provincia`, `nom_prov`, `desc_prov`, `id_departamento`) VALUES
(1, 'Lima', 'bla bla bla', 1),
(2, 'Oyon', 'Bla Bla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_colores`
--

CREATE TABLE IF NOT EXISTS `relacion_colores` (
  `id_relacion_color` int(11) NOT NULL AUTO_INCREMENT,
  `rel_producto` int(11) DEFAULT NULL,
  `rel_color` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_relacion_color`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `relacion_colores`
--

INSERT INTO `relacion_colores` (`id_relacion_color`, `rel_producto`, `rel_color`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 1),
(4, 1, NULL),
(5, 1, NULL),
(6, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relacion_tallas`
--

CREATE TABLE IF NOT EXISTS `relacion_tallas` (
  `id_relacion_talla` int(11) NOT NULL AUTO_INCREMENT,
  `rel_producto` int(11) DEFAULT NULL,
  `rel_talla` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_relacion_talla`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `relacion_tallas`
--

INSERT INTO `relacion_tallas` (`id_relacion_talla`, `rel_producto`, `rel_talla`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 1, 1),
(4, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategorias`
--

CREATE TABLE IF NOT EXISTS `subcategorias` (
  `id_subcategoria` int(15) NOT NULL AUTO_INCREMENT,
  `nom_subcat` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `url_seo_subcat` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `desc_subcat` text COLLATE utf8_spanish_ci,
  `img_subcat` varchar(160) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '0',
  `fecha_subcat` datetime DEFAULT NULL,
  `id_categoria` int(15) NOT NULL,
  `clicks` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_subcategoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `subcategorias`
--

INSERT INTO `subcategorias` (`id_subcategoria`, `nom_subcat`, `url_seo_subcat`, `desc_subcat`, `img_subcat`, `estado`, `fecha_subcat`, `id_categoria`, `clicks`) VALUES
(1, 'Chompas', 'chopinias', 'chopas de lanita pes señora', '12-33.jpg', 1, NULL, 1, 32),
(2, 'calsones', 'calsones', 'ssdsdsddsd', '12-33.jpg', 1, '2014-02-28 00:00:00', 1, 6),
(3, 'fdrd', 'fdrd', 'sdfdsf', '12-33.jpg', 1, NULL, 2, 6),
(4, 'fgdfÃ±EpeÃ©Ã©eÃ©Â´.', 'fgdfnepeeeee', NULL, NULL, 1, '2014-03-02 19:03:28', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(15) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` varchar(8) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(120) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass_recuperar` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(9) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `direccion` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `referencias` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_departamento` int(11) DEFAULT '0',
  `id_provincia` int(11) DEFAULT '0',
  `id_distrito` int(11) DEFAULT '0',
  `fecha_reg` datetime DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '0',
  `suscrito` int(1) DEFAULT '0',
  `ipus` varchar(25) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `altaok` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `dni`, `correo`, `password`, `pass_recuperar`, `telefono`, `celular`, `direccion`, `referencias`, `id_departamento`, `id_provincia`, `id_distrito`, `fecha_reg`, `estado`, `suscrito`, `ipus`, `altaok`) VALUES
(1, 'Ronny', 'Cabrera Sinarahua', '45991958', 'ronny_2the_fly7@hotmail.com', '939d3aa4a2d840551137a8d9933e9af6', NULL, 9684756, 966354311, NULL, NULL, 1, 1, 1, '2014-03-02 17:03:44', 1, 1, '0', ''),
(2, 'asdsa', 'Cabrera', NULL, 'ronny_the_fly7@hotmail.com', '939d3aa4a2d840551137a8d9933e9af6', NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '2014-03-02 15:40:56', 1, 1, '127.0.0.1', '43ddc58b03022163180a80602f6985');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

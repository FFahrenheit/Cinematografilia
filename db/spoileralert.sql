-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-10-2019 a las 17:18:53
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `spoileralert`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amistad`
--

CREATE TABLE `amistad` (
  `usuario` varchar(30) NOT NULL,
  `amigo` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `amistad`
--

INSERT INTO `amistad` (`usuario`, `amigo`, `fecha`) VALUES
('ivan', 'ivxn', '2019-10-16 03:21:50'),
('ivan', 'ivxn1', '2019-10-16 02:54:02'),
('ivan', 'ivxn1k', '2019-10-16 02:58:25'),
('ivan', 'iv_n', '2019-10-11 15:04:18'),
('ivan', 'jjjj', '2019-10-16 01:47:25'),
('ivan', 'xxyo', '2019-10-07 03:13:23'),
('ivxn', 'ivan', '2019-10-16 03:21:50'),
('ivxn1', 'ivan', '2019-10-16 02:54:02'),
('ivxn1k', 'ivan', '2019-10-16 02:58:25'),
('iv_n', 'ivan', '2019-10-11 15:04:18'),
('jjjj', 'ivan', '2019-10-16 01:47:25'),
('jjjj', 'Johann', '2019-10-16 02:07:47'),
('Johann', 'jjjj', '2019-10-16 02:07:47'),
('xxyo', 'ivan', '2019-10-07 03:13:23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bloqueo`
--

CREATE TABLE `bloqueo` (
  `usuario` varchar(30) NOT NULL,
  `bloqueado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `valor` tinyint(4) DEFAULT 1,
  `usuario` varchar(30) NOT NULL,
  `pelicula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `calificacion`
--

INSERT INTO `calificacion` (`fecha`, `valor`, `usuario`, `pelicula`) VALUES
('2019-10-01 05:34:32', 1, 'ivan', ''),
('2019-10-01 04:38:06', 1, 'ivan', 'tt0363771'),
('2019-10-13 03:33:33', 1, 'ivan', 'tt4154796');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `clave` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `mensaje` text NOT NULL,
  `visto` tinyint(1) NOT NULL DEFAULT 0,
  `emisor` varchar(30) NOT NULL,
  `receptor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`clave`, `fecha`, `mensaje`, `visto`, `emisor`, `receptor`) VALUES
(1, '2019-10-09 03:30:13', 'Hola!', 1, 'xxyo', 'ivan'),
(2, '2019-10-09 03:30:29', 'Hello there', 1, 'ivan', 'xxyo'),
(3, '2019-10-09 03:48:34', 'n', 1, 'ivan', 'xxyo'),
(4, '2019-10-09 03:48:37', 'n', 1, 'ivan', 'xxyo'),
(5, '2019-10-09 03:48:40', 'hola', 1, 'ivan', 'xxyo'),
(6, '2019-10-09 03:49:16', 'Hola, me gustarÃ­a invitarte un chat', 1, 'ivan', 'xxyo'),
(7, '2019-10-09 04:19:34', 'hola', 1, 'ivan', 'xxyo'),
(8, '2019-10-09 04:19:37', 'holaa', 1, 'ivan', 'xxyo'),
(9, '2019-10-09 04:19:52', 'mmm', 1, 'ivan', 'xxyo'),
(10, '2019-10-09 04:19:57', 'mmmm', 1, 'ivan', 'xxyo'),
(11, '2019-10-09 04:20:06', 'hdhd', 1, 'ivan', 'xxyo'),
(12, '2019-10-09 04:20:15', 'hdh', 1, 'ivan', 'xxyo'),
(13, '2019-10-09 04:20:32', 'jejej', 1, 'ivan', 'xxyo'),
(14, '2019-10-11 15:04:36', 'Hola!', 0, 'ivan', 'iv_n'),
(15, '2019-10-11 15:04:58', 'Hey!', 1, 'iv_n', 'ivan'),
(27, '2019-10-13 04:43:01', 'Hola! <span class=\"recomend(jaja)\"> click aquí jaja</span>', 0, 'ivan', 'iv_n'),
(28, '2019-10-13 04:53:13', 'Â¡Hola! Te recomiendo The Avengers de Joss Whedon. Visita su ficha haciendo \r\n                click <span href=\'movie.php?id=tt0848228\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span href=\'recomendations.php\'>aquÃ­</span>.', 0, 'ivan', 'iv_n'),
(29, '2019-10-13 04:56:07', 'Â¡Hola! Te recomiendo The Avengers de Joss Whedon. Visita su ficha haciendo \r\n                click <span class=\'recomend onclick=\'window.location.href=\"movie.php?id=tt0848228\">aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 0, 'ivan', 'iv_n'),
(30, '2019-10-13 04:57:43', 'Â¡Hola! Te recomiendo The Avengers de Joss Whedon. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt0848228\">aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 0, 'ivan', 'iv_n'),
(31, '2019-10-13 04:59:49', 'Â¡Hola! Te recomiendo The Avengers de Joss Whedon. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt0848228\"\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 0, 'ivan', 'iv_n'),
(32, '2019-10-13 05:06:20', 'Â¡Hola! Te recomiendo The Avengers de Joss Whedon. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt0848228\"\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 0, 'ivan', 'iv_n'),
(33, '2019-10-13 05:21:07', 'Â¡Hola! Te recomiendo After Porn Ends de Bryce Wagoner. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt1291547\"\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 1, 'xxyo', 'ivan'),
(34, '2019-10-13 20:45:25', 'Â¡Hola! Te recomiendo Clown de Jon Watts. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt1780798\"\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 0, 'ivan', 'iv_n'),
(35, '2019-10-13 20:56:36', 'Â¡Hola! Te recomiendo The Avengers de Joss Whedon. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt0848228\"\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 0, 'ivan', 'xxyo'),
(36, '2019-10-16 01:47:38', 'Hola!', 1, 'jjjj', 'ivan'),
(37, '2019-10-16 01:48:03', 'Â¿CÃ³mo estÃ¡s?', 1, 'ivan', 'jjjj'),
(38, '2019-10-16 01:48:16', ':o', 1, 'jjjj', 'ivan'),
(39, '2019-10-16 01:49:49', 'm', 1, 'ivan', 'jjjj'),
(40, '2019-10-16 02:06:24', 'Hola!', 1, 'jjjj', 'ivan'),
(41, '2019-10-16 02:06:47', 'Hey', 1, 'jjjj', 'ivan'),
(42, '2019-10-16 02:06:57', 'hola', 1, 'ivan', 'jjjj'),
(43, '2019-10-16 02:07:05', 'Hey', 1, 'ivan', 'jjjj'),
(44, '2019-10-16 02:54:18', 'hey', 1, 'ivan', 'ivxn1'),
(45, '2019-10-16 02:54:38', 'hola', 1, 'ivan', 'ivxn1'),
(46, '2019-10-16 02:54:42', 'ola', 1, 'ivxn1', 'ivan'),
(47, '2019-10-16 02:54:52', 'uwu', 1, 'ivan', 'ivxn1'),
(48, '2019-10-16 02:58:43', 'hola', 1, 'ivan', 'ivxn1k'),
(49, '2019-10-16 02:59:03', 'Como estÃ¡s', 1, 'ivan', 'ivxn1k'),
(50, '2019-10-16 02:59:07', 'uwu', 1, 'ivan', 'ivxn1k'),
(51, '2019-10-16 03:10:20', 'UWU', 0, 'ivan', 'ivxn1'),
(52, '2019-10-16 03:22:06', 'Â¡Hola! Te recomiendo Captain America: The First Avenger de Joe Johnston. Visita su ficha haciendo \r\n                click <span class=\'recomend\' onclick=\'window.location.href=\"movie.php?id=tt0458339\"\'>aquÃ­</span>. O velo desde tus recomendaciones \r\n                <span class=\'recomend\' onclick=\'window.location.href=\"recomendations.php\"\'>aquÃ­</span>.', 1, 'ivxn', 'ivan'),
(53, '2019-10-16 04:37:24', 'hola', 0, 'ivan', 'jjjj');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `cuentas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `cuentas` (
`username` varchar(30)
,`pass` varbinary(30)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favoritas`
--

CREATE TABLE `favoritas` (
  `pelicula` varchar(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `favoritas`
--

INSERT INTO `favoritas` (`pelicula`, `usuario`, `fecha`) VALUES
('tt0156922', 'ivan', '2019-09-30 16:37:40'),
('tt0289879', 'ivan', '2019-09-16 23:25:50'),
('tt0290673', 'ivan', '2019-09-24 02:44:25'),
('tt0363771', 'ivan', '2019-09-30 15:55:37'),
('tt0848228', 'ivan', '2019-09-16 23:10:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `pelicula` varchar(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`pelicula`, `usuario`, `fecha`) VALUES
('tt0363771', 'ivan', '2019-10-08 21:43:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist`
--

CREATE TABLE `playlist` (
  `clave` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `creador` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `playlist`
--

INSERT INTO `playlist` (`clave`, `nombre`, `descripcion`, `fecha`, `creador`) VALUES
(47, 'Timetravel movies', 'Peliculas para romperse la mente', '2019-09-20 16:08:36', 'ivan'),
(48, 'Otra lista', 'Otra lista cool', '2019-09-20 16:08:54', 'ivan'),
(49, 'Mi lista', 'Una lista interesante', '2019-10-09 17:05:16', 'Johann'),
(50, 'Hola', 'jola', '2019-10-16 03:43:55', 'ivxn'),
(51, 'NSN', 'nd', '2019-10-16 03:46:05', 'ivxn'),
(52, 'snsn', 'xnsn', '2019-10-16 03:48:22', 'ivxn'),
(53, 'jcsjc', 'qjjwdcjs', '2019-10-16 03:48:27', 'ivxn'),
(54, 'jaja', 'JAJA', '2019-10-16 03:49:16', 'ivxn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist_likes`
--

CREATE TABLE `playlist_likes` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `playlist` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `playlist_likes`
--

INSERT INTO `playlist_likes` (`fecha`, `playlist`, `usuario`) VALUES
('2019-09-22 22:12:45', 47, 'ivan'),
('2019-09-25 02:12:24', 47, 'ivxn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `playlist_peliculas`
--

CREATE TABLE `playlist_peliculas` (
  `pelicula` varchar(10) NOT NULL,
  `playlist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `playlist_peliculas`
--

INSERT INTO `playlist_peliculas` (`pelicula`, `playlist`) VALUES
('tt0114746', 47),
('tt0468569', 49),
('tt0480669', 47),
('tt0480669', 48),
('tt1000774', 54),
('tt2194499', 47),
('tt2397535', 47),
('tt2669336', 47);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `clave` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `estado` enum('activa','inactiva','cola','') NOT NULL DEFAULT 'cola',
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendacion`
--

CREATE TABLE `recomendacion` (
  `clave` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelicula` varchar(10) NOT NULL,
  `visto` tinyint(1) NOT NULL DEFAULT 0,
  `emisor` varchar(30) NOT NULL,
  `receptor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `recomendacion`
--

INSERT INTO `recomendacion` (`clave`, `fecha`, `pelicula`, `visto`, `emisor`, `receptor`) VALUES
(1, '2019-10-13 04:12:07', 'tt4154796', 0, 'ivan', 'iv_n'),
(2, '2019-10-13 04:12:34', 'tt4154796', 0, 'ivan', 'iv_n'),
(3, '2019-10-13 04:14:10', 'tt4154796', 0, 'ivan', 'iv_n'),
(4, '2019-10-13 04:14:14', 'tt4154796', 0, 'ivan', 'iv_n'),
(6, '2019-10-13 04:27:02', 'tt0458339', 0, 'ivan', 'iv_n'),
(7, '2019-10-13 04:29:02', 'tt0458339', 0, 'ivan', 'iv_n'),
(10, '2019-10-13 04:38:36', 'tt0848228', 0, 'ivan', 'iv_n'),
(11, '2019-10-13 04:53:13', 'tt0848228', 0, 'ivan', 'iv_n'),
(12, '2019-10-13 04:56:06', 'tt0848228', 0, 'ivan', 'iv_n'),
(13, '2019-10-13 04:57:43', 'tt0848228', 0, 'ivan', 'iv_n'),
(14, '2019-10-13 04:59:49', 'tt0848228', 0, 'ivan', 'iv_n'),
(15, '2019-10-13 05:06:19', 'tt0848228', 0, 'ivan', 'iv_n'),
(17, '2019-10-13 20:45:24', 'tt1780798', 0, 'ivan', 'iv_n'),
(18, '2019-10-13 20:56:35', 'tt0848228', 1, 'ivan', 'xxyo'),
(19, '2019-10-16 03:22:05', 'tt0458339', 1, 'ivxn', 'ivan');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recomendacion_bloqueo`
--

CREATE TABLE `recomendacion_bloqueo` (
  `usuario` varchar(30) NOT NULL,
  `pelicula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `usuario` varchar(30) NOT NULL,
  `pregunta` int(11) NOT NULL,
  `pelicula` varchar(10) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review`
--

CREATE TABLE `review` (
  `clave` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `texto` varchar(2000) NOT NULL,
  `spoilers` tinyint(1) NOT NULL,
  `recomendada` tinyint(1) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pelicula` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `review`
--

INSERT INTO `review` (`clave`, `fecha`, `texto`, `spoilers`, `recomendada`, `usuario`, `pelicula`) VALUES
(3, '2019-10-16 14:59:17', 'Mala', 0, 0, 'ivan', 'tt0363771');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review_like`
--

CREATE TABLE `review_like` (
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `review` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `review_like`
--

INSERT INTO `review_like` (`fecha`, `review`, `usuario`) VALUES
('2019-10-04 15:40:30', 3, 'ivan'),
('2019-10-03 04:00:42', 3, 'ivxn1'),
('2019-10-16 02:04:48', 3, 'jjjj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `review_reporte`
--

CREATE TABLE `review_reporte` (
  `clave` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `razon` varchar(100) NOT NULL,
  `review` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `emisor` varchar(30) NOT NULL,
  `receptor` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado` enum('aceptada','pendiente','') NOT NULL DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`emisor`, `receptor`, `fecha`, `estado`) VALUES
('ivan', 'hola', '2019-10-16 03:01:53', 'pendiente'),
('ivan', 'jjjj', '2019-10-16 01:46:05', 'aceptada'),
('ivxn', 'ivan', '2019-10-16 03:21:35', 'aceptada'),
('ivxn1', 'ivan', '2019-10-16 02:52:58', 'aceptada'),
('ivxn1k', 'ivan', '2019-10-16 02:58:00', 'aceptada'),
('iv_n', 'ivan', '2019-10-07 02:50:30', 'aceptada'),
('jjjj', 'Johann', '2019-10-16 02:05:58', 'aceptada'),
('xxyo', 'ivan', '2019-10-07 03:06:12', 'aceptada');

--
-- Disparadores `solicitud`
--
DELIMITER $$
CREATE TRIGGER `aceptarAmistad` AFTER UPDATE ON `solicitud` FOR EACH ROW BEGIN
IF(NEW.estado = 'aceptada')
THEN 
	INSERT INTO amistad(usuario,amigo) VALUES (OLD.emisor, OLD.receptor);
	INSERT INTO amistad(amigo,usuario) VALUES (OLD.emisor, OLD.receptor);
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `imagen` varchar(100) DEFAULT '../../img/default-profile.png',
  `origen` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`username`, `password`, `email`, `imagen`, `origen`) VALUES
('admin', 'â—Š“I¥áéQÆÔÊc[ø', ' ', '../../img/default-profile.png', '2019-10-14 14:52:08'),
('hola', 'V[sÎÆPgRÖùoJ ', 'hola@hola.co', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('ivan', '0Móè3ÒÂ\'Æà¡8c3‰', 'di@di.com', '../../img/profiles/ivan.gif', '2019-09-16 02:14:04'),
('ivxn', 'ÞÔpƒW–+2‹ïŽ‚A¬', 'cuenta@ejemplo.com', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('ivxn1', 'á†™>Öz00qMÊ£', 'cuenta@ejemplo.co', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('ivxn1k', 'á†™>Öz00qMÊ£', '1cuenta@ejemplo.co', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('iv_n', 'E¸e-ÍÀÏÝd1»ä', 'ivan@ivan.com', '../../img/default-profile.png', '2019-09-19 05:36:51'),
('jjjj', '†GV¦µ=@“ÿà :²', 'ja@ja.ja', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('jkjj', '´†l\0©HÔ::£k$^ù}8', 'di@dia.com', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('Johann', 'ÞÔpƒW–+2‹ïŽ‚A¬', 'dii@dii.com', '../../img/default-profile.png', '2019-10-09 17:04:46'),
('xxyo', 'ET¸q¯©xÓõé-•u;å', 'xx@xx.xx', '../../img/default-profile.png', '2019-09-16 02:14:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas`
--

CREATE TABLE `vistas` (
  `pelicula` varchar(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vistas`
--

INSERT INTO `vistas` (`pelicula`, `usuario`, `fecha`) VALUES
('tt0062622', 'ivan', '2019-09-30 05:00:00'),
('tt0156922', 'ivan', '2019-09-30 05:00:00'),
('tt0156923', 'ivan', '2019-09-30 05:00:00'),
('tt0156934', 'ivan', '2019-09-30 05:00:00'),
('tt0164063', 'ivan', '2019-09-23 05:00:00'),
('tt0290673', 'ivan', '2019-09-13 05:00:00'),
('tt0363771', 'ivan', '2019-10-08 05:00:00'),
('tt0425121', 'ivan', '2019-09-30 05:00:00'),
('tt0425123', 'ivan', '2019-09-23 05:00:00'),
('tt0425124', 'ivan', '2019-09-30 05:00:00'),
('tt0458339', 'ivan', '2019-12-23 06:00:00'),
('tt0485947', 'ivan', '2019-10-01 05:00:00'),
('tt0848228', 'ivan', '2019-09-18 05:00:00'),
('tt1920984', 'ivan', '2019-09-30 05:00:00'),
('tt0468569', 'Johann', '2019-10-09 05:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `watchlist`
--

CREATE TABLE `watchlist` (
  `pelicula` varchar(10) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `watchlist`
--

INSERT INTO `watchlist` (`pelicula`, `usuario`, `fecha`) VALUES
('tt0164063', 'ivan', '2019-09-24 02:48:38'),
('tt0290673', 'ivan', '2019-09-24 02:44:22'),
('tt0425123', 'ivan', '2019-09-24 02:47:21'),
('tt0458339', 'ivan', '2019-09-19 03:56:08'),
('tt1291547', 'ivan', '2019-10-13 20:31:57');

-- --------------------------------------------------------

--
-- Estructura para la vista `cuentas`
--
DROP TABLE IF EXISTS `cuentas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cuentas`  AS  select `usuario`.`username` AS `username`,aes_decrypt(`usuario`.`password`,'5p01l3r') AS `pass` from `usuario` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amistad`
--
ALTER TABLE `amistad`
  ADD PRIMARY KEY (`usuario`,`amigo`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `amigo` (`amigo`);

--
-- Indices de la tabla `bloqueo`
--
ALTER TABLE `bloqueo`
  ADD PRIMARY KEY (`usuario`,`bloqueado`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `bloqueado` (`bloqueado`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`pelicula`,`usuario`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `usuario_2` (`usuario`),
  ADD KEY `pelicula` (`pelicula`);

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `favoritas`
--
ALTER TABLE `favoritas`
  ADD PRIMARY KEY (`usuario`,`pelicula`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`pelicula`,`usuario`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `creador` (`creador`);

--
-- Indices de la tabla `playlist_likes`
--
ALTER TABLE `playlist_likes`
  ADD PRIMARY KEY (`usuario`,`playlist`),
  ADD KEY `playlist` (`playlist`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `playlist_peliculas`
--
ALTER TABLE `playlist_peliculas`
  ADD PRIMARY KEY (`pelicula`,`playlist`),
  ADD KEY `playlist` (`playlist`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`clave`);

--
-- Indices de la tabla `recomendacion`
--
ALTER TABLE `recomendacion`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `recomendacion_bloqueo`
--
ALTER TABLE `recomendacion_bloqueo`
  ADD PRIMARY KEY (`usuario`,`pelicula`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`usuario`,`pregunta`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `pregunta` (`pregunta`);

--
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`clave`),
  ADD UNIQUE KEY `uniqueReview` (`usuario`,`pelicula`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `pelicula` (`pelicula`);

--
-- Indices de la tabla `review_like`
--
ALTER TABLE `review_like`
  ADD PRIMARY KEY (`review`,`usuario`),
  ADD KEY `review` (`review`),
  ADD KEY `review_2` (`review`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `review_reporte`
--
ALTER TABLE `review_reporte`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `review` (`review`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`emisor`,`receptor`),
  ADD KEY `emisor` (`emisor`),
  ADD KEY `receptor` (`receptor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD PRIMARY KEY (`usuario`,`pelicula`),
  ADD KEY `usuario` (`usuario`);

--
-- Indices de la tabla `watchlist`
--
ALTER TABLE `watchlist`
  ADD PRIMARY KEY (`usuario`,`pelicula`),
  ADD KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat`
--
ALTER TABLE `chat`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recomendacion`
--
ALTER TABLE `recomendacion`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `review_reporte`
--
ALTER TABLE `review_reporte`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `amistad`
--
ALTER TABLE `amistad`
  ADD CONSTRAINT `amistad_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`),
  ADD CONSTRAINT `amistad_ibfk_2` FOREIGN KEY (`amigo`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `bloqueo`
--
ALTER TABLE `bloqueo`
  ADD CONSTRAINT `bloqueo_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`),
  ADD CONSTRAINT `bloqueo_ibfk_2` FOREIGN KEY (`bloqueado`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `calificacion_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuario` (`username`),
  ADD CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `favoritas`
--
ALTER TABLE `favoritas`
  ADD CONSTRAINT `favoritas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `playlist`
--
ALTER TABLE `playlist`
  ADD CONSTRAINT `playlist_ibfk_2` FOREIGN KEY (`creador`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `playlist_likes`
--
ALTER TABLE `playlist_likes`
  ADD CONSTRAINT `playlist_likes_ibfk_1` FOREIGN KEY (`playlist`) REFERENCES `playlist` (`clave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `playlist_likes_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `playlist_peliculas`
--
ALTER TABLE `playlist_peliculas`
  ADD CONSTRAINT `playlist_peliculas_ibfk_1` FOREIGN KEY (`playlist`) REFERENCES `playlist` (`clave`);

--
-- Filtros para la tabla `recomendacion`
--
ALTER TABLE `recomendacion`
  ADD CONSTRAINT `recomendacion_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuario` (`username`),
  ADD CONSTRAINT `recomendacion_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `recomendacion_bloqueo`
--
ALTER TABLE `recomendacion_bloqueo`
  ADD CONSTRAINT `recomendacion_bloqueo_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`pregunta`) REFERENCES `preguntas` (`clave`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `review_like`
--
ALTER TABLE `review_like`
  ADD CONSTRAINT `review_like_ibfk_1` FOREIGN KEY (`review`) REFERENCES `review` (`clave`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_like_ibfk_2` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `review_reporte`
--
ALTER TABLE `review_reporte`
  ADD CONSTRAINT `review_reporte_ibfk_1` FOREIGN KEY (`review`) REFERENCES `review` (`clave`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`emisor`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`receptor`) REFERENCES `usuario` (`username`);

--
-- Filtros para la tabla `vistas`
--
ALTER TABLE `vistas`
  ADD CONSTRAINT `vistas_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `watchlist`
--
ALTER TABLE `watchlist`
  ADD CONSTRAINT `watchlist_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

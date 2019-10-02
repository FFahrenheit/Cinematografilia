-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2019 a las 07:46:44
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
('2019-10-01 04:38:06', 1, 'ivan', 'tt0363771');

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
(48, 'Otra lista', 'Otra lista cool', '2019-09-20 16:08:54', 'ivan');

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
('tt0480669', 47),
('tt0480669', 48),
('tt2194499', 47),
('tt2397535', 47),
('tt2669336', 47);

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
(1, '2019-10-01 05:36:39', 'adj', 0, 0, 'ivan', 'tt0363771'),
(2, '2019-10-02 05:30:47', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, 1, 'ivan', 'tt0363771'),
(3, '2019-10-02 05:31:51', 'JWDNEWFOJCKLENCJE VKLVNERV VKJV KC  CD CDJC VF VKJDNF C', 1, 0, 'ivan', 'tt0363771'),
(4, '2019-10-02 05:39:16', 'ho\'y', 1, 0, 'ivan', 'tt0363771');

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
('ivan', 'ivxn', '2019-09-25 01:59:34', 'aceptada');

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
('hola', 'V[sÎÆPgRÖùoJ ', 'hola@hola.co', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('ivan', '0Móè3ÒÂ\'Æà¡8c3‰', 'di@di.com', '../../img/profiles/ivan.gif', '2019-09-16 02:14:04'),
('ivxn', 'ÞÔpƒW–+2‹ïŽ‚A¬', 'cuenta@ejemplo.com', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('ivxn1', 'á†™>Öz00qMÊ£', 'cuenta@ejemplo.co', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('ivxn1k', 'á†™>Öz00qMÊ£', '1cuenta@ejemplo.co', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('iv_n', 'E¸e-ÍÀÏÝd1»ä', 'ivan@ivan.com', '../../img/default-profile.png', '2019-09-19 05:36:51'),
('jjjj', '†GV¦µ=@“ÿà :²', 'ja@ja.ja', '../../img/default-profile.png', '2019-09-16 02:14:04'),
('jkjj', '´†l\0©HÔ::£k$^ù}8', 'di@dia.com', '../../img/default-profile.png', '2019-09-16 02:14:04'),
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
('tt0425121', 'ivan', '2019-09-30 05:00:00'),
('tt0425123', 'ivan', '2019-09-23 05:00:00'),
('tt0425124', 'ivan', '2019-09-30 05:00:00'),
('tt0458339', 'ivan', '2019-12-23 06:00:00'),
('tt0485947', 'ivan', '2019-10-01 05:00:00'),
('tt0848228', 'ivan', '2019-09-18 05:00:00'),
('tt1920984', 'ivan', '2019-09-30 05:00:00');

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
('tt0363771', 'ivan', '2019-09-30 16:09:50'),
('tt0425123', 'ivan', '2019-09-24 02:47:21'),
('tt0458339', 'ivan', '2019-09-19 03:56:08');

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
-- Indices de la tabla `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`clave`),
  ADD KEY `usuario` (`usuario`),
  ADD KEY `pelicula` (`pelicula`);

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
-- AUTO_INCREMENT de la tabla `playlist`
--
ALTER TABLE `playlist`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `review`
--
ALTER TABLE `review`
  MODIFY `clave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`username`);

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

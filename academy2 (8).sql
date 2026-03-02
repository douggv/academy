-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-03-2026 a las 02:50:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `academy2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academias`
--

CREATE TABLE `academias` (
  `id_universidad` int(11) NOT NULL,
  `nombre_universidad` varchar(100) NOT NULL,
  `ubicacion` varchar(255) DEFAULT NULL,
  `imagen` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `academias`
--

INSERT INTO `academias` (`id_universidad`, `nombre_universidad`, `ubicacion`, `imagen`) VALUES
(1, 'Santiago Mariño', 'Av. La Limpia, Maracaibo', 'Santiago_Mari__o.png'),
(2, 'Antonio Jose de Sucre', 'Av. La Limpia, Maracaibo', 'Antonio_Jose_de_Sucre.webp'),
(3, 'Universidad de el Zulia', 'avenida 16 (Guajira) con calle, Maracaibo', 'Universidad_de_el_Zulia.webp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `fecha_hora_asistencia` datetime DEFAULT NULL,
  `id_universidad_fk` int(11) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `fecha_hora_asistencia`, `id_universidad_fk`, `descripcion`) VALUES
(1, '2026-02-25 16:05:00', 1, 'Entretamiento tactito para la competencia 3 vs 3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_asistencia_jugador`
--

CREATE TABLE `detalle_asistencia_jugador` (
  `id_detalle_asistencia` int(11) NOT NULL,
  `id_asistencia_fk` int(11) DEFAULT NULL,
  `id_jugador_fk` int(11) DEFAULT NULL,
  `estado` enum('presente','ausente','justificado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id_juego` int(11) NOT NULL,
  `tipo_juego` varchar(50) DEFAULT NULL,
  `fecha_juego` datetime DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_academia_local` int(11) DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `id_academia_visitante` int(11) DEFAULT NULL,
  `ganador` tinyint(2) DEFAULT NULL,
  `puntos_local` int(11) DEFAULT NULL,
  `puntos_visitante` int(11) DEFAULT NULL
) ;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id_juego`, `tipo_juego`, `fecha_juego`, `fecha_creacion`, `fecha_actualizacion`, `id_academia_local`, `lugar`, `id_academia_visitante`, `ganador`, `puntos_local`, `puntos_visitante`) VALUES
(1, 'Amistoso', '2026-02-17 00:00:00', '2026-02-15 16:45:50', '2026-02-18 00:56:57', 1, 'cancha', 2, 1, 1, 0),
(2, '3 vs 3', '2026-02-19 00:00:00', '2026-02-19 21:11:37', '2026-02-23 18:51:14', 1, 'cancha santiago', 2, 1, 52, 45),
(3, 'Amistoso', '2026-02-25 00:00:00', '2026-02-24 18:01:19', '2026-02-24 18:07:26', 1, 'Cancha Santiago Mariño', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id_jugador` int(11) NOT NULL,
  `nombre_jugador` varchar(100) DEFAULT NULL,
  `email_jugador` varchar(100) DEFAULT NULL,
  `password_jugador` varchar(255) DEFAULT NULL,
  `altura_jugador` decimal(3,2) DEFAULT NULL,
  `peso_jugador` decimal(5,2) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_universidad_fk` int(11) DEFAULT NULL,
  `isActive` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `imagen_jugador` text DEFAULT NULL,
  `puntos` int(11) DEFAULT NULL,
  `asistencias` int(11) DEFAULT NULL,
  `rebotes` int(11) DEFAULT NULL,
  `robos` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id_jugador`, `nombre_jugador`, `email_jugador`, `password_jugador`, `altura_jugador`, `peso_jugador`, `fecha_nacimiento`, `id_universidad_fk`, `isActive`, `fecha_creacion`, `fecha_actualizacion`, `imagen_jugador`, `puntos`, `asistencias`, `rebotes`, `robos`) VALUES
(12, 'Harold Rojas', 'harolde@gmail.com', NULL, 1.90, 105.00, '2026-02-17', 1, NULL, '2026-01-23 23:48:56', '2026-02-23 20:15:21', 'Harold Rojas_1769212136_harold.jpg', 6, 2, 23, 2),
(13, 'Gustavo Yanes', 'gustavo@gmail.com', NULL, 1.73, 85.00, '2026-02-01', 1, NULL, '2026-01-23 23:50:00', '2026-02-23 20:15:36', 'Gustavo Yanes_1769212200_gustavo.jpg', 12, 2, 2, 2),
(14, 'Diego Chacin', 'diego@gmail.com', NULL, 1.70, 85.00, '2002-04-12', 1, NULL, '2026-01-24 00:20:56', '2026-02-23 20:15:52', 'Diego Chacin_1769214056_diego chacin.jpg', 2, 3, 3, 3),
(16, 'Edwards Cedeño', 'Edwars@gmail.com', NULL, 1.85, 97.50, '2003-06-01', 1, NULL, '2026-01-24 00:23:58', '2026-02-23 20:16:58', 'Edwards Cedeño_1769214238_edwards cedeño.jpg', 1, 4, 4, 1),
(17, 'Ismael Razz', 'ismael@gmail.cpm', NULL, 1.82, 92.00, '2002-09-08', 1, NULL, '2026-01-24 00:24:47', '2026-02-23 20:17:52', 'Ismael Razz_1769214287_ismael.jpg', 5, 1, 0, 1),
(18, 'Jesus Gonzalez', 'jesusG@GMAIL.COM', NULL, 1.83, 85.00, '2004-02-02', 1, NULL, '2026-01-24 00:26:11', '2026-02-23 20:18:32', 'Jesus Gonzalez_1769214371_jesus gonzalez.jpg', 1, 0, 6, 5),
(22, 'Jean Hernández', 'jeanhernandez@gmail.com', NULL, 1.75, 65.00, '2026-02-10', 2, NULL, '2026-02-23 17:48:24', '2026-02-24 18:08:22', 'Jean_Hernández_1771868904.jpg', 1, 0, 0, 0),
(23, 'yoiber Avila', 'yoiberavila@gmail.com', NULL, 1.82, 89.00, NULL, 2, NULL, '2026-02-23 18:27:25', '2026-02-24 18:08:22', 'yoiber_Avila_1771871245.jpg', 1, 0, 0, 0),
(24, 'Giampaolo Derrico', 'Giampaolo@gmail.com', NULL, 1.76, 90.00, '2000-06-03', 2, NULL, '2026-02-23 18:30:12', '2026-02-24 18:08:22', 'Giampaolo_DERRICO_1771871412.jpg', 0, 2, 2, 0),
(26, 'Jesus Frias', 'jesusfrias@gmail.com', NULL, 1.93, 96.00, '2001-07-08', 2, NULL, '2026-02-23 18:36:09', '2026-02-24 18:08:22', 'Jesus_Frias_1771871769.jpg', 0, 0, 0, 1),
(28, 'Moises Osorio', 'moises@gmail.com', NULL, 1.80, 85.00, NULL, 2, NULL, '2026-02-23 18:56:39', '2026-02-24 18:08:22', 'Moises_Osorio_1771872999.jpg', 2, 0, 0, 0),
(30, 'Cesar Arrieta', 'cesararrieta@gmail.com', NULL, 1.75, 60.00, '2004-08-04', 3, NULL, '2026-02-23 19:03:25', '2026-02-23 19:08:39', 'Cesar_Arrieta_1771873405.jpg', NULL, NULL, NULL, NULL),
(31, 'William Arrieta', 'William@gmail.com', NULL, 1.73, 85.00, '2003-03-25', 3, NULL, '2026-02-23 19:05:34', '2026-02-23 19:09:04', 'William_Arrieta_1771873534.jpg', NULL, NULL, NULL, NULL),
(32, 'Diego Gonzalez', 'diegogonzalez@gmail.com', NULL, 1.75, 92.00, '2004-05-15', 3, NULL, '2026-02-23 19:08:15', '2026-02-23 19:09:20', 'Diego_Gonzalez_1771873695.jpg', NULL, NULL, NULL, NULL),
(34, 'Arturo Gonzalez', 'Arturo@gmail.com', NULL, 1.75, 78.00, '2002-03-07', 3, NULL, '2026-02-23 19:10:42', '2026-02-23 19:19:53', 'Arturo_Gonzalez_1771873842.jpg', NULL, NULL, NULL, NULL),
(35, 'Humberto Añez', 'humberto@gmail.com', NULL, 1.83, 98.00, '2003-09-13', 3, NULL, '2026-02-23 19:12:06', '2026-02-23 19:19:30', 'Humberto_Añez_1771873926.jpg', NULL, NULL, NULL, NULL),
(37, 'Leandro Gomez', 'leandro@gmail.com', NULL, 1.88, 78.00, '2004-06-29', 3, NULL, '2026-02-23 19:13:22', '2026-02-23 19:13:53', 'Leandro_Gomez_1771874002.jpg', NULL, NULL, NULL, NULL),
(38, 'Joan Rosell', 'Joan@gmail.com', NULL, 1.78, 68.00, '2005-12-19', 3, NULL, '2026-02-23 19:18:12', '2026-02-23 19:19:07', 'Joan_Rosell_1771874292.jpg', NULL, NULL, NULL, NULL),
(39, 'Jhoswer Maya', 'Jhoswer@gmail.com', NULL, 1.72, 65.00, '2005-07-04', 3, NULL, '2026-02-23 19:22:19', '2026-02-23 19:22:36', 'Jhoswer_Maya_1771874539.jpg', NULL, NULL, NULL, NULL),
(40, 'Juan Rojas', 'Juanrojas@gmail.com', NULL, 1.87, 76.60, NULL, 1, NULL, '2026-02-23 20:20:32', '2026-02-24 18:08:22', 'Juan_Rojas_1771878032.jpg', 0, 0, 0, 0),
(41, 'Jesus Orfilas', 'jota@gmail.com', NULL, 1.73, 62.50, NULL, 1, NULL, '2026-02-23 20:22:34', '2026-02-24 18:08:22', 'Jesus_Orfilas_1771878154.jpg', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planificacion`
--

CREATE TABLE `planificacion` (
  `id_planificacion` int(11) NOT NULL,
  `id_universidad_fk` int(11) DEFAULT NULL,
  `planificacion_cualitativa` text DEFAULT NULL,
  `fecha_planificada` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_individuales`
--

CREATE TABLE `resultados_individuales` (
  `id_resultado` int(11) NOT NULL,
  `id_juego_fk` int(11) NOT NULL,
  `id_jugador_fk` int(11) NOT NULL,
  `puntos` int(11) DEFAULT 0,
  `asistencias` int(11) DEFAULT 0,
  `robos` int(11) DEFAULT 0,
  `rebotes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados_individuales`
--

INSERT INTO `resultados_individuales` (`id_resultado`, `id_juego_fk`, `id_jugador_fk`, `puntos`, `asistencias`, `robos`, `rebotes`) VALUES
(1, 1, 12, 2, 2, 1, 23),
(2, 1, 13, 12, 1, 2, 2),
(3, 1, 14, 2, 3, 3, 3),
(7, 1, 16, 1, 4, 1, 4),
(13, 1, 17, 5, 1, 1, 0),
(14, 1, 18, 1, 0, 5, 6),
(85, 2, 12, 10, 2, 2, 22),
(86, 2, 13, 12, 2, 2, 2),
(87, 2, 14, 0, 0, 0, 0),
(88, 2, 16, 0, 0, 0, 0),
(89, 2, 17, 0, 0, 0, 0),
(90, 2, 18, 0, 0, 0, 0),
(133, 1, 22, 0, 0, 0, 0),
(134, 1, 23, 0, 0, 0, 0),
(135, 1, 24, 0, 0, 0, 0),
(136, 1, 26, 0, 0, 0, 0),
(144, 2, 40, 0, 0, 0, 0),
(145, 2, 41, 0, 0, 0, 0),
(146, 2, 22, 2, 0, 0, 0),
(147, 2, 23, 1, 0, 0, 0),
(148, 2, 24, 0, 3, 0, 3),
(149, 2, 26, 0, 0, 1, 0),
(150, 2, 28, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` enum('ojeador','coordinador','entrenador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'ojeador'),
(2, 'coordinador'),
(3, 'entrenador'),
(4, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `password_usuario` varchar(255) NOT NULL,
  `email_usuario` varchar(100) DEFAULT NULL,
  `id_universidad_fk` int(11) DEFAULT NULL,
  `id_rol_fk` int(11) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isActive` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password_usuario`, `email_usuario`, `id_universidad_fk`, `id_rol_fk`, `fecha_creacion`, `fecha_actualizacion`, `isActive`) VALUES
(3, 'pedro', '$2y$10$.JopWlCIrIYSjP1JyzEW.Oddi1Av.TYXK2nlOFYjnftoNw6GHbKAS', 'pedro@gmail.com', 1, 2, '2026-01-20 15:45:05', '2026-02-03 14:03:23', NULL),
(4, 'Hidalgo', '$2y$10$7/NXH6caLgy25MUKuk7ZMOCttyQ71oT5qctUaDMqPAl2cNzOLp.Sm', 'hidalgo@gmail.com', 1, 3, '2026-01-23 22:32:58', '2026-02-24 17:54:46', NULL),
(5, 'harold', '$2y$10$jScDfAuWczSTaSCWRSG0b.0yY.91MFAAROWptD65OiQrAyEXdhQb6', 'hr13032003e@gmail.com', NULL, 1, '2026-01-23 23:50:53', '2026-01-23 23:50:53', NULL),
(6, 'cris', '$2y$10$Z3TzVRhR72aepizf9RUlZu1fiCV/1/TvW7d0qbuLdlUHGdaGx3wL2', 'cris@gmail.com', NULL, 1, '2026-02-03 13:41:59', '2026-02-03 13:41:59', NULL),
(7, 'mario', '$2y$10$.JopWlCIrIYSjP1JyzEW.Oddi1Av.TYXK2nlOFYjnftoNw6GHbKAS', 'mario@gmail.com', 2, 3, '2026-02-04 16:48:44', '2026-02-23 17:36:18', NULL),
(8, 'santiago', '$2y$10$mJ2/V8nWHPRVd45zsedpxuXrbbkNCE.e3Sib8e24SGxcXTZqe/Qae', 'santiago@gmail.com', 3, 3, '2026-02-04 16:59:30', '2026-02-04 16:59:30', NULL),
(10, 'santi', '$2y$10$Jz4H2uIt.8oUr7IxCBcOReRf32qN5r0XAnVpqXbxujNfkFsIYPa3K', 'santiago2@gmail.com', NULL, 1, '2026-02-17 19:31:06', '2026-02-17 19:31:06', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `academias`
--
ALTER TABLE `academias`
  ADD PRIMARY KEY (`id_universidad`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `fk_asistencia_academias` (`id_universidad_fk`);

--
-- Indices de la tabla `detalle_asistencia_jugador`
--
ALTER TABLE `detalle_asistencia_jugador`
  ADD PRIMARY KEY (`id_detalle_asistencia`),
  ADD KEY `id_asistencia_fk` (`id_asistencia_fk`),
  ADD KEY `id_jugador_fk` (`id_jugador_fk`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id_juego`),
  ADD KEY `fk_juegos_local` (`id_academia_local`),
  ADD KEY `fk_juegos_visitante` (`id_academia_visitante`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id_jugador`),
  ADD UNIQUE KEY `email_jugador` (`email_jugador`),
  ADD KEY `id_universidad_fk` (`id_universidad_fk`);

--
-- Indices de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD PRIMARY KEY (`id_planificacion`),
  ADD KEY `id_universidad_fk` (`id_universidad_fk`);

--
-- Indices de la tabla `resultados_individuales`
--
ALTER TABLE `resultados_individuales`
  ADD PRIMARY KEY (`id_resultado`),
  ADD UNIQUE KEY `jugador_por_juego` (`id_juego_fk`,`id_jugador_fk`),
  ADD UNIQUE KEY `juego_jugador_unico` (`id_juego_fk`,`id_jugador_fk`),
  ADD KEY `id_jugador_fk` (`id_jugador_fk`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`),
  ADD KEY `id_universidad_fk` (`id_universidad_fk`),
  ADD KEY `id_rol_fk` (`id_rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `academias`
--
ALTER TABLE `academias`
  MODIFY `id_universidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_asistencia_jugador`
--
ALTER TABLE `detalle_asistencia_jugador`
  MODIFY `id_detalle_asistencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id_juego` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id_jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `planificacion`
--
ALTER TABLE `planificacion`
  MODIFY `id_planificacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados_individuales`
--
ALTER TABLE `resultados_individuales`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_academias` FOREIGN KEY (`id_universidad_fk`) REFERENCES `academias` (`id_universidad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_asistencia_jugador`
--
ALTER TABLE `detalle_asistencia_jugador`
  ADD CONSTRAINT `detalle_asistencia_jugador_ibfk_1` FOREIGN KEY (`id_asistencia_fk`) REFERENCES `asistencia` (`id_asistencia`),
  ADD CONSTRAINT `detalle_asistencia_jugador_ibfk_2` FOREIGN KEY (`id_jugador_fk`) REFERENCES `jugadores` (`id_jugador`);

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_juegos_local` FOREIGN KEY (`id_academia_local`) REFERENCES `academias` (`id_universidad`),
  ADD CONSTRAINT `fk_juegos_visitante` FOREIGN KEY (`id_academia_visitante`) REFERENCES `academias` (`id_universidad`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `jugadores_ibfk_1` FOREIGN KEY (`id_universidad_fk`) REFERENCES `academias` (`id_universidad`);

--
-- Filtros para la tabla `planificacion`
--
ALTER TABLE `planificacion`
  ADD CONSTRAINT `planificacion_ibfk_1` FOREIGN KEY (`id_universidad_fk`) REFERENCES `academias` (`id_universidad`);

--
-- Filtros para la tabla `resultados_individuales`
--
ALTER TABLE `resultados_individuales`
  ADD CONSTRAINT `resultados_individuales_ibfk_1` FOREIGN KEY (`id_juego_fk`) REFERENCES `juegos` (`id_juego`) ON DELETE CASCADE,
  ADD CONSTRAINT `resultados_individuales_ibfk_2` FOREIGN KEY (`id_jugador_fk`) REFERENCES `jugadores` (`id_jugador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_universidad_fk`) REFERENCES `academias` (`id_universidad`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_rol_fk`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

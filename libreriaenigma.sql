-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-04-2019 a las 05:27:09
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreriaenigma`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

DROP TABLE IF EXISTS `autor`;
CREATE TABLE IF NOT EXISTS `autor` (
  `id_autor` int(11) NOT NULL AUTO_INCREMENT,
  `nombreCompleto` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `autor`
--

INSERT INTO `autor` (`id_autor`, `nombreCompleto`) VALUES
(1, 'Yuval Noah Harari'),
(2, 'Florencia Bonelli'),
(3, 'Magali Tajes'),
(4, 'Margaret Atwood'),
(5, 'Dario Sztajnszrajber'),
(6, 'Alex Wisrch'),
(7, 'Maria Dueñas'),
(8, 'Haylie Pomroy'),
(9, 'Hugo Alconada Mon'),
(10, 'Mariano Hamilton'),
(11, 'Luciana Peker'),
(12, 'Lorena Pronsky'),
(13, 'Andrés Oppenheimer'),
(14, 'Virginie Despentes'),
(15, 'Anonimo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrousel`
--

DROP TABLE IF EXISTS `carrousel`;
CREATE TABLE IF NOT EXISTS `carrousel` (
  `id_carrousel` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_carrousel`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `carrousel`
--

INSERT INTO `carrousel` (`id_carrousel`, `imagen`) VALUES
(1, 'img/carrousel/1/1.jpg'),
(2, 'img/carrousel/2/2.jpg'),
(3, 'img/carrousel/3/3.jpg'),
(4, 'img/carrousel/4/4.jpg'),
(5, 'img/carrousel/5/5.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

DROP TABLE IF EXISTS `editorial`;
CREATE TABLE IF NOT EXISTS `editorial` (
  `id_editorial` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id_editorial`, `nombre`) VALUES
(1, 'Debate'),
(2, 'Suma'),
(3, 'Sudamericana'),
(4, 'Salamandra'),
(5, 'Paidos'),
(6, 'Disney'),
(7, 'Planeta'),
(8, 'Grijalbo'),
(9, 'Sur'),
(10, 'Literatura Random House'),
(11, 'Sin Editorial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

DROP TABLE IF EXISTS `libro`;
CREATE TABLE IF NOT EXISTS `libro` (
  `id_libro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(150) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(200) COLLATE utf8_bin NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `id_autor_FK` int(11) NOT NULL,
  `id_editorial_FK` int(11) NOT NULL,
  PRIMARY KEY (`id_libro`),
  KEY `id_autor_FK` (`id_autor_FK`),
  KEY `id_editorial_FK` (`id_editorial_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id_libro`, `nombre`, `imagen`, `habilitado`, `id_autor_FK`, `id_editorial_FK`) VALUES
(1, '21 Lecciones Para El Siglo Xxi', 'libros/21_lecciones_para_el_siglo_xxi/21_lecciones_para_el_siglo_xxi.png', 1, 1, 1),
(2, 'Aqui Hay Dragones', 'libros/aqui_hay_dragones/aqui_hay_dragones.png', 1, 2, 2),
(3, 'Caos Nadie Puede Decirte Quien Sos', 'libros/caos_nadie_puede_decirte_quien_sos/caos_nadie_puede_decirte_quien_sos.png', 1, 3, 3),
(4, 'De Animales A Dioses', 'libros/de_animales_a_dioses/de_animales_a_dioses.png', 1, 1, 1),
(5, 'El Cuento De La Criada', 'libros/el_cuento_de_la_criada/el_cuento_de_la_criada.png', 1, 4, 4),
(6, 'Filosofia En 11 Frases', 'libros/filosofia_en_11_frases/filosofia_en_11_frases.png', 1, 5, 5),
(7, 'Gravity Falls', 'libros/gravity_falls/gravity_falls.png', 1, 6, 6),
(8, 'Las Hijas Del Capitan', 'libros/las_hijas_del_capitan/las_hijas_del_capitan.png', 1, 7, 7),
(9, 'La Dieta Del Metabolismo Acelerado', 'libros/la_dieta_del_metabolismo_acelerado/la_dieta_del_metabolismo_acelerado.png', 1, 8, 8),
(10, 'La Raiz De Todos Los Males', 'libros/la_raiz_de_todos_los_males/la_raiz_de_todos_los_males.png', 1, 9, 7),
(11, 'Masones Argentinos El Poder En Las Sombras', 'libros/masones_argentinos_el_poder_en_las_sombras/masones_argentinos_el_poder_en_las_sombras.png', 1, 10, 7),
(12, 'Putita Golosa', 'libros/putita_golosa/putita_golosa.png', 1, 11, 8),
(13, 'Rota, Se Camina Igual', 'libros/rota,_se_camina_igual/rota,_se_camina_igual.png', 1, 12, 9),
(14, 'Salvese Quien Pueda !', 'libros/salvese_quien_pueda_!/salvese_quien_pueda_!.png', 1, 13, 1),
(15, 'Teoria King Kong', 'libros/teoria_king_kong/teoria_king_kong.png', 1, 14, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_bin NOT NULL,
  `apellido` varchar(100) COLLATE utf8_bin NOT NULL,
  `comentario` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `genero_favorito` varchar(300) COLLATE utf8_bin NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `comentario`, `email`, `password`, `genero_favorito`, `habilitado`, `admin`) VALUES
(1, 'Martin', 'Perez', 'soy el admin', 'martin.perez@davinci.edu.ar', '$2y$10$nzjNTkMwpQUw/nv8aqqS5uQtU85oOSJ1kZpG4AatxrqbDG2Q6xc56', 'a:1:{i:0;s:7:\"Comedia\";}', 1, 1),
(2, 'Jorge', 'Lopez', 'Que buena pagina!!', 'Jorge.Lopez@davinci.edu.ar', '$2y$10$nzjNTkMwpQUw/nv8aqqS5uQtU85oOSJ1kZpG4AatxrqbDG2Q6xc56', 'a:1:{i:0;s:7:\"Comedia\";}', 1, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

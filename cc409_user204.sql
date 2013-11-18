-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-11-2013 a las 07:32:01
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cc409_user204`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(50) NOT NULL,
  `porcentaje` int(100) NOT NULL,
  `idCurso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `actividad`, `porcentaje`, `idCurso`) VALUES
(1, 'Examen', 30, 1),
(2, 'Tareas', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `id_administrador` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tipo` int(5) NOT NULL,
  PRIMARY KEY (`id_administrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `codigo`, `password`, `nombre`, `tipo`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'God', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `celular` varchar(12) DEFAULT NULL,
  `github` varchar(200) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `tipo` int(5) NOT NULL,
  PRIMARY KEY (`id_alumno`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcar la base de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `codigo`, `password`, `nombre`, `apellidos`, `carrera`, `correo`, `celular`, `github`, `web`, `tipo`) VALUES
(1, 'alumno', '684b10ab8da41b83690bd96f9a846b9814d8a288', 'AlumnoPro', 'Probetin', 'Ingenieria en computacion', 'alumno@alumno.com', NULL, NULL, NULL, 2),
(4, '210681391', 'd162826367decfb3a6b3196b41a5bc3780b4c9fe', 'Adrian', 'Vazquez Esparza', 'computacion', 'adrianvazuquez@gmail.com', '3314986623', '', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_cursos`
--

CREATE TABLE IF NOT EXISTS `alumnos_cursos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(255) NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `alumnos_cursos`
--

INSERT INTO `alumnos_cursos` (`id`, `id_alumno`, `id_curso`) VALUES
(1, 1, 1),
(2, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE IF NOT EXISTS `asistencias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(255) NOT NULL,
  `id_curso` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `asistencia` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Volcar la base de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `id_alumno`, `id_curso`, `fecha`, `asistencia`) VALUES
(1, 1, 1, '2013-10-02', 1),
(2, 1, 1, '2013-10-07', 0),
(3, 1, 1, '2013-10-09', 1),
(4, 1, 1, '2013-10-14', 0),
(5, 1, 1, '2013-10-16', 1),
(6, 1, 1, '2013-10-21', 1),
(7, 1, 1, '2013-10-23', 0),
(8, 1, 1, '2013-10-28', 1),
(9, 1, 1, '2013-10-30', 0),
(10, 1, 1, '2013-11-04', 0),
(11, 1, 1, '2013-11-06', 0),
(12, 1, 1, '2013-11-11', 0),
(13, 1, 1, '2013-11-13', 0),
(14, 1, 1, '2013-11-18', 0),
(15, 1, 1, '2013-11-20', 0),
(16, 1, 1, '2013-11-25', 0),
(17, 1, 1, '2013-11-27', 0),
(18, 1, 1, '2013-12-02', 0),
(19, 1, 1, '2013-12-04', 0),
(20, 1, 1, '2013-12-09', 0),
(21, 1, 1, '2013-12-11', 0),
(22, 1, 1, '2013-12-16', 0),
(23, 1, 1, '2013-12-18', 0),
(24, 1, 1, '2013-12-23', 0),
(25, 1, 1, '2013-12-25', 0),
(26, 1, 1, '2013-12-30', 0),
(27, 1, 1, '2014-01-01', 0),
(28, 4, 1, '2013-10-02', 0),
(29, 4, 1, '2013-10-07', 1),
(30, 4, 1, '2013-10-09', 0),
(31, 4, 1, '2013-10-14', 1),
(32, 4, 1, '2013-10-16', 0),
(33, 4, 1, '2013-10-21', 0),
(34, 4, 1, '2013-10-23', 1),
(35, 4, 1, '2013-10-28', 0),
(36, 4, 1, '2013-10-30', 0),
(37, 4, 1, '2013-11-04', 0),
(38, 4, 1, '2013-11-06', 0),
(39, 4, 1, '2013-11-11', 0),
(40, 4, 1, '2013-11-13', 0),
(41, 4, 1, '2013-11-18', 0),
(42, 4, 1, '2013-11-20', 0),
(43, 4, 1, '2013-11-25', 0),
(44, 4, 1, '2013-11-27', 0),
(45, 4, 1, '2013-12-02', 0),
(46, 4, 1, '2013-12-04', 0),
(47, 4, 1, '2013-12-09', 0),
(48, 4, 1, '2013-12-11', 0),
(49, 4, 1, '2013-12-16', 0),
(50, 4, 1, '2013-12-18', 0),
(51, 4, 1, '2013-12-23', 0),
(52, 4, 1, '2013-12-25', 0),
(53, 4, 1, '2013-12-30', 0),
(54, 4, 1, '2014-01-01', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones_actividades`
--

CREATE TABLE IF NOT EXISTS `calificaciones_actividades` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(255) NOT NULL,
  `id_actividad` int(255) NOT NULL,
  `nombre_actividad` varchar(50) NOT NULL,
  `calificacion` float NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `calificaciones_actividades`
--

INSERT INTO `calificaciones_actividades` (`id`, `id_alumno`, `id_actividad`, `nombre_actividad`, `calificacion`, `id_curso`) VALUES
(1, 1, 1, 'Examen', 30, 1),
(2, 1, 2, 'Tareas', 20, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones_hojas`
--

CREATE TABLE IF NOT EXISTS `calificaciones_hojas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(255) NOT NULL,
  `id_hoja` int(255) NOT NULL,
  `calificacion` float NOT NULL,
  `id_curso` int(255) NOT NULL,
  `id_actividad` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `calificaciones_hojas`
--

INSERT INTO `calificaciones_hojas` (`id`, `id_alumno`, `id_hoja`, `calificacion`, `id_curso`, `id_actividad`) VALUES
(1, 1, 1, 15, 1, 1),
(2, 1, 2, 15, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos`
--

CREATE TABLE IF NOT EXISTS `ciclos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ciclo` varchar(5) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinalizacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `ciclos`
--

INSERT INTO `ciclos` (`id`, `ciclo`, `fechaInicio`, `fechaFinalizacion`) VALUES
(1, '2013A', '2013-10-01', '2014-01-02'),
(2, '2013B', '2013-10-11', '2013-10-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ciclo` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `nrc` int(10) NOT NULL,
  `academia` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `ciclo`, `nombre`, `seccion`, `nrc`, `academia`) VALUES
(1, '2013A', 'Matematicas', 'd05', 87746, 'cienciasBasicas'),
(2, '2013A', 'Fisica', 'd33', 56465, 'cienciasBasicas'),
(4, '2013B', 'Matematicas', 'd05', 87746, 'cienciasBasicas'),
(5, '2013B', 'Matematicas', 'd05', 87746, 'cienciasBasicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diasnoefectivos`
--

CREATE TABLE IF NOT EXISTS `diasnoefectivos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idCiclo` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `diasnoefectivos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojasextras`
--

CREATE TABLE IF NOT EXISTS `hojasextras` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `porcentaje` float NOT NULL,
  `id_actividad` int(255) NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `hojasextras`
--

INSERT INTO `hojasextras` (`id`, `porcentaje`, `id_actividad`, `id_curso`) VALUES
(1, 15, 1, 1),
(2, 15, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idCurso` int(255) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `dia` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcar la base de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `idCurso`, `horaInicio`, `horaFin`, `dia`) VALUES
(5, 1, '07:00:00', '09:00:00', 'Lunes'),
(6, 1, '07:00:00', '09:00:00', 'Miercoles'),
(7, 2, '08:00:00', '10:00:00', 'Sabado'),
(15, 0, '07:00:00', '09:00:00', 'Lunes'),
(16, 0, '07:00:00', '09:00:00', 'Miercoles'),
(17, 0, '07:00:00', '09:00:00', 'Lunes'),
(18, 0, '07:00:00', '09:00:00', 'Miercoles');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
  `id_profesor` int(255) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tipo` int(5) NOT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcar la base de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `codigo`, `password`, `nombre`, `tipo`) VALUES
(1, 'profesor', 'aabb211b66e86d825aaec57dd03bd285590da669', 'ProfesorUltra', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

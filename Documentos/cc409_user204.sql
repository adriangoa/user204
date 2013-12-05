-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-12-2013 a las 04:56:00
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `cc409_user204`
--
CREATE DATABASE IF NOT EXISTS `cc409_user204` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cc409_user204`;

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
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `actividad`, `porcentaje`, `idCurso`) VALUES
(1, 'Examen', 40, 1),
(2, 'Tareas', 60, 1);

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
  `correo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_administrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `codigo`, `password`, `nombre`, `tipo`, `correo`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'God', 0, 'admin@admin.com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `codigo`, `password`, `nombre`, `apellidos`, `carrera`, `correo`, `celular`, `github`, `web`, `tipo`) VALUES
(1, '210681392', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Jose', 'Orozco', 'computacion', 'adrianvazuquez@gmail.com', '', '', '', 2),
(2, '1597534646', 'a39256d32b96c96f7aef751864bceed2b1778e91', 'otro', 'garcia', 'computacion', 'adrianvazuquez@gmail.com', '', '', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos_cursos`
--

CREATE TABLE IF NOT EXISTS `alumnos_cursos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(255) NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `alumnos_cursos`
--

INSERT INTO `alumnos_cursos` (`id`, `id_alumno`, `id_curso`) VALUES
(3, 2, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `id_alumno`, `id_curso`, `fecha`, `asistencia`) VALUES
(1, 1, 1, '2013-12-17', 0),
(2, 1, 1, '2013-12-19', 0),
(3, 1, 1, '2013-12-24', 0),
(4, 1, 1, '2013-12-26', 1),
(5, 1, 1, '2013-12-31', 1),
(6, 1, 1, '2014-01-02', 0),
(7, 1, 1, '2014-01-07', 0),
(8, 1, 1, '2014-01-09', 1),
(9, 1, 1, '2014-01-14', 0),
(10, 1, 1, '2014-01-16', 0),
(11, 1, 1, '2014-01-21', 0),
(12, 1, 1, '2014-01-23', 0),
(13, 1, 1, '2014-01-28', 0),
(14, 1, 1, '2014-01-30', 0),
(15, 1, 1, '2014-02-04', 0),
(16, 1, 1, '2014-02-06', 0),
(17, 1, 1, '2014-02-11', 0),
(18, 1, 1, '2014-02-13', 0),
(19, 1, 1, '2014-02-18', 0),
(20, 1, 1, '2014-02-20', 0),
(21, 1, 1, '2014-02-25', 0),
(22, 1, 1, '2014-02-27', 0),
(23, 1, 1, '2014-03-04', 0),
(24, 1, 1, '2014-03-06', 0),
(25, 1, 1, '2014-03-11', 0),
(26, 1, 1, '2014-03-13', 0),
(27, 1, 1, '2014-03-18', 0),
(28, 1, 1, '2014-03-20', 0),
(29, 1, 1, '2014-03-25', 0),
(30, 1, 1, '2014-03-27', 0),
(31, 1, 1, '2014-04-01', 0),
(32, 1, 1, '2014-04-03', 0),
(33, 1, 1, '2014-04-08', 0),
(34, 1, 1, '2014-04-10', 0),
(35, 1, 1, '2014-04-15', 0),
(36, 1, 1, '2014-04-17', 0),
(37, 1, 1, '2014-04-22', 0),
(38, 1, 1, '2014-04-24', 0),
(39, 1, 1, '2014-04-29', 0),
(40, 1, 1, '2014-05-01', 0),
(41, 1, 1, '2014-05-06', 0),
(42, 1, 1, '2014-05-08', 0),
(43, 1, 1, '2014-05-13', 0),
(44, 1, 1, '2014-05-15', 0),
(45, 1, 1, '2014-05-20', 0),
(46, 1, 1, '2014-05-22', 0),
(47, 1, 1, '2014-05-27', 0),
(48, 1, 1, '2014-05-29', 0),
(49, 1, 1, '2014-06-03', 0),
(50, 1, 1, '2014-06-05', 0);

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
-- Volcado de datos para la tabla `calificaciones_actividades`
--

INSERT INTO `calificaciones_actividades` (`id`, `id_alumno`, `id_actividad`, `nombre_actividad`, `calificacion`, `id_curso`) VALUES
(1, 1, 1, 'Examen', 40, 1),
(2, 1, 2, 'Tareas', 50, 1);

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
-- Volcado de datos para la tabla `calificaciones_hojas`
--

INSERT INTO `calificaciones_hojas` (`id`, `id_alumno`, `id_hoja`, `calificacion`, `id_curso`, `id_actividad`) VALUES
(1, 1, 1, 20, 1, 1),
(2, 1, 2, 20, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `ciclos`
--

INSERT INTO `ciclos` (`id`, `ciclo`, `fechaInicio`, `fechaFinalizacion`) VALUES
(1, '2013B', '2013-12-12', '2014-06-09');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `ciclo`, `nombre`, `seccion`, `nrc`, `academia`) VALUES
(1, '2013B', 'Programacion web', 'd03', 45542, 'electronicaComputacion'),
(2, '2013B', 'Matematicas discretas', 'd45', 54654, 'electronicaComputacion'),
(3, '2013B', 'Ingenieria de Software I', 'd02', 78784, '4');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `diasnoefectivos`
--

INSERT INTO `diasnoefectivos` (`id`, `idCiclo`, `fecha`, `motivo`) VALUES
(1, 1, '2013-12-10', 'nada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hojasextras`
--

CREATE TABLE IF NOT EXISTS `hojasextras` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `porcentaje` float NOT NULL,
  `id_actividad` int(255) NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `hojasextras`
--

INSERT INTO `hojasextras` (`id`, `nombre`, `porcentaje`, `id_actividad`, `id_curso`) VALUES
(1, 'Parcial 1', 20, 1, 1),
(2, 'Parcial 2', 20, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id`, `idCurso`, `horaInicio`, `horaFin`, `dia`) VALUES
(1, 1, '07:00:00', '09:00:00', 'Martes'),
(2, 1, '07:00:00', '09:00:00', 'Jueves'),
(3, 2, '07:00:00', '08:00:00', 'Lunes'),
(4, 3, '07:00:00', '08:00:00', 'Lunes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_academias`
--

CREATE TABLE IF NOT EXISTS `materias_academias` (
  `clave` varchar(5) DEFAULT NULL,
  `nombre_materia` varchar(93) DEFAULT NULL,
  `academia_id` varchar(11) DEFAULT NULL,
  `nombre_academia` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materias_academias`
--

INSERT INTO `materias_academias` (`clave`, `nombre_materia`, `academia_id`, `nombre_academia`) VALUES
('CC100', 'Introduccion a la Computacion', '1', 'Computacion Basica'),
('CC101', 'Taller de Introduccion a la Computacion', '1', 'Computacion Basica'),
('CC102', 'Introduccion a la Programacion', '2', 'Programacion Basicas'),
('CC103', 'Taller de Programacion Estructurada', '2', 'Programacion Basicas'),
('CC108', 'Programacion Estructurada', '2', 'Programacion Basicas'),
('CC109', 'Programacion para Interfaces', '8', 'Tecnicas Modernas de Programacion'),
('CC200', 'Programacion Orientada a Objetos', '8', 'Tecnicas Modernas de Programacion'),
('CC201', 'Taller de Programacion Orientada a Objetos', '8', 'Tecnicas Modernas de Programacion'),
('CC202', 'Estructura de Datos', '3', 'Estructuras y algoritmos'),
('CC203', 'Taller de Estructura de Datos', '3', 'Estructuras y algoritmos'),
('CC204', 'Estructura de Archivos', '3', 'Estructuras y algoritmos'),
('CC205', 'Taller de Estructura de Archivos', '3', 'Estructuras y algoritmos'),
('CC206', 'Programacion de Sistemas', '7', 'Software de Sistemas'),
('CC207', 'Taller de Programacion de Sistemas', '7', 'Software de Sistemas'),
('CC208', 'Lenguajes de Programacion Comparados', '8', 'Tecnicas Modernas de Programacion'),
('CC209', 'Teoria de la Computacion', '3', 'Estructuras y algoritmos'),
('CC210', 'Arquitectura de Computadoras', '6', 'Sistemas Digitales'),
('CC211', 'TeleInformatica', '6', 'Sistemas Digitales'),
('CC212', 'Redes de Computadoras', '6', 'Sistemas Digitales'),
('CC213', 'Taller de Redes de Computadoras', '6', 'Sistemas Digitales'),
('CC300', 'Sistemas Operativos', '7', 'Software de Sistemas'),
('CC301', 'Taller de Sistemas Operativos', '7', 'Software de Sistemas'),
('CC302', 'Bases de Datos', '5', 'Sistemas de Informacion'),
('CC303', 'Taller de Bases de Datos', '5', 'Sistemas de Informacion'),
('CC304', 'Ingenieria de Software I', '4', 'Ingenieria de software'),
('CC305', 'Ingenieria de Software II', '4', 'Ingenieria de software'),
('CC306', 'Taller de Ingenieria de Software II', '4', 'Ingenieria de software'),
('CC307', 'Programacion Logica y Funcional', '8', 'Tecnicas Modernas de Programacion'),
('CC308', 'Taller de Programacion Logica y Funcional', '8', 'Tecnicas Modernas de Programacion'),
('CC309', 'Bases de Datos Avanzadas', '5', 'Sistemas de Informacion'),
('CC310', 'Taller de Bases de Datos Avanzadas', '5', 'Sistemas de Informacion'),
('CC311', 'Graficas por Computadora', '7', 'Software de Sistemas'),
('CC312', 'Taller de Graficas por Computadora', '10', ''),
('CC313', 'Administracion de Bases de Datos', '5', 'Sistemas de Informacion'),
('CC314', 'Taller de Administracion de Bases de Datos', '5', 'Sistemas de Informacion'),
('CC315', 'Sistemas de Informacion Administrativos', '5', 'Sistemas de Informacion'),
('CC316', 'Analisis yDise', '3', 'Estructuras y algoritmos'),
('CC317', 'Compiladores', '10', ''),
('CC318', 'Taller de Compiladores', '7', 'Software de Sistemas'),
('CC319', 'Sistemas Operativos Avanzados', '7', 'Software de Sistemas'),
('CC320', 'Taller de Sistemas Operativos Avanzados', '7', 'Software de Sistemas'),
('CC321', 'Fundamentos de Ingenieria de Software', '4', 'Ingenieria de software'),
('CC322', 'Organizacion de Computadoras I', '6', 'Sistemas Digitales'),
('CC323', 'Organizacion de Computadoras II', '6', 'Sistemas Digitales'),
('CC324', 'Redes de Computadoras Avanzadas', '6', 'Sistemas Digitales'),
('CC325', 'Taller de Redes Avanzadas', '6', 'Sistemas Digitales'),
('CC400', 'Sistemas Expertos', '8', 'Tecnicas Modernas de Programacion'),
('CC401', 'Programacion de Sistemas Multimedia', '5', 'Sistemas de Informacion'),
('CC402', 'Taller de Sistemas Multimedia', '5', 'Sistemas de Informacion'),
('CC403', 'Auditoría de Sistemas', '4', 'Ingenieria de software'),
('CC404', 'Sistemas de Informacion Financieros', '5', 'Sistemas de Informacion'),
('CC405', 'Sistemas de Informacion para la Manufactura', '5', 'Sistemas de Informacion'),
('CC406', 'Sistemas de Informacion para la Toma de Decisiones', '5', 'Sistemas de Informacion'),
('CC407', 'Proyecto Terminal', '4', 'Ingenieria de software'),
('CC408', 'Simulacion de Sistemas Digitales', '6', 'Sistemas Digitales'),
('CC409', 'Arquitectura de Computadoras Avanzada', '6', 'Sistemas Digitales'),
('CC410', 'Redes Neuronales Artificiales', '8', 'Tecnicas Modernas de Programacion'),
('CC411', 'Computacion Tolerante a Fallas', '7', 'Software de Sistemas'),
('CC413', 'Programacion Concurrente y Distribuida', '7', 'Software de Sistemas'),
('CC414', 'Taller de Programacion Concurrente y Distribuida', '7', 'Software de Sistemas'),
('CC415', 'Inteligencia Artificial', '8', 'Tecnicas Modernas de Programacion'),
('CC417', 'Topicos Selectos de Computacion I (Robotica Movil)', '7', 'Software de Sistemas'),
('CC417', 'Topicos Selectos de Computacion I (Administracion de Servidores Microsoft)', '7', 'Software de Sistemas'),
('CC417', 'Topicos Selectos de Computacion I (Control de Proyectos)', '4', 'Ingenieria de software'),
('CC418', 'Topicos Selectos de Computacion II (Unix y Linux)', '7', 'Software de Sistemas'),
('CC419', 'Topicos Selectos de Computacion III (Java Avanzado)', '8', 'Tecnicas Modernas de Programacion'),
('CC419', 'Topicos Selectos de Computacion III (Programacion Web)', '8', 'Tecnicas Modernas de Programacion'),
('CC420', 'Topicos Selectos de Informatica I (Programacion de iPod y iPhone)', '7', 'Software de Sistemas'),
('CC420', 'Topicos Selectos de Informatica I (Interconexion de redes)', '6', 'Sistemas Digitales'),
('CC420', 'Topicos Selectos de Informatica I (Comercio Electronico)', '4', 'Ingenieria de software'),
('CC421', 'Topicos Selectos de Informatica II (Programacion de iPod y iPhone)', '7', 'Software de Sistemas'),
('CC421', 'Topicos Selectos de Informatica II', '8', 'Tecnicas Modernas de Programacion'),
('CC421', 'Topicos Selectos de Informatica II', '4', 'Ingenieria de software'),
('CC422', 'Topicos Selectos de Informatica III (C#)', '8', 'Tecnicas Modernas de Programacion'),
('CC422', 'Topicos Selectos de Informatica III (Software libre)', '7', 'Software de Sistemas'),
('I5882', 'Programacion', '10', ''),
('I5883', 'Seminario de Solucion de Problemas de Programacion', '10', ''),
('I5884', 'Algoritmia', '10', ''),
('I5885', 'Seminario de Solucion de Problemas de Algoritmia', '10', ''),
('I5886', 'Estructuras de Datos I', '10', ''),
('I5887', 'Seminario de Solucion de Problemas de Estructuras de Datos I', '10', ''),
('I5888', 'Estructuras de Datos II', '10', ''),
('I5889', 'Seminario de Solucion de Problemas de Estructuras de Datos II', '10', ''),
('I5890', 'Bases de Datos', '10', ''),
('I5891', 'Seminario de Solucion de Problemas de Bases de Datos', '10', ''),
('I5898', 'Ingenieria de Software I', '10', ''),
('I5899', 'Seminario de Solucion de Problemas de Ingenieria de Software I', '10', ''),
('I5900', 'Ingenieria de Software II', '10', ''),
('I5902', 'Administracion de Bases de Datos', '10', ''),
('I5903', 'Uso, Adaptacion y Explotacion de Sistemas Operativos', '10', ''),
('I5904', 'Seminario de Solucion de Problemas de Uso, Adaptacion y Explotacion de Sistemas Operativos', '10', ''),
('I5905', 'Seguridad de la Informacion', '10', ''),
('I5906', 'Almacenes de Datos (Data Warehouse)', '10', ''),
('I5907', 'Administracion de Redes', '10', ''),
('I5908', 'Administracion de Servidores', '10', ''),
('I5909', 'Programacion para Internet', '10', ''),
('I5910', 'Hypermedia', '10', ''),
('I5911', 'Mineria de Datos', '10', ''),
('I5912', 'Clasificacion Inteligente de Datos', '10', ''),
('I5913', 'Sistemas Basados en Conocimiento', '10', ''),
('I5914', 'Seminario de Solucion de Problemas de Sistemas Basados en Conocimiento', '10', ''),
('I5915', 'Teoria de la Computacion', '10', ''),
('I7022', 'Fundamentos Filosoficos de la Computacion', '10', ''),
('I7023', 'Arquitectura de Computadoras', '10', ''),
('I7024', 'Seminario de Solucion de Problemas de Arquitectura de Computadoras', '10', ''),
('I7025', 'Traductores de Lenguajes I', '10', ''),
('I7026', 'Seminario de Solucion de Problemas de Traductores de Lenguajes I', '10', ''),
('I7027', 'Traductores de Lenguajes II', '10', ''),
('I7028', 'Seminario de Solucion de Problemas de Traductores de Lenguaje II', '10', ''),
('I7029', 'Sistemas Operativos', '10', ''),
('I7030', 'Seminario de Solucion de Problemas de Sistemas Operativos', '10', ''),
('I7031', 'Redes de computadoras y Protocolos de Comunicacion', '10', ''),
('I7032', 'Seminario de Solucion de Problemas de Redes de Computadoras y Protocolos de Comunicacion', '10', ''),
('I7033', 'Sistemas Operativos de Red', '10', ''),
('I7034', 'Seminario de Solucion de Problemas de Sistemas Operativos en Red', '10', ''),
('I7035', 'Sistemas Concurrentes y Distribuidos', '10', ''),
('I7036', 'Computacion tolerante a fallas', '10', ''),
('I7037', 'Seguridad', '10', ''),
('I7038', 'Inteligencia Artificial I', '10', ''),
('I7039', 'Seminario de Solucion de Problemas de Inteligencia Artificial I', '10', ''),
('I7040', 'Inteligencia Artificial II', '10', ''),
('I7041', 'Seminario de Solucion de Problemas de Inteligencia Artificial II', '10', ''),
('I7042', 'Simulacion por Computadora', '10', ''),
('I7609', 'Procesamiento de Bioimagenes', '10', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
  `id_profesor` int(255) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `tipo` int(5) NOT NULL,
  `correo` varchar(100) NOT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `codigo`, `password`, `nombre`, `apellidos`, `tipo`, `correo`) VALUES
(1, '210681391', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Adrian', 'Vazquez', 1, 'adrianvazuquez@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

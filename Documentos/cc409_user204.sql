-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2013 at 01:36 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cc409_user204`
--
CREATE DATABASE IF NOT EXISTS `cc409_user204` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cc409_user204`;

-- --------------------------------------------------------

--
-- Table structure for table `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actividad` varchar(50) NOT NULL,
  `porcentaje` int(100) NOT NULL,
  `idCurso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `actividades`
--

INSERT INTO `actividades` (`id`, `actividad`, `porcentaje`, `idCurso`) VALUES
(1, 'Examen', 40, 1),
(2, 'Tareas', 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `administradores`
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
-- Dumping data for table `administradores`
--

INSERT INTO `administradores` (`id_administrador`, `codigo`, `password`, `nombre`, `tipo`, `correo`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'God', 0, 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `codigo`, `password`, `nombre`, `apellidos`, `carrera`, `correo`, `celular`, `github`, `web`, `tipo`) VALUES
(1, '210681392', '1acf49f163e9e0fffebba9cad1446d7f9594bce8', 'Jose', 'Orozco', 'computacion', 'adrianvazuquez@gmail.com', '', '', '', 2);

-- --------------------------------------------------------

--
-- Table structure for table `alumnos_cursos`
--

CREATE TABLE IF NOT EXISTS `alumnos_cursos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `id_alumno` int(255) NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `alumnos_cursos`
--

INSERT INTO `alumnos_cursos` (`id`, `id_alumno`, `id_curso`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asistencias`
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
-- Dumping data for table `asistencias`
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
-- Table structure for table `calificaciones_actividades`
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
-- Dumping data for table `calificaciones_actividades`
--

INSERT INTO `calificaciones_actividades` (`id`, `id_alumno`, `id_actividad`, `nombre_actividad`, `calificacion`, `id_curso`) VALUES
(1, 1, 1, 'Examen', 40, 1),
(2, 1, 2, 'Tareas', 50, 1);

-- --------------------------------------------------------

--
-- Table structure for table `calificaciones_hojas`
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
-- Dumping data for table `calificaciones_hojas`
--

INSERT INTO `calificaciones_hojas` (`id`, `id_alumno`, `id_hoja`, `calificacion`, `id_curso`, `id_actividad`) VALUES
(1, 1, 1, 20, 1, 1),
(2, 1, 2, 20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ciclos`
--

CREATE TABLE IF NOT EXISTS `ciclos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ciclo` varchar(5) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinalizacion` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ciclos`
--

INSERT INTO `ciclos` (`id`, `ciclo`, `fechaInicio`, `fechaFinalizacion`) VALUES
(1, '2013B', '2013-12-12', '2014-06-09');

-- --------------------------------------------------------

--
-- Table structure for table `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `ciclo` varchar(5) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `nrc` int(10) NOT NULL,
  `academia` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cursos`
--

INSERT INTO `cursos` (`id`, `ciclo`, `nombre`, `seccion`, `nrc`, `academia`) VALUES
(1, '2013B', 'Programacion web', 'd03', 45542, 'electronicaComputacion');

-- --------------------------------------------------------

--
-- Table structure for table `diasnoefectivos`
--

CREATE TABLE IF NOT EXISTS `diasnoefectivos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idCiclo` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diasnoefectivos`
--

INSERT INTO `diasnoefectivos` (`id`, `idCiclo`, `fecha`, `motivo`) VALUES
(1, 1, '2013-12-10', 'nada');

-- --------------------------------------------------------

--
-- Table structure for table `hojasextras`
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
-- Dumping data for table `hojasextras`
--

INSERT INTO `hojasextras` (`id`, `nombre`, `porcentaje`, `id_actividad`, `id_curso`) VALUES
(1, 'Parcial 1', 20, 1, 1),
(2, 'Parcial 2', 20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `horarios`
--

CREATE TABLE IF NOT EXISTS `horarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `idCurso` int(255) NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `dia` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `horarios`
--

INSERT INTO `horarios` (`id`, `idCurso`, `horaInicio`, `horaFin`, `dia`) VALUES
(1, 1, '07:00:00', '09:00:00', 'Martes'),
(2, 1, '07:00:00', '09:00:00', 'Jueves');

-- --------------------------------------------------------

--
-- Table structure for table `profesores`
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
-- Dumping data for table `profesores`
--

INSERT INTO `profesores` (`id_profesor`, `codigo`, `password`, `nombre`, `apellidos`, `tipo`, `correo`) VALUES
(1, '210681391', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Adrian', 'Vazquez', 1, 'adrianvazuquez@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

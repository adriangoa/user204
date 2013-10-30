-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-09-2013 a las 15:19:18
-- Versión del servidor: 5.1.41
-- Versión de PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `califix`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE IF NOT EXISTS `administrador` (
  `id_administrador` int(255) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id_administrador`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `administrador`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(60) NOT NULL,
  `carrera` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `celular` varchar(15) NOT NULL,
  `github` varchar(255) NOT NULL,
  `web` varchar(255) NOT NULL,
  `estatus` int(1) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `alumnos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asitencia`
--

CREATE TABLE IF NOT EXISTS `asitencia` (
  `id_curso` int(255) NOT NULL,
  `fecha` date NOT NULL,
  `aistencia` int(1) NOT NULL,
  `codigo` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `asitencia`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones-usuarios`
--

CREATE TABLE IF NOT EXISTS `calificaciones-usuarios` (
  `codigo_usuario` varchar(50) NOT NULL,
  `id_actividad` int(255) NOT NULL,
  `calificacion` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `calificaciones-usuarios`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciclos`
--

CREATE TABLE IF NOT EXISTS `ciclos` (
  `ciclo` varchar(10) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`ciclo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `ciclos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion-actividades`
--

CREATE TABLE IF NOT EXISTS `configuracion-actividades` (
  `id_actividad` int(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `porcentaje` int(100) NOT NULL,
  `id_curso` int(255) NOT NULL,
  PRIMARY KEY (`id_actividad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `configuracion-actividades`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `seccion` varchar(10) NOT NULL,
  `nrc` varchar(10) NOT NULL,
  `academia` varchar(50) NOT NULL,
  `ciclo` varchar(10) NOT NULL,
  `id_profesor` int(255) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `cursos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias-no-efectivos`
--

CREATE TABLE IF NOT EXISTS `dias-no-efectivos` (
  `ciclo` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `motivo` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `dias-no-efectivos`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE IF NOT EXISTS `profesores` (
  `id_profesor` int(255) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_profesor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcar la base de datos para la tabla `profesores`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

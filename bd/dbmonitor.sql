-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-04-2014 a las 06:19:32
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `dbmonitor`
--
CREATE DATABASE IF NOT EXISTS `dbmonitor` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbmonitor`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_company` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `fk_company`, `description`, `status`) VALUES
(51, 1, 'Funcionales', 1),
(52, 1, 'Personales', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_country` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `code` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `gps_time` int(11) NOT NULL,
  `gps_distance` int(11) NOT NULL,
  `idle_time` int(11) NOT NULL,
  `bytes` float NOT NULL,
  `inactive_time` int(11) NOT NULL,
  `logo` longblob NOT NULL,
  `logo_type` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `companies`
--

INSERT INTO `companies` (`id`, `fk_country`, `name`, `code`, `gps_time`, `gps_distance`, `idle_time`, `bytes`, `inactive_time`, `logo`, `logo_type`, `status`) VALUES
(1, 1, 'FlushOut Solutions', 'FOT014', 31, 47, 58, 0, 10, '', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_language` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`id`, `fk_language`, `name`, `status`) VALUES
(1, 1, 'United States', 1),
(2, 2, 'Brasil', 1),
(3, 3, 'Peru', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descriptions`
--

CREATE TABLE IF NOT EXISTS `descriptions` (
  `id` int(11) NOT NULL,
  `fk_language` int(11) NOT NULL,
  `description` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `descriptions`
--

INSERT INTO `descriptions` (`id`, `fk_language`, `description`, `active`) VALUES
(1, 1, 'Dashboard', 1),
(1, 2, 'Dashboard', 1),
(1, 3, 'Dashboard', 1),
(2, 1, 'Mobile', 1),
(2, 2, 'Móvel', 1),
(2, 3, 'Móvil', 1),
(3, 1, 'GPS', 1),
(3, 2, 'GPS', 1),
(3, 3, 'GPS', 1),
(4, 1, 'Map', 1),
(4, 2, 'Mapa', 1),
(4, 3, 'Mapa', 1),
(5, 1, 'Route', 1),
(5, 2, 'Recorrido', 1),
(5, 3, 'Percurso', 1),
(6, 1, 'Maintenance', 1),
(6, 2, 'Manutenção', 1),
(6, 3, 'Mantenimiento', 1),
(7, 1, 'Users', 1),
(7, 2, 'Usuarios', 1),
(7, 3, 'Usuarios', 1),
(8, 1, 'Points', 1),
(8, 2, 'Pontos', 1),
(8, 3, 'Puntos', 1),
(9, 1, 'Categories', 1),
(9, 2, 'Categorias', 1),
(9, 3, 'Categorias', 1),
(10, 1, 'Reports', 1),
(10, 2, 'Relatorios', 1),
(10, 3, 'Reportes', 1),
(11, 1, 'Stays', 1),
(11, 2, 'Estadia', 1),
(11, 3, 'Estadia', 1),
(12, 1, 'Inbox', 1),
(12, 2, 'Inbox', 1),
(12, 3, 'Inbox', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `languages`
--

INSERT INTO `languages` (`id`, `name`, `status`) VALUES
(1, 'English', 1),
(2, 'Português', 1),
(3, 'Español', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobiles`
--

CREATE TABLE IF NOT EXISTS `mobiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fk_status` int(11) DEFAULT NULL,
  `fk_category` int(11) DEFAULT NULL,
  `fk_company` int(11) DEFAULT NULL,
  `manufacturer` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `model` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `warranty` datetime DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contact` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `mobiles`
--

INSERT INTO `mobiles` (`id`, `imei`, `fk_status`, `fk_category`, `fk_company`, `manufacturer`, `model`, `warranty`, `name`, `contact`, `email`, `password`, `status`, `create_date`, `last_update`) VALUES
(6, '353229050830973', 1, 1, 1, 'Test', 'Test', '2014-04-30 00:00:00', 'Test', 'Test', 'Test@test.com', '1234', 1, '2014-04-20 00:00:00', '2014-04-15 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_applications`
--

CREATE TABLE IF NOT EXISTS `mobile_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `package` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `allowed` tinyint(1) NOT NULL,
  `installed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `mobile_applications`
--

INSERT INTO `mobile_applications` (`id`, `imei`, `name`, `package`, `allowed`, `installed`) VALUES
(1, '353229050830973', 'Test1', 'pck Test1', 1, 1),
(2, '353229050830973', 'Test2', 'pck Test2', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_data`
--

CREATE TABLE IF NOT EXISTS `mobile_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `date` datetime NOT NULL,
  `phonenumber` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `speed` float NOT NULL,
  `bearing` float NOT NULL,
  `accuracy` float NOT NULL,
  `batterylevel` float NOT NULL,
  `gsmstrength` float NOT NULL,
  `carrier` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `bytes_rx` float NOT NULL,
  `bytes_tx` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `mobile_data`
--

INSERT INTO `mobile_data` (`id`, `imei`, `date`, `phonenumber`, `latitude`, `longitude`, `speed`, `bearing`, `accuracy`, `batterylevel`, `gsmstrength`, `carrier`, `bytes_rx`, `bytes_tx`) VALUES
(1, '353229050830973', '2014-04-20 00:00:00', '5511965766464', -23.5109, -46.6928, 7.39347, 349.01, 6, 0.25, 19, 'Claro', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_settings`
--

CREATE TABLE IF NOT EXISTS `mobile_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `wifi` tinyint(1) DEFAULT NULL,
  `screen` tinyint(1) DEFAULT NULL,
  `localsafety` tinyint(1) DEFAULT NULL,
  `apps` tinyint(1) DEFAULT NULL,
  `accounts` tinyint(1) DEFAULT NULL,
  `privacy` tinyint(1) DEFAULT NULL,
  `storage` tinyint(1) DEFAULT NULL,
  `keyboard` tinyint(1) DEFAULT NULL,
  `voice` tinyint(1) DEFAULT NULL,
  `accessibility` tinyint(1) DEFAULT NULL,
  `about` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `mobile_settings`
--

INSERT INTO `mobile_settings` (`id`, `imei`, `wifi`, `screen`, `localsafety`, `apps`, `accounts`, `privacy`, `storage`, `keyboard`, `voice`, `accessibility`, `about`) VALUES
(4, '353229050830973', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_statuses`
--

CREATE TABLE IF NOT EXISTS `mobile_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_description` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  `class` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `modules`
--

INSERT INTO `modules` (`id`, `fk_description`, `parent`, `type`, `class`, `status`) VALUES
(14, 1, NULL, 'l', 'icofont-dashboard', 1),
(15, 2, NULL, 'l', 'icofont-th-large', 1),
(16, 3, NULL, 'l', 'icofont-magnet', 1),
(17, 4, 16, 'l', NULL, 1),
(18, 5, 16, 'l', NULL, 1),
(19, 6, NULL, 'l', 'icofont-table', 1),
(20, 7, 19, 'l', NULL, 1),
(21, 8, 19, 'l', NULL, 1),
(22, 9, 19, 'l', NULL, 1),
(23, 10, NULL, 'l', 'icofont-bar-chart', 1),
(24, 11, 23, 'l', NULL, 1),
(25, 12, NULL, 'r', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `addr_street` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `addr_number` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `addr_district` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `addr_city` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `addr_state` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `add_postalcode` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `radius` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `explanation` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id`, `description`, `explanation`, `status`) VALUES
(1, 'Admin', 'Access to all', 1),
(2, 'Usuarios', 'Acces to user module', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile_modules`
--

CREATE TABLE IF NOT EXISTS `profile_modules` (
  `fk_profile` int(11) NOT NULL,
  `fk_module` int(11) NOT NULL,
  `url` varchar(200) NOT NULL,
  `start_module` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profile_modules`
--

INSERT INTO `profile_modules` (`fk_profile`, `fk_module`, `url`, `start_module`) VALUES
(1, 14, '/pages/dashboard.php', NULL),
(1, 15, '/pages/mobile.php', NULL),
(1, 16, '#', NULL),
(1, 17, '/pages/map.php', NULL),
(1, 18, '/pages/route.php', NULL),
(1, 19, '#', NULL),
(1, 20, '/pages/users.php', 1),
(1, 21, '/pages/points.php', NULL),
(1, 22, '/pages/categories.php', NULL),
(1, 23, '#', NULL),
(1, 24, '/pages/stays.php', NULL),
(1, 25, '#', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_company` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `create_date` datetime NOT NULL,
  `create_user` int(11) NOT NULL,
  `update_date` datetime NOT NULL,
  `update_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `fk_company`, `name`, `email`, `password`, `status`, `create_date`, `create_user`, `update_date`, `update_user`) VALUES
(8, 1, 'Manuel Moyano', 'admin@flushoutsolutions.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2014-04-13 00:00:00', 0, '0000-00-00 00:00:00', 0),
(10, 1, 'Juan', 'manuel7_77@hotmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `fk_user` int(11) NOT NULL,
  `fk_profile` int(11) NOT NULL,
  `first_profile` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_profiles`
--

INSERT INTO `user_profiles` (`fk_user`, `fk_profile`, `first_profile`) VALUES
(8, 1, 1),
(10, 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-04-2014 a las 03:10:34
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=56 ;

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
(1, 1, 'FlushOut Solutions', 'FOT014', 60, 3, 10, 0, 10, 0x474946383961cd008200f500000000001111112222223333334444445555556666667777772a8ebf5fc0bb3996c4479ec855a5cc63add171b4d56ac5c075c9c57fcdc9888888999999aaaaaabbbbbb80bcd98ad1ce8ec3dd95d5d29fdad7aadedb9ccbe2aad2e6b8daeab5e2e0bfe6e4ccccccddddddc7e1eecaeae9d5efedd5e9f3dff3f2eeeeeee3f0f7eaf7f6f1f8fbf5fbfb00000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000021f9040100002d002c00000000cd0082000006fec09670482c1a8fc8a472c96c3a9fd0a8744aad5aafd8ac76cbed7abfe0b0784c2e9bcfe8b47acd6ebbdff0b87c4eafdbeff8bc7ecfeffbff808149151315152182898907008d8e078a917c048e8e14929857211307049e9f9e05070714874f21958d0199ac5022120501a9b3b400039ea31286bb0705b404adc149af03b5c6c7c8a912c2cc432206c9d1d2b422cdc2cfd3d9d902d6c107b2dae1c906dd9921c5e2e9c797e59113e0eaf1b328ed8928d0f2f995c0f58128e8fa024ee807e85fc083dc08fa3178306005857d1836cc470ee21e8913e30db0781160467503e871cce3eb63bc022247de9160525d80812af1a06aa92d80019831efa010900dd7fea852bb2a8c1a3a0a94d1503f2ba4cc898711329b1310318d29029980094ba7aaa4640c5214439c3aa1d42aa982b1000f9384a820e18001021e2b7925ab88ebac00528f8828992c21dd443369e53512025e32767f05e19b35d7c8ce69fc12fbab15202b11bed1d24a0634a156c5239da715d82c28ee2324220c27d34cba4fd55a8d89d88de6b7759fd0b47012319b2db66d3d8b191fe1998df56f3dc469d516827bdaf188c896c9d6b6f1f91ede67f3069ef6d93a1e96c8420a092ecdb7773a4ec357531d4df7f93ae99fc69f66fcfd9cf919eb1fa920cafe19fc13595644055c99e7df170036a4c404c90120dd816334f711121234d8887e1076f15a4b45fe88f04d2d1866c8c56c190981c20424ce12a2885a60f71105e419c3221929d224e38c626064e38d388681428d3b3ab25c8f5f8017e42c911119860840da98a4926110a88a8b2d3d09e59206ac15a481577eb1d7965d92814d90012016a61763ee288004029e89050a1fee38807b6e6ef14e9004ac5867154cee68939e7b5251988d056015e81714b077500114d08301061d9c31c2a329506102071634a0690390aec011052d09b014020834700606a48e20c5080d90eaeaab0858e0a9421636341a11a49a6a06aa08a80a05afaf36b000ac0a9890c50a238c50e91d124ef4a010b99e9aeaafae36e0c1ac42a4c0c1b008148bc508a462800766190dd642b4febb4eeb04b8a4468ac40a1690cac0b7e1e241d390e896c1abaf4d3850ef120cb47b05bbe2da41e544b7e25aaab4bd3ab102a90a34e101a90e0cfc2f7cc718404182ed19916f0b2668ea6e11213730f210da62b0e9a6c60eb1ef0816045caa05fc0ec1ae054e90ba00111d68da72113d37d0b2ca322fb0b2d07190db88000788d46432967d4cf011530fb182bfb0ba5a33afad661d6b111c5c0c30a944ec7b84d92d74ed75c368d0d9028901344d843a092bacab1055179177da6bab2b04b0b96aaa80ab1e944d6ae14d746d38db45a0adb6d7354728407545cc26f76eeab82db5d8365f9c02c41d608b04b01c1001efc76833a1b8cb7e2f5ef3de6730d848fe7743704580b94270fc94809b2350b0de17c33e3aa9381b313802ae3bb1fadfadb3ce780bc24b2ed711049499c4d31923d1fbef44e4cdeedd4aa44ec4f22d88af04f9e633ff7cf460c89e8a9943b099040aea5473c4f6548b7dfc021cfc7c76f3ea4b5ee2c8e6bcc8a9ef759c6b5fad2e24055089837676eb5e02a127b689bd6a0116385901ff87bc0d0eb08307e420027d273d63b449094a9306ee86803f23c02e05f12216e23cd83802aaaf741f14600dd737c11699661652a0df0395d042e091d0082bf08005b875381d2e8e0816e41e116d583e0056918747ec8294fa22856649c37eda5b58e7b22841321e2105589b170d9f380413c8ab096e146308fe8d203ef655618bd1b012137e980c2e414b8e1434a310c286001c2e815b4e745e11b8654023608d7bbc9a2111b0e63f3b4ec148d2a85b130e461b267cec6108d89911bad64823c82c910124022115203a23740062a2b360f14c77bc227cee6b5b70e034fc788414aec693806c01b764653560b5f20884045ffaae684ad01d6105c092e22d0b490434beb108c7f3df1538790c5e76481cde3c57305f592d4dbd8a7b253bdaf11070b265f2ca08265827061ff5a8c7cd920831ec96a66406406031806557d046386b170ef100137ceaf3da3d03b93629ba938a567b9cd71420c588ae4d011a14c20af8a9b580f6e609dc3c065e7216cc6c110d01ffc4803619fe2aaf06388003cb42253391003326ba8a011838a6de32352c4dc134092be04003f859ca27602f15036d011fd7d18f648d60a5c0f9681374570bb71d8a09544d851e09138ea472a10419804002c63a56285c20015728410236709d9e30e131d978d619343056085ce0ae77352b5a9f7001b61241ad7ecd8310a771c216e82819561dc30912f0801258e1ac5048c0058ac08212a8800f313a865c89700e6d24760c1f58eb1520fb04c92a22a4b5d82c9c6a02a8308040b44b388106f0fa81cb0e81b42d00c1054e4004ddf27603677d005e41d082135c80b843500170efba01db0e81051fc0ab061c4b04e52ef7b85a386a2a0470134ef8f2186369830ac6fafe01256c80ac647d006f8580dbf3525708ee6dc159d12b5ac00ee1b5f44d00099e1b81fc0616bfe80dac2614f591006c760df87d800640e05c218cf701c865015d27cbdebdb620be43c0700b4cfb57d8b6e0010928af1042fb80fb262002ebc52f0b8420d60facb70bbaa40901c00807e58a75ac17786f6805dc02b1ae58be16d6f08513f05e0e0fc1be2d506b068a900122c357bf44683275c7fa634411581f0368ed1a5410ddb12257c82d90728533ec64321799c24786ed79797cde2f97f9c9d46d320436f0de2e74762204f8ec1c5e0b01381701c3ed7df390cf5c0424aff9cf6a163486259c5e0d54990b71a2889eeb50d641239aba81aeb3868d2c04fe437bf8c97e15b2905900020d8018cd5d38d102a311804215160f956e7311cebade4c1361d3a84e326c49f0e921efd7d2663e020b403c861074421a0490c00afd70de25b780d7a87ef06d839c000d3c57ac2f4e409f3becd7f142a0ca2c10ab6d452d682288f50c6b690b5148a19440587703f0be8058d53b04b1f615de200e2c6ec77be20d989ad3679d339d75ad6f6dc37b03f60eb6c24170708473fa3d6aa52f0434d0e0138038bd02c6edb36f3c564713e104fd1d2b5b91dc0216849cac1ef7b3c2e78bf247bfa7b22588f98b8da08298c7dc0827a8b3102a3bf322d4dcb22507fa736d5e0297d7fcd1471742ce63dee0ab3afde9508fbad4a74ef5aa155bfdea58cfbad6b7cef5ae7bfdeb600fbbd8551204003b, 'gif', 1);

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
  `imei` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `manufacturer` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `model` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `warranty` datetime NOT NULL,
  `name` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `contact` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobile_settings`
--

CREATE TABLE IF NOT EXISTS `mobile_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imei` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `screen` tinyint(1) NOT NULL,
  `localsafety` tinyint(1) NOT NULL,
  `apps` tinyint(1) NOT NULL,
  `accounts` tinyint(1) NOT NULL,
  `privacy` tinyint(1) NOT NULL,
  `storage` tinyint(1) NOT NULL,
  `keyboard` tinyint(1) NOT NULL,
  `voice` tinyint(1) NOT NULL,
  `accessibility` tinyint(1) NOT NULL,
  `about` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

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

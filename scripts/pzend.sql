-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 14-06-2012 a las 13:52:29
-- Versión del servidor: 5.1.50
-- Versión de PHP: 5.3.9-ZS5.6.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pzend`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_modules`
--

CREATE TABLE IF NOT EXISTS `acl_modules` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`module_id`),
  UNIQUE KEY `module_name` (`module_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `acl_modules`
--

INSERT INTO `acl_modules` (`module_id`, `module_name`) VALUES
(1, 'default'),
(2, 'admin'),
(3, 'users'),
(15, 'mailer'),
(5, 'frontend'),
(16, 'staticcontent');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_permissions`
--

CREATE TABLE IF NOT EXISTS `acl_permissions` (
  `permission_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(1) NOT NULL,
  `resource_uid` int(4) NOT NULL,
  `permission` varchar(64) NOT NULL,
  `name` varchar(250) NOT NULL,
  `menu` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Volcar la base de datos para la tabla `acl_permissions`
--

INSERT INTO `acl_permissions` (`permission_id`, `role_id`, `resource_uid`, `permission`, `name`, `menu`) VALUES
(1, 4, 1, 'index', 'Index', 0),
(9, 6, 8, 'index', 'frontend', 1),
(11, 6, 11, 'login', 'login', 0),
(12, 6, 11, 'logout', 'logout', 0),
(34, 6, 20, 'index', 'index', 0),
(36, 1, 22, 'index', 'index users', 0),
(37, 1, 38, 'add', 'add users', 0),
(38, 1, 38, 'edit', 'edit users', 0),
(39, 1, 38, 'delete', 'delete users', 0),
(40, 1, 38, 'editpassword', 'editPassword User', 0),
(41, 1, 23, 'index', 'index resources', 0),
(42, 1, 23, 'add', 'add resources', 0),
(43, 1, 23, 'edit', 'edit resources', 0),
(44, 1, 23, 'delete', 'delete resource', 0),
(45, 1, 24, 'index', 'index roles', 0),
(46, 1, 24, 'edit', 'edit roles', 0),
(47, 1, 24, 'delete', 'delete roles', 0),
(48, 1, 25, 'index', 'index permissions', 0),
(49, 1, 25, 'edit', 'edit permissions', 0),
(50, 1, 25, 'delete', 'delete permission', 0),
(51, 1, 26, 'index', 'index modules', 0),
(52, 1, 26, 'edit', 'edit modules', 0),
(53, 1, 26, 'add', 'add modules', 1),
(54, 1, 26, 'delete', 'delete modules', 0),
(55, 1, 24, 'add', 'add roles', 1),
(56, 1, 25, 'add', 'add permissions', 0),
(58, 2, 1, 'listresources', 'List Resources', 1),
(59, 1, 1, 'checkconfig', 'Check Config', 1),
(74, 1, 23, 'listresources', 'List Resources', 1),
(94, 6, 8, 'viewblog', 'frontend view blog', 1),
(124, 1, 47, 'delete', 'delete', 1),
(123, 1, 47, 'edit', 'edit', 1),
(88, 1, 38, 'index', 'index users', 1),
(122, 1, 47, 'add', 'add', 1),
(121, 1, 47, 'index', 'index', 1),
(120, 6, 8, 'indexnews', 'indexnews', 1),
(119, 1, 46, 'filldb', 'filldb', 1),
(118, 1, 46, 'index', 'index', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_resources`
--

CREATE TABLE IF NOT EXISTS `acl_resources` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL,
  `resource` varchar(64) NOT NULL,
  `name_r` varchar(250) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `resource` (`resource`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Volcar la base de datos para la tabla `acl_resources`
--

INSERT INTO `acl_resources` (`uid`, `module_id`, `resource`, `name_r`) VALUES
(1, 2, 'admin:index', 'Admin'),
(8, 5, 'frontend:index', 'Frontend'),
(11, 3, 'users:author', 'Author'),
(20, 1, 'default:index', 'index'),
(22, 3, 'users:index', 'Users'),
(23, 3, 'users:resources', 'resources'),
(24, 3, 'users:roles', 'roles'),
(25, 3, 'users:permissions', 'permissions'),
(26, 3, 'users:modules', 'modules'),
(47, 16, 'staticcontent:index', 'index'),
(46, 15, 'mailer:index', 'index'),
(38, 3, 'users:users', 'users');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_roles`
--

CREATE TABLE IF NOT EXISTS `acl_roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(64) NOT NULL,
  `role_parents` varchar(255) NOT NULL,
  `prefered_uri` varchar(255) NOT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `role_name` (`role_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcar la base de datos para la tabla `acl_roles`
--

INSERT INTO `acl_roles` (`role_id`, `role_name`, `role_parents`, `prefered_uri`) VALUES
(1, 'Implementor', '2', 'admin'),
(2, 'Assistant Director', '3', ''),
(3, 'Chief', '4', ''),
(4, 'Member', '5', ''),
(5, 'User', '6', ''),
(6, 'Everyone', '0', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_users`
--

CREATE TABLE IF NOT EXISTS `acl_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(4) NOT NULL,
  `user_name` varchar(64) NOT NULL DEFAULT '0',
  `password` varchar(250) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `email` varchar(250) NOT NULL DEFAULT '0',
  `status` int(2) NOT NULL DEFAULT '0',
  `person_id` varchar(250) NOT NULL DEFAULT '0',
  `validation_code` varchar(250) NOT NULL DEFAULT '0',
  `phone` varchar(250) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcar la base de datos para la tabla `acl_users`
--

INSERT INTO `acl_users` (`uid`, `role_id`, `user_name`, `password`, `date`, `email`, `status`, `person_id`, `validation_code`, `phone`) VALUES
(1, 1, 'AgustÃ­n CalderÃ³n', '1b51bc5fa5a990a0519ba9a01d8c18f92f241c849e5a442113d67db623ee593c', '2009-05-25 00:00:00', 'agustincl@gmail.com', 1, '0', '0', '687 780 786'),
(2, 6, 'Guest', '', '0000-00-00 00:00:00', '0', 0, '0', '0', '0'),
(27, 1, 'vapor', '9ced00a444f5569e51363f4a38c6ead8b2acd324c6f33110f0c262608e367bf8', '2010-11-15 13:26:43', 'vapor@gmail.com', 1, '0', '0', 'bcn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mails`
--

CREATE TABLE IF NOT EXISTS `mails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `postal_code` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `mails`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mail_list`
--

CREATE TABLE IF NOT EXISTS `mail_list` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `maillist` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcar la base de datos para la tabla `mail_list`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sendmails`
--

CREATE TABLE IF NOT EXISTS `sendmails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `html` text COLLATE utf8_bin NOT NULL,
  `mail_list_id` int(11) NOT NULL,
  `sended` text COLLATE utf8_bin,
  `status` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sendmails_mail_list` (`mail_list_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `sendmails`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `static_content`
--

CREATE TABLE IF NOT EXISTS `static_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_bin NOT NULL,
  `content_es` text COLLATE utf8_bin,
  `content_en` text COLLATE utf8_bin,
  `content_ca` text COLLATE utf8_bin,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `acl_users_uid` int(11) NOT NULL,
  `acl_permissions_permission_id` int(11) NOT NULL,
  `tittle` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_static_content_acl_users1` (`acl_users_uid`),
  KEY `fk_static_content_acl_permissions1` (`acl_permissions_permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `static_content`
--

INSERT INTO `static_content` (`id`, `name`, `content_es`, `content_en`, `content_ca`, `date`, `acl_users_uid`, `acl_permissions_permission_id`, `tittle`, `image`, `order`) VALUES
(1, '', 'c', 'c', 'c', '2010-11-19 10:42:22', 1, 2, NULL, NULL, NULL),
(2, '', 'es', 'en', 'ca', '2010-11-19 10:45:06', 1, 0, NULL, NULL, NULL),
(3, 'noticias', 'This is Creevykeel , a free, fully standards-compliant CSS template designed by FreeCssTemplates for Free CSS Templates. The picture in this template is from PDPhoto.org. This free template is released under a Creative Commons Attributions 2.5 license, so youâ€™re pretty much free to do whatever you want with it (even use it commercially) provided you keep the links in the footer intact. Aside from that, have fun with it :)', 'news', 'noticies', '2010-11-19 10:59:09', 1, 120, 'Welcome to Creevykeel', 'img09.jpg', 1);

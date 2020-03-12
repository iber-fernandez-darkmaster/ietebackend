-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para db_iete
CREATE DATABASE IF NOT EXISTS `db_iete` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_iete`;

-- Volcando estructura para tabla db_iete.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla db_iete.auth_assignment: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('Administrador', '2', 1577132602);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla db_iete.auth_item: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('/*', 2, NULL, NULL, NULL, 1577132566, 1577132566),
	('Administrador', 1, NULL, NULL, NULL, 1577132580, 1577132580);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla db_iete.auth_item_child: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
	('Administrador', '/*');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla db_iete.auth_rule: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.informacion
CREATE TABLE IF NOT EXISTS `informacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idestudiante` varchar(100) NOT NULL,
  `idcentro` varchar(100) NOT NULL,
  `idexamen` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla db_iete.informacion: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `informacion` DISABLE KEYS */;
INSERT INTO `informacion` (`id`, `idestudiante`, `idcentro`, `idexamen`, `foto`) VALUES
	(1, '1', '1', '1', '1.png'),
	(2, '1', '1', '1', '1.png'),
	(3, '1', '1', '1', '1.png'),
	(4, '2', '2', '2', '2.png'),
	(5, '12345678', '2', '2', '12345678.png');
/*!40000 ALTER TABLE `informacion` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.pcounter_save
CREATE TABLE IF NOT EXISTS `pcounter_save` (
  `save_name` varchar(10) NOT NULL,
  `save_value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`save_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla db_iete.pcounter_save: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pcounter_save` DISABLE KEYS */;
/*!40000 ALTER TABLE `pcounter_save` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.pcounter_users
CREATE TABLE IF NOT EXISTS `pcounter_users` (
  `user_ip` varchar(255) NOT NULL,
  `user_time` int(10) unsigned NOT NULL,
  `day_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla db_iete.pcounter_users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `pcounter_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `pcounter_users` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.session
CREATE TABLE IF NOT EXISTS `session` (
  `id` char(40) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla db_iete.session: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
INSERT INTO `session` (`id`, `expire`, `data`) VALUES
	('86v2kik1bt6r0n9mpbqai018bv', 1578471981, _binary 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31313A222F7573756172696F617070223B5F5F69647C693A323B),
	('a9hcrosp2qe8738tvqcdftna3b', 1582187468, _binary 0x5F5F666C6173687C613A303A7B7D),
	('ciq1765ppulr2sauqrcgq08a3h', 1582192760, _binary 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A343A222F676969223B5F5F69647C693A323B),
	('egelktu7jkg5dqqk1fmd95bg4t', 1578559454, _binary 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31323A222F6175746F6D6F76696C6573223B5F5F69647C693A323B),
	('vcck719hbe04l39oo2mnisj4vp', 1578450261, _binary 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A393A222F7469706F7061676F223B5F5F69647C693A323B);
/*!40000 ALTER TABLE `session` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.trails_log
CREATE TABLE IF NOT EXISTS `trails_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `action` varchar(20) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla db_iete.trails_log: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `trails_log` DISABLE KEYS */;
INSERT INTO `trails_log` (`id`, `description`, `action`, `model`, `id_model`, `ip`, `creation_date`, `user_id`) VALUES
	(1, 'El usuario anonimo: Registro app\\models\\User[2].', 'create', 'app\\models\\User', 2, '127.0.0.1', 1577132552, NULL),
	(2, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1577132616, 2),
	(3, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1577794776, 2),
	(4, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1577997692, 2),
	(5, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578071030, 2),
	(6, 'Salio del sistema', 'logout', 'app\\models\\User', 2, '127.0.0.1', 1578071043, 2),
	(7, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578077229, 2),
	(8, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578266936, 2),
	(9, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578324267, 2),
	(10, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578409381, 2),
	(11, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578419285, 2),
	(12, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1578522071, 2),
	(13, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 2, '127.0.0.1', 1582146088, 2);
/*!40000 ALTER TABLE `trails_log` ENABLE KEYS */;

-- Volcando estructura para tabla db_iete.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla db_iete.user: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rol`, `status`, `created_at`, `updated_at`) VALUES
	(2, 'admin', '27nFwJ2FN1jI4KcQKe4nF3n1vp47lzJe', '$2y$13$QxfHSTyRC0RB4YGNJcxp9e/dsYbGI6DUjWuNvM6WCbC2F6VHLAb.6', NULL, 'admin@admin.com', 'administrador', 10, 1577132552, 1577132552);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

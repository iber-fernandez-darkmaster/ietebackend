-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 07-10-2019 a las 13:59:31
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_calles_amarillas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_user`
--

CREATE TABLE `app_user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `access_token` varchar(255) NOT NULL,
  `nombre_completo` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `telefono_celular` varchar(45) DEFAULT NULL,
  `token_facebook` varchar(200) DEFAULT NULL,
  `token_gmail` varchar(200) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `respuesta_solicitud` varchar(200) DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1569521994),
('administrador', '2', 1569521994),
('editor', '3', 1569521994),
('editor', '6', 1569969599);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('/*', 2, 'acceso total a todos los modulos', NULL, NULL, 1569521994, 1569521994),
('/admin/assignment/assign', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/assignment/index', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/assignment/revoke', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/assignment/view', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/assign', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/create', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/delete', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/index', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/remove', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/update', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/role/view', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/route/assign', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/route/create', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/route/index', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/route/refresh', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/route/remove', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/activate', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/delete', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/index', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/request-password-reset', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/reset-password', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/signup', 2, '', NULL, NULL, 1569521994, 1569521994),
('/admin/user/view', 2, '', NULL, NULL, 1569521994, 1569521994),
('/cliente/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('/consulta/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('/contacto/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('/espacio/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('/gii/*', 2, 'acceso a generador de codigo', NULL, NULL, 1569521994, 1569521994),
('/portafolio/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('/site/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('/testimonio/*', 2, '', NULL, NULL, 1569521994, 1569521994),
('admin', 1, NULL, NULL, NULL, 1569521994, 1569521994),
('administrador', 1, NULL, NULL, NULL, 1569521994, 1569521994),
('editor', 1, NULL, NULL, NULL, 1569521994, 1569521994);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', '/*'),
('administrador', '/admin/assignment/assign'),
('administrador', '/admin/assignment/index'),
('administrador', '/admin/assignment/revoke'),
('administrador', '/admin/assignment/view'),
('administrador', '/admin/role/assign'),
('administrador', '/admin/role/create'),
('administrador', '/admin/role/delete'),
('administrador', '/admin/role/index'),
('administrador', '/admin/role/remove'),
('administrador', '/admin/role/update'),
('administrador', '/admin/role/view'),
('administrador', '/admin/route/assign'),
('administrador', '/admin/route/create'),
('administrador', '/admin/route/index'),
('administrador', '/admin/route/refresh'),
('administrador', '/admin/route/remove'),
('administrador', '/admin/user/activate'),
('administrador', '/admin/user/delete'),
('administrador', '/admin/user/index'),
('administrador', '/admin/user/request-password-reset'),
('administrador', '/admin/user/reset-password'),
('administrador', '/admin/user/signup'),
('administrador', '/admin/user/view'),
('editor', '/cliente/*'),
('editor', '/consulta/*'),
('editor', '/contacto/*'),
('editor', '/espacio/*'),
('admin', '/gii/*'),
('editor', '/portafolio/*'),
('administrador', '/site/*'),
('editor', '/testimonio/*'),
('admin', 'administrador'),
('administrador', 'editor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE `calificacion` (
  `id` int(11) NOT NULL,
  `calificacion` int(11) DEFAULT NULL,
  `votador` int(11) DEFAULT NULL,
  `app_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `publicado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id`, `nombre`, `logo`, `publicado`) VALUES
(1, 'asb', 'cliente_1191002105333.jpg', 1),
(2, 'Almanza', 'cliente_2191002105528.jpg', 1),
(3, 'BDC', 'cliente_3191002105547.jpg', 1),
(4, 'BNB', 'cliente_4191002105604.jpg', 1),
(5, 'Burger king', 'cliente_5191002105625.jpg', 1),
(6, 'Coca cola', 'cliente_6191002105643.jpg', 1),
(7, 'Hipermaxi', 'cliente_7191002105658.jpg', 1),
(8, 'Nivea', 'cliente_8191002105712.jpg', 1),
(9, 'PIL', 'cliente_9191002105726.jpg', 1),
(10, 'SONY', 'cliente_10191002105744.jpg', 1),
(11, 'Unilever', 'cliente_11191002105806.jpg', 1),
(12, 'Univalle', 'cliente_12191002105821.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) DEFAULT NULL,
  `empresa` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `mensaje` varchar(1000) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre_completo`, `empresa`, `email`, `telefono`, `mensaje`, `fecha`, `hora`) VALUES
(3, 'willam mamani garcia', 'rnova solutions', 'will-gm@hotmail.com', '75977665', 'este es un mensaje de prueba desde las oficinas de la empresa rnova solutions', NULL, NULL),
(4, 'william dsada', 'dsadsa', 'will-gm@hotmail.com', '75977665', 'dhk hfdshfjjdsk fds fds sd', NULL, NULL),
(6, 'dsada', 'dsadsa', 'dsadsa@dsadsa,com', '7456456456', 'dsadsa', '2019-10-07', '09:26:21'),
(7, 'dsadsa', 'dsadsa', 'sadsad@sadsa.com', '456456', 'fdfsdfds', '2019-10-07', '09:28:28'),
(8, 'dsadsaddsads', 'dsdasd', 'dsadsa@dsada.com', '45646', 'dsadsadsa', '2019-10-07', '09:29:24'),
(9, 'hollo', 'holas', 'asdsa@dsds.com', '456465', 'dsad sadsa  dsdsdsds', '2019-10-07', '09:31:26'),
(10, 'dsadsad', 'dsadsa', 'asdsadasdsa.com', '456456', 'dsadsdas', '2019-10-07', '09:33:25'),
(11, 'hola como va', '456456', 'dsadsa@dsads.com', '456456', 'dsadsads', '2019-10-07', '09:37:04'),
(12, 'hola que hacer ', '465456', 'dsadsa@dsads.com', '456', 'dffd', '2019-10-07', '09:40:16'),
(13, 'made in japan', '456456', '45646@ds45ds.com', '5653243', 'dfdsf', '2019-10-07', '09:42:47'),
(14, 'la lola', '4132132', '445646@456.com', '456456', 'fddsfds', '2019-10-07', '09:46:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacio_publicitario`
--

CREATE TABLE `espacio_publicitario` (
  `id` int(11) NOT NULL,
  `zona_id` int(11) NOT NULL,
  `tipo_espacio_publicitario_id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL COMMENT 'es el codigo de la publicidad',
  `tamano` varchar(45) DEFAULT NULL,
  `direccion` varchar(500) DEFAULT NULL,
  `caras` varchar(45) DEFAULT NULL,
  `ilumniacion` varchar(200) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `zoom` varchar(50) DEFAULT NULL,
  `icono` varchar(200) DEFAULT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT '1',
  `publicado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `espacio_publicitario`
--

INSERT INTO `espacio_publicitario` (`id`, `zona_id`, `tipo_espacio_publicitario_id`, `nombre`, `tamano`, `direccion`, `caras`, `ilumniacion`, `latitude`, `longitude`, `zoom`, `icono`, `disponible`, `publicado`, `created_at`, `updated_at`) VALUES
(4, 3, 2, 'dsdsdsfsds', '1500 x 2000 m ', 'avenida principal', '1', '1 foco led ', '56.005252', '37.142556900000045', NULL, NULL, 1, 1, NULL, 1570208349),
(6, 3, 2, '446465', NULL, NULL, NULL, NULL, '56.0228225', '37.20779279999999', NULL, NULL, 1, 1, 1569932676, 1569932676),
(7, 3, 1, 'dsadsada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1569937881, 1569937881),
(8, 3, 1, 'dsadsada', '1024 * 6000 m', 'avendia principal de quilla collo cerca de la terminal', '3 caras', '4 focos led', '-17.406201271136617', '-66.15544489060181', '17', NULL, 1, 1, 1569937892, 1570208218),
(9, 3, 1, 'dsadsada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1569937929, 1569937929),
(10, 3, 1, 'dsadsada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1569937970, 1569937970),
(11, 3, 1, 'dsadsada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 1569937980, 1569937980),
(12, 3, 1, 'dsadsada', '1024 * 6000 m', 'dsadsa dsadsa', 'rew rew', '2 focos led', '-17.379039281044072', '-66.1523085350891', '17', 'icono_12191007095037.jpg', 1, 1, 1569938044, 1570456237);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE `favorito` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `producto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_espacios`
--

CREATE TABLE `fotos_espacios` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos_servicio`
--

CREATE TABLE `fotos_servicio` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `servicio_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fotos_servicio`
--

INSERT INTO `fotos_servicio` (`id`, `foto`, `servicio_id`) VALUES
(4, 'servicio_4191003140324.jpg', 2),
(11, 'servicio_11191004190615.jpg', 1),
(12, 'servicio_12191004190625.jpg', 1),
(13, 'servicio_13191004190637.jpg', 1),
(14, 'servicio_14191004190715.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fui_lona`
--

CREATE TABLE `fui_lona` (
  `id` int(11) NOT NULL,
  `nombre_producto` varchar(200) DEFAULT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fui_lona`
--

INSERT INTO `fui_lona` (`id`, `nombre_producto`, `foto`, `descripcion`) VALUES
(3, 'estuche de cosmeticos', 'producto_3191004155348.jpg', '17 x 24'),
(4, 'Cartera', 'producto_4191004154525.jpg', '29 x 30 cm'),
(5, 'Bolsa grande para compras', 'producto_5191004154614.jpg', '50 x 40 cm peso maximo 5 kilos'),
(6, 'Mochila', 'producto_6191004154650.jpg', '46 x 36 cm peso maximo 1,5 kilos'),
(7, 'Bolsa para bisicletas', 'producto_7191004155124.jpg', '50 x 40 cm peso maximo 5 kilos'),
(8, 'Archivador portadocumentos', 'producto_8191004155157.png', '50 x 40 cm peso maximo 5 kilos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nosotros`
--

CREATE TABLE `nosotros` (
  `id` int(11) NOT NULL,
  `subtitulo` varchar(500) DEFAULT NULL,
  `parrafo` varchar(1000) DEFAULT NULL,
  `publicado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nosotros`
--

INSERT INTO `nosotros` (`id`, `subtitulo`, `parrafo`, `publicado`) VALUES
(1, '', 'En mayo de 2008,esta cálida tierra cochabambina vio nacer a nuestra empresa, que se abrió al mercado publicitario al instalar la primera pantalla gigante digital en el Puente de la Recoleta. A partir de este emprendimiento, decidimos ampliar la oferta dentro del rubro de la publicidad vial con la instalación de estructuras publicitarias en diferentes formatos: torres unipolares, vallas, carteleras y murales. ', 1),
(2, '', 'Nos caracterizamos y diferenciamos en el mercado porque trabajamos con una estrategia de comunicación que se basa en conocer bien a nuestros clientes y saber qué es lo que necesitan. Es por eso que buscamos ofrecer alternativas ajustadas a cada uno de ellos. Queremos cuidar su imagen de marca, por lo cual trabajamos con: estructuras profesionales, monitoreo de los espacios, respuesta inmediata ante problemas. De igual manera garantizamos: iluminación, seguro, pago de patentes, de modo que  nuestro cliente quede tranquilo y satisfecho.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parrafos_servicio`
--

CREATE TABLE `parrafos_servicio` (
  `id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `subtitulo` varchar(500) DEFAULT NULL,
  `parrafo` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `parrafos_servicio`
--

INSERT INTO `parrafos_servicio` (`id`, `servicio_id`, `subtitulo`, `parrafo`) VALUES
(3, 1, 'esto es un subtitulo', 'Un párrafo, también llamado parágrafo, es una unidad comunicativa formada por un conjunto de oraciones secuenciales que trata un mismo tema. Está compuesto por un conjunto de oraciones que tienen cierta unidad temática o que, sin tenerla, se enuncian juntas. Wikipedia'),
(4, 1, '', 'Un párrafo, también llamado parágrafo, es una unidad comunicativa formada por un conjunto de oraciones secuenciales que trata un mismo tema. Está compuesto por un conjunto de oraciones que tienen cierta unidad temática o que, sin tenerla, se enuncian juntas. Wikipedia'),
(5, 2, '', ' también llamado parágrafo, es una unidad comunicativa formada por un conjunto de oraciones secuenciales que trata un mismo tema. Está compuesto por un conjunto de oraciones que tienen cierta unidad temática o que, sin tenerla, se enuncian juntas. Wikipedia'),
(6, 2, 'subtitulo', ' también llamado parágrafo, es una unidad comunicativa formada por un conjunto de oraciones secuenciales que trata un mismo tema. Está compuesto por un conjunto de oraciones que tienen cierta unidad temática o que, sin tenerla, se enuncian juntas. Wikipedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pcounter_save`
--

CREATE TABLE `pcounter_save` (
  `save_name` varchar(10) NOT NULL,
  `save_value` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pcounter_save`
--

INSERT INTO `pcounter_save` (`save_name`, `save_value`) VALUES
('counter', 0),
('day_time', 2458764),
('max_count', 0),
('max_time', 0),
('yesterday', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pcounter_users`
--

CREATE TABLE `pcounter_users` (
  `user_ip` varchar(255) NOT NULL,
  `user_time` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pcounter_users`
--

INSERT INTO `pcounter_users` (`user_ip`, `user_time`) VALUES
('f528764d624db129b32c21fbca0cb8d6', 1570456705);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portafolio`
--

CREATE TABLE `portafolio` (
  `id` int(11) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `portafolio`
--

INSERT INTO `portafolio` (`id`, `foto`, `nombre`, `publicado`) VALUES
(1, 'portafolio_1191002101126.jpg', 'dsfsdfsds ds ds s', 1),
(2, 'portafolio_2191002101117.jpg', 'dsfsdfs', 1),
(3, 'portafolio_3191002101104.jpg', 'dsadsadsad ', 1),
(6, 'portafolio_6191002101040.jpg', 'sdtgtfdgfdgdf', 1),
(8, 'portafolio_8191002101030.jpg', 'mojmo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `publicado` tinyint(2) DEFAULT '1',
  `usado` tinyint(2) NOT NULL,
  `condicion_uso` int(11) DEFAULT NULL,
  `descripcion` varchar(500) NOT NULL,
  `short_descripcion` varchar(100) NOT NULL,
  `presio` decimal(11,2) NOT NULL,
  `precio_charlable` tinyint(2) NOT NULL,
  `vistas` int(11) DEFAULT NULL,
  `vendido` tinyint(2) DEFAULT '0',
  `ciudad_id` int(11) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicio`
--

CREATE TABLE `servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicio`
--

INSERT INTO `servicio` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Publicidad', 'publicidad'),
(2, 'servicio de mensajeria', 'Un párrafo, también llamado parágrafo, es una unidad comunicativa formada por un conjunto de oraciones secuenciales que trata un mismo tema. Está compuesto por un conjunto de oraciones que tienen cierta unidad temática o que, sin tenerla, se enuncian juntas. Wikipedia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE `session` (
  `id` char(40) COLLATE utf8_unicode_ci NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `session`
--

INSERT INTO `session` (`id`, `expire`, `data`) VALUES
('erpafbqujckipu7dbadahfhvit', 1570347962, 0x5f5f666c6173687c613a303a7b7d),
('q996a2b2e5jscln5tuhe10a7ke', 1570492705, 0x5f5f666c6173687c613a303a7b7d5f5f72657475726e55726c7c733a32313a222f6573706163696f2d7075626c696369746172696f223b5f5f69647c693a313b),
('s33qmdkjl73oa49s6ksqa87k75', 1570267560, 0x5f5f666c6173687c613a303a7b7d),
('usjv3u73jpm1o8smu6oof5qclv', 1570267163, 0x5f5f666c6173687c613a303a7b7d5f5f72657475726e55726c7c733a31313a222f64622d6d616e61676572223b5f5f69647c693a313b6261636b7570506964737c613a303a7b7d);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `estado` tinyint(2) NOT NULL DEFAULT '0',
  `mensaje` varchar(500) DEFAULT NULL,
  `producto_id` int(11) NOT NULL,
  `app_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sugerencia`
--

CREATE TABLE `sugerencia` (
  `id` int(11) NOT NULL,
  `sugerencia` varchar(500) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `app_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `nombre_completo` varchar(50) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`id`, `nombre_completo`, `cargo`, `foto`, `descripcion`) VALUES
(2, 'lourdes kenayata montes', 'directora general', 'member_2191004145853.jpg', ''),
(3, 'jane sanches sana', 'Marketing', 'member_3191004151045.jpg', ''),
(4, 'jhoan octubre modal', 'busdirector de carrera', 'member_4191004151249.jpg', ''),
(5, 'yovana sanches fuentes', 'contabilidad', 'miembro_5191004151650.jpg', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_espacio_publicitario`
--

CREATE TABLE `tipo_espacio_publicitario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `publicado` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_espacio_publicitario`
--

INSERT INTO `tipo_espacio_publicitario` (`id`, `nombre`, `publicado`) VALUES
(1, 'muro', 1),
(2, 'torre', 1),
(3, 'valla', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trails_log`
--

CREATE TABLE `trails_log` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_model` int(11) DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_date` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `trails_log`
--

INSERT INTO `trails_log` (`id`, `description`, `action`, `model`, `id_model`, `ip`, `creation_date`, `user_id`) VALUES
(23498, 'Ingreso al sistema', 'login', 'mdm\\admin\\models\\User', 1, '127.0.0.1', 1570456162, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `rol`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'CR5Qfhm1db6QzkqtcCVjzzd8858JK7cd', '$2y$13$E3eEFr.CAROHCPUfhPDaBu0FiUZ6R0fWHR3uOfpa0ev/YiGgMPFm2', NULL, 'admin@admin.com', 'admin', 10, 1, 1),
(2, 'administrador', 'uCh7-WBVoHEAxQ71WolP8CpVISTlAkyf', '$2y$13$hdm79hbYG93V/uhqwk8nseIMQBHCCONGLLt53c2g5coI9NwhSVUNC', NULL, 'admin@admin.com', 'administrador', 10, 1, 1),
(5, 'editor', 'VNE9olbA4_AXqBT9BJWkrnAY-zff1iSd', '$2y$13$/TkH3EPoGSWUi559cJre6OZwmE5lNCp4K17ztT0/QitlKsk2lJXmW', NULL, 'editor@editor.com', 'editor', 10, 1, 1),
(6, 'juana', 'MRmnN6zhPZYbvM1rB-FE0U8U7ejcqsaS', '$2y$13$ADd945.yOXQ6D5jQ.DATN.TJeD9pbqENyu6.Tem9nPR1umy.IWkY2', NULL, 'juana@gmail.com', 'editor', 10, 1569969591, 1569969591);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zona`
--

CREATE TABLE `zona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `zona`
--

INSERT INTO `zona` (`id`, `nombre`) VALUES
(3, 'recoleta'),
(5, 'zona oeste de tarata'),
(6, 'chimba'),
(7, 'ticti norte'),
(8, 'ticti sud'),
(9, 'circunbalacion'),
(10, 'tiquipaya'),
(11, 'quillacollo norte'),
(12, 'quillacolo central'),
(13, 'stadium'),
(14, 'pulacayo'),
(15, 'plaza ptincipal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `app_user`
--
ALTER TABLE `app_user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `auth_assignment_user_id_idx` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_calificacion_app_user2_idx` (`votador`),
  ADD KEY `fk_calificacion_app_user1_idx` (`app_user_id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `espacio_publicitario`
--
ALTER TABLE `espacio_publicitario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_servicio_zona1_idx` (`zona_id`),
  ADD KEY `fk_espacio_publicitario_tipo_espacio_publicitario1_idx` (`tipo_espacio_publicitario_id`);

--
-- Indices de la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_favorito_producto1_idx` (`producto_id`),
  ADD KEY `fk_favorito_app_user1_idx` (`app_user_id`);

--
-- Indices de la tabla `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_foto_producto1_idx` (`producto_id`);

--
-- Indices de la tabla `fotos_espacios`
--
ALTER TABLE `fotos_espacios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fotos_servicio_servicio1_idx` (`servicio_id`);

--
-- Indices de la tabla `fotos_servicio`
--
ALTER TABLE `fotos_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_fotos_servicio_servicio2_idx` (`servicio_id`);

--
-- Indices de la tabla `fui_lona`
--
ALTER TABLE `fui_lona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parrafos_servicio`
--
ALTER TABLE `parrafos_servicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_table1_servicio1_idx` (`servicio_id`);

--
-- Indices de la tabla `pcounter_save`
--
ALTER TABLE `pcounter_save`
  ADD PRIMARY KEY (`save_name`);

--
-- Indices de la tabla `pcounter_users`
--
ALTER TABLE `pcounter_users`
  ADD PRIMARY KEY (`user_ip`);

--
-- Indices de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_ciudad1_idx` (`ciudad_id`),
  ADD KEY `fk_producto_categoria1_idx` (`categoria_id`);

--
-- Indices de la tabla `servicio`
--
ALTER TABLE `servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitud_producto1_idx` (`producto_id`),
  ADD KEY `fk_solicitud_app_user1_idx` (`app_user_id`);

--
-- Indices de la tabla `sugerencia`
--
ALTER TABLE `sugerencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sugerencia_app_user1_idx` (`app_user_id`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_espacio_publicitario`
--
ALTER TABLE `tipo_espacio_publicitario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trails_log`
--
ALTER TABLE `trails_log`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `zona`
--
ALTER TABLE `zona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `app_user`
--
ALTER TABLE `app_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `calificacion`
--
ALTER TABLE `calificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `espacio_publicitario`
--
ALTER TABLE `espacio_publicitario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `favorito`
--
ALTER TABLE `favorito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos_espacios`
--
ALTER TABLE `fotos_espacios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fotos_servicio`
--
ALTER TABLE `fotos_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `fui_lona`
--
ALTER TABLE `fui_lona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parrafos_servicio`
--
ALTER TABLE `parrafos_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `portafolio`
--
ALTER TABLE `portafolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `servicio`
--
ALTER TABLE `servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sugerencia`
--
ALTER TABLE `sugerencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_espacio_publicitario`
--
ALTER TABLE `tipo_espacio_publicitario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `trails_log`
--
ALTER TABLE `trails_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23499;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `zona`
--
ALTER TABLE `zona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `fk_calificacion_app_user1` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_calificacion_app_user2` FOREIGN KEY (`votador`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `espacio_publicitario`
--
ALTER TABLE `espacio_publicitario`
  ADD CONSTRAINT `fk_espacio_publicitario_tipo_espacio_publicitario1` FOREIGN KEY (`tipo_espacio_publicitario_id`) REFERENCES `tipo_espacio_publicitario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_servicio_zona1` FOREIGN KEY (`zona_id`) REFERENCES `zona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `fk_favorito_app_user1` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_favorito_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `fk_foto_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fotos_espacios`
--
ALTER TABLE `fotos_espacios`
  ADD CONSTRAINT `fk_fotos_servicio_servicio1` FOREIGN KEY (`servicio_id`) REFERENCES `espacio_publicitario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `fotos_servicio`
--
ALTER TABLE `fotos_servicio`
  ADD CONSTRAINT `fk_fotos_servicio_servicio2` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `parrafos_servicio`
--
ALTER TABLE `parrafos_servicio`
  ADD CONSTRAINT `fk_table1_servicio1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_producto_ciudad1` FOREIGN KEY (`ciudad_id`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `fk_solicitud_app_user1` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_solicitud_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sugerencia`
--
ALTER TABLE `sugerencia`
  ADD CONSTRAINT `fk_sugerencia_app_user1` FOREIGN KEY (`app_user_id`) REFERENCES `app_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

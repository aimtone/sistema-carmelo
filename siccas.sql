-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-04-2018 a las 09:54:58
-- Versión del servidor: 5.5.58-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `siccas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidatos`
--

CREATE TABLE IF NOT EXISTS `candidatos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_habitante` bigint(20) NOT NULL,
  `id_periodo` bigint(20) NOT NULL,
  `id_eleccion` bigint(20) NOT NULL,
  `id_comite` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `candidatos`
--

INSERT INTO `candidatos` (`id`, `id_habitante`, `id_periodo`, `id_eleccion`, `id_comite`, `created_at`, `updated_at`) VALUES
(1, 14, 2, 2, 5, '2018-04-08 23:55:26', '2018-04-08 23:55:26'),
(2, 14, 3, 3, 5, '2018-04-09 00:23:10', '2018-04-09 00:23:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'CARGO 1', '2018-04-08 21:48:31', '2018-04-08 22:17:18'),
(34, 'CARGO 2', '2018-04-08 22:17:11', '2018-04-08 22:17:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comites`
--

CREATE TABLE IF NOT EXISTS `comites` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(500) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descripcion` (`descripcion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `comites`
--

INSERT INTO `comites` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(5, 'COMITE DE REGISTROS Y ALMACENAMIENTO', '2018-04-07 04:01:10', '2018-04-08 21:50:29'),
(18, 'COMITÉ DE CULTURA', '2018-04-08 21:50:40', '2018-04-08 21:50:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eleccions`
--

CREATE TABLE IF NOT EXISTS `eleccions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `descripcion` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `eleccions`
--

INSERT INTO `eleccions` (`id`, `descripcion`, `created_at`, `updated_at`) VALUES
(2, 'ELECCIONES DEL CONSEJO COMUNAL DE LA URBANIZACION LA ASCENSION', '2018-04-08 22:27:13', '2018-04-08 22:27:13'),
(3, 'OTRA ELECCION', '2018-04-08 23:29:27', '2018-04-08 23:29:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitantes`
--

CREATE TABLE IF NOT EXISTS `habitantes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nacionalidad` varchar(1) NOT NULL DEFAULT 'V',
  `cedula` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `casa` varchar(50) NOT NULL,
  `calle` varchar(50) NOT NULL,
  `vereda` varchar(50) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `telefono_celular` varchar(20) NOT NULL,
  `telefono_habitacion` varchar(20) NOT NULL,
  `cargo` bigint(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_candidatos` (`nacionalidad`,`cedula`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `habitantes`
--

INSERT INTO `habitantes` (`id`, `nacionalidad`, `cedula`, `nombre`, `apellido`, `casa`, `calle`, `vereda`, `sector`, `fecha_de_nacimiento`, `telefono_celular`, `telefono_habitacion`, `cargo`, `status`, `created_at`, `updated_at`) VALUES
(14, 'V', 21301059, 'Anthony Jose', 'Medina Fuentes', 'casa 1', 'calle 2', 'Vereda 2', 'Sector 1', '2017-10-20', '298203980', '308038038', 34, 1, '2018-04-08 22:17:29', '2018-04-08 22:17:29'),
(15, 'V', 21301058, 'JUAN', 'SANCHEZ', 'CASA 2', 'CALLE 2', 'VEREDA 3', 'SECTOR 1', '2017-10-20', '383838383', '229292929', 1, 1, '2018-04-08 22:17:01', '2018-04-08 22:17:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_access_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('13af44491e67070cc754e575dd76747a60e055772f768e8f3082e32037715805d5f967cd2efb5f31', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:07:07', '2018-03-29 00:07:07', '2019-03-28 20:07:07'),
('15c1127806241d53370bf0f30239a25f18559561f881af72568406fefe60dc999aa5d325dec3ed1f', 4, 5, 'MyApp', '[]', 0, '2018-03-28 23:15:12', '2018-03-28 23:15:12', '2019-03-28 19:15:12'),
('1e86c4f0c57626853b22324656ad791d3fc83506285be34c86d36334567fd5f526a118995ef8af16', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:10:56', '2018-03-29 00:10:56', '2019-03-28 20:10:56'),
('2629dc1b629e52816b857f9ea8e610680e6623c9b87917572e344c04c1d8ca05d870d95021930509', 4, 5, 'MyApp', '[]', 0, '2018-04-08 20:37:41', '2018-04-08 20:37:41', '2019-04-08 16:37:41'),
('2e59cb49488876ddb77eba585b6dad04ea511c1e238c03999977b669177b26b084e18c2d1a1fce2d', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:14:44', '2018-03-29 00:14:44', '2019-03-28 20:14:44'),
('3423b88762ef503c38680a8543cb343e48124eb9bcb1baddbcaf006e632a1ece37c3937e72c023fc', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:10:18', '2018-03-29 00:10:18', '2019-03-28 20:10:18'),
('3829399b212644344a347044a4d0bec44e309793c561668fac933764c6c7f67b51162099b4d09e98', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:10:58', '2018-03-29 00:10:58', '2019-03-28 20:10:58'),
('391568e80c8566f8c1ff17252ad8af963fe50d0dce86fdd06d5f862f18e18715c440242f29c64959', 4, 5, 'MyApp', '[]', 0, '2018-04-07 00:03:29', '2018-04-07 00:03:29', '2019-04-06 20:03:29'),
('46c5894e05fc0c47798ac25b4eccf7d7d43668811480d0c5ec13077d8e3a2a50005e175f7ac55bad', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:09:19', '2018-03-29 00:09:19', '2019-03-28 20:09:19'),
('46e7452a57560c835126c61f65a4693142a5bedf894c3d54e45d512c86461fbaf9a0b25ece47d552', 4, 5, 'MyApp', '[]', 0, '2018-04-06 23:15:10', '2018-04-06 23:15:10', '2019-04-06 19:15:10'),
('4ccd9856b82820b13842baf3a64ce74060dff6143edf1c3be0d75c2b4123bca396fc2a828cdfe599', 4, 5, 'MyApp', '[]', 0, '2018-03-28 23:52:46', '2018-03-28 23:52:46', '2019-03-28 19:52:46'),
('5228410750ebb1887057d06d6f0a28b26311766119c8c96b14a4f58640dcd4b8a878ccd4a776c8ce', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:07:22', '2018-03-29 00:07:22', '2019-03-28 20:07:22'),
('607ab7959af61afce9f3929023234cc0f1c4da88bad1c7a825fac3d824c4014fe0f1fbf54be4a358', 4, 5, 'MyApp', '[]', 0, '2018-04-07 02:10:37', '2018-04-07 02:10:37', '2019-04-06 22:10:37'),
('6101612db613c733f00e956290ad00d65a1bbce09edb373ed2bbf5a36543daef78c15fe30ada8a24', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:47:33', '2018-03-29 00:47:33', '2019-03-28 20:47:33'),
('6d8edba4b6777f40f74dd5e41e780df408914dc0ea0f7a69bee5cd8e3de29096c3cb69a1bc73ab65', 4, 5, 'MyApp', '[]', 0, '2018-03-28 23:18:36', '2018-03-28 23:18:36', '2019-03-28 19:18:36'),
('78efde9762532b3933a6c6653364ee8db306b62138c83e59510ffadb17f5f3f646db7b9c11a8ebe1', 4, 5, 'MyApp', '[]', 0, '2018-04-07 03:52:32', '2018-04-07 03:52:32', '2019-04-06 23:52:32'),
('79910ee48aafa287ff996246f95ef58a1b1060e0fccebbef6fb91691e3dbab622ec2c5a0f795b6e1', 4, 5, 'MyApp', '[]', 0, '2018-04-06 23:59:41', '2018-04-06 23:59:41', '2019-04-06 19:59:41'),
('b12ababf2490bfacf08dce3daf1a3b1b5f000051b8a31ee70ca6e8b3bfd2cd22e43927cb00a1bea9', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:10:08', '2018-03-29 00:10:08', '2019-03-28 20:10:08'),
('ca2cfd5d3714c6dee0577734af7b7c83b7ec8f68a5e86e82c49fcbba882bc57ab674e2eba9c6abbc', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:10:06', '2018-03-29 00:10:06', '2019-03-28 20:10:06'),
('d76ba23041e0186046adfae4aa233d83f7ab32a41a707b765655357f31f9d5d3e98e98079bed45a4', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:13:11', '2018-03-29 00:13:11', '2019-03-28 20:13:11'),
('d770e0c57c77de8e5a057e6e812f4f2418abd7eb9872c8c1d533dc5d92c41e752a8a84085aa25a58', 4, 5, 'MyApp', '[]', 0, '2018-04-07 01:03:33', '2018-04-07 01:03:33', '2019-04-06 21:03:33'),
('dd97eb89315a0a12c5354f79019ef90210c6b2c295b2d8a32ebbf8b692b434f09fd897b952467717', 4, 5, 'MyApp', '[]', 0, '2018-04-07 04:15:56', '2018-04-07 04:15:56', '2019-04-07 00:15:56'),
('e363f430a7b8e8827815d5b658fc3093d0392f2485f9d4b4a591f2a29fcf9eea4bdf1b80c34c107a', 4, 5, 'MyApp', '[]', 0, '2018-03-29 00:11:43', '2018-03-29 00:11:43', '2019-03-28 20:11:43'),
('e8221df2b9ece39d6601b81d93efef297402c2ca5285a89d896aa8fc74846a9fb1df14587ea497f4', 4, 5, 'MyApp', '[]', 0, '2018-04-08 21:08:06', '2018-04-08 21:08:06', '2019-04-08 17:08:06'),
('ecf52a98e15907382457b0bc1c7e6e8d3fcd4c2bad4da15af21a20958b52084fdb7d485f28f9eae3', 4, 5, 'MyApp', '[]', 0, '2018-04-07 00:30:36', '2018-04-07 00:30:36', '2019-04-06 20:30:36'),
('f1f5ee6655fbdbb9e12841c064b0f54acd1eb57443a50be5368844495a3a7d7ee8ec3c82f5ada768', 4, 5, 'MyApp', '[]', 0, '2018-04-06 23:14:47', '2018-04-06 23:14:47', '2019-04-06 19:14:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_auth_codes`
--

CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'XbDG36L2iGqP9Pa5FEyDzYiFKZJOjdsohWhvx5Hx', 'http://localhost', 1, 0, 0, '2018-01-23 11:20:42', '2018-01-23 11:20:42'),
(2, NULL, 'Laravel Password Grant Client', 'BNBvHqadTObkuYmwdlhbEl8fBryTGV04mvUgKmct', 'http://localhost', 0, 1, 0, '2018-01-23 11:20:42', '2018-01-23 11:20:42'),
(3, NULL, 'Laravel Personal Access Client', 'tFXjXrpxoum4k0krg7Oupf4Y0iWMTAauZo7XcwZa', 'http://localhost', 1, 0, 0, '2018-01-23 11:20:59', '2018-01-23 11:20:59'),
(4, NULL, 'Laravel Password Grant Client', 'EynLyvr5Lt4raE53et8gVvNgCkqZYXPquCFAge0l', 'http://localhost', 0, 1, 0, '2018-01-23 11:20:59', '2018-01-23 11:20:59'),
(5, NULL, 'Laravel Personal Access Client', 'fQY1U1pQcygUAmJU695CV2qtjusL2NY2Un8VjmIt', 'http://localhost', 1, 0, 0, '2018-03-28 23:14:44', '2018-03-28 23:14:44'),
(6, NULL, 'Laravel Password Grant Client', '0QziAD6y3Eq9ovvyH4vJbbHrp06yHKthAX8g6nSb', 'http://localhost', 0, 1, 0, '2018-03-28 23:14:44', '2018-03-28 23:14:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_personal_access_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(3, 5, '2018-03-28 23:14:44', '2018-03-28 23:14:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oauth_refresh_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE IF NOT EXISTS `periodos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_eleccion` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id`, `fecha`, `id_eleccion`, `created_at`, `updated_at`) VALUES
(2, '2018-04-08', 2, '2018-04-08 22:51:43', '2018-04-08 22:53:21'),
(3, '2018-10-20', 3, '2018-04-08 23:29:58', '2018-04-08 23:29:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `responses`
--

CREATE TABLE IF NOT EXISTS `responses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `response` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `pattern_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `responses_pattern_id_foreign` (`pattern_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'anthony medina', 'nthny20@hotmail.com', '$2y$10$3e8hUmrSat0nGPG0kGNJ..eW4RhWK9yyLkA/rk4xGS92d1q10gzq6', NULL, '2018-03-28 04:00:00', '2018-03-28 04:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

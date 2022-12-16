-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2022 at 12:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `activo`, `fecha_creada`, `fecha_edit`) VALUES
(1, 'cartas', 1, '2022-12-15 20:16:56', '2022-12-16 16:26:06');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `direccion`, `telefono`, `correo`, `activo`, `fecha_creada`, `fecha_edit`) VALUES
(0, 'benjamin', 'plaza sesamo', '9133', 'benja@gmail.com', 1, '2022-12-16 16:26:58', '2022-12-16 16:26:58'),
(1, 'jorge olate', 'asdasfdaf', '966565411888', 'jorge@gmail.com', 1, '2022-12-16 05:05:11', '2022-12-16 16:15:13'),
(4, 'yovani', 'asdasfdafssss', '952135435', 'yovani@gmail.com', 1, '2022-12-16 16:34:33', '2022-12-16 16:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reference` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `browser` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `date`, `time`, `reference`, `name`, `ip`, `location`, `browser`, `status`, `created_at`, `updated_at`) VALUES
(13, '2022-11-28', '12:59:50', 1, 'Admin', '::1', NULL, 'Firefox', 'Success', '2022-11-28 12:59:50', '2022-11-28 12:59:50'),
(14, '2022-12-14', '15:25:58', 17, 'lapokeparada', '::1', NULL, 'Opera', 'Success', '2022-12-14 15:25:58', '2022-12-14 15:25:58'),
(15, '2022-12-14', '15:45:09', 17, 'lapokeparada', '::1', NULL, 'Opera', 'Success', '2022-12-14 15:45:09', '2022-12-14 15:45:09'),
(16, '2022-12-14', '15:52:42', 17, 'lapokeparada', '::1', NULL, 'Opera', 'Success', '2022-12-14 15:52:42', '2022-12-14 15:52:42'),
(17, '2022-12-15', '07:01:48', 17, 'lapokeparada', '::1', NULL, 'Opera', 'Success', '2022-12-15 07:01:48', '2022-12-15 07:01:48'),
(18, '2022-12-15', '13:30:39', 17, 'lapokeparada', '::1', NULL, 'Opera', 'Success', '2022-12-15 13:30:39', '2022-12-15 13:30:39'),
(19, '2022-12-15', '16:46:32', 17, 'lapokeparada', '::1', NULL, 'Opera', 'Success', '2022-12-15 16:46:32', '2022-12-15 16:46:32'),
(20, '2022-12-16', '09:44:53', 17, 'lapokeparada', '::1', NULL, 'Chrome', 'Success', '2022-12-16 09:44:53', '2022-12-16 09:44:53'),
(21, '2022-12-16', '11:24:14', 17, 'lapokeparada', '::1', NULL, 'Chrome', 'Success', '2022-12-16 11:24:14', '2022-12-16 11:24:14'),
(22, '2022-12-16', '13:20:29', 17, 'lapokeparada', '::1', NULL, 'Chrome', 'Success', '2022-12-16 13:20:29', '2022-12-16 13:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL DEFAULT 0.00,
  `existencias` int(11) NOT NULL DEFAULT 0,
  `stock_minimo` int(11) NOT NULL DEFAULT 0,
  `inventariable` tinyint(4) NOT NULL,
  `id_unidades` smallint(6) NOT NULL,
  `id_categoria` smallint(6) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `nombre`, `precio_venta`, `precio_compra`, `existencias`, `stock_minimo`, `inventariable`, `id_unidades`, `id_categoria`, `activo`, `fecha_creada`, `fecha_edit`) VALUES
(3, '123123', 'Box elit kjhjhgh', '12651.00', '4000.00', 1, 1, 1, 1, 1, 1, '2022-12-15 22:42:40', NULL),
(4, '123123', 'Box elit ', '12651.00', '4000.00', 1, 1, 1, 1, 1, 1, '2022-12-15 22:42:51', NULL),
(5, '123124', 'boc letras', '12652.00', '5000.00', 2, 1, 1, 1, 1, 1, '2022-12-15 22:45:17', NULL),
(6, '2134', 'pikachu', '124214.00', '123123.00', 1, 1, 1, 1, 1, 1, '2022-12-16 17:10:13', NULL),
(7, '2134', 'pikachu', '124214.00', '123123.00', 1, 1, 1, 1, 1, 1, '2022-12-16 17:10:16', NULL),
(8, '2323', 'pikachu', '214321.00', '0.00', 1, 1, 1, 1, 1, 1, '2022-12-16 15:44:18', '2022-12-16 15:44:18'),
(9, '23234', 'fffffffffff', '214321.00', '0.00', 1, 1, 1, 1, 1, 1, '2022-12-16 15:44:46', '2022-12-16 15:44:46'),
(10, '2323', 'ererere', '214321.00', '0.00', 1, 1, 1, 1, 1, 1, '2022-12-16 15:55:21', '2022-12-16 15:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `language` varchar(255) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `dateformat` varchar(255) NOT NULL,
  `timeformat` varchar(255) NOT NULL,
  `iprestriction` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `language`, `timezone`, `dateformat`, `timeformat`, `iprestriction`, `created_at`, `updated_at`) VALUES
(1, 'es', 'America/Santiago', 'yyyy-mm-dd', '24', '', '2020-08-21 17:43:51', '2022-11-28 13:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `unidades`
--

CREATE TABLE `unidades` (
  `id` smallint(6) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_corto` varchar(10) NOT NULL,
  `activo` tinyint(3) NOT NULL DEFAULT 1,
  `fecha_creada` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_edit` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unidades`
--

INSERT INTO `unidades` (`id`, `nombre`, `nombre_corto`, `activo`, `fecha_creada`, `fecha_edit`) VALUES
(1, 'Pokemon TCG Tempestad plateada', 'sobre', 1, '2022-12-14 19:53:53', NULL),
(2, 'Pokemon TCG Lost Origin', 'sobre', 1, '2022-12-16 01:11:42', '2022-12-15 22:11:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(191) NOT NULL,
  `new_email` varchar(191) DEFAULT NULL,
  `password_hash` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `firstname` varchar(191) DEFAULT NULL,
  `lastname` varchar(191) DEFAULT NULL,
  `activate_hash` varchar(191) DEFAULT NULL,
  `reset_hash` varchar(191) DEFAULT NULL,
  `reset_expires` bigint(20) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(50) DEFAULT NULL,
  `updated_at` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `new_email`, `password_hash`, `name`, `firstname`, `lastname`, `activate_hash`, `reset_hash`, `reset_expires`, `active`, `created_at`, `updated_at`) VALUES
(1, 'admin@example.com', NULL, '$2y$10$leBVD86iyCkhfjCv6Fv9GOYlNCxe1vK5y7MpINzdqzmhm5JDTnxs6', 'Admin', 'Admin', 'User', 'ZEWv2TUIY5oDqgw9FkjnmAS78zJNKfpL', NULL, NULL, 1, '2020-08-04 16:07:50', '2022-11-28 13:00:40'),
(18, 'poke@gmail.com', NULL, '$2y$10$HUwCyVsUogYYaJ9HrjA2MOQPfqh/EykqaizJsR0ZsVovOIhUv12ye', 'lapokeparada', 'pokeparada', 'pokeparada', 'VjFz6nQ5DhIs03RCvpg8xw9rZWoy4Jqu', NULL, NULL, 0, '2022-12-16 13:22:55', '2022-12-16 13:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id_v` int(11) NOT NULL,
  `folio` varchar(15) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `forma_pago` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id_v`, `folio`, `total`, `id_cliente`, `forma_pago`, `created_at`, `active`) VALUES
(0, '2323', '344343.00', 1, 'efect', '2022-12-16 20:50:23', 1),
(0, '2323', '344343.00', 1, 'pago', '2022-12-16 20:50:23', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_detalle_venta_ventas` (`id_venta`),
  ADD KEY `fk_detalle_venta_productos` (`id_producto`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_unidad` (`id_unidades`),
  ADD KEY `fk_producto_categoria` (`id_categoria`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unidades`
--
ALTER TABLE `unidades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unidades`
--
ALTER TABLE `unidades`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `fk_producto_unidad` FOREIGN KEY (`id_unidades`) REFERENCES `unidades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

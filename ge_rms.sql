-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2019 at 07:56 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ge_rms`
--

-- --------------------------------------------------------

--
-- Table structure for table `ma_customer`
--

CREATE TABLE `ma_customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tin` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_customer`
--

INSERT INTO `ma_customer` (`id`, `code`, `name`, `address`, `contact_person`, `email`, `tin`, `contact`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CS001', 'Customer One', 'Chennai', 'Arun', 'arun.m@d.com', '123456789', '987654', 1, 1, NULL, NULL),
(2, 'CS002', 'Sujan', 'Chennai', 'Sujan', 'sujan@gmail.com', 'QWERTYUIO', '1234567890', 1, 1, '2019-08-26 01:50:54', '2019-08-26 01:50:54'),
(3, 'CS002', 'Sujan', 'Chennai', 'Sujan', 'sujan@gmail.com', 'QWERTYUIO', '1234567890', 1, 1, '2019-08-26 01:52:04', '2019-08-26 01:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `ma_customer_location_trans`
--

CREATE TABLE `ma_customer_location_trans` (
  `customer_id` bigint(20) NOT NULL,
  `location_id` bigint(20) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_customer_location_trans`
--

INSERT INTO `ma_customer_location_trans` (`customer_id`, `location_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(3, 1, 1, 1, '2019-08-26 01:52:04', '2019-08-26 01:52:04');

-- --------------------------------------------------------

--
-- Table structure for table `ma_customer_site_trans`
--

CREATE TABLE `ma_customer_site_trans` (
  `customer_id` bigint(20) NOT NULL,
  `site_id` bigint(20) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_customer_site_trans`
--

INSERT INTO `ma_customer_site_trans` (`customer_id`, `site_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL),
(3, 2, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ma_location`
--

CREATE TABLE `ma_location` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_location`
--

INSERT INTO `ma_location` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'LOC1', 'Chennai', 1, 1, NULL, NULL),
(2, 'LOC2', 'Madurai', 1, 1, NULL, NULL),
(3, 'LOC3', 'Coimbatore', 1, 1, '2019-08-26 08:38:09', '2019-08-26 08:38:09');

-- --------------------------------------------------------

--
-- Table structure for table `ma_manufacture`
--

CREATE TABLE `ma_manufacture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_manufacture`
--

INSERT INTO `ma_manufacture` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'MAN001', 'ManOne', 1, 1, '2019-08-26 13:54:15', '2019-08-26 13:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `ma_material`
--

CREATE TABLE `ma_material` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_material`
--

INSERT INTO `ma_material` (`id`, `part_no`, `description`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PART01', 'DESC', 1, 1, 1, '2019-08-27 02:54:45', '2019-08-27 02:54:45');

-- --------------------------------------------------------

--
-- Table structure for table `ma_material_type`
--

CREATE TABLE `ma_material_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_material_type`
--

INSERT INTO `ma_material_type` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'MT001', 'Mat One', 1, 1, '2019-08-26 13:30:35', '2019-08-26 13:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `ma_packing_style`
--

CREATE TABLE `ma_packing_style` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_packing_style`
--

INSERT INTO `ma_packing_style` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PS001', 'PS ONE', 1, 1, '2019-08-26 12:59:42', '2019-08-26 12:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `ma_product`
--

CREATE TABLE `ma_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_no` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` bigint(20) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_product`
--

INSERT INTO `ma_product` (`id`, `part_no`, `description`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PART01', 'This is First Part', 1, 1, 1, '2019-08-26 07:15:46', '2019-08-26 07:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `ma_product_type`
--

CREATE TABLE `ma_product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_product_type`
--

INSERT INTO `ma_product_type` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PT001', 'PT1', 1, 1, '2019-08-26 05:11:51', '2019-08-26 05:11:51'),
(2, 'PT002', 'PT2', 1, 1, '2019-08-26 05:52:15', '2019-08-26 05:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `ma_rack`
--

CREATE TABLE `ma_rack` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_rack`
--

INSERT INTO `ma_rack` (`id`, `code`, `name`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'RK001', 'Rack One', 1, 1, 1, '2019-08-26 12:26:40', '2019-08-26 12:26:40'),
(2, 'RK002', 'Rack Two', 2, 1, 1, '2019-08-26 12:29:43', '2019-08-26 12:29:43');

-- --------------------------------------------------------

--
-- Table structure for table `ma_rack_type`
--

CREATE TABLE `ma_rack_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_rack_type`
--

INSERT INTO `ma_rack_type` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Rack One', 1, 1, '2019-08-26 10:43:21', '2019-08-26 10:43:21'),
(2, 'Rack Two', 1, 1, '2019-08-26 10:43:56', '2019-08-26 10:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `ma_site`
--

CREATE TABLE `ma_site` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_site`
--

INSERT INTO `ma_site` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SITE1', 'Chennai', 1, 1, NULL, NULL),
(2, 'SITE2', 'Madurai', 1, 1, NULL, NULL),
(3, 'SITE3', 'Coimbatore', 1, 1, '2019-08-26 09:56:01', '2019-08-26 09:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2019_08_21_01_create_location_master_table', 1),
(22, '2019_08_21_01_create_site_master_table', 2),
(23, '2019_08_21_01_create_rack_master_table', 3),
(24, '2019_08_21_01_create_rack_type_master_table', 4),
(25, '2019_08_21_01_create_material_master_table', 5),
(26, '2019_08_21_01_create_packing_style_master_table', 6),
(27, '2019_08_21_01_create_manufacture_master_table', 7),
(28, '2019_08_21_01_create_customer_master_table', 8),
(29, '2019_08_21_01_create_product_master_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Inbound User');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$cml2/aLiRi345NMh0L5Zt.gZUJzCATgulxM6krtplr9iW7Pk2uaHG', NULL, NULL, NULL),
(2, 'Inbound User', 'iu@iu.com', NULL, '123456', NULL, NULL, NULL),
(4, 'Sujan', 'sujan@su.com', NULL, '$2y$10$GFHFDMKUHa.LABP5RgiQje86qTii5SOG.i3V62U5cOTK9/NMsIVjC', NULL, '2019-08-27 01:31:44', '2019-08-27 01:31:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ma_customer`
--
ALTER TABLE `ma_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_location`
--
ALTER TABLE `ma_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_manufacture`
--
ALTER TABLE `ma_manufacture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_material`
--
ALTER TABLE `ma_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_material_type`
--
ALTER TABLE `ma_material_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_packing_style`
--
ALTER TABLE `ma_packing_style`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_product`
--
ALTER TABLE `ma_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_product_type`
--
ALTER TABLE `ma_product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_rack`
--
ALTER TABLE `ma_rack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_rack_type`
--
ALTER TABLE `ma_rack_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ma_site`
--
ALTER TABLE `ma_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ma_customer`
--
ALTER TABLE `ma_customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ma_location`
--
ALTER TABLE `ma_location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ma_manufacture`
--
ALTER TABLE `ma_manufacture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ma_material`
--
ALTER TABLE `ma_material`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ma_material_type`
--
ALTER TABLE `ma_material_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ma_packing_style`
--
ALTER TABLE `ma_packing_style`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ma_product`
--
ALTER TABLE `ma_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ma_product_type`
--
ALTER TABLE `ma_product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ma_rack`
--
ALTER TABLE `ma_rack`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ma_rack_type`
--
ALTER TABLE `ma_rack_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ma_site`
--
ALTER TABLE `ma_site`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 03:56 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `displaypvstatus` ()  BEGIN
select * from ma_pv_status;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `aging`
--

CREATE TABLE `aging` (
  `pv_id` bigint(20) NOT NULL,
  `result` tinyint(4) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aging_tracking`
--

CREATE TABLE `aging_tracking` (
  `pv_id` bigint(20) NOT NULL,
  `result` tinyint(4) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auto_test_bench`
--

CREATE TABLE `auto_test_bench` (
  `pv_id` bigint(20) NOT NULL,
  `result` tinyint(4) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auto_test_bench_tracking`
--

CREATE TABLE `auto_test_bench_tracking` (
  `pv_id` bigint(20) NOT NULL,
  `result` tinyint(4) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dispatch`
--

CREATE TABLE `dispatch` (
  `id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `pv_id` bigint(16) NOT NULL,
  `dc_no` varchar(100) NOT NULL,
  `docket_details` varchar(100) NOT NULL,
  `rma_id` bigint(10) NOT NULL,
  `courier_name` varchar(100) NOT NULL,
  `person_name` varchar(100) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_tickets`
--

CREATE TABLE `job_tickets` (
  `id` bigint(20) NOT NULL,
  `pv_id` bigint(20) NOT NULL,
  `nature_of_defect` varchar(100) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `power_on_test` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_ticket_materials`
--

CREATE TABLE `job_ticket_materials` (
  `id` bigint(20) NOT NULL,
  `jt_id` bigint(20) NOT NULL,
  `part_no` varchar(50) DEFAULT NULL,
  `value` varchar(25) DEFAULT NULL,
  `old_pcp` varchar(50) DEFAULT NULL,
  `new_pcp` varchar(50) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ma_customer`
--

CREATE TABLE `ma_customer` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `ma_location`
--

CREATE TABLE `ma_location` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_location`
--

INSERT INTO `ma_location` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'AP', 'Andhra Pradesh', 1, 1, '2019-11-08 07:43:27', '2019-11-08 07:43:27');

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

-- --------------------------------------------------------

--
-- Table structure for table `ma_product`
--

CREATE TABLE `ma_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `part_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` bigint(20) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ma_product_type`
--

CREATE TABLE `ma_product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ma_pv_status`
--

CREATE TABLE `ma_pv_status` (
  `id` tinyint(4) NOT NULL,
  `status` varchar(50) NOT NULL,
  `close_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ma_pv_status`
--

INSERT INTO `ma_pv_status` (`id`, `status`, `close_status`) VALUES
(1, 'Relay Without RMA', NULL),
(2, 'Relay With RMA', NULL),
(3, 'Waiting For Customer Approval', NULL),
(4, 'Manager Approved', 'Job Ticket Open'),
(5, 'Job Ticket Started', NULL),
(6, 'Job Ticket Completed', 'Auto Test Bench Open'),
(7, 'Auto Test Bench Started', NULL),
(8, 'Auto Test Bench Completed', NULL),
(9, 'Aging Started', NULL),
(10, 'Aging Completed', 'Waiting For Verification'),
(11, 'Verification Completed', 'Waiting For Dispatch Approval'),
(12, 'Dispatched', NULL),
(13, 'Waiting For Manager Approval', NULL),
(14, 'Dispatch Approved', NULL),
(15, 'Saved', NULL);

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
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_site`
--

INSERT INTO `ma_site` (`id`, `code`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'KAD', 'Kadivedu', 1, 1, '2019-11-08 07:43:59', '2019-11-08 07:43:59');

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
-- Table structure for table `physical_verification`
--

CREATE TABLE `physical_verification` (
  `id` bigint(20) NOT NULL,
  `receipt_id` bigint(20) NOT NULL,
  `docket_details` varchar(100) DEFAULT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `pvdate` date NOT NULL,
  `producttype_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `serial_no` varchar(50) NOT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `case` tinyint(3) NOT NULL DEFAULT '-1',
  `case_condition` tinyint(3) NOT NULL DEFAULT '-1',
  `battery` tinyint(3) NOT NULL DEFAULT '-1',
  `battery_condition` tinyint(3) NOT NULL DEFAULT '-1',
  `terminal_blocks` tinyint(3) DEFAULT '-1',
  `terminal_blocks_condition` tinyint(3) NOT NULL DEFAULT '-1',
  `no_of_terminal_blocks` varchar(11) DEFAULT NULL,
  `top_bottom_cover` tinyint(3) NOT NULL DEFAULT '-1',
  `top_bottom_cover_condition` tinyint(3) NOT NULL DEFAULT '-1',
  `short_links` tinyint(3) NOT NULL DEFAULT '-1',
  `short_links_condition` tinyint(3) NOT NULL DEFAULT '-1',
  `no_of_short_links` smallint(11) DEFAULT NULL,
  `screws` tinyint(4) NOT NULL DEFAULT '-1',
  `sales_order_no` varchar(50) DEFAULT NULL,
  `is_rma_available` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pv_priority_list`
--

CREATE TABLE `pv_priority_list` (
  `pv_id` bigint(20) NOT NULL,
  `priority` smallint(6) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` tinyint(4) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pv_rms_tracking`
--

CREATE TABLE `pv_rms_tracking` (
  `pv_id` bigint(20) NOT NULL,
  `rack_id` varchar(15) NOT NULL,
  `rack_type` tinyint(4) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pv_status`
--

CREATE TABLE `pv_status` (
  `pv_id` bigint(20) NOT NULL,
  `current_status_id` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pv_status_tracking`
--

CREATE TABLE `pv_status_tracking` (
  `pv_id` bigint(20) NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` bigint(20) NOT NULL,
  `gs_no` varchar(20) DEFAULT NULL,
  `receipt_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `end_customer` varchar(35) DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `courier_name` varchar(35) NOT NULL,
  `docket_details` varchar(35) NOT NULL,
  `total_boxes` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1.Open, 2.Started, 3.Closed',
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rma`
--

CREATE TABLE `rma` (
  `id` bigint(20) NOT NULL,
  `receipt_id` bigint(20) NOT NULL,
  `gs_no` varchar(50) DEFAULT NULL,
  `act_reference` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `customer_address_id` int(11) NOT NULL,
  `end_customer` varchar(50) DEFAULT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1.Open, 2.Saved, 3.Completed',
  `service_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1.Physical, 2.Site Card',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rma_delivery_address`
--

CREATE TABLE `rma_delivery_address` (
  `id` bigint(11) NOT NULL,
  `rma_id` bigint(20) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `contact_person` varchar(25) DEFAULT NULL,
  `tel_no` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gst` varchar(15) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rma_unit_information`
--

CREATE TABLE `rma_unit_information` (
  `id` bigint(11) NOT NULL,
  `rma_id` bigint(11) NOT NULL,
  `pv_id` bigint(11) NOT NULL,
  `sw_version` varchar(50) DEFAULT NULL,
  `service_type` tinyint(11) NOT NULL COMMENT '1.Physical,2.SiteCard',
  `warrenty` tinyint(11) NOT NULL,
  `desc_of_fault` varchar(200) DEFAULT NULL,
  `sales_order_no` varchar(50) DEFAULT NULL,
  `field_volts_used` tinyint(4) NOT NULL,
  `equip_failed_on_installation` tinyint(4) NOT NULL,
  `equip_failed_on_service` tinyint(4) NOT NULL,
  `how_long` varchar(100) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rma_unit_serial_number`
--

CREATE TABLE `rma_unit_serial_number` (
  `id` bigint(11) NOT NULL,
  `rma_unit_information_id` bigint(11) NOT NULL,
  `serial_number` varchar(10) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rms`
--

CREATE TABLE `rms` (
  `pv_id` bigint(20) NOT NULL,
  `rack_id` varchar(15) DEFAULT NULL,
  `rack_type` tinyint(4) DEFAULT NULL COMMENT '1.Repair, 2.Customer Rack, 3.Post Lab, 4.Application Lab, 5.PV Rack',
  `moved_date` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 2),
(5, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(11) NOT NULL,
  `updated_by` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Admin', 'admin@admin.com', NULL, '$2y$10$cml2/aLiRi345NMh0L5Zt.gZUJzCATgulxM6krtplr9iW7Pk2uaHG', NULL, NULL, NULL, 0, 0),
(2, 'Inbound User', 'iu@iu.com', NULL, '$2y$10$1Txo56Y26edjgaEWk/IT3O80k1430PONZrSYGtguByIkJRKYJQliu', NULL, NULL, '2019-10-29 08:19:47', 0, 1),
(4, 'Sujan', 'sujan@su.com', NULL, '$2y$10$GFHFDMKUHa.LABP5RgiQje86qTii5SOG.i3V62U5cOTK9/NMsIVjC', NULL, '2019-08-27 01:31:44', '2019-08-27 01:31:44', 0, 0),
(5, 'Arun', 'arun@designtovr.com', NULL, '$2y$10$ccCJ0gDNrV2LbHfTF6w2vOoXvrsm91TZL7Wo.Pslgd9ytOg5SHpxW', NULL, '2019-10-29 07:13:26', '2019-10-29 07:13:26', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verification_completion`
--

CREATE TABLE `verification_completion` (
  `pv_id` bigint(20) NOT NULL,
  `clio_test` tinyint(1) NOT NULL,
  `rtd_test` tinyint(1) NOT NULL,
  `nic_test` tinyint(1) NOT NULL,
  `received_with_screws` tinyint(1) NOT NULL,
  `received_with_terminal` tinyint(1) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warranty`
--

CREATE TABLE `warranty` (
  `id` int(11) NOT NULL,
  `pv_id` bigint(11) DEFAULT NULL,
  `smp` tinyint(11) DEFAULT NULL,
  `pcp` tinyint(11) DEFAULT NULL,
  `type` tinyint(11) DEFAULT NULL,
  `move` tinyint(11) DEFAULT NULL,
  `rca` tinyint(11) DEFAULT NULL,
  `comment` varchar(200) DEFAULT NULL,
  `mail_to` varchar(100) DEFAULT NULL,
  `cc` varchar(100) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `po` varchar(50) DEFAULT NULL,
  `wbs` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aging`
--
ALTER TABLE `aging`
  ADD UNIQUE KEY `pv_id` (`pv_id`);

--
-- Indexes for table `auto_test_bench`
--
ALTER TABLE `auto_test_bench`
  ADD UNIQUE KEY `pv_id` (`pv_id`);

--
-- Indexes for table `dispatch`
--
ALTER TABLE `dispatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_tickets`
--
ALTER TABLE `job_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pv_id` (`pv_id`);

--
-- Indexes for table `job_ticket_materials`
--
ALTER TABLE `job_ticket_materials`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ma_pv_status`
--
ALTER TABLE `ma_pv_status`
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
-- Indexes for table `physical_verification`
--
ALTER TABLE `physical_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pv_status`
--
ALTER TABLE `pv_status`
  ADD UNIQUE KEY `pv_id` (`pv_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rma`
--
ALTER TABLE `rma`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rma_delivery_address`
--
ALTER TABLE `rma_delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rma_unit_information`
--
ALTER TABLE `rma_unit_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rma_unit_serial_number`
--
ALTER TABLE `rma_unit_serial_number`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rms`
--
ALTER TABLE `rms`
  ADD UNIQUE KEY `pv_id` (`pv_id`);

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
-- Indexes for table `verification_completion`
--
ALTER TABLE `verification_completion`
  ADD UNIQUE KEY `pv_id` (`pv_id`);

--
-- Indexes for table `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pv_id` (`pv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispatch`
--
ALTER TABLE `dispatch`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_tickets`
--
ALTER TABLE `job_tickets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `job_ticket_materials`
--
ALTER TABLE `job_ticket_materials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `ma_customer`
--
ALTER TABLE `ma_customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ma_location`
--
ALTER TABLE `ma_location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ma_product_type`
--
ALTER TABLE `ma_product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ma_pv_status`
--
ALTER TABLE `ma_pv_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `physical_verification`
--
ALTER TABLE `physical_verification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rma`
--
ALTER TABLE `rma`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rma_delivery_address`
--
ALTER TABLE `rma_delivery_address`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rma_unit_information`
--
ALTER TABLE `rma_unit_information`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rma_unit_serial_number`
--
ALTER TABLE `rma_unit_serial_number`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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

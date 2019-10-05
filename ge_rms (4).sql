-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2019 at 06:05 PM
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
-- Table structure for table `dispatch`
--

CREATE TABLE `dispatch` (
  `dispatch_no` int(10) NOT NULL,
  `date` date NOT NULL,
  `rid_no` int(16) NOT NULL,
  `dc_no` int(16) NOT NULL,
  `docket_details` varchar(35) NOT NULL,
  `rma_no` int(10) NOT NULL,
  `courier_name` varchar(35) NOT NULL,
  `person_name` varchar(35) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dispatch`
--

INSERT INTO `dispatch` (`dispatch_no`, `date`, `rid_no`, `dc_no`, `docket_details`, `rma_no`, `courier_name`, `person_name`, `updated_at`, `created_at`) VALUES
(12441, '2019-09-17', 124124, 124125, 'adsgadg', 124312, 'adag', 'asfasgfa', '2019-09-17 11:30:23', '2019-09-17 11:30:23'),
(12445, '2019-09-17', 12515, 1245, 'sddssd', 214124, 'Cname', 'Pmname', '2019-09-17 11:31:46', '2019-09-17 11:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `job_tickets`
--

CREATE TABLE `job_tickets` (
  `id` bigint(20) NOT NULL,
  `pv_id` bigint(20) NOT NULL,
  `nature_of_defect` varchar(100) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `power_on_test` varchar(25) DEFAULT NULL,
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
  `comment` varchar(100) DEFAULT NULL,
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
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gst` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_customer`
--

INSERT INTO `ma_customer` (`id`, `code`, `name`, `address`, `contact_person`, `email`, `gst`, `contact`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'CS001', 'Customer One', 'Chennai', 'Arun', 'arun.m@d.com', '123456789', '987654', 1, 1, NULL, NULL),
(2, 'CS002', 'Sujan', 'Chennai', 'Sujan', 'sujan@gmail.com', 'QWERTYUIO', '1234567890', 1, 1, '2019-08-26 01:50:54', '2019-08-26 01:50:54'),
(3, 'CS002', 'Sujan', 'Chennai', 'Sujan', 'sujan@gmail.com', 'QWERTYUIO', '1234567890', 1, 1, '2019-08-26 01:52:04', '2019-08-26 01:52:04'),
(4, 'CS003', 'ASDD', 'Chennai', 'Arun', 'arun@ds.com', '35AABCS1429B1ZX', '1234567890', 1, 1, '2019-09-24 06:00:19', '2019-09-24 06:00:19'),
(5, 'CS003', 'ASDD', 'Chennai', 'Arun', 'arun@ds.com', '35AABCS1429B1ZX', '1234567890', 1, 1, '2019-09-24 06:00:32', '2019-09-24 06:00:32'),
(6, 'CS003', 'ASDD', 'Chennai', 'Arun', 'arun@ds.com', '35AABCS1429B1ZX', '1234567890', 1, 1, '2019-09-24 06:02:03', '2019-09-24 06:02:03'),
(7, 'CS004', 'ADFEW', 'Chennai', 'Sujan', 'ds@da.co', '35AABCS1429B1ZX', '1234567', 1, 1, '2019-09-24 06:13:11', '2019-09-24 06:13:11');

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
(3, 1, 1, 1, '2019-08-26 01:52:04', '2019-08-26 01:52:04'),
(6, 1, 1, 1, '2019-09-24 06:02:03', '2019-09-24 06:02:03'),
(7, 1, 1, 1, '2019-09-24 06:13:11', '2019-09-24 06:13:11');

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
(3, 2, 1, 1, NULL, NULL),
(6, 1, 1, 1, '2019-09-24 06:02:03', '2019-09-24 06:02:03'),
(7, 1, 1, 1, '2019-09-24 06:13:11', '2019-09-24 06:13:11');

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
  `description` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, 'PART01', 'This is First Part', 1, 1, 1, '2019-08-26 07:15:46', '2019-08-26 07:15:46'),
(2, 'AD002', 'This is second', 3, 1, 1, '2019-09-24 11:07:35', '2019-09-24 11:07:35'),
(3, 'PRO3', 'Product 3', 3, 1, 1, '2019-09-30 07:27:35', '2019-09-30 07:27:35'),
(4, 'PART004', NULL, 3, 1, 1, '2019-10-01 02:12:56', '2019-10-01 02:12:56'),
(5, 'PAR0045', NULL, 2, 1, 1, '2019-10-01 02:29:30', '2019-10-01 02:29:30'),
(6, 'P141916A6M', 'Backup protection', 4, 1, 1, '2019-10-03 05:45:51', '2019-10-03 05:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `ma_product_type`
--

CREATE TABLE `ma_product_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ma_product_type`
--

INSERT INTO `ma_product_type` (`id`, `code`, `name`, `category`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PT001', 'PT1', 'boj', '', 1, 1, '2019-08-26 05:11:51', '2019-08-26 05:11:51'),
(2, 'PT002', 'PT2', 'boj', '', 1, 1, '2019-08-26 05:52:15', '2019-08-26 05:52:15'),
(3, 'PT003', 'PT3', 'ge', 'This is third', 1, 1, '2019-09-24 10:36:20', '2019-09-24 10:36:20'),
(4, 'Px40', 'Numerical', 'ge', 'micom', 1, 1, '2019-10-03 05:40:44', '2019-10-03 05:40:44');

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
(13, 'Waiting For Manager Approval', NULL);

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
-- Table structure for table `physical_verification`
--

CREATE TABLE `physical_verification` (
  `id` bigint(20) NOT NULL,
  `receipt_id` int(20) NOT NULL,
  `docket_details` varchar(35) NOT NULL,
  `courier_name` varchar(35) NOT NULL,
  `pvdate` date NOT NULL,
  `producttype_id` int(11) NOT NULL,
  `product_id` varchar(35) DEFAULT NULL,
  `serial_no` varchar(35) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `case` int(3) NOT NULL,
  `case_condition` int(3) NOT NULL,
  `battery` int(3) NOT NULL,
  `battery_condition` int(3) NOT NULL,
  `terminal_blocks` int(3) NOT NULL,
  `terminal_blocks_condition` int(3) NOT NULL,
  `no_of_terminal_blocks` tinyint(11) DEFAULT NULL,
  `top_bottom_cover` int(3) NOT NULL,
  `top_bottom_cover_condition` int(3) NOT NULL,
  `short_links` int(3) NOT NULL,
  `short_links_condition` int(3) NOT NULL,
  `no_of_short_links` tinyint(11) DEFAULT NULL,
  `sales_order_no` varchar(15) DEFAULT NULL,
  `is_rma_available` tinyint(4) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` bigint(20) NOT NULL,
  `created_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `physical_verification`
--

INSERT INTO `physical_verification` (`id`, `receipt_id`, `docket_details`, `courier_name`, `pvdate`, `producttype_id`, `product_id`, `serial_no`, `comment`, `case`, `case_condition`, `battery`, `battery_condition`, `terminal_blocks`, `terminal_blocks_condition`, `no_of_terminal_blocks`, `top_bottom_cover`, `top_bottom_cover_condition`, `short_links`, `short_links_condition`, `no_of_short_links`, `sales_order_no`, `is_rma_available`, `updated_at`, `created_at`, `updated_by`, `created_by`) VALUES
(1, 1, '49m231', 'ADS', '2019-09-28', 2, '3', 'asfasf', '235235dd', 3, 1, 2, 2, 3, 2, NULL, 2, 1, 2, 1, NULL, '12563455', 1, '2019-10-03 06:32:07', '2019-09-27 15:21:52', 1, 1),
(2, 9, '49m231', 'ADS', '2019-09-25', 1, '2', 'asfasf', '235235dd', 3, 1, 3, 2, 2, 2, NULL, 2, 2, 3, 1, NULL, '1234', 1, '2019-10-03 06:32:03', '2019-09-25 12:37:35', 1, 1),
(3, 8, '567yhu8', 'ADS', '2019-09-25', 1, '4', 'asfasf', '235235dd', 2, 2, 1, 1, 2, 2, NULL, 1, 2, 2, 1, NULL, '123433', 1, '2019-10-03 01:53:48', '2019-09-26 00:14:22', 1, 1),
(4, 7, '49m231', 'ADS', '2019-09-23', 1, '1', 'asfasf', '235235dd', 3, 1, 2, 2, 3, 2, NULL, 2, 1, 2, 1, NULL, '12563455', 1, '2019-10-03 01:51:49', '2019-09-26 03:43:12', 1, 1),
(5, 9, 'DD  agf', 'CNM', '2019-09-27', 2, '5', 'SER1234', 'FAult', 1, 1, 2, 2, 3, 1, NULL, 2, 2, 3, 1, NULL, 'SO001', 1, '2019-10-03 01:54:37', '2019-09-27 13:00:17', 1, 1),
(6, 8, 'DD  agf', 'CNM', '2019-09-28', 2, '3', 'Serial002', 'Faulty', 2, 1, 1, 2, 3, 1, NULL, 2, 2, 3, 1, NULL, 'Sales001', 1, '2019-10-03 01:56:10', '2019-09-27 13:15:00', 1, 1),
(7, 7, '49m231', 'ADS', '2019-09-28', 2, '2', 'SER003', 'Fal', 3, 1, 2, 2, 3, 1, NULL, 2, 2, 3, 1, NULL, 'Sales001', 1, '2019-10-03 01:58:45', '2019-09-27 15:25:11', 1, 1),
(8, 1, 'Docket', 'Fed', '2019-09-28', 2, '1', 'SER001', 'Fault', 1, 2, 1, 2, 1, 2, NULL, 1, 2, 1, 2, NULL, 'SO001', 1, '2019-10-03 06:31:29', '2019-09-28 00:49:17', 1, 1),
(9, 9, 'STCD1', 'STC1', '2019-10-01', 3, '2', 'SER003', '', 1, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, '', 1, '2019-10-02 10:46:27', '2019-10-01 02:11:16', 1, 1),
(10, 9, 'STCD1', 'STC1', '2019-10-01', 3, '4', 'SER021', '', 1, 2, 1, 2, 1, 2, 12, 1, 2, 1, 2, 2, NULL, 1, '2019-10-01 06:09:03', '2019-10-01 02:12:56', 1, 1),
(11, 10, 'STCD2', 'STC2', '2019-10-01', 2, '5', 'SER0045', '', 1, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, '', 1, '2019-10-02 10:46:27', '2019-10-01 02:29:30', 1, 1),
(12, 1, 'DD  agf', 'CNM', '2019-10-03', 3, '4', 'SE1456', '', 1, 2, 1, 2, 3, 2, 0, 1, 2, 2, 2, 0, NULL, 1, '2019-10-03 06:13:19', '2019-10-03 02:01:04', 1, 1),
(13, 1, 'DD  agf', 'CNM', '2019-10-03', 2, '3', 'SER003', '', 1, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, '', 1, '2019-10-03 03:10:39', '2019-10-03 03:10:39', 1, 1),
(14, 7, '49m231', 'ADS', '2019-10-03', 2, '5', 'SER9687', '', 1, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, '', 0, '2019-10-03 03:13:25', '2019-10-03 03:13:25', 1, 1),
(15, 1, 'DD  agf', 'CNM', '2019-10-03', 4, '6', 'SER0321234', '', 1, 2, 1, 2, 2, 2, 14, 1, 2, 2, 2, 0, '13242355', 0, '2019-10-03 05:53:51', '2019-10-03 05:53:51', 1, 1),
(16, 1, 'DD  agf', 'CNM', '2019-10-04', 4, '6', '23442351', '', 2, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, '', 1, '2019-10-04 09:01:05', '2019-10-04 08:57:06', 1, 1),
(17, 1, 'DD  agf', 'CNM', '2019-10-04', 4, '6', '23423532', '', 1, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, '', 1, '2019-10-04 08:58:09', '2019-10-04 08:58:09', 1, 1),
(18, 1, 'DD  agf', 'CNM', '2019-10-05', 4, '6', 'SER0032', '', 1, 2, 1, 2, 2, 2, 0, 1, 2, 2, 2, 0, NULL, 1, '2019-10-05 02:56:39', '2019-10-04 13:58:49', 1, 1);

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

--
-- Dumping data for table `pv_status`
--

INSERT INTO `pv_status` (`pv_id`, `current_status_id`, `created_at`, `created_by`) VALUES
(1, 5, '2019-10-04 16:04:41', 1),
(2, 4, '2019-10-04 08:45:23', 1),
(10, 5, '2019-10-04 16:23:42', 1),
(12, 5, '2019-10-04 16:23:42', 1),
(13, 5, '2019-10-04 16:23:42', 1),
(16, 13, '2019-10-04 14:52:42', 1),
(17, 5, '2019-10-04 14:30:31', 1),
(18, 4, '2019-10-05 03:01:50', 1);

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

--
-- Dumping data for table `pv_status_tracking`
--

INSERT INTO `pv_status_tracking` (`pv_id`, `status_id`, `created_at`, `created_by`) VALUES
(1, 4, '2019-10-04 07:47:14', 1),
(1, 4, '2019-10-04 07:47:50', 1),
(1, 4, '2019-10-04 07:48:13', 1),
(1, 4, '2019-10-04 07:48:19', 1),
(1, 4, '2019-10-04 07:53:44', 1),
(1, 4, '2019-10-04 07:54:12', 1),
(1, 4, '2019-10-04 07:55:08', 1),
(1, 4, '2019-10-04 07:55:42', 1),
(1, 4, '2019-10-04 07:56:07', 1),
(1, 4, '2019-10-04 07:56:13', 1),
(1, 5, '2019-10-04 08:02:07', 1),
(1, 4, '2019-10-04 08:45:23', 1),
(2, 4, '2019-10-04 08:45:23', 1),
(16, 1, '2019-10-04 08:57:06', 1),
(17, 2, '2019-10-04 08:58:09', 1),
(1, 4, '2019-10-04 12:56:55', 1),
(18, 2, '2019-10-04 13:58:49', 1),
(17, 5, '2019-10-04 14:30:31', 1),
(18, 3, '2019-10-04 14:33:40', 1),
(16, 2, '2019-10-04 14:41:41', 1),
(16, 2, '2019-10-04 14:43:12', 1),
(16, 13, '2019-10-04 14:52:42', 1),
(18, 4, '2019-10-04 14:56:20', 1),
(1, 5, '2019-10-04 16:04:41', 1),
(10, 5, '2019-10-04 16:10:02', 1),
(10, 5, '2019-10-04 16:12:52', 1),
(12, 5, '2019-10-04 16:12:52', 1),
(13, 5, '2019-10-04 16:12:52', 1),
(10, 5, '2019-10-04 16:22:53', 1),
(12, 5, '2019-10-04 16:22:53', 1),
(13, 5, '2019-10-04 16:22:53', 1),
(10, 5, '2019-10-04 16:23:42', 1),
(12, 5, '2019-10-04 16:23:42', 1),
(13, 5, '2019-10-04 16:23:42', 1),
(18, 2, '2019-10-05 02:56:39', 1),
(18, 13, '2019-10-05 03:00:47', 1),
(18, 4, '2019-10-05 03:01:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` bigint(20) NOT NULL,
  `gs_no` varchar(20) NOT NULL,
  `receipt_date` date NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `end_customer` varchar(35) NOT NULL,
  `courier_name` varchar(35) NOT NULL,
  `docket_details` varchar(35) NOT NULL,
  `total_boxes` int(10) NOT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `gs_no`, `receipt_date`, `customer_name`, `end_customer`, `courier_name`, `docket_details`, `total_boxes`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, '4523463465', '2019-10-02', 'siemens', 'ENDCC', 'CNM', 'DD  agf', 55, 0, 1, '2019-10-02 06:50:16', '2019-10-02 06:50:16'),
(7, '3242354642', '2019-10-02', '23to8y9', 'dio', 'ADS', '49m231', 5, 1, 1, '2019-10-02 06:50:28', '2019-10-02 06:50:28'),
(8, '1243252352', '2019-10-02', 'Arun', 'Sri', 'Fed', 'Docket', 3, 1, 1, '2019-10-02 06:50:36', '2019-10-02 06:50:36'),
(9, '2342135424', '2019-10-01', 'Cus11', 'EndCus1', 'STC1', 'STCD1', 3, 1, 1, '2019-09-30 16:24:19', '2019-09-30 16:24:19'),
(10, '2343245345', '2019-09-30', 'Cus2', 'EndCus2', 'STC2', 'STCD2', 5, 1, 1, '2019-09-30 16:25:02', '2019-09-30 10:55:02');

-- --------------------------------------------------------

--
-- Table structure for table `rma`
--

CREATE TABLE `rma` (
  `id` bigint(20) NOT NULL,
  `gs_no` varchar(11) NOT NULL,
  `act_reference` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `customer_address_id` int(11) NOT NULL,
  `end_customer` varchar(25) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rma`
--

INSERT INTO `rma` (`id`, `gs_no`, `act_reference`, `date`, `customer_address_id`, `end_customer`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'GS001', 'ACT001', '2019-09-26', 7, '', 1, 1, '2019-09-26 03:50:04', '2019-09-26 09:20:04'),
(2, 'GS001', 'ACT001', '2019-09-26', 7, '', 1, 1, '2019-09-26 03:50:47', '2019-09-26 09:20:47'),
(3, 'GS001', 'ACT001', '2019-09-26', 7, '', 1, 1, '2019-09-26 03:51:08', '2019-09-26 09:21:08'),
(4, 'dfsa', 'dsfas', '2019-09-26', 7, '', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(5, 'GS003', 'ACT0045', '2019-10-02', 7, 'dio', 1, 1, '2019-10-02 09:58:35', '2019-10-02 15:28:35'),
(6, 'GS003', 'ACT0045', '2019-10-02', 7, 'dio', 1, 1, '2019-10-02 09:59:53', '2019-10-02 15:29:53'),
(7, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, '2019-10-02 10:39:05', '2019-10-02 16:09:05'),
(8, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, '2019-10-02 10:39:14', '2019-10-02 16:09:14'),
(9, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, '2019-10-02 10:39:35', '2019-10-02 16:09:35'),
(10, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, '2019-10-02 10:41:14', '2019-10-02 16:11:14'),
(11, '2342135424', 'ACT00034', '2019-10-02', 7, 'Sri', 1, 1, '2019-10-02 10:46:27', '2019-10-02 16:16:27'),
(12, '4523463465', 'AST0045', '2019-10-02', 7, 'Sri', 1, 1, '2019-10-02 10:50:58', '2019-10-02 16:20:58'),
(13, '4523463465', 'ACT0034', '2019-10-02', 7, 'EndCus1', 1, 1, '2019-10-02 11:32:58', '2019-10-02 17:02:58'),
(14, '2342135424', 'ACT432', '2019-10-02', 7, 'EndCus2', 1, 1, '2019-10-02 11:33:51', '2019-10-02 17:03:51'),
(15, '4523463465', 'ACT00345', '2019-10-03', 7, 'Sri', 1, 1, '2019-10-03 02:03:35', '2019-10-03 07:33:35'),
(16, '4523463465', 'sdsfsdaaf', '2019-10-04', 7, 'Sri', 1, 1, '2019-10-04 08:59:51', '2019-10-04 14:29:51'),
(17, '4523463465', 'sdfsadf', '2019-10-04', 6, 'dio', 1, 1, '2019-10-04 09:01:05', '2019-10-04 14:31:05'),
(18, '4523463465', 'sdfsadf', '2019-10-04', 6, 'dio', 1, 1, '2019-10-04 09:05:34', '2019-10-04 14:35:34'),
(19, '4523463465', 'sdfsdafa', '2019-10-05', 7, 'EndCus1', 1, 1, '2019-10-04 14:36:01', '2019-10-04 20:06:01'),
(20, '4523463465', 'sdfsaf', '2019-10-05', 7, 'EndCus2', 1, 1, '2019-10-04 14:37:25', '2019-10-04 20:07:25'),
(21, '4523463465', 'sdfsf', '2019-10-05', 6, 'EndCus2', 1, 1, '2019-10-04 14:41:14', '2019-10-04 20:11:14'),
(22, '4523463465', 'sdfsf', '2019-10-05', 6, 'EndCus2', 1, 1, '2019-10-04 14:41:41', '2019-10-04 20:11:41'),
(23, '4523463465', 'sfsdf', '2019-10-05', 6, 'Sri', 1, 1, '2019-10-04 14:43:12', '2019-10-04 20:13:12'),
(24, '4523463465', 'fdsdaf', '2019-10-05', 6, 'EndCus2', 1, 1, '2019-10-04 14:52:42', '2019-10-04 20:22:42'),
(25, '4523463465', 'sdfasf', '2019-10-05', 7, 'EndCus1', 1, 1, '2019-10-05 03:00:47', '2019-10-05 08:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `rma_delivery_address`
--

CREATE TABLE `rma_delivery_address` (
  `id` bigint(11) NOT NULL,
  `rma_id` bigint(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `contact_person` varchar(25) NOT NULL,
  `tel_no` varchar(15) NOT NULL,
  `email` varchar(25) NOT NULL,
  `gst` varchar(15) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rma_delivery_address`
--

INSERT INTO `rma_delivery_address` (`id`, `rma_id`, `address`, `contact_person`, `tel_no`, `email`, `gst`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-09-26 03:50:47', '2019-09-26 09:20:47'),
(2, 3, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-09-26 03:51:08', '2019-09-26 09:21:08'),
(3, 4, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(4, 5, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 09:58:36', '2019-10-02 15:28:36'),
(5, 6, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 09:59:53', '2019-10-02 15:29:53'),
(6, 7, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 10:39:05', '2019-10-02 16:09:05'),
(7, 8, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 10:39:14', '2019-10-02 16:09:14'),
(8, 9, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 10:39:35', '2019-10-02 16:09:35'),
(9, 10, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 10:41:14', '2019-10-02 16:11:14'),
(10, 11, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 10:46:27', '2019-10-02 16:16:27'),
(11, 12, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 10:50:58', '2019-10-02 16:20:58'),
(12, 13, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 11:32:58', '2019-10-02 17:02:58'),
(13, 14, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-02 11:33:51', '2019-10-02 17:03:51'),
(14, 15, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-03 02:03:35', '2019-10-03 07:33:35'),
(15, 16, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-04 08:59:51', '2019-10-04 14:29:51'),
(16, 17, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-04 09:01:05', '2019-10-04 14:31:05'),
(17, 18, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-04 09:05:34', '2019-10-04 14:35:34'),
(18, 19, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-04 14:36:01', '2019-10-04 20:06:01'),
(19, 20, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-04 14:37:25', '2019-10-04 20:07:25'),
(20, 21, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-04 14:41:14', '2019-10-04 20:11:14'),
(21, 22, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-04 14:41:41', '2019-10-04 20:11:41'),
(22, 23, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-04 14:43:12', '2019-10-04 20:13:12'),
(23, 24, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-04 14:52:42', '2019-10-04 20:22:42'),
(24, 25, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-05 03:00:47', '2019-10-05 08:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `rma_unit_information`
--

CREATE TABLE `rma_unit_information` (
  `id` bigint(11) NOT NULL,
  `rma_id` bigint(11) NOT NULL,
  `pv_id` bigint(11) NOT NULL,
  `sw_version` varchar(5) NOT NULL,
  `service_type` int(11) NOT NULL,
  `warrenty` int(11) NOT NULL,
  `desc_of_fault` varchar(100) NOT NULL,
  `sales_order_no` varchar(10) DEFAULT NULL,
  `field_volts_used` tinyint(4) NOT NULL,
  `equip_failed_on_installation` tinyint(4) NOT NULL,
  `equip_failed_on_service` tinyint(4) NOT NULL,
  `how_long` varchar(25) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rma_unit_information`
--

INSERT INTO `rma_unit_information` (`id`, `rma_id`, `pv_id`, `sw_version`, `service_type`, `warrenty`, `desc_of_fault`, `sales_order_no`, `field_volts_used`, `equip_failed_on_installation`, `equip_failed_on_service`, `how_long`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 'V01', 1, 1, '', NULL, 0, 0, 0, '', 1, 1, '2019-09-26 03:51:08', '2019-09-26 09:21:08'),
(2, 3, 0, 'V02', 2, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-09-26 03:51:08', '2019-09-26 09:21:08'),
(3, 4, 0, 'sdfas', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(4, 4, 0, 'dsfas', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(5, 6, 9, 'SV9', 1, 1, 'Desc of fault 9', NULL, 1, 1, 1, '9', 1, 1, '2019-10-02 09:59:53', '2019-10-02 15:29:53'),
(6, 6, 11, 'SV11', 2, 0, 'desc', NULL, 0, 0, 0, 'as', 1, 1, '2019-10-02 09:59:53', '2019-10-02 15:29:53'),
(7, 7, 9, 'SW9', 1, 1, 'Desc9', NULL, 1, 1, 1, '9', 1, 1, '2019-10-02 10:39:05', '2019-10-02 16:09:05'),
(8, 8, 9, 'SW9', 1, 1, 'Desc9', NULL, 1, 1, 1, '9', 1, 1, '2019-10-02 10:39:14', '2019-10-02 16:09:14'),
(9, 9, 9, 'SW9', 1, 1, 'Desc9', NULL, 1, 1, 1, '9', 1, 1, '2019-10-02 10:39:35', '2019-10-02 16:09:35'),
(10, 10, 9, 'SW9', 1, 1, 'Desc9', NULL, 1, 1, 1, '9', 1, 1, '2019-10-02 10:41:14', '2019-10-02 16:11:14'),
(11, 10, 11, 'SV11', 2, 0, 'Desc11', NULL, 0, 0, 0, '11', 1, 1, '2019-10-02 10:41:14', '2019-10-02 16:11:14'),
(12, 11, 9, 'SV9', 1, 1, 'Desc9', NULL, 1, 1, 1, '9', 1, 1, '2019-10-02 10:46:27', '2019-10-02 16:16:27'),
(13, 11, 11, 'SV11', 2, 0, 'Desc11', NULL, 0, 0, 0, '11', 1, 1, '2019-10-02 10:46:27', '2019-10-02 16:16:27'),
(14, 12, 8, 'SV8', 1, 1, 'DSC8', 'SO001', 1, 1, 1, 'HW8', 1, 1, '2019-10-02 10:50:58', '2019-10-02 16:20:58'),
(15, 13, 1, 'SV1', 2, 1, 'Desc1', '12563455', 1, 1, 1, '1', 1, 1, '2019-10-02 11:32:58', '2019-10-02 17:02:58'),
(16, 14, 2, 'SV2', 1, 1, 'Desc2', '1234', 1, 1, 1, '2', 1, 1, '2019-10-02 11:33:51', '2019-10-02 17:03:51'),
(17, 10, 4, 'SV4', 1, 1, 'Desc', '12563455', 1, 1, 1, 'HW4', 1, 1, '2019-10-03 01:51:49', '2019-10-03 07:21:49'),
(18, 5, 3, 'SV3', 1, 1, 'Desc3', '123433', 1, 1, 1, 'HW3', 1, 1, '2019-10-03 01:53:47', '2019-10-03 07:23:47'),
(19, 8, 5, 'SV5', 1, 1, 'Desc5', 'SO001', 1, 1, 1, 'HW5', 1, 1, '2019-10-03 01:54:37', '2019-10-03 07:24:37'),
(20, 5, 6, 'SV6', 1, 1, 'Desc6', 'Sales001', 1, 1, 1, 'HW6', 1, 1, '2019-10-03 01:56:10', '2019-10-03 07:26:10'),
(21, 10, 7, 'SV7', 1, 1, 'Desc7', 'Sales001', 1, 1, 1, 'HW7', 1, 1, '2019-10-03 01:58:45', '2019-10-03 07:28:45'),
(22, 15, 12, 'SV12', 1, 1, 'Desc12', NULL, 1, 1, 1, 'HL12', 1, 1, '2019-10-03 02:03:35', '2019-10-03 07:33:35'),
(23, 16, 17, 'sdfsa', 1, 1, 'sdfsdafas', NULL, 1, 0, 0, 'sdfas', 1, 1, '2019-10-04 08:59:51', '2019-10-04 14:29:51'),
(24, 17, 16, '12', 1, 1, 'sdfdsafa', NULL, 1, 1, 0, '1', 1, 1, '2019-10-04 09:01:05', '2019-10-04 14:31:05'),
(25, 18, 16, '12', 1, 1, 'sdfdsafa', NULL, 1, 1, 0, '1', 1, 1, '2019-10-04 09:05:34', '2019-10-04 14:35:34'),
(26, 19, 16, 'ASD3r', 1, 1, 'adfdsaf', NULL, 0, 0, 1, 'sdfsa', 1, 1, '2019-10-04 14:36:01', '2019-10-04 20:06:01'),
(27, 20, 16, 'asd', 1, 1, 'sdfas', NULL, 1, 0, 0, 'sdfas', 1, 1, '2019-10-04 14:37:25', '2019-10-04 20:07:25'),
(28, 21, 16, 'sd', 1, 1, 'dfs', NULL, 1, 1, 1, 'sdfs', 1, 1, '2019-10-04 14:41:14', '2019-10-04 20:11:14'),
(29, 22, 16, 'sd', 1, 1, 'dfs', NULL, 1, 1, 1, 'sdfs', 1, 1, '2019-10-04 14:41:41', '2019-10-04 20:11:41'),
(30, 23, 16, 'sdfs', 2, 1, 'sdfsda', NULL, 1, 1, 1, 'dsfsa', 1, 1, '2019-10-04 14:43:12', '2019-10-04 20:13:12'),
(31, 24, 16, 'as', 1, 1, 'sdfsafs', NULL, 1, 0, 0, 'sdfdsa', 1, 1, '2019-10-04 14:52:42', '2019-10-04 20:22:42'),
(32, 25, 18, 's', 1, 0, 'sdfads', NULL, 0, 0, 0, 'dsfsa', 1, 1, '2019-10-05 03:00:47', '2019-10-05 08:30:47');

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

--
-- Dumping data for table `rma_unit_serial_number`
--

INSERT INTO `rma_unit_serial_number` (`id`, `rma_unit_information_id`, `serial_number`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'SER0101', 1, 1, '2019-09-26 03:51:08', '2019-09-26 09:21:08'),
(2, 2, 'SER0201', 1, 1, '2019-09-26 03:51:08', '2019-09-26 09:21:08'),
(3, 3, 'sdfsa', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(4, 3, 'sdadfasd', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(5, 4, 'adsf', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53'),
(6, 4, 'sdfas', 1, 1, '2019-09-26 07:12:53', '2019-09-26 12:42:53');

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
  `comment` varchar(30) DEFAULT NULL,
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
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`id`, `pv_id`, `smp`, `pcp`, `type`, `move`, `rca`, `comment`, `mail_to`, `cc`, `message`, `po`, `wbs`, `updated_at`, `updated_by`, `created_at`, `created_by`) VALUES
(1, 1, 1, 2, 1, 1, 1, '', NULL, NULL, '', '', 'WBS0034', '2019-10-04 02:55:10', 1, '2019-10-04 02:55:10', 1),
(2, 1, 1, 2, 1, 1, 1, '', NULL, NULL, '', '', 'WBS0034', '2019-10-04 02:57:18', 1, '2019-10-04 02:57:18', 1),
(3, 1, 1, 2, 1, 1, 1, '', NULL, NULL, NULL, '', 'WBS0034', '2019-10-04 02:59:01', 1, '2019-10-04 02:59:01', 1),
(4, 2, 1, 2, 1, 1, 1, '', 'Krishnan@email.com,Balaji@email.com', 'Krishnan@email.com,Srinivas@email.com', 'Messagae', '', 'WBS0034', '2019-10-04 02:59:01', 1, '2019-10-04 02:59:01', 1),
(5, 3, 1, 2, 1, 1, 1, '', 'Krishnan@email.com,Balaji@email.com', 'Krishnan@email.com,Srinivas@email.com', 'Messagae', '', 'WBS0034', '2019-10-04 02:59:01', 1, '2019-10-04 02:59:01', 1),
(6, 4, 1, 2, 1, 1, 1, '', NULL, NULL, NULL, '', 'WBS0034', '2019-10-04 02:59:01', 1, '2019-10-04 02:59:01', 1),
(7, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:26:02', 1, '2019-10-04 07:26:02', 1),
(8, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:27:31', 1, '2019-10-04 07:27:31', 1),
(9, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:31:36', 1, '2019-10-04 07:31:36', 1),
(10, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:31:56', 1, '2019-10-04 07:31:56', 1),
(11, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:42:19', 1, '2019-10-04 07:42:19', 1),
(12, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:42:31', 1, '2019-10-04 07:42:31', 1),
(13, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:42:58', 1, '2019-10-04 07:42:58', 1),
(14, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:43:28', 1, '2019-10-04 07:43:28', 1),
(15, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:43:56', 1, '2019-10-04 07:43:56', 1),
(16, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:45:20', 1, '2019-10-04 07:45:20', 1),
(17, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:45:32', 1, '2019-10-04 07:45:32', 1),
(18, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:46:40', 1, '2019-10-04 07:46:40', 1),
(19, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:47:14', 1, '2019-10-04 07:47:14', 1),
(20, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:47:50', 1, '2019-10-04 07:47:50', 1),
(21, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:48:13', 1, '2019-10-04 07:48:13', 1),
(22, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:48:19', 1, '2019-10-04 07:48:19', 1),
(23, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:53:44', 1, '2019-10-04 07:53:44', 1),
(24, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:54:12', 1, '2019-10-04 07:54:12', 1),
(25, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:55:08', 1, '2019-10-04 07:55:08', 1),
(26, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:55:42', 1, '2019-10-04 07:55:42', 1),
(27, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:56:07', 1, '2019-10-04 07:56:07', 1),
(28, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 07:56:13', 1, '2019-10-04 07:56:13', 1),
(29, 1, 1, 2, 1, 2, 1, '', 'Krishnan@email.com,Balaji@email.com', 'Krishnan@email.com,Balaji@email.com', 'sdfsaaf', '', 'sdfsda', '2019-10-04 07:59:45', 1, '2019-10-04 07:59:45', 1),
(30, 1, 1, 2, 1, 2, 1, '', 'Krishnan@email.com,Balaji@email.com', 'Krishnan@email.com,Balaji@email.com', 'sdfsaaf', '', 'sdfsda', '2019-10-04 08:01:10', 1, '2019-10-04 08:01:10', 1),
(31, 1, 1, 2, 1, 2, 1, '', 'Krishnan@email.com,Balaji@email.com', 'Krishnan@email.com,Balaji@email.com', 'sdfsaaf', '', 'sdfsda', '2019-10-04 08:02:07', 1, '2019-10-04 08:02:07', 1),
(32, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:24:09', 1, '2019-10-04 08:24:09', 1),
(33, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:24:58', 1, '2019-10-04 08:24:58', 1),
(34, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:29:18', 1, '2019-10-04 08:29:18', 1),
(35, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:29:47', 1, '2019-10-04 08:29:47', 1),
(36, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:30:31', 1, '2019-10-04 08:30:31', 1),
(37, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:31:06', 1, '2019-10-04 08:31:06', 1),
(38, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:31:35', 1, '2019-10-04 08:31:35', 1),
(39, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:33:08', 1, '2019-10-04 08:33:08', 1),
(40, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:41:38', 1, '2019-10-04 08:41:38', 1),
(41, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:43:04', 1, '2019-10-04 08:43:04', 1),
(42, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:45:23', 1, '2019-10-04 08:45:23', 1),
(43, 2, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:45:23', 1, '2019-10-04 08:45:23', 1),
(44, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 12:56:55', 1, '2019-10-04 12:56:55', 1),
(45, 17, 2, 2, 1, 2, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 14:30:31', 1, '2019-10-04 14:30:31', 1),
(46, 18, 2, 2, 1, 2, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 14:33:40', 1, '2019-10-04 14:33:40', 1),
(47, 18, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 14:56:20', 1, '2019-10-04 14:56:20', 1),
(48, 18, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-05 03:01:50', 1, '2019-10-05 03:01:50', 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `warranty`
--
ALTER TABLE `warranty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `job_tickets`
--
ALTER TABLE `job_tickets`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_ticket_materials`
--
ALTER TABLE `job_ticket_materials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ma_customer`
--
ALTER TABLE `ma_customer`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ma_product_type`
--
ALTER TABLE `ma_product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ma_pv_status`
--
ALTER TABLE `ma_pv_status`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- AUTO_INCREMENT for table `physical_verification`
--
ALTER TABLE `physical_verification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `rma`
--
ALTER TABLE `rma`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `rma_delivery_address`
--
ALTER TABLE `rma_delivery_address`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rma_unit_information`
--
ALTER TABLE `rma_unit_information`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rma_unit_serial_number`
--
ALTER TABLE `rma_unit_serial_number`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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

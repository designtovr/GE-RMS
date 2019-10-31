-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2019 at 09:14 AM
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

--
-- Dumping data for table `aging`
--

INSERT INTO `aging` (`pv_id`, `result`, `comment`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(34, 1, 'Pass 1', 1, '2019-10-31 08:12:29', 1, '2019-10-31 13:43:09');

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

--
-- Dumping data for table `aging_tracking`
--

INSERT INTO `aging_tracking` (`pv_id`, `result`, `comment`, `created_by`, `created_at`) VALUES
(34, 0, 'Fail 1', 1, '2019-10-31 08:12:29'),
(34, 0, 'Fail 2', 1, '2019-10-31 08:12:48'),
(34, 1, 'Pass 1', 1, '2019-10-31 08:13:09');

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

--
-- Dumping data for table `auto_test_bench`
--

INSERT INTO `auto_test_bench` (`pv_id`, `result`, `comment`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(34, 1, 'Pass 1', 1, '2019-10-31 07:49:31', 1, '2019-10-31 13:21:46'),
(39, 1, 'Pass 1', 1, '2019-10-31 07:49:31', 1, '2019-10-31 13:21:46');

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

--
-- Dumping data for table `auto_test_bench_tracking`
--

INSERT INTO `auto_test_bench_tracking` (`pv_id`, `result`, `comment`, `created_by`, `created_at`) VALUES
(34, 0, 'Fail 1', 1, '2019-10-31 07:49:31'),
(39, 0, 'Fail 1', 1, '2019-10-31 07:49:31'),
(34, 0, 'Fail 2', 1, '2019-10-31 07:51:33'),
(39, 0, 'Fail 2', 1, '2019-10-31 07:51:33'),
(34, 1, 'Pass 1', 1, '2019-10-31 07:51:46'),
(39, 1, 'Pass 1', 1, '2019-10-31 07:51:46');

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
  `comment` varchar(200) DEFAULT NULL,
  `power_on_test` varchar(200) DEFAULT NULL,
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_tickets`
--

INSERT INTO `job_tickets` (`id`, `pv_id`, `nature_of_defect`, `comment`, `power_on_test`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 18, '', NULL, NULL, 1, 1, '2019-10-05 11:24:23', '2019-10-17 03:46:21'),
(2, 16, NULL, NULL, NULL, 1, 1, '2019-10-05 11:25:46', '2019-10-05 19:15:02'),
(3, 20, NULL, NULL, NULL, 1, 1, '2019-10-05 11:30:33', '2019-10-06 13:24:37'),
(4, 23, NULL, NULL, NULL, 1, 1, '2019-10-06 04:27:07', '2019-10-06 09:57:07'),
(5, 2, NULL, NULL, NULL, 1, 1, '2019-10-06 04:46:34', '2019-10-06 10:16:34'),
(6, 25, NULL, NULL, NULL, 1, 1, '2019-10-06 08:11:36', '2019-10-06 13:46:12'),
(7, 1, NULL, NULL, NULL, 1, 1, '2019-10-08 12:22:41', '2019-10-08 17:52:41'),
(8, 12, NULL, NULL, NULL, 1, 1, '2019-10-08 12:22:49', '2019-10-08 17:52:49'),
(9, 17, '', NULL, 'dsa', 1, 1, '2019-10-09 15:49:02', '2019-10-17 03:45:08'),
(10, 40, NULL, NULL, NULL, 1, 1, '2019-10-10 13:36:39', '2019-10-10 19:09:33'),
(11, 60, NULL, NULL, NULL, 1, 1, '2019-10-15 15:59:44', '2019-10-15 21:29:50'),
(12, 21, 'NA', NULL, 'na', 1, 1, '2019-10-15 16:01:31', '2019-10-15 21:31:31'),
(13, 28, 'NA', NULL, 'na', 1, 1, '2019-10-15 16:02:50', '2019-10-15 21:33:31'),
(14, 30, NULL, NULL, NULL, 1, 1, '2019-10-16 15:49:33', '2019-10-16 21:21:41'),
(18, 37, '', NULL, 'dfgsdfs', 1, 1, '2019-10-16 21:55:45', '2019-10-17 03:26:02'),
(19, 72, '', NULL, 'NOT POWERING ON', 1, 1, '2019-10-17 06:36:41', '2019-10-17 12:06:52'),
(20, 19, '', NULL, '1a', 1, 1, '2019-10-17 07:43:11', '2019-10-17 13:13:11'),
(21, 27, '', NULL, '121', 1, 1, '2019-10-17 07:50:34', '2019-10-17 13:20:34'),
(22, 71, '', 'Repair Commentn', '12', 1, 1, '2019-10-17 07:53:36', '2019-10-17 13:23:36'),
(23, 34, '', 'Job Ticket Comment', NULL, 1, 1, '2019-10-31 07:42:09', '2019-10-31 13:15:42'),
(26, 39, '', NULL, NULL, 1, 1, '2019-10-31 07:46:46', '2019-10-31 13:16:46');

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

--
-- Dumping data for table `job_ticket_materials`
--

INSERT INTO `job_ticket_materials` (`id`, `jt_id`, `part_no`, `value`, `old_pcp`, `new_pcp`, `comment`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(5, 2, 'sdfdsaf', 'sdfasd', 'sdfasdf', 'sdfds', NULL, 1, 1, '2019-10-05 13:43:09', '2019-10-05 19:13:09'),
(6, 2, 'sdfdsaf', 'sdfasd', 'sdfasdf', 'sdfds', NULL, 1, 1, '2019-10-05 13:45:02', '2019-10-05 19:15:02'),
(7, 2, 'dfasdf', 'sdfsad', 'sdfsada', 'sdfdsad', NULL, 1, 1, '2019-10-05 13:45:02', '2019-10-05 19:15:02'),
(8, 4, 'sdfsdf', 'sdfas', NULL, NULL, NULL, 1, 1, '2019-10-06 04:27:07', '2019-10-06 09:57:07'),
(9, 5, 'sfds', 'sfss', 'sdfsa', 'sdfdsa', NULL, 1, 1, '2019-10-06 04:46:34', '2019-10-06 10:16:34'),
(10, 3, 'fgfasgas', 'dsdcsd', 'dsfsadf', 'sdfdsda', NULL, 1, 1, '2019-10-06 07:54:37', '2019-10-06 13:24:37'),
(15, 6, 'dsfsadaf', 'sadafsda', 'sdfas', 'sdafsda', NULL, 1, 1, '2019-10-06 08:16:12', '2019-10-06 13:46:12'),
(16, 6, 'sdfsda', 'sdfdsa', 'sdfas', 'dsfsa', NULL, 1, 1, '2019-10-06 08:16:12', '2019-10-06 13:46:12'),
(17, 7, 'ssda', 'sdfas', 'sdfsa', 'sdas', NULL, 1, 1, '2019-10-08 12:22:41', '2019-10-08 17:52:41'),
(18, 8, 'sdfsa', 'sds', 'sdaas', 'sdsa', 'sdfas', 1, 1, '2019-10-08 12:22:49', '2019-10-08 17:52:49'),
(24, 10, 'EZN0019101', NULL, 'NIL', 'NIl', 'Nil', 1, 1, '2019-10-10 13:39:33', '2019-10-10 19:09:33'),
(27, 11, 'sfsfsf', NULL, 'sfsdfdfg', 'fsddgh', 'dfsfds', 1, 1, '2019-10-15 15:59:50', '2019-10-15 21:29:50'),
(28, 11, 'gfsdfhhhdhf', NULL, 'dfsfsf', 'sfsf', 'fsff', 1, 1, '2019-10-15 15:59:50', '2019-10-15 21:29:50'),
(29, 12, 'na', NULL, 'na', 'na', 'na', 1, 1, '2019-10-15 16:01:31', '2019-10-15 21:31:31'),
(32, 13, 'nan', NULL, 'nan', 'nan', 'nan', 1, 1, '2019-10-15 16:03:31', '2019-10-15 21:33:31'),
(34, 14, 'zxcxcvxc', NULL, 'sadfsdvsad', 'sdfsdvcxvxzxcz', 'sdfsvczxzvczx', 1, 1, '2019-10-16 15:51:41', '2019-10-16 21:21:41'),
(36, 18, 'dfasfas', NULL, 'ssdfasdf', 'sdfasdfa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the in', 1, 1, '2019-10-16 21:56:02', '2019-10-17 03:26:02'),
(37, 9, 'QDQDQ', NULL, 'sdfasdf', 'sdfdasd', 'sdfsadfasd', 1, 1, '2019-10-16 22:14:40', '2019-10-17 03:44:40'),
(38, 9, 'QDQDQ', NULL, 'sdfasdf', 'sdfdasd', 'sdfsadfasd', 1, 1, '2019-10-16 22:15:08', '2019-10-17 03:45:08'),
(39, 1, 'sdfsfa', NULL, 'sdfsadf', 'sdfdasdf', 'sdfasdf', 1, 1, '2019-10-16 22:16:21', '2019-10-17 03:46:21'),
(41, 19, 'EZN0019101', NULL, 'EZN0019101.A.1939240', 'EZN0019101.D.1939240.PCB', 'Relay card error', 1, 1, '2019-10-17 06:36:52', '2019-10-17 12:06:52'),
(42, 20, 'dsdfsdf', NULL, 'sdfasdfasd', 'sdfasdfas', 'sdfsdfasdd', 1, 1, '2019-10-17 07:43:11', '2019-10-17 13:13:11'),
(43, 21, 'sdfdsad', NULL, 'sdfasd', 'sdfas', 'sadfa', 1, 1, '2019-10-17 07:50:34', '2019-10-17 13:20:34'),
(44, 22, 'sdfsadf', NULL, 'sdfsadfa', 'sadffsad', 'asdfasfasd', 1, 1, '2019-10-17 07:53:36', '2019-10-17 13:23:36'),
(45, 23, '2312421341', NULL, '2342', '23421421', NULL, 1, 1, '2019-10-31 07:45:42', '2019-10-31 13:15:42'),
(46, 26, '1232', NULL, '234214', 'dsfsa', NULL, 1, 1, '2019-10-31 07:46:46', '2019-10-31 13:16:46');

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

--
-- Dumping data for table `ma_customer`
--

INSERT INTO `ma_customer` (`id`, `code`, `name`, `address`, `pincode`, `contact_person`, `email`, `gst`, `contact`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3, 'CS002', 'Sujan', 'Chennai', '1234', 'Sujan', 'sujan@gmail.com', 'QWERTYUIOASDFDS', '1234567890', 1, 1, '2019-08-26 01:52:04', '2019-10-29 06:27:09'),
(4, 'CS003', 'ASDD', 'No,1 Anna Salai, Guindy,\nChennai -600075', '6000023', 'Arun', 'arun@ds.com', '35AABCS1429B1ZX', '1234567890', 1, 1, '2019-09-24 06:00:19', '2019-10-21 07:48:59'),
(5, 'CS003', 'ASDD', 'Chennai', '', 'Arun', 'arun@ds.com', '35AABCS1429B1ZX', '1234567890', 1, 1, '2019-09-24 06:00:32', '2019-09-24 06:00:32'),
(6, 'CS003', 'ASDD', 'Chennai', '', 'Arun', 'arun@ds.com', '35AABCS1429B1ZX', '1234567890', 1, 1, '2019-09-24 06:02:03', '2019-09-24 06:02:03'),
(7, 'CS004', 'ADFEW', 'Chennai', '', 'Sujan', 'ds@da.co', '35AABCS1429B1ZX', '1234567', 1, 1, '2019-09-24 06:13:11', '2019-09-24 06:13:11'),
(8, 'CS0010', 'AK Electrical', 'No.1 , MG Road, \nKolkata -500045', '', 'SUMAN', 'admin@akelectricals.com', '18AABCT3518Q1ZV', '7401262829', 1, 1, '2019-10-08 06:33:39', '2019-10-08 06:33:39'),
(9, 'CS0011', 'PGCIL', 'NO.3,GB ROAD,MUMBAI-700085', '', 'SUNIL', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', '9024442442', 1, 1, '2019-10-08 07:00:18', '2019-10-08 07:00:18'),
(10, 'CS0012', 'Srivari Electricals', 'No,1 Anna Salai, Guindy,\nChennai -600075', '', 'GUNA', 'guna.s@srivarielectricals.com', '18AABCT3518Q1ZV', '7810456794', 1, 1, '2019-10-14 11:04:00', '2019-10-14 11:04:00'),
(11, 'CS0015', 'APTRANSCO', 'Vidyut Soudha,\nGunadala,Eluru Rd,\nVijayawada, Andhra Pradesh 520004', '', 'praveen kumar', 'praveenkumar@aptransco.co.in', '29AADCC9174H1ZA', '87845613366', 1, 1, '2019-10-20 13:11:30', '2019-10-20 13:11:30'),
(12, 'CS00345', 'GE Branch 2', 'Vidyut Soudha,\nGunadala,Eluru Rd,\nVijayawada, Andhra Pradesh 520004', '', 'praveen kumar', 'praveenkumar@aptransco.co.in', '29AADCC9174H1ZA', '87845613366', 1, 1, '2019-10-21 06:18:29', '2019-10-21 06:18:29');

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
(3, 1, 1, 1, '2019-08-26 01:52:04', '2019-10-29 06:27:09'),
(6, 1, 1, 1, '2019-09-24 06:02:03', '2019-09-24 06:02:03'),
(7, 1, 1, 1, '2019-09-24 06:13:11', '2019-09-24 06:13:11'),
(8, 2, 1, 1, '2019-10-08 06:33:39', '2019-10-08 06:33:39'),
(9, 5, 1, 1, '2019-10-08 07:00:18', '2019-10-08 07:00:18'),
(10, 1, 1, 1, '2019-10-14 11:04:00', '2019-10-14 11:04:00'),
(11, 6, 1, 1, '2019-10-20 13:11:30', '2019-10-20 13:11:30'),
(12, 6, 1, 1, '2019-10-21 06:18:29', '2019-10-21 06:18:29'),
(13, 6, 1, 1, '2019-10-21 06:20:53', '2019-10-21 06:20:53'),
(16, 6, 1, 1, '2019-10-21 06:53:02', '2019-10-21 07:17:20'),
(4, 5, 1, 1, '2019-10-21 07:48:47', '2019-10-21 07:48:59');

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
(3, 2, 1, 1, NULL, '2019-10-29 06:27:09'),
(6, 1, 1, 1, '2019-09-24 06:02:03', '2019-09-24 06:02:03'),
(7, 1, 1, 1, '2019-09-24 06:13:11', '2019-09-24 06:13:11'),
(8, 1, 1, 1, '2019-10-08 06:33:39', '2019-10-08 06:33:39'),
(9, 5, 1, 1, '2019-10-08 07:00:18', '2019-10-08 07:00:18'),
(10, 1, 1, 1, '2019-10-14 11:04:00', '2019-10-14 11:04:00'),
(11, 6, 1, 1, '2019-10-20 13:11:30', '2019-10-20 13:11:30'),
(12, 4, 1, 1, '2019-10-21 06:18:29', '2019-10-21 06:18:29'),
(13, 4, 1, 1, '2019-10-21 06:20:53', '2019-10-21 06:20:53'),
(4, 6, 1, 1, '2019-10-21 07:48:59', '2019-10-21 07:48:59');

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
(1, 'LOC1', 'Chennai', 1, 1, NULL, NULL),
(2, 'LOC2', 'Madurai', 1, 1, NULL, NULL),
(3, 'LOC3', 'Coimbatore', 1, 1, '2019-08-26 08:38:09', '2019-08-26 08:38:09'),
(4, 'WBE', 'Kolkata', 1, 1, '2019-10-08 06:34:22', '2019-10-08 06:34:22'),
(5, 'MUM', 'MUMBAI', 1, 1, '2019-10-08 06:54:57', '2019-10-08 06:54:57'),
(6, 'APS', 'Andhra', 1, 1, '2019-10-20 13:04:30', '2019-10-20 13:04:30');

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
  `part_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(6, 'P141916A6M', 'Backup protection', 4, 1, 1, '2019-10-03 05:45:51', '2019-10-03 05:45:51'),
(7, 'ASFfsdgfsd', NULL, 4, 1, 1, '2019-10-05 12:35:14', '2019-10-05 12:35:14'),
(8, 'asdafasdf', 'adsafsadf', 4, 1, 1, '2019-10-08 07:41:04', '2019-10-08 07:41:04'),
(9, 'sdfdsdafsdagsdgsdfsdfsdfdasddfasd', 'sdfsadafsdfdsdfsdfsd', 4, 1, 1, '2019-10-08 07:45:14', '2019-10-08 07:45:14'),
(10, 'P14NB1CA6C0570A', 'feeder Management Relay', 6, 1, 1, '2019-10-09 05:29:08', '2019-10-09 05:29:08'),
(11, 'P14NB16A6C0610A', NULL, 6, 1, 1, '2019-10-09 11:09:58', '2019-10-09 11:09:58'),
(12, 'P141916A6M0520J', 'OVER CURRENT RELAY', 5, 1, 1, '2019-10-10 11:18:42', '2019-10-10 11:18:42'),
(13, 'part02', NULL, 3, 1, 1, '2019-10-14 14:01:36', '2019-10-14 14:01:36'),
(14, 'P142916A6M0520K', NULL, 5, 1, 1, '2019-10-15 07:57:22', '2019-10-21 11:32:38'),
(15, 'AS234322', '', 5, 1, 1, '2019-10-29 06:39:09', '2019-10-29 06:39:09');

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

--
-- Dumping data for table `ma_product_type`
--

INSERT INTO `ma_product_type` (`id`, `code`, `name`, `category`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'PT001', 'PT1', 'boj', '', 1, 1, '2019-08-26 05:11:51', '2019-08-26 05:11:51'),
(2, 'PT002', 'PT2', 'boj', '', 1, 1, '2019-08-26 05:52:15', '2019-08-26 05:52:15'),
(3, 'PT003', 'PT3', 'ge', 'This is third', 1, 1, '2019-09-24 10:36:20', '2019-09-24 10:36:20'),
(4, 'Px40', 'Numerical', 'ge', 'micom', 1, 1, '2019-10-03 05:40:44', '2019-10-03 05:40:44'),
(5, 'PX40', 'MICOM', 'ge', 'NUMERICAL RELAY', 1, 1, '2019-10-08 06:44:34', '2019-10-08 06:44:34'),
(6, 'P14N', 'AGILE', 'ge', 'Numerical Relay', 1, 1, '2019-10-09 05:27:18', '2019-10-09 05:27:18'),
(7, 'C264', 'NUMERICAL', 'ge', 'Bus control bay', 1, 1, '2019-10-10 11:14:51', '2019-10-10 11:14:51');

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
(1, 'SITE1', 'Chennai', 1, 1, NULL, NULL),
(2, 'SITE2', 'Madurai', 1, 1, NULL, NULL),
(3, 'SITE3', 'Coimbatore', 1, 1, '2019-08-26 09:56:01', '2019-08-26 09:56:01'),
(4, 'KOL', 'Kolkata', 1, 1, '2019-10-08 06:37:13', '2019-10-08 06:37:13'),
(5, 'MUM-DHAR', 'DHARABI SS', 1, 1, '2019-10-08 06:58:02', '2019-10-08 06:58:02'),
(6, 'SITE4', 'Kadivedu', 1, 1, '2019-10-20 13:02:13', '2019-10-20 13:02:13');

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

--
-- Dumping data for table `physical_verification`
--

INSERT INTO `physical_verification` (`id`, `receipt_id`, `docket_details`, `courier_name`, `pvdate`, `producttype_id`, `product_id`, `serial_no`, `comment`, `case`, `case_condition`, `battery`, `battery_condition`, `terminal_blocks`, `terminal_blocks_condition`, `no_of_terminal_blocks`, `top_bottom_cover`, `top_bottom_cover_condition`, `short_links`, `short_links_condition`, `no_of_short_links`, `screws`, `sales_order_no`, `is_rma_available`, `updated_at`, `created_at`, `updated_by`, `created_by`) VALUES
(1, 1, '49m231', 'ADS', '2019-09-28', 2, 3, 'asfasf', '235235dd', 3, 1, 2, 2, 3, 2, NULL, 2, 1, 2, 1, NULL, 1, '12563455', 1, '2019-10-08 11:02:11', '2019-09-27 15:21:52', 1, 1),
(2, 9, '49m231', 'ADS', '2019-09-25', 1, 2, 'asfasf', '235235dd', 3, 1, 3, 2, 2, 2, NULL, 2, 2, 3, 1, NULL, 1, '1234', 1, '2019-10-08 11:02:11', '2019-09-25 12:37:35', 1, 1),
(3, 8, '567yhu8', 'ADS', '2019-09-25', 1, 4, 'asfasf', '235235dd', 2, 2, 1, 1, 2, 2, NULL, 1, 2, 2, 1, NULL, 1, '123433', 1, '2019-10-08 11:02:11', '2019-09-26 00:14:22', 1, 1),
(4, 7, '49m231', 'ADS', '2019-09-23', 1, 1, 'asfasf', '235235dd', 3, 1, 2, 2, 3, 2, NULL, 2, 1, 2, 1, NULL, 1, '12563455', 1, '2019-10-08 11:02:11', '2019-09-26 03:43:12', 1, 1),
(5, 9, 'DD  agf', 'CNM', '2019-09-27', 2, 5, 'SER1234', 'FAult', 1, 1, 2, 2, 3, 1, NULL, 2, 2, 3, 1, NULL, 1, 'SO001', 1, '2019-10-08 11:02:11', '2019-09-27 13:00:17', 1, 1),
(6, 8, 'DD  agf', 'CNM', '2019-09-28', 2, 3, 'Serial002', 'Faulty', 2, 1, 1, 2, 3, 1, NULL, 2, 2, 3, 1, NULL, 1, 'Sales001', 1, '2019-10-08 11:02:11', '2019-09-27 13:15:00', 1, 1),
(7, 7, '49m231', 'ADS', '2019-09-28', 2, 2, 'SER003', 'Fal', 3, 1, 2, 2, 3, 1, NULL, 2, 2, 3, 1, NULL, 1, 'Sales001', 1, '2019-10-08 11:02:11', '2019-09-27 15:25:11', 1, 1),
(8, 1, 'Docket', 'Fed', '2019-09-28', 2, 1, 'SER001', 'Fault', 1, 2, 1, 2, 1, 2, NULL, 1, 2, 1, 2, NULL, 1, 'SO001', 1, '2019-10-08 11:02:11', '2019-09-28 00:49:17', 1, 1),
(9, 9, 'STCD1', 'STC1', '2019-10-01', 3, 2, 'SER003', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-01 02:11:16', 1, 1),
(10, 9, 'STCD1', 'STC1', '2019-10-01', 3, 4, 'SER021', '', 1, 2, 1, 2, 1, 2, '12', 1, 2, 1, 2, 2, 1, NULL, 1, '2019-10-08 11:02:11', '2019-10-01 02:12:56', 1, 1),
(11, 10, 'STCD2', 'STC2', '2019-10-01', 2, 5, 'SER0045', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-01 02:29:30', 1, 1),
(12, 1, 'DD  agf', 'CNM', '2019-10-03', 3, 4, 'SE1456', '', 1, 2, 1, 2, 3, 2, '0', 1, 2, 2, 2, 0, 1, NULL, 1, '2019-10-08 11:02:11', '2019-10-03 02:01:04', 1, 1),
(13, 1, 'DD  agf', 'CNM', '2019-10-03', 2, 3, 'SER003', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-03 03:10:39', 1, 1),
(14, 7, '49m231', 'ADS', '2019-10-03', 2, 5, 'SER9687', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 0, '2019-10-08 11:02:11', '2019-10-03 03:13:25', 1, 1),
(15, 1, 'DD  agf', 'CNM', '2019-10-03', 4, 6, 'SER0321234', '', 1, 2, 1, 2, 2, 2, '14', 1, 2, 2, 2, 0, 1, '13242355', 0, '2019-10-08 11:02:11', '2019-10-03 05:53:51', 1, 1),
(16, 1, 'DD  agf', 'CNM', '2019-10-04', 4, 6, '23442351', '', 2, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-04 08:57:06', 1, 1),
(17, 1, 'DD  agf', 'CNM', '2019-10-04', 4, 6, '23423532', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-04 08:58:09', 1, 1),
(18, 1, 'DD  agf', 'CNM', '2019-10-05', 4, 6, 'SER0032', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, NULL, 1, '2019-10-08 11:02:11', '2019-10-04 13:58:49', 1, 1),
(19, 1, 'DD  agf', 'CNM', '2019-10-05', 4, 6, 'sdfdsadf', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-05 11:27:45', 1, 1),
(20, 7, '49m231', 'ADS', '2019-10-05', 4, 6, 'sdfsaf', '', 1, 2, 1, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-05 11:28:16', 1, 1),
(21, 1, 'DD  agf', 'CNM', '2019-10-05', 4, 6, 'sdfasdfas', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, 'sdfsadfds', 1, '2019-10-08 11:02:11', '2019-10-05 12:34:46', 1, 1),
(22, 1, 'DD  agf', 'CNM', '2019-10-05', 4, 7, 'sdfsa', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, 'sdfasdf', 1, '2019-10-08 11:02:11', '2019-10-05 12:35:14', 1, 1),
(23, 7, '49m231', 'ADS', '2019-10-06', 3, 4, 'sadfsgfds', '', 1, 2, 2, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-06 04:13:09', 1, 1),
(24, 7, '49m231', 'ADS', '2019-10-06', 3, 3, 'dfdsf', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-06 04:13:51', 1, 1),
(25, 7, '49m231', 'ADS', '2019-10-06', 3, 4, 'dfdasf', '', 1, 2, 2, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 11:02:11', '2019-10-06 04:17:59', 1, 1),
(26, 1, 'DD  agf', 'CNM', '2019-10-08', 3, 4, 'asdaasffafaFadsdasdafsdagfsgfsadfdasfasd', 'from un', 1, 2, 1, 2, 2, 2, '102', 1, 2, 2, 2, 0, 1, 'sdfsdalkfhsdalfh;okljsjdhfoisdahfpiosadhfioashd', 1, '2019-10-08 15:13:06', '2019-10-08 07:53:48', 1, 1),
(27, 9, 'STCD1', 'STC1', '2019-10-08', 4, 8, 'asddf', 'from in', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 15:13:25', '2019-10-08 08:28:03', 1, 1),
(28, 1, 'DD  agf', 'CNM', '2019-10-08', 2, 5, 'sdfsd', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-08 10:18:17', '2019-10-08 09:20:45', 1, 1),
(29, 29, 'sdfsdf', 'dsdadfas', '2019-10-21', 6, 11, 'Serial No New', '', 1, 2, 1, 2, 1, 2, '0120', 1, 2, 1, 2, 123, 1, 'Sales Order New', 1, '2019-10-21 14:41:23', '2019-10-08 09:27:39', 1, 1),
(30, 12, 'ewq', 'adas', '2019-10-08', 4, 7, 'dsfs', '', 1, 2, 1, 2, 1, 2, '1232', 1, 2, 1, 2, 12, 1, '', 1, '2019-10-08 09:28:27', '2019-10-08 09:28:27', 1, 1),
(31, 14, 'DC0001333', 'DHL', '2019-10-09', 6, 11, '34006080', '', 1, 2, 1, 2, 1, 2, '301', 1, 2, 1, 2, 3, 1, '', 1, '2019-10-09 11:09:58', '2019-10-09 11:09:58', 1, 1),
(32, 14, 'DC0001333', 'DHL', '2019-10-09', 6, 10, '3000456', '', 1, 1, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 13:24:08', '2019-10-09 13:24:08', 1, 1),
(33, 1, 'DD  agf', 'CNM', '2019-10-10', 4, 8, 'dfsadfsadfasdf', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 18:33:59', '2019-10-09 18:33:59', 1, 1),
(34, 1, 'DD  agf', 'CNM', '2019-10-10', 6, 11, 'dsdrsfsad', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 21:32:34', '2019-10-09 19:28:50', 1, 1),
(35, 1, 'DD  agf', 'CNM', '2019-10-10', 2, 5, 'sdfasafa', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 19:29:10', '2019-10-09 19:29:10', 1, 1),
(36, 1, 'DD  agf', 'CNM', '2019-10-10', 6, 11, 'sdfsdafsdf', '', 1, 2, 1, 2, 2, 2, '103', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 19:29:34', '2019-10-09 19:29:34', 1, 1),
(37, 1, 'DD  agf', 'CNM', '2019-10-10', 2, 5, 'fsgsd', '', 1, 2, 1, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-09 21:34:31', '2019-10-09 21:34:31', 1, 1),
(38, 7, '49m231', 'ADS', '2019-10-10', 3, 3, 'dfdf', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 21:34:47', '2019-10-09 21:34:47', 1, 1),
(39, 1, 'DD  agf', 'CNM', '2019-10-10', 4, 8, 'sffasfsd', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 21:37:06', '2019-10-09 21:37:06', 1, 1),
(40, 1, 'DD  agf', 'CNM', '2019-10-10', 6, 11, 'sdfsfgss', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-10 13:04:25', '2019-10-09 21:37:23', 1, 1),
(41, 1, 'DD  agf', 'CNM', '2019-10-10', 4, 7, 'fdsdgds', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-09 21:37:43', '2019-10-09 21:37:43', 1, 1),
(42, 18, 'DC000023', 'blue dart', '2019-10-10', 6, 11, '30004523', '', 1, 2, 1, 2, 1, 2, '102', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-10 05:52:26', '2019-10-10 05:52:26', 1, 1),
(43, 8, 'Docket', 'Fed', '2019-10-10', 6, 11, 'dsfsfsafdsafas', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-15 14:18:59', '2019-10-10 07:37:43', 1, 1),
(44, 20, 'DC000123', 'DHL', '2019-10-10', 5, 12, '32012345', '', 1, 2, 1, 2, 1, 2, '102', 1, 2, 1, 2, 2, 1, '', 1, '2019-10-10 11:20:30', '2019-10-10 11:20:30', 1, 1),
(45, 17, 'Doc', 'New Cour', '2019-10-10', 5, 12, '323444232', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-10 11:26:09', '2019-10-10 11:26:09', 1, 1),
(46, 21, 'DC1', 'dingdong', '2019-10-14', 3, 13, '123456', '', 1, 1, 2, 1, 1, 2, '202', 1, 2, 2, 2, 0, 3, '', 1, '2019-10-14 14:01:36', '2019-10-14 14:01:36', 1, 1),
(47, -1, '', '', '2019-10-14', 5, 12, 'ASdsfdsfs', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-14 14:29:47', '2019-10-14 14:29:47', 1, 1),
(48, -1, '', '', '2019-10-14', 5, 12, 'sdfvasdfasd', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-14 14:29:47', '2019-10-14 14:29:47', 1, 1),
(49, -1, '', '', '2019-10-14', 5, 12, 'ASdsfdsfs', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-14 14:30:11', '2019-10-14 14:30:11', 1, 1),
(50, -1, '', '', '2019-10-14', 5, 12, 'sdfvasdfasd', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-14 14:30:11', '2019-10-14 14:30:11', 1, 1),
(51, -1, '', '', '2019-10-14', 6, 10, '10jhdukdh', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-14 14:37:10', '2019-10-14 14:37:10', 1, 1),
(52, -1, '', '', '2019-10-14', 6, 11, '11OYNEHYUJ', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, 'Ses', 1, '2019-10-15 12:48:30', '2019-10-14 14:37:10', 1, 1),
(53, 1, 'DD  agf', 'CNM', '2019-10-15', 6, 11, 'AWETDSAGFDSE', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-15 05:47:05', '2019-10-15 05:47:05', 1, 1),
(54, 22, '49m231', 'ADS', '2019-10-15', 5, 14, '32466796', '', 1, 1, 2, 2, 1, 2, '401', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-15 14:18:59', '2019-10-15 07:57:22', 1, 1),
(55, 22, '49m231', 'ADS', '2019-10-15', 5, 14, '3246689', '', 1, 1, 1, 2, 1, 2, '501', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-15 08:18:27', '2019-10-15 08:18:27', 1, 1),
(56, 24, 'DC456782', 'DHL', '2019-10-15', 5, 12, '45678621', '', 1, 1, 2, 2, 1, 2, '301', 1, 1, 2, 2, 0, 2, '', 1, '2019-10-15 14:55:09', '2019-10-15 14:55:09', 1, 1),
(57, 23, 'DC456782', 'DHL', '2019-10-15', 5, 14, '456131238', '', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 2, '', 1, '2019-10-16 05:28:58', '2019-10-15 14:56:47', 1, 1),
(58, 24, 'DC456782', 'DHL', '2019-10-15', 5, 14, '754666', '', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 2, '', 1, '2019-10-16 05:37:47', '2019-10-15 15:04:14', 1, 1),
(59, 24, 'DC456782', 'DHL', '2019-10-15', 5, 14, '4566128', '', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-15 15:05:26', '2019-10-15 15:05:26', 1, 1),
(60, 24, 'DC456782', 'DHL', '2019-10-15', 5, 12, '45641813216', '', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-15 15:31:29', '2019-10-15 15:06:14', 1, 1),
(61, 23, 'DC456782', 'DHL', '2019-10-15', 6, 11, '6466545', '', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-15 15:09:08', '2019-10-15 15:09:08', 1, 1),
(62, 1, 'DD  agf', 'CNM', '2019-10-16', 6, 11, 'SER1234567', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 2, '', 1, '2019-10-16 07:11:15', '2019-10-16 07:11:15', 1, 1),
(63, 9, 'STCD1', 'STC1', '2019-10-16', 6, 10, 'SER93442435', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-17 06:17:05', '2019-10-16 07:15:00', 1, 1),
(64, 10, 'STCD2', 'STC2', '2019-10-16', 6, 11, 'ASD12134234', '', 1, 1, 1, 1, 1, 1, '0125', 1, 1, 1, 1, 45, 2, 'no', 1, '2019-10-21 12:57:41', '2019-10-16 08:17:09', 1, 1),
(65, 11, 'ewq', 'adas', '2019-10-16', 6, 11, 'SER23141234', '', 1, 2, 2, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-16 18:18:01', '2019-10-16 18:18:01', 1, 1),
(66, 24, 'DC456782', 'DHL', '2019-10-17', 5, 14, 'Ser00342', '', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-16 20:39:07', '2019-10-16 20:19:19', 1, 1),
(67, 12, 'ewq', 'adas', '2019-10-17', 3, 4, 'SErewt34535342', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-16 20:43:54', '2019-10-16 20:43:05', 1, 1),
(68, 13, 'sdfs', 'sdfsaf', '2019-10-17', 5, 14, '3445476', 'naa', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-17 06:07:34', '2019-10-17 06:07:34', 1, 1),
(69, 13, 'sdfs', 'sdfsaf', '2019-10-17', 6, 11, '454687798', 'NIL', 2, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-17 07:10:28', '2019-10-17 06:09:04', 1, 1),
(70, 13, 'sdfs', 'sdfsaf', '2019-10-17', 5, 14, '125465767', 'NIL', 2, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-17 06:10:05', '2019-10-17 06:10:05', 1, 1),
(71, -1, '', '', '2019-10-17', 5, 14, '34256567', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-17 06:18:33', '2019-10-17 06:18:33', 1, 1),
(72, -1, '', '', '2019-10-17', 5, 14, '568698087', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-17 06:18:33', '2019-10-17 06:18:33', 1, 1),
(73, 27, 'DC1234566', 'DHL', '2019-10-17', 5, 14, '332125466', 'No external Damage', 1, 2, 1, 2, 2, 2, '0', 2, 2, 2, 2, 0, 2, '', 0, '2019-10-17 06:48:28', '2019-10-17 06:48:28', 1, 1),
(74, 27, 'DC1234566', 'DHL', '2019-10-17', 6, 11, '34765879', 'No damage', 1, 2, 1, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-17 06:51:02', '2019-10-17 06:51:02', 1, 1),
(75, 27, 'DC1234566', 'DHL', '2019-10-17', 5, 12, '565657676', 'no damage', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-17 06:52:04', '2019-10-17 06:52:04', 1, 1),
(76, 27, 'DC1234566', 'DHL', '2019-10-17', 6, 10, '577987090', 'case broken', 1, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 2, '', 1, '2019-10-17 06:53:20', '2019-10-17 06:53:20', 1, 1),
(77, 14, 'DC0001333', 'DHL', '2019-10-17', 6, 11, 'Swer12344', 'sfsadfasfdadd', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-17 06:59:06', '2019-10-17 06:59:06', 1, 1),
(78, 10, 'STCD2', 'STC2', '2019-10-17', 5, 14, 'asdfasdfasd', 'asdfsdfsadsa', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-17 07:01:02', '2019-10-17 07:01:02', 1, 1),
(79, 10, 'STCD2', 'STC2', '2019-10-17', 5, 14, 'asdafadf', 'sdsfdsadfasfdas', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-17 07:02:45', '2019-10-17 07:02:45', 1, 1),
(80, -1, '', '', '2019-10-17', 5, 14, '321544656', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-17 07:13:41', '2019-10-17 07:13:41', 1, 1),
(81, -1, '', '', '2019-10-17', 4, 6, 'SEryfsdfs', NULL, -1, -1, -1, -1, -1, -1, NULL, -1, -1, -1, -1, NULL, -1, '', 1, '2019-10-17 07:35:55', '2019-10-17 07:35:55', 1, 1),
(82, 28, 'DC45612336', 'DHL', '2019-10-20', 6, 11, '333456412', 'No physical Damage', 1, 2, 2, 2, 1, 2, '301', 2, 2, 2, 2, 0, 1, '', 1, '2019-10-20 15:13:39', '2019-10-20 14:16:08', 1, 1),
(83, 28, 'DC45612336', 'DHL', '2019-10-20', 6, 10, '324566852', 'Case rusted, Display broken', 1, 2, 1, 2, 1, 2, '301', 1, 2, 2, 2, 0, 2, '', 1, '2019-10-20 15:13:39', '2019-10-20 14:18:21', 1, 1),
(84, 28, 'DC45612336', 'DHL', '2019-10-20', 5, 14, '324566872', 'No physical damage', 1, 2, 1, 2, 1, 2, '401', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-20 15:09:00', '2019-10-20 14:20:16', 1, 1),
(85, 16, 'aswe', 'ased', '2019-10-21', 4, 7, '3245668724', '', 2, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 0, '2019-10-21 13:31:52', '2019-10-21 13:31:52', 1, 1),
(86, 16, 'aswe', 'ased', '2019-10-21', 4, 7, '32456687245', '', 2, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, '', 0, '2019-10-21 13:32:44', '2019-10-21 13:32:44', 1, 1),
(87, 15, 'AS1234', 'FED', '2019-10-21', 4, 8, '3245668723', NULL, 2, 1, 2, 1, 2, 1, '0', 2, 1, 2, 1, 0, 2, 'as', 0, '2019-10-21 14:20:20', '2019-10-21 13:36:23', 1, 1),
(88, 30, 'sdfasdf', 'sdfsaf', '2019-10-21', 6, 11, '32456687233', NULL, 2, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 1, 'awers', 0, '2019-10-21 14:21:51', '2019-10-21 14:21:29', 1, 1),
(89, 29, 'sdfsdf', 'dsdadfas', '2019-10-21', 6, 11, 'Serial No New 2', NULL, 2, 2, 2, 2, 1, 2, '0120', 2, 2, 1, 2, 23, 2, 'Sales New', 1, '2019-10-21 14:48:53', '2019-10-21 14:46:37', 1, 1),
(90, 18, 'DC000023', 'blue dart', '2019-10-21', 5, 12, 'sdfsafsadfsadfas', '', 2, 2, 2, 2, 2, 2, '0', 2, 2, 2, 2, 0, 2, 'sdfsadfsdafsadaf', 0, '2019-10-21 15:16:39', '2019-10-21 15:16:39', 1, 1),
(91, 26, 'Cxsera', 'AWeaq', '2019-10-21', 6, 11, '26SerialNo', '26 Comment', 2, 2, 2, 2, 2, 2, '0505', 2, 2, 2, 2, 26, 2, '26SerialNo', 1, '2019-10-21 15:19:21', '2019-10-21 15:18:28', 1, 1),
(92, 26, 'Cxsera', 'AWeaq', '2019-10-21', 3, 4, '26SerialNo2', '', 1, 2, 1, 2, 1, 2, '0808', 1, 2, 1, 2, 8, 2, '26serialno2', 1, '2019-10-21 15:20:23', '2019-10-21 15:20:23', 1, 1),
(93, 32, 'DC00023', 'DHL', '2019-10-28', 5, 14, '32324123', 'CASE RUSTED.\nTB BROKEN', 1, 1, 1, 2, 1, 1, '0501', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-28 07:24:54', '2019-10-28 07:24:54', 1, 1),
(94, 32, 'DC00023', 'DHL', '2019-10-28', 5, 12, '3242342342', 'NIL', 1, 2, 1, 2, 2, 2, '0', 1, 2, 2, 2, 0, 1, '', 1, '2019-10-28 07:28:16', '2019-10-28 07:28:16', 1, 1);

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

--
-- Dumping data for table `pv_rms_tracking`
--

INSERT INTO `pv_rms_tracking` (`pv_id`, `rack_id`, `rack_type`, `created_by`, `created_at`) VALUES
(31, '', 1, 1, '2019-10-16 14:41:52'),
(22, '', 2, 1, '2019-10-16 14:45:03'),
(123, 'R22', 0, 1, '2019-10-16 15:06:52'),
(123, 'R222', 0, 1, '2019-10-16 15:07:03'),
(22, 'R2345', 2, 1, '2019-10-16 15:07:19'),
(30, '', 1, 1, '2019-10-16 15:48:28'),
(67, '', 2, 1, '2019-10-16 20:50:09'),
(66, '', 2, 1, '2019-10-16 20:54:42'),
(65, '', 2, 1, '2019-10-16 20:55:15'),
(62, '', 2, 1, '2019-10-16 20:56:36'),
(35, '', 1, 1, '2019-10-16 21:14:05'),
(36, '', 1, 1, '2019-10-16 21:14:05'),
(37, '', 1, 1, '2019-10-16 21:15:39'),
(38, '', 1, 1, '2019-10-16 21:15:39'),
(63, '', 2, 1, '2019-10-17 06:24:25'),
(72, '', 1, 1, '2019-10-17 06:32:32'),
(71, '', 1, 1, '2019-10-17 06:33:03'),
(80, '', 2, 1, '2019-10-17 07:18:10'),
(80, 'R12', 2, 1, '2019-10-17 07:24:33'),
(31, 'R23', 1, 1, '2019-10-24 04:49:35'),
(31, 'R27', 1, 1, '2019-10-24 05:17:40'),
(30, 'R21', 1, 1, '2019-10-24 05:18:03'),
(31, 'R55', 1, 1, '2019-10-24 05:18:45'),
(35, 'R12', 1, 1, '2019-10-24 05:41:59'),
(35, 'R35', 1, 1, '2019-10-24 05:47:26'),
(35, 'R37', 1, 1, '2019-10-24 05:52:03'),
(31, 'R77', 1, 1, '2019-10-24 05:54:06'),
(35, 'rr35', 1, 1, '2019-10-24 05:58:30'),
(30, 'R344', 1, 1, '2019-10-24 06:51:44'),
(36, 'R37', 1, 1, '2019-10-24 06:53:02'),
(37, 'R23', 1, 1, '2019-10-24 06:58:14'),
(38, 'R17', 1, 1, '2019-10-24 12:29:02'),
(38, 'R11', 1, 1, '2019-10-24 12:29:32'),
(38, 'R17', 1, 1, '2019-10-24 12:49:07'),
(35, 'R56', 1, 1, '2019-10-24 12:50:54'),
(62, 'R29', 2, 1, '2019-10-24 12:54:51'),
(34, '', 0, 1, '2019-10-31 07:26:17'),
(39, '', 0, 1, '2019-10-31 07:26:17'),
(41, '', 0, 1, '2019-10-31 07:26:17');

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
(1, 14, '2019-10-09 15:55:46', 1),
(2, 14, '2019-10-15 16:29:57', 1),
(10, 5, '2019-10-05 12:54:59', 1),
(12, 14, '2019-10-17 05:40:09', 1),
(13, 5, '2019-10-04 16:23:42', 1),
(16, 14, '2019-10-15 16:28:33', 1),
(17, 9, '2019-10-17 06:43:22', 1),
(18, 7, '2019-10-17 07:55:26', 1),
(19, 7, '2019-10-17 07:55:38', 1),
(20, 10, '2019-10-17 08:05:35', 1),
(21, 5, '2019-10-08 12:22:04', 1),
(22, 3, '2019-10-16 14:45:03', 1),
(23, 15, '2019-10-09 19:59:06', 1),
(24, 15, '2019-10-09 19:59:06', 1),
(25, 14, '2019-10-10 13:43:28', 1),
(26, 3, '2019-10-09 15:22:30', 1),
(27, 6, '2019-10-17 07:50:34', 1),
(28, 5, '2019-10-15 16:00:30', 1),
(29, 2, '2019-10-21 14:41:23', 1),
(30, 6, '2019-10-16 15:51:41', 1),
(31, 5, '2019-10-16 14:46:52', 1),
(32, 15, '2019-10-09 19:26:10', 1),
(33, 15, '2019-10-09 19:26:10', 1),
(34, 10, '2019-10-31 08:13:09', 1),
(35, 5, '2019-10-16 21:17:27', 1),
(36, 5, '2019-10-16 21:17:27', 1),
(37, 6, '2019-10-16 21:56:02', 1),
(38, 5, '2019-10-17 06:28:55', 1),
(39, 8, '2019-10-31 07:51:46', 1),
(40, 10, '2019-10-10 13:41:37', 1),
(41, 4, '2019-10-31 07:26:17', 1),
(42, 15, '2019-10-15 14:30:05', 1),
(43, 13, '2019-10-15 14:18:59', 1),
(44, 15, '2019-10-15 14:30:05', 1),
(45, 15, '2019-10-15 14:30:05', 1),
(46, 13, '2019-10-15 08:14:00', 1),
(47, 13, '2019-10-17 06:31:23', 1),
(48, 13, '2019-10-17 06:31:23', 1),
(49, 13, '2019-10-14 14:30:11', 1),
(50, 13, '2019-10-14 14:30:11', 1),
(51, 13, '2019-10-14 14:37:10', 1),
(52, 13, '2019-10-14 14:37:10', 1),
(53, 13, '2019-10-16 19:43:46', 1),
(54, 13, '2019-10-15 14:18:59', 1),
(55, 13, '2019-10-16 19:39:21', 1),
(56, 13, '2019-10-16 06:27:55', 1),
(57, 13, '2019-10-16 05:28:58', 1),
(58, 15, '2019-10-16 06:23:33', 1),
(59, 13, '2019-10-16 06:27:55', 1),
(60, 13, '2019-10-16 06:27:55', 1),
(61, 13, '2019-10-16 06:27:55', 1),
(62, 3, '2019-10-16 20:56:36', 1),
(63, 3, '2019-10-17 06:24:25', 1),
(64, 2, '2019-10-21 12:57:41', 1),
(65, 3, '2019-10-16 20:55:15', 1),
(66, 3, '2019-10-16 20:54:42', 1),
(67, 3, '2019-10-16 20:50:09', 1),
(68, 15, '2019-10-17 06:12:10', 1),
(69, 13, '2019-10-17 07:10:53', 1),
(70, 15, '2019-10-17 06:12:10', 1),
(71, 8, '2019-10-17 07:59:39', 1),
(72, 11, '2019-10-17 06:44:05', 1),
(73, 1, '2019-10-17 06:48:28', 1),
(74, 13, '2019-10-23 08:09:47', 1),
(75, 13, '2019-10-23 08:10:55', 1),
(76, 13, '2019-10-17 07:10:52', 1),
(77, 13, '2019-10-17 07:10:52', 1),
(78, 2, '2019-10-17 07:01:02', 1),
(79, 2, '2019-10-17 07:02:45', 1),
(80, 3, '2019-10-17 07:18:10', 1),
(81, 13, '2019-10-17 07:35:55', 1),
(82, 13, '2019-10-20 15:18:10', 1),
(83, 13, '2019-10-20 15:18:10', 1),
(84, 13, '2019-10-20 15:18:10', 1),
(85, 1, '2019-10-21 13:31:52', 1),
(86, 1, '2019-10-21 13:32:44', 1),
(87, 1, '2019-10-21 14:20:20', 1),
(88, 1, '2019-10-21 14:21:51', 1),
(89, 15, '2019-10-23 08:28:10', 1),
(90, 1, '2019-10-21 15:16:39', 1),
(91, 13, '2019-10-23 08:04:44', 1),
(92, 2, '2019-10-21 15:20:23', 1),
(93, 2, '2019-10-28 07:24:54', 1),
(94, 2, '2019-10-28 07:28:16', 1);

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
(18, 4, '2019-10-05 03:01:50', 1),
(18, 5, '2019-10-05 11:24:23', 1),
(16, 4, '2019-10-05 11:25:30', 1),
(16, 5, '2019-10-05 11:25:46', 1),
(19, 1, '2019-10-05 11:27:45', 1),
(20, 2, '2019-10-05 11:28:16', 1),
(20, 13, '2019-10-05 11:29:41', 1),
(20, 4, '2019-10-05 11:30:18', 1),
(20, 5, '2019-10-05 11:30:33', 1),
(19, 13, '2019-10-05 11:36:33', 1),
(19, 4, '2019-10-05 11:36:49', 1),
(19, 5, '2019-10-05 11:39:39', 1),
(10, 5, '2019-10-05 12:11:27', 1),
(10, 5, '2019-10-05 12:17:27', 1),
(18, 5, '2019-10-05 12:18:27', 1),
(16, 5, '2019-10-05 12:27:31', 1),
(16, 5, '2019-10-05 12:32:04', 1),
(21, 2, '2019-10-05 12:34:46', 1),
(22, 2, '2019-10-05 12:35:14', 1),
(16, 5, '2019-10-05 12:45:45', 1),
(10, 5, '2019-10-05 12:54:59', 1),
(16, 5, '2019-10-05 12:55:10', 1),
(16, 5, '2019-10-05 12:56:14', 1),
(16, 5, '2019-10-05 12:59:07', 1),
(16, 5, '2019-10-05 13:00:26', 1),
(16, 5, '2019-10-05 13:01:07', 1),
(16, 5, '2019-10-05 13:16:48', 1),
(16, 5, '2019-10-05 13:17:03', 1),
(12, 5, '2019-10-05 13:40:15', 1),
(16, 5, '2019-10-05 13:41:39', 1),
(16, 6, '2019-10-05 13:45:02', 1),
(12, 5, '2019-10-06 04:07:47', 1),
(17, 5, '2019-10-06 04:09:43', 1),
(12, 5, '2019-10-06 04:10:23', 1),
(23, 2, '2019-10-06 04:13:09', 1),
(24, 1, '2019-10-06 04:13:51', 1),
(24, 13, '2019-10-06 04:14:40', 1),
(24, 4, '2019-10-06 04:14:59', 1),
(25, 2, '2019-10-06 04:18:00', 1),
(23, 13, '2019-10-06 04:18:32', 1),
(23, 4, '2019-10-06 04:18:49', 1),
(2, 5, '2019-10-06 04:23:57', 1),
(2, 5, '2019-10-06 04:24:07', 1),
(23, 5, '2019-10-06 04:26:37', 1),
(16, 7, '2019-10-06 04:34:53', 1),
(16, 8, '2019-10-06 04:36:33', 1),
(2, 6, '2019-10-06 04:46:34', 1),
(2, 7, '2019-10-06 06:38:35', 1),
(20, 6, '2019-10-06 07:54:37', 1),
(20, 7, '2019-10-06 07:54:56', 1),
(2, 8, '2019-10-06 07:56:04', 1),
(20, 8, '2019-10-06 07:56:04', 1),
(25, 13, '2019-10-06 08:08:49', 1),
(25, 4, '2019-10-06 08:09:08', 1),
(24, 5, '2019-10-06 08:09:27', 1),
(25, 5, '2019-10-06 08:09:27', 1),
(25, 6, '2019-10-06 08:16:12', 1),
(25, 7, '2019-10-06 08:16:30', 1),
(25, 8, '2019-10-06 08:20:28', 1),
(2, 9, '2019-10-06 08:20:49', 1),
(25, 9, '2019-10-06 08:20:49', 1),
(2, 10, '2019-10-06 08:20:55', 1),
(25, 10, '2019-10-06 08:20:55', 1),
(2, 11, '2019-10-06 11:16:25', 1),
(26, 2, '2019-10-08 07:53:48', 1),
(27, 1, '2019-10-08 08:28:03', 1),
(26, 13, '2019-10-08 09:19:28', 1),
(27, 13, '2019-10-08 09:20:16', 1),
(28, 1, '2019-10-08 09:20:46', 1),
(29, 1, '2019-10-08 09:27:39', 1),
(30, 2, '2019-10-08 09:28:27', 1),
(27, 3, '2019-10-08 09:41:01', 1),
(21, 13, '2019-10-08 09:58:07', 1),
(21, 3, '2019-10-08 09:58:28', 1),
(28, 13, '2019-10-08 10:18:17', 1),
(27, 3, '2019-10-08 11:47:30', 1),
(27, 4, '2019-10-08 11:53:15', 1),
(21, 4, '2019-10-08 11:56:14', 1),
(27, 5, '2019-10-08 12:17:57', 1),
(21, 5, '2019-10-08 12:22:04', 1),
(1, 6, '2019-10-08 12:22:41', 1),
(12, 6, '2019-10-08 12:22:49', 1),
(1, 7, '2019-10-08 12:30:49', 1),
(1, 8, '2019-10-08 12:31:02', 1),
(1, 9, '2019-10-08 12:31:13', 1),
(1, 9, '2019-10-08 12:31:16', 1),
(16, 9, '2019-10-08 12:45:23', 1),
(1, 10, '2019-10-08 12:45:34', 1),
(31, 2, '2019-10-09 11:09:58', 1),
(31, 13, '2019-10-09 11:24:29', 1),
(22, 13, '2019-10-09 12:53:20', 1),
(32, 2, '2019-10-09 13:24:08', 1),
(26, 3, '2019-10-09 15:14:04', 1),
(26, 3, '2019-10-09 15:22:30', 1),
(28, 4, '2019-10-09 15:23:21', 1),
(28, 5, '2019-10-09 15:23:40', 1),
(12, 7, '2019-10-09 15:29:22', 1),
(12, 8, '2019-10-09 15:32:52', 1),
(30, 13, '2019-10-09 15:45:55', 1),
(1, 11, '2019-10-09 15:54:53', 1),
(1, 14, '2019-10-09 15:55:46', 1),
(33, 2, '2019-10-09 18:33:59', 1),
(33, 15, '2019-10-09 19:26:10', 1),
(32, 15, '2019-10-09 19:26:10', 1),
(34, 1, '2019-10-09 19:28:50', 1),
(35, 2, '2019-10-09 19:29:10', 1),
(36, 2, '2019-10-09 19:29:34', 1),
(35, 15, '2019-10-09 19:31:39', 1),
(36, 15, '2019-10-09 19:31:39', 1),
(24, 15, '2019-10-09 19:56:07', 1),
(23, 15, '2019-10-09 19:56:07', 1),
(24, 15, '2019-10-09 19:57:33', 1),
(23, 15, '2019-10-09 19:57:33', 1),
(24, 15, '2019-10-09 19:59:06', 1),
(23, 15, '2019-10-09 19:59:06', 1),
(35, 15, '2019-10-09 20:02:34', 1),
(36, 15, '2019-10-09 20:02:34', 1),
(35, 15, '2019-10-09 20:06:48', 1),
(36, 15, '2019-10-09 20:06:48', 1),
(35, 15, '2019-10-09 20:09:18', 1),
(36, 15, '2019-10-09 20:09:18', 1),
(35, 15, '2019-10-09 20:10:58', 1),
(36, 15, '2019-10-09 20:10:58', 1),
(35, 15, '2019-10-09 20:12:55', 1),
(36, 15, '2019-10-09 20:12:55', 1),
(35, 15, '2019-10-09 20:16:14', 1),
(36, 15, '2019-10-09 20:16:14', 1),
(35, 15, '2019-10-09 20:32:18', 1),
(36, 15, '2019-10-09 20:32:18', 1),
(35, 15, '2019-10-09 20:33:05', 1),
(36, 15, '2019-10-09 20:33:05', 1),
(35, 15, '2019-10-09 20:46:29', 1),
(36, 15, '2019-10-09 20:46:29', 1),
(35, 13, '2019-10-09 21:01:51', 1),
(36, 13, '2019-10-09 21:01:51', 1),
(35, 13, '2019-10-09 21:31:05', 1),
(36, 13, '2019-10-09 21:31:05', 1),
(29, 13, '2019-10-09 21:32:34', 1),
(34, 13, '2019-10-09 21:32:34', 1),
(37, 2, '2019-10-09 21:34:31', 1),
(38, 2, '2019-10-09 21:34:47', 1),
(37, 13, '2019-10-09 21:36:14', 1),
(38, 13, '2019-10-09 21:36:14', 1),
(39, 2, '2019-10-09 21:37:06', 1),
(40, 1, '2019-10-09 21:37:23', 1),
(41, 2, '2019-10-09 21:37:43', 1),
(39, 15, '2019-10-09 21:37:59', 1),
(41, 15, '2019-10-09 21:37:59', 1),
(39, 13, '2019-10-09 21:38:42', 1),
(41, 13, '2019-10-09 21:38:42', 1),
(42, 2, '2019-10-10 05:52:26', 1),
(43, 1, '2019-10-10 07:37:43', 1),
(44, 2, '2019-10-10 11:20:30', 1),
(45, 2, '2019-10-10 11:26:09', 1),
(44, 15, '2019-10-10 12:41:24', 1),
(45, 15, '2019-10-10 12:41:24', 1),
(42, 15, '2019-10-10 12:41:24', 1),
(40, 13, '2019-10-10 13:04:25', 1),
(40, 3, '2019-10-10 13:26:14', 1),
(40, 4, '2019-10-10 13:29:49', 1),
(40, 5, '2019-10-10 13:33:55', 1),
(40, 6, '2019-10-10 13:39:33', 1),
(40, 7, '2019-10-10 13:40:21', 1),
(40, 8, '2019-10-10 13:41:10', 1),
(40, 9, '2019-10-10 13:41:26', 1),
(40, 10, '2019-10-10 13:41:37', 1),
(25, 11, '2019-10-10 13:43:05', 1),
(25, 14, '2019-10-10 13:43:28', 1),
(46, 2, '2019-10-14 14:01:36', 1),
(47, 13, '2019-10-14 14:29:47', 1),
(48, 13, '2019-10-14 14:29:47', 1),
(49, 13, '2019-10-14 14:30:11', 1),
(50, 13, '2019-10-14 14:30:11', 1),
(51, 13, '2019-10-14 14:37:10', 1),
(52, 13, '2019-10-14 14:37:10', 1),
(53, 2, '2019-10-15 05:47:05', 1),
(54, 1, '2019-10-15 07:57:22', 1),
(46, 13, '2019-10-15 08:14:00', 1),
(55, 2, '2019-10-15 08:18:27', 1),
(39, 13, '2019-10-15 10:47:33', 1),
(41, 13, '2019-10-15 10:47:33', 1),
(39, 13, '2019-10-15 10:48:47', 1),
(41, 13, '2019-10-15 10:48:47', 1),
(39, 13, '2019-10-15 10:49:14', 1),
(41, 13, '2019-10-15 10:49:14', 1),
(39, 13, '2019-10-15 10:57:46', 1),
(41, 13, '2019-10-15 10:57:46', 1),
(39, 13, '2019-10-15 11:06:15', 1),
(41, 13, '2019-10-15 11:06:15', 1),
(39, 13, '2019-10-15 11:06:47', 1),
(41, 13, '2019-10-15 11:06:47', 1),
(54, 13, '2019-10-15 14:18:59', 1),
(43, 13, '2019-10-15 14:18:59', 1),
(44, 15, '2019-10-15 14:30:05', 1),
(45, 15, '2019-10-15 14:30:05', 1),
(42, 15, '2019-10-15 14:30:05', 1),
(56, 2, '2019-10-15 14:55:09', 1),
(57, 1, '2019-10-15 14:56:47', 1),
(58, 1, '2019-10-15 15:04:14', 1),
(59, 2, '2019-10-15 15:05:26', 1),
(60, 1, '2019-10-15 15:06:14', 1),
(61, 2, '2019-10-15 15:09:08', 1),
(56, 15, '2019-10-15 15:26:00', 1),
(59, 15, '2019-10-15 15:26:00', 1),
(61, 15, '2019-10-15 15:26:00', 1),
(56, 15, '2019-10-15 15:28:43', 1),
(59, 15, '2019-10-15 15:28:43', 1),
(61, 15, '2019-10-15 15:28:43', 1),
(60, 13, '2019-10-15 15:31:29', 1),
(60, 4, '2019-10-15 15:50:13', 1),
(60, 5, '2019-10-15 15:52:03', 1),
(60, 6, '2019-10-15 15:59:50', 1),
(28, 5, '2019-10-15 16:00:30', 1),
(60, 7, '2019-10-15 16:04:42', 1),
(60, 8, '2019-10-15 16:15:28', 1),
(12, 9, '2019-10-15 16:20:58', 1),
(16, 10, '2019-10-15 16:25:00', 1),
(16, 11, '2019-10-15 16:28:22', 1),
(16, 14, '2019-10-15 16:28:33', 1),
(2, 14, '2019-10-15 16:29:57', 1),
(57, 13, '2019-10-16 05:28:58', 1),
(58, 15, '2019-10-16 05:37:47', 1),
(58, 15, '2019-10-16 06:06:16', 1),
(58, 15, '2019-10-16 06:23:33', 1),
(56, 15, '2019-10-16 06:27:41', 1),
(59, 15, '2019-10-16 06:27:41', 1),
(61, 15, '2019-10-16 06:27:41', 1),
(60, 15, '2019-10-16 06:27:41', 1),
(56, 13, '2019-10-16 06:27:55', 1),
(59, 13, '2019-10-16 06:27:55', 1),
(61, 13, '2019-10-16 06:27:55', 1),
(60, 13, '2019-10-16 06:27:55', 1),
(62, 2, '2019-10-16 07:11:15', 1),
(63, 1, '2019-10-16 07:15:01', 1),
(64, 2, '2019-10-16 08:17:09', 1),
(20, 9, '2019-10-16 13:07:25', 1),
(12, 10, '2019-10-16 13:14:06', 1),
(31, 4, '2019-10-16 14:38:44', 1),
(31, 4, '2019-10-16 14:40:45', 1),
(31, 4, '2019-10-16 14:41:52', 1),
(22, 3, '2019-10-16 14:45:03', 1),
(31, 5, '2019-10-16 14:46:52', 1),
(30, 4, '2019-10-16 15:48:28', 1),
(30, 5, '2019-10-16 15:48:50', 1),
(30, 6, '2019-10-16 15:51:41', 1),
(65, 2, '2019-10-16 18:18:02', 1),
(55, 13, '2019-10-16 19:39:21', 1),
(53, 13, '2019-10-16 19:43:46', 1),
(65, 13, '2019-10-16 19:45:16', 1),
(62, 15, '2019-10-16 19:50:36', 1),
(62, 15, '2019-10-16 19:57:00', 1),
(62, 15, '2019-10-16 20:00:54', 1),
(62, 13, '2019-10-16 20:02:10', 1),
(62, 13, '2019-10-16 20:04:35', 1),
(66, 2, '2019-10-16 20:19:19', 1),
(66, 13, '2019-10-16 20:39:07', 1),
(67, 2, '2019-10-16 20:43:05', 1),
(67, 13, '2019-10-16 20:43:54', 1),
(67, 3, '2019-10-16 20:50:09', 1),
(66, 3, '2019-10-16 20:54:42', 1),
(65, 3, '2019-10-16 20:55:15', 1),
(62, 3, '2019-10-16 20:56:36', 1),
(35, 4, '2019-10-16 21:14:05', 1),
(36, 4, '2019-10-16 21:14:05', 1),
(37, 4, '2019-10-16 21:15:39', 1),
(38, 4, '2019-10-16 21:15:39', 1),
(35, 5, '2019-10-16 21:17:27', 1),
(36, 5, '2019-10-16 21:17:27', 1),
(37, 5, '2019-10-16 21:29:10', 1),
(37, 6, '2019-10-16 21:56:02', 1),
(17, 6, '2019-10-16 22:14:40', 1),
(17, 6, '2019-10-16 22:15:08', 1),
(18, 6, '2019-10-16 22:16:21', 1),
(17, 8, '2019-10-17 05:01:50', 1),
(12, 11, '2019-10-17 05:32:52', 1),
(12, 14, '2019-10-17 05:40:09', 1),
(68, 2, '2019-10-17 06:07:34', 1),
(69, 1, '2019-10-17 06:09:04', 1),
(70, 2, '2019-10-17 06:10:05', 1),
(68, 15, '2019-10-17 06:12:10', 1),
(70, 15, '2019-10-17 06:12:10', 1),
(64, 13, '2019-10-17 06:14:41', 1),
(63, 13, '2019-10-17 06:17:05', 1),
(71, 13, '2019-10-17 06:18:33', 1),
(72, 13, '2019-10-17 06:18:33', 1),
(63, 3, '2019-10-17 06:24:25', 1),
(38, 5, '2019-10-17 06:28:55', 1),
(47, 13, '2019-10-17 06:31:23', 1),
(48, 13, '2019-10-17 06:31:23', 1),
(72, 4, '2019-10-17 06:32:32', 1),
(71, 4, '2019-10-17 06:33:03', 1),
(71, 5, '2019-10-17 06:34:30', 1),
(72, 5, '2019-10-17 06:35:09', 1),
(72, 6, '2019-10-17 06:36:52', 1),
(72, 8, '2019-10-17 06:41:30', 1),
(72, 9, '2019-10-17 06:42:21', 1),
(72, 9, '2019-10-17 06:42:21', 1),
(72, 9, '2019-10-17 06:42:21', 1),
(17, 9, '2019-10-17 06:43:22', 1),
(72, 10, '2019-10-17 06:43:32', 1),
(72, 11, '2019-10-17 06:44:05', 1),
(73, 1, '2019-10-17 06:48:28', 1),
(74, 2, '2019-10-17 06:51:02', 1),
(75, 2, '2019-10-17 06:52:04', 1),
(76, 2, '2019-10-17 06:53:20', 1),
(77, 2, '2019-10-17 06:59:06', 1),
(78, 2, '2019-10-17 07:01:02', 1),
(79, 2, '2019-10-17 07:02:45', 1),
(76, 15, '2019-10-17 07:09:04', 1),
(77, 15, '2019-10-17 07:09:05', 1),
(69, 13, '2019-10-17 07:10:28', 1),
(76, 13, '2019-10-17 07:10:52', 1),
(77, 13, '2019-10-17 07:10:52', 1),
(69, 13, '2019-10-17 07:10:53', 1),
(80, 13, '2019-10-17 07:13:41', 1),
(80, 3, '2019-10-17 07:18:10', 1),
(81, 13, '2019-10-17 07:35:55', 1),
(19, 6, '2019-10-17 07:43:11', 1),
(27, 6, '2019-10-17 07:50:34', 1),
(71, 6, '2019-10-17 07:53:36', 1),
(18, 7, '2019-10-17 07:55:26', 1),
(19, 7, '2019-10-17 07:55:38', 1),
(71, 7, '2019-10-17 07:58:15', 1),
(71, 8, '2019-10-17 07:59:39', 1),
(20, 10, '2019-10-17 08:05:35', 1),
(82, 2, '2019-10-20 14:16:08', 1),
(83, 2, '2019-10-20 14:18:21', 1),
(84, 1, '2019-10-20 14:20:16', 1),
(84, 15, '2019-10-20 15:09:00', 1),
(84, 15, '2019-10-20 15:09:21', 1),
(83, 13, '2019-10-20 15:13:39', 1),
(82, 13, '2019-10-20 15:13:39', 1),
(84, 15, '2019-10-20 15:17:29', 1),
(83, 15, '2019-10-20 15:17:29', 1),
(82, 15, '2019-10-20 15:17:29', 1),
(84, 13, '2019-10-20 15:18:10', 1),
(83, 13, '2019-10-20 15:18:10', 1),
(82, 13, '2019-10-20 15:18:10', 1),
(64, 1, '2019-10-21 12:46:55', 1),
(64, 2, '2019-10-21 12:51:25', 1),
(64, 2, '2019-10-21 12:56:15', 1),
(64, 2, '2019-10-21 12:57:31', 1),
(64, 2, '2019-10-21 12:57:41', 1),
(85, 1, '2019-10-21 13:31:52', 1),
(86, 1, '2019-10-21 13:32:44', 1),
(87, 2, '2019-10-21 13:36:23', 1),
(87, 2, '2019-10-21 14:13:00', 1),
(87, 2, '2019-10-21 14:16:28', 1),
(87, 1, '2019-10-21 14:20:20', 1),
(88, 1, '2019-10-21 14:21:29', 1),
(88, 1, '2019-10-21 14:21:51', 1),
(29, 2, '2019-10-21 14:41:23', 1),
(89, 2, '2019-10-21 14:46:37', 1),
(89, 2, '2019-10-21 14:47:22', 1),
(89, 2, '2019-10-21 14:48:53', 1),
(90, 1, '2019-10-21 15:16:39', 1),
(91, 1, '2019-10-21 15:18:28', 1),
(91, 2, '2019-10-21 15:19:21', 1),
(92, 2, '2019-10-21 15:20:23', 1),
(91, 13, '2019-10-23 08:04:44', 1),
(74, 13, '2019-10-23 08:09:47', 1),
(75, 13, '2019-10-23 08:10:55', 1),
(89, 15, '2019-10-23 08:20:03', 1),
(89, 15, '2019-10-23 08:25:47', 1),
(89, 15, '2019-10-23 08:26:17', 1),
(89, 15, '2019-10-23 08:26:33', 1),
(89, 15, '2019-10-23 08:26:47', 1),
(89, 15, '2019-10-23 08:27:10', 1),
(89, 15, '2019-10-23 08:27:47', 1),
(89, 15, '2019-10-23 08:28:10', 1),
(93, 2, '2019-10-28 07:24:54', 1),
(94, 2, '2019-10-28 07:28:16', 1),
(34, 4, '2019-10-31 07:26:17', 1),
(39, 4, '2019-10-31 07:26:17', 1),
(41, 4, '2019-10-31 07:26:17', 1),
(34, 5, '2019-10-31 07:41:22', 1),
(34, 6, '2019-10-31 07:45:42', 1),
(39, 5, '2019-10-31 07:46:18', 1),
(39, 6, '2019-10-31 07:46:46', 1),
(34, 7, '2019-10-31 07:47:36', 1),
(39, 7, '2019-10-31 07:47:36', 1),
(34, 8, '2019-10-31 07:51:46', 1),
(39, 8, '2019-10-31 07:51:46', 1),
(34, 9, '2019-10-31 08:12:15', 1),
(34, 10, '2019-10-31 08:13:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` bigint(20) NOT NULL,
  `gs_no` varchar(20) DEFAULT NULL,
  `receipt_date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name_old` varchar(100) DEFAULT NULL,
  `end_customer` varchar(35) DEFAULT NULL,
  `site_id` int(11) NOT NULL,
  `courier_name` varchar(35) NOT NULL,
  `docket_details` varchar(35) NOT NULL,
  `total_boxes` int(10) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1.Open, 2.Started, 3.Closed',
  `created_by` tinyint(4) NOT NULL,
  `updated_by` tinyint(4) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `gs_no`, `receipt_date`, `customer_id`, `customer_name_old`, `end_customer`, `site_id`, `courier_name`, `docket_details`, `total_boxes`, `status`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, '4523463465', '2019-10-02', 4, 'ASDD', 'ENDCC', 0, 'CNM', 'DD  agf', 55, 3, 0, 1, '2019-10-16 13:48:52', '2019-10-23 07:27:04'),
(7, '3242354642', '2019-10-02', 4, '23to8y9', 'dio', 0, 'ADS', '49m231', 5, 3, 1, 1, '2019-10-10 13:08:36', '2019-10-23 11:37:14'),
(8, '1243252352', '2019-10-02', 3, 'Arun', 'Sri', 0, 'Fed', 'Docket', 3, 3, 1, 1, '2019-10-10 17:27:18', '2019-10-23 11:37:20'),
(9, '2342135424', '2019-10-01', 8, 'Cus11', 'EndCus1', 0, 'STC1', 'STCD1', 3, 3, 1, 1, '2019-10-16 13:48:52', '2019-10-23 11:37:23'),
(10, '2343245345', '2019-09-30', 8, 'Cus2', 'EndCus2', 0, 'STC2', 'STCD2', 5, 2, 1, 1, '2019-10-17 12:32:45', '2019-10-23 11:37:26'),
(11, NULL, '2019-10-08', 3, 'Sujan', 'EndCus2', 0, 'adas', 'ewq', 1, 2, 1, 1, '2019-10-16 23:48:02', '2019-10-23 07:29:57'),
(12, NULL, '2019-10-08', 3, 'Sujan', 'EndCus2', 0, 'adas', 'ewq', 1, 2, 1, 1, '2019-10-17 02:13:05', '2019-10-23 07:30:01'),
(13, NULL, '2019-10-09', 3, 'Sujan', 'EndCus2', 0, 'sdfsaf', 'sdfs', 12, 3, 1, 1, '2019-10-17 11:40:45', '2019-10-23 07:30:04'),
(14, NULL, '2019-10-09', 8, 'AK Electrical', 'Add New123', 0, 'DHL', 'DC0001333', 2, 2, 1, 1, '2019-10-17 12:29:06', '2019-10-23 07:31:23'),
(15, NULL, '2019-10-09', 4, 'ASDD', 'New End Customer', 0, 'FED', 'AS1234', 123, 2, 1, 1, '2019-10-21 19:06:23', '2019-10-23 07:27:04'),
(16, NULL, '2019-10-09', 9, 'PGCIL', 'EndCus1', 0, 'ased', 'aswe', 15, 2, 1, 1, '2019-10-21 19:02:44', '2019-10-23 07:28:57'),
(17, NULL, '2019-10-09', 9, 'PGCIL', 'Sri', 0, 'New Cour', 'Doc', 234, 3, 1, 1, '2019-10-10 17:27:18', '2019-10-23 07:28:57'),
(18, NULL, '2019-10-10', 8, 'AK Electrical', 'pgcil-tirupura', 0, 'blue dart', 'DC000023', 2, 2, 1, 1, '2019-10-21 20:46:39', '2019-10-23 07:30:19'),
(19, NULL, '2019-10-10', 8, 'AK Electrical', 'PGCIL-HARYANA', 0, 'DHL', 'DC000123', 2, 1, 1, 1, '2019-10-10 16:04:34', '2019-10-23 07:30:21'),
(20, NULL, '2019-10-10', 8, 'AK Electrical', 'PGCIL-HARYANA', 0, 'DHL', 'DC000123', 2, 3, 1, 1, '2019-10-10 17:29:51', '2019-10-23 07:30:23'),
(21, NULL, '2019-10-14', 10, 'Srivari Electricals', 'ENDCC', 0, 'dingdong', 'DC1', 100, 1, 1, 1, '2019-10-15 13:09:31', '2019-10-23 07:30:52'),
(22, NULL, '2019-10-15', 9, 'PGCIL', 'PGCIL-HARYANA', 0, 'ADS', '49m231', 5, 3, 1, 1, '2019-10-15 13:48:43', '2019-10-23 07:28:57'),
(23, NULL, '2019-10-15', 9, 'PGCIL', 'pgcil-tirupura', 0, 'DHL', 'DC456782', 8, 3, 1, 1, '2019-10-15 20:46:47', '2019-10-23 07:28:57'),
(24, NULL, '2019-10-15', 9, 'PGCIL', 'pgcil-tirupura', 0, 'DHL', 'DC456782', 5, 2, 1, 1, '2019-10-17 01:49:19', '2019-10-23 07:28:57'),
(25, NULL, '2019-10-16', 8, 'AK Electrical', 'pgcil-tirupura', 2, 'Aswqed', 'Dwersa', 12, 1, 1, 1, '2019-10-16 23:15:50', '2019-10-23 07:30:27'),
(26, NULL, '2019-10-16', 10, 'Srivari Electricals', 'pgcil-tirupura', 3, 'AWeaq', 'Cxsera', 23, 2, 1, 1, '2019-10-21 20:50:23', '2019-10-23 07:30:58'),
(27, NULL, '2019-10-17', 9, 'PGCIL', 'PGCIL-HARYANA', 4, 'DHL', 'DC1234566', 1, 3, 1, 1, '2019-10-17 12:34:10', '2019-10-23 07:28:57'),
(28, NULL, '2019-10-20', 11, 'APTRANSCO', 'APTRANSCo', 6, 'DHL', 'DC45612336', 2, 3, 1, 1, '2019-10-20 19:55:32', '2019-10-23 07:31:10'),
(29, NULL, '2019-10-21', 8, 'ADFEW', NULL, 4, 'dsdadfas', 'sdfsdf', 2, 2, 1, 1, '2019-10-21 20:16:37', '2019-10-23 11:38:41'),
(30, NULL, '2019-10-21', 4, 'ASDD', NULL, 2, 'sdfsaf', 'sdfasdf', 2, 2, 1, 1, '2019-10-21 19:51:29', '2019-10-23 07:27:04'),
(31, NULL, '2019-10-23', 11, NULL, NULL, 6, 'COU78292', 'AKGLDS', 3, 1, 1, 1, '2019-10-23 13:01:50', '2019-10-23 07:31:50'),
(32, NULL, '2019-10-28', 11, NULL, NULL, 6, 'DHL', 'DC00023', 3, 2, 1, 1, '2019-10-28 12:58:16', '2019-10-28 07:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `rma`
--

CREATE TABLE `rma` (
  `id` bigint(20) NOT NULL,
  `gs_no` varchar(50) DEFAULT NULL,
  `act_reference` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  `customer_address_id` int(11) NOT NULL,
  `end_customer` varchar(25) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1.Open, 2.Saved, 3.Completed',
  `service_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1.Physical, 2.Site Card',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rma`
--

INSERT INTO `rma` (`id`, `gs_no`, `act_reference`, `date`, `customer_address_id`, `end_customer`, `status`, `service_type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'GS001', 'ACT001', '2019-09-26', 7, '', 2, 1, 1, 1, '2019-10-15 14:19:14', '2019-10-15 19:49:14'),
(2, 'GS001', 'ACT001', '2019-09-26', 7, '', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-09-26 09:20:47'),
(3, 'GS001', 'ACT001', '2019-09-26', 7, '', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-09-26 09:21:08'),
(4, 'dfsa', 'dsfas', '2019-09-26', 7, '', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-09-26 12:42:53'),
(5, 'GS003', 'ACT0045', '2019-10-02', 7, 'dio', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 15:28:35'),
(6, 'GS003', 'ACT0045', '2019-10-02', 7, 'dio', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 15:29:53'),
(7, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 16:09:05'),
(8, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 16:09:14'),
(9, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 16:09:35'),
(10, '2342135424', 'ACT004', '2019-10-02', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 16:11:14'),
(11, '2342135424', 'ACT00034', '2019-10-02', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 16:16:27'),
(12, '4523463465', 'AST0045', '2019-10-02', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 16:20:58'),
(13, '4523463465', 'ACT0034', '2019-10-02', 7, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 17:02:58'),
(14, '2342135424', 'ACT432', '2019-10-02', 7, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-02 17:03:51'),
(15, '4523463465', 'ACT00345', '2019-10-03', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-03 07:33:35'),
(16, '4523463465', 'sdsfsdaaf', '2019-10-04', 7, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 14:29:51'),
(17, '4523463465', 'sdfsadf', '2019-10-04', 6, 'dio', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 14:31:05'),
(18, '4523463465', 'sdfsadf', '2019-10-04', 6, 'dio', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 14:35:34'),
(19, '4523463465', 'sdfsdafa', '2019-10-05', 7, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 20:06:01'),
(20, '4523463465', 'sdfsaf', '2019-10-05', 7, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 20:07:25'),
(21, '4523463465', 'sdfsf', '2019-10-05', 6, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 20:11:14'),
(22, '4523463465', 'sdfsf', '2019-10-05', 6, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 20:11:41'),
(23, '4523463465', 'sfsdf', '2019-10-05', 6, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 20:13:12'),
(24, '4523463465', 'fdsdaf', '2019-10-05', 6, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-04 20:22:42'),
(25, '4523463465', 'sdfasf', '2019-10-05', 7, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-05 08:30:47'),
(26, '3242354642', 'sdfsdf', '2019-10-05', 7, 'dio', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-05 16:59:41'),
(27, '4523463465', 'dfdsfad', '2019-10-05', 7, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-05 17:06:33'),
(28, '3242354642', 'sdfsdfasd', '2019-10-06', 6, 'Sri', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-06 09:44:40'),
(29, '3242354642', 'dfsdadfa', '2019-10-06', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-06 09:48:32'),
(30, '3242354642', 'sfdsf', '2019-10-06', 6, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-06 13:38:49'),
(31, '4523463465', 'asdff', '2019-10-08', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 14:42:20'),
(32, '4523463465', 'asdff', '2019-10-08', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 14:46:10'),
(33, '4523463465', 'asdff', '2019-10-08', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 14:48:16'),
(34, '4523463465', 'asdff', '2019-10-08', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 14:49:28'),
(35, '2342135424', 'sdfsf', '2019-10-08', 8, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 14:50:16'),
(36, '4523463465', 'adf', '2019-10-08', 7, 'EndCus2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 15:28:07'),
(37, '4523463465', 'dsd', '2019-10-08', 4, 'EndCus1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-08 15:48:17'),
(38, 'GS-0190739', 'ACT0012', '2019-10-09', 8, 'Add New 1', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-09 16:53:03'),
(39, 'GS-0190739', 'ACT0012', '2019-10-09', 8, 'Add New2', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-09 16:53:21'),
(40, 'GS-0190739', 'ACT0012', '2019-10-09', 8, 'Add New3', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-09 16:54:29'),
(41, '4523463465', '', '2019-10-09', 6, 'Add New123', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-09 18:22:48'),
(42, '4523463465', '', '2019-10-09', 6, 'Add New123', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-09 18:23:20'),
(43, 'gs12656', 'act0001', '2019-10-09', 8, 'Add New', 1, 1, 1, 1, '2019-10-09 18:50:36', '2019-10-09 21:15:55'),
(45, '4523463465', NULL, '2019-10-10', 0, 'EndCus2', 2, 1, 1, 1, '2019-10-10 07:09:35', '2019-10-10 12:39:35'),
(46, '4523463465', '', '2019-10-10', 0, '', 2, 1, 1, 1, '2019-10-09 19:24:20', '2019-10-10 00:54:20'),
(47, '4523463465', '', '2019-10-10', 0, '', 2, 1, 1, 1, '2019-10-09 19:26:10', '2019-10-10 00:56:10'),
(48, '4523463465', NULL, '2019-10-10', 6, 'EndCus2', 1, 1, 1, 1, '2019-10-09 21:31:05', '2019-10-10 03:01:05'),
(49, '4523463465', NULL, '2019-10-10', 7, 'Add New123', 1, 1, 1, 1, '2019-10-09 21:01:51', '2019-10-10 02:31:51'),
(50, 'sdfsf', 'sdfsadf', '2019-10-11', 6, 'EndCus2', 1, 1, 1, 1, '2019-10-09 21:32:33', '2019-10-10 03:02:33'),
(51, 'dfgdsfgsddfgs', 'dfgdfgsdsf', '2019-10-10', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-09 21:36:14', '2019-10-10 03:06:14'),
(52, 'gs edited', 'act edited', '2019-10-10', 9, 'pgcil-tirupura', 1, 1, 1, 1, '2019-10-15 11:06:47', '2019-10-15 16:36:47'),
(53, 'GS0111334', 'ACT001', '2019-10-10', 8, '', 2, 1, 1, 1, '2019-10-15 14:30:05', '2019-10-15 20:00:05'),
(54, '54364765677', 'cae123', '2019-10-10', 8, 'EndCus1', 1, 1, 1, 1, '2019-10-10 13:04:25', '2019-10-10 18:34:25'),
(55, 'gs00112', 'ACT112334', '2019-10-14', 9, 'PGCIL-HARYANA', 3, 2, 1, 1, '2019-10-17 06:31:23', '2019-10-17 12:01:23'),
(56, '', '', '2019-10-14', 9, 'PGCIL-HARYANA', 3, 2, 1, 1, '2019-10-14 14:30:11', '2019-10-14 20:00:11'),
(57, '', '', '2019-10-14', 8, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-14 14:37:10', '2019-10-14 20:07:10'),
(58, '123412342134', '', '2019-10-15', 7, 'PGCIL-HARYANA', 1, 1, 1, 1, '2019-10-15 08:09:56', '2019-10-15 13:39:56'),
(59, '123124134', '', '2019-10-15', 6, 'Add New123', 1, 1, 1, 1, '2019-10-15 08:14:00', '2019-10-15 13:44:00'),
(60, 'GS0012354', 'ACT0045', '2019-10-15', 6, 'dio', 1, 1, 1, 1, '2019-10-16 06:27:55', '2019-10-16 11:57:55'),
(61, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:29', '2019-10-15 21:12:29'),
(62, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:37', '2019-10-15 21:12:37'),
(63, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:38', '2019-10-15 21:12:38'),
(64, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:39', '2019-10-15 21:12:39'),
(65, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:39', '2019-10-15 21:12:39'),
(66, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:40', '2019-10-15 21:12:40'),
(67, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:40', '2019-10-15 21:12:40'),
(68, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:41', '2019-10-15 21:12:41'),
(69, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:41', '2019-10-15 21:12:41'),
(70, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:41', '2019-10-15 21:12:41'),
(71, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:41', '2019-10-15 21:12:41'),
(72, 'GS10002', 'ACT0045', '2019-10-15', 10, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-15 15:42:43', '2019-10-15 21:12:43'),
(73, '12321125453', '', '2019-10-16', 8, 'Sri', 1, 1, 1, 1, '2019-10-16 05:28:58', '2019-10-16 10:58:58'),
(74, '1234', '5678', '2019-10-16', 8, 'Sri', 2, 1, 1, 1, '2019-10-16 06:23:33', '2019-10-16 11:53:33'),
(75, '123214234', '', '2019-10-17', 6, 'EndCus1', 1, 1, 1, 1, '2019-10-16 19:39:21', '2019-10-17 01:09:21'),
(76, '1234234', '', '2019-10-17', 6, 'Add New123', 1, 1, 1, 1, '2019-10-16 19:43:46', '2019-10-17 01:13:46'),
(77, '213421423', '', '2019-10-17', 6, 'EndCus2', 3, 1, 1, 1, '2019-10-16 19:45:15', '2019-10-17 01:15:15'),
(78, NULL, NULL, '2019-10-17', 3, 'pgcil-tirupura', 2, 1, 1, 1, '2019-10-20 15:02:54', '2019-10-20 20:32:54'),
(79, '123234', NULL, '2019-10-17', 9, 'Add New123', 3, 1, 1, 1, '2019-10-16 20:04:35', '2019-10-17 01:34:35'),
(80, 'GS123445', 'ACT098756', '2019-10-17', 10, 'pgcil-tirupura', 3, 1, 1, 1, '2019-10-17 06:16:22', '2019-10-17 11:46:22'),
(81, 'gs1234', 'act0213', '2019-10-17', 9, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-17 06:18:33', '2019-10-17 11:48:33'),
(82, 'GS0001', 'ACT1111', '2019-10-17', 8, 'pgcil-tirupura', 3, 1, 1, 1, '2019-10-17 07:10:52', '2019-10-17 12:40:52'),
(83, 'GS0002', 'ACt002', '2019-10-17', 8, 'pgcil-tirupura', 3, 2, 1, 1, '2019-10-17 07:13:41', '2019-10-17 12:43:41'),
(84, 'sfgsdfgdsf', '', '2019-10-17', 7, 'Add New123', 3, 2, 1, 1, '2019-10-17 07:35:55', '2019-10-17 13:05:55'),
(85, 'gs0012335', 'act0012', '2019-10-20', 11, 'APTRANSCo', 3, 1, 1, 1, '2019-10-20 14:57:23', '2019-10-20 20:27:23'),
(86, '', '', '2019-10-20', 11, 'APTRANSCo', 2, 1, 1, 1, '2019-10-20 15:04:10', '2019-10-20 20:34:10'),
(87, '', '', '2019-10-20', 11, 'APTRANSCo', 2, 1, 1, 1, '2019-10-20 15:05:31', '2019-10-20 20:35:31'),
(88, 'GS123334', 'ACT 4566', '2019-10-20', 11, 'APTRANSCo', 2, 1, 1, 1, '2019-10-20 15:05:55', '2019-10-20 20:35:55'),
(89, 'GS123334', 'ACT 4566', '2019-10-20', 11, 'APTRANSCo', 2, 1, 1, 1, '2019-10-20 15:17:17', '2019-10-20 20:47:17'),
(90, 'GS123334', 'ACT 4566', '2019-10-20', 11, 'APTRANSCo', 3, 1, 1, 1, '2019-10-20 15:18:10', '2019-10-20 20:48:10'),
(91, '324241234123', '3421421342221', '2019-10-23', 10, 'PGCIL-HARYANA', 3, 1, 1, 1, '2019-10-23 08:04:44', '2019-10-23 13:34:44'),
(92, '234214123', '1342141241', '2019-10-23', 9, 'pgcil-tirupura', 3, 1, 1, 1, '2019-10-23 08:09:47', '2019-10-23 13:39:47'),
(93, '23123431234', '24321432134213', '2019-10-23', 9, 'PGCIL-HARYANA', 3, 1, 1, 1, '2019-10-23 08:10:55', '2019-10-23 13:40:55'),
(94, 'Save GS 1', 'Save ACT 1', '2019-10-23', 7, 'pgcil-tirupura', 2, 1, 1, 1, '2019-10-23 08:28:10', '2019-10-23 13:58:10');

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
(24, 25, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-05 03:00:47', '2019-10-05 08:30:47'),
(25, 26, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-05 11:29:41', '2019-10-05 16:59:41'),
(26, 27, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-05 11:36:33', '2019-10-05 17:06:33'),
(27, 28, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-06 04:14:40', '2019-10-06 09:44:40'),
(28, 29, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-06 04:18:32', '2019-10-06 09:48:32'),
(29, 30, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-06 08:08:49', '2019-10-06 13:38:49'),
(30, 31, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-08 09:12:20', '2019-10-08 14:42:20'),
(31, 32, 'sdfsf', 'sdfs', '2342453', 'asda@fds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-08 09:16:10', '2019-10-08 14:46:10'),
(32, 33, 'sdfsf', 'sdfs', '2342453', 'asda@fds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-08 09:18:16', '2019-10-08 14:48:16'),
(33, 34, 'sdfsf', 'sdfs', '2342453', 'asda@fds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-08 09:19:28', '2019-10-08 14:49:28'),
(34, 35, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-08 09:20:16', '2019-10-08 14:50:16'),
(35, 36, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-08 09:58:07', '2019-10-08 15:28:07'),
(36, 37, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-08 10:18:17', '2019-10-08 15:48:17'),
(37, 38, 'PGCIL,\n 11KV Substation ,Ambala \nHaryana - 133001', 'ARJUN', '984256789', 'arjunkumar@pgcil.co.in', '18AABCT3518Q1ZR', 1, 1, '2019-10-09 11:23:03', '2019-10-09 16:53:03'),
(38, 39, 'PGCIL,\n 11KV Substation ,Ambala \nHaryana - 133001', 'ARJUN', '984256789', 'arjunkumar@pgcil.co.in', '18AABCT3518Q1ZR', 1, 1, '2019-10-09 11:23:22', '2019-10-09 16:53:22'),
(39, 40, 'PGCIL,\n 11KV Substation ,Ambala \nHaryana - 133001', 'ARJUN', '984256789', 'arjunkumar@pgcil.co.in', '18AABCT3518Q1ZR', 1, 1, '2019-10-09 11:24:29', '2019-10-09 16:54:29'),
(40, 41, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-09 12:52:48', '2019-10-09 18:22:48'),
(41, 42, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-09 12:53:20', '2019-10-09 18:23:20'),
(42, 43, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-09 15:45:55', '2019-10-09 21:15:55'),
(43, 49, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-09 21:01:51', '2019-10-10 02:31:51'),
(44, 48, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-09 21:31:05', '2019-10-10 03:01:05'),
(45, 50, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-09 21:32:33', '2019-10-10 03:02:33'),
(46, 51, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-09 21:36:14', '2019-10-10 03:06:14'),
(47, 52, 'Chennai edited', 'Arun edite', '123456789000', 'arun@ds.come', '35AABCS1429B1ZE', 1, 1, '2019-10-15 11:06:47', '2019-10-15 16:36:47'),
(48, 54, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-10 13:04:25', '2019-10-10 18:34:25'),
(49, 55, 'NO.3,GB ROAD,MUMBAI-700085', 'SUNIL', '9024442442', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', 1, 1, '2019-10-17 06:31:23', '2019-10-17 12:01:23'),
(50, 56, 'NO.3,GB ROAD,MUMBAI-700085', 'SUNIL', '9024442442', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', 1, 1, '2019-10-14 14:30:11', '2019-10-14 20:00:11'),
(51, 57, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-14 14:37:10', '2019-10-14 20:07:10'),
(52, 59, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-15 08:14:00', '2019-10-15 13:44:00'),
(53, 73, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-16 05:28:58', '2019-10-16 10:58:58'),
(54, 74, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-16 06:23:33', '2019-10-16 11:53:33'),
(55, 60, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-16 06:27:55', '2019-10-16 11:57:55'),
(56, 75, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-16 19:39:21', '2019-10-17 01:09:21'),
(57, 76, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-16 19:43:46', '2019-10-17 01:13:46'),
(58, 77, 'Chennai', 'Arun', '1234567890', 'arun@ds.com', '35AABCS1429B1ZX', 1, 1, '2019-10-16 19:45:16', '2019-10-17 01:15:16'),
(59, 79, 'NO.3,GB ROAD,MUMBAI-700085', 'SUNIL', '9024442442', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', 1, 1, '2019-10-16 20:04:35', '2019-10-17 01:34:35'),
(60, 80, 'Chennai', 'Sujan', '1234567890', 'sujan@gmail.com', 'QWERTYUIO', 1, 1, '2019-10-17 06:12:10', '2019-10-17 11:42:10'),
(61, 81, 'NO.3,GB ROAD,MUMBAI-700085', 'SUNIL', '9024442442', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', 1, 1, '2019-10-17 06:18:33', '2019-10-17 11:48:33'),
(62, 82, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-17 07:10:52', '2019-10-17 12:40:52'),
(63, 83, 'No.1 , MG Road, \nKolkata -500045', 'SUMAN', '7401262829', 'admin@akelectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-17 07:13:41', '2019-10-17 12:43:41'),
(64, 84, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-17 07:35:55', '2019-10-17 13:05:55'),
(65, 78, 'Chennai', 'Sujan', '1234567890', 'sujan@gmail.com', 'QWERTYUIO', 1, 1, '2019-10-20 15:02:54', '2019-10-20 20:32:54'),
(66, 90, 'Vidyut Soudha,\nGunadala,Eluru Rd,\nVijayawada, Andhra Pradesh 520004', 'praveen kumar', '87845613366', 'praveenkumar@aptransco.co.in', '29AADCC9174H1ZA', 1, 1, '2019-10-20 15:18:10', '2019-10-20 20:48:10'),
(67, 89, '', '', '', '', '', 1, 1, '2019-10-20 15:17:04', '2019-10-20 20:47:04'),
(68, 91, 'No,1 Anna Salai, Guindy,\nChennai -600075', 'GUNA', '7810456794', 'guna.s@srivarielectricals.com', '18AABCT3518Q1ZV', 1, 1, '2019-10-23 08:04:44', '2019-10-23 13:34:44'),
(69, 92, 'NO.3,GB ROAD,MUMBAI-700085', 'SUNIL', '9024442442', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', 1, 1, '2019-10-23 08:09:47', '2019-10-23 13:39:47'),
(70, 93, 'NO.3,GB ROAD,MUMBAI-700085', 'SUNIL', '9024442442', 'sunilkumar.k@pgcil.co.in', '27AABCT3518Q1ZV', 1, 1, '2019-10-23 08:10:55', '2019-10-23 13:40:55'),
(71, 94, 'Chennai', 'Sujan', '1234567', 'ds@da.co', '35AABCS1429B1ZX', 1, 1, '2019-10-23 08:28:10', '2019-10-23 13:58:10');

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
(32, 25, 18, 's', 1, 0, 'sdfads', NULL, 0, 0, 0, 'dsfsa', 1, 1, '2019-10-05 03:00:47', '2019-10-05 08:30:47'),
(33, 26, 20, 'sdfs', 1, 0, 'sdfdsdf', NULL, 0, 0, 0, 'sdfads', 1, 1, '2019-10-05 11:29:41', '2019-10-05 16:59:41'),
(34, 27, 19, 'sdfs', 2, 1, 'dfsdaf', NULL, 0, 0, 0, 'sdfsdaf', 1, 1, '2019-10-05 11:36:33', '2019-10-05 17:06:33'),
(35, 28, 24, NULL, 1, 1, NULL, NULL, 1, 1, 1, NULL, 1, 1, '2019-10-09 19:59:06', '2019-10-10 01:29:06'),
(36, 29, 23, NULL, 1, 0, NULL, NULL, 0, 0, 0, NULL, 1, 1, '2019-10-09 19:59:06', '2019-10-10 01:29:06'),
(37, 30, 25, 'sdf', 1, 0, 'xcvvzv', NULL, 0, 0, 0, 'vzx', 1, 1, '2019-10-06 08:08:49', '2019-10-06 13:38:49'),
(38, 34, 26, 'sd', 1, 0, '', 'sdfsdalkfhsdalfh;okljsjdhfoisdahfpiosadhfioashd', 0, 0, 0, '', 1, 1, '2019-10-08 09:19:28', '2019-10-08 14:49:28'),
(39, 35, 27, 'sd', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-08 09:20:16', '2019-10-08 14:50:16'),
(40, 36, 21, 'sd', 1, 0, '', 'sdfsadfds', 0, 0, 0, '', 1, 1, '2019-10-08 09:58:07', '2019-10-08 15:28:07'),
(41, 37, 28, 'sd', 1, 1, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-08 10:18:17', '2019-10-08 15:48:17'),
(42, 40, 31, '610_A', 1, 1, 'KEYPAD ISSUE', NULL, 0, 0, 0, 'nil', 1, 1, '2019-10-09 11:24:29', '2019-10-09 16:54:29'),
(43, 42, 22, NULL, 1, 1, '', 'sdfasdf', 1, 0, 0, '', 1, 1, '2019-10-09 12:53:20', '2019-10-09 18:23:20'),
(44, 43, 30, NULL, 1, 1, 'na', NULL, 1, 1, 1, '5', 1, 1, '2019-10-09 15:45:55', '2019-10-09 21:15:55'),
(45, 47, 33, NULL, 1, -1, '', NULL, -1, -1, -1, '', 1, 1, '2019-10-09 19:26:10', '2019-10-10 00:56:10'),
(46, 47, 32, NULL, 1, -1, '', NULL, -1, -1, -1, '', 1, 1, '2019-10-09 19:26:10', '2019-10-10 00:56:10'),
(47, 48, 35, NULL, 1, 0, NULL, 'sdfsdfsad', 0, 0, 0, NULL, 1, 1, '2019-10-09 21:31:05', '2019-10-10 03:01:05'),
(48, 48, 36, NULL, 1, 0, NULL, 'cvbcvbcv', 0, 0, 0, NULL, 1, 1, '2019-10-09 21:31:05', '2019-10-10 03:01:05'),
(49, 49, 35, NULL, 1, 0, NULL, '', 0, 0, 0, NULL, 1, 1, '2019-10-09 21:01:51', '2019-10-10 02:31:51'),
(50, 49, 36, NULL, 1, 0, NULL, '', 0, 0, 0, NULL, 1, 1, '2019-10-09 21:01:51', '2019-10-10 02:31:51'),
(51, 50, 29, 'dsfsd', 1, 1, '', '', 1, 1, 1, '', 1, 1, '2019-10-09 21:32:33', '2019-10-10 03:02:33'),
(52, 50, 34, NULL, 1, 1, '', '', 0, 0, 0, '', 1, 1, '2019-10-09 21:32:34', '2019-10-10 03:02:34'),
(53, 51, 37, NULL, 1, 1, 'Natural Faullt', '', 1, 1, 1, '', 1, 1, '2019-10-16 21:51:03', '2019-10-10 03:06:14'),
(54, 51, 38, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-09 21:36:14', '2019-10-10 03:06:14'),
(55, 52, 39, 'sw edited', 1, 0, 'desc edited', 'sales edited', 0, 0, 0, 'how long edited', 1, 1, '2019-10-15 11:06:47', '2019-10-15 16:36:47'),
(56, 52, 41, 'sw edited', 1, 0, 'desc edited', 'sales edited', 0, 0, 0, 'how long edited', 1, 1, '2019-10-15 11:06:47', '2019-10-15 16:36:47'),
(57, 53, 44, '52_A', 1, 0, 'Display fault', '', 0, 0, 0, 'NA', 1, 1, '2019-10-15 14:30:05', '2019-10-15 20:00:05'),
(58, 53, 45, NULL, 1, -1, NULL, '', -1, -1, -1, NULL, 1, 1, '2019-10-15 14:30:05', '2019-10-15 20:00:05'),
(59, 53, 42, NULL, 1, -1, NULL, '', -1, -1, -1, NULL, 1, 1, '2019-10-15 14:30:05', '2019-10-15 20:00:05'),
(60, 54, 40, '12', 1, 1, '', '', 0, 0, 0, 'hgcgfhg', 1, 1, '2019-10-10 13:04:25', '2019-10-10 18:34:25'),
(61, 55, 47, NULL, 2, 0, 'NIL', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-17 06:31:23', '2019-10-17 12:01:23'),
(62, 55, 48, NULL, 2, 0, 'NIL', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-17 06:31:23', '2019-10-17 12:01:23'),
(63, 56, 49, NULL, 2, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-14 14:30:11', '2019-10-14 20:00:11'),
(64, 56, 50, NULL, 2, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-14 14:30:11', '2019-10-14 20:00:11'),
(65, 57, 51, NULL, 2, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-14 14:37:10', '2019-10-14 20:07:10'),
(66, 57, 52, NULL, 2, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-14 14:37:10', '2019-10-14 20:07:10'),
(67, 59, 46, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-15 08:14:00', '2019-10-15 13:44:00'),
(68, 8, 54, '', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-15 14:18:59', '2019-10-15 19:48:59'),
(69, 8, 43, '', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-15 14:18:59', '2019-10-15 19:48:59'),
(70, 60, 56, '52_A', 1, 1, 'Keypad not working', NULL, 0, 0, 0, 'NA', 1, 1, '2019-10-16 06:27:55', '2019-10-16 11:57:55'),
(71, 60, 59, NULL, 1, 0, 'Display LED failure', NULL, 0, 1, 1, '2 days', 1, 1, '2019-10-16 06:27:55', '2019-10-16 11:57:55'),
(72, 60, 61, '61_A', 1, 0, 'NIC failure', NULL, 1, 0, 0, NULL, 1, 1, '2019-10-16 06:27:55', '2019-10-16 11:57:55'),
(73, 60, 60, NULL, 1, 0, NULL, NULL, 0, 0, 0, NULL, 1, 1, '2019-10-16 06:27:55', '2019-10-16 11:57:55'),
(74, 73, 57, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-16 05:28:58', '2019-10-16 10:58:58'),
(75, 74, 58, 'sw save', 1, 0, 'desc save', 'sales save', 0, 0, 0, 'how long save', 1, 1, '2019-10-16 06:23:33', '2019-10-16 11:53:33'),
(76, 75, 55, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-16 19:39:21', '2019-10-17 01:09:21'),
(77, 76, 53, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-16 19:43:46', '2019-10-17 01:13:46'),
(78, 77, 65, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-16 19:45:16', '2019-10-17 01:15:16'),
(79, 79, 62, NULL, 1, 0, NULL, NULL, 0, 0, 0, NULL, 1, 1, '2019-10-16 20:04:35', '2019-10-17 01:34:35'),
(80, 79, 66, '', 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type', NULL, 0, 0, 0, 'ADsafas', 1, 1, '2019-10-16 20:39:07', '2019-10-17 02:09:07'),
(81, 79, 67, '', 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', NULL, 0, 0, 0, '', 1, 1, '2019-10-16 20:43:54', '2019-10-17 02:13:54'),
(82, 80, 68, NULL, 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-17 06:12:10', '2019-10-17 11:42:10'),
(83, 80, 70, NULL, 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-17 06:12:10', '2019-10-17 11:42:10'),
(84, 80, 64, '', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-17 06:14:41', '2019-10-17 11:44:41'),
(85, 80, 63, '', 1, 0, '', NULL, 0, 0, 0, '', 1, 1, '2019-10-17 06:17:05', '2019-10-17 11:47:05'),
(86, 81, 71, '69J', 2, 0, 'NIL', '', 0, 0, 0, '', 1, 1, '2019-10-17 06:18:33', '2019-10-17 11:48:33'),
(87, 81, 72, '52_J', 2, 0, 'NIL', '', 0, 0, 0, '', 1, 1, '2019-10-17 06:18:33', '2019-10-17 11:48:33'),
(88, 82, 76, 'NA', 1, 0, 'not power on.', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-17 07:10:52', '2019-10-17 12:40:52'),
(89, 82, 77, 'NA', 1, 0, 'Display light power off.', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-17 07:10:52', '2019-10-17 12:40:52'),
(90, 82, 69, '61_A', 1, 0, 'Display broken', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-17 07:10:52', '2019-10-17 12:40:52'),
(91, 83, 80, '52_K', 2, 0, 'Relay card burnt', '', 1, 1, 1, '', 1, 1, '2019-10-17 07:13:41', '2019-10-17 12:43:41'),
(92, 84, 81, 'sfdsdfgd', 2, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-17 07:35:55', '2019-10-17 13:05:55'),
(93, 90, 84, '52_J', 1, 0, 'error code 4556', '52_J', 0, 0, 0, NULL, 1, 1, '2019-10-20 15:18:10', '2019-10-20 20:48:10'),
(94, 90, 83, NULL, 1, 0, 'display LED fault', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-20 15:18:10', '2019-10-20 20:48:10'),
(95, 90, 82, NULL, 1, 0, 'Error code X4555655', NULL, 0, 0, 0, NULL, 1, 1, '2019-10-20 15:18:10', '2019-10-20 20:48:10'),
(96, 91, 91, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-23 08:04:44', '2019-10-23 13:34:44'),
(97, 92, 74, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-23 08:09:47', '2019-10-23 13:39:47'),
(98, 93, 75, NULL, 1, 0, '', '', 0, 0, 0, '', 1, 1, '2019-10-23 08:10:55', '2019-10-23 13:40:55'),
(99, 94, 89, 'save 1', 1, 0, 'save 1', 'Sales New', 0, 0, 0, 'save 1', 1, 1, '2019-10-23 08:28:10', '2019-10-23 13:58:10');

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

--
-- Dumping data for table `rms`
--

INSERT INTO `rms` (`pv_id`, `rack_id`, `rack_type`, `moved_date`, `updated_at`, `created_at`, `updated_by`, `created_by`) VALUES
(1, 'R23', 0, '2019-10-07', '2019-10-07 14:20:21', '2019-10-07 14:20:21', 1, 1),
(11, 'R28', 0, '2019-10-10', '2019-10-10 09:34:59', '2019-10-07 14:18:35', 1, 1),
(22, 'R2345', 2, '2019-10-16', '2019-10-16 15:07:19', '2019-10-16 14:45:03', 1, 1),
(30, 'R344', 1, '2019-10-24', '2019-10-24 06:51:44', '2019-10-16 15:48:28', 1, 1),
(31, 'R77', 1, '2019-10-24', '2019-10-24 05:54:06', '2019-10-16 14:41:52', 1, 1),
(34, '', 0, '2019-10-31', '2019-10-31 07:26:17', '2019-10-31 07:26:17', 1, 1),
(35, 'R56', 1, '2019-10-24', '2019-10-24 12:50:54', '2019-10-16 21:14:05', 1, 1),
(36, 'R37', 1, '2019-10-24', '2019-10-24 06:53:02', '2019-10-16 21:14:05', 1, 1),
(37, 'R23', 1, '2019-10-24', '2019-10-24 06:58:14', '2019-10-16 21:15:39', 1, 1),
(38, 'R17', 1, '2019-10-24', '2019-10-24 12:49:07', '2019-10-16 21:15:39', 1, 1),
(39, '', 0, '2019-10-31', '2019-10-31 07:26:17', '2019-10-31 07:26:17', 1, 1),
(41, '', 0, '2019-10-31', '2019-10-31 07:26:17', '2019-10-31 07:26:17', 1, 1),
(62, 'R29', 2, '2019-10-24', '2019-10-24 12:54:51', '2019-10-16 20:56:36', 1, 1),
(63, '', 2, '2019-10-17', '2019-10-17 06:24:25', '2019-10-17 06:24:25', 1, 1),
(65, '', 2, '2019-10-17', '2019-10-16 20:55:15', '2019-10-16 20:55:15', 1, 1),
(66, '', 2, '2019-10-17', '2019-10-16 20:54:42', '2019-10-16 20:54:42', 1, 1),
(67, '', 2, '2019-10-17', '2019-10-16 20:50:09', '2019-10-16 20:50:09', 1, 1),
(71, '', 1, '2019-10-17', '2019-10-17 06:33:03', '2019-10-17 06:33:03', 1, 1),
(72, '', 1, '2019-10-17', '2019-10-17 06:32:32', '2019-10-17 06:32:32', 1, 1),
(80, 'R12', 2, '2019-10-17', '2019-10-17 07:24:33', '2019-10-17 07:18:10', 1, 1),
(112, 'R24', 0, '2019-10-07', '2019-10-07 14:20:05', '2019-10-07 14:20:05', 1, 1),
(123, 'R222', 0, '2019-10-16', '2019-10-16 15:07:03', '2019-10-08 00:54:09', 1, 1);

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

--
-- Dumping data for table `verification_completion`
--

INSERT INTO `verification_completion` (`pv_id`, `clio_test`, `rtd_test`, `nic_test`, `received_with_screws`, `received_with_terminal`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, '2019-10-09 15:54:53', '2019-10-09 21:24:53'),
(2, 0, 0, 0, 0, 0, 1, 1, '2019-10-06 11:16:25', '2019-10-06 16:46:25'),
(12, 0, 0, 0, 0, 0, 1, 1, '2019-10-17 05:32:52', '2019-10-17 11:02:52'),
(16, 0, 0, 0, 0, 0, 1, 1, '2019-10-15 16:28:22', '2019-10-15 21:58:22'),
(25, 0, 0, 0, 0, 0, 1, 1, '2019-10-10 13:43:05', '2019-10-10 19:13:05'),
(72, 0, 0, 0, 0, 0, 1, 1, '2019-10-17 06:44:05', '2019-10-17 12:14:05');

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
-- Dumping data for table `warranty`
--

INSERT INTO `warranty` (`id`, `pv_id`, `smp`, `pcp`, `type`, `move`, `rca`, `comment`, `mail_to`, `cc`, `message`, `po`, `wbs`, `updated_at`, `updated_by`, `created_at`, `created_by`) VALUES
(43, 2, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 08:45:23', 1, '2019-10-04 08:45:23', 1),
(44, 1, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 12:56:55', 1, '2019-10-04 12:56:55', 1),
(45, 17, 2, 2, 1, 2, 0, '', NULL, NULL, NULL, '', '', '2019-10-04 14:30:31', 1, '2019-10-04 14:30:31', 1),
(48, 18, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-05 03:01:50', 1, '2019-10-05 03:01:50', 1),
(49, 16, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-05 11:25:30', 1, '2019-10-05 11:25:30', 1),
(50, 20, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-05 11:30:18', 1, '2019-10-05 11:30:18', 1),
(51, 19, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-05 11:36:49', 1, '2019-10-05 11:36:48', 1),
(52, 24, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-06 04:14:59', 1, '2019-10-06 04:14:59', 1),
(53, 23, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-06 04:18:49', 1, '2019-10-06 04:18:49', 1),
(54, 25, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-06 08:09:08', 1, '2019-10-06 08:09:08', 1),
(55, 27, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, NULL, NULL, '2019-10-08 11:53:15', 1, '2019-10-08 09:41:01', 1),
(56, 21, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, NULL, NULL, '2019-10-08 11:56:14', 1, '2019-10-08 09:58:28', 1),
(57, 26, 2, 2, 1, 2, 0, '', NULL, NULL, NULL, NULL, NULL, '2019-10-09 15:22:30', 1, '2019-10-09 15:14:04', 1),
(58, 28, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-09 15:23:21', 1, '2019-10-09 15:23:21', 1),
(59, 40, 1, 1, 1, 1, 0, '', NULL, NULL, NULL, 'NIL', NULL, '2019-10-10 13:29:49', 1, '2019-10-10 13:26:14', 1),
(60, 60, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-15 15:50:13', 1, '2019-10-15 15:50:13', 1),
(65, 31, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-16 14:41:52', 1, '2019-10-16 14:41:52', 1),
(66, 22, 2, 2, 1, 2, 0, '', NULL, NULL, NULL, '', '', '2019-10-16 14:45:03', 1, '2019-10-16 14:45:03', 1),
(67, 30, 2, 2, 1, 1, 0, '', NULL, NULL, NULL, '', '', '2019-10-16 15:48:28', 1, '2019-10-16 15:48:28', 1),
(68, 67, 2, 2, 1, 2, 0, '', NULL, NULL, NULL, '', '', '2019-10-16 20:50:09', 1, '2019-10-16 20:50:09', 1),
(69, 66, 2, 2, 1, 2, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of', NULL, NULL, NULL, '', '', '2019-10-16 20:54:42', 1, '2019-10-16 20:54:42', 1),
(70, 65, 2, 2, 1, 2, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of', NULL, NULL, NULL, '', '', '2019-10-16 20:55:15', 1, '2019-10-16 20:55:15', 1),
(71, 62, 2, 2, 1, 2, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of', NULL, NULL, NULL, '', '', '2019-10-16 20:56:36', 1, '2019-10-16 20:56:36', 1),
(72, 35, 2, 2, 1, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown print', NULL, NULL, NULL, '', '', '2019-10-16 21:14:05', 1, '2019-10-16 21:14:05', 1),
(73, 36, 2, 2, 1, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown print', NULL, NULL, NULL, '', '', '2019-10-16 21:14:05', 1, '2019-10-16 21:14:05', 1),
(78, 37, 2, 2, 1, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown print', NULL, NULL, NULL, '', '', '2019-10-16 21:15:39', 1, '2019-10-16 21:15:39', 1),
(79, 38, 2, 2, 1, 1, 0, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown print', NULL, NULL, NULL, '', '', '2019-10-16 21:15:39', 1, '2019-10-16 21:15:39', 1),
(80, 63, 2, 2, 1, 2, 0, 'REPAIR ASAP', NULL, NULL, NULL, '', '', '2019-10-17 06:24:25', 1, '2019-10-17 06:24:25', 1),
(105, 72, 2, 2, 1, 1, 0, 'ARRANGE SITE CARD', NULL, NULL, NULL, '', '', '2019-10-17 06:32:32', 1, '2019-10-17 06:32:32', 1),
(106, 71, 2, 2, 1, 1, 0, 'ARRANGE SITE CARD', NULL, NULL, NULL, '', '', '2019-10-17 06:33:03', 1, '2019-10-17 06:33:03', 1),
(107, 80, 1, 1, 1, 2, 0, 'waiting for customer approval', NULL, NULL, NULL, 'nil', '', '2019-10-17 07:18:10', 1, '2019-10-17 07:18:10', 1),
(110, 34, 2, 2, 1, 1, 0, 'Warrenty Form Comment', NULL, NULL, NULL, '', '', '2019-10-31 07:26:17', 1, '2019-10-31 07:26:17', 1),
(111, 39, 2, 2, 1, 1, 0, 'Warrenty Form Comment', NULL, NULL, NULL, '', '', '2019-10-31 07:26:17', 1, '2019-10-31 07:26:17', 1),
(112, 41, 2, 2, 1, 1, 0, 'Warrenty Form Comment', NULL, NULL, NULL, '', '', '2019-10-31 07:26:17', 1, '2019-10-31 07:26:17', 1);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ma_location`
--
ALTER TABLE `ma_location`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ma_product_type`
--
ALTER TABLE `ma_product_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `physical_verification`
--
ALTER TABLE `physical_verification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `rma`
--
ALTER TABLE `rma`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `rma_delivery_address`
--
ALTER TABLE `rma_delivery_address`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `rma_unit_information`
--
ALTER TABLE `rma_unit_information`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warranty`
--
ALTER TABLE `warranty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

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

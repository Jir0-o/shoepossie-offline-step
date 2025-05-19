-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 15, 2023 at 11:04 AM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute_definition`
--

DROP TABLE IF EXISTS `attribute_definition`;
CREATE TABLE IF NOT EXISTS `attribute_definition` (
  `attribute_id` int NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(32) DEFAULT NULL,
  `attribute_type_id` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  PRIMARY KEY (`attribute_id`),
  KEY `attribute_type_id` (`attribute_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_type_definition`
--

DROP TABLE IF EXISTS `attribute_type_definition`;
CREATE TABLE IF NOT EXISTS `attribute_type_definition` (
  `attribute_type_id` int NOT NULL,
  `attribute_type_name` varchar(32) DEFAULT NULL,
  `is_active` int DEFAULT '1',
  PRIMARY KEY (`attribute_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_type_definition`
--

INSERT INTO `attribute_type_definition` (`attribute_type_id`, `attribute_type_name`, `is_active`) VALUES
(1, 'text', 1),
(2, 'button', 0),
(3, 'checkbox', 1),
(4, 'color', 0),
(5, 'date', 1),
(6, 'datetime-local', 0),
(7, 'email', 0),
(8, 'file', 1),
(9, 'hidden', 0),
(10, 'image', 0),
(11, 'month', 0),
(12, 'number', 1),
(13, 'password', 0),
(14, 'radio', 0),
(15, 'range', 0),
(16, 'reset', 0),
(17, 'search', 0),
(18, 'submit', 0),
(19, 'tel', 0),
(20, 'time', 0),
(21, 'url', 0),
(22, 'week', 0),
(23, 'textarea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `backoffice_login`
--

DROP TABLE IF EXISTS `backoffice_login`;
CREATE TABLE IF NOT EXISTS `backoffice_login` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `office_user_id` int NOT NULL,
  `full_name` varchar(256) DEFAULT NULL,
  `user_email` varchar(128) NOT NULL,
  `designation` varchar(64) DEFAULT NULL,
  `login_user_name` varchar(32) NOT NULL,
  `login_user_pass` varchar(512) NOT NULL,
  `user_image` varchar(32) DEFAULT NULL,
  `role_id` int NOT NULL,
  `token` varchar(512) DEFAULT NULL,
  `last_login` date DEFAULT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backoffice_login`
--

INSERT INTO `backoffice_login` (`login_id`, `office_user_id`, `full_name`, `user_email`, `designation`, `login_user_name`, `login_user_pass`, `user_image`, `role_id`, `token`, `last_login`, `is_active`) VALUES
(1, 999, 'ABU BAKAR SIDDIQUE', 'abusid@gmail.com', NULL, 'admin', '$2y$10$GiWR74K2NwB/CvVkNM9NzOP4kYJPp2ziCMvLWSwG6Om0MOCKJvOBa', '202207240549face16.jpg', 1, 'ebeb491775e9505a01d18b3d732588a3d272aa21', NULL, 1),
(2, 1000, 'Moyuri', 'moyuri@kaynat.com', NULL, 'Moyuri', '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS', '202207231746face5.jpg', 2, NULL, NULL, 1),
(3, 1001, 'Jui', 'jui@thechef.com', NULL, 'Jui', '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS', '202207240544face5.jpg', 2, NULL, NULL, 1),
(4, 1002, 'Khalid', 'khalid@thechef.com', NULL, 'Khalid', '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS', '202207240551face13.jpg', 2, NULL, NULL, 1),
(5, 1003, 'Munna', 'munna@thechef.com', NULL, 'Munna', '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS', '202207240551face10.jpg', 3, NULL, NULL, 1),
(6, 1005, 'Ritu', 'ritu@thechef.com', NULL, 'Ritu', '$2y$10$uVovbVjAqROdpi1Xsh6oYuEaGER7MtJS0GirglNnEqFZtD6mrbOi2', '202207240552face26.jpg', 5, NULL, NULL, 1),
(7, 1005, 'kamrul', 'hasan@email.com', NULL, 'Kamrul', '$2y$10$Q2Nhuf4ARX8vWVakLQL/o.riyLypjS2zpU89pgzzCt0W28WhDInFW', '202207231733user.webp', 1, NULL, NULL, 1),
(8, 1006, 'Emon', 'emon@thechef.com', NULL, 'Emon', '$2y$10$.pynO24r7Gq08pOheRqPze5P8bik77qK6MZmgv8vW6wiUIneBNYIS', '202207240554face12.jpg', 3, NULL, NULL, 1),
(9, 1007, 'Md.Kamrul Hasan', 'kamrul@ussbd.com', NULL, 'Kamrul', '$2y$10$l.hH/Ht.QktYBmQzmCgIv.3T9mhNisQ7ezYGTIfhDwS/OKXXT52ZW', NULL, 1, NULL, NULL, 1),
(11, 12345, 'Sajjad Hossain', 'abusid@ussbd.com', NULL, 'sajjad121360', '$2y$10$rZAUq/QQyx9FGcSdgaD2j.di8RLnQdBE1bMyOWjoGvkzUQUGQan9a', NULL, 4, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `backoffice_role`
--

DROP TABLE IF EXISTS `backoffice_role`;
CREATE TABLE IF NOT EXISTS `backoffice_role` (
  `role_id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(32) NOT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backoffice_role`
--

INSERT INTO `backoffice_role` (`role_id`, `role_name`) VALUES
(1, 'Super Administrator'),
(2, 'Admin'),
(3, 'Accountant'),
(4, 'Super Admin');

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

DROP TABLE IF EXISTS `banks`;
CREATE TABLE IF NOT EXISTS `banks` (
  `bank_id` int NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `balance` double NOT NULL DEFAULT '0',
  `is_default` int NOT NULL DEFAULT '1',
  `is_active` int DEFAULT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`bank_id`, `bank_name`, `balance`, `is_default`, `is_active`) VALUES
(4, 'World Bank', -289195, 1, 1),
(5, 'DBBL', 303000, 1, 1),
(6, 'X', 0, 1, 0),
(7, 'Dhaka Bank', 0, 1, 1),
(8, 'Midland Bank', 1222081, 1, 1),
(9, 'Brac', 0, 1, 1),
(10, 'IBBL', 34546, 1, 1),
(11, 'X', 0, 1, 1),
(12, 'Janata', 0, 1, 1),
(13, 'IMF', 900000, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank_transactions`
--

DROP TABLE IF EXISTS `bank_transactions`;
CREATE TABLE IF NOT EXISTS `bank_transactions` (
  `bank_transaction_id` int NOT NULL AUTO_INCREMENT,
  `bank_id` int DEFAULT NULL,
  `date` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `trx_type` int DEFAULT NULL,
  `trx_mode` int DEFAULT NULL,
  `bank_name` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cheque_no` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `transaction_no` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prev_balance` double DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `current_balance` double DEFAULT NULL,
  `is_verified` int DEFAULT NULL,
  PRIMARY KEY (`bank_transaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_transactions`
--

INSERT INTO `bank_transactions` (`bank_transaction_id`, `bank_id`, `date`, `trx_type`, `trx_mode`, `bank_name`, `cheque_no`, `transaction_no`, `prev_balance`, `amount`, `current_balance`, `is_verified`) VALUES
(29, 5, '2023-01-04', 1, 2, 'DBBL', 'AAA12121244', NULL, 1000, 1000, 2000, NULL),
(30, 5, '2023-01-04', 1, 3, NULL, NULL, NULL, 2000, 1000, 3000, NULL),
(31, 5, '2023-01-04', 1, 4, NULL, NULL, 'A1234', 3000, 1000, 4000, NULL),
(32, 5, '2023-01-04', 2, 1, NULL, NULL, NULL, 4000, 15000, -11000, NULL),
(33, 5, '2023-01-04', 1, 1, NULL, NULL, NULL, -11000, 15000, 4000, NULL),
(34, 5, '2023-01-04', 2, 2, 'DBBL1', 'AAA12121244', NULL, 4000, 1000, 3000, NULL),
(35, 4, '2023-01-04', 1, 1, NULL, NULL, NULL, 14700, 25685655, 25700355, NULL),
(36, 4, '2023-01-04', 1, 1, NULL, NULL, NULL, 3000, 245, 3245, NULL),
(37, 4, '2023-01-04', 2, 2, 'DBBL1', '12121244', NULL, 3245, 3100, 145, NULL),
(38, 4, '2023-01-04', 2, 4, NULL, NULL, 'A12345', 145, 100, 45, NULL),
(39, 4, '2023-01-04', 2, 2, 'City bank', '12121244', NULL, 45, 1000, 1045, NULL),
(40, NULL, '2023-01-05', 2, 2, NULL, '12121244', NULL, 1045, 4560, -3515, NULL),
(41, NULL, '2023-01-05', 2, 2, NULL, '12121244', NULL, -3515, 4560, -8075, NULL),
(42, NULL, '2023-01-05', 2, 2, NULL, '12121244', NULL, -8075, 4560, -12635, NULL),
(43, NULL, '2023-01-05', 2, 2, NULL, '12121244', NULL, -12635, 4560, -17195, NULL),
(44, NULL, '2023-01-21', 2, 2, NULL, 'AAA12121244', NULL, 3000, 750000, -747000, NULL),
(45, 4, '2023-01-21', 1, 2, 'City bank', '12121244', NULL, -17195, 16000, -1195, NULL),
(46, NULL, '2023-01-22', 2, 2, NULL, '12121244', NULL, -1195, 35000, -36195, NULL),
(47, 4, '2023-01-22', 1, 2, 'Brac', '0123456987', NULL, -36195, 12000, -24195, NULL),
(48, NULL, '2023-02-11', 2, 2, NULL, '123456', NULL, -747000, 350000, -1097000, NULL),
(49, 5, '2023-02-11', 1, 1, NULL, NULL, NULL, -1097000, 700000, -397000, NULL),
(50, 5, '2023-02-11', 1, 2, 'Dhaka Bank', '3456789', NULL, -397000, 700000, 303000, NULL),
(51, 8, '2023-02-14', 1, 1, NULL, NULL, NULL, 0, 1000000, 1000000, NULL),
(52, NULL, '2023-02-14', 2, 2, NULL, '123456', NULL, 1000000, 180000, 820000, NULL),
(53, NULL, '2023-03-01', 2, 2, NULL, '1234567890', NULL, -24195, 300000, -324195, NULL),
(54, NULL, '2023-03-01', 2, 2, NULL, '1234567809', NULL, -324195, 30000, -354195, NULL),
(55, 10, '2023-03-22', 1, 2, NULL, 'eryesrurturyj', NULL, 0, 34546, 34546, NULL),
(56, 8, '2023-03-22', 1, 2, 'Swiss Bank', 'dtyuirtyu', NULL, 820000, 456756, 1276756, NULL),
(57, 8, '2023-03-22', 2, 1, NULL, NULL, NULL, 1276756, 54675, 1222081, NULL),
(58, 4, '2023-04-27', 1, 2, 'brac', '0124789999', NULL, -354195, 65000, -289195, NULL),
(59, 13, '2023-05-06', 1, 1, NULL, NULL, NULL, 0, 1000000, 1000000, NULL),
(60, 13, '2023-05-06', 2, 2, 'IMF', '12345678', NULL, 1000000, 100000, 900000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banner_information`
--

DROP TABLE IF EXISTS `banner_information`;
CREATE TABLE IF NOT EXISTS `banner_information` (
  `id` int NOT NULL AUTO_INCREMENT,
  `banner_url` varchar(32) NOT NULL,
  `banner_address` varchar(255) DEFAULT NULL,
  `banner_mobile` varchar(20) DEFAULT NULL,
  `banner_email` varchar(32) NOT NULL DEFAULT 'contact@yyooss.com',
  `banner_name` varchar(128) NOT NULL,
  `banner_logo` varchar(512) NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner_information`
--

INSERT INTO `banner_information` (`id`, `banner_url`, `banner_address`, `banner_mobile`, `banner_email`, `banner_name`, `banner_logo`, `is_active`) VALUES
(1, 'https://possie.nescostore.com', 'Nirala', '+8801717006925', 'contact@ussbd.com', 'POSSIE', 'https://possie.nescostore.com/public/backend/050123unipos_logo.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand_types`
--

DROP TABLE IF EXISTS `brand_types`;
CREATE TABLE IF NOT EXISTS `brand_types` (
  `brand_type_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_type_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_type_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`brand_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand_types`
--

INSERT INTO `brand_types` (`brand_type_id`, `brand_type_name`, `brand_type_code`, `brand_type_is_active`, `created_at`, `updated_at`) VALUES
(1, 'Step', 'ST', 1, '2023-07-08 01:56:00', '2023-07-08 02:05:47'),
(2, 'China', 'CH', 1, '2023-07-08 01:56:21', '2023-07-08 01:56:21'),
(3, 'Bangladesh', 'BD', 1, '2023-07-08 01:56:37', '2023-07-08 01:56:37'),
(4, 'India', 'IN', 1, '2023-07-09 18:35:16', '2023-07-09 18:35:16'),
(5, 'Others', 'OT', 1, '2023-07-09 18:36:37', '2023-07-09 18:36:37');

-- --------------------------------------------------------

--
-- Table structure for table `cart_cancel`
--

DROP TABLE IF EXISTS `cart_cancel`;
CREATE TABLE IF NOT EXISTS `cart_cancel` (
  `cancel_id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `cancelled_by_id` int NOT NULL,
  `cancel_note` text NOT NULL,
  `cancel_time` date NOT NULL,
  `last_delivery_level` int NOT NULL,
  PRIMARY KEY (`cancel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_delivery`
--

DROP TABLE IF EXISTS `cart_delivery`;
CREATE TABLE IF NOT EXISTS `cart_delivery` (
  `delivery_id` int NOT NULL AUTO_INCREMENT,
  `temp_cart_id` int NOT NULL,
  `cart_id` int DEFAULT NULL,
  `waiter_id` int DEFAULT NULL,
  `payment_status` int DEFAULT '0',
  `delivery_status_id` int DEFAULT NULL,
  PRIMARY KEY (`delivery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_informtion`
--

DROP TABLE IF EXISTS `cart_informtion`;
CREATE TABLE IF NOT EXISTS `cart_informtion` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int DEFAULT NULL,
  `cart_date` varchar(32) DEFAULT NULL,
  `cart_status` int DEFAULT NULL,
  `payment_method_id` int DEFAULT NULL,
  `total_cart_amount` float DEFAULT NULL,
  `vat_amount` float DEFAULT '0',
  `total_discount` float DEFAULT '0',
  `total_payable_amount` float DEFAULT NULL,
  `gross_profit` float DEFAULT NULL,
  `payment_method_charge` float DEFAULT NULL,
  `final_total_amount` float DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT '0',
  `net_profit` float DEFAULT NULL,
  `delivery_date` varchar(32) DEFAULT NULL,
  `table_no` varchar(32) DEFAULT NULL,
  `waiter_id` int DEFAULT NULL,
  `sales_type` int NOT NULL DEFAULT '1',
  `is_vat_show` tinyint(1) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `payment_method_id` (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_informtion`
--

INSERT INTO `cart_informtion` (`cart_id`, `consumer_id`, `cart_date`, `cart_status`, `payment_method_id`, `total_cart_amount`, `vat_amount`, `total_discount`, `total_payable_amount`, `gross_profit`, `payment_method_charge`, `final_total_amount`, `paid_amount`, `due_amount`, `net_profit`, `delivery_date`, `table_no`, `waiter_id`, `sales_type`, `is_vat_show`, `created_by`) VALUES
(59, 148, '2023-01-04 13:06:10', 2, 2, 1000, 0, 0, 1000, 300, NULL, 1000, 1000, 0, 300, NULL, NULL, NULL, 1, 1, 7),
(60, 148, '2023-01-05 13:04:17', 2, 1, 1000, 0, NULL, 1000, 300, NULL, 1000, 1000, 0, 300, NULL, NULL, NULL, 1, 1, 7),
(61, 148, '2023-01-05 13:05:57', 2, 1, 1500, 0, 0, 1500, 750, NULL, 1500, 1500, 0, 750, NULL, NULL, NULL, 1, NULL, 7),
(62, 149, '2023-01-05 15:25:18', 2, 1, 1500, 0, 500, 1000, 250, NULL, 1000, 1000, 0, 250, NULL, NULL, NULL, 1, NULL, 7),
(63, 150, '2023-01-05 15:25:57', 2, 1, 1500, 0, 500, 1000, 250, NULL, 1000, 1000, 0, 250, NULL, NULL, NULL, 1, NULL, 7),
(64, 148, '2023-01-07 07:47:52', 2, 1, 2400, 0, 400, 2000, 400, NULL, 2000, 2000, 0, 400, NULL, NULL, NULL, 1, NULL, 7),
(65, 151, '2023-01-19 07:19:07', 2, 1, 6000, 0, 500, 5500, 500, NULL, 5500, 5500, 0, 500, NULL, NULL, NULL, 1, NULL, 7),
(66, 152, '2023-01-21 09:03:06', 2, 2, 16000, 0, 0, 16000, 1000, NULL, 16000, 16000, 0, 1000, NULL, NULL, NULL, 1, NULL, 7),
(67, 151, '2023-01-22 12:51:24', 2, 1, 25000, 0, 0, 25000, 5000, NULL, 25000, 15000, 0, 5000, NULL, NULL, NULL, 1, NULL, 7),
(68, 151, '2023-01-22 14:04:19', 2, 2, 12000, 0, 0, 12000, 2000, NULL, 12000, 12000, 0, 2000, NULL, NULL, NULL, 1, NULL, 7),
(69, 153, '2023-01-23 08:16:18', 2, 1, 8250, 0, NULL, 8250, 2250, NULL, 8250, 8250, 0, 2250, NULL, NULL, NULL, 1, NULL, 7),
(70, 154, '2023-01-23 11:12:11', 2, 1, 3300, 15, 75, 3240, 940, NULL, 3240, 3240, 0, 940, NULL, NULL, NULL, 1, NULL, 7),
(71, 155, '2023-01-25 14:13:53', 2, 1, 3000, 20, 200, 2820, 820, NULL, 2820, 2820, 0, 820, NULL, NULL, NULL, 1, NULL, 7),
(72, 151, '2023-01-26 11:30:38', 1, 1, 110000, 0, NULL, 110000, 10000, NULL, 110000, 10000, 100000, 10000, NULL, NULL, NULL, 2, NULL, 7),
(73, 156, '2023-02-11 12:08:40', 2, 3, 112500, 0, NULL, 112500, 7500, NULL, 112500, 112500, 0, 7500, NULL, NULL, NULL, 2, NULL, 7),
(74, 157, '2023-02-15 15:31:57', 2, 1, 75000, 0, 0, 75000, 25000, NULL, 75000, 75000, 0, 25000, NULL, NULL, NULL, 1, NULL, 7),
(75, 158, '2023-02-15 15:35:10', 2, 1, 7500, 0, 0, 7500, 2500, NULL, 7500, 0, 0, 2500, NULL, NULL, NULL, 1, NULL, 7),
(76, 158, '2023-02-15 15:38:33', 0, 1, 3000, 0, 0, 3000, 1000, NULL, 3000, 0, 3000, 1000, NULL, NULL, NULL, 1, NULL, 7),
(77, 159, '2023-02-21 05:20:09', 2, 1, 1500, 25, 50, 1475, 475, NULL, 1475, 1475, 0, 475, NULL, NULL, NULL, 1, NULL, 7),
(78, 160, '2023-02-28 12:04:50', 2, 1, 680, 0, 0, 680, 160, NULL, 680, 680, 0, 160, NULL, NULL, NULL, 1, NULL, 7),
(79, 161, '2023-03-01 12:59:02', 2, 1, 31000, 0, 0, 31000, 1000, NULL, 31000, 31000, 0, 1000, NULL, NULL, NULL, 1, NULL, 7),
(80, 161, '2023-03-01 13:00:22', 2, 1, 15500, 0, 0, 15500, 500, NULL, 15500, 0, 0, 500, NULL, NULL, NULL, 1, NULL, 7),
(81, 162, '2023-03-01 13:55:41', 2, 1, 330000, 0, 0, 330000, 30000, NULL, 330000, 330000, 0, 30000, NULL, NULL, NULL, 1, NULL, 7),
(82, 163, '2023-03-05 05:52:55', 2, 1, 14500, 0, 0, 14500, 500, NULL, 14500, 14500, 0, 500, NULL, NULL, NULL, 1, NULL, 7),
(83, 164, '2023-03-07 06:32:51', 2, 1, 500500, 25090, 5000, 520590, 52590, NULL, 520590, 520590, 0, 52590, NULL, NULL, NULL, 1, NULL, 7),
(84, 165, '2023-03-07 14:56:13', 2, 1, 4400, 0, 0, 4400, 400, NULL, 4400, 4400, 0, 400, NULL, NULL, NULL, 2, NULL, 7),
(85, 166, '2023-03-08 09:52:45', 2, 1, 1140, 600, 40, 1700, 980, NULL, 1700, 1700, 0, 980, NULL, NULL, NULL, 1, NULL, 7),
(86, 155, '2023-03-09 07:31:20', 2, 1, 12800, 0, NULL, 12800, 400, NULL, 12800, 12800, 0, 400, NULL, NULL, NULL, 1, NULL, 1),
(87, 167, '2023-03-12 06:13:05', 2, 1, 32500, 0, 0, 32500, 3500, NULL, 32500, 32500, 0, 3500, NULL, NULL, NULL, 1, NULL, 7),
(88, 159, '2023-03-15 08:02:25', 2, 1, 3290, 100, NULL, 3390, 270, NULL, 3390, 3390, 0, 270, NULL, NULL, NULL, 1, NULL, 7),
(89, 160, '2023-03-21 09:15:09', 2, 1, 570, 300, NULL, 870, 510, NULL, 870, 870, 0, 510, NULL, NULL, NULL, 1, NULL, 7),
(90, 168, '2023-03-28 08:41:58', NULL, 1, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, 1, NULL, 7),
(91, 169, '2023-04-01 06:14:16', 2, 1, 9700, 0, 100, 9600, 300, NULL, 9600, 9600, 0, 300, NULL, NULL, NULL, 1, NULL, 7),
(92, 170, '2023-04-02 09:08:31', 2, 1, 3100, 0, 0, 3100, 100, NULL, 3100, 3100, 0, 100, NULL, NULL, NULL, 1, NULL, 7),
(93, 171, '2023-04-05 09:13:15', 2, 1, 3100, 0, 0, 3100, 100, NULL, 3100, 3100, 0, 100, NULL, NULL, NULL, 1, NULL, 7),
(94, 172, '2023-04-05 09:14:19', 2, 1, 3100, 0, 0, 3100, 100, NULL, 3100, 3100, 0, 100, NULL, NULL, NULL, 1, NULL, 7),
(95, 171, '2023-04-05 09:15:48', 2, 1, 3100, 0, NULL, 3100, 100, NULL, 3100, 3100, 0, 100, NULL, NULL, NULL, 1, NULL, 7),
(96, 173, '2023-04-11 05:00:04', 2, 1, 18600, 0, 300, 18300, 300, NULL, 18300, 18300, 0, 300, NULL, NULL, NULL, 1, NULL, 7),
(97, 174, '2023-04-27 07:26:58', 2, 2, 65000, 0, 0, 65000, 7000, NULL, 65000, 65000, 0, 7000, NULL, NULL, NULL, 1, NULL, 7),
(98, 175, '2023-05-01 05:32:37', 2, 1, 9300, 0, 0, 9300, 300, NULL, 9300, 9300, 0, 300, NULL, NULL, NULL, 1, NULL, 7),
(99, 176, '2023-05-01 05:52:31', 2, 1, 40000, 0, 0, 40000, 10000, NULL, 40000, 40000, 0, 10000, NULL, NULL, NULL, 2, NULL, 7),
(100, 176, '2023-05-01 06:03:51', 2, 1, 129500, 0, 0, 129500, 37500, NULL, 129500, 129500, 0, 37500, NULL, NULL, NULL, 1, NULL, 7),
(101, 177, '2023-05-03 04:13:49', 2, 1, 1200, 0, 0, 1200, 200, NULL, 1200, 1200, 0, 200, NULL, NULL, NULL, 1, NULL, 7),
(102, 178, '2023-05-06 11:21:20', 2, 1, 3600, 0, 3000, 600, -1400, NULL, 600, 600, 0, -1400, NULL, NULL, NULL, 1, NULL, 7),
(103, 179, '2023-05-11 13:15:11', 2, 1, 9700, 0, 0, 9700, 400, NULL, 9700, 9700, 0, 400, NULL, NULL, NULL, 1, NULL, 1),
(104, 179, '2023-05-11 13:37:33', 2, 1, 19400, 0, 0, 19400, 800, NULL, 19400, 19400, 0, 800, NULL, NULL, NULL, 1, NULL, 1),
(105, 180, '2023-05-22 07:17:52', 2, 1, 12000, 0, 0, 12000, 3200, NULL, 12000, 12000, 0, 3200, NULL, NULL, NULL, 1, NULL, 7),
(106, 160, '2023-05-24 10:55:46', 2, 1, 640, 0, NULL, 640, 240, NULL, 640, 640, 0, 240, NULL, NULL, NULL, 1, 1, 7),
(107, 160, '2023-05-24 10:59:19', 2, 1, 4000, 0, NULL, 4000, 800, NULL, 4000, 4000, 0, 800, NULL, NULL, NULL, 1, NULL, 7),
(108, 160, '2023-05-24 12:39:33', 2, 1, 2900, 20, 0, 2920, 860, NULL, 2920, 2920, 0, 860, NULL, NULL, NULL, 1, NULL, 7),
(109, 160, '2023-05-24 12:47:47', 2, 1, 6250, 38, 0, 6288, 1978, NULL, 6288, 6288, 0, 1978, NULL, NULL, NULL, 1, NULL, 7),
(110, 160, '2023-05-24 12:48:14', 2, 1, 1450, 10, 0, 1460, 430, NULL, 1460, 1460, 0, 430, NULL, NULL, NULL, 1, NULL, 7),
(111, 181, '2023-05-24 14:41:50', 2, 1, 1000, 5, 0, 1005, 305, NULL, 1005, 1005, 0, 305, NULL, NULL, NULL, 1, NULL, 7),
(112, 181, '2023-05-25 07:50:05', 2, 1, 2500, 10, NULL, 2510, 860, NULL, 2510, 2510, 0, 860, NULL, NULL, NULL, 1, NULL, 7),
(113, 182, '2023-05-25 08:15:33', 2, 1, 1450, 10, NULL, 1460, 430, NULL, 1460, 1460, 0, 430, NULL, NULL, NULL, 1, 1, 7),
(114, 160, '2023-05-28 09:31:12', 2, 1, 500, 0, 0, 500, 250, NULL, 500, 500, 0, 250, NULL, NULL, NULL, 1, 1, 7),
(115, 183, '2023-05-28 09:32:02', 2, 1, 1150, 5, 0, 1155, 355, NULL, 1155, 1155, 0, 355, NULL, NULL, NULL, 1, NULL, 7),
(116, 184, '2023-05-28 09:36:39', 2, 1, 7000, 0, 0, 7000, 200, NULL, 7000, 7000, 0, 200, NULL, NULL, NULL, 1, NULL, 7),
(117, 185, '2023-05-31 08:18:45', 1, 1, 70000, 0, NULL, 70000, 2000, NULL, 70000, 500, 69500, 2000, NULL, NULL, NULL, 1, NULL, 7),
(118, 186, '2023-06-13 06:37:57', 2, 1, 18000, 0, 1800, 16200, 6200, NULL, 16200, 16200, 0, 6200, NULL, NULL, NULL, 1, NULL, 7),
(119, 187, '2023-06-17 06:22:16', 2, 1, 4800, 0, 120, 4680, 810, NULL, 4680, 4680, 0, 810, NULL, NULL, NULL, 1, NULL, 7);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE IF NOT EXISTS `cart_items` (
  `cart_item_id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `stock_id` int DEFAULT NULL,
  `size_id` varchar(128) DEFAULT NULL,
  `unit_id` int DEFAULT NULL,
  `unit_purchase_cost` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `unit_sales_cost` float DEFAULT NULL,
  `total_price` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `is_confirmed` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`cart_item_id`),
  KEY `cart_id` (`cart_id`),
  KEY `product_id` (`product_id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cart_item_id`, `cart_id`, `product_id`, `stock_id`, `size_id`, `unit_id`, `unit_purchase_cost`, `quantity`, `unit_sales_cost`, `total_price`, `vat`, `net_amount`, `is_confirmed`) VALUES
(79, 59, 1, 219, NULL, 1, 700, 1, 1000, 1000, 0, 1000, '1'),
(80, 60, 1, 219, NULL, 1, 700, 1, 1000, 1000, 0, 1000, '1'),
(81, 61, 1, 220, NULL, 1, 750, 1, 1500, 1500, 0, 1500, '1'),
(82, 62, 1, 220, NULL, 1, 750, 1, 1500, 1500, 0, 1500, '1'),
(83, 63, 1, 220, NULL, 1, 750, 1, 1500, 1500, 0, 1500, '1'),
(84, 64, 19, 223, NULL, 1, 700, 2, 1000, 2000, 0, 2000, '1'),
(85, 64, 37, 224, NULL, 1, 100, 2, 200, 400, 0, 400, '1'),
(86, 65, 158, 225, NULL, 1, 1000, 5, 1200, 6000, 0, 6000, '1'),
(87, 66, 159, 226, NULL, 1, 15000, 1, 16000, 16000, 0, 16000, '1'),
(88, 67, 160, 228, NULL, 1, 20000, 1, 25000, 25000, 0, 25000, '1'),
(89, 68, 158, 225, NULL, 1, 1000, 10, 1200, 12000, 0, 12000, '1'),
(90, 69, 166, 233, NULL, 1, 400, 15, 550, 8250, 0, 8250, '1'),
(91, 70, 167, 234, NULL, 1, 1500, 1, 2200, 2200, 15, 2215, '1'),
(92, 70, 166, 233, NULL, 1, 400, 2, 550, 1100, 0, 1100, '1'),
(93, 71, 169, 237, NULL, 1, 1000, 2, 1500, 3000, 20, 3020, '1'),
(94, 72, 158, 225, NULL, 1, 1000, 100, 1200, 110000, 0, 110000, '1'),
(95, 73, 171, 242, NULL, 1, 3500, 30, 4000, 112500, 0, 112500, '1'),
(96, 74, 174, 246, NULL, 1, 1000, 50, 1500, 75000, 0, 75000, '1'),
(97, 75, 174, 246, NULL, 1, 1000, 5, 1500, 7500, 0, 7500, '1'),
(98, 76, 174, 246, NULL, 1, 1000, 2, 1500, 3000, 0, 3000, '1'),
(99, 77, 175, 247, NULL, 1, 200, 5, 300, 1500, 25, 1525, '1'),
(100, 78, 178, 249, NULL, 1, 120, 1, 180, 180, 0, 180, '1'),
(101, 78, 179, 250, NULL, 1, 200, 2, 250, 500, 0, 500, '1'),
(102, 79, 180, 252, NULL, 1, 3000, 10, 3100, 31000, 0, 31000, '1'),
(103, 80, 180, 252, NULL, 1, 3000, 5, 3100, 15500, 0, 15500, '1'),
(104, 81, 180, 253, NULL, 1, 10000, 30, 11000, 330000, 0, 330000, '1'),
(105, 82, 180, 257, NULL, 1, 2500, 2, 2600, 5200, 0, 5200, '1'),
(106, 82, 180, 252, NULL, 1, 3000, 2, 3100, 6200, 0, 6200, '1'),
(107, 82, 180, 255, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(108, 83, 180, 258, NULL, 1, 3600, 130, 3850, 500500, 25090, 525590, '1'),
(109, 84, 179, 250, NULL, 1, 200, 20, 250, 4400, 0, 4400, '1'),
(110, 85, 178, 251, NULL, 1, 120, 6, 190, 1140, 600, 1740, '1'),
(111, 86, 180, 252, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(112, 86, 180, 254, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(113, 86, 180, 255, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(114, 86, 180, 256, NULL, 1, 3400, 1, 3500, 3500, 0, 3500, '1'),
(115, 87, 180, 259, NULL, 1, 5800, 5, 6500, 32500, 0, 32500, '1'),
(116, 88, 178, 251, NULL, 1, 120, 1, 190, 190, 100, 290, '1'),
(117, 88, 180, 252, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(118, 89, 178, 251, NULL, 1, 120, 3, 190, 570, 300, 870, '1'),
(119, 91, 183, 261, NULL, 1, 9300, 1, 9700, 9700, 0, 9700, '1'),
(120, 92, 180, 252, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(121, 93, 180, 254, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(122, 94, 180, 254, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(123, 95, 180, 254, NULL, 1, 3000, 1, 3100, 3100, 0, 3100, '1'),
(124, 96, 180, 254, NULL, 1, 3000, 6, 3100, 18600, 0, 18600, '1'),
(125, 97, 180, 259, NULL, 1, 5800, 10, 6500, 65000, 0, 65000, '1'),
(126, 98, 180, 255, NULL, 1, 3000, 3, 3100, 9300, 0, 9300, '1'),
(127, 99, 184, 265, NULL, 4, 60, 500, 85, 40000, 0, 40000, '1'),
(128, 100, 184, 265, NULL, 4, 60, 500, 85, 42500, 0, 42500, '1'),
(129, 100, 184, 266, NULL, 4, 62, 1000, 87, 87000, 0, 87000, '1'),
(130, 101, 185, 267, NULL, 1, 50, 20, 60, 1200, 0, 1200, '1'),
(131, 102, 186, 268, NULL, 1, 1000, 2, 1800, 3600, 0, 3600, '1'),
(132, 103, 183, 261, NULL, 1, 9300, 1, 9700, 9700, 0, 9700, '1'),
(133, 104, 183, 261, NULL, 1, 9300, 2, 9700, 19400, 0, 19400, '1'),
(134, 105, 187, 269, NULL, 4, 220, 40, 300, 12000, 0, 12000, '1'),
(135, 106, 179, 270, NULL, 1, 200, 2, 320, 640, 0, 640, '1'),
(136, 107, 180, 260, NULL, 1, 800, 4, 1000, 4000, 0, 4000, '1'),
(137, 108, 191, 271, NULL, 1, 580, 2, 800, 1600, 10, 1610, '1'),
(138, 108, 192, 272, NULL, 1, 450, 2, 650, 1300, 10, 1310, '1'),
(139, 109, 191, 271, NULL, 1, 580, 2, 800, 1600, 10, 1610, '1'),
(140, 109, 192, 272, NULL, 1, 450, 2, 650, 1300, 10, 1310, '1'),
(141, 109, 188, 273, NULL, 1, 700, 2, 1000, 2000, 10, 2010, '1'),
(142, 109, 189, 274, NULL, 1, 850, 1, 1350, 1350, 8, 1358, '1'),
(143, 110, 191, 271, NULL, 1, 580, 1, 800, 800, 5, 805, '1'),
(144, 110, 192, 272, NULL, 1, 450, 1, 650, 650, 5, 655, '1'),
(145, 111, 188, 273, NULL, 1, 700, 1, 1000, 1000, 5, 1005, '1'),
(146, 112, 190, 278, NULL, 1, 950, 1, 1500, 1500, 5, 1505, '1'),
(147, 112, 188, 273, NULL, 1, 700, 1, 1000, 1000, 5, 1005, '1'),
(148, 113, 191, 271, NULL, 1, 580, 1, 800, 800, 5, 805, '1'),
(149, 113, 192, 272, NULL, 1, 450, 1, 650, 650, 5, 655, '1'),
(150, 114, 199, 279, NULL, 1, 50, 3, 100, 300, 0, 300, '1'),
(151, 114, 200, 280, NULL, 1, 50, 2, 100, 200, 0, 200, '1'),
(152, 115, 197, 281, NULL, 1, 350, 1, 500, 500, 2, 502, '1'),
(153, 115, 198, 282, NULL, 1, 450, 1, 650, 650, 3, 653, '1'),
(154, 116, 180, 256, NULL, 1, 3400, 2, 3500, 7000, 0, 7000, '1'),
(155, 117, 180, 256, NULL, 1, 3400, 20, 3500, 70000, 0, 70000, '1'),
(156, 118, 201, 285, NULL, 1, 500, 20, 900, 18000, 0, 18000, '1'),
(157, 119, 202, 286, NULL, 6, 1290, 3, 1600, 4800, 0, 4800, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item_return`
--

DROP TABLE IF EXISTS `cart_item_return`;
CREATE TABLE IF NOT EXISTS `cart_item_return` (
  `cart_item_return_id` int NOT NULL AUTO_INCREMENT,
  `login_id` int DEFAULT NULL,
  `cart_id` int DEFAULT NULL,
  `cart_item_id` varchar(11) NOT NULL,
  `received_by_id` int DEFAULT NULL,
  `reason_of_return` varchar(128) DEFAULT NULL,
  `total_amount` varchar(128) DEFAULT NULL,
  `non_refundable_vat` varchar(128) DEFAULT NULL,
  `refund_amount` varchar(128) DEFAULT NULL,
  `return_date` varchar(32) DEFAULT NULL,
  `authorized_by` int DEFAULT NULL,
  `authorize_date` varchar(32) DEFAULT NULL,
  `return_status` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`cart_item_return_id`),
  KEY `cart_id` (`cart_id`),
  KEY `consumer_id` (`login_id`),
  KEY `cart_item_id` (`cart_item_id`),
  KEY `received_by_id` (`received_by_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_item_return`
--

INSERT INTO `cart_item_return` (`cart_item_return_id`, `login_id`, `cart_id`, `cart_item_id`, `received_by_id`, `reason_of_return`, `total_amount`, `non_refundable_vat`, `refund_amount`, `return_date`, `authorized_by`, `authorize_date`, `return_status`) VALUES
(1, 148, 61, '81', 7, NULL, '1500', '0', '1500', '2023-01-05 13:46:41', 7, '2023-01-05 13:59:35', '4'),
(2, 148, 61, '81', 7, NULL, '1500', '0', '1500', '2023-01-05 14:06:36', 7, '2023-01-05 14:06:48', '4'),
(3, 148, 61, '81', 7, NULL, '1500', '0', '1500', '2023-01-05 14:08:57', 7, '2023-01-05 14:09:12', '4'),
(4, 148, 60, '80', 7, NULL, '1000', '0', '1000', '2023-01-05 14:10:49', 7, '2023-01-05 14:10:57', '3'),
(5, 148, 59, '79', 7, NULL, '1000', '0', '1000', '2023-01-05 14:36:19', 7, '2023-01-05 15:30:50', '3'),
(6, 150, 63, '83', 7, NULL, '1500', '0', '1500', '2023-01-05 15:29:56', 7, '2023-01-16 07:18:31', '4'),
(7, 149, 62, '82', 7, 'ABCD', '1500', '0', '1500', '2023-01-07 07:49:17', 7, '2023-01-07 07:49:30', '4'),
(8, 148, 64, '84', 7, 'hudai', '2000', '0', '2000', '2023-01-16 07:17:49', 7, '2023-02-06 10:50:42', '3'),
(9, 156, 73, '95', 7, 'Battery problem', '11250', '0', '112500', '2023-02-11 12:27:01', NULL, NULL, '1'),
(10, 155, 71, '93', 7, 'Date expired', '2000', '20', '2000', '2023-02-11 12:35:14', NULL, NULL, '1'),
(11, 158, 75, '97', 7, 'test', '7500', '0', '7500', '2023-02-15 15:44:20', NULL, NULL, '1'),
(12, 178, 102, '131', 7, 'Wife angry', '3600', '0', '3600', '2023-05-06 11:26:05', 7, '2023-05-06 11:26:46', '4'),
(13, 179, 103, '132', 1, 'test', '9700', '0', '9700', '2023-05-11 13:33:43', 1, '2023-05-11 13:34:18', '4'),
(14, 179, 104, '133', 1, 'test', '19400', '0', '19400', '2023-05-11 13:39:06', 1, '2023-05-11 13:39:26', '4'),
(15, 162, 81, '104', 7, 'dhbfhbzd', '330000', '30000', '3000', '2023-05-24 12:43:34', NULL, NULL, '1'),
(16, 181, 111, '145', 7, 'damage', '1000', '5', '1000', '2023-05-24 14:49:01', NULL, NULL, '1'),
(17, 183, 115, '153', 7, 'Damage', '650', '3', '650', '2023-05-28 09:35:55', 7, '2023-05-28 09:36:58', '4'),
(18, 187, 119, '157', 7, 'Spot', '4800', '0', '1000', '2023-06-17 06:35:46', 7, '2023-06-17 06:36:48', '3');

-- --------------------------------------------------------

--
-- Table structure for table `cart_payment_information`
--

DROP TABLE IF EXISTS `cart_payment_information`;
CREATE TABLE IF NOT EXISTS `cart_payment_information` (
  `payment_id` int NOT NULL AUTO_INCREMENT,
  `cart_id` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `paid_amount` float NOT NULL,
  `balance_amount` float NOT NULL,
  `is_verified` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`payment_id`),
  KEY `cart_payment_information_ibfk_1` (`cart_id`),
  KEY `payment_method_id` (`payment_method_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cart_payment_methods`
--

DROP TABLE IF EXISTS `cart_payment_methods`;
CREATE TABLE IF NOT EXISTS `cart_payment_methods` (
  `payment_method_id` int NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(64) NOT NULL,
  `payment_method_symbol` varchar(16) NOT NULL,
  `payment_method_charge` float NOT NULL,
  `is_verified` int NOT NULL,
  PRIMARY KEY (`payment_method_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_payment_methods`
--

INSERT INTO `cart_payment_methods` (`payment_method_id`, `payment_method`, `payment_method_symbol`, `payment_method_charge`, `is_verified`) VALUES
(1, 'Cash', 'Cash', 0, 1),
(2, 'Bank', 'BANK', 0, 1),
(3, 'ATM', 'ATM', 0, 1),
(4, 'Others', 'Others', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_temporary`
--

DROP TABLE IF EXISTS `cart_temporary`;
CREATE TABLE IF NOT EXISTS `cart_temporary` (
  `temp_cart_id` int NOT NULL AUTO_INCREMENT,
  `temporary_consumer_id` int DEFAULT NULL,
  `consumer_id` int DEFAULT NULL,
  `create_date` varchar(32) DEFAULT NULL,
  `from_ip` varchar(15) DEFAULT NULL,
  `created_by` int NOT NULL,
  `table_no` varchar(32) DEFAULT NULL,
  `waiter_id` int DEFAULT NULL,
  `expected_delivery_date` varchar(32) DEFAULT NULL,
  `sales_type` int NOT NULL DEFAULT '1',
  `is_suspended` int DEFAULT NULL,
  PRIMARY KEY (`temp_cart_id`),
  KEY `consumer_id` (`consumer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_temporary`
--

INSERT INTO `cart_temporary` (`temp_cart_id`, `temporary_consumer_id`, `consumer_id`, `create_date`, `from_ip`, `created_by`, `table_no`, `waiter_id`, `expected_delivery_date`, `sales_type`, `is_suspended`) VALUES
(135, 34671, NULL, '2023-01-03 08:07:44', '127.0.0.1', 7, '1', 1, NULL, 1, 1),
(143, 86537, NULL, '2023-01-16 07:10:49', '27.147.190.162', 7, '1', 1, NULL, 1, 1),
(164, 24083, NULL, '2023-02-21 05:21:38', '27.147.190.229', 7, '1', 1, NULL, 1, 1),
(181, 62149, NULL, '2023-03-22 05:51:37', '103.232.100.213', 7, NULL, NULL, NULL, 1, 0),
(197, 94103, NULL, '2023-05-24 12:16:13', '103.232.100.213', 1, NULL, NULL, NULL, 1, 0),
(209, 41390, NULL, '2023-06-13 06:49:27', '103.232.100.213', 1, NULL, NULL, NULL, 1, 0),
(210, 41390, NULL, '2023-06-13 06:53:20', '103.232.100.213', 1, NULL, NULL, NULL, 1, 0),
(212, 59368, NULL, '2023-07-13 11:49:33', '::1', 1, '1', 1, NULL, 1, 1),
(213, 59368, NULL, '2023-07-13 11:50:25', '::1', 1, NULL, NULL, NULL, 1, 0),
(214, 59368, NULL, '2023-07-13 12:12:43', '::1', 1, NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_temporary_items`
--

DROP TABLE IF EXISTS `cart_temporary_items`;
CREATE TABLE IF NOT EXISTS `cart_temporary_items` (
  `temp_cart_item_id` int NOT NULL AUTO_INCREMENT,
  `temp_cart_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `stock_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `total_discount` int DEFAULT NULL,
  `size_id` int DEFAULT NULL,
  `color_id` int DEFAULT NULL,
  `temp_net_amount` float DEFAULT NULL,
  `vat` float DEFAULT '0',
  PRIMARY KEY (`temp_cart_item_id`),
  KEY `temp_cart_id` (`temp_cart_id`),
  KEY `product_id` (`product_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=341 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_temporary_items`
--

INSERT INTO `cart_temporary_items` (`temp_cart_item_id`, `temp_cart_id`, `product_id`, `stock_id`, `quantity`, `total_discount`, `size_id`, `color_id`, `temp_net_amount`, `vat`) VALUES
(216, 143, 158, 225, 58, 0, NULL, NULL, 69600, 0),
(246, 164, 158, 225, 2, 0, NULL, NULL, 2400, 0),
(247, 164, 174, 246, 1, 0, NULL, NULL, 1500, 0),
(248, 164, 159, 226, 1, 0, NULL, NULL, 16000, 0),
(335, 212, 188, 273, 2, 0, NULL, NULL, 2000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cart_temporary_payment`
--

DROP TABLE IF EXISTS `cart_temporary_payment`;
CREATE TABLE IF NOT EXISTS `cart_temporary_payment` (
  `cart_temporary_payment_id` int NOT NULL AUTO_INCREMENT,
  `cart_temporary_id` int NOT NULL,
  `cart_temporary_total` int NOT NULL,
  `discount_amount` int NOT NULL,
  `total_payable` int NOT NULL,
  `payment_method_id` int NOT NULL,
  `paid_amount` int NOT NULL,
  `due_amount` int NOT NULL,
  `change_amount` int NOT NULL,
  `vat` float DEFAULT '0',
  PRIMARY KEY (`cart_temporary_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=158 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_temporary_payment`
--

INSERT INTO `cart_temporary_payment` (`cart_temporary_payment_id`, `cart_temporary_id`, `cart_temporary_total`, `discount_amount`, `total_payable`, `payment_method_id`, `paid_amount`, `due_amount`, `change_amount`, `vat`) VALUES
(93, 143, 69600, 1000, 68600, 1, 69600, 0, 1000, 0),
(101, 152, 0, 100, -100, 1, 1110, 0, 1210, 0),
(106, 157, 1200, 0, 1200, 1, 1200, 0, 0, 0),
(118, 171, 46500, 0, 46500, 1, 46500, 0, 0, 0),
(126, 181, 0, 200, -200, 1, 2400, 0, 2600, 0),
(157, 213, 4150, 10, 4163, 1, 1000, 3163, -3163, 23);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

DROP TABLE IF EXISTS `colors`;
CREATE TABLE IF NOT EXISTS `colors` (
  `colors_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `colors_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `colors_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`colors_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`colors_id`, `colors_name`, `colors_code`, `colors_is_active`, `created_at`, `updated_at`) VALUES
(1, 'Mixes/Multi', '0', 1, '2023-07-08 01:04:14', '2023-07-08 01:04:14'),
(2, 'Black', '1', 1, '2023-07-08 01:04:39', '2023-07-08 01:04:39'),
(3, 'Brown', '2', 1, '2023-07-08 01:04:54', '2023-07-08 01:33:11'),
(4, 'Coffee', '3', 1, '2023-07-09 18:32:41', '2023-07-09 18:32:41'),
(5, 'Ash', '4', 1, '2023-07-09 18:33:04', '2023-07-09 18:33:04'),
(6, 'Red', '5', 1, '2023-07-09 18:33:16', '2023-07-09 18:33:16'),
(7, 'White', '8', 1, '2023-07-09 18:34:33', '2023-07-09 18:34:33'),
(8, 'Blue', '9', 1, '2023-07-09 18:34:45', '2023-07-09 18:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `color_definition`
--

DROP TABLE IF EXISTS `color_definition`;
CREATE TABLE IF NOT EXISTS `color_definition` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `color_name` varchar(64) NOT NULL,
  `color_syblol` varchar(16) NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `color_definition`
--

INSERT INTO `color_definition` (`color_id`, `color_name`, `color_syblol`, `is_active`) VALUES
(1, 'Red', '#FF0000', 0),
(2, 'Cyan', '#00FFFF', 1),
(3, 'Blue', '#0000FF', 0),
(4, 'DarkBlue', '#00008B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `consumer_login`
--

DROP TABLE IF EXISTS `consumer_login`;
CREATE TABLE IF NOT EXISTS `consumer_login` (
  `login_id` int NOT NULL AUTO_INCREMENT,
  `mobile_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`login_id`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumer_login`
--

INSERT INTO `consumer_login` (`login_id`, `mobile_no`) VALUES
(148, '01516705104'),
(149, '01717006925'),
(150, '01717810721'),
(151, '01954667964'),
(152, '01516705114'),
(153, '01309832199'),
(154, '01976203099'),
(155, '01935778149'),
(156, '01922592015'),
(157, 'K  012255566666'),
(158, 'hhh'),
(159, 'Lili 03698741256'),
(160, '01701074878'),
(161, 'Md Hasib( 01956988767)'),
(162, 'Mr Rafi ( 019 )'),
(163, 'Mr x 01912042161'),
(164, 'Mr. Bipu 01712744430'),
(165, '01711123123'),
(166, '01988497126'),
(167, 'Mr. X 0123654789'),
(168, 'Khokon 01919999999'),
(169, 'ABU BOKKOR-01754825555'),
(170, '01711157023'),
(171, 'fergf45tg56y'),
(172, 'fbww3w'),
(173, 'Razib 098765432'),
(174, 'Mr. H 01236547899'),
(175, 'm0225555556'),
(176, 'Tushar 002558899663.'),
(177, 'Mr. V 1234567890'),
(178, 'Asif Ferdous'),
(179, '01684067842sajjad'),
(180, 'M 1233456789'),
(181, '01842079698'),
(182, '436225624'),
(183, '5464564456'),
(184, 'kiuuy12345679'),
(185, 'kjhg23456789'),
(186, '234567890hasan'),
(187, 'mr. p 122336997751');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

DROP TABLE IF EXISTS `customer_payments`;
CREATE TABLE IF NOT EXISTS `customer_payments` (
  `customer_payment_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `sales_info_id` bigint UNSIGNED DEFAULT NULL,
  `payable_amount` double(8,2) DEFAULT NULL,
  `adjustment_amount` double(8,2) DEFAULT NULL,
  `adjust_payable` double(8,2) DEFAULT NULL,
  `paid_amount` double(8,2) DEFAULT NULL,
  `revised_due` double(8,2) DEFAULT NULL,
  `payment_method` int DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`customer_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_payments`
--

INSERT INTO `customer_payments` (`customer_payment_id`, `date`, `customer_id`, `sales_info_id`, `payable_amount`, `adjustment_amount`, `adjust_payable`, `paid_amount`, `revised_due`, `payment_method`, `bank_name`, `cheque_no`, `created_at`, `updated_at`) VALUES
(36, '2023-01-03 07:52:35', 148, 57, 5000.00, NULL, NULL, 5000.00, 0.00, 1, NULL, NULL, '2023-01-03 01:52:36', '2023-01-03 01:52:36'),
(37, '2023-01-03 09:08:31', 148, 58, 3500.00, NULL, NULL, 2700.00, 800.00, 2, NULL, NULL, '2023-01-03 03:08:32', '2023-01-03 03:08:32'),
(38, NULL, 148, NULL, NULL, NULL, NULL, 56325.00, NULL, 2, NULL, NULL, '2023-01-04 06:19:01', '2023-01-04 06:19:01'),
(39, '2023-01-04 13:06:10', 148, 59, 1000.00, NULL, NULL, 1000.00, 0.00, 2, NULL, NULL, '2023-01-04 07:06:10', '2023-01-04 07:06:10'),
(40, '2023-01-05 13:04:17', 148, 60, 1000.00, NULL, NULL, 1000.00, 0.00, 1, NULL, NULL, '2023-01-05 07:04:17', '2023-01-05 07:04:17'),
(41, '2023-01-05 13:05:57', 148, 61, 1500.00, NULL, NULL, 1500.00, 0.00, 1, NULL, NULL, '2023-01-05 07:05:58', '2023-01-05 07:05:58'),
(42, '2023-01-05 15:25:18', 149, 62, 1000.00, NULL, NULL, 1000.00, 0.00, 1, NULL, NULL, '2023-01-05 20:25:18', '2023-01-05 20:25:18'),
(43, '2023-01-05 15:25:57', 150, 63, 1000.00, NULL, NULL, 1000.00, 0.00, 1, NULL, NULL, '2023-01-05 20:25:57', '2023-01-05 20:25:57'),
(44, '2023-01-07 07:47:52', 148, 64, 2000.00, NULL, NULL, 2000.00, 0.00, 1, NULL, NULL, '2023-01-07 12:47:52', '2023-01-07 12:47:52'),
(45, NULL, 149, NULL, NULL, NULL, NULL, 100000.00, NULL, 1, NULL, NULL, '2023-01-17 18:52:20', '2023-01-17 18:52:20'),
(46, '2023-01-19 07:19:07', 151, 65, 5500.00, NULL, NULL, 5500.00, 0.00, 1, NULL, NULL, '2023-01-19 12:19:07', '2023-01-19 12:19:07'),
(47, '2023-01-21 09:03:06', 152, 66, 16000.00, NULL, NULL, 16000.00, 0.00, 2, NULL, NULL, '2023-01-21 14:03:06', '2023-01-21 14:03:06'),
(48, '2023-01-22 12:51:24', 151, 67, 25000.00, NULL, NULL, 25000.00, 0.00, 1, NULL, NULL, '2023-01-22 17:51:24', '2023-01-22 19:09:43'),
(49, '2023-01-22 14:04:19', 151, 68, 12000.00, NULL, NULL, 12000.00, 0.00, 2, NULL, NULL, '2023-01-22 19:04:19', '2023-01-22 19:04:19'),
(50, NULL, 152, NULL, NULL, NULL, NULL, 100000.00, NULL, 1, NULL, NULL, '2023-01-22 19:11:07', '2023-01-22 19:11:07'),
(51, NULL, 151, NULL, NULL, NULL, NULL, 10000.00, NULL, 1, NULL, NULL, '2023-01-22 19:12:54', '2023-01-22 19:12:54'),
(52, '2023-01-23 08:16:18', 153, 69, 8250.00, NULL, NULL, 8250.00, 0.00, 1, NULL, NULL, '2023-01-23 13:16:18', '2023-01-23 13:16:18'),
(53, '2023-01-23 11:12:11', 154, 70, 3240.00, NULL, NULL, 3240.00, 0.00, 1, NULL, NULL, '2023-01-23 16:12:11', '2023-01-23 16:12:11'),
(54, '2023-01-25 14:13:53', 155, 71, 2820.00, NULL, NULL, 2820.00, 0.00, 1, NULL, NULL, '2023-01-25 19:13:53', '2023-01-25 19:13:53'),
(55, '2023-01-26 11:30:38', 151, 72, 110000.00, NULL, NULL, 10000.00, 100000.00, 1, NULL, NULL, '2023-01-26 16:30:38', '2023-01-26 16:30:38'),
(56, '2023-02-11 12:08:40', 156, 73, 112500.00, NULL, NULL, 112500.00, 0.00, 3, NULL, NULL, '2023-02-11 17:08:40', '2023-02-11 17:08:40'),
(57, '2023-02-15 15:31:57', 157, 74, 75000.00, NULL, NULL, 75000.00, 0.00, 1, NULL, NULL, '2023-02-15 20:31:57', '2023-02-15 20:31:57'),
(58, '2023-02-15 15:35:10', 158, 75, 7500.00, NULL, NULL, 7500.00, 0.00, 2, 'Brac', NULL, '2023-02-15 20:35:10', '2023-02-15 20:55:44'),
(59, '2023-02-15 15:38:33', 158, 76, 3000.00, NULL, NULL, 0.00, 3000.00, 1, NULL, NULL, '2023-02-15 20:38:33', '2023-02-15 20:38:33'),
(60, '2023-02-21 05:20:09', 159, 77, 1475.00, NULL, NULL, 1475.00, 0.00, 1, NULL, NULL, '2023-02-21 10:20:09', '2023-02-21 10:20:09'),
(61, '2023-02-28 12:04:50', 160, 78, 680.00, NULL, NULL, 680.00, 0.00, 1, NULL, NULL, '2023-02-28 17:04:50', '2023-02-28 17:04:50'),
(62, '2023-03-01 12:59:02', 161, 79, 31000.00, NULL, NULL, 31000.00, 0.00, 1, NULL, NULL, '2023-03-01 17:59:02', '2023-03-01 17:59:02'),
(63, '2023-03-01 13:00:22', 161, 80, 15500.00, NULL, NULL, 15500.00, 0.00, 1, NULL, NULL, '2023-03-01 18:00:22', '2023-03-01 18:29:16'),
(64, NULL, 158, NULL, NULL, NULL, NULL, 10500.00, NULL, 1, NULL, NULL, '2023-03-01 18:24:31', '2023-03-01 18:24:31'),
(65, NULL, 151, NULL, NULL, NULL, NULL, 100000.00, NULL, 1, NULL, NULL, '2023-03-01 18:27:30', '2023-03-01 18:27:30'),
(66, '2023-03-01 13:55:41', 162, 81, 330000.00, NULL, NULL, 330000.00, 0.00, 1, NULL, NULL, '2023-03-01 18:55:41', '2023-03-01 18:55:41'),
(67, '2023-03-05 05:52:55', 163, 82, 14500.00, NULL, NULL, 14500.00, 0.00, 1, NULL, NULL, '2023-03-05 10:52:55', '2023-03-05 10:52:55'),
(68, '2023-03-07 06:32:51', 164, 83, 520590.00, NULL, NULL, 520590.00, 0.00, 1, NULL, NULL, '2023-03-07 11:32:51', '2023-03-07 11:32:51'),
(69, '2023-03-07 14:56:13', 165, 84, 4400.00, NULL, NULL, 4400.00, 0.00, 1, NULL, NULL, '2023-03-07 19:56:13', '2023-03-07 19:56:13'),
(70, '2023-03-08 09:52:45', 166, 85, 1700.00, NULL, NULL, 1700.00, 0.00, 1, NULL, NULL, '2023-03-08 14:52:45', '2023-03-08 14:52:45'),
(71, '2023-03-09 07:31:20', 155, 86, 12800.00, NULL, NULL, 12800.00, 0.00, 1, NULL, NULL, '2023-03-09 12:31:20', '2023-03-09 12:31:20'),
(72, '2023-03-12 06:13:05', 167, 87, 32500.00, NULL, NULL, 32500.00, 0.00, 1, NULL, NULL, '2023-03-12 10:13:05', '2023-03-12 10:13:05'),
(73, '2023-03-15 08:02:25', 159, 88, 3390.00, NULL, NULL, 3390.00, 0.00, 1, NULL, NULL, '2023-03-15 12:02:25', '2023-03-15 12:02:25'),
(74, '2023-03-21 09:15:09', 160, 89, 870.00, NULL, NULL, 870.00, 0.00, 1, NULL, NULL, '2023-03-21 13:15:09', '2023-03-21 13:15:09'),
(75, '2023-04-01 06:14:16', 169, 91, 9600.00, NULL, NULL, 9600.00, 0.00, 1, NULL, NULL, '2023-04-01 10:14:16', '2023-04-01 10:14:16'),
(76, '2023-04-02 09:08:31', 170, 92, 3100.00, NULL, NULL, 3100.00, 0.00, 1, NULL, NULL, '2023-04-02 13:08:31', '2023-04-02 13:08:31'),
(77, '2023-04-05 09:13:15', 171, 93, 3100.00, NULL, NULL, 3100.00, 0.00, 1, NULL, NULL, '2023-04-05 13:13:15', '2023-04-05 13:13:15'),
(78, '2023-04-05 09:14:19', 172, 94, 3100.00, NULL, NULL, 3100.00, 0.00, 1, NULL, NULL, '2023-04-05 13:14:19', '2023-04-05 13:14:19'),
(79, '2023-04-05 09:15:48', 171, 95, 3100.00, NULL, NULL, 3100.00, 0.00, 1, NULL, NULL, '2023-04-05 13:15:48', '2023-04-05 13:15:48'),
(80, '2023-04-11 05:00:04', 173, 96, 18300.00, NULL, NULL, 18300.00, 0.00, 1, NULL, NULL, '2023-04-11 09:00:04', '2023-04-11 09:00:04'),
(81, '2023-04-27 07:26:58', 174, 97, 65000.00, NULL, NULL, 65000.00, 0.00, 2, NULL, NULL, '2023-04-27 11:26:58', '2023-04-27 11:26:58'),
(82, '2023-05-01 05:32:37', 175, 98, 9300.00, NULL, NULL, 9300.00, 0.00, 1, NULL, NULL, '2023-05-01 09:32:37', '2023-05-01 09:32:37'),
(83, '2023-05-01 05:52:31', 176, 99, 40000.00, NULL, NULL, 40000.00, 0.00, 1, NULL, NULL, '2023-05-01 09:52:31', '2023-05-01 09:52:31'),
(84, '2023-05-01 06:03:51', 176, 100, 129500.00, NULL, NULL, 129500.00, 0.00, 1, NULL, NULL, '2023-05-01 10:03:51', '2023-05-01 10:03:51'),
(85, '2023-05-03 04:13:49', 177, 101, 1200.00, NULL, NULL, 1200.00, 0.00, 1, NULL, NULL, '2023-05-03 08:13:49', '2023-05-03 08:13:49'),
(86, '2023-05-06 11:21:20', 178, 102, 600.00, NULL, NULL, 600.00, 0.00, 1, NULL, NULL, '2023-05-06 15:21:21', '2023-05-06 15:21:21'),
(87, '2023-05-11 13:15:11', 179, 103, 9700.00, NULL, NULL, 9700.00, 0.00, 1, NULL, NULL, '2023-05-11 17:15:11', '2023-05-11 17:15:11'),
(88, '2023-05-11 13:37:33', 179, 104, 19400.00, NULL, NULL, 19400.00, 0.00, 1, NULL, NULL, '2023-05-11 17:37:33', '2023-05-11 17:37:33'),
(89, '2023-05-22 07:17:52', 180, 105, 12000.00, NULL, NULL, 12000.00, 0.00, 1, NULL, NULL, '2023-05-22 11:17:52', '2023-05-22 11:17:52'),
(90, '2023-05-24 10:55:46', 160, 106, 640.00, NULL, NULL, 640.00, 0.00, 1, NULL, NULL, '2023-05-24 14:55:46', '2023-05-24 14:55:46'),
(91, '2023-05-24 10:59:19', 160, 107, 4000.00, NULL, NULL, 4000.00, 0.00, 1, NULL, NULL, '2023-05-24 14:59:19', '2023-05-24 14:59:19'),
(92, '2023-05-24 12:39:33', 160, 108, 2920.00, NULL, NULL, 2920.00, 0.00, 1, NULL, NULL, '2023-05-24 16:39:33', '2023-05-24 16:39:33'),
(93, '2023-05-24 12:47:47', 160, 109, 6288.00, NULL, NULL, 6288.00, 0.00, 1, NULL, NULL, '2023-05-24 16:47:47', '2023-05-24 16:47:47'),
(94, '2023-05-24 12:48:14', 160, 110, 1460.00, NULL, NULL, 1460.00, 0.00, 1, NULL, NULL, '2023-05-24 16:48:14', '2023-05-24 16:48:14'),
(95, '2023-05-24 14:41:50', 181, 111, 1005.00, NULL, NULL, 1005.00, 0.00, 1, NULL, NULL, '2023-05-24 18:41:50', '2023-05-24 18:41:50'),
(96, '2023-05-25 07:50:05', 181, 112, 2510.00, NULL, NULL, 2510.00, 0.00, 1, NULL, NULL, '2023-05-25 11:50:05', '2023-05-25 11:50:05'),
(97, '2023-05-25 08:15:33', 182, 113, 1460.00, NULL, NULL, 1460.00, 0.00, 1, NULL, NULL, '2023-05-25 12:15:33', '2023-05-25 12:15:33'),
(98, '2023-05-28 09:31:12', 160, 114, 500.00, NULL, NULL, 500.00, 0.00, 1, NULL, NULL, '2023-05-28 13:31:12', '2023-05-28 13:31:12'),
(99, '2023-05-28 09:32:02', 183, 115, 1155.00, NULL, NULL, 1155.00, 0.00, 1, NULL, NULL, '2023-05-28 13:32:02', '2023-05-28 13:32:02'),
(100, '2023-05-28 09:36:39', 184, 116, 7000.00, NULL, NULL, 7000.00, 0.00, 1, NULL, NULL, '2023-05-28 13:36:39', '2023-05-28 13:36:39'),
(101, '2023-05-31 08:18:45', 185, 117, 70000.00, NULL, NULL, 500.00, 69500.00, 1, NULL, NULL, '2023-05-31 12:18:45', '2023-05-31 12:18:45'),
(102, '2023-06-13 06:37:57', 186, 118, 16200.00, NULL, NULL, 16200.00, 0.00, 1, NULL, NULL, '2023-06-13 10:37:57', '2023-06-13 10:37:57'),
(103, '2023-06-17 06:22:16', 187, 119, 4680.00, NULL, NULL, 4680.00, 0.00, 1, NULL, NULL, '2023-06-17 10:22:16', '2023-06-17 10:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `day_end_balance`
--

DROP TABLE IF EXISTS `day_end_balance`;
CREATE TABLE IF NOT EXISTS `day_end_balance` (
  `day_end_balance_id` int NOT NULL AUTO_INCREMENT,
  `date` varchar(128) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `opening_balance` double DEFAULT NULL,
  `total_sales` double DEFAULT NULL,
  `sales_paid_amount` double DEFAULT NULL,
  `sales_due_amount` double DEFAULT NULL,
  `cash_in` double DEFAULT NULL,
  `total_purchase` double DEFAULT NULL,
  `purchase_paid_amount` double DEFAULT NULL,
  `purchase_due_amount` double DEFAULT NULL,
  `total_expense` double DEFAULT NULL,
  `cash_out` double DEFAULT NULL,
  `closing_balance` double DEFAULT NULL,
  `is_closed` int DEFAULT NULL,
  PRIMARY KEY (`day_end_balance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `day_end_balance`
--

INSERT INTO `day_end_balance` (`day_end_balance_id`, `date`, `opening_balance`, `total_sales`, `sales_paid_amount`, `sales_due_amount`, `cash_in`, `total_purchase`, `purchase_paid_amount`, `purchase_due_amount`, `total_expense`, `cash_out`, `closing_balance`, `is_closed`) VALUES
(5, NULL, 1000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1000, NULL),
(6, '2023-05-03', 1000, 1200, 1200, 0, 1200, 5000, 5000, 0, 0, 55000, -52800, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `delivery_status_definition`
--

DROP TABLE IF EXISTS `delivery_status_definition`;
CREATE TABLE IF NOT EXISTS `delivery_status_definition` (
  `delivery_status_id` int NOT NULL AUTO_INCREMENT,
  `delivery_status` varchar(256) NOT NULL,
  `delivery_status_client` varchar(256) DEFAULT NULL,
  `delivery_status_symbol` varchar(16) NOT NULL,
  `is_active` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`delivery_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `delivery_status_definition`
--

INSERT INTO `delivery_status_definition` (`delivery_status_id`, `delivery_status`, `delivery_status_client`, `delivery_status_symbol`, `is_active`) VALUES
(1, 'Cart Checked Out', 'Awaiting Order Placement', 'CCO', 1),
(2, 'Order Placed', 'Awaiting For Approval', 'OP', 1),
(3, 'Cart Accepted and escallated to Warehouse', 'Your order is being processed', 'CADW', 1),
(4, 'Waiting for Administrator Confirmation', 'Your order is being processed', 'WAC', 1),
(5, 'Waiting For Delivery Agency Confirmation', 'Your order is being processed', 'WAGF', 1),
(6, 'Parcel Handedover to delivery agent', 'Your order is on the way', 'PHTA', 1),
(7, 'Product Delivered and Payment Collected', 'Your order is delivered', 'PDPC', 1),
(8, 'Delivery Completted', 'Your order is delivered', 'DC', 1),
(9, 'Order Cancelled', 'Order Cancelled', 'DOC', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `expense_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expense_category_id` bigint UNSIGNED DEFAULT NULL,
  `is_default` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expense_id`, `expense_name`, `expense_category_id`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(11, 'EB', 6, NULL, NULL, '2023-01-05 07:24:02', '2023-01-05 07:24:02'),
(12, 'EB', 6, NULL, NULL, '2023-01-14 15:44:46', '2023-01-14 15:44:46'),
(13, 'ES', 6, NULL, NULL, '2023-01-14 16:45:37', '2023-01-14 16:46:23'),
(14, 'E', 6, NULL, NULL, '2023-01-17 18:56:09', '2023-01-17 18:56:09'),
(15, 'Internet Bill', 6, NULL, NULL, '2023-02-06 12:03:00', '2023-02-06 12:03:00'),
(16, 'Geeky Cloud', 8, NULL, NULL, '2023-02-06 12:06:25', '2023-02-06 12:06:25'),
(17, 'Bill', 9, NULL, NULL, '2023-02-06 18:33:31', '2023-02-06 18:33:31'),
(18, 'Entertainment', 10, NULL, NULL, '2023-02-11 17:46:48', '2023-02-11 17:46:48'),
(19, 'Electricity Bill', 6, NULL, NULL, '2023-03-15 13:15:58', '2023-03-15 13:15:58'),
(20, 'gdfgdf', 8, NULL, NULL, '2023-03-18 11:35:29', '2023-03-18 11:35:29'),
(21, 'tyfghdfgh', 6, NULL, NULL, '2023-03-20 13:10:33', '2023-03-20 13:10:33'),
(22, 'Hhhhhh', 12, NULL, NULL, '2023-04-11 09:28:12', '2023-04-11 09:28:12'),
(23, 'tea cost', 10, NULL, NULL, '2023-05-06 15:30:41', '2023-05-06 15:30:41'),
(24, 'Bill', 6, NULL, NULL, '2023-05-24 15:32:30', '2023-05-24 15:32:30'),
(25, 'salay', 7, NULL, NULL, '2023-05-24 15:35:30', '2023-05-24 15:35:30'),
(26, 'Entertainment', 10, NULL, NULL, '2023-06-17 10:33:39', '2023-06-17 10:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `expense_categories`
--

DROP TABLE IF EXISTS `expense_categories`;
CREATE TABLE IF NOT EXISTS `expense_categories` (
  `expense_category_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` int DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_categories`
--

INSERT INTO `expense_categories` (`expense_category_id`, `expense_category_name`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(6, 'Electricity Bill', 0, 1, NULL, NULL),
(7, 'Employee Salary', 1, 1, NULL, NULL),
(8, 'Internet Bill', 1, 1, NULL, NULL),
(9, 'Internet Bill', 1, 1, NULL, NULL),
(10, 'Tea Cost', 1, 1, NULL, NULL),
(11, 'Water Bill', 1, 1, NULL, NULL),
(12, 'Transport Bill', 0, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `expense_details`
--

DROP TABLE IF EXISTS `expense_details`;
CREATE TABLE IF NOT EXISTS `expense_details` (
  `expense_details_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_id` bigint UNSIGNED NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_vat_show` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`expense_details_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expense_details`
--

INSERT INTO `expense_details` (`expense_details_id`, `expense_id`, `date`, `amount`, `notes`, `is_vat_show`, `created_at`, `updated_at`) VALUES
(11, 11, '2023-01-05', 1000.00, 'EB', 1, '2023-01-05 07:24:03', '2023-05-24 14:44:19'),
(12, 12, '2023-01-14', 500.00, 'EB', 1, '2023-01-14 15:44:46', '2023-05-24 14:44:19'),
(13, 13, '2023-01-14', 100.00, 'ES', NULL, '2023-01-14 16:45:37', '2023-01-14 16:47:45'),
(14, 14, '2023-01-17', 1000.00, 'EB', NULL, '2023-01-17 18:56:09', '2023-01-17 18:56:09'),
(15, 15, '2023-02-06', 500.00, 'net', NULL, '2023-02-06 12:03:00', '2023-02-06 12:03:00'),
(16, 16, '2023-02-06', 500.00, 'February', NULL, '2023-02-06 12:06:25', '2023-02-06 12:06:25'),
(17, 17, '2023-02-06', 30.00, 'Test', NULL, '2023-02-06 18:33:31', '2023-02-06 18:33:31'),
(18, 18, '2023-02-11', 10.00, 'Mr. Motin', NULL, '2023-02-11 17:46:48', '2023-02-11 17:46:48'),
(19, 19, '2023-03-15', 1476.00, 'OK', NULL, '2023-03-15 13:15:58', '2023-03-15 13:15:58'),
(20, 20, '2023-03-18', 566.00, 'okk', NULL, '2023-03-18 11:35:29', '2023-03-18 11:35:29'),
(21, 21, '2023-03-20', 15490.00, 'sdrgsdfgds', NULL, '2023-03-20 13:10:33', '2023-03-20 13:10:33'),
(22, 22, '2023-04-11', 200.00, 'X', NULL, '2023-04-11 09:28:12', '2023-04-11 09:28:12'),
(23, 23, '2023-05-06', 200.00, 'h;oj', NULL, '2023-05-06 15:30:41', '2023-05-06 15:30:41'),
(24, 24, '2023-05-24', 1000.00, 'bill', NULL, '2023-05-24 15:32:30', '2023-05-24 15:32:30'),
(25, 25, '2023-05-24', 50000.00, 'salary', 1, '2023-05-24 15:35:30', '2023-05-24 15:37:11'),
(26, 26, '2023-06-17', 100.00, 'ok', NULL, '2023-06-17 10:33:39', '2023-06-17 10:33:39');

-- --------------------------------------------------------

--
-- Table structure for table `final_stock_table`
--

DROP TABLE IF EXISTS `final_stock_table`;
CREATE TABLE IF NOT EXISTS `final_stock_table` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `total_purchased_quantity` float DEFAULT NULL,
  `total_sold_quantity` float DEFAULT NULL,
  `total_ordered_quantity` float DEFAULT NULL,
  `in_order_queue` float DEFAULT NULL,
  `temp_quantity` float DEFAULT NULL,
  `final_quantity` float DEFAULT NULL,
  `purchase_id` int DEFAULT NULL,
  `purchase_price` double NOT NULL DEFAULT '0',
  `wholesale_price` double NOT NULL DEFAULT '0',
  `sales_price` double NOT NULL DEFAULT '0',
  `store_id` int DEFAULT NULL,
  `colors_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `article` varchar(40) NOT NULL,
  PRIMARY KEY (`stock_id`),
  KEY `product_id` (`product_id`),
  KEY `purchase_id` (`purchase_id`),
  KEY `colors_id` (`colors_id`),
  KEY `size_id` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=295 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_stock_table`
--

INSERT INTO `final_stock_table` (`stock_id`, `product_id`, `total_purchased_quantity`, `total_sold_quantity`, `total_ordered_quantity`, `in_order_queue`, `temp_quantity`, `final_quantity`, `purchase_id`, `purchase_price`, `wholesale_price`, `sales_price`, `store_id`, `colors_id`, `size_id`, `article`) VALUES
(219, 1, 50, 3, 0, 0, 47, 0, 131, 700, 900, 1000, 1, 0, 0, ''),
(220, 1, 50, 4, 0, 0, 46, 46, 132, 750, 900, 1500, 1, 0, 0, ''),
(221, 1, 3, 0, 0, 0, 3, 19, 133, 700, 900, 1000, 8, 0, 0, ''),
(222, 2, 3, 0, 0, 0, 3, 2, 133, 700, 900, 1000, 8, 0, 0, ''),
(223, 19, 10, 0, 0, 0, 10, 10, 137, 700, 900, 1000, 1, 0, 0, ''),
(224, 37, 10, 0, 0, 0, 10, 10, 137, 100, 150, 200, 1, 0, 0, ''),
(225, 158, 200, 115, 0, 0, 85, 85, 138, 1000, 1100, 1200, 13, 0, 0, ''),
(226, 159, 50, 1, 0, 0, 49, 49, 139, 15000, 14000, 16000, 2, 0, 0, ''),
(227, 1, 50, 0, 0, 0, 50, 0, 140, 700, 900, 1000, 12, 0, 0, ''),
(228, 160, 10, 1, 0, 0, 9, 9, 141, 20000, 22000, 25000, 15, 0, 0, ''),
(229, 162, 50, 0, 0, 0, 50, 50, 142, 15000, 20000, 25000, 15, 0, 0, ''),
(230, 165, 20, 0, 0, 0, 20, 10, 143, 30000, 35000, 40000, 15, 0, 0, ''),
(231, 164, 10, 0, 0, 0, 10, 10, 144, 50000, 75000, 100000, 15, 0, 0, ''),
(232, 165, NULL, NULL, NULL, NULL, NULL, 10, NULL, 0, 0, 0, 14, 0, 0, ''),
(233, 166, 150, 17, 0, 0, 133, 133, 145, 400, 450, 550, 2, 0, 0, ''),
(234, 167, 50, 1, 0, 0, 49, 49, 146, 1500, 1800, 2200, 15, 0, 0, ''),
(235, 168, 200, 0, 0, 0, 200, 200, 147, 120, 130, 150, 2, 0, 0, ''),
(236, 168, 200, 0, 0, 0, 200, 200, 148, 120, 130, 150, 2, 0, 0, ''),
(237, 169, 20, 2, 0, 0, 18, 18, 149, 1000, 1200, 1500, 4, 0, 0, ''),
(238, 1, NULL, NULL, NULL, NULL, NULL, 75, NULL, 0, 0, 0, 2, 0, 0, ''),
(239, 170, 20, 0, 0, 0, 20, 6, 150, 1500, 1450, 1550, 9, 0, 0, ''),
(240, 170, NULL, NULL, NULL, NULL, NULL, 14, NULL, 0, 0, 0, 1, 0, 0, ''),
(241, 170, NULL, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, 0, 4, 0, 0, ''),
(242, 171, 100, 30, 0, 0, 70, 70, 151, 3500, 3750, 4000, 13, 0, 0, ''),
(243, 172, 100, 0, 0, 0, 100, 0, 152, 1800, 2000, 2200, 16, 0, 0, ''),
(244, 172, NULL, NULL, NULL, NULL, NULL, 100, NULL, 0, 0, 0, 17, 0, 0, ''),
(245, 173, 100, 0, 0, 0, 100, 100, 153, 10, 9, 12, 3, 0, 0, ''),
(246, 174, 100, 57, 0, 0, 43, 43, 154, 1000, 1200, 1500, 15, 0, 0, ''),
(247, 175, 50, 5, 0, 0, 45, 45, 155, 200, 250, 300, 18, 0, 0, ''),
(248, 176, 50, 0, 0, 0, 50, 50, 156, 250, 220, 300, 18, 0, 0, ''),
(249, 178, 1, 1, 0, 0, 0, 1, 157, 120, 140, 180, 4, 0, 0, ''),
(250, 179, 20, 22, 0, 0, -2, -2, 158, 200, 220, 250, 6, 0, 0, ''),
(251, 178, 30, 10, 0, 0, 20, 19, 159, 120, 140, 190, 2, 0, 0, ''),
(252, 180, 20, 20, 0, 0, 0, 0, 160, 3000, 3050, 3100, 3, 0, 0, ''),
(253, 180, 30, 30, 0, 0, 0, 0, 161, 10000, 10050, 11000, 3, 0, 0, ''),
(254, 180, 10, 10, 0, 0, 0, 0, 162, 3000, 3050, 3100, 3, 0, 0, ''),
(255, 180, 5, 5, 0, 0, 0, 0, 163, 3000, 3050, 3100, 3, 0, 0, ''),
(256, 180, 10, 23, 0, 0, -13, -13, 164, 3400, 3450, 3500, 3, 0, 0, ''),
(257, 180, 5, 2, 0, 0, 3, 3, 165, 2500, 2550, 2600, 3, 0, 0, ''),
(258, 180, 100, 130, 0, 0, -30, -30, 166, 3600, 0, 3850, 6, 0, 0, ''),
(259, 180, 20, 15, 0, 0, 5, 5, 167, 5800, 6000, 6500, 15, 0, 0, ''),
(260, 180, 50, 4, 0, 0, 46, 46, 168, 800, 900, 1000, 2, 0, 0, ''),
(261, 183, 5, 1, 0, 0, 4, 4, 169, 9300, 9500, 9700, 2, 0, 0, ''),
(262, 2, NULL, NULL, NULL, NULL, NULL, 1, NULL, 0, 0, 0, 19, 0, 0, ''),
(263, 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, 0, 0, 0, 19, 0, 0, ''),
(264, 179, 50, 0, 0, 0, 50, 50, 170, 80, 90, 0, 15, 0, 0, ''),
(265, 184, 1000, 1000, 0, 0, 0, 0, 171, 60, 80, 85, 2, 0, 0, ''),
(266, 184, 10000, 1000, 0, 0, 9000, 9000, 172, 62, 82, 87, 3, 0, 0, ''),
(267, 185, 100, 20, 0, 0, 80, 80, 173, 50, 55, 60, 3, 0, 0, ''),
(268, 186, 100, 0, 0, 0, 100, 100, 174, 1000, 1200, 1800, 21, 0, 0, ''),
(269, 187, 50, 40, 0, 0, 10, 10, 175, 220, 250, 300, 16, 0, 0, ''),
(270, 179, 10, 2, 0, 0, 8, 8, 176, 200, 250, 320, 2, 0, 0, ''),
(271, 191, 10, 6, 0, 0, 4, 4, 177, 580, 650, 800, 14, 0, 0, ''),
(272, 192, 10, 6, 0, 0, 4, 4, 177, 450, 500, 650, 14, 0, 0, ''),
(273, 188, 12, 4, 0, 0, 8, 8, 178, 700, 750, 1000, 12, 0, 0, ''),
(274, 189, 8, 1, 0, 0, 7, 7, 178, 850, 950, 1350, 12, 0, 0, ''),
(275, 188, 10, 0, 0, 0, 10, 8, 179, 530, 650, 800, 21, 0, 0, ''),
(276, 188, NULL, NULL, NULL, NULL, NULL, 2, NULL, 0, 0, 0, 3, 0, 0, ''),
(277, 189, 5, 0, 0, 0, 5, 5, 180, 800, 950, 1350, 21, 0, 0, ''),
(278, 190, 5, 1, 0, 0, 4, 4, 180, 950, 1100, 1500, 21, 0, 0, ''),
(279, 199, 100, 3, 0, 0, 97, 97, 181, 50, 80, 100, 14, 0, 0, ''),
(280, 200, 100, 2, 0, 0, 98, 98, 181, 50, 80, 100, 14, 0, 0, ''),
(281, 197, 15, 0, 0, 0, 15, 15, 182, 350, 380, 500, 14, 0, 0, ''),
(282, 198, 10, 0, 0, 0, 10, 10, 182, 450, 500, 650, 14, 0, 0, ''),
(283, 187, 5, 0, 0, 0, 5, 5, 183, 300, 350, 400, 15, 0, 0, ''),
(284, 180, 50, 0, 0, 0, 50, 50, 184, 1000, 1100, 1200, 6, 0, 0, ''),
(285, 201, 50, 20, 0, 0, 30, 30, 185, 500, 700, 900, 22, 0, 0, ''),
(286, 202, 100, 0, 0, 0, 100, 100, 186, 1290, 1400, 1600, 2, 0, 0, ''),
(292, 3, 8, 0, 0, 0, 8, 8, 197, 8, 8, 8, 9, 4, 2, '01'),
(293, 3, 2, 0, 0, 0, 2, 2, 198, 2, 2, 2, 10, 1, 1, '01'),
(294, 3, 1, 0, 0, 0, 1, 1, 199, 1, 1, 1, 5, 1, 1, '01');

-- --------------------------------------------------------

--
-- Table structure for table `foot_ware_categories`
--

DROP TABLE IF EXISTS `foot_ware_categories`;
CREATE TABLE IF NOT EXISTS `foot_ware_categories` (
  `foot_ware_categories_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `foot_ware_categories_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foot_ware_categories_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foot_ware_categories_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`foot_ware_categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foot_ware_categories`
--

INSERT INTO `foot_ware_categories` (`foot_ware_categories_id`, `foot_ware_categories_name`, `foot_ware_categories_code`, `foot_ware_categories_is_active`, `created_at`, `updated_at`) VALUES
(1, 'Non Foot Ware', '0', 1, '2023-07-09 18:09:29', '2023-07-09 18:21:45'),
(2, 'Children 0 to 1', '1', 1, '2023-07-09 18:22:52', '2023-07-09 18:22:52'),
(3, 'Children 2 to 3', '2', 1, '2023-07-09 18:23:09', '2023-07-09 18:23:09'),
(4, 'Children 3 to 4', '3', 1, '2023-07-09 18:23:29', '2023-07-09 18:23:29'),
(5, 'Children 4 to 5', '4', 1, '2023-07-09 18:23:48', '2023-07-09 18:23:48'),
(6, 'Children 5 to 10', '5', 1, '2023-07-09 18:24:05', '2023-07-09 18:24:05'),
(7, 'Ladies Flat', '6', 1, '2023-07-09 18:25:04', '2023-07-09 18:25:04'),
(8, 'Ladies Short Hill', '7', 1, '2023-07-09 18:25:28', '2023-07-09 18:25:28'),
(9, 'Ladies High Hill', '8', 1, '2023-07-09 18:25:44', '2023-07-09 18:25:44'),
(10, 'Mens', '9', 1, '2023-07-09 18:26:04', '2023-07-09 18:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `material_types`
--

DROP TABLE IF EXISTS `material_types`;
CREATE TABLE IF NOT EXISTS `material_types` (
  `material_type_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `material_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_type_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `material_type_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`material_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_types`
--

INSERT INTO `material_types` (`material_type_id`, `material_type_name`, `material_type_code`, `material_type_is_active`, `created_at`, `updated_at`) VALUES
(1, 'Leather', '1', 1, '2023-07-08 00:36:18', '2023-07-08 00:49:10'),
(2, 'Synthetic', '5', 1, '2023-07-08 00:36:37', '2023-07-08 00:36:37'),
(3, 'Textile/Fabric', '6', 1, '2023-07-08 00:37:21', '2023-07-08 00:37:21');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_12_01_095421_create_purchase_details_table', 1),
(3, '2022_12_01_095421_create_purchase_info_table', 1),
(4, '2022_12_03_102056_create_supplier_payments_table', 1),
(5, '2022_12_03_103404_create_sales_infos_table', 1),
(6, '2022_12_03_104101_create_sales_details_table', 1),
(7, '2022_12_03_104557_create_customer_payments_table', 1),
(8, '2022_12_03_111742_create_stores_table', 1),
(9, '2022_12_03_112041_create_expense_categories_table', 1),
(10, '2022_12_03_112627_create_expenses_table', 1),
(11, '2022_12_03_113026_create_expense_details_table', 1),
(12, '2022_12_01_095714_create_purchase_temporaries_table', 2),
(13, '2022_12_01_095752_create_purchase_temporary_items_table', 2),
(14, '2023_07_08_100326_create_types_table', 3),
(15, '2023_07_08_100428_create_material_types_table', 4),
(16, '2023_07_08_100642_create_brand_types_table', 5),
(17, '2023_07_08_100716_create_sizes_table', 6),
(18, '2023_07_08_101440_create_colors_table', 7),
(19, '2023_07_10_054601_create_foot_ware_categories_table', 8),
(20, '2023_07_10_064449_create_product_materials_table', 9),
(21, '2023_07_10_103639_create_purchase_news_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int DEFAULT NULL,
  `sc_one_id` int DEFAULT NULL,
  `attribute_id` varchar(255) DEFAULT NULL,
  `product_name` varchar(512) NOT NULL,
  `avg_rating` varchar(11) DEFAULT NULL,
  `product_description` text,
  `unit_type` int NOT NULL,
  `image_path` text,
  `product_image` varchar(255) DEFAULT 'kaynat.jpeg',
  `sku_no` varchar(11) DEFAULT NULL,
  `is_active` int NOT NULL,
  `cost_price` float NOT NULL DEFAULT '0',
  `bulk_price` float NOT NULL DEFAULT '0',
  `sales_price` float NOT NULL DEFAULT '0',
  `vat` float NOT NULL DEFAULT '0',
  `barcode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `sc_one_id`, `attribute_id`, `product_name`, `avg_rating`, `product_description`, `unit_type`, `image_path`, `product_image`, `sku_no`, `is_active`, `cost_price`, `bulk_price`, `sales_price`, `vat`, `barcode`) VALUES
(1, 1, NULL, NULL, 'Viral Bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 400, 450, 520, 0, '0001'),
(2, 1, NULL, NULL, 'Box Bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 700, 720, 800, 0, '0002'),
(3, 1, NULL, NULL, 'Chain demo', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 100, 130, 200, 0, '0003'),
(4, 1, NULL, NULL, 'jute bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 300, 300, 350, 0, '0004'),
(5, 1, NULL, NULL, 'viral bag 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 400, 450, 550, 0, '0005'),
(6, 1, NULL, NULL, 'folding bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 300, 350, 0, '0006'),
(7, 1, NULL, NULL, 'tea tree facewash', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 220, 260, 320, 0, '0007'),
(8, 1, NULL, NULL, 'tecnic bronzer,highlighter,blush', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 180, 210, 230, 0, '0008'),
(9, 2, NULL, NULL, 'lip gloss', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 45, 55, 75, 0, '0009'),
(10, 2, NULL, NULL, 'genji', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 130, 150, 150, 0, '0010'),
(11, 2, NULL, NULL, 'tecnic eyeshadow', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 340, 350, 400, 0, '0011'),
(12, 2, NULL, NULL, 'plazzu', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 105, 120, 150, 0, '0012'),
(13, 2, NULL, NULL, 'skart', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 135, 160, 200, 0, '0013'),
(14, 2, NULL, NULL, 'party bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 950, 1200, 1200, 0, '0014'),
(15, 2, NULL, NULL, 'dubai gold earring', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 200, 250, 280, 0, '0015'),
(16, 1, NULL, NULL, 'party bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 650, 650, 750, 0, '0016'),
(17, 5, NULL, NULL, 'earring', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 90, 120, 0, '0017'),
(18, 5, NULL, NULL, 'gajra eartop', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 120, 160, 0, '0018'),
(19, 8, NULL, NULL, 'clip set', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/images/product/231122clip.jpg', '231122clip.jpg', NULL, 1, 130, 160, 200, 0, '0019'),
(20, 9, NULL, NULL, 'travel bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 580, 750, 950, 0, '0020'),
(21, 9, NULL, NULL, 'travel bag small', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 550, 700, 800, 0, '0021'),
(22, 9, NULL, NULL, 'cat bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 780, 900, 1200, 0, '0022'),
(23, 1, NULL, NULL, 'box bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 700, 950, 1200, 0, '0023'),
(24, 1, NULL, NULL, 'party bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 850, 950, 1200, 0, '0024'),
(25, 10, NULL, NULL, 'daisy bag 1', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 280, 330, 400, 0, '0025'),
(26, 10, NULL, NULL, 'bag with bagpack', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 280, 320, 420, 0, '0026'),
(27, 1, NULL, NULL, 'purse', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 950, 970, 1400, 0, '0027'),
(28, 1, NULL, NULL, 'purse 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1000, 1050, 1200, 0, '0028'),
(29, 10, NULL, NULL, 'make up bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 230, 270, 300, 0, '0029'),
(30, 10, NULL, NULL, 'bottle bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 320, 400, 500, 0, '0030'),
(31, 10, NULL, NULL, 'daisy bag 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 300, 400, 0, '0031'),
(32, 10, NULL, NULL, 'bagpack', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 770, 850, 950, 0, '0032'),
(33, 1, NULL, NULL, 'box bag 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 950, 1050, 1350, 0, '0033'),
(34, 1, NULL, NULL, 'house bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1100, 1300, 1600, 0, '0034'),
(35, 1, NULL, NULL, 'Lv bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1199, 1300, 1400, 0, '0035'),
(36, 10, NULL, NULL, 'make up bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 450, 540, 650, 0, '0036'),
(37, 8, NULL, NULL, 'clip set 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 110, 130, 220, 0, '0037'),
(38, 10, NULL, NULL, 'bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 280, 380, 0, '0038'),
(39, 8, NULL, NULL, 'clip set 3', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 130, 160, 220, 0, '0039'),
(40, 2, NULL, NULL, 'school bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 800, 1200, 1500, 0, '0040'),
(41, 10, NULL, NULL, 'fur bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 450, 450, 500, 0, '0041'),
(42, 10, NULL, NULL, 'print bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 350, 350, 400, 0, '0042'),
(43, 1, NULL, NULL, 'bag 1', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 300, 350, 400, 0, '0043'),
(44, 10, NULL, NULL, 'bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 500, 550, 650, 0, '0044'),
(45, 10, NULL, NULL, 'wallet', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 250, 270, 0, '0045'),
(46, 10, NULL, NULL, 'wallet 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 400, 400, 450, 0, '0046'),
(47, 10, NULL, NULL, 'mobile bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 200, 250, 0, '0047'),
(48, 10, NULL, NULL, 'hanger', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 180, 200, 200, 0, '0048'),
(49, 1, NULL, NULL, 'face bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1100, 1300, 1500, 0, '0049'),
(50, 10, NULL, NULL, 'color bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 400, 450, 500, 0, '0050'),
(51, 10, NULL, NULL, 'cute bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 300, 350, 350, 0, '0051'),
(52, 20, NULL, NULL, 'bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 0, 300, 300, 350, 0, '0052'),
(53, 3, NULL, NULL, 'purse bag 3', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 500, 540, 600, 0, '0053'),
(54, 8, NULL, NULL, 'clip set 4', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 180, 240, 0, '0054'),
(55, 8, NULL, NULL, 'clip set 5', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 160, 190, 250, 0, '0055'),
(56, 1, NULL, NULL, 'box party bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 800, 1000, 1200, 0, '0056'),
(57, 10, NULL, NULL, 'pad bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 100, 150, 0, '0057'),
(58, 10, NULL, NULL, 'bag pack 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 300, 350, 350, 0, '0058'),
(59, 10, NULL, NULL, 'bagpack 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 380, 430, 480, 0, '0059'),
(60, 10, NULL, NULL, 'pencil bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 100, 120, 150, 0, '0060'),
(61, 10, NULL, NULL, 'black white bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 440, 500, 550, 0, '0061'),
(62, 1, NULL, NULL, 'red dress', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 900, 950, 950, 0, '0062'),
(63, 5, NULL, NULL, 'baby set', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 750, 850, 850, 0, '0063'),
(64, 5, NULL, NULL, 'blue rupangel', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1250, 1400, 1400, 0, '0064'),
(65, 4, NULL, NULL, 'large bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 800, 1000, 1400, 0, '0065'),
(66, 8, NULL, NULL, 'yellow dress', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 750, 800, 850, 0, '0066'),
(67, 8, NULL, NULL, 'silk scarf', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 420, 480, 520, 0, '0067'),
(68, 8, NULL, NULL, 'moslin scarf', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 450, 500, 550, 0, '0068'),
(69, 8, NULL, NULL, 'small scarf', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 250, 250, 0, '0069'),
(70, 8, NULL, NULL, 'juta', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 800, 850, 850, 0, '0070'),
(71, 6, NULL, NULL, 'churi', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 350, 400, 450, 0, '0071'),
(72, 8, NULL, NULL, 'clip set 6', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 180, 200, 250, 0, '0072'),
(73, 8, NULL, NULL, 'coin bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 120, 120, 0, '0073'),
(74, 6, NULL, NULL, 'jar', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 150, 150, 0, '0074'),
(75, 8, NULL, NULL, 'clip set 7', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 200, 200, 250, 0, '0075'),
(76, 7, NULL, NULL, 'juta', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 560, 650, 750, 0, '0076'),
(77, 6, NULL, NULL, 'daimond cut churi', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1380, 1500, 1650, 0, '0077'),
(78, 6, NULL, NULL, 'mirror', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 110, 140, 180, 0, '0078'),
(79, 14, NULL, NULL, 'mirror 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 120, 150, 0, '0079'),
(80, 15, NULL, NULL, 'churi', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 260, 300, 350, 0, '0080'),
(81, 15, NULL, NULL, 'brooch set', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 140, 160, 180, 0, '0081'),
(82, 14, NULL, NULL, 'pen', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 500, 600, 600, 0, '0082'),
(83, 15, NULL, NULL, 'moon brooch', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 160, 250, 250, 0, '0083'),
(84, 14, NULL, NULL, 'tape', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 120, 120, 150, 0, '0084'),
(85, 15, NULL, NULL, 'crown brooch', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 100, 120, 150, 0, '0085'),
(86, 13, NULL, NULL, 'juta', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1100, 1250, 1250, 0, '0086'),
(87, 13, NULL, NULL, 'shoe', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 450, 550, 600, 0, '0087'),
(88, 15, NULL, NULL, 'brooch 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 200, 250, 0, '0088'),
(89, 15, NULL, NULL, 'brooch 3', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 130, 180, 240, 0, '0089'),
(90, 15, NULL, NULL, 'brooch 4', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 180, 250, 0, '0090'),
(91, 15, NULL, NULL, 'brooch 5', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 130, 160, 240, 0, '0091'),
(92, 15, NULL, NULL, 'brooch 6', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 80, 110, 150, 0, '0092'),
(93, 15, NULL, NULL, 'brooch 7', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 200, 260, 0, '0093'),
(94, 15, NULL, NULL, 'brooch 9', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 140, 160, 200, 0, '0094'),
(95, 14, NULL, NULL, 'huggies', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 1500, 1550, 1580, 0, '0095'),
(96, 14, NULL, NULL, 'twinkle', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 580, 620, 650, 0, '0096'),
(97, 14, NULL, NULL, 'urine alarm', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 110, 120, 160, 0, '0097'),
(98, 6, NULL, NULL, 'facewash', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 330, 350, 400, 0, '0098'),
(99, 14, NULL, NULL, 'twinkle tissue', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 185, 210, 230, 0, '0099'),
(100, 14, NULL, NULL, 'neo care', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 165, 185, 210, 0, '0100'),
(101, 6, NULL, NULL, 'lafz roller', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 120, 150, 0, '0101'),
(102, 14, NULL, NULL, 'hot water pot', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 60, 75, 90, 0, '0102'),
(103, 14, NULL, NULL, 'soap holder', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 120, 140, 160, 0, '0103'),
(104, 15, NULL, NULL, 'earring', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 300, 350, 0, '0104'),
(105, 6, NULL, NULL, 'false nail', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 110, 130, 180, 0, '0105'),
(106, 6, NULL, NULL, 'dove lotion', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 550, 650, 700, 0, '0106'),
(107, 6, NULL, NULL, 'neutrogena facewash', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 440, 500, 570, 0, '0107'),
(108, 14, NULL, NULL, 'watch', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 300, 350, 0, '0108'),
(109, 6, NULL, NULL, 'tressme shampo', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 630, 680, 730, 0, '0109'),
(110, 6, NULL, NULL, 'loreal men roll on', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 290, 330, 380, 0, '0110'),
(111, 14, NULL, NULL, 'watch 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 110, 150, 200, 0, '0111'),
(112, 14, NULL, NULL, 'loreal shower gel', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 460, 510, 550, 0, '0112'),
(113, 6, NULL, NULL, 'lynx men shower gel', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 360, 410, 450, 0, '0113'),
(114, 6, NULL, NULL, 'loreal hair gel', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 450, 500, 560, 0, '0114'),
(115, 4, NULL, NULL, 'adidas shower gel', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 390, 450, 500, 0, '0115'),
(116, 14, NULL, NULL, 'watch 3', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 180, 230, 0, '0116'),
(117, 6, NULL, NULL, 'venus rajor', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 170, 200, 250, 0, '0117'),
(118, 6, NULL, NULL, 'simple moistarizer', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 350, 370, 400, 0, '0118'),
(119, 6, NULL, NULL, 'eyelah curler', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 120, 150, 0, '0119'),
(120, 14, NULL, NULL, 'watch 4', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 180, 220, 0, '0120'),
(121, 6, NULL, NULL, 'simple scrub', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 270, 340, 340, 0, '0121'),
(122, 14, NULL, NULL, 'watch 5', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 550, 650, 650, 0, '0122'),
(123, 6, NULL, NULL, 'facewash 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 200, 220, 240, 0, '0123'),
(124, 6, NULL, NULL, 'sakura cleanser', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 170, 170, 0, '0124'),
(125, 6, NULL, NULL, 'scrub', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 220, 250, 250, 0, '0125'),
(126, 6, NULL, NULL, 'clean  & care', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 350, 450, 450, 0, '0126'),
(127, 6, NULL, NULL, 'make up puff', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 70, 90, 120, 0, '0127'),
(128, 14, NULL, NULL, 'travel kit', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 170, 180, 180, 0, '0128'),
(129, 14, NULL, NULL, 'china matt', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 150, 175, 220, 0, '0129'),
(130, 6, NULL, NULL, 'vaselin', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 90, 120, 140, 0, '0130'),
(131, 14, NULL, NULL, 'hand socks', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 95, 130, 150, 0, '0131'),
(132, 14, NULL, NULL, 'watch 6', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 220, 250, 300, 0, '0132'),
(133, 14, NULL, NULL, 'watch 7', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 170, 200, 230, 0, '0133'),
(134, 14, NULL, NULL, 'watch', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 280, 400, 480, 0, '0134'),
(135, 15, NULL, NULL, 'clip', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 50, 60, 75, 0, '0135'),
(136, 2, NULL, NULL, 'school bag 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 450, 600, 750, 0, '0136'),
(137, 14, NULL, NULL, 'socks', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 110, 140, 160, 0, '0137'),
(138, 6, NULL, NULL, 'bob powder', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 165, 190, 220, 0, '0138'),
(139, 15, NULL, NULL, 'clip 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 40, 50, 60, 0, '0139'),
(140, 2, NULL, NULL, 'school bag 3', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 400, 550, 650, 0, '0140'),
(141, 14, NULL, NULL, 'socks 2', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 60, 75, 100, 0, '0141'),
(142, 6, NULL, NULL, 'emilie foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 280, 310, 350, 0, '0142'),
(143, 6, NULL, NULL, 'wet & wild foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 490, 510, 550, 0, '0143'),
(144, 6, NULL, NULL, 'straightner', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 200, 230, 250, 0, '0144'),
(145, 6, NULL, NULL, 'milani foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 590, 650, 750, 0, '0145'),
(146, 15, NULL, NULL, 'strawberry earring', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 200, 200, 200, 0, '0146'),
(147, 6, NULL, NULL, 'imagic foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 360, 390, 420, 0, '0147'),
(148, 6, NULL, NULL, 'profiber', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 165, 190, 220, 0, '0148'),
(149, 6, NULL, NULL, 'imagic tube foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 165, 200, 250, 0, '0149'),
(150, 6, NULL, NULL, 'foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 250, 290, 350, 0, NULL),
(151, 14, NULL, NULL, 'socks 3', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 60, 75, 90, 0, '0151'),
(152, 6, NULL, NULL, 'note brush', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 340, 390, 430, 0, '0152'),
(153, 6, NULL, NULL, 'w7 hd foundation', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 360, 400, 450, 0, '0153'),
(158, 11, NULL, NULL, 'Akij Tiles', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(159, 10, NULL, NULL, 'Xiaomi 12 Pro', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(160, 13, NULL, NULL, 'pos', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/220123Capture.PNG', '220123Capture.PNG', NULL, 1, 0, 0, 0, 0, NULL),
(161, 13, NULL, NULL, 'RMS', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/220123Capture.PNG', '220123Capture.PNG', NULL, 1, 0, 0, 0, 0, NULL),
(162, 13, NULL, NULL, 'RMS', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(163, 13, NULL, NULL, 'test', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(164, 13, NULL, NULL, 'EIMS', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(165, 13, NULL, NULL, 'Ecommerce', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(166, 14, NULL, NULL, 'Football', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/230123football.webp', '230123football.webp', NULL, 1, 0, 0, 0, 0, NULL),
(167, 14, NULL, NULL, 'Cricket bat', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/230123cricket-bat_1.jpg', '230123cricket-bat_1.jpg', NULL, 1, 0, 0, 0, 0, NULL),
(168, 15, NULL, NULL, 'Floor mat', NULL, NULL, 3, 'https://possie.nescostore.com/public/backend/images/product/230123download.jpeg', '230123download.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(169, 16, NULL, NULL, 'Chair', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(170, 20, NULL, NULL, 'bag 2', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/060223image.jpg', '060223image.jpg', NULL, 1, 0, 0, 0, 0, NULL),
(171, 19, NULL, NULL, 'Walton A30 4GB 64GB', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(172, 21, NULL, NULL, 'LPG Cylender', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(173, 6, NULL, NULL, 'Pen', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(174, 22, NULL, NULL, 'Pu -L002', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(175, 23, NULL, NULL, 'Bela N gray', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(176, 24, NULL, NULL, 'Rose', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(177, NULL, 1, NULL, 'test', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/280223WhatsApp Image 2023-02-28 at 12.15.15 PM.jpeg', '280223WhatsApp Image 2023-02-28 at 12.15.15 PM.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(178, NULL, 19, NULL, 'A4 Tech Mouse', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/280223download.jpg', '280223download.jpg', NULL, 0, 0, 0, 0, 0, NULL),
(179, NULL, 18, NULL, 'Lenevo Mouse', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/280223download.jpg', '280223download.jpg', NULL, 1, 0, 0, 0, 0, NULL),
(180, NULL, 20, NULL, 'Gorjon 36 mm', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(181, NULL, 20, NULL, 'Gorjon 36 mm', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(182, NULL, 21, NULL, 'model 4523', NULL, NULL, 3, 'https://possie.nescostore.com/public/backend/images/product/080323various.webp', '080323various.webp', NULL, 1, 0, 0, 0, 0, NULL),
(183, NULL, 22, NULL, 'GIGABYTE 510', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(184, NULL, 23, NULL, 'Mosuri Boro Dana', NULL, NULL, 4, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(185, NULL, 24, NULL, 'Cocola', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(186, NULL, 25, NULL, '3 pcs', NULL, NULL, 1, 'https://possie.nescostore.com/public/backend/images/product/0605231234.jpg', '0605231234.jpg', NULL, 1, 0, 0, 0, 0, NULL),
(187, NULL, 26, NULL, 'Tuna', NULL, NULL, 4, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(188, NULL, 2, NULL, 'Lotto Bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(189, NULL, 2, NULL, 'Leather Bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(190, NULL, 2, NULL, 'Apple Bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(191, NULL, 1, NULL, 'Gucci', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(192, NULL, 1, NULL, 'Zara', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(193, NULL, 3, NULL, 'Leather Bag', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(194, NULL, 5, NULL, 'Gold Chain', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(195, NULL, 5, NULL, 'Semi-Gold', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(196, NULL, 5, NULL, 'Antique Chain', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(197, NULL, 12, NULL, 'Kurti', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(198, NULL, 12, NULL, 'Gown', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(199, NULL, 7, NULL, 'Ledis T-Shirt', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(200, NULL, 7, NULL, 'Men\'s T-Shirt', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(201, NULL, 27, NULL, 'Nayra Cut', NULL, NULL, 1, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(202, NULL, 28, NULL, 'Chaina Sandal', NULL, NULL, 6, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL),
(203, NULL, 13, NULL, 'sandal shoe 92610a', NULL, NULL, 6, 'https://kaynat.nescostore.com/public/backend/kaynat.jpeg', 'kaynat.jpeg', NULL, 1, 0, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

DROP TABLE IF EXISTS `product_attribute`;
CREATE TABLE IF NOT EXISTS `product_attribute` (
  `product_attribute_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `attribute_id` varchar(32) DEFAULT NULL,
  `attribute_image` varchar(128) DEFAULT NULL,
  `attribute_value` text,
  `is_active` int DEFAULT NULL,
  PRIMARY KEY (`product_attribute_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=414 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`product_attribute_id`, `product_id`, `attribute_id`, `attribute_image`, `attribute_value`, `is_active`) VALUES
(21, 31, '1', NULL, '#789CC9', NULL),
(22, 31, '1', NULL, '#BBBDC1', NULL),
(25, 31, '3', NULL, '0', NULL),
(26, 31, '4', NULL, '0', NULL),
(27, 31, '5', NULL, '20', NULL),
(28, 31, '6', NULL, '20', NULL),
(29, 31, '7', NULL, 'ujigu', NULL),
(30, 31, '8', NULL, NULL, NULL),
(31, 32, '1', NULL, '#789CC9', NULL),
(32, 32, '1', NULL, '#BBBDC1', NULL),
(34, 32, '2', NULL, 'L', NULL),
(35, 32, '3', NULL, '10', NULL),
(36, 32, '4', NULL, '10', NULL),
(37, 32, '5', NULL, '10', NULL),
(38, 32, '6', NULL, '10', NULL),
(39, 32, '7', NULL, '10', NULL),
(40, 32, '8', NULL, '100101aedawe', NULL),
(41, 50, '1', NULL, 'Purple', NULL),
(42, 50, '1', NULL, 'Black', NULL),
(75, 51, '1', NULL, '#00B8B7', NULL),
(76, 51, '1', NULL, '#FAFAFA', NULL),
(77, 51, '10', NULL, 'Powerful Octa-core Processor', NULL),
(78, 51, '11', NULL, 'RAM: 4GB LPDDR4X  |  ROM: 64GB', NULL),
(79, 51, '12', NULL, '16.5cm (6.5 inc ) Large Display', NULL),
(80, 51, '13', NULL, '8MP AI Camera', NULL),
(81, 51, '14', NULL, '5000 mAh Massive Battery', NULL),
(82, 51, '15', NULL, 'Length: 165.2mm |  Width: 76.4mm | Depth: 8.9mm', NULL),
(83, 51, '16', NULL, 'realme UI Go Edition  Based on Android 11', NULL),
(84, 51, '1', NULL, '#00B8B7', NULL),
(85, 51, '1', NULL, '#000000', NULL),
(86, 51, '10', NULL, 'Powerful Octa-core Processor  CPU: Octa-core CPU, up to 1.6GHz  GPU: IMG 8322', NULL),
(87, 51, '11', NULL, 'RAM: 4GB LPDDR4X  ROM: 64GB', NULL),
(88, 51, '12', NULL, '16.5cm (6.5inch) Large Display  88.7% Screen-to-body Ratio', NULL),
(89, 51, '13', NULL, '8MP AI Camera  5MP AI Selfie Camera', NULL),
(90, 51, '14', NULL, '5000mAh Massive Battery  Up to 43 Days of Standby', NULL),
(91, 52, '1', NULL, '#88D5E3', NULL),
(92, 52, '1', NULL, '#242830', NULL),
(93, 52, '10', NULL, 'UNISOC T610 Processor', NULL),
(94, 52, '11', NULL, 'RAM: 3GB LPDDR4X  ROM: 32GB', NULL),
(95, 52, '12', NULL, '6.5inch Mini-drop Fullscreen', NULL),
(96, 52, '13', NULL, '13MP AI Triple Camera', NULL),
(97, 52, '14', NULL, '5000mAh Massive Battery', NULL),
(98, 53, '1', NULL, '#FBFBFB', NULL),
(99, 53, '1', NULL, '#242830', NULL),
(100, 53, '10', NULL, 'UNISOC T610 Processor', NULL),
(101, 53, '11', NULL, 'RAM: 4GB LPDDR4X  ROM: 64GB', NULL),
(102, 53, '12', NULL, '6.5inch Mini-drop Fullscreen', NULL),
(103, 53, '13', NULL, '13MP AI Triple Camera', NULL),
(104, 53, '14', NULL, '5000mAh Massive Battery', NULL),
(105, 53, '15', NULL, 'Length: 164.5mm  Width: 76mm  Depth: 9.1mm  Weight: 200g(with battery)', NULL),
(106, 53, '16', NULL, 'realme UI  Based on Android 11', NULL),
(107, 54, '1', NULL, '#B5BDD4', NULL),
(108, 54, '1', NULL, '#DDDDDD', NULL),
(109, 54, '10', NULL, 'Powerful Unisoc T612 Processor', NULL),
(110, 54, '11', NULL, 'RAM: 4GB LPDDR4X  ROM: 64GB UFS 2.2', NULL),
(111, 55, '1', NULL, '#6E8AA8', NULL),
(112, 55, '1', NULL, '#FBFBFB', NULL),
(113, 55, '10', NULL, 'Helio G85 Powerful Processor', NULL),
(114, 55, '11', NULL, 'RAM: 4GB LPDDR4X  ROM: 128GB', NULL),
(115, 55, '12', NULL, '16.5cm(6.5inch) Large Display', NULL),
(116, 55, '13', NULL, '48MP AI Triple Camera', NULL),
(117, 55, '14', NULL, '6000mAh Mega Battery  18W Quick Charge', NULL),
(118, 55, '15', NULL, 'Length: 164.5mm  Width: 75.9mm  Depth: 9.6mm  Weight:  209g', NULL),
(119, 55, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(120, 56, '1', NULL, '#A4CDE8', NULL),
(121, 56, '1', NULL, '#212228', NULL),
(122, 56, '10', NULL, 'Powerful Unisoc T612 Processor', NULL),
(123, 56, '11', NULL, 'RAM: 4GB LPDDR4X  ROM: 128GB', NULL),
(124, 57, '1', NULL, '#C1D4A3', NULL),
(125, 57, '1', NULL, '#323850', NULL),
(126, 57, '10', NULL, 'Powerful Unisoc T616 Processor', NULL),
(127, 57, '11', NULL, 'RAM: 4GB LPDDR4X  ROM: 128GB UFS 2.2', NULL),
(128, 57, '12', NULL, '16.7cm  6.6inch +FHD+ Fullscreen', NULL),
(129, 57, '13', NULL, '50MP AI Triple Camera', NULL),
(130, 57, '14', NULL, '5000mAh Massive Battery  18W Quick Charge', NULL),
(131, 57, '15', NULL, 'Length: 164.4mm  Width: 75.6mm  Depth: 8.1mm  Weight: 189g', NULL),
(132, 57, '16', NULL, 'realme UI R Edition  Based on Android 11', NULL),
(133, 59, '1', NULL, '#FAFAFA', NULL),
(134, 59, '1', NULL, '#C0EBFC', NULL),
(135, 59, '10', NULL, 'MediaTek Helio G96 Gaming Processor', NULL),
(136, 59, '11', NULL, 'RAM: 4GB  ROM: 64GB', NULL),
(137, 59, '12', NULL, '120Hz Ultra Smooth Display', NULL),
(138, 59, '13', NULL, '50MP AI Triple Camera', NULL),
(139, 59, '14', NULL, '33W Dart Charge  5000mAh Massive Battery', NULL),
(140, 59, '15', NULL, 'Length: 164.1mm  Width: 75.5mm  Depth 8.5mm  Weight  194g', NULL),
(141, 59, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(142, 60, '1', NULL, '#E9E9E9', NULL),
(143, 60, '1', NULL, '#FAFAFA', NULL),
(144, 60, '10', NULL, 'MediaTek Helio G96 Gaming Processor', NULL),
(145, 60, '11', NULL, 'RAM: 6GB  ROM: 128GB', NULL),
(146, 60, '12', NULL, '120Hz Ultra Smooth Display', NULL),
(147, 60, '13', NULL, '50MP AI Triple Camera', NULL),
(148, 60, '14', NULL, '33W Dart Charge  5000mAh Massive Battery', NULL),
(149, 60, '15', NULL, 'Length: 164.1mm  Width: 75.5mm  Depth  8.5mm  Weight  194g', NULL),
(150, 60, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(151, 61, '1', NULL, '#EEEEEE', NULL),
(152, 61, '1', NULL, '#6B7179', NULL),
(153, 61, '10', NULL, 'Qualcomm Snapdragon  680 Processo', NULL),
(154, 61, '11', NULL, 'RAM: 6GB LPDDR4X  ROM: 128GB UFS 2.1', NULL),
(155, 61, '12', NULL, '90Hz  Ultra Smooth Display', NULL),
(156, 61, '13', NULL, '50MP  AI Triple Camera', NULL),
(157, 61, '14', NULL, '33W  Dart Charge 5000mAh  Massive Battery', NULL),
(158, 61, '15', NULL, 'Length: 164.4mm  Width: 75.7mm  Depth  8.4mm  Weight  190g', NULL),
(159, 61, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(160, 62, '1', NULL, '#FAFAFA', NULL),
(161, 62, '1', NULL, '#555555', NULL),
(162, 62, '10', NULL, 'Helio G95 Gaming Processor', NULL),
(163, 62, '11', NULL, 'RAM: 8GB LPDDR4X  ROM: 128GB UFS 2.1', NULL),
(164, 62, '12', NULL, '16.3cm 6.4inch Super AMOLED Fullscreen', NULL),
(165, 62, '13', NULL, '64MP AI Quad Camera', NULL),
(166, 62, '14', NULL, '30W Dart Charge 5000mAh Massive Battery', NULL),
(167, 62, '15', NULL, 'Length: 160.6mm  Width: 73.9mm  Depth: 7.99mm  Weight: 177g', NULL),
(168, 62, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(169, 63, '1', NULL, '#343C4A', NULL),
(170, 63, '1', NULL, '#7F7F7F', NULL),
(171, 63, '1', NULL, '#FECF67', NULL),
(172, 63, '10', NULL, 'Snapdragon 680 Processor', NULL),
(173, 63, '11', NULL, 'RAM: 8GB  ROM: 128GB, UFS 2.2 Storage', NULL),
(174, 63, '12', NULL, '90Hz Super AMOLED Display', NULL),
(175, 63, '13', NULL, '108MP ProLight Camera', NULL),
(176, 63, '14', NULL, 'Massive 5000mAh Battery', NULL),
(177, 63, '15', NULL, 'Length: 160.2mm  Width: 73.3mm  Depth  7.99mm  Weight  178g', NULL),
(178, 63, '16', NULL, 'realme UI 3.0  Based on Android 12', NULL),
(179, 64, '1', NULL, '#FAFAFA', NULL),
(180, 64, '1', NULL, '#236866', NULL),
(181, 64, '1', NULL, '#85C8EA', NULL),
(182, 64, '10', NULL, 'Qualcomm Snapdragon 695 5G Processor', NULL),
(183, 64, '11', NULL, 'RAM:  8GB  ROM: 128GB UFS2.2', NULL),
(184, 64, '12', NULL, '120Hz Ultra Smooth Display', NULL),
(185, 64, '13', NULL, '64MP Nightscape Camera', NULL),
(186, 64, '14', NULL, '5000mAh Massive Battery', NULL),
(187, 64, '15', NULL, 'Length: 164.3mm  Width: 75.6mm  Depth  8.5mm  Weight  195g', NULL),
(188, 64, '16', NULL, 'realme UI 3.0  Based on Android 12', NULL),
(189, 65, '1', NULL, '#276E6C', NULL),
(190, 65, '1', NULL, '#8BC8E9', NULL),
(191, 65, '10', NULL, 'MediaTek Dimensity 920 5G Processor', NULL),
(192, 65, '11', NULL, '8GB + 128GB', NULL),
(193, 65, '12', NULL, '90Hz Super AMOLED Display', NULL),
(194, 65, '13', NULL, 'Sony IMX766 OIS Camera', NULL),
(195, 65, '14', NULL, '60W SuperDart Charge', NULL),
(196, 65, '15', NULL, 'Length: 160.2mm  Width: 73.3mm  Depth  7.99mm Weight  182g', NULL),
(197, 65, '16', NULL, 'realme UI 3.0  Based on Android 12', NULL),
(198, 66, '1', NULL, '#FBFBFC', NULL),
(199, 66, '1', NULL, '#F9F9FA', NULL),
(200, 66, '1', NULL, '#F1F5FF', NULL),
(201, 66, '10', NULL, 'Snapdragon 778G 5G Processor', NULL),
(202, 66, '11', NULL, '8GB + 128GB', NULL),
(203, 66, '12', NULL, '120Hz Samsung AMOLED Fullscreen', NULL),
(204, 66, '13', NULL, '64MP Street Photography Camera  Rear Camera', NULL),
(205, 66, '14', NULL, '65W SuperDart Charge  4300mAh Massive Battery', NULL),
(206, 66, '15', NULL, 'Length: 159.2mm  Width: 73.5mm  Depth: 8.0mm, 8.7mm Weight 174g', NULL),
(207, 66, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(208, 67, '1', NULL, '#D7F17F', NULL),
(209, 67, '10', NULL, 'Qualcomm Snapdragon 870 5G Processor', NULL),
(210, 67, '11', NULL, 'RAM: 8GB  ROM: 128GB', NULL),
(211, 67, '12', NULL, '120Hz E4 AMOLED Display', NULL),
(212, 67, '13', NULL, '64MP AI Triple Camera', NULL),
(213, 67, '14', NULL, '65W SuperDart Charge 5000mAh Massive Battery', NULL),
(214, 67, '15', NULL, 'Length: 162.9mm  Width: 75.8mm  Depth: 8.6mm  Weight 200g', NULL),
(215, 67, '16', NULL, 'realme UI 2.0  Based on Android 11', NULL),
(216, 58, '1', NULL, '#2F344D', NULL),
(217, 58, '1', NULL, '#3E3E3E', NULL),
(218, 58, '10', NULL, 'Powerful Unisoc T616 Processor', NULL),
(219, 58, '11', NULL, 'RAM: 6GB LPDDR4X  ROM: 128GB UFS 2.2', NULL),
(220, 58, '12', NULL, '16.7cm 6.6inchi FHD+ Fullscreen', NULL),
(221, 58, '13', NULL, '50MP AI Triple Camera', NULL),
(222, 58, '14', NULL, '5000mAh Massive Battery  18W Quick Charge', NULL),
(223, 58, '15', NULL, 'Length: 164.4mm  Width: 75.6mm  Depth: 8.1mm  Weight: 189g', NULL),
(224, 58, '16', NULL, 'realme UI R Edition  Based on Android 11', NULL),
(225, 68, '1', NULL, '#474842', NULL),
(226, 68, '1', NULL, '#A0A0A0', NULL),
(227, 68, '10', NULL, 'UNISOC T610 Processor', NULL),
(228, 68, '11', NULL, '4 GB & 64GB', NULL),
(229, 68, '12', NULL, '16.5cm 6.5inch Large Display', NULL),
(230, 68, '13', NULL, '50MP AI Triple Camera', NULL),
(231, 68, '14', NULL, '5000mAh Massive Battery  18W Quick Charge', NULL),
(232, 68, '15', NULL, '16.51 cm (6.5 inch)', NULL),
(233, 69, '17', NULL, '6 month brand warranty', NULL),
(234, 70, '17', NULL, '12 month brand warranty', NULL),
(235, 71, '17', NULL, '6 month brand warranty', NULL),
(236, 74, '17', NULL, '6 month brand warranty', NULL),
(237, 75, '17', NULL, '6 month brand warranty', NULL),
(238, 76, '17', NULL, '1 month brand warranty', NULL),
(239, 77, '17', NULL, '2 years (12 month parts & 12 month service)', NULL),
(242, 72, '17', NULL, '12 month brand warranty', NULL),
(244, 80, '17', NULL, '12 month brand warranty', NULL),
(245, 81, '17', NULL, '6 month brand warranty', NULL),
(246, 82, '17', NULL, '12 month brand warranty(Cable 6 months)', NULL),
(247, 83, '17', NULL, '3 month brand warranty', NULL),
(248, 84, '17', NULL, '12 month brand warranty', NULL),
(249, 85, '17', NULL, '6 month brand warranty', NULL),
(250, 86, '17', NULL, '6 month brand warranty', NULL),
(251, 87, '17', NULL, '6 month brand warranty', NULL),
(270, 73, '17', NULL, '6 month brand warranty', NULL),
(305, 104, '1', NULL, 'white', NULL),
(306, 104, '2', NULL, 'XL', NULL),
(307, 104, '2', NULL, 'L', NULL),
(308, 104, '2', NULL, 'M', NULL),
(346, 89, '1', NULL, 'Blue Washed', NULL),
(347, 89, '1', NULL, 'Blue', NULL),
(348, 89, '2', NULL, '32', NULL),
(349, 89, '2', NULL, '34', NULL),
(350, 89, '2', NULL, '36', NULL),
(351, 89, '2', NULL, '38', NULL),
(352, 89, '2', NULL, '40', NULL),
(353, 89, '2', NULL, '32', NULL),
(354, 89, '2', NULL, '34', NULL),
(355, 89, '2', NULL, '36', NULL),
(356, 89, '2', NULL, '38', NULL),
(357, 89, '2', NULL, '40', NULL),
(358, 92, '1', NULL, 'Blue', NULL),
(359, 92, '2', NULL, '32', NULL),
(360, 92, '2', NULL, '34', NULL),
(361, 92, '2', NULL, '36', NULL),
(362, 90, '1', NULL, 'Wash Denim', NULL),
(363, 90, '2', NULL, '32', NULL),
(364, 90, '2', NULL, '34', NULL),
(365, 90, '2', NULL, '36', NULL),
(366, 90, '2', NULL, '38', NULL),
(398, 88, '1', NULL, 'White', NULL),
(399, 88, '2', NULL, 'M', NULL),
(400, 88, '2', NULL, 'L', NULL),
(401, 88, '2', NULL, 'XL', NULL),
(402, 88, '18', NULL, 'Argentina', NULL),
(403, 88, '19', NULL, 'Home', NULL),
(404, 79, '17', NULL, '6 month brand warranty', NULL),
(405, 78, '17', NULL, '12 month brand warranty', NULL),
(406, 91, '1', NULL, 'Blue', NULL),
(407, 91, '2', NULL, '32', NULL),
(408, 91, '2', NULL, '34', NULL),
(409, 91, '2', NULL, '36', NULL),
(412, 105, '1', NULL, 'White', NULL),
(413, 105, '2', NULL, 'XL', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

DROP TABLE IF EXISTS `product_category`;
CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(512) NOT NULL,
  `category_description` text,
  `sample_image_path` text,
  `sample_image` varchar(32) DEFAULT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `category_description`, `sample_image_path`, `sample_image`, `is_active`) VALUES
(1, 'Bags', NULL, NULL, '202211171219bag.jpg', 1),
(2, 'Jwellary', NULL, NULL, '202211171508jwellary.jpg', 1),
(3, 'Ladies Dress', NULL, NULL, '202211171804dress.jpeg', 1),
(4, 'Shoes', NULL, NULL, '202211171805shoes.jpeg', 1),
(5, 'Baby Dress', NULL, NULL, '202211171805baby dress.jpeg', 1),
(6, 'Accessories', NULL, NULL, '202211171811accesories.jpeg', 1),
(7, 'cosmetics', NULL, NULL, '202211190555cosmetics.jpg', 1),
(8, 'clip', NULL, NULL, '202211231044clip.jpg', 1),
(9, 'sandle', NULL, NULL, '202211261101bag.jpg', 1),
(10, 'others', NULL, NULL, '202211261214clip.jpg', 1),
(11, 'Tils', NULL, NULL, '202301190658photo-t.jpeg', 1),
(12, 'Tile', NULL, NULL, '2023012110136634-1629266464.png', 1),
(13, 'Service & Solution', NULL, NULL, '202301221300logo.jpg', 1),
(14, 'Sports', NULL, NULL, '202301230808sports.jpg', 1),
(15, 'Mats', NULL, NULL, '202301231117download.jpeg', 1),
(16, 'Woood', NULL, NULL, 'white-blank-product.jpg', 1),
(17, 'Furniture', NULL, NULL, 'white-blank-product.jpg', 1),
(18, 'Furniture', NULL, NULL, 'white-blank-product.jpg', 0),
(19, 'Mobile', NULL, NULL, '202301261120download.jpeg', 1),
(20, 'Bag', NULL, NULL, '202302060644image.jpg', 1),
(21, 'LPG Clyender', NULL, NULL, 'white-blank-product.jpg', 1),
(22, 'Shoe', NULL, NULL, '202302151524side_view_.webp', 1),
(23, 'Lense', NULL, NULL, '202302210505images.jpg', 1),
(24, 'Show piece', NULL, NULL, 'white-blank-product.jpg', 1),
(25, 'Mouse', NULL, NULL, '202302281036download.jpg', 1),
(26, 'Plywood', NULL, NULL, '202303011247Spruce_plywood.JPG', 1),
(27, 'RAK Tiles', NULL, NULL, '202303080958various.webp', 1),
(28, 'COMPUTER', NULL, NULL, '202304010601MAMUN-1.jpg', 1),
(29, 'Lentil', NULL, NULL, '202305010537licensed-image.jpeg', 1),
(30, 'Food', NULL, NULL, '202305030403images (1).jpg', 1),
(31, 'Salowar Kamij', NULL, NULL, '2023050611051234.jpg', 1),
(32, 'Frozen', NULL, NULL, '20230522070577315077.webp', 1),
(33, 'Manha Dress', NULL, NULL, '202306130626images (1).jpeg', 1),
(34, 'Shoe', NULL, NULL, '202306170607s.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `product_images_id` int NOT NULL AUTO_INCREMENT,
  `product_images_name` varchar(128) NOT NULL,
  `product_images_path` varchar(128) NOT NULL,
  `product_images_size` varchar(32) NOT NULL,
  PRIMARY KEY (`product_images_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

DROP TABLE IF EXISTS `product_materials`;
CREATE TABLE IF NOT EXISTS `product_materials` (
  `product_material_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_material_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foot_ware_categories_id` bigint UNSIGNED NOT NULL,
  `type_id` bigint UNSIGNED NOT NULL,
  `material_type_id` bigint UNSIGNED NOT NULL,
  `brand_type_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`product_material_id`),
  KEY `product_materials_foot_ware_categories_id_foreign` (`foot_ware_categories_id`),
  KEY `product_materials_type_id_foreign` (`type_id`),
  KEY `product_materials_material_type_id_foreign` (`material_type_id`),
  KEY `product_materials_brand_type_id_foreign` (`brand_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`product_material_id`, `product_material_name`, `foot_ware_categories_id`, `type_id`, `material_type_id`, `brand_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Product1', 1, 1, 1, 1, '2023-07-09 20:20:53', '2023-07-09 20:52:19'),
(2, 'Product2', 3, 4, 3, 3, '2023-07-09 21:58:42', '2023-07-09 21:58:42'),
(3, 'Leather shoe', 10, 1, 1, 1, '2023-07-11 02:38:12', '2023-07-11 02:38:12'),
(4, 'Ladis', 7, 2, 2, 2, '2023-07-12 05:23:42', '2023-07-12 05:23:42');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

DROP TABLE IF EXISTS `purchase_details`;
CREATE TABLE IF NOT EXISTS `purchase_details` (
  `purchase_details_id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `brand_id` int DEFAULT '1',
  `unit_id` int DEFAULT NULL,
  `stock_id` int DEFAULT NULL,
  `colors_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `batch` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` double DEFAULT NULL,
  `purchase_price` double NOT NULL DEFAULT '0',
  `wholesale_price` double NOT NULL DEFAULT '0',
  `sales_price` double NOT NULL DEFAULT '0',
  `total_purchase_price` int NOT NULL DEFAULT '0',
  `discount` float NOT NULL DEFAULT '0',
  `vat` float NOT NULL DEFAULT '0',
  `article` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`purchase_details_id`),
  KEY `Purchase_Info_Foreign_Key` (`purchase_id`),
  KEY `Brand_Foreign_Key` (`brand_id`),
  KEY `unit_fk` (`unit_id`),
  KEY `P_Foreign` (`product_id`) USING BTREE,
  KEY `colors_id` (`colors_id`),
  KEY `size_id` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=244 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`purchase_details_id`, `purchase_id`, `product_id`, `brand_id`, `unit_id`, `stock_id`, `colors_id`, `size_id`, `batch`, `barcode`, `quantity`, `purchase_price`, `wholesale_price`, `sales_price`, `total_purchase_price`, `discount`, `vat`, `article`, `date`) VALUES
(172, 131, 1, 1, NULL, 219, 0, 0, '', '0172', 1, 700, 900, 1000, 700, 0, 0, '', '0000-00-00'),
(173, 132, 1, 1, NULL, 220, 0, 0, '', '0173', 2, 750, 900, 1500, 1500, 0, 0, '', '0000-00-00'),
(174, 133, 1, 1, NULL, 221, 0, 0, '', NULL, 3, 700, 900, 1000, 2100, 0, 300, '', '0000-00-00'),
(175, 133, 2, 1, NULL, 222, 0, 0, '', NULL, 3, 700, 900, 1000, 2100, 0, 60, '', '0000-00-00'),
(176, 137, 19, 1, NULL, 223, 0, 0, '', NULL, 10, 700, 900, 1000, 7000, 0, 0, '', '0000-00-00'),
(177, 137, 37, 1, NULL, 224, 0, 0, '', NULL, 10, 100, 150, 200, 1000, 0, 0, '', '0000-00-00'),
(178, 138, 158, 1, NULL, 225, 0, 0, '', NULL, 200, 1000, 1100, 1200, 200000, 0, 0, '', '0000-00-00'),
(179, 139, 159, 1, NULL, 226, 0, 0, '', NULL, 50, 15000, 14000, 16000, 750000, 0, 0, '', '0000-00-00'),
(180, 140, 1, 1, NULL, 227, 0, 0, '', NULL, 50, 700, 900, 1000, 35000, 0, 0, '', '0000-00-00'),
(181, 141, 160, 1, NULL, 228, 0, 0, '', NULL, 10, 20000, 22000, 25000, 200000, 0, 0, '', '0000-00-00'),
(182, 142, 162, 1, NULL, 229, 0, 0, '', NULL, 50, 15000, 20000, 25000, 750000, 0, 0, '', '0000-00-00'),
(183, 143, 165, 1, NULL, 230, 0, 0, '', NULL, 20, 30000, 35000, 40000, 600000, 0, 0, '', '0000-00-00'),
(184, 144, 164, 1, NULL, 231, 0, 0, '', NULL, 10, 50000, 75000, 100000, 500000, 0, 0, '', '0000-00-00'),
(185, 145, 166, 1, NULL, 233, 0, 0, '', NULL, 150, 400, 450, 550, 60000, 0, 0, '', '0000-00-00'),
(186, 146, 167, 1, NULL, 234, 0, 0, '', NULL, 50, 1500, 1800, 2200, 75000, 75, 750, '', '0000-00-00'),
(187, 147, 168, 1, NULL, 235, 0, 0, '', NULL, 200, 120, 130, 150, 24000, 2000, 1000, '', '0000-00-00'),
(188, 148, 168, 1, NULL, 236, 0, 0, '', NULL, 200, 120, 130, 150, 24000, 2000, 1000, '', '0000-00-00'),
(189, 149, 169, 1, NULL, 237, 0, 0, '', NULL, 20, 1000, 1200, 1500, 20000, 100, 200, '', '0000-00-00'),
(190, 150, 170, 1, NULL, 239, 0, 0, '', NULL, 20, 1500, 1450, 1550, 30000, 5, 100, '', '0000-00-00'),
(191, 151, 171, 1, NULL, 242, 0, 0, '', NULL, 100, 3500, 3750, 4000, 350000, 0, 0, '', '0000-00-00'),
(192, 152, 172, 1, NULL, 243, 0, 0, '', NULL, 100, 1800, 2000, 2200, 180000, 0, 0, '', '0000-00-00'),
(193, 153, 173, 1, NULL, 245, 0, 0, '', NULL, 100, 10, 9, 12, 1000, 0, 0, '', '0000-00-00'),
(194, 154, 174, 1, NULL, 246, 0, 0, '', NULL, 100, 1000, 1200, 1500, 100000, 0, 0, '', '0000-00-00'),
(195, 155, 175, 1, NULL, 247, 0, 0, '', NULL, 50, 200, 250, 300, 10000, 0, 250, '', '0000-00-00'),
(196, 156, 176, 1, NULL, 248, 0, 0, '', NULL, 50, 250, 220, 300, 12500, 0, 0, '', '0000-00-00'),
(197, 157, 178, 1, NULL, 249, 0, 0, '', NULL, 1, 120, 140, 180, 120, 0, 0, '', '0000-00-00'),
(198, 158, 179, 1, NULL, 250, 0, 0, '', NULL, 20, 200, 220, 250, 4000, 0, 0, '', '0000-00-00'),
(199, 159, 178, 1, NULL, 251, 0, 0, '', NULL, 30, 120, 140, 190, 3600, 50, 3000, '', '0000-00-00'),
(200, 160, 180, 1, NULL, 252, 0, 0, '', NULL, 20, 3000, 3050, 3100, 60000, 0, 0, '', '0000-00-00'),
(201, 161, 180, 1, NULL, 253, 0, 0, '', NULL, 30, 10000, 10050, 11000, 300000, 0, 0, '', '0000-00-00'),
(202, 162, 180, 1, NULL, 254, 0, 0, '', NULL, 10, 3000, 3050, 3100, 30000, 0, 0, '', '0000-00-00'),
(203, 163, 180, 1, NULL, 255, 0, 0, '', NULL, 5, 3000, 3050, 3100, 15000, 0, 0, '', '0000-00-00'),
(204, 164, 180, 1, NULL, 256, 0, 0, '', NULL, 10, 3400, 3450, 3500, 34000, 0, 0, '', '0000-00-00'),
(205, 165, 180, 1, NULL, 257, 0, 0, '', NULL, 5, 2500, 2550, 2600, 12500, 0, 0, '', '0000-00-00'),
(206, 166, 180, 1, NULL, 258, 0, 0, '', NULL, 100, 3600, 0, 3850, 360000, 193, 19300, '', '0000-00-00'),
(207, 167, 180, 1, NULL, 259, 0, 0, '', NULL, 20, 5800, 6000, 6500, 116000, 0, 0, '', '0000-00-00'),
(208, 168, 180, 1, NULL, 260, 0, 0, '', NULL, 50, 800, 900, 1000, 40000, 0, 0, '', '0000-00-00'),
(209, 169, 183, 1, NULL, 261, 0, 0, '', NULL, 5, 9300, 9500, 9700, 46500, 0, 0, '', '0000-00-00'),
(210, 170, 179, 1, NULL, 264, 0, 0, '', NULL, 50, 80, 90, 0, 4000, 0, 500, '', '0000-00-00'),
(211, 171, 184, 1, NULL, 265, 0, 0, '', NULL, 1000, 60, 80, 85, 60000, 0, 0, '', '0000-00-00'),
(212, 172, 184, 1, NULL, 266, 0, 0, '', NULL, 10000, 62, 82, 87, 620000, 0, 0, '', '0000-00-00'),
(213, 173, 185, 1, NULL, 267, 0, 0, '', NULL, 100, 50, 55, 60, 5000, 0, 0, '', '0000-00-00'),
(214, 174, 186, 1, NULL, 268, 0, 0, '', NULL, 100, 1000, 1200, 1800, 100000, 0, 0, '', '0000-00-00'),
(215, 175, 187, 1, NULL, 269, 0, 0, '', NULL, 50, 220, 250, 300, 11000, 0, 0, '', '0000-00-00'),
(216, 176, 179, 1, NULL, 270, 0, 0, '', NULL, 10, 200, 250, 320, 2000, 0, 0, '', '0000-00-00'),
(217, 177, 191, 1, NULL, 271, 0, 0, '', NULL, 10, 580, 650, 800, 5800, 0, 50, '', '0000-00-00'),
(218, 177, 192, 1, NULL, 272, 0, 0, '', NULL, 10, 450, 500, 650, 4500, 0, 50, '', '0000-00-00'),
(219, 178, 188, 1, NULL, 273, 0, 0, '', NULL, 12, 700, 750, 1000, 8400, 0, 60, '', '0000-00-00'),
(220, 178, 189, 1, NULL, 274, 0, 0, '', NULL, 8, 850, 950, 1350, 6800, 0, 64, '', '0000-00-00'),
(221, 179, 188, 1, NULL, 275, 0, 0, '', NULL, 10, 530, 650, 800, 5300, 0, 50, '', '0000-00-00'),
(222, 180, 189, 1, NULL, 277, 0, 0, '', NULL, 5, 800, 950, 1350, 4000, 0, 25, '', '0000-00-00'),
(223, 180, 190, 1, NULL, 278, 0, 0, '', NULL, 5, 950, 1100, 1500, 4750, 0, 25, '', '0000-00-00'),
(224, 181, 199, 1, NULL, 279, 0, 0, '', NULL, 100, 50, 80, 100, 5000, 0, 0, '', '0000-00-00'),
(225, 181, 200, 1, NULL, 280, 0, 0, '', NULL, 100, 50, 80, 100, 5000, 0, 0, '', '0000-00-00'),
(226, 182, 197, 1, NULL, 281, 0, 0, '', NULL, 15, 350, 380, 500, 5250, 0, 30, '', '0000-00-00'),
(227, 182, 198, 1, NULL, 282, 0, 0, '', NULL, 10, 450, 500, 650, 4500, 0, 30, '', '0000-00-00'),
(228, 183, 187, 1, NULL, 283, 0, 0, '', NULL, 5, 300, 350, 400, 1500, 0, 0, '', '0000-00-00'),
(229, 184, 180, 1, NULL, 284, 0, 0, '', NULL, 50, 1000, 1100, 1200, 50000, 0, 0, '', '0000-00-00'),
(230, 185, 201, 1, NULL, 285, 0, 0, '', NULL, 50, 500, 700, 900, 25000, 0, 0, '', '0000-00-00'),
(231, 186, 202, 1, NULL, 286, 0, 0, '', NULL, 100, 1290, 1400, 1600, 129000, 0, 0, '', '0000-00-00'),
(232, 191, 3, 1, NULL, 287, 1, 1, '124', '9110ST011-0723', 8, 8, 8, 8, 64, 8, 64, '', '0000-00-00'),
(233, 192, 4, 1, NULL, 288, 3, 1, '011', '6252CH011-0723', 10, 50, 45, 55, 500, 5, 100, '', '0000-00-00'),
(241, 197, 3, 1, NULL, 292, 4, 2, '122', '9113ST012-0723', 8, 8, 8, 8, 64, 8, 64, '01', '2023-07-15'),
(242, 198, 3, 1, NULL, 293, 1, 1, '122', '9110ST011-0723', 2, 2, 2, 2, 4, 2, 4, '01', '2023-07-15'),
(243, 199, 3, 1, NULL, 294, 1, 1, '011', '9110ST011-0723', 1, 1, 1, 1, 1, 1, 1, '01', '2023-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_info`
--

DROP TABLE IF EXISTS `purchase_info`;
CREATE TABLE IF NOT EXISTS `purchase_info` (
  `purchase_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_no` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `pur_date` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_item_price` double(128,2) NOT NULL DEFAULT '0.00',
  `discount` double(128,2) NOT NULL DEFAULT '0.00',
  `total_payable` double(128,2) NOT NULL DEFAULT '0.00',
  `paid_status` double(10,2) NOT NULL DEFAULT '0.00',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `store_id` int DEFAULT NULL,
  `is_completed` int NOT NULL DEFAULT '0',
  `total_vat` float NOT NULL DEFAULT '0',
  `due_amount` float NOT NULL DEFAULT '0',
  `paid_amount` float NOT NULL DEFAULT '0',
  `is_vat_show` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_info`
--

INSERT INTO `purchase_info` (`purchase_id`, `ref_no`, `supplier_id`, `pur_date`, `total_item_price`, `discount`, `total_payable`, `paid_status`, `notes`, `store_id`, `is_completed`, `total_vat`, `due_amount`, `paid_amount`, `is_vat_show`) VALUES
(131, 'A112', 11, '2023-01-02 10:18:48', 700.00, 0.00, 700.00, 2.00, 'ASsa', 1, 1, 0, 0, 700, 1),
(132, 'A112', 11, '2023-01-03 06:11:27', 1500.00, 0.00, 1500.00, 2.00, 'ok', 1, 1, 0, 0, 1500, 1),
(133, 'A112', 11, '2023-01-05 13:09:41', 4200.00, 0.00, 4560.00, 2.00, 'afsdf', 8, 1, 360, 0, 4560, NULL),
(134, 'A112', 11, '2023-01-05 13:09:46', 0.00, 0.00, 0.00, 2.00, 'afsdf', 8, 1, 0, 0, 0, NULL),
(135, 'A112', 11, '2023-01-05 13:10:16', 0.00, 0.00, 0.00, 2.00, 'afsdf', 8, 1, 0, 0, 0, NULL),
(136, 'A112', 11, '2023-01-05 13:10:19', 0.00, 0.00, 0.00, 2.00, 'afsdf', 8, 1, 0, 0, 0, NULL),
(137, 'A112', 11, '2023-01-07 07:46:52', 8000.00, 0.00, 8000.00, 2.00, 'fgdf', 1, 1, 0, 0, 8000, NULL),
(138, 'no', NULL, '2023-01-19 07:08:25', 200000.00, 0.00, 200000.00, 2.00, NULL, 13, 1, 0, 0, 200000, NULL),
(139, 'A112', 11, '2023-01-21 09:02:22', 750000.00, 0.00, 750000.00, 2.00, 'vcg', 2, 1, 0, 0, 750000, NULL),
(140, 'A112', 11, '2023-01-22 09:31:57', 35000.00, 0.00, 35000.00, 2.00, 'xsfgbh', 12, 1, 0, 0, 35000, NULL),
(141, NULL, 16, '2023-01-22 12:49:46', 200000.00, 0.00, 200000.00, 2.00, 'service & solution', 15, 1, 0, 0, 200000, NULL),
(142, NULL, 16, '2023-01-22 13:10:01', 750000.00, 0.00, 750000.00, 2.00, 'ok', 15, 1, 0, 0, 750000, NULL),
(143, '0', 16, '2023-01-22 13:11:59', 600000.00, 0.00, 600000.00, 1.00, 'ok', 15, 1, 0, 600000, 0, NULL),
(144, 'ABC', 16, '2023-01-22 13:14:19', 500000.00, 0.00, 500000.00, 1.00, 'ok', 15, 1, 0, 500000, 0, NULL),
(145, NULL, 17, '2023-01-23 08:14:40', 60000.00, 0.00, 60000.00, 2.00, 'Deer Football 150p', 2, 1, 0, 0, 60000, NULL),
(146, NULL, 18, '2023-01-23 11:10:21', 75000.00, 75.00, 75675.00, 2.00, NULL, 15, 1, 750, 0, 75675, NULL),
(147, NULL, 19, '2023-01-23 11:20:31', 24000.00, 2000.00, 23000.00, 2.00, 'floor mat', 2, 1, 1000, 0, 23000, NULL),
(148, NULL, 19, '2023-01-23 11:26:35', 24000.00, 2000.00, 23000.00, 2.00, NULL, 2, 1, 1000, 0, 23000, NULL),
(149, NULL, 11, '2023-01-25 14:07:26', 20000.00, 100.00, 20100.00, 2.00, NULL, 4, 1, 200, 0, 20100, NULL),
(150, NULL, 20, '2023-02-06 07:25:42', 30000.00, 5.00, 30095.00, 2.00, NULL, 9, 1, 100, 0, 30095, NULL),
(151, NULL, 22, '2023-02-11 12:06:06', 350000.00, 0.00, 350000.00, 2.00, NULL, 13, 1, 0, 0, 350000, NULL),
(152, NULL, 23, '2023-02-14 12:00:07', 180000.00, 0.00, 180000.00, 2.00, NULL, 16, 1, 0, 0, 180000, NULL),
(153, NULL, 11, '2023-02-14 12:51:36', 1000.00, 0.00, 1000.00, 2.00, NULL, 3, 1, 0, 0, 1000, NULL),
(154, NULL, 24, '2023-02-15 15:29:01', 100000.00, 0.00, 100000.00, 2.00, NULL, 15, 1, 0, 0, 100000, NULL),
(155, NULL, 25, '2023-02-21 05:14:48', 10000.00, 0.00, 10250.00, 1.00, NULL, 18, 1, 250, 5250, 5000, NULL),
(156, NULL, 26, '2023-02-21 05:48:47', 12500.00, 0.00, 12500.00, 2.00, NULL, 18, 1, 0, 0, 12500, NULL),
(157, '123', NULL, '2023-02-28 10:55:03', 120.00, 0.00, 120.00, 2.00, NULL, 4, 1, 0, 0, 120, NULL),
(158, NULL, NULL, '2023-02-28 12:04:05', 4000.00, 0.00, 4000.00, 2.00, NULL, 6, 1, 0, 0, 4000, NULL),
(159, NULL, 22, '2023-02-28 12:11:31', 3600.00, 50.00, 6550.00, 1.00, NULL, 2, 1, 3000, 550, 6000, NULL),
(160, '01', 27, '2023-03-01 12:53:37', 60000.00, 0.00, 60000.00, 2.00, 'ok', 3, 1, 0, 0, 60000, NULL),
(161, '0', 27, '2023-03-01 13:42:14', 300000.00, 0.00, 300000.00, 2.00, 'ok', 3, 1, 0, 0, 300000, NULL),
(162, '0', 27, '2023-03-01 13:45:11', 30000.00, 0.00, 30000.00, 2.00, 'ok', 3, 1, 0, 0, 30000, NULL),
(163, '0', 27, '2023-03-01 13:46:48', 15000.00, 0.00, 15000.00, 2.00, 'ok', 3, 1, 0, 0, 15000, NULL),
(164, '0', 27, '2023-03-01 14:00:22', 34000.00, 0.00, 34000.00, 2.00, 'ok', 3, 1, 0, 0, 34000, NULL),
(165, '0', 27, '2023-03-01 14:06:37', 12500.00, 0.00, 12500.00, 2.00, NULL, 3, 1, 0, 0, 12500, NULL),
(166, '1095', 27, '2023-03-07 06:29:50', 360000.00, 193.00, 379107.00, 1.00, '50    for islam traders', 6, 1, 19300, 279107, 100000, NULL),
(167, NULL, 26, '2023-03-12 06:10:53', 116000.00, 0.00, 116000.00, 2.00, NULL, 15, 1, 0, 0, 116000, NULL),
(168, NULL, 27, '2023-03-28 08:39:54', 40000.00, 0.00, 40000.00, 1.00, NULL, 2, 1, 0, 10000, 30000, NULL),
(169, '2023-4565', 28, '2023-04-01 06:11:25', 46500.00, 0.00, 46500.00, 2.00, 'MDKD', 2, 1, 0, 0, 46500, NULL),
(170, '10', 30, '2023-04-27 07:21:44', 4000.00, 0.00, 4500.00, 2.00, 'ok', 15, 1, 500, 0, 4500, NULL),
(171, 'M303', 31, '2023-05-01 05:47:40', 60000.00, 0.00, 60000.00, 2.00, 'Basic Bank\nL.c - 00023\nUSD - 2000', 2, 1, 0, 20000, 40000, NULL),
(172, 'M304', 31, '2023-05-01 05:57:01', 620000.00, 0.00, 620000.00, 2.00, 'ok', 3, 1, 0, 0, 620000, NULL),
(173, '011', 32, '2023-05-03 04:10:57', 5000.00, 0.00, 5000.00, 2.00, 'ok', 3, 1, 0, 0, 5000, NULL),
(174, NULL, 33, '2023-05-06 11:18:09', 100000.00, 0.00, 100000.00, 2.00, 'jhgkjnjghlfgv,hgliyfuflhgli', 21, 1, 0, 0, 100000, NULL),
(175, '996', 34, '2023-05-22 07:13:07', 11000.00, 0.00, 11000.00, 2.00, 'ok', 16, 1, 0, 0, 11000, NULL),
(176, NULL, 15, '2023-05-23 14:57:00', 2000.00, 0.00, 2000.00, 2.00, NULL, 2, 1, 0, 0, 2000, NULL),
(177, NULL, 33, '2023-05-24 12:27:55', 10300.00, 0.00, 10400.00, 2.00, NULL, 14, 1, 100, 0, 10400, NULL),
(178, NULL, 31, '2023-05-24 12:46:23', 15200.00, 0.00, 15324.00, 2.00, NULL, 12, 1, 124, 0, 15324, NULL),
(179, NULL, 33, '2023-05-24 14:44:42', 5300.00, 0.00, 5350.00, 2.00, NULL, 21, 1, 50, 0, 5350, NULL),
(180, NULL, 25, '2023-05-25 07:42:06', 8750.00, 0.00, 8800.00, 2.00, NULL, 21, 1, 50, 0, 8800, 1),
(181, NULL, 35, '2023-05-28 09:28:04', 10000.00, 0.00, 10000.00, 2.00, NULL, 14, 1, 0, 0, 10000, 1),
(182, NULL, 35, '2023-05-28 09:30:18', 9750.00, 0.00, 9810.00, 2.00, NULL, 14, 1, 60, 0, 9810, NULL),
(183, '011', 34, '2023-05-28 09:38:12', 1500.00, 0.00, 1500.00, 2.00, 'ok', 15, 1, 0, 0, 1500, NULL),
(184, '23', 32, '2023-05-31 08:13:29', 50000.00, 0.00, 50000.00, 2.00, 'ok', 6, 1, 0, 0, 50000, NULL),
(185, '02', 36, '2023-06-13 06:33:58', 25000.00, 0.00, 25000.00, 2.00, 'ok', 22, 1, 0, 0, 25000, NULL),
(186, '02', NULL, '2023-06-17 06:14:20', 129000.00, 0.00, 129000.00, 2.00, 'ok', 2, 1, 0, 0, 129000, NULL),
(187, NULL, NULL, '2023-07-15 06:26:58', 0.00, 0.00, 0.00, 0.00, NULL, NULL, 0, 0, 0, 704, NULL),
(188, NULL, NULL, '2023-07-15 06:34:44', 0.00, 0.00, 0.00, 0.00, NULL, NULL, 0, 0, 0, 90, NULL),
(189, NULL, NULL, '2023-07-15 06:41:28', 0.00, 0.00, 0.00, 0.00, NULL, NULL, 0, 0, 0, 72, NULL),
(190, NULL, 38, '2023-07-15 09:55:28', 0.00, 0.00, 0.00, 0.00, 'Sajjad Test', 23, 0, 0, 0, 188, NULL),
(191, '01', 38, '2023-07-15 09:58:41', 64.00, 8.00, 120.00, 2.00, 'Sajjad Notes', 23, 1, 64, 0, 120, NULL),
(192, NULL, 38, '2023-07-15 10:10:00', 4550.00, 20.00, 5230.00, 1.00, 'Sajjad New Notes', 23, 1, 700, 4010, 1220, NULL),
(193, NULL, 22, '2023-07-15 10:18:22', 0.00, 0.00, 0.00, 0.00, 'new Notes', 14, 0, 0, 0, 4550, NULL),
(194, '01', 25, '2023-07-15 10:20:19', 0.00, 0.00, 0.00, 0.00, 'sds', 15, 0, 0, 0, 10, NULL),
(195, NULL, 17, '2023-07-15 10:22:06', 0.00, 0.00, 0.00, 0.00, 'ssds', 6, 0, 0, 0, 3, NULL),
(196, NULL, 38, '2023-07-15 10:23:36', 0.00, 0.00, 0.00, 0.00, 'asd', 23, 0, 0, 0, 78, NULL),
(197, NULL, 20, '2023-07-15 10:26:59', 64.00, 8.00, 120.00, 2.00, 'dsf', 9, 1, 64, 0, 120, NULL),
(198, '01', 23, '2023-07-15 10:30:26', 4.00, 2.00, 6.00, 2.00, 'safsdfsd', 10, 1, 4, 0, 6, NULL),
(199, NULL, 13, '2023-07-15 10:57:42', 1.00, 1.00, 1.00, 2.00, 'sdfsef', 5, 1, 1, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_news`
--

DROP TABLE IF EXISTS `purchase_news`;
CREATE TABLE IF NOT EXISTS `purchase_news` (
  `purchase_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_material_id` bigint UNSIGNED NOT NULL,
  `colors_id` bigint UNSIGNED NOT NULL,
  `size_id` bigint UNSIGNED NOT NULL,
  `batch` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_price` bigint NOT NULL,
  `sales_price` bigint NOT NULL,
  `wholeSell_price` bigint DEFAULT NULL,
  `discount` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `vat` int NOT NULL,
  `qty` int NOT NULL,
  `purchase_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`purchase_id`),
  KEY `purchase_news_product_material_id_foreign` (`product_material_id`),
  KEY `purchase_news_colors_id_foreign` (`colors_id`),
  KEY `purchase_news_size_id_foreign` (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_news`
--

INSERT INTO `purchase_news` (`purchase_id`, `product_material_id`, `colors_id`, `size_id`, `batch`, `purchase_price`, `sales_price`, `wholeSell_price`, `discount`, `date`, `vat`, `qty`, `purchase_code`, `barcode`, `created_at`, `updated_at`) VALUES
(13, 3, 1, 1, '011', 9, 9, 9, 9, '2023-07-15', 0, 9, '9110ST011-0723', '9110ST011-0723', '2023-07-15 00:34:44', '2023-07-15 00:34:44'),
(14, 3, 4, 1, '244', 8, 8, 8, 8, '2023-07-15', 0, 8, '9113ST011-0723', '9113ST011-0723', '2023-07-15 00:41:29', '2023-07-15 00:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_temporaries`
--

DROP TABLE IF EXISTS `purchase_temporaries`;
CREATE TABLE IF NOT EXISTS `purchase_temporaries` (
  `purchase_temporary_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `temporary_consumer_id` bigint UNSIGNED DEFAULT NULL,
  `consumer_id` bigint UNSIGNED DEFAULT NULL,
  `create_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sales_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_suspended` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`purchase_temporary_id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_temporaries`
--

INSERT INTO `purchase_temporaries` (`purchase_temporary_id`, `temporary_consumer_id`, `consumer_id`, `create_date`, `from_ip`, `created_by`, `sales_type`, `is_suspended`) VALUES
(99, 92801, NULL, '2023-01-05 13:07:07', '127.0.0.1', '7', NULL, '0'),
(100, 92801, NULL, '2023-01-05 13:07:18', '127.0.0.1', '7', NULL, '0'),
(115, 59613, NULL, '2023-01-26 11:25:42', '27.147.190.162', '7', NULL, '0'),
(116, 15340, NULL, '2023-01-29 10:33:46', '27.147.190.162', '7', NULL, '0'),
(117, 15340, NULL, '2023-01-29 10:34:02', '27.147.190.162', '7', NULL, '0'),
(120, 19408, NULL, '2023-02-14 11:52:17', '103.232.100.213', '7', NULL, '0'),
(121, 19408, NULL, '2023-02-14 11:52:37', '103.232.100.213', '7', NULL, '0'),
(122, 19408, NULL, '2023-02-14 11:52:49', '103.232.100.213', '7', NULL, '0'),
(123, 19408, NULL, '2023-02-14 11:57:25', '103.232.100.213', '7', NULL, '0'),
(124, 19408, NULL, '2023-02-14 11:58:00', '103.232.100.213', '7', NULL, '0'),
(132, 56041, NULL, '2023-02-28 12:07:44', '103.232.100.213', '7', NULL, '0'),
(133, 56041, NULL, '2023-02-28 12:08:47', '103.232.100.213', '7', NULL, '0'),
(134, 56041, NULL, '2023-02-28 12:09:19', '103.232.100.213', '7', NULL, '0'),
(143, 63271, NULL, '2023-03-08 10:06:06', '103.126.150.34', '7', NULL, '0'),
(148, 53810, NULL, '2023-04-09 07:57:47', '103.232.100.213', '1', NULL, '0'),
(149, 30871, NULL, '2023-05-01 05:42:47', '103.143.1.20', '7', NULL, '0'),
(151, 30871, NULL, '2023-05-01 05:55:53', '103.143.1.20', '7', NULL, '0'),
(152, 30871, NULL, '2023-05-01 05:56:12', '103.143.1.20', '7', NULL, '0'),
(153, 30871, NULL, '2023-05-01 05:56:24', '103.143.1.20', '7', NULL, '0'),
(156, 24805, NULL, '2023-05-06 11:14:39', '103.232.100.213', '7', NULL, '0'),
(159, 61823, NULL, '2023-05-23 14:54:59', '103.232.100.213', '7', NULL, '0'),
(160, 61823, NULL, '2023-05-23 14:55:35', '103.232.100.213', '7', NULL, '0'),
(161, 61823, NULL, '2023-05-23 14:56:20', '103.232.100.213', '7', NULL, '0'),
(163, 94103, NULL, '2023-05-24 12:14:17', '103.232.100.213', '1', NULL, '0'),
(164, 94103, NULL, '2023-05-24 12:14:24', '103.232.100.213', '1', NULL, '0'),
(165, 94103, NULL, '2023-05-24 12:17:05', '103.232.100.213', '1', NULL, '0'),
(166, 94103, NULL, '2023-05-24 12:19:49', '103.232.100.213', '1', NULL, '0'),
(177, 98134, NULL, '2023-06-17 06:17:42', '103.79.183.230', '7', NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_temporary_items`
--

DROP TABLE IF EXISTS `purchase_temporary_items`;
CREATE TABLE IF NOT EXISTS `purchase_temporary_items` (
  `temp_purchase_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_temporary_id` bigint UNSIGNED DEFAULT NULL,
  `unit_id` bigint UNSIGNED DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `discount` double(8,2) NOT NULL DEFAULT '0.00',
  `vat` double(8,2) NOT NULL DEFAULT '0.00',
  `temp_net_amount` double(8,2) NOT NULL DEFAULT '0.00',
  `purchase_price` double NOT NULL DEFAULT '0',
  `sales_price` double NOT NULL DEFAULT '0',
  `wholesale_price` double NOT NULL DEFAULT '0',
  `product_id` int DEFAULT NULL,
  PRIMARY KEY (`temp_purchase_id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_temporary_items`
--

INSERT INTO `purchase_temporary_items` (`temp_purchase_id`, `purchase_temporary_id`, `unit_id`, `quantity`, `discount`, `vat`, `temp_net_amount`, `purchase_price`, `sales_price`, `wholesale_price`, `product_id`) VALUES
(195, 166, NULL, 112, 12.00, 1344.00, 137984.00, 1232, 123, 1232, 181),
(210, 166, NULL, 123, 123.00, 1476.00, 162729.00, 1323, 1232, 1231, 180),
(212, 177, NULL, 50, 0.00, 0.00, 60000.00, 1200, 1500, 1300, 177);

-- --------------------------------------------------------

--
-- Table structure for table `salary_details`
--

DROP TABLE IF EXISTS `salary_details`;
CREATE TABLE IF NOT EXISTS `salary_details` (
  `salary_details_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `salary_info_id` bigint UNSIGNED NOT NULL,
  `pay_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid_amount` bigint NOT NULL,
  `extra_allowence_amount` bigint NOT NULL,
  `paid_for_month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary_amount` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`salary_details_id`),
  KEY `salary_details_salary_info_id_foreign` (`salary_info_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_details`
--

INSERT INTO `salary_details` (`salary_details_id`, `salary_info_id`, `pay_date`, `paid_amount`, `extra_allowence_amount`, `paid_for_month`, `description`, `salary_amount`, `created_at`, `updated_at`) VALUES
(1, 5, '2023-06-13', 2000, 0, 'Jun', 'Test', 2000, '2023-06-13 11:18:35', '2023-06-13 11:18:35'),
(2, 5, '2023-06-13', 6000, 0, 'Jun', 'Test', 6000, '2023-06-13 11:19:18', '2023-06-13 11:19:18'),
(3, 7, '2023-06-13', 16000, 1000, 'Jun', 'Employee Salary', 15000, '2023-06-13 14:01:09', '2023-06-13 14:01:09'),
(4, 7, '2023-06-14', 5000, 0, 'Jun', 'Deu Complete', 5000, '2023-06-13 14:02:03', '2023-06-13 14:02:03'),
(5, 7, '2023-06-13', 10000, 0, 'Jun', 'Test', 10000, '2023-06-13 15:33:53', '2023-06-13 15:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `salary_infos`
--

DROP TABLE IF EXISTS `salary_infos`;
CREATE TABLE IF NOT EXISTS `salary_infos` (
  `salary_info_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `back_office_login_id` bigint UNSIGNED DEFAULT NULL,
  `salary_type_id` bigint UNSIGNED NOT NULL,
  `salary_amount` bigint NOT NULL,
  `due` bigint NOT NULL DEFAULT '0',
  `paid` bigint NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`salary_info_id`),
  KEY `salary_infos_salary_type_id_foreign` (`salary_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_infos`
--

INSERT INTO `salary_infos` (`salary_info_id`, `back_office_login_id`, `salary_type_id`, `salary_amount`, `due`, `paid`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 12, 2, 2000, 0, 0, 1, NULL, '2023-06-03 07:27:14'),
(5, 5, 2, 10000, -2000, 16000, 1, '2023-06-03 04:51:36', '2023-06-13 11:19:18'),
(6, 5, 2, 0, 0, 0, 1, '2023-06-03 05:09:42', '2023-06-03 07:27:23'),
(7, 6, 4, 20000, 0, 30000, 1, '2023-06-13 13:59:55', '2023-06-13 15:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `salary_types`
--

DROP TABLE IF EXISTS `salary_types`;
CREATE TABLE IF NOT EXISTS `salary_types` (
  `salary_type_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `salary_type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`salary_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_types`
--

INSERT INTO `salary_types` (`salary_type_id`, `salary_type_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Name Update', 1, NULL, '2023-06-03 03:29:02'),
(2, 'Another name', 1, '2023-06-03 01:54:24', '2023-06-03 03:27:25'),
(4, 'Employee', 1, '2023-06-13 13:59:13', '2023-06-13 13:59:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

DROP TABLE IF EXISTS `sales_details`;
CREATE TABLE IF NOT EXISTS `sales_details` (
  `sales_details_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `sales_info_id` bigint UNSIGNED DEFAULT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `sales_price` double(8,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `unit_id` bigint UNSIGNED DEFAULT NULL,
  `item_total` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `revised_price` double(8,2) DEFAULT NULL,
  `vat` double(8,2) DEFAULT NULL,
  `item_final_price` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sales_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_infos`
--

DROP TABLE IF EXISTS `sales_infos`;
CREATE TABLE IF NOT EXISTS `sales_infos` (
  `sales_info_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` bigint UNSIGNED DEFAULT NULL,
  `total_item_price` double(8,2) DEFAULT NULL,
  `vat` double(8,2) DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `total_payable` double(8,2) DEFAULT NULL,
  `sales_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sales_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `size_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `size_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`, `size_code`, `size_is_active`, `created_at`, `updated_at`) VALUES
(1, '1', '1', 1, '2023-07-08 02:23:02', '2023-07-08 02:28:56'),
(2, '2', '2', 1, '2023-07-09 18:37:50', '2023-07-09 18:37:50'),
(3, '3', '3', 1, '2023-07-09 18:38:18', '2023-07-09 18:38:18'),
(4, '4', '4', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(5, '5', '5', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(6, '6', '6', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(7, '7', '7', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(8, '8', '8', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(9, '9', '9', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(10, '10', '10', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(11, '11', '11', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(12, '12', '12', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(13, '13', '13', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(14, '14', '14', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(15, '15', '15', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(16, '16', '16', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(17, '17', '17', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(18, '18', '18', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(19, '19', '19', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(20, '20', '20', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(21, '21', '21', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(22, '22', '22', 1, '2023-07-09 18:38:42', '2023-07-09 18:38:42'),
(23, '23', '23', 1, '2023-07-12 04:27:37', '2023-07-12 04:27:37'),
(24, '24', '24', 1, '2023-07-12 04:27:43', '2023-07-12 04:27:43'),
(25, '25', '25', 1, '2023-07-12 04:27:49', '2023-07-12 04:27:49'),
(26, '26', '26', 1, '2023-07-12 04:27:55', '2023-07-12 04:27:55'),
(27, '27', '27', 1, '2023-07-12 04:28:00', '2023-07-12 04:28:00'),
(28, '28', '28', 1, '2023-07-12 04:28:06', '2023-07-12 04:28:06'),
(29, '29', '29', 1, '2023-07-12 04:28:12', '2023-07-12 04:28:12'),
(30, '30', '30', 1, '2023-07-12 04:28:19', '2023-07-12 04:28:19'),
(31, '31', '31', 1, '2023-07-12 04:28:25', '2023-07-12 04:28:25'),
(32, '32', '32', 1, '2023-07-12 04:28:34', '2023-07-12 04:28:34'),
(33, '33', '33', 1, '2023-07-12 04:28:38', '2023-07-12 04:28:38'),
(34, '34', '34', 1, '2023-07-12 04:28:44', '2023-07-12 04:28:44'),
(35, '35', '35', 1, '2023-07-12 04:28:50', '2023-07-12 04:28:50'),
(36, '36', '36', 1, '2023-07-12 04:28:56', '2023-07-12 04:28:56'),
(37, '37', '37', 1, '2023-07-12 04:29:03', '2023-07-12 04:29:03'),
(38, '38', '38', 1, '2023-07-12 04:29:11', '2023-07-12 04:29:11'),
(39, '39', '39', 1, '2023-07-12 04:29:19', '2023-07-12 04:29:19'),
(40, '40', '40', 1, '2023-07-12 04:29:25', '2023-07-12 04:29:25'),
(41, '41', '41', 1, '2023-07-12 04:29:31', '2023-07-12 04:29:31'),
(42, '42', '42', 1, '2023-07-12 04:29:38', '2023-07-12 04:29:38'),
(43, '43', '43', 1, '2023-07-12 04:29:43', '2023-07-12 04:29:43'),
(44, '44', '44', 1, '2023-07-12 04:29:48', '2023-07-12 04:29:48'),
(45, '45', '45', 1, '2023-07-12 04:29:53', '2023-07-12 04:29:53'),
(46, '46', '46', 1, '2023-07-12 04:30:01', '2023-07-12 04:30:01'),
(47, '47', '47', 1, '2023-07-12 04:30:08', '2023-07-12 04:30:08'),
(48, '48', '48', 1, '2023-07-12 04:30:14', '2023-07-12 04:30:14'),
(49, '49', '49', 1, '2023-07-12 04:30:22', '2023-07-12 04:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `size_definition`
--

DROP TABLE IF EXISTS `size_definition`;
CREATE TABLE IF NOT EXISTS `size_definition` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size_name` varchar(32) NOT NULL,
  `size_symbol` int NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `size_definition`
--

INSERT INTO `size_definition` (`size_id`, `size_name`, `size_symbol`, `is_active`) VALUES
(1, 'XS', 1, 0),
(2, 'XL', 3, 1),
(3, 'L', 4, 1),
(4, 'S', 5, 1),
(5, 'M', 4, 1),
(6, 'XXL', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`store_id`, `store_name`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Daulatpur', 1, NULL, NULL),
(2, 'Dak Bangla', 1, NULL, NULL),
(3, 'nirala', 1, NULL, NULL),
(4, 'Gollamari', 1, NULL, NULL),
(5, 'Rupsha', 1, NULL, NULL),
(6, 'Shibbari', 1, NULL, NULL),
(7, 'Zero Point', 1, NULL, NULL),
(8, 'bogra', 1, NULL, NULL),
(9, 'Daulatpur', 1, NULL, NULL),
(10, 'showroom', 1, NULL, NULL),
(11, 'hhhhhhhhhhhhh', 1, NULL, NULL),
(12, '118 tofmdnnd', 1, NULL, NULL),
(13, 'Dhaka', 1, NULL, NULL),
(14, 'Dhaka', 1, NULL, NULL),
(15, 'Nirala R/A', 1, NULL, NULL),
(16, 'Mongla', 1, NULL, NULL),
(17, 'Bhola LPG', 1, NULL, NULL),
(18, 'Bosupara', 1, NULL, NULL),
(19, 'moilapota', 1, NULL, NULL),
(20, 'moilapota', 1, NULL, NULL),
(21, 'Mirpur 10', 1, NULL, NULL),
(22, 'Ahsan Ahmed Road', 1, NULL, NULL),
(23, 'Sundanga', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_one`
--

DROP TABLE IF EXISTS `sub_category_one`;
CREATE TABLE IF NOT EXISTS `sub_category_one` (
  `sc_one_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `sc_one_name` varchar(512) NOT NULL,
  `sc_one_description` text,
  `sc_one_image` varchar(32) DEFAULT NULL,
  `is_active` int NOT NULL,
  `sc_one_image_path` text,
  PRIMARY KEY (`sc_one_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_category_one`
--

INSERT INTO `sub_category_one` (`sc_one_id`, `category_id`, `sc_one_name`, `sc_one_description`, `sc_one_image`, `is_active`, `sc_one_image_path`) VALUES
(1, 1, 'Party Bag', NULL, '171122pb.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/171122pb.jpg'),
(2, 1, 'School Bag', NULL, '17112271xMWMGpo9S.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/17112271xMWMGpo9S.jpg'),
(3, 1, 'Parts Bag', NULL, '171122parts.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/171122parts.jpg'),
(4, 1, 'Versity Bag', NULL, '17112202.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/17112202.jpg'),
(5, 2, 'Chain', NULL, '171122chain.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/171122chain.jpg'),
(6, 7, 'cosmetics', NULL, '191122cosmetics.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/191122cosmetics.jpg'),
(7, 3, 'genji', NULL, '191122dress.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/191122dress.jpg'),
(8, 8, 'clip', NULL, '231122clip.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/231122clip.jpg'),
(9, 1, 'luggage bag', NULL, '231122bag.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/231122bag.jpg'),
(10, 1, 'normal bag', NULL, '241122bag.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/241122bag.jpg'),
(11, 5, 'baby item', NULL, '261122dress.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/261122dress.jpg'),
(12, 3, 'dress', NULL, '261122dress.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/261122dress.jpg'),
(13, 9, 'sandle', NULL, '261122bag.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/261122bag.jpg'),
(14, 10, 'others', NULL, '261122clip.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/261122clip.jpg'),
(15, 2, 'jwellary', NULL, '271122jwellary.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/271122jwellary.jpg'),
(16, 2, 'jwellary', NULL, '271122jwellary.jpg', 1, 'https://kaynat.nescostore.com/public/backend/images/CategoryWise/271122jwellary.jpg'),
(17, 23, 'Glass', NULL, '2302231675.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/2302231675.jpg'),
(18, 25, 'Wireless Mouse', NULL, '280223download.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/280223download.jpg'),
(19, 25, 'USB Mouse', NULL, '280223download.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/280223download.jpg'),
(20, 26, 'Gorjon', NULL, '010323Spruce_plywood.JPG', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/010323Spruce_plywood.JPG'),
(21, 27, 'Floor Tiles', NULL, '080323various.webp', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/080323various.webp'),
(22, 28, 'MOTHTER BOARD', NULL, '010423MG.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/010423MG.jpg'),
(23, 29, 'Mosuri', NULL, '010523licensed-image.jpeg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/010523licensed-image.jpeg'),
(24, 30, 'Biscuit', NULL, '030523b.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/030523b.jpg'),
(25, 31, '3 pcs', NULL, '0605231234.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/0605231234.jpg'),
(26, 32, 'Fish', NULL, '220523l-intro-1649691956.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/220523l-intro-1649691956.jpg'),
(27, 33, 'Manha Three pcs', NULL, '130623ME.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/130623ME.jpg'),
(28, 34, 'Keds', NULL, '170623k.jpg', 1, 'https://possie.nescostore.com/public/backend/images/CategoryWise/170623k.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(256) DEFAULT NULL,
  `supplier_address` varchar(512) DEFAULT NULL,
  `supplier_contact_person` varchar(256) DEFAULT NULL,
  `supplier_contact_no` varchar(32) DEFAULT NULL,
  `is_active` int DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact_person`, `supplier_contact_no`, `is_active`) VALUES
(11, 'Kamrul Hasan', 'Khulna', 'Kamrul', '01516705104', 1),
(12, 'Muhaiminul', 'Jeshore', 'Muhaimin', '016598653265', 1),
(13, 'Jersey Supplier', 'Khulna', 'Name', '01000000000', 1),
(14, 'Akij', 'sksjjsjsjsjjss', '000000000000000000jajajjaja', '0000000000000000000000000000000', 1),
(15, 'New Supplyer', 'dhaka', 'mr. miraz', '012365478', 1),
(16, 'Self', 'Nirala', 'Prince', '01711157023', 1),
(17, 'Deer', 'Pakistan', 'Afridi', '65562686854546', 1),
(18, 'CA', 'Pakistan', 'Yahya', '253436536', 1),
(19, 'RFL', 'Khulna', 'Aiub', '11111111111', 1),
(20, 'Abu Dawod', 'Khulna University', 'Md. Abu Dawod Rahman', '01755273417', 1),
(21, 'Abu Dawod', 'Khulna University', 'Md. Abu Dawod Rahman', '01755273417', 1),
(22, 'Walton Bangladesh', 'Dhaka', 'Mr.Mohaimin', '1234567890', 1),
(23, 'Dubai Bangla LPG', 'Mongla', 'Mr.Shimon', '123456', 1),
(24, 'SREE LEATHER', 'Magura', 'Mr. Y', '01225555555', 1),
(25, 'Mr. Y', 'Dhaka', 'Mr. Z', '0142356987', 1),
(26, 'Sagor', 'Dhaka', 'Sagor', '0123565447', 1),
(27, 'Wooodtech Factory', 'Rampal', 'Mr Sumon', '01956988767', 1),
(28, 'SMART BD LTD', 'DHAKA', 'SAJOL', '01752554152', 1),
(29, 'Oxycon', 'Dhaka', 'Rakib', '0988766544', 1),
(30, 'R D', 'India', 'Mr. X', '12365789999', 1),
(31, 'Saha International', 'Kolkata, India', 'Mr. uttom', '01248500', 1),
(32, 'Arong', 'Dhaka', 'Emon', '1234567899', 1),
(33, 'Owhab Fashion', 'America', 'Mr. Donald Trump', '01871234568', 1),
(34, 'Sumon', 'Chittagong', 'Sumon', '123456789', 1),
(35, 'Buying House', 'Dhaka', 'Jui', '01842079698', 1),
(36, 'Mehedi Fashion', 'Dhaka', 'Mr. Mehedi', '1234567890', 1),
(37, 'Dallas', 'Dhaka', 'Mr. Al Amin', '1236547899', 1),
(38, 'Sajjad Hossain', 'Sunadanga', 'Tamim', '01684067842', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_payments`
--

DROP TABLE IF EXISTS `supplier_payments`;
CREATE TABLE IF NOT EXISTS `supplier_payments` (
  `supplier_payment_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_id` bigint UNSIGNED DEFAULT NULL,
  `payable_amount` double(8,2) DEFAULT NULL,
  `paid_amount` double(8,2) DEFAULT NULL,
  `revised_due` double(8,2) DEFAULT NULL,
  `bank_id` int DEFAULT NULL,
  `payment_method` bigint UNSIGNED DEFAULT NULL,
  `cheque_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_payments`
--

INSERT INTO `supplier_payments` (`supplier_payment_id`, `supplier_id`, `purchase_id`, `payable_amount`, `paid_amount`, `revised_due`, `bank_id`, `payment_method`, `cheque_no`, `notes`, `created_at`, `updated_at`) VALUES
(93, 11, 131, 700.00, 700.00, NULL, 4, 2, 'AAA12121244', 'ASsa', '2023-01-02 04:18:49', '2023-01-02 04:18:49'),
(94, 11, 132, 1500.00, 1500.00, NULL, 4, 2, '1500', 'ok', '2023-01-03 00:11:28', '2023-01-03 00:11:28'),
(95, 11, NULL, NULL, 1500.00, NULL, 1, 2, '12121244', NULL, '2023-01-04 06:18:41', '2023-01-04 06:18:41'),
(96, 11, 133, 4560.00, 4560.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:09:42', '2023-01-05 07:09:42'),
(97, 11, NULL, NULL, 4560.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:09:46', '2023-01-05 07:09:46'),
(98, 11, 134, 0.00, 0.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:09:46', '2023-01-05 07:09:46'),
(99, 11, NULL, NULL, 4560.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:10:17', '2023-01-05 07:10:17'),
(100, 11, 135, 0.00, 0.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:10:17', '2023-01-05 07:10:17'),
(101, 11, NULL, NULL, 4560.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:10:20', '2023-01-05 07:10:20'),
(102, 11, 136, 0.00, 0.00, NULL, 4, 2, '12121244', 'afsdf', '2023-01-05 07:10:20', '2023-01-05 07:10:20'),
(103, 11, NULL, NULL, 50000.00, NULL, NULL, 1, NULL, NULL, '2023-01-05 07:22:21', '2023-01-05 07:22:21'),
(104, 12, NULL, NULL, -100.00, NULL, NULL, 1, NULL, NULL, '2023-01-07 11:53:48', '2023-01-07 11:53:48'),
(105, 11, 137, 8000.00, 8000.00, NULL, NULL, 1, NULL, 'fgdf', '2023-01-07 12:46:52', '2023-01-07 12:46:52'),
(106, 11, NULL, NULL, 15000.00, NULL, NULL, 1, NULL, NULL, '2023-01-14 16:57:41', '2023-01-14 16:57:41'),
(107, 12, NULL, NULL, 50000.00, NULL, NULL, 1, NULL, NULL, '2023-01-14 16:58:05', '2023-01-14 16:58:05'),
(108, NULL, 138, 200000.00, 200000.00, NULL, NULL, 1, NULL, NULL, '2023-01-19 12:08:25', '2023-01-19 12:08:25'),
(109, 11, 139, 750000.00, 750000.00, NULL, 5, 2, 'AAA12121244', 'vcg', '2023-01-21 14:02:22', '2023-01-21 14:02:22'),
(110, 11, 140, 35000.00, 35000.00, NULL, 4, 2, '12121244', 'xsfgbh', '2023-01-22 14:31:57', '2023-01-22 14:31:57'),
(111, 16, 141, 200000.00, 200000.00, NULL, NULL, 1, NULL, 'service & solution', '2023-01-22 17:49:46', '2023-01-22 17:49:46'),
(112, 16, 142, 750000.00, 750000.00, NULL, NULL, 1, NULL, 'ok', '2023-01-22 18:10:01', '2023-01-22 18:10:01'),
(113, 16, 143, 600000.00, 0.00, 600000.00, NULL, 1, NULL, 'ok', '2023-01-22 18:11:59', '2023-01-22 18:11:59'),
(114, 16, 144, 500000.00, 0.00, 500000.00, NULL, 1, NULL, 'ok', '2023-01-22 18:14:19', '2023-01-22 18:14:19'),
(115, 16, NULL, NULL, 60000.00, NULL, NULL, 1, NULL, NULL, '2023-01-22 19:06:00', '2023-01-22 19:06:00'),
(116, 17, 145, 60000.00, 60000.00, NULL, NULL, 1, NULL, 'Deer Football 150p', '2023-01-23 13:14:40', '2023-01-23 13:14:40'),
(117, 18, 146, 75675.00, 75675.00, NULL, NULL, 1, NULL, NULL, '2023-01-23 16:10:21', '2023-01-23 16:10:21'),
(118, 19, 147, 23000.00, 23000.00, NULL, NULL, 1, NULL, 'floor mat', '2023-01-23 16:20:31', '2023-01-23 16:20:31'),
(119, 19, 148, 23000.00, 23000.00, 0.00, NULL, 1, NULL, NULL, '2023-01-23 16:26:35', '2023-01-23 16:29:12'),
(120, 11, 149, 20100.00, 20100.00, NULL, NULL, 1, NULL, NULL, '2023-01-25 19:07:26', '2023-01-25 19:07:26'),
(121, 20, 150, 30095.00, 30095.00, NULL, NULL, 1, NULL, NULL, '2023-02-06 12:25:42', '2023-02-06 12:25:42'),
(122, 22, 151, 350000.00, 350000.00, NULL, 5, 2, '123456', NULL, '2023-02-11 17:06:06', '2023-02-11 17:06:06'),
(123, 22, NULL, NULL, 50000.00, NULL, 1, 2, '654321', NULL, '2023-02-11 17:47:33', '2023-02-11 17:47:33'),
(124, 23, 152, 180000.00, 180000.00, NULL, 8, 2, '123456', NULL, '2023-02-14 17:00:07', '2023-02-14 17:00:07'),
(125, 11, 153, 1000.00, 1000.00, NULL, NULL, 1, NULL, NULL, '2023-02-14 17:51:36', '2023-02-14 17:51:36'),
(126, 24, 154, 100000.00, 100000.00, NULL, NULL, 1, NULL, NULL, '2023-02-15 20:29:01', '2023-02-15 20:29:01'),
(127, 25, 155, 10250.00, 5000.00, 5250.00, NULL, 1, NULL, NULL, '2023-02-21 10:14:48', '2023-02-21 10:14:48'),
(128, 26, 156, 12500.00, 12500.00, NULL, NULL, 1, NULL, NULL, '2023-02-21 10:48:47', '2023-02-21 10:48:47'),
(129, NULL, 157, 120.00, 120.00, NULL, NULL, 1, NULL, NULL, '2023-02-28 15:55:03', '2023-02-28 15:55:03'),
(130, NULL, 158, 4000.00, 4000.00, NULL, NULL, 1, NULL, NULL, '2023-02-28 17:04:05', '2023-02-28 17:04:05'),
(131, 22, 159, 6550.00, 6000.00, 550.00, NULL, 1, NULL, NULL, '2023-02-28 17:11:31', '2023-02-28 17:11:31'),
(132, 27, 160, 60000.00, 60000.00, NULL, NULL, 1, NULL, 'ok', '2023-03-01 17:53:38', '2023-03-01 17:53:38'),
(133, 16, NULL, NULL, 104000.00, NULL, NULL, 1, NULL, NULL, '2023-03-01 18:36:49', '2023-03-01 18:36:49'),
(134, 16, NULL, NULL, 104000.00, NULL, NULL, 1, NULL, NULL, '2023-03-01 18:38:06', '2023-03-01 18:38:06'),
(135, 27, 161, 300000.00, 300000.00, NULL, 4, 2, '1234567890', 'ok', '2023-03-01 18:42:14', '2023-03-01 18:42:14'),
(136, 27, 162, 30000.00, 30000.00, NULL, 4, 2, '1234567809', 'ok', '2023-03-01 18:45:11', '2023-03-01 18:45:11'),
(137, 27, 163, 15000.00, 15000.00, NULL, NULL, 1, NULL, 'ok', '2023-03-01 18:46:48', '2023-03-01 18:46:48'),
(138, 27, 164, 34000.00, 34000.00, NULL, NULL, 1, NULL, 'ok', '2023-03-01 19:00:23', '2023-03-01 19:00:23'),
(139, 27, 165, 12500.00, 12500.00, NULL, NULL, 1, NULL, NULL, '2023-03-01 19:06:37', '2023-03-01 19:06:37'),
(140, 27, 166, 379107.00, 100000.00, 279107.00, NULL, 1, NULL, '50    for islam traders', '2023-03-07 11:29:50', '2023-03-07 11:29:50'),
(141, 26, 167, 116000.00, 116000.00, NULL, NULL, 1, NULL, NULL, '2023-03-12 10:10:53', '2023-03-12 10:10:53'),
(142, 27, 168, 40000.00, 30000.00, 10000.00, NULL, 1, NULL, NULL, '2023-03-28 12:39:54', '2023-03-28 12:39:54'),
(143, 28, 169, 46500.00, 46500.00, NULL, NULL, 1, NULL, 'MDKD', '2023-04-01 10:11:25', '2023-04-01 10:11:25'),
(144, 30, 170, 4500.00, 4500.00, NULL, NULL, 1, NULL, 'ok', '2023-04-27 11:21:44', '2023-04-27 11:21:44'),
(145, 27, NULL, NULL, 50000.00, NULL, 1, 2, '0124789999', NULL, '2023-04-27 11:29:41', '2023-04-27 11:29:41'),
(146, 31, 171, 60000.00, 40000.00, 20000.00, NULL, 1, NULL, 'Basic Bank\nL.c - 00023\nUSD - 2000', '2023-05-01 09:47:40', '2023-05-01 10:04:58'),
(147, 31, NULL, NULL, 80000.00, NULL, NULL, 1, NULL, NULL, '2023-05-01 09:54:30', '2023-05-01 09:54:30'),
(148, 31, 172, 620000.00, 620000.00, NULL, NULL, 1, NULL, 'ok', '2023-05-01 09:57:01', '2023-05-01 09:57:01'),
(149, 32, 173, 5000.00, 5000.00, NULL, NULL, 1, NULL, 'ok', '2023-05-03 08:10:57', '2023-05-03 08:10:57'),
(150, 22, NULL, NULL, 50000.00, NULL, NULL, 1, NULL, NULL, '2023-05-03 08:22:50', '2023-05-03 08:22:50'),
(151, 33, 174, 100000.00, 100000.00, NULL, NULL, 1, NULL, 'jhgkjnjghlfgv,hgliyfuflhgli', '2023-05-06 15:18:09', '2023-05-06 15:18:09'),
(152, 34, 175, 11000.00, 11000.00, NULL, NULL, 1, NULL, 'ok', '2023-05-22 11:13:07', '2023-05-22 11:13:07'),
(153, 15, 176, 2000.00, 2000.00, NULL, NULL, 1, NULL, NULL, '2023-05-23 18:57:00', '2023-05-23 18:57:00'),
(154, 33, 177, 10400.00, 10400.00, NULL, NULL, 1, NULL, NULL, '2023-05-24 16:27:55', '2023-05-24 16:27:55'),
(155, 31, 178, 15324.00, 15324.00, NULL, NULL, 1, NULL, NULL, '2023-05-24 16:46:23', '2023-05-24 16:46:23'),
(156, 33, 179, 5350.00, 5350.00, NULL, NULL, 1, NULL, NULL, '2023-05-24 18:44:42', '2023-05-24 18:44:42'),
(157, 25, 180, 8800.00, 8800.00, NULL, NULL, 1, NULL, NULL, '2023-05-25 11:42:06', '2023-05-25 11:42:06'),
(158, 35, 181, 10000.00, 10000.00, NULL, NULL, 1, NULL, NULL, '2023-05-28 13:28:04', '2023-05-28 13:28:04'),
(159, 35, 182, 9810.00, 9810.00, NULL, NULL, 1, NULL, NULL, '2023-05-28 13:30:18', '2023-05-28 13:30:18'),
(160, 34, 183, 1500.00, 1500.00, NULL, NULL, 1, NULL, 'ok', '2023-05-28 13:38:12', '2023-05-28 13:38:12'),
(161, 32, 184, 50000.00, 50000.00, NULL, NULL, 1, NULL, 'ok', '2023-05-31 12:13:29', '2023-05-31 12:13:29'),
(162, 36, 185, 25000.00, 25000.00, NULL, NULL, 1, NULL, 'ok', '2023-06-13 10:33:58', '2023-06-13 10:33:58'),
(163, NULL, 186, 129000.00, 129000.00, NULL, NULL, 1, NULL, 'ok', '2023-06-17 10:14:20', '2023-06-17 10:14:20'),
(164, 38, NULL, NULL, 16.00, NULL, NULL, 1, NULL, 'Sajjad Notes', '2023-07-15 03:58:42', '2023-07-15 03:58:42'),
(165, 38, 191, 120.00, 120.00, NULL, NULL, 1, NULL, 'Sajjad Notes', '2023-07-15 03:58:42', '2023-07-15 03:58:42'),
(166, 38, 192, 5230.00, 1220.00, 4010.00, NULL, 1, NULL, 'Sajjad New Notes', '2023-07-15 04:10:01', '2023-07-15 04:10:01'),
(167, 20, NULL, NULL, 16.00, NULL, NULL, 1, NULL, 'dsf', '2023-07-15 04:26:59', '2023-07-15 04:26:59'),
(168, 20, 197, 120.00, 120.00, NULL, NULL, 1, NULL, 'dsf', '2023-07-15 04:27:00', '2023-07-15 04:27:00'),
(169, 23, NULL, NULL, 4.00, NULL, NULL, 1, NULL, 'safsdfsd', '2023-07-15 04:30:26', '2023-07-15 04:30:26'),
(170, 23, 198, 6.00, 6.00, NULL, NULL, 1, NULL, 'safsdfsd', '2023-07-15 04:30:26', '2023-07-15 04:30:26'),
(171, 13, NULL, NULL, 2.00, NULL, NULL, 1, NULL, 'sdfsef', '2023-07-15 04:57:43', '2023-07-15 04:57:43'),
(172, 13, 199, 1.00, 1.00, NULL, NULL, 1, NULL, 'sdfsef', '2023-07-15 04:57:43', '2023-07-15 04:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `type_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`type_id`, `type_name`, `type_code`, `type_is_active`, `created_at`, `updated_at`) VALUES
(1, 'Shoe', '1', 1, '2023-07-07 22:59:05', '2023-07-08 00:18:29'),
(2, 'Sandal', '2', 1, '2023-07-08 00:17:45', '2023-07-08 00:17:45'),
(3, 'Canvas', '3', 1, '2023-07-09 18:26:30', '2023-07-09 18:26:30'),
(4, 'Sports', '4', 1, '2023-07-09 18:26:44', '2023-07-09 18:26:44'),
(5, 'Synthetic', '5', 1, '2023-07-09 18:26:59', '2023-07-09 18:26:59'),
(6, 'Boot', '6', 1, '2023-07-09 18:27:18', '2023-07-09 18:27:18'),
(7, 'Leather Goods', '7', 1, '2023-07-09 18:27:38', '2023-07-09 18:27:38'),
(8, 'Socks', '8', 1, '2023-07-09 18:27:53', '2023-07-09 18:27:53'),
(9, 'Accessories', '9', 1, '2023-07-09 18:28:47', '2023-07-09 18:28:47');

-- --------------------------------------------------------

--
-- Table structure for table `unit_definition`
--

DROP TABLE IF EXISTS `unit_definition`;
CREATE TABLE IF NOT EXISTS `unit_definition` (
  `unit_id` int NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(64) NOT NULL,
  `unit_symbol` varchar(32) NOT NULL,
  `is_fractional` int NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit_definition`
--

INSERT INTO `unit_definition` (`unit_id`, `unit_name`, `unit_symbol`, `is_fractional`, `is_active`) VALUES
(1, 'piece', 'pcs', 2, 1),
(2, 'Feet', 'ft', 1, 1),
(3, 'Square Feet', 'sft', 1, 1),
(4, 'Kilogram', 'kg', 1, 1),
(5, 'Cubic Feet', 'CFT', 1, 1),
(6, 'Pair', 'Pr', 0, 1),
(7, 'Dozen', 'Dz', 1, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD CONSTRAINT `product_materials_brand_type_id_foreign` FOREIGN KEY (`brand_type_id`) REFERENCES `brand_types` (`brand_type_id`),
  ADD CONSTRAINT `product_materials_foot_ware_categories_id_foreign` FOREIGN KEY (`foot_ware_categories_id`) REFERENCES `foot_ware_categories` (`foot_ware_categories_id`),
  ADD CONSTRAINT `product_materials_material_type_id_foreign` FOREIGN KEY (`material_type_id`) REFERENCES `material_types` (`material_type_id`),
  ADD CONSTRAINT `product_materials_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`type_id`);

--
-- Constraints for table `purchase_news`
--
ALTER TABLE `purchase_news`
  ADD CONSTRAINT `purchase_news_colors_id_foreign` FOREIGN KEY (`colors_id`) REFERENCES `colors` (`colors_id`),
  ADD CONSTRAINT `purchase_news_product_material_id_foreign` FOREIGN KEY (`product_material_id`) REFERENCES `product_materials` (`product_material_id`),
  ADD CONSTRAINT `purchase_news_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Constraints for table `salary_details`
--
ALTER TABLE `salary_details`
  ADD CONSTRAINT `salary_details_salary_info_id_foreign` FOREIGN KEY (`salary_info_id`) REFERENCES `salary_infos` (`salary_info_id`);

--
-- Constraints for table `salary_infos`
--
ALTER TABLE `salary_infos`
  ADD CONSTRAINT `salary_infos_salary_type_id_foreign` FOREIGN KEY (`salary_type_id`) REFERENCES `salary_types` (`salary_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2023 at 07:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_webchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_addon`
--

CREATE TABLE `tbl_addon` (
  `addon_id` int(11) NOT NULL,
  `addon_name` varchar(255) NOT NULL,
  `addon_price` bigint(20) NOT NULL,
  `addon_number` int(11) NOT NULL,
  `addon_message` int(11) NOT NULL,
  `addon_type` enum('personal','company') NOT NULL,
  `addon_status` tinyint(1) NOT NULL,
  `addon_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_addon`
--

INSERT INTO `tbl_addon` (`addon_id`, `addon_name`, `addon_price`, `addon_number`, `addon_message`, `addon_type`, `addon_status`, `addon_created`) VALUES
(1, 'Personal 1', 80000, 1, 50000, 'personal', 1, '2023-12-09 11:22:36'),
(2, 'Personal 2', 125000, 3, 150000, 'personal', 1, '2023-12-09 11:23:55'),
(3, 'Company 1', 80000, 1, 100000, 'company', 1, '2023-12-09 11:35:11'),
(4, 'Company 2', 200000, 3, 300000, 'company', 1, '2023-12-09 11:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_channel`
--

CREATE TABLE `tbl_channel` (
  `channel_id` int(11) NOT NULL,
  `channel_code` varchar(50) NOT NULL,
  `channel_name` varchar(150) NOT NULL,
  `channel_fee` decimal(10,3) NOT NULL,
  `channel_feeadd` decimal(10,3) NOT NULL,
  `channel_fee_type` enum('nominal','percent') NOT NULL,
  `channel_feeadd_type` enum('nominal','percent') NOT NULL,
  `channel_image` varchar(150) NOT NULL,
  `channel_category` enum('credit_card','bank_transfer','direct_debit','ewallet','retail_outlet','paylater','qr') NOT NULL,
  `channel_seq` int(11) NOT NULL,
  `channel_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_channel`
--

INSERT INTO `tbl_channel` (`channel_id`, `channel_code`, `channel_name`, `channel_fee`, `channel_feeadd`, `channel_fee_type`, `channel_feeadd_type`, `channel_image`, `channel_category`, `channel_seq`, `channel_status`) VALUES
(1, 'CREDIT_CARD', 'Credit Cards', '0.029', '2000.000', 'percent', 'nominal', '20231026130817-credit-cards.png', 'credit_card', 2, 1),
(2, 'BCA', 'BCA Virtual Account', '0.000', '4000.000', 'percent', 'nominal', '20231026130827-bca-virtual-account.png', 'bank_transfer', 3, 1),
(3, 'MANDIRI', 'Mandiri Bill Payment', '0.000', '4000.000', 'percent', 'nominal', '20231026130837-mandiri-bill-payment.png', 'bank_transfer', 4, 1),
(4, 'BNI', 'BNI Virtual Account', '0.000', '4000.000', 'percent', 'nominal', '20231026130847-bni-virtual-account.png', 'bank_transfer', 5, 1),
(5, 'PERMATA', 'Permata Virtual Account', '0.000', '4000.000', 'percent', 'nominal', '20231026131608-permata-virtual-account.png', 'bank_transfer', 6, 1),
(6, 'DD_BCA_KLIKPAY', 'BCA KlikPay', '0.000', '2500.000', 'nominal', 'nominal', '20231026131631-bca-klikpay.png', 'direct_debit', 7, 1),
(7, 'DD_MANDIRI', 'Mandiri KlikPay', '0.000', '4500.000', 'nominal', 'nominal', '20231026131652-mandiri-klikpay.png', 'direct_debit', 8, 1),
(9, 'DD_BRI', 'BRI Epay', '0.019', '0.000', 'percent', 'nominal', '20231026131708-bri-epay.png', 'direct_debit', 10, 1),
(11, 'GOPAY', 'GoPay', '0.000', '5000.000', 'percent', 'nominal', '20231026131805-gopay.png', 'ewallet', 12, 1),
(12, 'INDOMARET', 'Indomaret', '0.000', '2500.000', 'nominal', 'nominal', '20231026131843-indomaret.png', 'retail_outlet', 13, 1),
(13, 'ALFAMART', 'Alfamart', '0.000', '5000.000', 'nominal', 'nominal', '20231026131900-alfamart.png', 'retail_outlet', 14, 1),
(15, 'BRI', 'BRI Virtual Account', '0.000', '4000.000', 'percent', 'nominal', '20231026130805-bri-virtual-account.png', 'bank_transfer', 0, 1),
(16, 'BSI', 'BSI Virtual Account', '0.000', '4000.000', 'percent', 'nominal', '20231026130502-bsi-virtual-account.png', 'bank_transfer', 0, 1),
(17, 'BNC', 'BNC Virtual Account', '0.020', '40.000', 'percent', 'nominal', '20231026130527-bnc-virtual-account.png', 'bank_transfer', 0, 0),
(18, 'SAHABAT_SAMPOERNA', 'Sahabat Sampoerna VA', '0.000', '4000.000', 'percent', 'nominal', '20231026130553-sahabat-sampoerna-va.png', 'bank_transfer', 0, 0),
(19, 'CIMB', 'CIMB Virtual Account', '0.000', '2000.000', 'percent', 'nominal', '20231026130605-cimb-virtual-account.png', 'bank_transfer', 0, 1),
(20, 'BJB', 'BJB Virtual Account', '0.000', '4000.000', 'percent', 'nominal', '20231026130619-bjb-virtual-account.png', 'bank_transfer', 0, 1),
(21, 'DANA', 'DANA', '0.015', '2000.000', 'percent', 'nominal', '20231026130634-dana.png', 'ewallet', 0, 1),
(22, 'OVO', 'OVO', '0.020', '2000.000', 'percent', 'nominal', '20231026130647-ovo.png', 'ewallet', 0, 1),
(23, 'SHOPPEPAY', 'Shopee Pay', '0.030', '2000.000', 'percent', 'nominal', '20231026130700-shopee-pay.png', 'ewallet', 0, 1),
(24, 'QRIS', 'QRIS', '0.007', '0.000', 'percent', 'nominal', '20231026130715-qris.png', 'ewallet', 0, 1),
(25, 'UANGME', 'Uang Me', '0.018', '0.000', 'percent', 'nominal', '20231026130754-uang-me.png', 'paylater', 0, 1),
(26, 'ATOME', 'Atome', '0.050', '0.000', 'percent', 'nominal', '20231026130448-atome.png', 'paylater', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faq`
--

CREATE TABLE `tbl_faq` (
  `faq_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `faq_status` tinyint(1) NOT NULL,
  `faq_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_faq`
--

INSERT INTO `tbl_faq` (`faq_id`, `question`, `answer`, `faq_status`, `faq_created`) VALUES
(1, 'Test', 'A asdasd', 0, '2023-12-22 15:20:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feature`
--

CREATE TABLE `tbl_feature` (
  `feature_id` int(11) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `feature_icon` varchar(255) NOT NULL,
  `feature_desc` text NOT NULL,
  `feature_status` tinyint(1) NOT NULL,
  `feature_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_feature`
--

INSERT INTO `tbl_feature` (`feature_id`, `feature_name`, `feature_icon`, `feature_desc`, `feature_status`, `feature_created`) VALUES
(1, 'Broadcast', '<i class=\"bi bi-megaphone\"></i>', 'Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, libero error in est odio expedita at aliquid.', 1, '2023-12-09 12:22:08'),
(2, 'Auto Reply', '<i class=\"bi bi-reply\"></i>', 'Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, libero error in est odio expedita at aliquid.', 1, '2023-12-09 12:29:52'),
(3, 'Contact Sync', '<i class=\"bi bi-journal-arrow-down\"></i>', 'Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, libero error in est odio expedita at aliquid.', 1, '2023-12-09 12:30:29'),
(4, 'Group Management', '<i class=\"bi bi-collection\"></i>', 'Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, libero error in est odio expedita at aliquid.', 1, '2023-12-09 12:30:57'),
(5, 'Individual Storage', '<i class=\"bi bi-floppy\"></i>', 'Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, libero error in est odio expedita at aliquid.', 1, '2023-12-09 12:31:24'),
(6, 'API Integration', '<i class=\"bi bi-arrow-left-right\"></i>', 'Lorem, ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, libero error in est odio expedita at aliquid.', 1, '2023-12-09 12:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `order_telp` varchar(255) NOT NULL,
  `order_email` varchar(255) NOT NULL,
  `order_total` bigint(20) NOT NULL,
  `order_status` enum('pending','processing','paid','completed','canceled','failed') NOT NULL,
  `order_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `order_code`, `order_name`, `order_telp`, `order_email`, `order_total`, `order_status`, `order_created`) VALUES
(4, '2023129032485', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'processing', '2023-12-14 16:35:39'),
(5, '2023121862240', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-14 16:36:44'),
(6, '2023120655441', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-14 16:41:21'),
(7, '2023121724286', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-14 16:44:13'),
(8, '2023129798046', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'completed', '2023-12-14 16:47:48'),
(9, '2023122907851', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 152500, 'pending', '2023-12-14 16:50:00'),
(10, '2023126002734', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-14 16:55:42'),
(11, '2023120848226', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-14 16:56:12'),
(12, '2023120849098', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-14 16:57:40'),
(13, '2023122145636', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 09:56:12'),
(14, '2023120775564', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 09:57:31'),
(15, '2023128636448', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:01:18'),
(16, '2023125567252', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:03:09'),
(17, '2023128523595', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:03:41'),
(18, '2023126110183', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:04:11'),
(19, '2023129135493', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:11:15'),
(20, '2023123246641', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:12:15'),
(21, '2023125854687', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:12:30'),
(22, '2023123551141', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:12:38'),
(23, '2023126869330', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:13:50'),
(24, '2023123361922', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:28:41'),
(25, '2023128958063', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:29:24'),
(26, '2023120908199', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:31:03'),
(27, '2023126088049', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:31:40'),
(28, '2023126001700', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:32:05'),
(29, '2023127022902', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:32:25'),
(30, '2023123948002', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:33:33'),
(31, '2023123182653', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:39:39'),
(32, '2023121821254', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:43:33'),
(33, '2023123340894', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:45:37'),
(34, '2023120822455', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:46:29'),
(35, '2023121991020', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:47:18'),
(36, '2023121879322', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:51:13'),
(37, '2023126974507', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-15 10:51:41'),
(38, '2023123587367', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:42:13'),
(39, '2023127794584', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:44:04'),
(40, '2023120458051', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:46:57'),
(41, '2023129069039', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:48:07'),
(42, '2023122563280', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:49:05'),
(43, '2023121153004', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:51:31'),
(44, '2023123903916', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 09:52:37'),
(45, '2023120512483', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:01:34'),
(46, '2023122762768', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:08:10'),
(47, '2023122048177', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:10:23'),
(48, '2023127604936', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:25:08'),
(49, '2023125924855', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:25:53'),
(50, '2023125681378', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:29:04'),
(51, '2023123498480', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 10:36:06'),
(52, '2023128547352', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 279000, 'pending', '2023-12-21 10:40:05'),
(53, '2023127579936', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 279000, 'pending', '2023-12-21 10:40:56'),
(54, '2023129109908', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 279000, 'pending', '2023-12-21 10:42:40'),
(55, '2023126048829', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 11:38:22'),
(56, '2023123868889', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 279000, 'pending', '2023-12-21 11:41:28'),
(57, '2023126627372', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 234000, 'pending', '2023-12-21 11:48:35'),
(58, '2023127406719', 'Reffizal Harist', '6289606298905', 'reffizalharist@gmail.com', 154000, 'pending', '2023-12-21 11:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_item`
--

CREATE TABLE `tbl_order_item` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_price` bigint(20) NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_total` bigint(20) NOT NULL,
  `is_addon` tinyint(1) NOT NULL,
  `item_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_order_item`
--

INSERT INTO `tbl_order_item` (`item_id`, `order_id`, `product_id`, `item_price`, `item_qty`, `item_total`, `is_addon`, `item_created`) VALUES
(4, 4, 2, 150000, 1, 150000, 0, '2023-12-14 16:35:39'),
(5, 5, 2, 150000, 1, 150000, 0, '2023-12-14 16:36:44'),
(6, 6, 2, 150000, 1, 150000, 0, '2023-12-14 16:41:21'),
(7, 7, 2, 150000, 1, 150000, 0, '2023-12-14 16:44:13'),
(8, 8, 2, 150000, 1, 150000, 0, '2023-12-14 16:47:48'),
(9, 9, 2, 150000, 1, 150000, 0, '2023-12-14 16:50:00'),
(10, 10, 2, 150000, 1, 150000, 0, '2023-12-14 16:55:42'),
(11, 11, 2, 150000, 1, 150000, 0, '2023-12-14 16:56:12'),
(12, 12, 2, 150000, 1, 150000, 0, '2023-12-14 16:57:41'),
(13, 13, 2, 150000, 1, 150000, 0, '2023-12-15 09:56:12'),
(14, 14, 2, 150000, 1, 150000, 0, '2023-12-15 09:57:31'),
(15, 15, 2, 150000, 1, 150000, 0, '2023-12-15 10:01:18'),
(16, 16, 2, 150000, 1, 150000, 0, '2023-12-15 10:03:09'),
(17, 17, 2, 150000, 1, 150000, 0, '2023-12-15 10:03:41'),
(18, 18, 2, 150000, 1, 150000, 0, '2023-12-15 10:04:11'),
(19, 19, 2, 150000, 1, 150000, 0, '2023-12-15 10:11:15'),
(20, 20, 2, 150000, 1, 150000, 0, '2023-12-15 10:12:15'),
(21, 21, 2, 150000, 1, 150000, 0, '2023-12-15 10:12:30'),
(22, 22, 2, 150000, 1, 150000, 0, '2023-12-15 10:12:38'),
(23, 23, 2, 150000, 1, 150000, 0, '2023-12-15 10:13:50'),
(24, 24, 2, 150000, 1, 150000, 0, '2023-12-15 10:28:41'),
(25, 25, 2, 150000, 1, 150000, 0, '2023-12-15 10:29:24'),
(26, 26, 2, 150000, 1, 150000, 0, '2023-12-15 10:31:03'),
(27, 27, 2, 150000, 1, 150000, 0, '2023-12-15 10:31:40'),
(28, 28, 2, 150000, 1, 150000, 0, '2023-12-15 10:32:05'),
(29, 29, 2, 150000, 1, 150000, 0, '2023-12-15 10:32:25'),
(30, 30, 2, 150000, 1, 150000, 0, '2023-12-15 10:33:33'),
(31, 31, 2, 150000, 1, 150000, 0, '2023-12-15 10:39:39'),
(32, 32, 2, 150000, 1, 150000, 0, '2023-12-15 10:43:33'),
(33, 33, 2, 150000, 1, 150000, 0, '2023-12-15 10:45:37'),
(34, 34, 2, 150000, 1, 150000, 0, '2023-12-15 10:46:29'),
(35, 35, 2, 150000, 1, 150000, 0, '2023-12-15 10:47:18'),
(36, 36, 2, 150000, 1, 150000, 0, '2023-12-15 10:51:13'),
(37, 37, 2, 150000, 1, 150000, 0, '2023-12-15 10:51:41'),
(38, 38, 2, 150000, 1, 150000, 0, '2023-12-21 09:42:13'),
(39, 38, 1, 80000, 1, 80000, 1, '2023-12-21 09:42:13'),
(40, 39, 2, 150000, 1, 150000, 0, '2023-12-21 09:44:04'),
(41, 39, 1, 80000, 1, 80000, 1, '2023-12-21 09:44:04'),
(42, 40, 2, 150000, 1, 150000, 0, '2023-12-21 09:46:57'),
(43, 40, 1, 80000, 1, 80000, 1, '2023-12-21 09:46:57'),
(44, 41, 2, 150000, 1, 150000, 0, '2023-12-21 09:48:07'),
(45, 41, 1, 80000, 1, 80000, 1, '2023-12-21 09:48:07'),
(46, 42, 2, 150000, 1, 150000, 0, '2023-12-21 09:49:05'),
(47, 42, 1, 80000, 1, 80000, 1, '2023-12-21 09:49:05'),
(48, 43, 2, 150000, 1, 150000, 0, '2023-12-21 09:51:31'),
(49, 43, 1, 80000, 1, 80000, 1, '2023-12-21 09:51:31'),
(50, 44, 2, 150000, 1, 150000, 0, '2023-12-21 09:52:37'),
(51, 44, 1, 80000, 1, 80000, 1, '2023-12-21 09:52:37'),
(52, 45, 2, 150000, 1, 150000, 0, '2023-12-21 10:01:34'),
(53, 45, 1, 80000, 1, 80000, 1, '2023-12-21 10:01:34'),
(54, 46, 2, 150000, 1, 150000, 0, '2023-12-21 10:08:10'),
(55, 46, 1, 80000, 1, 80000, 1, '2023-12-21 10:08:10'),
(56, 47, 2, 150000, 1, 150000, 0, '2023-12-21 10:10:23'),
(57, 47, 1, 80000, 1, 80000, 1, '2023-12-21 10:10:23'),
(58, 48, 2, 150000, 1, 150000, 0, '2023-12-21 10:25:08'),
(59, 48, 1, 80000, 1, 80000, 1, '2023-12-21 10:25:08'),
(60, 49, 2, 150000, 1, 150000, 0, '2023-12-21 10:25:53'),
(61, 49, 1, 80000, 1, 80000, 1, '2023-12-21 10:25:53'),
(62, 50, 2, 150000, 1, 150000, 0, '2023-12-21 10:29:04'),
(63, 50, 1, 80000, 1, 80000, 1, '2023-12-21 10:29:04'),
(64, 51, 2, 150000, 1, 150000, 0, '2023-12-21 10:36:06'),
(65, 51, 1, 80000, 1, 80000, 1, '2023-12-21 10:36:06'),
(66, 52, 2, 150000, 1, 150000, 0, '2023-12-21 10:40:05'),
(67, 52, 2, 125000, 1, 125000, 1, '2023-12-21 10:40:05'),
(68, 53, 2, 150000, 1, 150000, 0, '2023-12-21 10:40:56'),
(69, 53, 2, 125000, 1, 125000, 1, '2023-12-21 10:40:56'),
(70, 54, 2, 150000, 1, 150000, 0, '2023-12-21 10:42:40'),
(71, 54, 2, 125000, 1, 125000, 1, '2023-12-21 10:42:40'),
(72, 55, 2, 150000, 1, 150000, 0, '2023-12-21 11:38:22'),
(73, 55, 1, 80000, 1, 80000, 1, '2023-12-21 11:38:22'),
(74, 56, 2, 150000, 1, 150000, 0, '2023-12-21 11:41:28'),
(75, 56, 2, 125000, 1, 125000, 1, '2023-12-21 11:41:28'),
(76, 57, 2, 150000, 1, 150000, 0, '2023-12-21 11:48:35'),
(77, 57, 1, 80000, 1, 80000, 1, '2023-12-21 11:48:35'),
(78, 58, 2, 150000, 1, 150000, 0, '2023-12-21 11:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_package`
--

CREATE TABLE `tbl_package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `package_desc` text NOT NULL,
  `package_price` bigint(20) NOT NULL,
  `package_type` enum('personal','company') NOT NULL,
  `package_status` tinyint(1) NOT NULL,
  `package_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_package`
--

INSERT INTO `tbl_package` (`package_id`, `package_name`, `package_desc`, `package_price`, `package_type`, `package_status`, `package_created`) VALUES
(2, 'Starter', '3 Whatsapp number,\r\n150.000 Message save,\r\n5 User / Agent,\r\nUnlimited send message,\r\nAPI Intergration', 150000, 'personal', 1, '2023-12-08 15:57:42'),
(3, 'Advanced', '5 Whatsapp number,\r\n250.000 Message save,\r\n10 User / Agent,\r\nUnlimited send message,\r\nAPI Intergration', 250000, 'personal', 1, '2023-12-08 16:19:46'),
(4, 'Contact Center Silver', '5 Whatsapp number,\r\n500.000 Message save,\r\n10 User / Agent,\r\nUnlimited send message,\r\nAPI Intergration', 500000, 'company', 1, '2023-12-08 16:23:28'),
(5, 'Contact Center Gold', '10 Whatsapp number,\r\n1.000.000 Message save,\r\n25 User / Agent,\r\nUnlimited send message,\r\nAPI Intergration', 900000, 'company', 1, '2023-12-08 16:24:15'),
(6, 'Contact Center Platinum', '15 Whatsapp number,\r\n1.500.000 Message save,\r\n50 User / Agent,\r\nUnlimited send message,\r\nAPI Intergration', 1350000, 'company', 1, '2023-12-08 16:25:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

CREATE TABLE `tbl_payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `data_id` varchar(255) NOT NULL,
  `external_id` varchar(255) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `expiry_date` datetime NOT NULL,
  `status` enum('pending','paid','expired') NOT NULL,
  `invoice_url` varchar(255) NOT NULL,
  `payment_method` varchar(150) DEFAULT NULL,
  `payment_channel` varchar(100) NOT NULL,
  `payment_destination` varchar(255) DEFAULT NULL,
  `fee` bigint(20) NOT NULL,
  `due_date` date DEFAULT NULL,
  `paid_date` datetime DEFAULT NULL,
  `payment_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `order_id`, `data_id`, `external_id`, `amount`, `description`, `expiry_date`, `status`, `invoice_url`, `payment_method`, `payment_channel`, `payment_destination`, `fee`, `due_date`, `paid_date`, `payment_created`) VALUES
(1, 0, '657bcd4eabb31909e1e70d5b', '2023126974507', 154000, 'Invoice #2023126974507', '0000-00-00 00:00:00', 'pending', 'https://checkout-staging.xendit.co/v2/657bcd4eabb31909e1e70d5b', NULL, 'MANDIRI', NULL, 4000, NULL, NULL, '2023-12-15 10:51:42'),
(2, 0, '6583b435f346006b7288cb64', '2023129109908', 279000, 'Invoice #2023129109908', '0000-00-00 00:00:00', 'pending', 'https://checkout-staging.xendit.co/v2/6583b435f346006b7288cb64', NULL, 'SAHABAT_SAMPOERNA', NULL, 4000, NULL, NULL, '2023-12-21 10:42:43'),
(3, 0, '6583c418f346001a3288e710', '2023127406719', 154000, 'Invoice #2023127406719', '2023-12-22 04:50:32', 'pending', 'https://checkout-staging.xendit.co/v2/6583c418f346001a3288e710', NULL, 'PERMATA', NULL, 4000, NULL, NULL, '2023-12-21 11:50:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setting`
--

CREATE TABLE `tbl_setting` (
  `setting_id` int(11) NOT NULL,
  `is_production` tinyint(1) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `api_key_test` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_setting`
--

INSERT INTO `tbl_setting` (`setting_id`, `is_production`, `api_key`, `api_key_test`) VALUES
(1, 0, 'xnd_development_FHPW4b3vWbkedQv1lzt5i3L83qAbg9BdQ1O2S3Iy91etJZGo8RjRfa3TVgEeqJt', 'xnd_development_FHPW4b3vWbkedQv1lzt5i3L83qAbg9BdQ1O2S3Iy91etJZGo8RjRfa3TVgEeqJt');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_level` enum('admin','user') NOT NULL,
  `is_forgot_password` tinyint(1) NOT NULL,
  `user_active` tinyint(1) NOT NULL,
  `user_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `is_forgot_password`, `user_active`, `user_created`) VALUES
(2, 'Administrator', 'admin@mail.com', '$2a$12$ESJWR6Pk3jvUIw5NQacWTehmGfnUtbw1LEszFzeBOER4JVIWMwk7O', 'admin', 0, 1, '2023-07-14 10:26:22'),
(9, 'Ujang', 'ujang@mail.com', '$2a$12$K3BO7AvZqo2/KjFNxgYSied0RVpXP.CuO89fd9rbFy2.4xrskL2nW', 'admin', 0, 1, '2023-12-04 14:25:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_addon`
--
ALTER TABLE `tbl_addon`
  ADD PRIMARY KEY (`addon_id`);

--
-- Indexes for table `tbl_channel`
--
ALTER TABLE `tbl_channel`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `tbl_feature`
--
ALTER TABLE `tbl_feature`
  ADD PRIMARY KEY (`feature_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `tbl_package`
--
ALTER TABLE `tbl_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_addon`
--
ALTER TABLE `tbl_addon`
  MODIFY `addon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_channel`
--
ALTER TABLE `tbl_channel`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_faq`
--
ALTER TABLE `tbl_faq`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_feature`
--
ALTER TABLE `tbl_feature`
  MODIFY `feature_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_order_item`
--
ALTER TABLE `tbl_order_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `tbl_package`
--
ALTER TABLE `tbl_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_payment`
--
ALTER TABLE `tbl_payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_setting`
--
ALTER TABLE `tbl_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 06, 2025 at 08:23 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aims_vtn`
--

-- --------------------------------------------------------

--
-- Table structure for table `device_transaction_log`
--

CREATE TABLE `device_transaction_log` (
  `autoID` int(11) NOT NULL,
  `device_table_id` int(11) NOT NULL,
  `action` enum('ADDED','ALLOTED','DEVICE_MOVED_TO_INVENTORY','READY_FOR_SCRAP','SCRAPPED','UPDATED','DELETED') DEFAULT NULL,
  `device_from` int(11) DEFAULT NULL,
  `device_to` int(11) NOT NULL DEFAULT '0',
  `device_remark` varchar(500) NOT NULL,
  `transactiondatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_query` text,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `admin_remark` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pc_transaction_log`
--

CREATE TABLE `pc_transaction_log` (
  `autoID` int(11) NOT NULL,
  `pc_table_id` int(11) NOT NULL,
  `action` enum('ADDED','ALLOTED','MOVED_TO_INVENTORY','READY_FOR_SCRAP','SCRAPPED','UPDATED','DELETED','RE-ASSIGNED TO OTHER') DEFAULT NULL,
  `pc_from` int(11) DEFAULT NULL,
  `pc_to` int(11) NOT NULL DEFAULT '0',
  `pc_remark` varchar(500) NOT NULL,
  `transactiondatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `transaction_query` text,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `admin_remark` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE `tbl_groups` (
  `autoID` int(11) NOT NULL,
  `grp_name` varchar(50) NOT NULL,
  `grp_email` varchar(50) NOT NULL,
  `grp_head` int(11) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`autoID`, `grp_name`, `grp_email`, `grp_head`, `isdeleted`) VALUES
(1, 'IT section', 'it@domain.co.in', 69, 0),
(2, 'Design Section', 'design@domain.co.in', 4, 0),
(3, 'Publication Section', 'publication@domain.co.in', 12, 0),
(9, 'Human Resource', 'hr@domain.co.in', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE `tbl_menu` (
  `autoID` int(11) NOT NULL,
  `menu_group` varchar(60) NOT NULL,
  `menu_name` varchar(60) NOT NULL,
  `menu_url` varchar(100) NOT NULL,
  `menu_icon` varchar(50) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`autoID`, `menu_group`, `menu_name`, `menu_url`, `menu_icon`, `isdeleted`) VALUES
(1, 'PERSONAL', 'Profile', 'profile.php', 'fas fa-id-card', 0),
(2, 'PERSONAL', 'PC & Accessories', 'pc_details.php', 'fas fa-desktop', 0),
(5, 'ADMIN', 'Centralize PC purchase details', 'pc_purchase_details_admin.php', 'fas fa-cart-plus', 0),
(6, 'ADMIN', 'Device Approval', 'device_approval_admin.php', 'fas fa-thumbs-up', 0),
(7, 'ADMIN', 'All Asset List', 'all_asset_info.php', 'fas fa-credit-card', 0),
(8, 'PERSONAL', 'Unit/Group Device Approval', 'group_device_approval.php', 'fas fa-check-double', 0),
(9, 'ADMIN', 'User Management', 'user_manage_admin.php', 'fas fa-user-cog', 0),
(10, 'ADMIN', 'Inventory', 'inventory_details.php', 'fas fa-truck-loading', 0),
(11, 'ADMIN', 'Centralize Printer/Scanner purchase details', 'printer_purchase_details_admin.php', 'fas fa-print', 0),
(12, 'ADMIN', 'Admin Dashboard', 'admin_dashboard.php', 'fas fa-tachometer-alt', 0),
(13, 'ADMIN', 'Manage Notifications', 'admin_notification.php', 'far fa-bell', 0),
(14, 'ADMIN', 'Transactions Log', 'admin_log.php', 'fas fa-exchange-alt', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu_permission`
--

CREATE TABLE `tbl_menu_permission` (
  `autoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `menuID` int(11) NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedbyip` varchar(50) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_menu_permission`
--

INSERT INTO `tbl_menu_permission` (`autoID`, `userID`, `menuID`, `updatedby`, `updatedbyip`, `updatedon`) VALUES
(132, 2, 1, 18974, '::1', '2023-04-24 15:50:52'),
(133, 3, 1, 18974, '::1', '2023-04-24 15:50:52'),
(134, 4, 1, 18974, '::1', '2023-04-24 15:50:52'),
(135, 5, 1, 18974, '::1', '2023-04-24 15:50:52'),
(136, 6, 1, 18974, '::1', '2023-04-24 15:50:52'),
(137, 7, 1, 18974, '::1', '2023-04-24 15:50:52'),
(138, 8, 1, 18974, '::1', '2023-04-24 15:50:52'),
(139, 9, 1, 18974, '::1', '2023-04-24 15:50:52'),
(140, 10, 1, 18974, '::1', '2023-04-24 15:50:52'),
(141, 11, 1, 18974, '::1', '2023-04-24 15:50:52'),
(142, 12, 1, 18974, '::1', '2023-04-24 15:50:52'),
(143, 13, 1, 18974, '::1', '2023-04-24 15:50:52'),
(144, 14, 1, 18974, '::1', '2023-04-24 15:50:52'),
(145, 15, 1, 18974, '::1', '2023-04-24 15:50:52'),
(146, 16, 1, 18974, '::1', '2023-04-24 15:50:52'),
(147, 17, 1, 18974, '::1', '2023-04-24 15:50:52'),
(148, 18, 1, 18974, '::1', '2023-04-24 15:50:52'),
(149, 19, 1, 18974, '::1', '2023-04-24 15:50:52'),
(150, 20, 1, 18974, '::1', '2023-04-24 15:50:52'),
(151, 21, 1, 18974, '::1', '2023-04-24 15:50:52'),
(152, 22, 1, 18974, '::1', '2023-04-24 15:50:52'),
(153, 23, 1, 18974, '::1', '2023-04-24 15:50:52'),
(154, 24, 1, 18974, '::1', '2023-04-24 15:50:52'),
(155, 25, 1, 18974, '::1', '2023-04-24 15:50:52'),
(156, 26, 1, 18974, '::1', '2023-04-24 15:50:52'),
(157, 27, 1, 18974, '::1', '2023-04-24 15:50:52'),
(158, 28, 1, 18974, '::1', '2023-04-24 15:50:52'),
(159, 29, 1, 18974, '::1', '2023-04-24 15:50:52'),
(160, 30, 1, 18974, '::1', '2023-04-24 15:50:52'),
(161, 31, 1, 18974, '::1', '2023-04-24 15:50:52'),
(162, 32, 1, 18974, '::1', '2023-04-24 15:50:52'),
(163, 33, 1, 18974, '::1', '2023-04-24 15:50:52'),
(164, 34, 1, 18974, '::1', '2023-04-24 15:50:52'),
(165, 35, 1, 18974, '::1', '2023-04-24 15:50:52'),
(166, 36, 1, 18974, '::1', '2023-04-24 15:50:52'),
(167, 37, 1, 18974, '::1', '2023-04-24 15:50:52'),
(168, 38, 1, 18974, '::1', '2023-04-24 15:50:52'),
(169, 39, 1, 18974, '::1', '2023-04-24 15:50:52'),
(170, 40, 1, 18974, '::1', '2023-04-24 15:50:52'),
(171, 41, 1, 18974, '::1', '2023-04-24 15:50:52'),
(172, 42, 1, 18974, '::1', '2023-04-24 15:50:52'),
(173, 43, 1, 18974, '::1', '2023-04-24 15:50:52'),
(174, 44, 1, 18974, '::1', '2023-04-24 15:50:52'),
(175, 45, 1, 18974, '::1', '2023-04-24 15:50:52'),
(176, 46, 1, 18974, '::1', '2023-04-24 15:50:52'),
(177, 47, 1, 18974, '::1', '2023-04-24 15:50:52'),
(178, 48, 1, 18974, '::1', '2023-04-24 15:50:52'),
(179, 49, 1, 18974, '::1', '2023-04-24 15:50:52'),
(180, 50, 1, 18974, '::1', '2023-04-24 15:50:52'),
(181, 51, 1, 18974, '::1', '2023-04-24 15:50:52'),
(182, 52, 1, 18974, '::1', '2023-04-24 15:50:52'),
(183, 53, 1, 18974, '::1', '2023-04-24 15:50:52'),
(184, 54, 1, 18974, '::1', '2023-04-24 15:50:52'),
(185, 55, 1, 18974, '::1', '2023-04-24 15:50:52'),
(186, 56, 1, 18974, '::1', '2023-04-24 15:50:52'),
(187, 57, 1, 18974, '::1', '2023-04-24 15:50:52'),
(188, 58, 1, 18974, '::1', '2023-04-24 15:50:52'),
(189, 59, 1, 18974, '::1', '2023-04-24 15:50:52'),
(190, 60, 1, 18974, '::1', '2023-04-24 15:50:52'),
(191, 61, 1, 18974, '::1', '2023-04-24 15:50:52'),
(192, 62, 1, 18974, '::1', '2023-04-24 15:50:52'),
(193, 63, 1, 18974, '::1', '2023-04-24 15:50:52'),
(194, 64, 1, 18974, '::1', '2023-04-24 15:50:52'),
(195, 65, 1, 18974, '::1', '2023-04-24 15:50:52'),
(196, 66, 1, 18974, '::1', '2023-04-24 17:31:41'),
(197, 67, 1, 18974, '::1', '2023-04-24 17:31:30'),
(198, 1, 1, 18974, '::1', '2023-04-24 15:50:52'),
(199, 2, 2, 18974, '::1', '2023-04-24 15:50:52'),
(200, 3, 2, 18974, '::1', '2023-04-24 15:50:52'),
(201, 4, 2, 18974, '::1', '2023-04-24 15:50:52'),
(202, 5, 2, 18974, '::1', '2023-04-24 15:50:52'),
(203, 6, 2, 18974, '::1', '2023-04-24 15:50:52'),
(204, 7, 2, 18974, '::1', '2023-04-24 15:50:52'),
(205, 8, 2, 18974, '::1', '2023-04-24 15:50:52'),
(206, 9, 2, 18974, '::1', '2023-04-24 15:50:52'),
(207, 10, 2, 18974, '::1', '2023-04-24 15:50:52'),
(208, 11, 2, 18974, '::1', '2023-04-24 15:50:52'),
(209, 12, 2, 18974, '::1', '2023-04-24 15:50:52'),
(210, 13, 2, 18974, '::1', '2023-04-24 15:50:52'),
(211, 14, 2, 18974, '::1', '2023-04-24 15:50:52'),
(212, 15, 2, 18974, '::1', '2023-04-24 15:50:52'),
(213, 16, 2, 18974, '::1', '2023-04-24 15:50:52'),
(214, 17, 2, 18974, '::1', '2023-04-24 15:50:52'),
(215, 18, 2, 18974, '::1', '2023-04-24 15:50:52'),
(216, 19, 2, 18974, '::1', '2023-04-24 15:50:52'),
(217, 20, 2, 18974, '::1', '2023-04-24 15:50:52'),
(218, 21, 2, 18974, '::1', '2023-04-24 15:50:52'),
(219, 22, 2, 18974, '::1', '2023-04-24 15:50:52'),
(220, 23, 2, 18974, '::1', '2023-04-24 15:50:52'),
(221, 24, 2, 18974, '::1', '2023-04-24 15:50:52'),
(222, 25, 2, 18974, '::1', '2023-04-24 15:50:52'),
(223, 26, 2, 18974, '::1', '2023-04-24 15:50:52'),
(224, 27, 2, 18974, '::1', '2023-04-24 15:50:52'),
(225, 28, 2, 18974, '::1', '2023-04-24 15:50:52'),
(226, 29, 2, 18974, '::1', '2023-04-24 15:50:52'),
(227, 30, 2, 18974, '::1', '2023-04-24 15:50:52'),
(228, 31, 2, 18974, '::1', '2023-04-24 15:50:52'),
(229, 32, 2, 18974, '::1', '2023-04-24 15:50:52'),
(230, 33, 2, 18974, '::1', '2023-04-24 15:50:52'),
(231, 34, 2, 18974, '::1', '2023-04-24 15:50:52'),
(232, 35, 2, 18974, '::1', '2023-04-24 15:50:52'),
(233, 36, 2, 18974, '::1', '2023-04-24 15:50:52'),
(234, 37, 2, 18974, '::1', '2023-04-24 15:50:52'),
(235, 38, 2, 18974, '::1', '2023-04-24 15:50:52'),
(236, 39, 2, 18974, '::1', '2023-04-24 15:50:52'),
(237, 40, 2, 18974, '::1', '2023-04-24 15:50:52'),
(238, 41, 2, 18974, '::1', '2023-04-24 15:50:52'),
(239, 42, 2, 18974, '::1', '2023-04-24 15:50:52'),
(240, 43, 2, 18974, '::1', '2023-04-24 15:50:52'),
(241, 44, 2, 18974, '::1', '2023-04-24 15:50:52'),
(242, 45, 2, 18974, '::1', '2023-04-24 15:50:52'),
(243, 46, 2, 18974, '::1', '2023-04-24 15:50:52'),
(244, 47, 2, 18974, '::1', '2023-04-24 15:50:52'),
(245, 48, 2, 18974, '::1', '2023-04-24 15:50:52'),
(246, 49, 2, 18974, '::1', '2023-04-24 15:50:52'),
(247, 50, 2, 18974, '::1', '2023-04-24 15:50:52'),
(248, 51, 2, 18974, '::1', '2023-04-24 15:50:52'),
(249, 52, 2, 18974, '::1', '2023-04-24 15:50:52'),
(250, 53, 2, 18974, '::1', '2023-04-24 15:50:52'),
(251, 54, 2, 18974, '::1', '2023-04-24 15:50:52'),
(252, 55, 2, 18974, '::1', '2023-04-24 15:50:52'),
(253, 56, 2, 18974, '::1', '2023-04-24 15:50:52'),
(254, 57, 2, 18974, '::1', '2023-04-24 15:50:52'),
(255, 58, 2, 18974, '::1', '2023-04-24 15:50:52'),
(256, 59, 2, 18974, '::1', '2023-04-24 15:50:52'),
(257, 60, 2, 18974, '::1', '2023-04-24 15:50:52'),
(258, 61, 2, 18974, '::1', '2023-04-24 15:50:52'),
(259, 62, 2, 18974, '::1', '2023-04-24 15:50:52'),
(260, 63, 2, 18974, '::1', '2023-04-24 15:50:52'),
(261, 64, 2, 18974, '::1', '2023-04-24 15:50:52'),
(262, 65, 2, 18974, '::1', '2023-04-24 15:50:52'),
(263, 66, 2, 18974, '::1', '2023-04-24 15:50:52'),
(264, 67, 2, 18974, '::1', '2023-04-24 15:50:52'),
(265, 1, 2, 18974, '::1', '2023-04-24 15:50:52'),
(266, 30, 3, 18974, '::1', '2023-04-24 15:50:52'),
(267, 30, 4, 18974, '::1', '2023-04-24 15:50:52'),
(268, 30, 5, 18974, '::1', '2023-04-24 15:50:52'),
(269, 30, 6, 18974, '::1', '2023-04-24 15:50:52'),
(270, 30, 7, 18974, '::1', '2023-04-24 15:50:52'),
(271, 30, 8, 18974, '::1', '2023-04-24 15:50:52'),
(272, 30, 9, 18974, '::1', '2023-04-24 15:50:52'),
(273, 30, 10, 18974, '::1', '2023-04-24 15:50:52'),
(274, 30, 11, 18974, '::1', '2023-04-24 15:50:52'),
(275, 30, 12, 18974, '::1', '2023-04-24 15:50:52'),
(276, 30, 13, 18974, '10.25.12.10', '2023-10-16 14:07:04'),
(277, 61, 3, 18974, '10.25.11.180', '2023-10-17 11:36:56'),
(278, 61, 5, 18974, '10.25.11.180', '2023-10-17 11:36:59'),
(279, 61, 6, 18974, '10.25.11.180', '2023-10-17 11:37:02'),
(280, 61, 9, 18974, '10.25.11.180', '2023-10-17 11:37:04'),
(281, 61, 7, 18974, '10.25.11.180', '2023-10-17 11:37:05'),
(282, 61, 10, 18974, '10.25.11.180', '2023-10-17 11:37:06'),
(283, 61, 4, 18974, '10.25.11.180', '2023-10-17 11:37:08'),
(284, 61, 11, 18974, '10.25.11.180', '2023-10-17 11:37:09'),
(285, 61, 12, 18974, '10.25.11.180', '2023-10-17 11:37:09'),
(286, 61, 13, 18974, '10.25.11.180', '2023-10-17 11:37:10'),
(287, 61, 8, 18974, '10.25.11.180', '2023-10-17 11:37:13'),
(288, 11, 8, 28120, '10.25.11.180', '2023-10-17 16:43:55'),
(289, 4, 8, 28120, '10.25.11.180', '2023-10-17 16:44:46'),
(290, 12, 8, 28120, '10.25.11.180', '2023-10-17 16:44:58'),
(291, 3, 8, 28120, '10.25.11.180', '2023-10-17 16:45:06'),
(292, 19, 8, 28120, '10.25.11.180', '2023-10-17 16:45:15'),
(293, 21, 8, 28120, '10.25.11.180', '2023-10-17 16:45:28'),
(294, 9, 8, 28120, '10.25.11.180', '2023-10-17 16:45:32'),
(295, 61, 14, 28120, '10.25.11.180', '2023-11-21 14:11:08'),
(296, 30, 14, 28120, '10.25.11.180', '2023-11-21 14:11:18'),
(299, 61, 16, 28120, '::1', '2024-09-17 15:25:00'),
(300, 35, 17, 28120, '::1', '2024-09-17 15:25:00'),
(301, 5, 15, 28120, '127.0.0.1', '2024-12-24 14:20:51'),
(302, 35, 15, 28120, '127.0.0.1', '2024-12-24 14:21:00'),
(303, 36, 15, 28120, '127.0.0.1', '2024-12-24 14:21:11'),
(304, 51, 15, 28120, '127.0.0.1', '2024-12-24 14:21:20'),
(305, 53, 15, 28120, '127.0.0.1', '2024-12-24 14:21:27'),
(306, 61, 15, 28120, '127.0.0.1', '2024-12-24 14:21:47'),
(307, 37, 15, 28120, '127.0.0.1', '2024-12-24 14:22:13'),
(308, 51, 17, 28120, '127.0.0.1', '2024-12-24 14:27:57'),
(309, 53, 17, 28120, '127.0.0.1', '2024-12-24 14:28:07'),
(310, 36, 17, 28120, '127.0.0.1', '2024-12-24 14:28:15'),
(311, 37, 17, 28120, '127.0.0.1', '2024-12-24 14:28:21'),
(312, 5, 17, 28120, '127.0.0.1', '2024-12-24 14:28:36'),
(313, 28, 15, 28120, '10.25.12.30', '2024-12-24 15:42:02'),
(314, 28, 16, 28120, '10.25.12.30', '2024-12-24 15:42:03'),
(315, 28, 17, 28120, '10.25.12.30', '2024-12-24 15:42:04'),
(316, 61, 17, 28120, '::1', '2024-12-26 11:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `autoID` int(11) NOT NULL,
  `noti_title` varchar(200) DEFAULT NULL,
  `noti_description` varchar(500) DEFAULT NULL,
  `active_till` date DEFAULT NULL,
  `noti_active` int(11) NOT NULL DEFAULT '1',
  `by_mail` tinyint(1) NOT NULL DEFAULT '0',
  `noti_link` varchar(500) NOT NULL,
  `isdeleted` int(11) NOT NULL DEFAULT '0',
  `addedbyip` varchar(100) NOT NULL,
  `addedby` int(11) NOT NULL,
  `updatedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`autoID`, `noti_title`, `noti_description`, `active_till`, `noti_active`, `by_mail`, `noti_link`, `isdeleted`, `addedbyip`, `addedby`, `updatedon`) VALUES
(6, 'AIMS:Help file', 'Help manual for AIMS : Asset & Inventory Management System', '2024-02-29', 1, 0, 'webapp.barc.gov.in/aims/aims_help.pdf', 1, '10.25.11.180', 28120, '2025-03-06 12:52:39'),
(7, 'aaa', 'aaa', '2024-02-09', 1, 0, '', 1, '::1', 28120, '2025-03-06 12:52:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pc_details`
--

CREATE TABLE `tbl_pc_details` (
  `pc_make_model` int(11) DEFAULT NULL,
  `pc_supplier_name` varchar(100) NOT NULL,
  `pc_indent_no` varchar(100) NOT NULL,
  `pc_indent_dt` date NOT NULL,
  `pc_indent_by` varchar(100) NOT NULL COMMENT 'INDENT BY NAME OF EMP',
  `autoID` int(11) NOT NULL,
  `pc_os` varchar(100) NOT NULL,
  `pc_make` varchar(100) DEFAULT NULL,
  `pc_processor_details` varchar(100) DEFAULT NULL,
  `pc_form` varchar(100) DEFAULT NULL,
  `pc_monitor_details` varchar(100) DEFAULT NULL,
  `pc_bit_type` varchar(50) NOT NULL,
  `pc_ram_value` varchar(100) DEFAULT NULL,
  `pc_hdd` varchar(100) DEFAULT NULL,
  `pc_ssd` int(11) NOT NULL,
  `pc_nic_number` int(11) NOT NULL DEFAULT '1',
  `pc_setup` varchar(100) NOT NULL,
  `pc_ip` varchar(50) NOT NULL,
  `pc_user_emp` int(11) NOT NULL,
  `pc_user_group` int(11) NOT NULL,
  `pc_barc_asset_id` varchar(100) NOT NULL,
  `pc_amc_id` varchar(50) NOT NULL,
  `pc_po_no` varchar(100) DEFAULT NULL,
  `pc_po_dt` date DEFAULT NULL,
  `pc_rv_no` varchar(100) NOT NULL,
  `pc_rv_dt` date NOT NULL,
  `rvfileuploaded` tinyint(1) NOT NULL DEFAULT '0',
  `rvfilename` varchar(100) DEFAULT NULL,
  `pc_cost` varchar(100) DEFAULT NULL,
  `pc_source` enum('Centralize','Borrowed','Individual') NOT NULL DEFAULT 'Centralize',
  `network_port_no` varchar(20) NOT NULL,
  `pc_location` varchar(100) NOT NULL,
  `pc_use` enum('official use','service use') NOT NULL DEFAULT 'official use',
  `under_amc` tinyint(1) NOT NULL DEFAULT '1',
  `warranty_in_years` int(11) DEFAULT NULL,
  `warranty_till` date NOT NULL,
  `groupadmin_approval` tinyint(1) NOT NULL DEFAULT '0',
  `groupadmin_approved_by` varchar(20) DEFAULT NULL,
  `sysadmin_approved_by` varchar(20) DEFAULT NULL,
  `sysadmin_approval` tinyint(1) NOT NULL DEFAULT '0',
  `groupadmin_approvedon` datetime NOT NULL,
  `sysadmin_approvedon` datetime NOT NULL,
  `pc_added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `updatedbyip` varchar(50) DEFAULT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `current_status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = in-use with user; 0: in inventory; 2: at maintenance/repair; 3: ready for scrap; 4: scrapped; 5: other',
  `working` tinyint(1) NOT NULL DEFAULT '1',
  `aimsid` varchar(75) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pc_details`
--

INSERT INTO `tbl_pc_details` (`pc_make_model`, `pc_supplier_name`, `pc_indent_no`, `pc_indent_dt`, `pc_indent_by`, `autoID`, `pc_os`, `pc_make`, `pc_processor_details`, `pc_form`, `pc_monitor_details`, `pc_bit_type`, `pc_ram_value`, `pc_hdd`, `pc_ssd`, `pc_nic_number`, `pc_setup`, `pc_ip`, `pc_user_emp`, `pc_user_group`, `pc_barc_asset_id`, `pc_amc_id`, `pc_po_no`, `pc_po_dt`, `pc_rv_no`, `pc_rv_dt`, `rvfileuploaded`, `rvfilename`, `pc_cost`, `pc_source`, `network_port_no`, `pc_location`, `pc_use`, `under_amc`, `warranty_in_years`, `warranty_till`, `groupadmin_approval`, `groupadmin_approved_by`, `sysadmin_approved_by`, `sysadmin_approval`, `groupadmin_approvedon`, `sysadmin_approvedon`, `pc_added_on`, `isdeleted`, `updatedbyip`, `updatedon`, `current_status`, `working`, `aimsid`) VALUES
(55, '', '', '0000-00-00', '', 145, '14', NULL, NULL, NULL, NULL, '32bit', '16', '1000', 512, 1, 'internet+intranet', 'NA', 1000, 0, '', '', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', '', 'Programming Lab, 1st floor', 'official use', 1, NULL, '0000-00-00', 1, '1000', '1000', 1, '2025-03-06 12:05:18', '2025-03-06 12:05:25', '2025-03-06 11:59:05', 0, '::1', '2025-03-06 12:05:25', 1, 1, 'SIRD/AIMS/PC/39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pc_make`
--

CREATE TABLE `tbl_pc_make` (
  `autoID` int(11) NOT NULL,
  `pc_make` varchar(50) NOT NULL,
  `pc_model` varchar(100) NOT NULL,
  `pc_processor` varchar(100) NOT NULL,
  `pc_ram_details` float NOT NULL DEFAULT '0',
  `pc_hdd_details` float NOT NULL DEFAULT '0',
  `pc_ssd_details` int(11) DEFAULT NULL,
  `pc_os_details` int(100) NOT NULL,
  `pc_monitor_details` varchar(100) NOT NULL,
  `indent_no` varchar(100) NOT NULL,
  `indent_dt` date NOT NULL,
  `indentor_emp` varchar(100) NOT NULL,
  `rv_no` varchar(100) NOT NULL,
  `rv_dt` date NOT NULL,
  `rvfileuploaded` tinyint(1) NOT NULL DEFAULT '0',
  `rvfilename` varchar(500) DEFAULT NULL,
  `po_no` varchar(100) NOT NULL,
  `po_dt` date NOT NULL,
  `pc_cost` varchar(10) NOT NULL,
  `details_of_supplier` varchar(500) NOT NULL,
  `qty_received` int(11) DEFAULT NULL,
  `warranty_in_years` int(11) DEFAULT NULL,
  `warranty_upto` date NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedbyip` varchar(50) NOT NULL,
  `pc_remarks` varchar(100) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `pc_form` varchar(50) NOT NULL DEFAULT 'desktop'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pc_make`
--

INSERT INTO `tbl_pc_make` (`autoID`, `pc_make`, `pc_model`, `pc_processor`, `pc_ram_details`, `pc_hdd_details`, `pc_ssd_details`, `pc_os_details`, `pc_monitor_details`, `indent_no`, `indent_dt`, `indentor_emp`, `rv_no`, `rv_dt`, `rvfileuploaded`, `rvfilename`, `po_no`, `po_dt`, `pc_cost`, `details_of_supplier`, `qty_received`, `warranty_in_years`, `warranty_upto`, `updatedby`, `updatedbyip`, `pc_remarks`, `updatedon`, `isdeleted`, `pc_form`) VALUES
(55, 'CYNIX', 'Intel Core i5 12400', '', 16, 1000, 512, 14, '21.5 in LED Res. 1920x1080', 'BARC/CENZ/SIRD/23-24/106', '2023-06-26', 'Shri Ajith Balan', '54031/23-24', '2024-01-25', 0, NULL, 'DPS/CPU/04/C1/3645/PO/GEMC-511687761596772 ', '2023-11-06', '63500', 'COMPUTER INFOTECH ( INDIA )PRIVATE LIMITED', 30, 3, '2027-01-18', 28120, '10.25.11.180', '', '2024-01-30 10:14:06', 0, 'desktop');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pc_os`
--

CREATE TABLE `tbl_pc_os` (
  `autoID` int(11) NOT NULL,
  `os_name` varchar(50) NOT NULL,
  `os_of` enum('WINDOWS','LINUX') NOT NULL,
  `os_remarks` varchar(100) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pc_os`
--

INSERT INTO `tbl_pc_os` (`autoID`, `os_name`, `os_of`, `os_remarks`, `isdeleted`) VALUES
(1, 'Windows 7 Pro', 'WINDOWS', '', 0),
(2, 'Windows 7 Ultimate', 'WINDOWS', '', 0),
(3, 'Windows 7', 'WINDOWS', '', 0),
(4, 'Windows 8.1 Pro', 'WINDOWS', '', 0),
(5, 'Windows 10', 'WINDOWS', '', 0),
(6, 'Ubuntu XFCE', 'LINUX', '', 0),
(7, 'Windows XP', 'WINDOWS', '', 0),
(8, 'Windows 10 Pro', 'WINDOWS', '', 0),
(10, 'Linux Mint', 'LINUX', '', 0),
(11, 'Windows Server 2012 R2', 'WINDOWS', '', 0),
(12, 'Windows Server 2003', 'WINDOWS', '', 0),
(13, 'Redhat Linux', 'LINUX', '', 0),
(14, 'Windows 11 Pro', 'WINDOWS', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_printer_details`
--

CREATE TABLE `tbl_printer_details` (
  `device_supplier_details` varchar(500) NOT NULL,
  `device` enum('Printer','Scanner','MFD') DEFAULT NULL,
  `device_make_model` int(11) DEFAULT NULL,
  `device_indent_no` varchar(100) NOT NULL,
  `device_indent_dt` date NOT NULL,
  `device_indent_by` varchar(100) NOT NULL COMMENT 'INDENT BY NAME OF EMP',
  `autoID` int(11) NOT NULL,
  `device_make` varchar(100) DEFAULT NULL,
  `device_model` varchar(100) DEFAULT NULL,
  `device_tone` enum('Colour','Black & White') NOT NULL,
  `device_user_emp` int(11) NOT NULL,
  `device_user_group` int(11) NOT NULL,
  `device_barc_asset_id` varchar(100) NOT NULL,
  `device_amc_id` varchar(50) NOT NULL,
  `device_po_no` varchar(100) DEFAULT NULL,
  `device_po_dt` date DEFAULT NULL,
  `device_rv_no` varchar(100) NOT NULL,
  `device_rv_dt` date NOT NULL,
  `rvfileuploaded` tinyint(1) NOT NULL DEFAULT '0',
  `rvfilename` varchar(100) DEFAULT NULL,
  `device_cost` varchar(100) DEFAULT NULL,
  `device_source` enum('Centralize','Borrowed','Individual') NOT NULL DEFAULT 'Centralize',
  `device_location` varchar(100) NOT NULL,
  `device_use` enum('official use','service use') NOT NULL DEFAULT 'official use',
  `under_amc` tinyint(1) NOT NULL DEFAULT '1',
  `warranty_in_years` int(11) DEFAULT NULL,
  `warranty_till` date NOT NULL,
  `groupadmin_approval` tinyint(1) NOT NULL DEFAULT '0',
  `groupadmin_approved_by` varchar(20) DEFAULT NULL,
  `sysadmin_approval` tinyint(1) NOT NULL DEFAULT '0',
  `groupadmin_approvedon` datetime NOT NULL,
  `sysadmin_approvedon` datetime NOT NULL,
  `sysadmin_approved_by` varchar(20) DEFAULT NULL,
  `device_added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `updatedbyip` varchar(50) DEFAULT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `current_status` int(11) NOT NULL DEFAULT '1' COMMENT '1 = in-use with user; 0: in inventory; 2: at maintenance/repair; 3: ready for scrap; 4: scrapped; 5: other',
  `working` tinyint(1) NOT NULL DEFAULT '1',
  `aimsid` varchar(75) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_printer_details`
--

INSERT INTO `tbl_printer_details` (`device_supplier_details`, `device`, `device_make_model`, `device_indent_no`, `device_indent_dt`, `device_indent_by`, `autoID`, `device_make`, `device_model`, `device_tone`, `device_user_emp`, `device_user_group`, `device_barc_asset_id`, `device_amc_id`, `device_po_no`, `device_po_dt`, `device_rv_no`, `device_rv_dt`, `rvfileuploaded`, `rvfilename`, `device_cost`, `device_source`, `device_location`, `device_use`, `under_amc`, `warranty_in_years`, `warranty_till`, `groupadmin_approval`, `groupadmin_approved_by`, `sysadmin_approval`, `groupadmin_approvedon`, `sysadmin_approvedon`, `sysadmin_approved_by`, `device_added_on`, `isdeleted`, `updatedbyip`, `updatedon`, `current_status`, `working`, `aimsid`) VALUES
('', NULL, 17, '', '0000-00-00', '', 1, NULL, NULL, 'Colour', 14340, 0, 'BARC/I/C-64/7804', 'LJ/2010', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'LM-15, Central Library', 'official use', 1, NULL, '0000-00-00', 1, '14340', 1, '2023-10-25 14:37:08', '2024-03-14 11:07:48', '18974', '2023-10-17 10:44:16', 0, '10.25.21.50', '2024-03-14 11:07:48', 1, 1, 'SIRD/AIMS/Dev/3'),
('', NULL, 17, '', '0000-00-00', '', 2, NULL, NULL, 'Colour', 20894, 0, 'BARC/I/C-64/7806', 'LJ/2009', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'Digital Library', 'official use', 1, NULL, '0000-00-00', 1, '18974', 0, '2023-11-10 14:47:12', '0000-00-00 00:00:00', NULL, '2023-10-17 10:45:53', 0, '10.25.31.10', '2023-11-10 14:47:12', 1, 1, '0'),
('', NULL, 19, '', '0000-00-00', '', 3, NULL, NULL, 'Colour', 14340, 0, 'BARC/I/C-65/338', 'SCN/350', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'LM-15, Central Library', 'official use', 1, NULL, '0000-00-00', 1, '14340', 0, '2023-10-25 14:37:15', '0000-00-00 00:00:00', NULL, '2023-10-17 10:47:03', 0, '10.25.21.50', '2023-10-25 14:37:15', 1, 1, '0'),
('', NULL, 17, '', '0000-00-00', '', 4, NULL, NULL, 'Colour', 18974, 0, 'BARC/I', 'PC/', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-4', 'official use', 1, NULL, '0000-00-00', 1, '18974', 0, '2023-11-10 14:47:09', '0000-00-00 00:00:00', NULL, '2023-10-17 11:29:51', 0, '10.25.12.10', '2024-01-08 14:41:10', 1, 1, '0'),
('', NULL, 19, '', '0000-00-00', '', 5, NULL, NULL, 'Colour', 28120, 0, 'BARC/I/C-65/32', 'SCN/011', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'CC, A-1-7', 'official use', 1, NULL, '0000-00-00', 1, '18974', 0, '2023-11-10 14:47:21', '0000-00-00 00:00:00', NULL, '2023-10-17 15:07:11', 0, '10.25.11.180', '2023-11-10 14:47:21', 1, 1, '0'),
('', NULL, 18, '', '0000-00-00', '', 6, NULL, NULL, 'Colour', 28120, 0, 'BARC/I/C-64/7807', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'CC, A-1-7', 'official use', 1, NULL, '0000-00-00', 1, '18974', 0, '2023-11-10 14:47:35', '0000-00-00 00:00:00', NULL, '2023-10-17 15:08:46', 0, '10.25.11.180', '2023-11-10 14:47:35', 1, 1, '0'),
('', NULL, 23, '', '0000-00-00', '', 9, NULL, NULL, 'Colour', 18974, 0, 'BARC/I', 'AMC with SKS', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-4', 'official use', 1, NULL, '0000-00-00', 1, '18974', 0, '2023-11-10 14:47:07', '0000-00-00 00:00:00', NULL, '2023-10-18 13:21:46', 0, '10.25.12.10', '2024-01-08 14:41:14', 1, 1, '0'),
('', NULL, 16, '', '0000-00-00', '', 10, NULL, NULL, 'Colour', 14118, 0, 'BARC/I/C.64/7799', 'MFD/0054', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-2', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-10-18 17:21:15', 0, '10.25.11.33', '2023-10-18 17:21:15', 1, 1, '0'),
('', NULL, 16, '', '0000-00-00', '', 11, NULL, NULL, 'Colour', 17380, 0, 'BARC/I/C-64/7801', 'MFD/0969', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'LM-3', 'official use', 1, NULL, '0000-00-00', 1, '14340', 0, '2023-10-25 14:38:52', '0000-00-00 00:00:00', NULL, '2023-10-18 17:33:30', 0, '10.25.21.130', '2023-10-25 14:38:52', 1, 1, '0'),
('Avant Computer Technologies Systems Pvt. Ltd.', 'Printer', NULL, 'BARC/LPS/SIRD/104/2017-18/OPA/183734', '2017-10-20', 'Rekha P. Upadhye', 12, '1', 'LASER JET PRO M403d', 'Black & White', 21323, 0, 'NA', 'NA', 'BARC/LPS/SIRD/104/2017-18/OPA/183734/OPA/15574', '2018-01-19', '531/17', '2018-02-07', 1, 'RV-1-12.pdf', '22700', 'Individual', 'CENTRAL LIBRARY-LM-8', 'official use', 1, 1, '2018-01-30', 1, '12520', 0, '2023-10-23 15:52:00', '0000-00-00 00:00:00', NULL, '2023-10-19 14:59:52', 0, '10.25.22.111', '2023-10-23 15:52:00', 1, 1, '0'),
('Avant Computer Technologies Systems Pvt. Ltd.', 'Printer', NULL, 'BARC/LPS/SIRD/104/2017-18/OPA/183734', '2017-10-20', 'Rekha P. Upadhye', 13, '1', 'LASER JET PRO M403d', 'Black & White', 12520, 0, 'NA', 'NA', 'BARC/LPS/SIRD/104/2017-18/OPA/183734/OPA/15574', '2018-01-19', '531/17', '2018-02-07', 1, 'IND-1-13.pdf', '22700', 'Individual', 'Central Library, LM-10', 'official use', 1, 1, '2018-01-30', 1, '12520', 1, '2023-10-26 17:14:51', '2024-03-14 11:05:01', '18974', '2023-10-26 16:15:06', 0, '10.25.22.81', '2024-03-14 11:05:01', 1, 1, 'SIRD/AIMS/Dev/1'),
('', NULL, 17, '', '0000-00-00', '', 14, NULL, NULL, 'Colour', 24706, 0, 'NA', '3505', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'New Extension_Mezzanine Floor_Central Library', 'official use', 1, NULL, '0000-00-00', 1, '17036', 0, '2023-10-30 08:40:35', '0000-00-00 00:00:00', NULL, '2023-10-27 10:24:53', 0, '10.25.31.21', '2023-10-30 08:40:35', 1, 1, '0'),
('', NULL, 17, '', '0000-00-00', '', 15, NULL, NULL, 'Colour', 24707, 0, 'NA', 'PRN/3503', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'bound volume room', 'official use', 1, NULL, '0000-00-00', 1, '17036', 0, '2023-10-30 08:41:21', '0000-00-00 00:00:00', NULL, '2023-10-27 14:37:51', 0, '10.25.21.230', '2023-10-30 08:41:21', 1, 1, '0'),
('Avant Computer Technologies Systems Pvt. Ltd.', 'Printer', NULL, 'BARC/LPS/SIRD/104/2017-18/OPA/183734', '2017-10-20', 'Rekha P. Upadhye', 16, '1', 'LASER JET PRO M403D', 'Black & White', 20131, 0, 'NA', 'NA', 'BARC/LPS/SIRD/104/2017-18/OPA/183734/OPA/15574', '2018-01-19', '531/17', '2018-02-07', 0, NULL, '22700', 'Individual', 'LM-11, Central Library', 'official use', 1, 1, '2018-01-30', 1, '12520', 1, '2023-10-31 14:31:47', '2024-03-14 11:05:28', '18974', '2023-10-27 15:31:02', 0, '10.25.22.70', '2024-03-14 11:05:28', 1, 1, 'SIRD/AIMS/Dev/2'),
('', NULL, 16, '', '0000-00-00', '', 17, NULL, NULL, 'Colour', 17038, 0, 'BARC/I/C-64/7800', 'MFD/0026', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'Central Library', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-03 16:36:42', 0, '10.25.21.40', '2023-11-03 16:36:42', 1, 1, '0'),
(' Hp World Geonet IT Mall, Shop No.5, Mansarover Building, S.V. Road, Santacruz (W), Mumbai-400054.', 'Printer', NULL, 'BARC/LPS/SIRD/104/16-17/06', '2016-09-29', 'Dr. P. R. Unni', 18, '1', 'Officejet 7612', 'Colour', 13414, 0, 'Not allotted yet.', 'AMC ID not allotted yet.', 'BARC/LPS/SIRD/104/16-17/06', '2016-11-18', '442/16', '2017-01-12', 1, 'RV-1-18.pdf', '25000', 'Individual', 'Room LM-13, Central Library', 'official use', 1, 1, '2018-01-09', 1, '18974', 0, '2023-11-10 14:46:55', '0000-00-00 00:00:00', NULL, '2023-11-07 12:06:17', 0, '10.25.21.30', '2023-11-10 14:46:55', 1, 1, '0'),
('', NULL, 22, '', '0000-00-00', '', 19, NULL, NULL, 'Colour', 23892, 0, 'BARC/I/C-64/2230', 'PRN/042', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'LM-10 Binding unit', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-07 12:34:37', 0, '10.25.22.32', '2024-02-09 12:30:33', 1, 1, '0'),
('', NULL, 17, '', '0000-00-00', '', 20, NULL, NULL, 'Colour', 22779, 0, 'BARC/I/C-64/7803', 'LJ/2014', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-8, CC', 'official use', 1, NULL, '0000-00-00', 1, '18974', 0, '2023-11-10 14:47:28', '0000-00-00 00:00:00', NULL, '2023-11-10 14:25:20', 0, '10.25.11.211', '2023-11-10 14:47:28', 1, 1, '0'),
('M/S. CREW BUSINESS SYSTEMS, Ghatkopar west, Mumbai', 'MFD', NULL, 'BARC/CENZ/SIRD/16-17/1609', '2017-01-23', 'R M GUND', 23, '9', 'BIZHUB C558', 'Colour', 20214, 0, 'NA', 'NA', 'DPS/CPU/A1/663-A/PO/237273', '2018-03-14', 'NA', '2018-03-27', 1, 'RV-9-23.pdf', '539000', 'Individual', 'A-1-2, CC', 'service use', 1, 1, '2019-03-26', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-14 11:28:16', 0, '10.25.11.41', '2023-11-14 11:28:16', 1, 1, '0'),
('KONICA MINOLTA BUSINESS SOLUTIONS INDIA PVT LTD., GURGAON, HARYANA', 'MFD', NULL, 'BARC/CENZ/SIRD/21-22/380', '2021-10-20', 'S K SINGH', 24, '9', 'BIZHUB C360i', 'Colour', 20214, 0, 'NA', 'NA', 'DPS/CPU/04/D3/2807/PO/511687742509568', '2021-12-15', 'CENZ/303435/21-22', '2022-02-25', 1, 'IND-9-24.pdf', '515163.00', 'Individual', 'A-1-2, CC', 'official use', 1, 3, '2025-02-21', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-15 09:47:25', 0, '10.25.11.41', '2023-11-15 14:40:39', 1, 1, '0'),
('', NULL, 29, '', '0000-00-00', '', 25, NULL, NULL, 'Colour', 17213, 0, 'BARC/I/C-65/337', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'LM-3, Central Library', 'official use', 1, NULL, '0000-00-00', 1, '14340', 0, '2023-12-06 17:44:57', '0000-00-00 00:00:00', NULL, '2023-11-20 08:39:28', 0, '10.25.21.110', '2024-02-19 17:04:31', 1, 1, '0'),
('', NULL, 33, '', '0000-00-00', '', 26, NULL, NULL, 'Colour', 13982, 0, 'NA', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-1, CC', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-20 11:15:45', 0, '10.25.11.180', '2023-11-20 11:15:45', 1, 1, '0'),
('Avant Computer Technologies Systems Pvt. Ltd.', 'Printer', NULL, 'BARC/LPS/SIRD/104/', '2017-10-20', 'Avinash Rahalakar', 27, '1', 'HP COLOR LASERJET PRO MFP M377 DW', 'Colour', 17179, 0, 'BARC/I', 'PC/', 'BARC/LPS/SIRD/104/2018', '2018-01-19', '041/2018', '2018-01-01', 0, NULL, '22700', 'Individual', 'S12 CC AUDITORIUM SIRD', 'official use', 1, 0, '2019-01-30', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-23 15:02:01', 0, '10.25.41.200', '2023-11-23 15:02:01', 1, 1, '0'),
('Avant Computer Technologies Systems Pvt. Ltd.', 'Printer', NULL, 'BARC/LPS/SIRD/104/2011-12/OPA/183734', '2011-10-20', 'R.K. Singh', 28, '1', 'LASERJET 100 color MFP m175a', 'Colour', 17056, 0, 'BARC/I/C-64/4525', 'MFD/0020', 'BARC/LPS/SIRD/104/2011-12/OPA/183734/OPA/15574', '2012-01-19', '531/12', '2012-02-07', 0, NULL, '35000', 'Individual', 'S-23, CC AUDITORIUM', 'official use', 1, 0, '2013-01-30', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-29 11:30:33', 0, '10.25.41.160', '2023-11-29 11:30:33', 1, 0, '0'),
('Avant Computer Technologies Systems Pvt. Ltd.', 'MFD', NULL, 'BARC/LPS/SIRD/104/2013-14/OPA/183735', '2013-10-20', 'R.K. Singh', 29, '1', 'Color Laserjet Pro MFP M176n', 'Colour', 17056, 0, 'BARC/I/C-64/6467', 'MFD/0020', 'BARC/LPS/SIRD/104/2013-14/OPA/183735/OPA/15575', '2014-01-19', '581/14', '2014-02-07', 0, NULL, '39000', 'Individual', '207, 2nd floor, DAE Convention Centre', 'official use', 1, 0, '2015-01-30', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-29 11:55:33', 0, '10.25.41.160', '2023-11-29 11:57:21', 1, 1, '0'),
('', NULL, 18, '', '0000-00-00', '', 30, NULL, NULL, 'Colour', 20892, 0, 'BARC/I/C-64/7808', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-5, CC', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-29 15:15:28', 0, '10.25.11.210', '2023-11-29 15:15:28', 1, 1, '0'),
('', NULL, 25, '', '0000-00-00', '', 31, NULL, NULL, 'Colour', 14951, 0, 'BARC/I/C-64/6468', 'MFD/0019', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'S-25 cc auditorium', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-11-30 11:25:03', 0, '10.25.41.180', '2023-11-30 11:25:03', 1, 1, '0'),
('', NULL, 18, '', '0000-00-00', '', 33, NULL, NULL, 'Colour', 18875, 0, 'BARC/I/C-64/7809', 'LJ/2013', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A1-5, CC Ist Floor', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-12-08 12:27:40', 0, '10.25.11.130', '2023-12-08 12:28:25', 1, 1, '0'),
('', NULL, 29, '', '0000-00-00', '', 34, NULL, NULL, 'Colour', 18875, 0, 'BARC/I/C-65/336', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A1-5, CC Ist Floor', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-12-08 12:30:56', 0, '10.25.11.130', '2023-12-08 12:30:56', 1, 1, '0'),
('KORES (INDIA) LTD, WORLI, MUMBAI-18', 'Printer', NULL, 'BARC/CENZ/SIRD/44/07-08/596', '2008-02-27', 'M. P. SOMAN', 35, '14', 'RISO MZ 770', 'Colour', 20214, 0, 'BARC/I/F02/90', 'NA', 'DPS/04/CAP/17826/PO/187882', '2008-06-24', '121312', '2008-07-11', 1, 'RV-14-35.pdf', '675000', 'Individual', 'A-1-2, CC', 'official use', 1, 1, '2009-06-10', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2023-12-11 11:50:17', 0, '10.25.11.41', '2023-12-11 11:50:17', 1, 1, '0'),
('SONU ENTERPRISES', 'Printer', NULL, 'DPS/LPS/BARC/181697/TO/219057', '2010-10-27', 'Smt V.B. Tilak', 36, '1', 'Laserjet 1020 Plus', 'Black & White', 17213, 0, 'BARC/I/C-64/3612', 'LJ/1447', 'SIRD/9/10-11/490/117', '2011-01-14', 'LPS 114315', '2010-12-28', 1, 'IND-1-36.pdf', '5773', 'Individual', 'LM-3, Central Library', 'official use', 1, 0, '0000-01-01', 1, '14340', 0, '2023-12-14 12:51:14', '0000-00-00 00:00:00', NULL, '2023-12-12 08:43:53', 0, '10.25.21.110', '2023-12-14 12:51:14', 1, 1, '0'),
('Aaradhya Enterprises', 'MFD', NULL, 'BARC/CENZ/SIRD/22-23/252', '2022-07-14', 'S K Singh', 37, '9', 'Bizhub550i', 'Black & White', 20215, 0, 'NA', 'NA', 'DPS/CPU/04/A2/3592-A/PO/GEMC-511687746938797', '2023-09-21', 'GEMC-511687746938797', '2023-09-21', 1, 'IND-9-37.pdf', '392511', 'Individual', 'A-1-2, CC', 'official use', 1, 1, '2024-12-11', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-03 14:39:07', 0, '10.25.11.40', '2024-01-03 14:42:00', 1, 1, '0'),
('Aaradhya Enterprises', 'MFD', NULL, 'BARC/CENZ/SIRD/22-23/252', '2022-07-14', 'S K Singh', 38, '9', 'Bizhub 205i', 'Black & White', 28120, 0, 'NA', 'NA', 'DPS/CPU/04/A2/3592-A/PO/GEMC-511687746938797', '2023-09-21', 'GEMC-511687746938797', '2023-09-21', 1, 'RV-9-38.pdf', '55641', 'Individual', 'A-1-6 [Server Room], CC', 'official use', 1, 1, '2024-09-20', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-03 15:00:39', 0, '10.25.11.180', '2024-01-03 15:00:39', 1, 1, '0'),
('', NULL, 20, '', '0000-00-00', '', 39, NULL, NULL, 'Colour', 14992, 0, 'BARC/I/C-64/7802', 'Not available', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-12', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-04 10:49:24', 0, '10.25.12.41', '2024-01-04 10:49:24', 1, 0, '0'),
('', NULL, 28, '', '0000-00-00', '', 40, NULL, NULL, 'Colour', 14992, 0, 'BARC/I/E-02/124', 'Not avaliable', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-12', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-04 10:53:32', 0, '10.25.12.41', '2024-01-04 10:53:32', 1, 0, '0'),
('', NULL, 31, '', '0000-00-00', '', 41, NULL, NULL, 'Colour', 14992, 0, 'Not avaliable', 'Not avaliable', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-16-A', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-04 10:53:32', 0, '10.25.12.41', '2024-01-04 15:48:55', 1, 0, '0'),
('', NULL, 32, '', '0000-00-00', '', 42, NULL, NULL, 'Colour', 16492, 0, 'NOT AVAILABLE', 'NOT AVAILABLE', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-12', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-04 10:56:33', 0, '10.25.12.42', '2024-01-04 10:56:33', 1, 1, '0'),
('', NULL, 19, '', '0000-00-00', '', 43, NULL, NULL, 'Colour', 24115, 0, 'BARC/I/C.65/33', 'SC/0015', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-16B', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-04 11:03:04', 0, '10.25.12.60', '2024-01-04 11:03:04', 1, 1, '0'),
('micropoint computer LTD', 'Scanner', NULL, 'BARC/CENZ/SIRD/22/11-12/319', '2011-08-23', 'N.M. POTE', 45, '1', 'G4050', 'Colour', 19138, 0, 'BARC/I/C.65/0218', 'SCN/778', 'DPS/LPS/BARC/188479/TO/226775', '2012-01-13', 'lps-123784', '2012-02-08', 0, NULL, '22000', 'Individual', 'LM-19', 'official use', 1, 1, '2013-02-08', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-09 10:32:58', 0, '10.25.23.50', '2024-01-09 10:32:58', 1, 1, '0'),
('ROHRA COMPUTER PRODUCTS', 'Printer', NULL, 'BARC/CENZ/SIRD/21/11-12/318', '2011-08-23', 'N.M. POTE', 46, '1', 'M551', 'Colour', 19138, 0, 'NA', 'NA', 'DPS/04/EPRO/1052/PO/211769', '2012-10-16', '169475', '2012-11-26', 0, NULL, '89250', 'Individual', 'LM-19', 'official use', 1, 1, '2012-11-26', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-09 10:55:05', 0, '10.25.23.50', '2024-01-09 10:56:00', 1, 1, '0'),
('ROHRA COMPUTER PRODUCTS', 'Printer', NULL, 'BARC/CENZ/SIRD/21/11-12/318', '2011-08-23', 'N.M. POTE', 47, '1', 'M551', 'Colour', 19138, 0, 'NA', 'NA', 'DPS/04/EPRO/1052/PO/211769', '2012-10-16', '169475', '2012-11-26', 0, NULL, '178500', 'Individual', 'LM-19', 'official use', 1, 1, '2012-11-26', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-09 10:56:27', 0, '10.25.23.50', '2024-01-09 10:56:27', 1, 1, '0'),
('', NULL, 17, '', '0000-00-00', '', 48, NULL, NULL, 'Colour', 18999, 0, 'NA', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'SIRD OFFICE, CC, FIRST FLOOR.', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-31 10:32:52', 0, '10.25.12.92', '2024-01-31 10:32:52', 1, 1, '0'),
('', NULL, 22, '', '0000-00-00', '', 49, NULL, NULL, 'Colour', 18999, 0, 'BARC/I/C-64/2373', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'SIRD OFFICE, CC, FIRST FLOOR.', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-01-31 10:35:29', 0, '10.25.12.92', '2024-01-31 10:35:29', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 50, '1', 'HP Color Laserjet CP2025', 'Colour', 12520, 0, 'BARC/I/C-64/3573', 'NA', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Central Library, LM-10', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-07 11:35:56', '0000-00-00 00:00:00', NULL, '2024-02-07 11:35:08', 0, '10.25.22.81', '2024-02-07 11:35:56', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 51, '1', 'laserjet 1000', 'Black & White', 21323, 0, 'BARC/I/C.64/0541', 'PRN/0008', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'CENTRAL LIBRARY-LM-8', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-12 12:30:14', '0000-00-00 00:00:00', NULL, '2024-02-08 14:27:43', 0, '10.25.22.111', '2024-02-12 12:30:14', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 52, '1', 'laserjet 1000', 'Black & White', 21323, 0, 'BARC/I/C.64/0542', 'PRN/0223', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'CENTRAL LIBRARY-LM-8', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-12 12:30:56', '0000-00-00 00:00:00', NULL, '2024-02-08 14:30:05', 0, '10.25.22.111', '2024-02-12 12:30:56', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 53, '1', 'DESKJET 810C', 'Colour', 21323, 0, 'SIRD/PR/014', 'PRN/0039', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'CENTRAL LIBRARY-LM-8', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-12 12:31:52', '0000-00-00 00:00:00', NULL, '2024-02-08 14:32:41', 0, '10.25.22.111', '2024-02-12 12:31:52', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 54, '1', 'DESKJET 1180C', 'Colour', 28153, 0, 'NA', 'DJ/065', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'CENTRAL LIBRARY-LM-9', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-12 12:42:49', '0000-00-00 00:00:00', NULL, '2024-02-08 14:41:54', 0, '10.25.21.14', '2024-02-19 12:00:29', 1, 0, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 56, '1', 'Scanjet 8290', 'Colour', 22779, 0, 'BARC/I/E.02/127', 'NA', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'A-1-8', 'official use', 1, 0, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-02-09 10:26:19', 0, '10.25.11.211', '2024-02-09 10:26:19', 1, 0, '0'),
('', NULL, 30, '', '0000-00-00', '', 57, NULL, NULL, 'Colour', 20892, 0, 'BARC/I/C-65/347', 'NA', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-5, CC', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-02-09 12:30:22', 0, '10.25.11.210', '2024-02-09 12:30:22', 1, 1, '0'),
('NA', 'MFD', NULL, 'NA', '0000-00-00', 'NA', 58, '1', 'photosmart 2608 all in one', 'Colour', 17037, 0, 'NA', 'MFD/0033', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM-9 CENTRAL LIBRARY', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-12 12:47:20', '0000-00-00 00:00:00', NULL, '2024-02-09 15:37:41', 0, '10.25.22.91', '2024-02-12 12:47:20', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 59, '1', 'Laserjet 1015', 'Black & White', 18507, 0, 'BARC/I/C.64/0978', 'LJ/1433', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM4', 'service use', 1, 0, '0000-00-00', 1, '14340', 0, '2024-02-13 10:29:15', '0000-00-00 00:00:00', NULL, '2024-02-12 12:04:16', 0, '10.25.21.100', '2024-02-13 10:29:15', 1, 1, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 60, '1', 'Scanjet G4010', 'Black & White', 18507, 0, 'NA', 'SCN/283', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM4', 'service use', 1, 0, '0000-00-00', 1, '14340', 0, '2024-02-13 10:29:25', '0000-00-00 00:00:00', NULL, '2024-02-12 12:08:14', 0, '10.25.21.100', '2024-02-13 10:29:25', 1, 1, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 61, '1', 'Scanjet G4010', 'Colour', 17380, 0, 'NA', 'SCN/17**', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM-3, Central Library', 'official use', 1, 0, '0000-00-00', 1, '14340', 0, '2024-02-19 12:19:48', '0000-00-00 00:00:00', NULL, '2024-02-19 11:56:35', 0, '10.25.21.130', '2024-02-19 12:19:48', 1, 0, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 62, '1', 'Scanjet G4010', 'Colour', 19913, 0, 'BARC/I/C/C.65/0123', 'NA', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Central Library, Book Section', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-19 14:36:56', '0000-00-00 00:00:00', NULL, '2024-02-19 12:33:20', 0, '10.25.22.110', '2024-02-19 14:36:56', 1, 1, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 63, '1', 'G4010', 'Colour', 20131, 0, 'BARC/I/C.65/0122', 'SCN/035', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM-11, Central Library', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-19 14:37:21', '0000-00-00 00:00:00', NULL, '2024-02-19 13:08:43', 0, '10.25.22.70', '2024-02-19 14:37:21', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 64, '1', 'Deskjet 710C', 'Black & White', 20131, 0, 'NA', 'PRN/0222', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM-11, Central Library', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-19 14:37:38', '0000-00-00 00:00:00', NULL, '2024-02-19 13:09:46', 0, '10.25.22.70', '2024-02-19 14:37:38', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 65, '3', 'ML4600', 'Black & White', 20131, 0, 'BARC/I/C.64/0590', 'LJ/0870', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM-11, Central Library', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-19 14:39:28', '0000-00-00 00:00:00', NULL, '2024-02-19 13:10:33', 0, '10.25.22.70', '2024-02-19 14:39:28', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 66, '3', 'ML4600', 'Black & White', 20131, 0, 'BARC/I/C.64/0592', 'SIRD/PC/039', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'LM-11, Central Library', 'official use', 1, 0, '0000-00-00', 1, '12520', 0, '2024-02-19 14:40:08', '0000-00-00 00:00:00', NULL, '2024-02-19 13:11:02', 0, '10.25.22.70', '2024-02-19 14:40:08', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 67, '1', 'LaserJet 1020 plus', 'Black & White', 21377, 0, 'BARC/I/C-64/3611', 'LJ/0877', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Reports Section, Central Library', 'official use', 1, 0, '0000-00-00', 1, '14412', 0, '2024-02-20 15:43:55', '0000-00-00 00:00:00', NULL, '2024-02-20 12:50:36', 0, '10.25.22.23', '2024-02-20 15:43:55', 1, 1, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 68, '1', 'Deskjet 1220C', 'Colour', 19158, 0, 'BARC/I/C.64/0405', 'DJ/544', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Reports Section, Central Library', 'official use', 1, 0, '0000-00-00', 1, '14412', 0, '2024-02-20 15:43:48', '0000-00-00 00:00:00', NULL, '2024-02-20 13:09:23', 0, '10.25.22.22', '2024-02-20 15:43:48', 1, 1, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 69, '1', 'Color LaserJet CP3525dn', 'Colour', 14412, 0, 'BARC/I/C.64/2979', 'PRN/0082', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'A-1-22, CC', 'official use', 1, 0, '0000-00-00', 1, '14412', 0, '2024-02-20 15:43:25', '0000-00-00 00:00:00', NULL, '2024-02-20 15:28:42', 0, '10.25.12.161', '2024-02-20 15:43:25', 1, 1, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 70, '1', 'Scanjet G4010', 'Colour', 14412, 0, 'NA', 'SCN/056', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'A-1-22, CC', 'official use', 1, 0, '0000-00-00', 1, '14412', 0, '2024-02-20 15:43:41', '0000-00-00 00:00:00', NULL, '2024-02-20 15:30:13', 0, '10.25.12.161', '2024-02-20 15:43:41', 1, 0, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 71, '1', 'Scanjet G4010', 'Colour', 28121, 0, 'NA', 'SCN/081', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'A-1-3, CC', 'official use', 1, 0, '0000-00-00', 1, '14412', 0, '2024-02-20 15:44:00', '0000-00-00 00:00:00', NULL, '2024-02-20 15:36:30', 0, '10.25.11.90', '2024-02-20 15:44:00', 1, 1, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 72, '1', 'Scanjet 4850', 'Colour', 12664, 0, 'NA', 'SCN/004', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Room A-1-21, CC', 'official use', 1, 0, '0000-00-00', 1, '12664', 0, '2024-03-04 11:16:08', '0000-00-00 00:00:00', NULL, '2024-03-04 11:14:46', 0, '10.25.12.150', '2024-03-04 11:16:08', 1, 1, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 73, '1', 'Laserjet 1020 plus', 'Colour', 12664, 0, 'BARC/I/C.64/3610', 'LJ/0837', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Room A-1-21, CC', 'official use', 1, 0, '0000-00-00', 1, '12664', 0, '2024-03-04 11:16:10', '0000-00-00 00:00:00', NULL, '2024-03-04 11:15:38', 0, '10.25.12.150', '2024-03-04 11:16:10', 1, 1, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 74, '6', 'HL-1201', 'Black & White', 29139, 0, 'NA', 'LJ/2016', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'A-1-20A, CC', 'official use', 1, 0, '0000-00-00', 1, '12664', 0, '2024-03-04 12:52:21', '0000-00-00 00:00:00', NULL, '2024-03-04 11:22:41', 0, '10.25.12.131', '2024-03-04 12:52:21', 1, 0, '0'),
('', NULL, 19, '', '0000-00-00', '', 75, NULL, NULL, 'Colour', 24704, 0, 'BARC/I/C.65/12', 'SCN/088', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'A-1-3, CC', 'official use', 1, NULL, '0000-00-00', 1, '12664', 0, '2024-03-04 12:52:16', '0000-00-00 00:00:00', NULL, '2024-03-04 11:33:24', 0, '10.25.11.70', '2024-03-04 12:52:16', 1, 1, '0'),
('', NULL, 27, '', '0000-00-00', '', 76, NULL, NULL, 'Colour', 20894, 0, 'NA', 'LJ/1454', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'DigitalLibrary', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 11:59:31', 0, '10.25.31.10', '2024-03-26 11:59:31', 1, 1, '0'),
('', NULL, 34, '', '0000-00-00', '', 77, NULL, NULL, 'Colour', 20894, 0, 'BARC/I/C.64/0544', 'LJ/0815', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'Digital Library', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:03:05', 0, '10.25.31.10', '2024-03-26 12:03:05', 1, 0, '0'),
('', NULL, 16, '', '0000-00-00', '', 78, NULL, NULL, 'Colour', 20894, 0, 'NA', 'LJ/0820', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'Digital Library', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:04:20', 0, '10.25.31.10', '2024-03-26 12:04:20', 1, 0, '0'),
('', NULL, 34, '', '0000-00-00', '', 79, NULL, NULL, 'Colour', 20894, 0, 'BARC/I/C.64/0540', 'LJ/1892', NULL, NULL, '', '0000-00-00', 0, NULL, NULL, 'Centralize', 'Digital Library', 'official use', 1, NULL, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:05:47', 0, '10.25.31.10', '2024-03-26 12:05:47', 1, 0, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 80, '1', 'Scanjet G4010', 'Colour', 20894, 0, 'NA', 'NA', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Digital Library', 'official use', 1, 0, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:13:42', 0, '10.25.31.10', '2024-03-26 12:13:42', 1, 0, '0'),
('NA', 'Scanner', NULL, 'NA', '0000-00-00', 'NA', 81, '1', 'Scanjet 6300C', 'Colour', 20894, 0, 'BARC/I/E.02/0040', 'SC/0018', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Digital Library', 'official use', 1, 0, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:16:33', 0, '10.25.31.10', '2024-03-26 12:16:33', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 82, '1', 'Deskjet 1220C', 'Colour', 20894, 0, 'BARC/I/C.64/0625', 'PRN/0219', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Digital Library', 'official use', 1, 0, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:19:22', 0, '10.25.31.10', '2024-03-26 12:19:22', 1, 0, '0'),
('NA', 'Printer', NULL, 'NA', '0000-00-00', 'NA', 83, '1', 'Laserjet Pro 400 M401n', 'Black & White', 20894, 0, 'NA', 'LJ/0839', 'NA', '0000-00-00', 'NA', '0000-00-00', 0, NULL, '0', 'Individual', 'Digital Library', 'official use', 1, 0, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-26 12:21:41', 0, '10.25.31.10', '2024-03-26 12:21:41', 1, 0, '0'),
('', 'Printer', NULL, '', '0000-00-00', '', 84, '1', 'Laserjet 1100A', 'Black & White', 20894, 0, 'NA', 'LJ/1440', '', '0000-00-00', '', '0000-00-00', 0, NULL, '', 'Individual', 'Digital Library', 'official use', 1, 0, '0000-00-00', 0, NULL, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, '2024-03-28 14:47:51', 0, '10.25.31.10', '2024-03-28 14:47:51', 1, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_printer_make`
--

CREATE TABLE `tbl_printer_make` (
  `autoID` int(11) NOT NULL,
  `device_make` varchar(50) NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_printer_make`
--

INSERT INTO `tbl_printer_make` (`autoID`, `device_make`, `isdeleted`) VALUES
(1, 'HP', 0),
(2, 'Canon', 0),
(3, 'Samsung', 0),
(4, 'Epson', 0),
(5, 'Kyocera', 0),
(6, 'Brother', 0),
(7, 'Ricoh', 0),
(8, 'Others', 0),
(9, 'Konica Minolta', 0),
(10, 'Nikon', 0),
(11, 'Fujitsu', 0),
(12, 'Braun', 0),
(13, 'Plustek', 0),
(14, 'Riso', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_printer_purchase`
--

CREATE TABLE `tbl_printer_purchase` (
  `device` enum('Printer','Scanner','MFD') DEFAULT NULL,
  `autoID` int(11) NOT NULL,
  `device_make` int(11) NOT NULL,
  `device_model` varchar(100) NOT NULL,
  `device_tone` enum('Colour','Black & White') NOT NULL,
  `indent_no` varchar(100) NOT NULL,
  `indent_dt` date NOT NULL,
  `indentor_emp` varchar(100) NOT NULL,
  `rv_no` varchar(100) NOT NULL,
  `rv_dt` date NOT NULL,
  `rvfileuploaded` tinyint(1) NOT NULL DEFAULT '0',
  `rvfilename` varchar(500) DEFAULT NULL,
  `po_no` varchar(100) NOT NULL,
  `po_dt` date NOT NULL,
  `device_cost` varchar(10) NOT NULL,
  `details_of_supplier` varchar(500) NOT NULL,
  `qty_received` int(11) DEFAULT NULL,
  `warranty_in_years` int(11) DEFAULT NULL,
  `warranty_upto` date NOT NULL,
  `updatedby` int(11) NOT NULL,
  `updatedbyip` varchar(50) NOT NULL,
  `printer_remarks` varchar(100) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_printer_purchase`
--

INSERT INTO `tbl_printer_purchase` (`device`, `autoID`, `device_make`, `device_model`, `device_tone`, `indent_no`, `indent_dt`, `indentor_emp`, `rv_no`, `rv_dt`, `rvfileuploaded`, `rvfilename`, `po_no`, `po_dt`, `device_cost`, `details_of_supplier`, `qty_received`, `warranty_in_years`, `warranty_upto`, `updatedby`, `updatedbyip`, `printer_remarks`, `updatedon`, `isdeleted`) VALUES
('MFD', 16, 1, 'Laser jet M 1005 Multifunction', 'Colour', 'BARC/CENZ/SIRD/11/15-16/190', '2015-09-21', 'Shri Manoj Singh', '210343', '2016-08-19', 1, 'printerRV-1-16.pdf', 'DPS/04/A3/340-A/PO/231176', '2016-06-07', '12051', 'M/S. Vibrant Infotech, Pune', 3, 1, '2017-08-31', 18974, '::1', '', '2023-02-09 15:16:51', 0),
('Printer', 17, 1, 'Laserjet Pro M403', 'Black & White', 'BARc/CENZ/SIRD/11/15-16/190', '2015-09-21', 'Shri Manoj Singh', '210343', '2016-08-19', 1, 'printerRV-1-17.pdf', 'DPS/04/A3/340-A/PO/231176', '2016-06-07', '20497', 'M/S. Vibrant Infotech, Pune', 4, 1, '2017-08-31', 28120, '10.25.11.180', '', '2023-11-08 15:37:15', 0),
('Printer', 18, 1, 'Laserjet Pro M452DN', 'Colour', 'BARc/CENZ/SIRD/11/15-16/190', '2015-09-21', 'Shri Manoj Singh', '210343', '2016-08-19', 1, 'printerRV-1-18.pdf', 'DPS/04/A3/340-A/PO/231176', '2016-06-07', '38110', 'M/S. Vibrant Infotech, Pune', 3, 1, '2017-08-31', 18974, '::1', '', '2023-02-09 14:49:01', 0),
('Scanner', 19, 1, 'Scanjet G4050', 'Colour', 'BARc/CENZ/SIRD/11/15-16/190', '2015-09-21', 'Shri Manoj Singh', '210343', '2016-08-19', 1, 'printerRV-1-19.pdf', 'DPS/04/A3/340-A/PO/231176', '2016-06-07', '23175', 'M/S. Vibrant Infotech, Pune', 2, 1, '2017-08-31', 18974, '::1', '', '2023-02-09 14:50:13', 0),
('Printer', 20, 4, 'INK TANK SYSTEM INKJET PHOTO L805', 'Colour', 'BARc/CENZ/SIRD/11/15-16/190', '2015-09-21', 'Shri Manoj Singh', '210343', '2016-08-19', 1, 'printerRV-4-20.pdf', 'DPS/04/EPRO/155-B/PO/203912', '2016-06-07', '16892', 'M/S. Vibrant Infotech, Pune', 1, 1, '2017-08-31', 18974, '::1', '', '2023-02-09 14:54:07', 0),
('Printer', 21, 4, 'Picturemate PM310', 'Colour', 'BARC/CENZ/SIRD/29/11-12/366', '2011-09-15', 'Shri Ajith Balan', '160480', '2012-02-08', 1, 'printerRV-4-21.pdf', 'DPS/04/EPRO/1112/PO/207503', '2012-01-10', '16500', 'Avant Computer Technologies Systems Pvt. Ltd.', 2, 3, '2013-02-07', 18974, '::1', '', '2023-02-09 15:04:02', 0),
('Printer', 22, 1, 'Laserjet P2015D', 'Black & White', 'BARC/CENZ/SIRD/0/08-09/233', '2008-08-08', 'Shri Sanjay Kumar Singh', '126177', '2008-12-26', 1, 'printerRV-1-22.pdf', 'DPS/04/MIA/28238/PO/190308', '2008-11-26', '1', 'RITE Systems, Chembur, Mumbai', 1, 1, '2009-12-25', 18974, '::1', '', '2023-02-09 15:12:49', 0),
('MFD', 23, 9, 'bizhub C300i', 'Colour', 'BARC/CENZ/SIRD/21-22/267', '2021-08-27', 'Manoj Singh', 'NA', '2021-09-22', 1, 'printerRV-9-23.pdf', 'DPS/CPU/04/C1/2328/PO/5116 87768649017', '2021-09-22', '346500', 'KONICA MINOLTA BUSINESS SOLUTIONS INDIA PRIVATE LIMITED', 1, 1, '2022-09-21', 28120, '10.25.11.180', '', '2023-10-17 12:42:38', 0),
('Printer', 24, 3, 'ML 4800', 'Black & White', 'BARC/CENZ/LISD/71/01-02/570', '2001-11-05', 'Shri A. P. Jadhav', '55776', '2002-03-20', 1, 'printerRV-3-24.jpg', 'DPS/04/MIC/36118/PO/155679', '2002-03-05', '14500', 'Modi Peripherals Pvt. Ltd.', 6, 0, '2023-10-26', 28120, '10.25.11.180', '', '2023-10-26 15:03:19', 0),
('MFD', 25, 1, 'Laserjet 1220 (Copy Scan Print)', 'Black & White', 'BARC/CENZ/LISD/58/01-02/485', '2001-10-03', 'Shri A. P. Jadhav', '57292', '2002-05-01', 1, 'printerRV-1-25.jpg', 'DPS/04/MIC/36034O/155833', '2002-03-13', '30750', 'Alphabetics Computer Services', 1, 0, '2023-10-26', 28120, '10.25.11.180', '', '2023-10-26 15:23:02', 0),
('Scanner', 26, 1, 'SJ 8290 C', 'Colour', 'BARC/CENZ/SIRD/12/05-06/356', '2005-09-08', 'Shri Manoj Singh', '95236', '2006-02-03', 1, 'printerRV-1-26.jpg', 'DPS/04/MIA/25656/PO/175582', '2006-01-23', '59400', 'VIRUPAUX INSTRUMENTS MUMBAI', 2, 1, '2007-02-02', 28120, '10.25.11.180', '', '2023-11-10 14:46:50', 0),
('Printer', 27, 1, 'LaserJet 1022', 'Black & White', 'BARC/CENZ/SIRD/08/05-06/216', '0205-07-14', 'Shri Manoj Singh', 'LPS-62009', '2005-11-24', 1, 'printerRV-1-27.jpg', 'DPS/LPS/BARC/127589/TO/144337', '2005-10-24', '11200', 'ROHRA COMPUTER PRODUCTS', 1, 3, '2006-11-23', 28120, '10.25.11.180', '', '2023-11-10 15:06:09', 0),
('Scanner', 28, 10, 'COOLSCAN 9000 ED Film Scanner', 'Colour', 'BARC/CENZ/LISD/05/04-05/155', '2004-06-25', 'Shri U. D. Chavan', 'NA', '2004-11-03', 1, 'printerRV-10-28.jpg', 'DPS/04/MIC/38766', '2004-11-03', '175000', 'Inter Foto India Pvt. Ltd.', 1, 1, '2005-11-02', 28120, '10.25.11.180', '', '2023-11-10 15:23:49', 0),
('Scanner', 29, 11, 'Scan Snap SV600', 'Colour', 'BARC/CENZ/SIRD/27/15-16/310', '2016-02-09', 'Shri S. K. Singh', '209777', '2016-08-01', 1, 'printerRV-11-29.pdf', 'DPS/04/C3/490/PO/230948', '2016-05-10', '40600', 'AVANT COMPUTER TECHNOLOGIES SYSTEMS PVT LTD', 2, 1, '2017-07-31', 28120, '10.25.11.180', '', '2023-11-14 16:14:07', 0),
('Scanner', 30, 2, 'CANOSCAN 9000F', 'Colour', 'BARC/CENZ/SIRD/27/15-16/310', '2016-02-09', 'Shri S. K. Singh', '209777', '2016-08-01', 1, 'printerRV-2-30.pdf', 'DPS/04/C3/490/PO/230948', '2016-05-10', '17300', 'AVANT COMPUTER TECHNOLOGIES SYSTEMS PVT LTD', 1, 1, '2017-07-31', 28120, '10.25.11.180', '', '2023-11-14 16:13:16', 0),
('Scanner', 31, 12, 'FS120', 'Colour', 'BARC/CENZ/SIRD/17-18/218', '2017-10-09', 'Shri Manoj Singh', '1144/18-19', '2018-05-25', 1, 'printerRV-1-31.pdf', 'DPS/CPU/04/ITS/28/PO/238563', '2018-01-23', '226400', 'AVANT COMPUTER TECHNOLOGIES SYSTEMS PVT LTD', 1, 2, '2020-05-23', 28120, '10.25.11.180', '', '2023-11-17 13:11:05', 0),
('Scanner', 32, 13, 'OPTICFILM 8100 ', 'Colour', 'BARC/CENZ/SIRD/17-18/223/48', '2017-10-20', 'Shri Manoj Singh', '1641/17', '2018-03-15', 1, 'printerRV-13-32.pdf', 'DPS/CPU/04/D4/1204/PO/238388', '2018-01-29', '48000', 'MICRO INFOTECH, 105 RAJASTHAN TECH. CENTRE, MUMBAI', 2, 1, '2019-03-14', 28120, '10.25.11.180', '', '2023-11-17 13:12:36', 0),
('Printer', 33, 1, 'LaserJet Pro M405dn', 'Black & White', 'BARC/CENZ/SIRD21-22/582', '2022-02-11', 'Shri Manoj Singh', '1053/22-23', '2022-09-21', 1, 'printerRV-1-33.pdf', 'DPS/CPU/04/C3/3077/PO252374', '2022-08-18', '38500', 'M/S TRINITY INFOTECH, NAGDEVI CROSS LANE, MUMBAI - 400003', 1, 3, '2023-09-20', 28120, '10.25.11.180', '', '2023-11-20 11:15:05', 0),
('Printer', 34, 1, 'LaserJet 1000', 'Black & White', 'BARC/CENZ/LISD/6/01-02/53', '2001-04-27', 'Shri A. P. Jadhav', '54948', '2002-02-21', 1, 'printerRV-1-34.pdf', 'DPS/04/MIC/35605/PO/152352', '2001-08-10', '17500', 'EXPERT INFOTECH INDIA PVT. LTD., MUMBAI', 6, 1, '2003-02-20', 28120, '10.25.11.180', '', '2023-12-07 10:56:26', 0),
('Printer', 35, 2, 'PIXMA G3020(PO-G3000)', 'Colour', 'BARC/CENZ/SIRD/21-22/582', '2022-02-11', 'Shri Manoj Singh', 'GR No. : 723/22-23', '2022-09-22', 1, 'printerRV-2-35.pdf', 'DPS/CPU/04/C3/3077/PO/252374', '2022-08-18', '14000', 'M/S TRINITY INFOTECH', 1, 3, '2025-09-21', 28120, '10.25.11.180', '', '2024-01-15 10:30:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_servers`
--

CREATE TABLE `tbl_servers` (
  `server_autoID` int(11) NOT NULL,
  `server_rack` varchar(20) NOT NULL,
  `server_name` varchar(100) DEFAULT NULL,
  `kvmid` int(11) DEFAULT '0',
  `server_ip` varchar(50) NOT NULL,
  `server_os` enum('Windows','Linux','Others') DEFAULT NULL,
  `os_version` varchar(100) DEFAULT NULL,
  `server_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `server_addedon` datetime NOT NULL,
  `server_updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `server_updateby` int(11) NOT NULL,
  `server_updatebyip` varchar(50) NOT NULL,
  `server_isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `server_username` varchar(50) NOT NULL,
  `server_password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_servers`
--

INSERT INTO `tbl_servers` (`server_autoID`, `server_rack`, `server_name`, `kvmid`, `server_ip`, `server_os`, `os_version`, `server_enabled`, `server_addedon`, `server_updatedon`, `server_updateby`, `server_updatebyip`, `server_isdeleted`, `server_username`, `server_password`) VALUES
(2, 'RACK - I', 'SnapArt', 4, '10.25.1.50', 'Windows', 'Windows 8.1', 1, '2021-09-28 00:00:00', '2023-03-20 15:18:45', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(3, 'RACK - I', 'Libcontent', 5, '10.25.1.40', 'Windows', 'Windows 2012 R2', 1, '2021-09-28 00:00:00', '2023-03-20 15:19:00', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(4, 'RACK - I', '[Linlib]Libsys/Dspace', 6, '10.25.1.10', 'Linux', 'Redhat Linux', 1, '2021-09-28 00:00:00', '2023-03-20 15:19:25', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(5, 'RACK - I', '[backup]Libsys/Dspace', 7, '10.25.1.199', 'Windows', 'Windows server 2003', 1, '2021-09-28 00:00:00', '2023-03-20 15:19:15', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(6, 'RACK - II', 'Citrix-II', 0, '10.25.1.100', 'Windows', NULL, 1, '2021-09-29 00:00:00', '2021-09-29 12:14:05', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(7, 'RACK - II', 'Antivirus', 5, '10.25.1.70', 'Windows', 'Windows 2012 R2', 1, '2021-09-29 00:00:00', '2023-03-20 15:19:50', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(8, 'RACK - III', 'Libresource [VM in SIRDDATA]', 6, '10.25.1.30', 'Windows', 'Windows server 2003', 1, '2021-09-29 00:00:00', '2023-12-19 11:24:09', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(9, 'RACK - III', '[SIRDDATA]Photoserver', 6, '10.25.1.120', 'Windows', 'Windows 2012 R2', 1, '2021-09-29 00:00:00', '2023-07-07 12:10:57', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(10, 'RACK - III', '[SIRDAPP]DewDrops,DACP', 2, '10.25.1.205', 'Windows', 'Windows 2012 R2', 1, '2021-09-29 00:00:00', '2023-07-07 12:10:33', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(11, 'RACK - III', 'Saraswati', 3, '10.25.1.20', 'Linux', 'centOS', 1, '2021-09-29 00:00:00', '2023-03-20 15:20:54', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(12, 'RACK - III', '[WEBAPP]Multimedia & RSync', 4, '10.25.1.110', 'Windows', 'Windows server 2016', 1, '2021-09-29 00:00:00', '2023-07-07 12:10:01', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(13, 'RACK - III', 'BARC Website-CMS', 5, '10.25.1.200', 'Windows', 'Windows 8.1', 1, '2021-09-29 00:00:00', '2023-03-20 15:20:26', 1, '127.0.0.1', 0, 'administrator', 'aaa'),
(24, 'REMOTE', 'RFID Kiosk', NULL, '10.25.22.210', 'Windows', 'Windows 2007', 1, '0000-00-00 00:00:00', '2023-03-20 15:21:45', 0, '', 0, '', ''),
(25, 'RACK - III', 'Citrix-I [VM in SIRDDATA]', 6, '10.25.1.90', 'Windows', 'Windows server 2003', 1, '2021-09-28 00:00:00', '2023-12-19 11:25:17', 1, '127.0.0.1', 0, 'administrator', 'aaa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shift`
--

CREATE TABLE `tbl_shift` (
  `autoID` int(11) NOT NULL,
  `shift_name` varchar(50) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shift`
--

INSERT INTO `tbl_shift` (`autoID`, `shift_name`, `shift_start`, `shift_end`) VALUES
(1, 'First General Shift', '08:00:00', '16:30:00'),
(2, 'Second General Shift', '09:45:00', '18:15:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_temp_users`
--

CREATE TABLE `tbl_temp_users` (
  `autoID` int(11) NOT NULL,
  `emp_no` int(11) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE `tbl_transactions` (
  `autoID` int(11) NOT NULL,
  `script_name` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `ondatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `byip` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transactions`
--

INSERT INTO `tbl_transactions` (`autoID`, `script_name`, `user_id`, `action`, `ondatetime`, `byip`) VALUES
(4572, '/tycs_vtn/process_login.php', 1000, 'USER LOGGED-IN', '2025-03-06 10:45:44', '::1'),
(4573, '/tycs_vtn/get_pcs.php', 1000, 'ADD PC [Centralize Purchase] : IP-NA, PC Make : 55', '2025-03-06 11:59:05', '::1'),
(4574, '/tycs_vtn/get_device_approval_group.php', 1000, '[GROUP-ADMIN] PC Approved : ID-145', '2025-03-06 12:05:18', '::1'),
(4575, '/tycs_vtn/get_device_approval_admin.php', 1000, '[SYS-ADMIN] PC Approved : ID-145, AIMS ID : SIRD/AIMS/PC/39', '2025-03-06 12:05:25', '::1'),
(4576, '/tycs_vtn/get_admin_notification.php', 1000, 'NOTIFICATION DELETED : ID-6', '2025-03-06 12:52:39', '::1'),
(4577, '/tycs_vtn/get_admin_notification.php', 1000, 'NOTIFICATION DELETED : ID-7', '2025-03-06 12:52:41', '::1'),
(4578, '/tycs_vtn/logout.php', 1000, 'LOGOUT', '2025-03-06 12:53:03', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `autoID` int(11) NOT NULL,
  `working_status` enum('1','0') NOT NULL DEFAULT '1' COMMENT '1=Working, 0=Ex-Emp/Non-Working/Retire/VRS/Demise',
  `emp_no` int(11) NOT NULL,
  `emp_title` enum('Shri','Smt','Dr.','Kum') NOT NULL,
  `emp_cc` varchar(20) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_desig` varchar(50) NOT NULL,
  `emp_dob` date NOT NULL,
  `emp_gender` enum('MALE','FEMALE') NOT NULL,
  `emp_grp_autoID` int(11) NOT NULL,
  `emp_sitting_place` varchar(100) NOT NULL,
  `emp_extn` varchar(20) NOT NULL,
  `emp_mob` varchar(20) NOT NULL,
  `emp_alternate_mob` varchar(20) NOT NULL,
  `emp_e_email` varchar(50) NOT NULL,
  `emp_o_email` varchar(50) NOT NULL,
  `emp_shift_autoID` int(11) NOT NULL,
  `isactive` tinyint(1) NOT NULL DEFAULT '0',
  `firsttimelogin` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=firsttime, 1=done first time',
  `activatedon` datetime NOT NULL,
  `isdeleted` tinyint(1) NOT NULL DEFAULT '0',
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedbyip` varchar(50) NOT NULL,
  `emp_pass` varchar(100) NOT NULL,
  `user_type` enum('user','groupadmin','superadmin') NOT NULL DEFAULT 'user',
  `updatedby` varchar(50) NOT NULL,
  `registeredusingIP` varchar(50) DEFAULT NULL,
  `registeredOn` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`autoID`, `working_status`, `emp_no`, `emp_title`, `emp_cc`, `emp_name`, `emp_desig`, `emp_dob`, `emp_gender`, `emp_grp_autoID`, `emp_sitting_place`, `emp_extn`, `emp_mob`, `emp_alternate_mob`, `emp_e_email`, `emp_o_email`, `emp_shift_autoID`, `isactive`, `firsttimelogin`, `activatedon`, `isdeleted`, `updatedon`, `updatedbyip`, `emp_pass`, `user_type`, `updatedby`, `registeredusingIP`, `registeredOn`) VALUES
(61, '1', 1000, 'Shri', 'IT/UG/1', 'Vighnesh T. Navle', 'Programmer', '0000-00-00', 'MALE', 1, 'Progamming Lab, !st Floor', '12345', '', '', '', 'vtn@domain.co.in', 2, 1, 1, '0000-00-00 00:00:00', 0, '2025-03-06 12:05:52', '::1', 'd53c39171cc3c91b55817554277a039b977ebaa1', 'user', '1000', '10.25.11.180', '2025-03-06 12:05:52'),
(69, '1', 999, 'Shri', 'IT/UG/1', 'Sanjay', 'Head IT', '0000-00-00', 'MALE', 1, 'Progamming Lab, !st Floor Cabin', '12346', '', '', '', 'sanjay@domain.co.in', 2, 1, 1, '0000-00-00 00:00:00', 0, '2025-03-06 11:11:28', '::1', 'd53c39171cc3c91b55817554277a039b977ebaa1', 'groupadmin', '1000', '10.25.11.180', '2025-03-06 11:11:28'),
(70, '1', 1002, 'Shri', 'IT/UG/2', 'Rajsh', 'Tester', '0000-00-00', 'MALE', 1, 'Progamming Lab, !st Floor', '12347', '', '', '', 'rajesh@domain.co.in', 2, 1, 1, '0000-00-00 00:00:00', 0, '2025-03-06 10:43:58', '::1', 'd53c39171cc3c91b55817554277a039b977ebaa1', 'user', '1000', '10.25.11.180', '2025-03-06 10:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `testtab`
--

CREATE TABLE `testtab` (
  `id` int(11) NOT NULL,
  `rack` varchar(50) NOT NULL,
  `servername` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `device_transaction_log`
--
ALTER TABLE `device_transaction_log`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `pc_transaction_log`
--
ALTER TABLE `pc_transaction_log`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_menu_permission`
--
ALTER TABLE `tbl_menu_permission`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_pc_details`
--
ALTER TABLE `tbl_pc_details`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_pc_make`
--
ALTER TABLE `tbl_pc_make`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_pc_os`
--
ALTER TABLE `tbl_pc_os`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_printer_details`
--
ALTER TABLE `tbl_printer_details`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_printer_make`
--
ALTER TABLE `tbl_printer_make`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_printer_purchase`
--
ALTER TABLE `tbl_printer_purchase`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_servers`
--
ALTER TABLE `tbl_servers`
  ADD PRIMARY KEY (`server_autoID`);

--
-- Indexes for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_temp_users`
--
ALTER TABLE `tbl_temp_users`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`autoID`);

--
-- Indexes for table `testtab`
--
ALTER TABLE `testtab`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `device_transaction_log`
--
ALTER TABLE `device_transaction_log`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pc_transaction_log`
--
ALTER TABLE `pc_transaction_log`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_menu`
--
ALTER TABLE `tbl_menu`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_menu_permission`
--
ALTER TABLE `tbl_menu_permission`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_pc_details`
--
ALTER TABLE `tbl_pc_details`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `tbl_pc_make`
--
ALTER TABLE `tbl_pc_make`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbl_pc_os`
--
ALTER TABLE `tbl_pc_os`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_printer_details`
--
ALTER TABLE `tbl_printer_details`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_printer_make`
--
ALTER TABLE `tbl_printer_make`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_printer_purchase`
--
ALTER TABLE `tbl_printer_purchase`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_servers`
--
ALTER TABLE `tbl_servers`
  MODIFY `server_autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_shift`
--
ALTER TABLE `tbl_shift`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_temp_users`
--
ALTER TABLE `tbl_temp_users`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transactions`
--
ALTER TABLE `tbl_transactions`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4579;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `autoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `testtab`
--
ALTER TABLE `testtab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

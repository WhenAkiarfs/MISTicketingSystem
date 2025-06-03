-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 09:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketingsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_activitylogs`
--

CREATE TABLE `t_activitylogs` (
  `id` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `activity_type` varchar(35) NOT NULL,
  `activity_time` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_activitylogs`
--

INSERT INTO `t_activitylogs` (`id`, `UserId`, `activity_type`, `activity_time`) VALUES
(1, 3, 'login', '2025-04-12 22:47:10'),
(2, 3, 'logout', '2025-04-12 22:55:57'),
(3, 3, 'login', '2025-04-12 22:56:09'),
(4, 3, 'logout', '2025-04-12 22:57:57'),
(5, 17, 'login', '2025-04-12 22:59:01'),
(6, 17, 'logout', '2025-04-12 23:00:43'),
(7, 17, 'login', '2025-04-12 23:00:46'),
(8, 17, 'logout', '2025-04-12 23:01:20'),
(9, 3, 'login', '2025-04-12 23:01:24'),
(10, 3, 'logout', '2025-04-12 23:08:40'),
(11, 3, 'login', '2025-04-13 11:57:25'),
(12, 3, 'login', '2025-04-13 21:47:34'),
(13, 3, 'logout', '2025-04-13 23:00:45'),
(14, 3, 'login', '2025-04-20 22:13:35'),
(23, 3, 'login', '2025-04-20 23:15:51'),
(24, 3, 'login', '2025-04-21 20:45:33'),
(25, 3, 'login', '2025-04-21 21:11:29'),
(26, 3, 'login', '2025-04-21 21:13:00'),
(27, 3, 'login', '2025-04-27 23:16:34'),
(28, 3, 'login', '2025-04-27 23:45:00'),
(29, 3, 'logout', '2025-04-28 00:59:18'),
(30, 3, 'login', '2025-04-28 00:59:20'),
(31, 3, 'logout', '2025-04-28 01:00:03'),
(32, 3, 'login', '2025-04-28 01:02:03'),
(33, 3, 'login', '2025-04-28 17:28:33'),
(34, 3, 'logout', '2025-04-29 06:48:37'),
(36, 3, 'login', '2025-04-29 08:19:38'),
(37, 3, 'logout', '2025-04-29 08:31:04'),
(38, 47, 'login', '2025-04-29 08:31:22'),
(39, 47, 'login', '2025-04-29 08:33:03'),
(40, 47, 'logout', '2025-04-29 08:56:43'),
(41, 19, 'login', '2025-04-29 08:57:01'),
(42, 19, 'logout', '2025-04-29 10:00:27'),
(43, 3, 'login', '2025-04-29 10:00:32'),
(44, 3, 'login', '2025-04-29 13:36:31'),
(45, 3, 'logout', '2025-04-29 13:36:41'),
(46, 47, 'login', '2025-04-29 14:25:56'),
(47, 3, 'login', '2025-05-02 01:16:04'),
(48, 3, 'logout', '2025-05-02 01:35:10'),
(49, 3, 'login', '2025-05-02 01:35:32'),
(50, 47, 'login', '2025-05-02 01:37:33'),
(51, 3, 'logout', '2025-05-02 01:39:25'),
(52, 47, 'login', '2025-05-02 01:39:47'),
(53, 47, 'logout', '2025-05-02 01:40:05'),
(54, 3, 'login', '2025-05-02 01:40:10'),
(55, 3, 'logout', '2025-05-02 01:42:12'),
(56, 3, 'login', '2025-05-02 01:42:15'),
(57, 47, 'logout', '2025-05-02 01:42:47'),
(58, 47, 'login', '2025-05-02 01:43:09'),
(59, 3, '', '2025-05-02 01:43:39'),
(60, 3, '', '2025-05-02 01:44:05'),
(61, 3, '', '2025-05-02 01:44:06'),
(62, 3, 'Heartbeat', '2025-05-02 01:48:53'),
(63, 3, 'login', '2025-05-05 18:06:57'),
(64, 3, 'Heartbeat', '2025-05-05 18:07:48'),
(65, 3, 'logout', '2025-05-05 18:07:55'),
(66, 47, 'login', '2025-05-05 18:12:15'),
(67, 47, 'logout', '2025-05-05 18:12:47'),
(68, 19, 'login', '2025-05-05 18:14:58'),
(69, 19, 'logout', '2025-05-05 18:15:40'),
(70, 3, 'login', '2025-05-05 18:15:43'),
(71, 3, 'Heartbeat', '2025-05-05 18:18:04'),
(72, 3, 'logout', '2025-05-05 20:20:17'),
(73, 19, 'login', '2025-05-05 20:20:47'),
(74, 19, 'logout', '2025-05-06 00:26:12'),
(75, 3, 'login', '2025-05-06 00:26:14'),
(76, 3, 'login', '2025-05-06 07:42:36'),
(77, 3, 'Heartbeat', '2025-05-06 07:42:47'),
(78, 3, 'logout', '2025-05-06 08:03:52'),
(79, 48, 'login', '2025-05-06 08:04:52'),
(80, 48, 'logout', '2025-05-06 08:14:34'),
(81, 50, 'login', '2025-05-06 08:14:59'),
(82, 50, 'logout', '2025-05-06 08:22:55'),
(83, 3, 'login', '2025-05-06 08:23:12'),
(84, 3, 'Heartbeat', '2025-05-06 08:23:16'),
(85, 3, 'Heartbeat', '2025-05-06 09:05:49'),
(86, 3, 'logout', '2025-05-06 09:13:08'),
(87, 48, 'login', '2025-05-06 09:13:43'),
(88, 48, 'logout', '2025-05-06 09:25:19'),
(89, 19, 'login', '2025-05-06 09:26:12'),
(90, 19, 'logout', '2025-05-06 09:27:39'),
(91, 3, 'login', '2025-05-06 09:27:48'),
(92, 3, 'Heartbeat', '2025-05-06 09:27:55'),
(93, 3, 'logout', '2025-05-06 10:23:01'),
(94, 3, 'login', '2025-05-06 10:23:11'),
(95, 3, 'login', '2025-05-06 14:35:52'),
(96, 3, 'login', '2025-05-06 14:38:35'),
(97, 3, 'logout', '2025-05-06 14:49:29'),
(98, 19, 'login', '2025-05-06 14:51:15'),
(99, 3, 'login', '2025-05-06 14:52:38'),
(100, 3, 'logout', '2025-05-06 16:23:50'),
(101, 3, 'login', '2025-05-06 16:23:55'),
(102, 3, 'logout', '2025-05-06 16:26:42'),
(103, 3, 'login', '2025-05-06 16:27:24'),
(104, 3, 'logout', '2025-05-06 16:37:16'),
(105, 19, 'login', '2025-05-06 16:38:32'),
(106, 3, 'login', '2025-05-06 16:43:47'),
(107, 3, 'login', '2025-05-08 14:15:30'),
(108, 3, 'login', '2025-05-08 15:22:58'),
(109, 3, 'login', '2025-05-08 15:22:59'),
(110, 3, 'Heartbeat', '2025-05-08 16:30:43'),
(111, 3, 'Heartbeat', '2025-05-08 16:31:17'),
(112, 3, 'Heartbeat', '2025-05-08 16:31:21'),
(113, 3, 'Heartbeat', '2025-05-08 16:31:46'),
(114, 3, 'Heartbeat', '2025-05-08 16:39:21'),
(115, 3, 'login', '2025-05-08 18:04:34'),
(116, 3, 'Heartbeat', '2025-05-08 18:04:37'),
(117, 3, 'Heartbeat', '2025-05-08 18:07:13'),
(118, 3, 'Heartbeat', '2025-05-08 18:14:23'),
(119, 3, 'Heartbeat', '2025-05-08 18:14:37'),
(120, 3, 'Heartbeat', '2025-05-08 18:14:55'),
(121, 3, 'Heartbeat', '2025-05-08 18:15:07'),
(122, 3, 'Heartbeat', '2025-05-08 18:16:22'),
(123, 3, 'Heartbeat', '2025-05-08 18:16:44'),
(124, 3, 'Heartbeat', '2025-05-08 18:19:55'),
(125, 3, 'Heartbeat', '2025-05-08 18:20:44'),
(126, 3, 'Heartbeat', '2025-05-08 18:22:48'),
(127, 3, 'Heartbeat', '2025-05-08 18:28:12'),
(128, 3, 'Heartbeat', '2025-05-08 18:29:21'),
(129, 3, 'Heartbeat', '2025-05-08 18:37:30'),
(130, 3, 'Heartbeat', '2025-05-08 18:49:37'),
(131, 3, 'Heartbeat', '2025-05-08 18:50:54'),
(132, 3, 'Heartbeat', '2025-05-08 18:51:47'),
(133, 3, 'Heartbeat', '2025-05-08 19:01:22'),
(134, 3, 'Heartbeat', '2025-05-08 19:01:56'),
(135, 3, 'Heartbeat', '2025-05-08 19:01:57'),
(136, 3, 'Heartbeat', '2025-05-08 19:02:05'),
(137, 3, 'Heartbeat', '2025-05-08 19:04:45'),
(138, 3, 'Heartbeat', '2025-05-08 19:04:55'),
(139, 3, 'Heartbeat', '2025-05-08 19:06:17'),
(140, 3, 'Heartbeat', '2025-05-08 19:10:32'),
(141, 3, 'Heartbeat', '2025-05-08 19:13:35'),
(142, 3, 'Heartbeat', '2025-05-08 19:14:32'),
(143, 3, 'Heartbeat', '2025-05-08 19:16:00'),
(144, 3, 'Heartbeat', '2025-05-08 19:17:30'),
(145, 3, 'Heartbeat', '2025-05-08 19:18:30'),
(146, 3, 'Heartbeat', '2025-05-08 19:18:45'),
(147, 3, 'Heartbeat', '2025-05-08 19:23:51'),
(148, 3, 'Heartbeat', '2025-05-08 19:25:12'),
(149, 3, 'Heartbeat', '2025-05-08 19:26:19'),
(150, 3, 'Heartbeat', '2025-05-08 19:32:43'),
(151, 3, 'Heartbeat', '2025-05-08 19:32:54'),
(152, 3, 'Heartbeat', '2025-05-08 19:33:23'),
(153, 3, 'Heartbeat', '2025-05-08 19:33:24'),
(154, 3, 'Heartbeat', '2025-05-08 19:40:17'),
(155, 3, 'Heartbeat', '2025-05-08 19:40:54'),
(156, 3, 'Heartbeat', '2025-05-08 19:41:23'),
(157, 3, 'Heartbeat', '2025-05-08 19:41:33'),
(158, 3, 'Heartbeat', '2025-05-08 19:42:32'),
(159, 3, 'Heartbeat', '2025-05-08 19:44:47'),
(160, 3, 'Heartbeat', '2025-05-08 19:47:33'),
(161, 3, 'Heartbeat', '2025-05-08 19:48:55'),
(162, 3, 'Heartbeat', '2025-05-08 19:48:57'),
(163, 3, 'Heartbeat', '2025-05-08 19:49:01'),
(164, 3, 'Heartbeat', '2025-05-08 19:52:06'),
(165, 3, 'Heartbeat', '2025-05-08 19:52:21'),
(166, 3, 'Heartbeat', '2025-05-08 19:56:36'),
(167, 3, 'Heartbeat', '2025-05-08 19:58:54'),
(168, 3, 'Heartbeat', '2025-05-08 19:59:31'),
(169, 3, 'Heartbeat', '2025-05-08 19:59:31'),
(170, 3, 'Heartbeat', '2025-05-08 19:59:46'),
(171, 3, 'Heartbeat', '2025-05-08 20:01:57'),
(172, 3, 'Heartbeat', '2025-05-08 20:02:04'),
(173, 3, 'Heartbeat', '2025-05-08 20:06:31'),
(174, 3, 'Heartbeat', '2025-05-08 20:12:37'),
(175, 3, 'Heartbeat', '2025-05-08 20:14:59'),
(176, 3, 'Heartbeat', '2025-05-08 20:19:57'),
(177, 3, 'Heartbeat', '2025-05-08 20:24:36'),
(178, 3, 'login', '2025-05-08 20:26:03'),
(179, 3, 'logout', '2025-05-08 20:27:45'),
(180, 3, 'login', '2025-05-12 23:23:51'),
(181, 3, 'Heartbeat', '2025-05-12 23:24:07'),
(182, 3, 'Heartbeat', '2025-05-12 23:32:24'),
(183, 3, 'logout', '2025-05-12 23:36:36'),
(184, 3, 'login', '2025-05-12 23:54:52'),
(185, 3, 'Heartbeat', '2025-05-12 23:54:56'),
(186, 3, 'Heartbeat', '2025-05-12 23:56:00'),
(187, 3, 'Heartbeat', '2025-05-12 23:57:24'),
(188, 3, 'logout', '2025-05-13 00:01:02'),
(189, 63, 'login', '2025-05-13 00:01:33'),
(190, 3, 'login', '2025-05-13 00:11:53'),
(191, 3, 'logout', '2025-05-13 00:18:42'),
(192, 3, 'login', '2025-05-13 00:21:10'),
(193, 3, 'logout', '2025-05-13 00:24:06'),
(194, 3, 'login', '2025-05-13 00:38:39'),
(195, 3, 'Heartbeat', '2025-05-13 00:46:36'),
(196, 3, 'logout', '2025-05-13 01:59:21'),
(197, 17, 'login', '2025-05-13 08:53:05'),
(198, 17, 'logout', '2025-05-13 08:53:28'),
(199, 3, 'login', '2025-05-13 08:53:35'),
(200, 3, 'Heartbeat', '2025-05-13 08:54:22'),
(201, 3, 'Heartbeat', '2025-05-13 08:54:34'),
(202, 3, 'Heartbeat', '2025-05-13 08:55:16'),
(203, 3, 'Heartbeat', '2025-05-13 08:55:25'),
(204, 3, 'logout', '2025-05-13 09:08:41'),
(205, 3, 'login', '2025-05-13 09:41:39'),
(206, 3, 'Heartbeat', '2025-05-13 09:41:43'),
(207, 3, 'Heartbeat', '2025-05-13 09:43:39'),
(208, 3, 'logout', '2025-05-13 09:43:57'),
(209, 65, 'login', '2025-05-13 09:44:15'),
(210, 65, 'logout', '2025-05-13 09:44:24'),
(211, 3, 'login', '2025-05-13 09:46:27'),
(212, 3, 'Heartbeat', '2025-05-13 09:53:08'),
(213, 3, 'logout', '2025-05-13 09:54:00'),
(214, 3, 'login', '2025-05-13 09:58:43'),
(215, 3, 'Heartbeat', '2025-05-13 09:58:50'),
(216, 3, 'logout', '2025-05-13 10:04:15'),
(217, 15, 'login', '2025-05-13 10:04:21'),
(218, 15, 'logout', '2025-05-13 14:24:38'),
(219, 19, 'login', '2025-05-13 14:25:04'),
(220, 19, 'logout', '2025-05-13 14:46:41'),
(221, 3, 'login', '2025-05-13 14:46:46'),
(222, 3, 'Heartbeat', '2025-05-13 16:32:36'),
(223, 3, 'logout', '2025-05-13 16:45:55'),
(224, 3, 'login', '2025-05-13 16:54:42'),
(225, 3, 'Heartbeat', '2025-05-13 16:58:43'),
(226, 3, 'Heartbeat', '2025-05-13 16:58:56'),
(227, 3, 'Heartbeat', '2025-05-13 17:01:30'),
(228, 3, 'Heartbeat', '2025-05-13 17:03:23'),
(229, 3, 'Heartbeat', '2025-05-13 17:06:04'),
(230, 3, 'logout', '2025-05-13 17:09:51'),
(231, 3, 'login', '2025-05-13 17:25:45'),
(232, 3, 'login', '2025-05-21 22:46:43'),
(233, 3, 'login', '2025-05-24 05:10:42'),
(234, 3, 'Heartbeat', '2025-05-24 05:10:48'),
(235, 3, 'Heartbeat', '2025-05-24 05:23:37'),
(236, 3, 'Heartbeat', '2025-05-24 06:10:42'),
(237, 3, 'login', '2025-05-25 18:05:55'),
(238, 3, 'logout', '2025-05-25 18:08:39'),
(239, 19, 'login', '2025-05-25 18:09:43'),
(240, 19, 'logout', '2025-05-25 18:15:13'),
(241, 3, 'login', '2025-05-25 18:15:15'),
(242, 3, 'Heartbeat', '2025-05-25 18:15:19'),
(243, 3, 'logout', '2025-05-25 18:16:10'),
(244, 19, 'login', '2025-05-25 18:16:36'),
(245, 19, 'logout', '2025-05-25 21:13:13'),
(246, 3, 'login', '2025-05-25 21:13:15'),
(247, 3, 'logout', '2025-05-25 21:15:19'),
(248, 19, 'login', '2025-05-25 21:15:41'),
(249, 19, 'logout', '2025-05-25 23:28:15'),
(250, 3, 'login', '2025-05-26 10:30:55'),
(251, 3, 'logout', '2025-05-26 10:44:06'),
(252, 19, 'login', '2025-05-26 10:44:29'),
(253, 19, 'logout', '2025-05-26 11:05:37'),
(254, 3, 'login', '2025-05-26 11:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `t_admin`
--

CREATE TABLE `t_admin` (
  `AdminId` varchar(25) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_admin`
--

INSERT INTO `t_admin` (`AdminId`, `UserId`, `Position`, `Department`) VALUES
('admin_67e22850c68bf', 3, '', ''),
('admin_67e238412f47f', 4, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_asset`
--

CREATE TABLE `t_asset` (
  `AssetId` int(11) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `AssetName` varchar(55) NOT NULL,
  `AssetTypeId` int(11) NOT NULL,
  `SerialNumber` varchar(55) DEFAULT NULL,
  `PurchasedDate` date DEFAULT NULL,
  `AssetStatus` enum('Available','In Use','Maintenance','Disposed','Transferred','Transfer Request') DEFAULT 'In Use',
  `Description` text DEFAULT NULL,
  `PropertyNumber` varchar(30) DEFAULT NULL,
  `Acquisition` enum('Donation','QCG') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_asset`
--

INSERT INTO `t_asset` (`AssetId`, `BranchId`, `AssetName`, `AssetTypeId`, `SerialNumber`, `PurchasedDate`, `AssetStatus`, `Description`, `PropertyNumber`, `Acquisition`) VALUES
(1, 25, 'Hp Laptop', 123456, 'DL123456', '2025-05-04', 'In Use', 'Testing', 'HP-LAPTOP-2023-0001', 'Donation'),
(2, 6, 'Dell Latitude 7430', 1, 'DL7430-2023-9987', '2024-07-23', 'In Use', 'Black', 'PUP-ITD-DELL7430-0001', 'QCG'),
(3, 7, 'Epson EcoTank L3210', 3, 'EP-L3210-2022-0012', '2024-08-21', 'In Use', 'High-efficiency color inkjet printer', 'QCG-ITD-DELL7430-0002', 'QCG'),
(4, 11, 'Dell Latitude 7435', 1, 'SN-DL7435-00129', '2025-02-10', 'In Use', 'Intel i7, 16GB RAM, 512GB SSD, Windows 11 Pro', 'QCG-DELL7435-0025', 'QCG'),
(5, 17, 'Epson EcoTank L3215', 4, 'EP-L3215-2022-0012', '2025-04-14', 'Maintenance', 'High-efficiency color inkjet printer', 'QCG-EPSON-3215-0012', 'QCG');

-- --------------------------------------------------------

--
-- Table structure for table `t_assettransfer`
--

CREATE TABLE `t_assettransfer` (
  `TransferId` int(11) NOT NULL,
  `AssetId` int(11) NOT NULL,
  `fromBranchId` int(11) NOT NULL,
  `toBranchId` int(11) NOT NULL,
  `requestedByBranchAdminId` varchar(25) NOT NULL,
  `approvedByITstaffId` varchar(30) DEFAULT NULL,
  `requestDate` date DEFAULT NULL,
  `transferDate` date DEFAULT NULL,
  `transferStatus` enum('Pending','Approved','Rejected','Completed') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `t_assettransfer`
--
DELIMITER $$
CREATE TRIGGER `after_transfer_request` AFTER INSERT ON `t_assettransfer` FOR EACH ROW BEGIN
    UPDATE t_asset
    SET AssetStatus = 'Transfer Request'
    WHERE AssetId = NEW.AssetId;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_transfer_update` AFTER UPDATE ON `t_assettransfer` FOR EACH ROW BEGIN
	/*If transfer   is approved but not yet completed*/
    IF NEW.TransferStatus = 'Approved' THEN
    	UPDATE t_asset
        SET AssetStatus = 'Transfer Request'
        WHERE AssetId = NEW.AssetId;
    END IF; 

	/*If transfer is marked as completed */
    IF NEW.TransferStatus = 'Completed' THEN 
    	UPDATE t_asset
        SET AssetStatus = 'Transferred'
        WHERE AssetId = NEW.AssetId;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_assettype`
--

CREATE TABLE `t_assettype` (
  `AssetTypeId` int(11) NOT NULL,
  `AssetTypeName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_assettype`
--

INSERT INTO `t_assettype` (`AssetTypeId`, `AssetTypeName`) VALUES
(1, 'Laptop'),
(2, 'Desktop Computer'),
(3, 'Monitor'),
(4, 'Printer'),
(5, 'Projector'),
(6, 'Server'),
(7, 'Networking Equipment'),
(8, 'Mobile Phone'),
(9, 'Tablet'),
(10, 'Software License'),
(11, 'External Storage Device'),
(12, 'Office Furniture'),
(13, 'Air Conditioner'),
(14, 'CCTV Camera'),
(15, 'Scanner');

-- --------------------------------------------------------

--
-- Table structure for table `t_branch`
--

CREATE TABLE `t_branch` (
  `BranchId` int(11) NOT NULL,
  `BranchName` varchar(50) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `Location` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_branch`
--

INSERT INTO `t_branch` (`BranchId`, `BranchName`, `DistrictId`, `Location`) VALUES
(1, 'Balingasa', 1, 'Second floor, Crisologo Building\r\nBarangay Balingasa, Quezon City'),
(2, 'Masambong ', 2, 'Masambong Multi-Purpose Building, 04 Capoas, Lungsod Quezon, Kalakhang Maynila, Philippines'),
(3, 'Nayong Kanluran ', 3, '2nd Floor Bagong Henerasyon “BH” Center, 37 Sorsogon Street, Barangay Nayong Kanluran, Quezon City, Metro Manila 1104'),
(4, 'NS Amoranto ', 4, 'Mayon Avenue, Brgy. NS Amoranto, Quezon City'),
(5, 'Project 7', 5, 'Bansalangin corner Palomaria Streets\r\nBarangay Veterans, Quezon City'),
(6, 'Project 8 ', 6, 'Road 15 corner Road 19\r\nBarangay Bahay Toro, Quezon City'),
(7, 'Book Nook (WalterMart-NE)', 7, '3rd floor of WalterMart North Edsa'),
(8, 'Bagong Pagasa', 8, 'Road 9, Barangay Bagong Pag-asa, Quezon City'),
(9, 'Payatas Lupang Pangako ', 9, 'Barangay Payatas, Quezon City'),
(10, 'Bagong Silangan', 10, '2nd Floor Susano Building, 570- A Bonifacio Street, corner Gen. Villamor, Quezon City, 1119 Metro Manila, Philippines'),
(11, 'Holy Spirit', 11, 'No. 6 Faustino St., Isidora Hills Subd., Brgy. Holy Spirit, District 2, Quezon City'),
(12, 'MRB Commonwealth', 12, 'Pilot St. corner Rotary, MRB Building, Barangay Commonwealth, Quezon City'),
(13, 'Payatas Landfill', 13, 'Clemente Street, Phase 3 Barangay Payatas B, Quezon City, Metro Manila 1119'),
(14, 'Greater Project 4', 19, 'A. Luna 58 1109 Quezon City National Capital Region'),
(15, 'Tagumpay', 20, '2B P. Tuazon Boulevard, Barangay Tagumpay, Cubao, Quezon City, Metro Manila 1109'),
(16, 'Libis', 21, 'Libis, Quezon City, National Capital Region, Philippines'),
(17, 'Matandang Balara', 22, 'Bistek Ville 20 Villa Beatriz, Barangay Matandang Balara.'),
(18, 'Escopa 2', 23, 'Barangay Escopa 2, Quezon City'),
(19, 'Escopa 3', 24, 'Barangay Escopa 3 PUD Site Bliss, Barangay Covered Court, Quezon City'),
(20, 'Cubao', 25, 'Ground floor, Lion\'s International Building\r\nBarangay Kamuning, Quezon City'),
(21, 'Krus na Ligas', 26, 'Second floor, Daza Hall\r\nBarangay Krus na Ligas, Quezon City'),
(22, 'San Isidro Galas', 27, 'Second floor, Barangay Hall\r\nBarangay San Isidro-Galas, Quezon City'),
(23, 'ROXAS', 28, 'Jasmin Street\r\nBarangay Roxas, Quezon City'),
(24, 'UP Campus Pook Amorsolo', 29, 'Diliman,\r\nQuezon City'),
(25, 'UP Campus Pook Dagohoy', 30, 'Diliman,\r\nQuezon City'),
(26, 'Lagro', 31, 'Greater Lagro Plaza\r\nBarangay Pasong Putik, Quezon City'),
(27, 'North Fairview', 32, '3rd Floor Barangay Hall, Brookside Street corner Brimley Street, Fairview Homes, Barangay North Fairview, Quezon City, Metro Manila 1121'),
(28, 'Novaliches', 33, 'SB Library Bldg., Quirino Highway\r\nNovaliches, Quezon City'),
(29, 'Pasong Tamo', 34, 'Diego Silang St\r\nBarangay Pasong Tamo, Quezon City'),
(30, 'Talipapa', 35, 'Quirino Highway, Barangay Talipapa, Quezon City'),
(31, 'Sagana', 36, 'Sagana Homes, Block 1 Lot 3 1 Subdivision, Quezon City, Metro Manila, Philippines'),
(32, 'Tandang Sora', 37, 'Tandang Sora, Quezon City'),
(33, 'QCPL Main Branch', 38, 'Mayaman Street,\r\nBarangay Central, Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `t_branchadmin`
--

CREATE TABLE `t_branchadmin` (
  `BranchAdminId` varchar(25) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_branchadmin`
--

INSERT INTO `t_branchadmin` (`BranchAdminId`, `UserId`, `Position`, `Department`) VALUES
('branchadmin_67e25600a2f6f', 8, '', ''),
('branchadmin_67e2622bb1caa', 14, '', ''),
('branchadmin_67e2628ad853f', 15, '', ''),
('branchadmin_681a0b0c80fac', 50, '', ''),
('branchadmin_681a7fcf1ef3c', 61, '', ''),
('branchadmin_6822e0a1b6968', 64, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_district`
--

CREATE TABLE `t_district` (
  `DistrictId` int(11) NOT NULL,
  `DistrictNo` varchar(25) DEFAULT NULL,
  `DistricTName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_district`
--

INSERT INTO `t_district` (`DistrictId`, `DistrictNo`, `DistricTName`) VALUES
(1, 'District 1 ', 'Balingasa'),
(2, 'District 1 ', 'Masambong'),
(3, 'District 1 ', 'Nayong Kanluran '),
(4, 'District 1 ', 'NS Amoranto '),
(5, 'District 1 ', 'Project 7 '),
(6, 'District 1 ', 'Project 8 '),
(7, 'District 1', 'Book Nook(WalterMart'),
(8, 'District 1', 'Bagong Pagasa '),
(9, 'District 2 ', 'Payatas Lupang Pangako '),
(10, 'District 2', 'Bagong Silangan '),
(11, 'District 2', 'Holy Spirit '),
(12, 'District 2', 'MRB Commonwealth '),
(13, 'District 2 ', 'Payatas Landfill'),
(19, 'District 3 ', 'Greater Project 4 '),
(20, 'District 3 ', 'Tagumpay '),
(21, 'District 3 ', 'Libis '),
(22, 'District 3 ', 'Matandang Balara '),
(23, 'District 3 ', 'Escopa 2 '),
(24, 'District 3', 'Escopa 3 '),
(25, 'District 4 ', 'Cubao '),
(26, 'District 4', 'Krus na Ligas '),
(27, 'District 4 ', 'San Isidro Galas '),
(28, 'District 4 ', 'ROXAS'),
(29, 'District 4', 'UP Campus Pook Amorsolo'),
(30, 'District 4 ', 'UP Campus Pook Dagohoy '),
(31, 'District 5 ', 'Lagro '),
(32, 'District 5', 'North Fairview '),
(33, 'District 5 ', 'Novaliches '),
(34, 'District 6 ', 'Pasong Tamo '),
(35, 'District 6 ', 'Talipapa '),
(36, 'District 6', 'Sagana '),
(37, 'District 6', 'Tandang Sora '),
(38, 'District 4', 'QCPL Main Branch ');

-- --------------------------------------------------------

--
-- Table structure for table `t_issuedsubtype`
--

CREATE TABLE `t_issuedsubtype` (
  `SubtypeId` int(11) NOT NULL,
  `IssueId` int(11) NOT NULL,
  `SubtypeName` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_issuedsubtype`
--

INSERT INTO `t_issuedsubtype` (`SubtypeId`, `IssueId`, `SubtypeName`) VALUES
(1, 1, 'Keyboard'),
(2, 1, 'Mouse'),
(3, 1, 'Monitor'),
(4, 1, 'Printer'),
(5, 1, 'System Unit'),
(6, 2, 'System Error'),
(7, 2, 'Installation Issue'),
(8, 2, 'Application Crash'),
(9, 2, 'License Expiration'),
(10, 3, 'No Internet'),
(11, 3, 'Slow Connection'),
(12, 3, 'VPN Issue'),
(13, 3, 'Network Cable Problem');

-- --------------------------------------------------------

--
-- Table structure for table `t_issuedtype`
--

CREATE TABLE `t_issuedtype` (
  `IssueId` int(11) NOT NULL,
  `IssueType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_issuedtype`
--

INSERT INTO `t_issuedtype` (`IssueId`, `IssueType`) VALUES
(1, 'Hardware'),
(2, 'Software'),
(3, 'Network');

-- --------------------------------------------------------

--
-- Table structure for table `t_itstaff`
--

CREATE TABLE `t_itstaff` (
  `ITstaffId` varchar(30) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_itstaff`
--

INSERT INTO `t_itstaff` (`ITstaffId`, `UserId`, `Position`, `Department`) VALUES
('itstaff_67e258517c98b', 12, '', ''),
('itstaff_67e264a751378', 17, '', ''),
('itstaff_67e42413ad043', 33, '', ''),
('itstaff_67ec447925949', 34, '', ''),
('itstaff_67f57291dcd77', 38, '', ''),
('itstaff_6810d3d8b4975', 47, '', ''),
('itstaff_681a088065f75', 48, '', ''),
('itstaff_6822d1303bd75', 63, '', ''),
('itstaff_68235a8d44e6f', 65, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_notifs`
--

CREATE TABLE `t_notifs` (
  `NotifId` int(11) NOT NULL,
  `NotifType` enum('Ticket','Transfer') DEFAULT NULL,
  `ReferencesId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `NotifMessage` text DEFAULT NULL,
  `Notifstatus` enum('Unread','Read') DEFAULT 'Unread',
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_roles`
--

CREATE TABLE `t_roles` (
  `RoleId` int(11) NOT NULL,
  `RoleName` enum('UserEmp','ITstaff','BranchAdmin','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_roles`
--

INSERT INTO `t_roles` (`RoleId`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'BranchAdmin'),
(3, 'ITstaff'),
(4, 'UserEmp');

-- --------------------------------------------------------

--
-- Table structure for table `t_ticketissues`
--

CREATE TABLE `t_ticketissues` (
  `TicketIssueId` int(11) NOT NULL,
  `TicketId` varchar(250) NOT NULL,
  `IssueId` int(11) NOT NULL,
  `SubtypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_ticketissues`
--

INSERT INTO `t_ticketissues` (`TicketIssueId`, `TicketId`, `IssueId`, `SubtypeId`) VALUES
(2, '25-UP Y-250526-employee_67e267733e5-060338', 2, 9),
(3, '25-UP Y-250526-employee_67e267733e5-060338', 1, 3),
(4, '25-UP Y-250526-employee_67e267733e5-061736', 3, 12),
(5, '25-UP Y-250526-employee_67e267733e5-061736', 2, 8),
(6, '25-UP Y-250526-employee_67e267733e5-061736', 1, 2),
(7, '25-UP Y-250526-employee_67e267733e5-174451', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `t_tickets`
--

CREATE TABLE `t_tickets` (
  `TicketId` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `EmployeeId` varchar(20) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `DistrictId` int(11) NOT NULL,
  `AssignedITstaffId` varchar(30) DEFAULT NULL,
  `AssetId` int(11) NOT NULL,
  `Description` text DEFAULT NULL,
  `TicketStatus` enum('Pending','Completed','Ongoing','Cancelled') DEFAULT 'Pending',
  `Priority` enum('Low','Medium','High') DEFAULT 'Low',
  `TimeSubmitted` timestamp NOT NULL DEFAULT current_timestamp(),
  `TimeResolved` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_tickets`
--

INSERT INTO `t_tickets` (`TicketId`, `EmployeeId`, `BranchId`, `DistrictId`, `AssignedITstaffId`, `AssetId`, `Description`, `TicketStatus`, `Priority`, `TimeSubmitted`, `TimeResolved`) VALUES
('10', 'employee_67e26713d38', 25, 30, NULL, 1, 'black', 'Pending', 'Low', '2025-05-25 23:34:42', NULL),
('12', 'employee_67e267733e5', 25, 25, NULL, 1, 'black', 'Pending', 'Low', '2025-05-26 01:05:08', NULL),
('13', 'employee_67e267733e5', 25, 25, NULL, 5, 'try', 'Pending', 'Low', '2025-05-26 02:07:40', NULL),
('14', 'employee_67e267733e5', 25, 25, NULL, 3, 'platnm', 'Pending', 'Low', '2025-05-26 02:10:43', NULL),
('25-UP Y-250526-employee_67e267733e5-043456', 'employee_67e267733e5', 25, 25, NULL, 1, 'blackvv', 'Pending', 'Low', '2025-05-26 02:34:56', NULL),
('25-UP Y-250526-employee_67e267733e5-045601', 'employee_67e267733e5', 25, 25, NULL, 2, 'Array', 'Pending', 'Low', '2025-05-26 02:56:01', NULL),
('25-UP Y-250526-employee_67e267733e5-052558', 'employee_67e267733e5', 25, 25, NULL, 1, 'Array', 'Pending', 'Low', '2025-05-26 03:25:58', NULL),
('25-UP Y-250526-employee_67e267733e5-054345', 'employee_67e267733e5', 25, 25, NULL, 3, 'Array', 'Pending', 'Low', '2025-05-26 03:43:45', NULL),
('25-UP Y-250526-employee_67e267733e5-054541', 'employee_67e267733e5', 25, 25, NULL, 3, 'xcvb', 'Pending', 'Low', '2025-05-26 03:45:41', NULL),
('25-UP Y-250526-employee_67e267733e5-060338', 'employee_67e267733e5', 25, 25, NULL, 1, 'l1\nmm', 'Pending', 'Low', '2025-05-26 04:03:38', NULL),
('25-UP Y-250526-employee_67e267733e5-061736', 'employee_67e267733e5', 25, 25, NULL, 4, '222dfgh\nkjado\nchange', 'Pending', 'Low', '2025-05-26 04:17:36', NULL),
('25-UP Y-250526-employee_67e267733e5-174451', 'employee_67e267733e5', 25, 25, NULL, 5, 'testing oink', 'Pending', 'Low', '2025-05-26 15:44:51', NULL),
('25-UPC-20250526-employee_67e267733e5-042855', 'employee_67e267733e5', 25, 25, NULL, 3, '..', 'Pending', 'Low', '2025-05-26 02:28:55', NULL),
('6', 'employee_67e267733e5', 25, 25, NULL, 1, 'testing', 'Pending', 'High', '2025-05-06 04:15:32', NULL),
('7', 'employee_67e267733e5', 10, 10, NULL, 3, 'Blank print', 'Pending', 'High', '2025-05-06 14:27:23', NULL),
('8', 'employee_67e267733e5', 25, 25, NULL, 3, 'hhhhhhh', 'Pending', 'High', '2025-05-06 19:52:02', NULL),
('9', 'employee_67e267733e5', 25, 25, NULL, 3, 'scanner issue ', 'Pending', 'High', '2025-05-06 21:39:40', NULL);

--
-- Triggers `t_tickets`
--
DELIMITER $$
CREATE TRIGGER `update_ticket_priority` BEFORE UPDATE ON `t_tickets` FOR EACH ROW BEGIN
    -- Check if the status is 'Pending' and it's more than 7 days since created
    IF NEW.TicketStatus = 'Pending' AND DATEDIFF(CURRENT_DATE, NEW.TimeSubmitted) > 7 THEN
        SET NEW.Priority = 'High';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `t_useremp`
--

CREATE TABLE `t_useremp` (
  `EmployeeId` varchar(20) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Position` varchar(25) DEFAULT NULL,
  `Department` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_useremp`
--

INSERT INTO `t_useremp` (`EmployeeId`, `UserId`, `Position`, `Department`) VALUES
('employee_67e2590d7a6', 13, '', ''),
('employee_67e26713d38', 18, '', ''),
('employee_67e267733e5', 19, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `t_users`
--

CREATE TABLE `t_users` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(45) NOT NULL,
  `Email` varchar(70) NOT NULL,
  `Contactno` varchar(11) DEFAULT NULL,
  `DistrictId` int(11) NOT NULL,
  `BranchId` int(11) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `RoleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `t_users`
--

INSERT INTO `t_users` (`UserId`, `FirstName`, `LastName`, `Email`, `Contactno`, `DistrictId`, `BranchId`, `Password`, `RoleId`) VALUES
(3, 'Admin', 'Admin', 'Admin@mail.com', '2147483647', 1, 1, '$2y$10$cd1FcVDTwR/Q8PM5FX3J3ughe3huyJMDVWjkNJpTCXk45FJzJHmhC', 1),
(4, 'Admin', 'Admin', 'Admin@mail.com', '2147483647', 4, 4, '$2y$10$5tj.MmZUTemTxquLCKJwgOUM1e4aj6QKHlM6ond/gl3FLSXrCqpg2', 1),
(6, 'LIC', 'LIC', 'Lic@mail.com', '2147483647', 4, 4, '$2y$10$BQNKDVqJPPFziojmDWRMguqTIC37xo2n/SkxEwDRYJqj0vVxh0bAe', 2),
(7, 'LIC', 'LIC', 'Lic@mail.com', '2147483647', 4, 4, '$2y$10$NQ6Zjk8CvuSkXBFA/P0zhuukjKy.AX9h/oqUsGCnqLIPiUl9jGxZ2', 2),
(8, 'LIC', 'LIC', 'Lic@mail.com', '2147483647', 4, 4, '$2y$10$gzve6w4uX1TwEHF/eHuvH.ytYxt3IzJk8Vu1jKih77urGjG1wjU6.', 2),
(11, 'IT', 'staff', 'ITstaff@mail.com', '2147483647', 10, 10, '$2y$10$TTygKQQfMRpeSrXgLbb3MOR84O/laPX3cti8/YGRhd9cDhVM3YlWe', 3),
(12, 'IT', 'staff', 'ITstaff@mail.com', '2147483647', 10, 10, '$2y$10$IikVPLRwrfqfMnl6BbQw5.pi4kCO1KKQpIvXPuUMyt.5kU9ZnU9T6', 3),
(13, 'employeesample', 'sample', 'Employee@mail.com', '2147483647', 19, 19, '$2y$10$a5rVr1wRAfu8jpByHnKuJORaqOLgd1o2y3xNXuvGN1qcb6PUDpkEy', 4),
(14, 'Ash', 'LIC', 'Lic@mail.com', '2147483647', 5, 5, '$2y$10$LFZ9vjbbZbwQ0jVrWzsgZOyGxNVWeZg43iPsVCpqRGFgGlvZ1S24q', 2),
(15, 'Ash', 'LIC', 'LicAsh@mail.com', '2147483647', 5, 5, '$2y$10$82gGKhomqPGfWCzJNRVV8.amrv8IllSR16A.TZGM8Tb3lCAg9D4da', 2),
(17, 'Hyas', 'ITstaff', 'ITstaff1@mail.com', '2147483647', 21, 21, '$2y$10$3GHnYvY7BenxeTGZARU6pOknwPtuxuKC84aOOJlYq2hvGxA9hi3Ja', 3),
(18, 'Ashley', 'delaCruz', 'Aldehalseymeows@mail.com', '2147483647', 30, 25, '$2y$10$Pa.0/DSMaqWmywbpBpHZyuQfDll8fV6YdIg0pGq9NczDjU7MpEJVy', 4),
(19, 'Ashley1', 'delaCruz', 'Aldehalseymeows1@mail.com', '2147483647', 25, 25, '$2y$10$9aTohvc0RjffZtHOppFGdOGe4yqjjZpKeHvB3fwOKfOmwnnbqjiUS', 4),
(33, 'Ria', 'Santos', 'RiaSantos@mail.com', '09337548800', 25, 20, '$2y$10$xvQKc2S8sQFPGAgHuS0equYMsM9JOU98uWZnnE/l1fzfrA5qaE9Pq', 3),
(34, 'Eziell', 'Villamor', 'ITstaff3@mail.com', '2147483647', 27, 22, '$2y$10$xeKLz5a9M341Yf9Z8NCqEOmx/jBcnpoNFcoD7DzpykQ.UWHTEsG7y', 3),
(38, 'Jhulius Kae', 'delaCruz', 'jhuliusdelacruzjdc10@gmail.com', '2147483647', 28, 23, '$2y$10$7AVUBbtSRL1RXcbxHOBlnu/l/Y742cyvBHMKgh2A1BaAhn4tyLal6', 3),
(47, 'Fal', 'dawnas', 'halseyaldecruz@gmail.com', '2147483647', 28, 23, '$2y$10$Vn61mAvXVVYDyiTRi8dFh.kINkawgLrnUFeFmLqtv1L4xTP0lcjs.', 3),
(48, 'Leanne', 'Delamar', 'leannedelamar@gmail.com', '09469417070', 32, 27, '$2y$10$Q.PxylkdRNMI7Ep1/bAFF.JjCKhlzMSEpeNDa3xHONO4ST29mez1S', 3),
(50, 'Gary', 'Mesahon', 'grayv@gmail.com', '09469318080', 4, 4, '$2y$10$FmDHNpMwD3fdoRRHv79xvOvkUiNidDiZBooUGldXk.FxuseNm946.', 2),
(61, 'Fal', 'dawnas', 'halseyaldecruz1@gmail.com', '00946941672', 11, 11, '$2y$10$VcY3J1fM4gyE2BR/ug.hdeJTdZbqbeMONTEJ0jxunzy9G0YMyY6au', 2),
(63, 'Caren', 'Pajarillo', 'pajarillorico@gmail.com', '09378276634', 29, 24, '$2y$10$Ea.Ks1EapIdEJ7AOwjFajO1NQzQpeQ5Hil8uNu6qgKRmzZZHRMzme', 3),
(64, 'Sally ', 'Matula', 'Ashleydelacruzasc01@gmail.com', '09424687671', 37, 32, '$2y$10$wrG4plM0TFuAFiLn0ssDr.0a/aG3qhFju1lux0fwJZdp9t5iw7jti', 2),
(65, 'hyas', 'Castro', 'hsalayay@gmail.com', '09876725431', 38, 33, '$2y$10$EAMTbDkggPyVfmY2VT4zNOcM8acUZIN8WZBRx53nrbe3vtEO/qr06', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_activitylogs`
--
ALTER TABLE `t_activitylogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_activitylogs_ibfk_1` (`UserId`);

--
-- Indexes for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD PRIMARY KEY (`AdminId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_asset`
--
ALTER TABLE `t_asset`
  ADD PRIMARY KEY (`AssetId`);

--
-- Indexes for table `t_assettransfer`
--
ALTER TABLE `t_assettransfer`
  ADD PRIMARY KEY (`TransferId`),
  ADD KEY `AssetId` (`AssetId`),
  ADD KEY `fromBranchId` (`fromBranchId`),
  ADD KEY `toBranchId` (`toBranchId`),
  ADD KEY `requestedByBranchAdminId` (`requestedByBranchAdminId`),
  ADD KEY `approvedByITstaffId` (`approvedByITstaffId`);

--
-- Indexes for table `t_assettype`
--
ALTER TABLE `t_assettype`
  ADD PRIMARY KEY (`AssetTypeId`);

--
-- Indexes for table `t_branch`
--
ALTER TABLE `t_branch`
  ADD PRIMARY KEY (`BranchId`),
  ADD KEY `DistrictId` (`DistrictId`);

--
-- Indexes for table `t_branchadmin`
--
ALTER TABLE `t_branchadmin`
  ADD PRIMARY KEY (`BranchAdminId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_district`
--
ALTER TABLE `t_district`
  ADD PRIMARY KEY (`DistrictId`);

--
-- Indexes for table `t_issuedsubtype`
--
ALTER TABLE `t_issuedsubtype`
  ADD PRIMARY KEY (`SubtypeId`);

--
-- Indexes for table `t_issuedtype`
--
ALTER TABLE `t_issuedtype`
  ADD PRIMARY KEY (`IssueId`);

--
-- Indexes for table `t_itstaff`
--
ALTER TABLE `t_itstaff`
  ADD PRIMARY KEY (`ITstaffId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_notifs`
--
ALTER TABLE `t_notifs`
  ADD PRIMARY KEY (`NotifId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_roles`
--
ALTER TABLE `t_roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `t_ticketissues`
--
ALTER TABLE `t_ticketissues`
  ADD PRIMARY KEY (`TicketIssueId`),
  ADD KEY `fk_ticketissues_ticketid` (`TicketId`),
  ADD KEY `fk_ticketissues_issueid` (`IssueId`),
  ADD KEY `fk_ticketissues_subtypeid` (`SubtypeId`);

--
-- Indexes for table `t_tickets`
--
ALTER TABLE `t_tickets`
  ADD PRIMARY KEY (`TicketId`),
  ADD KEY `EmployeeId` (`EmployeeId`),
  ADD KEY `BranchId` (`BranchId`),
  ADD KEY `DistrictId` (`DistrictId`),
  ADD KEY `AssignedITstaffId` (`AssignedITstaffId`),
  ADD KEY `AssetId` (`AssetId`);

--
-- Indexes for table `t_useremp`
--
ALTER TABLE `t_useremp`
  ADD PRIMARY KEY (`EmployeeId`),
  ADD KEY `UserId` (`UserId`);

--
-- Indexes for table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`UserId`),
  ADD KEY `DistrictId` (`DistrictId`),
  ADD KEY `BranchId` (`BranchId`),
  ADD KEY `RoleId` (`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_activitylogs`
--
ALTER TABLE `t_activitylogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `t_asset`
--
ALTER TABLE `t_asset`
  MODIFY `AssetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `t_assettransfer`
--
ALTER TABLE `t_assettransfer`
  MODIFY `TransferId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_assettype`
--
ALTER TABLE `t_assettype`
  MODIFY `AssetTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `t_branch`
--
ALTER TABLE `t_branch`
  MODIFY `BranchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `t_district`
--
ALTER TABLE `t_district`
  MODIFY `DistrictId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `t_issuedsubtype`
--
ALTER TABLE `t_issuedsubtype`
  MODIFY `SubtypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_issuedtype`
--
ALTER TABLE `t_issuedtype`
  MODIFY `IssueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t_notifs`
--
ALTER TABLE `t_notifs`
  MODIFY `NotifId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_roles`
--
ALTER TABLE `t_roles`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_ticketissues`
--
ALTER TABLE `t_ticketissues`
  MODIFY `TicketIssueId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_activitylogs`
--
ALTER TABLE `t_activitylogs`
  ADD CONSTRAINT `t_activitylogs_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`) ON DELETE CASCADE;

--
-- Constraints for table `t_admin`
--
ALTER TABLE `t_admin`
  ADD CONSTRAINT `t_admin_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_assettransfer`
--
ALTER TABLE `t_assettransfer`
  ADD CONSTRAINT `t_assettransfer_ibfk_1` FOREIGN KEY (`AssetId`) REFERENCES `t_asset` (`AssetId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_assettransfer_ibfk_2` FOREIGN KEY (`fromBranchId`) REFERENCES `t_branch` (`BranchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_assettransfer_ibfk_3` FOREIGN KEY (`toBranchId`) REFERENCES `t_branch` (`BranchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_assettransfer_ibfk_4` FOREIGN KEY (`requestedByBranchAdminId`) REFERENCES `t_branchadmin` (`BranchAdminId`),
  ADD CONSTRAINT `t_assettransfer_ibfk_5` FOREIGN KEY (`approvedByITstaffId`) REFERENCES `t_itstaff` (`ITstaffId`);

--
-- Constraints for table `t_branch`
--
ALTER TABLE `t_branch`
  ADD CONSTRAINT `t_branch_ibfk_1` FOREIGN KEY (`DistrictId`) REFERENCES `t_district` (`DistrictId`);

--
-- Constraints for table `t_branchadmin`
--
ALTER TABLE `t_branchadmin`
  ADD CONSTRAINT `t_branchadmin_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_itstaff`
--
ALTER TABLE `t_itstaff`
  ADD CONSTRAINT `t_itstaff_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_notifs`
--
ALTER TABLE `t_notifs`
  ADD CONSTRAINT `t_notifs_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`);

--
-- Constraints for table `t_ticketissues`
--
ALTER TABLE `t_ticketissues`
  ADD CONSTRAINT `fk_ticketissues_issueid` FOREIGN KEY (`IssueId`) REFERENCES `t_issuedtype` (`IssueId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticketissues_subtypeid` FOREIGN KEY (`SubtypeId`) REFERENCES `t_issuedsubtype` (`SubtypeId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ticketissues_ticketid` FOREIGN KEY (`TicketId`) REFERENCES `t_tickets` (`TicketId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `t_tickets`
--
ALTER TABLE `t_tickets`
  ADD CONSTRAINT `t_tickets_ibfk_1` FOREIGN KEY (`EmployeeId`) REFERENCES `t_useremp` (`EmployeeId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_2` FOREIGN KEY (`BranchId`) REFERENCES `t_branch` (`BranchId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_3` FOREIGN KEY (`DistrictId`) REFERENCES `t_district` (`DistrictId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_4` FOREIGN KEY (`AssignedITstaffId`) REFERENCES `t_itstaff` (`ITstaffId`) ON DELETE CASCADE,
  ADD CONSTRAINT `t_tickets_ibfk_5` FOREIGN KEY (`AssetId`) REFERENCES `t_asset` (`AssetId`) ON DELETE CASCADE;

--
-- Constraints for table `t_useremp`
--
ALTER TABLE `t_useremp`
  ADD CONSTRAINT `t_useremp_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `t_users` (`UserId`) ON DELETE CASCADE;

--
-- Constraints for table `t_users`
--
ALTER TABLE `t_users`
  ADD CONSTRAINT `t_users_ibfk_1` FOREIGN KEY (`DistrictId`) REFERENCES `t_district` (`DistrictId`),
  ADD CONSTRAINT `t_users_ibfk_2` FOREIGN KEY (`BranchId`) REFERENCES `t_branch` (`BranchId`),
  ADD CONSTRAINT `t_users_ibfk_3` FOREIGN KEY (`RoleId`) REFERENCES `t_roles` (`RoleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2019 at 12:23 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_upa`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `level` int(20) NOT NULL,
  `main` tinyint(2) NOT NULL DEFAULT '1' COMMENT '0=has Sub Categoru, 1=Main Category',
  `parent_id` int(30) NOT NULL,
  `type_id` int(30) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0 =active , 1=Inactive',
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `level`, `main`, `parent_id`, `type_id`, `status`, `date_updated`) VALUES
(1, 'CCTV', 'Main category for cctv items.', 1, 0, 0, 5, 0, '2019-11-15 11:21:05'),
(2, 'CCTV Camera (Dome Type)', 'CCTV Camera (Dome Type)', 2, 1, 1, 5, 0, '2019-11-15 11:21:25'),
(4, 'CCTV Camera (Pan/ Tilt Zoom)', 'CCTV Camera (Pan/ Tilt Zoom)', 2, 1, 1, 5, 0, '2019-11-15 07:22:11'),
(5, 'FDAS', 'FDAS', 1, 0, 0, 5, 0, '2019-11-15 09:17:51'),
(6, 'Addressable Heat Detector (Add HD)\r\n', 'Addressable Heat Detector (Add HD)\r\n', 2, 1, 5, 5, 0, '2019-11-15 09:18:07'),
(7, 'Addressable Smoke Detector (Add SD)', 'Addressable Smoke Detector (Add SD)', 2, 1, 5, 5, 0, '2019-11-15 09:18:26'),
(8, 'Backhoe, Caterpillar EL240', 'Backhoe, Caterpillar EL240', 1, 0, 0, 1, 0, '2019-11-15 09:20:41'),
(9, 'Bare rental / month', 'Bare rental / month', 2, 1, 8, 1, 0, '2019-11-15 09:21:16'),
(10, 'TEST 101', 'Test Level 1', 1, 0, 0, 3, 0, '2019-11-15 10:10:00'),
(11, 'Test 102', 'Test Level 2 w/sub', 2, 0, 10, 3, 0, '2019-11-15 10:12:13'),
(12, 'test 103', 'test level 2 w/o sub', 2, 1, 10, 3, 0, '2019-11-15 10:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(20) NOT NULL,
  `material_code` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `material_code`, `status`, `date_created`) VALUES
(1, 'M-001', 0, '2019-11-14 10:05:52'),
(2, 'M-002', 0, '2019-11-14 10:48:52'),
(3, 'M-003', 1, '2019-11-14 10:59:43');

-- --------------------------------------------------------

--
-- Table structure for table `materials_meta`
--

CREATE TABLE `materials_meta` (
  `id` int(20) NOT NULL,
  `material_id` int(20) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials_meta`
--

INSERT INTO `materials_meta` (`id`, `material_id`, `meta_field`, `meta_value`, `date_updated`) VALUES
(1, 1, 'id', '', '2019-11-14 10:05:52'),
(2, 1, 'mcode', 'M-001', '2019-11-14 10:05:52'),
(3, 1, 'name', 'Material 101', '2019-11-14 10:05:52'),
(4, 1, 'unit', 'm', '2019-11-14 10:05:52'),
(5, 1, 'description', 'Sample Only', '2019-11-14 10:05:52'),
(6, 1, 'price', '1500', '2019-11-14 10:05:52'),
(7, 1, 'supplier_id', '1', '2019-11-14 10:05:52'),
(8, 1, 'category_id', '2', '2019-11-14 10:05:52'),
(9, 2, 'mcode', 'M-002', '2019-11-14 10:48:52'),
(10, 2, 'name', 'Material 102', '2019-11-14 10:48:52'),
(11, 2, 'unit', 'm', '2019-11-14 10:46:20'),
(12, 2, 'description', 'Sample Only', '2019-11-14 10:46:20'),
(13, 2, 'price', '1500', '2019-11-14 10:46:20'),
(14, 2, 'supplier_id', '3', '2019-11-14 10:46:20'),
(15, 2, 'category_id', '1', '2019-11-14 10:56:09'),
(16, 3, 'mcode', 'M-003', '2019-11-14 10:58:40'),
(17, 3, 'name', 'Material 103', '2019-11-14 10:58:40'),
(18, 3, 'unit', 'pcs', '2019-11-14 10:58:26'),
(19, 3, 'description', 'Sample Onlyyyyy', '2019-11-14 10:58:26'),
(20, 3, 'price', '250', '2019-11-14 10:58:26'),
(21, 3, 'supplier_id', '1', '2019-11-14 10:58:26'),
(22, 3, 'category_id', '3', '2019-11-14 10:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `material_type`
--

CREATE TABLE `material_type` (
  `id` int(20) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `queue` int(11) NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material_type`
--

INSERT INTO `material_type` (`id`, `name`, `description`, `status`, `queue`, `date_updated`) VALUES
(1, 'Equipment', 'Equipment\'s to be use on projects.', 0, 2, '2019-11-15 07:16:31'),
(3, 'Sample 1', 'sample', 0, 4, '2019-11-15 07:16:31'),
(4, 'Sample 2', 'sample 2', 0, 3, '2019-11-15 07:16:31'),
(5, 'Special Construction', 'Special', 0, 1, '2019-11-15 07:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(20) NOT NULL,
  `supplier_code` varchar(30) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_code`, `status`, `date_created`) VALUES
(1, 'SUP-1001', 0, '2019-11-14 06:00:05'),
(2, 'SUP-1002', 1, '2019-11-14 08:40:18'),
(3, 'SUP-1002', 0, '2019-11-14 08:47:57');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers_meta`
--

CREATE TABLE `suppliers_meta` (
  `id` int(20) NOT NULL,
  `supplier_id` int(20) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers_meta`
--

INSERT INTO `suppliers_meta` (`id`, `supplier_id`, `meta_field`, `meta_value`, `updated_date`) VALUES
(1, 1, 'scode', 'SUP-1001', '2019-11-14 06:00:05'),
(2, 1, 'name', 'Supplier 1001', '2019-11-14 06:00:05'),
(3, 1, 'address', 'Address of supplier 1001', '2019-11-14 06:00:05'),
(4, 1, 'description', 'Description place here.', '2019-11-14 06:00:05'),
(6, 2, 'scode', 'SUP-1002', '2019-11-14 06:01:23'),
(7, 2, 'name', 'Supplier 1002', '2019-11-14 06:01:23'),
(8, 2, 'address', 'ajhdkjgajdsb jagdjhagd b', '2019-11-14 06:01:23'),
(9, 2, 'description', 'jsagjhdga jgjahgsdhads', '2019-11-14 06:01:23'),
(10, 3, 'id', '', '2019-11-14 08:47:57'),
(11, 3, 'scode', 'SUP-1002', '2019-11-14 08:47:57'),
(12, 3, 'name', 'Rockbuilt Manufacturing Co.', '2019-11-14 08:47:57'),
(13, 3, 'address', '...', '2019-11-14 08:47:57'),
(14, 3, 'description', '...', '2019-11-14 08:47:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials_meta`
--
ALTER TABLE `materials_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_type`
--
ALTER TABLE `material_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers_meta`
--
ALTER TABLE `suppliers_meta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials_meta`
--
ALTER TABLE `materials_meta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `material_type`
--
ALTER TABLE `material_type`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers_meta`
--
ALTER TABLE `suppliers_meta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

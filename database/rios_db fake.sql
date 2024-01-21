-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2023 at 04:54 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rios_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alert_msg`
--

CREATE TABLE `alert_msg` (
  `id` int(30) NOT NULL,
  `form_id` int(30) NOT NULL,
  `alert_type` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_list`
--

CREATE TABLE `cart_list` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `voucher_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('t0arofp05f4662ataf3lckvfuelucbiq', '::1', 1701314923, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730313331343636373b73797374656d7c613a363a7b733a343a226e616d65223b733a303a22223b733a353a227469746c65223b733a31303a2243616c6c65204c756e61223b733a373a2261646472657373223b733a36333a22506c61726964656c2d416e746f6e696f204c756e612053742e2c20427267792e20312c2053696c617920436974792c204e65672e204f63632e2c2036313136223b733a363a2266625f75726c223b733a33393a2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f63616c6c656c756e61303832312f223b733a353a22656d61696c223b733a32333a2263616c6c656c756e6130383231407961686f6f2e636f6d223b733a343a226c6f676f223b733a33363a2275706c6f6164732f32303230313231393037343634365f72696f735f6c6f676f2e69636f223b7d6d73677c733a31373a2220456d61696c206e6f7420666f756e6421223b5f5f63695f766172737c613a313a7b733a333a226d7367223b733a333a226f6c64223b7d),
('k41cf0eo7cia0ko768phfmk45pdjqoh8', '::1', 1701315280, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730313331353238303b73797374656d7c613a363a7b733a343a226e616d65223b733a303a22223b733a353a227469746c65223b733a31303a2243616c6c65204c756e61223b733a373a2261646472657373223b733a36333a22506c61726964656c2d416e746f6e696f204c756e612053742e2c20427267792e20312c2053696c617920436974792c204e65672e204f63632e2c2036313136223b733a363a2266625f75726c223b733a33393a2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f63616c6c656c756e61303832312f223b733a353a22656d61696c223b733a32333a2263616c6c656c756e6130383231407961686f6f2e636f6d223b733a343a226c6f676f223b733a33363a2275706c6f6164732f32303230313231393037343634365f72696f735f6c6f676f2e69636f223b7d757365725f69647c733a313a2238223b66697273746e616d657c733a353a2261646d696e223b6c6173746e616d657c733a353a2261646d696e223b6163636573735f746f6b656e7c733a303a22223b70686f6e655f6e756d6265727c733a303a22223b656d61696c7c733a32313a22746f6d677573717561726540676d61696c2e636f6d223b747970657c733a313a2231223b7374617475737c733a313a2231223b64656c6574655f666c61677c733a313a2230223b646174655f637265617465647c733a31393a22323032302d30352d30362030303a30343a3137223b),
('ig2phurn109sl7r4d06jmh95hvde2d5h', '::1', 1701315592, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730313331353539323b73797374656d7c613a363a7b733a343a226e616d65223b733a303a22223b733a353a227469746c65223b733a31303a2243616c6c65204c756e61223b733a373a2261646472657373223b733a36333a22506c61726964656c2d416e746f6e696f204c756e612053742e2c20427267792e20312c2053696c617920436974792c204e65672e204f63632e2c2036313136223b733a363a2266625f75726c223b733a33393a2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f63616c6c656c756e61303832312f223b733a353a22656d61696c223b733a32333a2263616c6c656c756e6130383231407961686f6f2e636f6d223b733a343a226c6f676f223b733a33363a2275706c6f6164732f32303230313231393037343634365f72696f735f6c6f676f2e69636f223b7d757365725f69647c733a313a2238223b66697273746e616d657c733a353a2261646d696e223b6c6173746e616d657c733a353a2261646d696e223b6163636573735f746f6b656e7c733a303a22223b70686f6e655f6e756d6265727c733a303a22223b656d61696c7c733a32313a22746f6d677573717561726540676d61696c2e636f6d223b747970657c733a313a2231223b7374617475737c733a313a2231223b64656c6574655f666c61677c733a313a2230223b646174655f637265617465647c733a31393a22323032302d30352d30362030303a30343a3137223b),
('p8jbg19jt5k2ddacje71kr8nrrr6ohfi', '::1', 1701315986, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730313331353938363b73797374656d7c613a363a7b733a343a226e616d65223b733a303a22223b733a353a227469746c65223b733a31303a2243616c6c65204c756e61223b733a373a2261646472657373223b733a36333a22506c61726964656c2d416e746f6e696f204c756e612053742e2c20427267792e20312c2053696c617920436974792c204e65672e204f63632e2c2036313136223b733a363a2266625f75726c223b733a33393a2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f63616c6c656c756e61303832312f223b733a353a22656d61696c223b733a32333a2263616c6c656c756e6130383231407961686f6f2e636f6d223b733a343a226c6f676f223b733a33363a2275706c6f6164732f32303230313231393037343634365f72696f735f6c6f676f2e69636f223b7d757365725f69647c733a313a2238223b66697273746e616d657c733a353a22544f4d4755223b6c6173746e616d657c733a363a22535155415245223b6163636573735f746f6b656e7c733a303a22223b70686f6e655f6e756d6265727c733a303a22223b656d61696c7c733a32313a22746f6d677573717561726540676d61696c2e636f6d223b747970657c733a313a2231223b7374617475737c733a313a2231223b64656c6574655f666c61677c733a313a2230223b646174655f637265617465647c733a31393a22323032302d30352d30362030303a30343a3137223b),
('m6cmf43nrlptu0rjp0niki7e02t2rmrd', '::1', 1701316311, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730313331363331313b73797374656d7c613a363a7b733a343a226e616d65223b733a303a22223b733a353a227469746c65223b733a31303a2243616c6c65204c756e61223b733a373a2261646472657373223b733a36333a22506c61726964656c2d416e746f6e696f204c756e612053742e2c20427267792e20312c2053696c617920436974792c204e65672e204f63632e2c2036313136223b733a363a2266625f75726c223b733a33393a2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f63616c6c656c756e61303832312f223b733a353a22656d61696c223b733a32333a2263616c6c656c756e6130383231407961686f6f2e636f6d223b733a343a226c6f676f223b733a33363a2275706c6f6164732f32303230313231393037343634365f72696f735f6c6f676f2e69636f223b7d757365725f69647c733a313a2238223b66697273746e616d657c733a353a22544f4d4755223b6c6173746e616d657c733a363a22535155415245223b6163636573735f746f6b656e7c733a303a22223b70686f6e655f6e756d6265727c733a303a22223b656d61696c7c733a32313a22746f6d677573717561726540676d61696c2e636f6d223b747970657c733a313a2231223b7374617475737c733a313a2231223b64656c6574655f666c61677c733a313a2230223b646174655f637265617465647c733a31393a22323032302d30352d30362030303a30343a3137223b),
('i30f74a8u43hkqvt5df4fjfiuh3d9huc', '::1', 1701316363, 0x5f5f63695f6c6173745f726567656e65726174657c693a313730313331363331313b73797374656d7c613a363a7b733a343a226e616d65223b733a303a22223b733a353a227469746c65223b733a31303a2243616c6c65204c756e61223b733a373a2261646472657373223b733a36333a22506c61726964656c2d416e746f6e696f204c756e612053742e2c20427267792e20312c2053696c617920436974792c204e65672e204f63632e2c2036313136223b733a363a2266625f75726c223b733a33393a2268747470733a2f2f7777772e66616365626f6f6b2e636f6d2f63616c6c656c756e61303832312f223b733a353a22656d61696c223b733a32333a2263616c6c656c756e6130383231407961686f6f2e636f6d223b733a343a226c6f676f223b733a33363a2275706c6f6164732f32303230313231393037343634365f72696f735f6c6f676f2e69636f223b7d757365725f69647c733a313a2238223b66697273746e616d657c733a353a22544f4d4755223b6c6173746e616d657c733a363a22535155415245223b6163636573735f746f6b656e7c733a303a22223b70686f6e655f6e756d6265727c733a303a22223b656d61696c7c733a32313a22746f6d677573717561726540676d61696c2e636f6d223b747970657c733a313a2231223b7374617475737c733a313a2231223b64656c6574655f666c61677c733a313a2230223b646174655f637265617465647c733a31393a22323032302d30352d30362030303a30343a3137223b);

-- --------------------------------------------------------

--
-- Table structure for table `for_delivery`
--

CREATE TABLE `for_delivery` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0=unread,1=read',
  `type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = user to admin, 1 = admin to user\r\n',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `ref_id` text NOT NULL,
  `onum` text NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=dine-in, 2=take-out, 3=Delivery, 4= pickup',
  `status` int(11) NOT NULL,
  `amount` text NOT NULL,
  `location` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `landmark` text NOT NULL,
  `discount` text NOT NULL,
  `total_amount` text NOT NULL,
  `remarks` text NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref_id`, `onum`, `type`, `status`, `amount`, `location`, `user_id`, `landmark`, `discount`, `total_amount`, `remarks`, `created_date`) VALUES
(1, 'HLJ-3837', '', 1, 0, '350.00', '', 8, '', '', '350.00', '', '2023-11-30 11:33:04'),
(2, 'CNP-5939', '', 1, 0, '310.00', '', 8, '', '', '310.00', '', '2023-11-30 11:33:32'),
(3, 'BEA-0534', '', 2, 0, '335.00', '', 8, '', '', '335.00', '', '2023-11-30 11:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `price` text NOT NULL,
  `qty` int(30) NOT NULL,
  `total_amount` text NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`id`, `order_id`, `product_id`, `price`, `qty`, `total_amount`, `status`, `date_created`) VALUES
(1, 1, 5, '65', 1, '65', 1, '2023-11-30 11:33:04'),
(2, 1, 7, '25', 1, '25', 1, '2023-11-30 11:33:04'),
(3, 1, 4, '50', 1, '50', 1, '2023-11-30 11:33:04'),
(4, 1, 3, '210', 1, '210', 1, '2023-11-30 11:33:04'),
(5, 2, 8, '35', 1, '35', 1, '2023-11-30 11:33:32'),
(6, 2, 5, '65', 1, '65', 1, '2023-11-30 11:33:32'),
(7, 2, 3, '210', 1, '210', 1, '2023-11-30 11:33:32'),
(8, 3, 11, '300', 1, '300', 1, '2023-11-30 11:34:13'),
(9, 3, 8, '35', 1, '35', 1, '2023-11-30 11:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `pt_id` int(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `price` text NOT NULL,
  `img_path` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `pt_id`, `status`, `price`, `img_path`, `date_created`) VALUES
(17, 'WATER', 'Drinks', 15, 1, '20', 'uploads/products/202311300441_Screenshot2023-11-25153525.png', '2023-11-30 11:41:55'),
(18, 'CHOP SUEY ', 'Noodles', 2, 1, '200', 'uploads/products/202311300444_Screenshot2023-11-25153525.png', '2023-11-30 11:44:43'),
(19, 'BURGER STEAK', 'Pork', 8, 1, '130', 'uploads/products/202311300447_Screenshot2023-11-25153525.png', '2023-11-30 11:47:41'),
(20, 'GRILLED TUNA PANGA', 'Seafoods', 7, 1, '230', 'uploads/products/202311300448_Screenshot2023-11-25153525.png', '2023-11-30 11:48:50'),
(21, 'FRIES', 'Snacks', 9, 1, '65', 'uploads/products/202311300449_Screenshot2023-11-25153525.png', '2023-11-30 11:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `status`, `date_created`) VALUES
(2, 'NOODLES/VEG', 1, '2020-04-04 23:50:23'),
(7, 'SEAFOOD ', 1, '2020-04-05 13:32:16'),
(8, 'PORK/POULTRY', 1, '2020-04-05 17:09:21'),
(9, 'SNACKS', 1, '2020-04-05 17:12:05'),
(15, 'DRINKS', 1, '2023-11-30 11:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `queue_list`
--

CREATE TABLE `queue_list` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `queue` int(30) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `queue_list`
--

INSERT INTO `queue_list` (`id`, `order_id`, `queue`, `status`, `date_created`) VALUES
(1, 1, 1, 1, '2023-11-30 03:33:04'),
(2, 2, 2, 1, '2023-11-30 03:33:32'),
(3, 3, 3, 1, '2023-11-30 03:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(30) NOT NULL,
  `ref_id` text NOT NULL,
  `order_id` int(30) NOT NULL,
  `receipt_no` text NOT NULL,
  `total_amount` text NOT NULL,
  `amount_tendered` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `ref_id`, `order_id`, `receipt_no`, `total_amount`, `amount_tendered`, `date_created`) VALUES
(1, 'HLJ-3837', 1, 'mgX6HMnc3k04', '350.00', '400', '2023-11-30 11:33:04'),
(2, 'BEA-0534', 3, 'hsRvCmo6PjLZ', '335.00', '400', '2023-11-30 11:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `meta_name` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`meta_name`, `meta_value`) VALUES
('system_name', ''),
('system_title', 'Calle Luna'),
('system_address', 'Plaridel-Antonio Luna St., Brgy. 1, Silay City, Neg. Occ., 6116'),
('system_fb_url', 'https://www.facebook.com/calleluna0821/'),
('system_email', 'calleluna0821@yahoo.com'),
('system_logo', 'uploads/20201219074646_rios_logo.ico');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `access_token` text NOT NULL,
  `phone_number` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `type` int(11) NOT NULL DEFAULT 1 COMMENT '1= admin,2=kitchen,3=cashier,4=delivery,5=client,6=Guest Self service',
  `status` int(11) DEFAULT 1 COMMENT '1= active, 2=blocked',
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0= active , 1= deleted',
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `access_token`, `phone_number`, `email`, `password`, `type`, `status`, `delete_flag`, `date_created`) VALUES
(7, 'Kitchen', 'Side', '', '', 'kitchen', '68a7b18d11156c6e806161741f55dc91', 2, 1, 0, '2020-05-05 23:53:40'),
(8, 'TOMGU', 'SQUARE', '', '', 'tomgusquare@gmail.com', '458b4785727b75dcc5529783f86c2f67', 1, 1, 0, '2020-05-06 00:04:17'),
(10, 'test', 'test', '', '', 'test@sample.com', '0192023a7bbd73250516f069df18b500', 5, 1, 0, '2020-05-06 00:24:01'),
(11, 'Cashier', 'Side', '', '', 'cashier', 'dbb8c54ee649f8af049357a5f99cede6', 3, 1, 0, '2020-05-06 00:52:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alert_msg`
--
ALTER TABLE `alert_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_list`
--
ALTER TABLE `cart_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `for_delivery`
--
ALTER TABLE `for_delivery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `queue_list`
--
ALTER TABLE `queue_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
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
-- AUTO_INCREMENT for table `alert_msg`
--
ALTER TABLE `alert_msg`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_list`
--
ALTER TABLE `cart_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `for_delivery`
--
ALTER TABLE `for_delivery`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `queue_list`
--
ALTER TABLE `queue_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

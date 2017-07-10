-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 26, 2016 at 02:19 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tutorial`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand`) VALUES
(8, 'Logitech'),
(9, 'Dell'),
(10, 'Microsoft'),
(11, 'Enter'),
(12, 'iBall'),
(13, 'Zebronics'),
(14, 'Redragon'),
(15, 'HP'),
(16, 'Intex'),
(17, 'Apple'),
(18, 'intel'),
(19, 'MSI'),
(20, 'sony'),
(21, 'canon'),
(22, 'samsung'),
(23, 'epson'),
(24, 'neat'),
(25, 'lenovo');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`, `shipped`) VALUES
(8, '[{"id":"13","size":"Medium","quantity":"4"}]', '2016-11-13 10:17:48', 0, 0),
(9, '[{"id":"17","size":"normal","quantity":"1"}]', '2016-11-13 13:54:58', 0, 0),
(10, '[{"id":"17","size":"normal","quantity":3}]', '2016-11-13 15:40:22', 0, 0),
(11, '[{"id":"15","size":"medium","quantity":"1"},{"id":"13","size":"Medium","quantity":"1"},{"id":"12","size":"Big","quantity":"3"}]', '2016-11-18 09:13:21', 0, 0),
(12, '[{"id":"15","size":"medium","quantity":"1"}]', '2016-11-16 20:38:55', 0, 0),
(13, '[{"id":"13","size":"Big","quantity":2}]', '2016-11-18 09:11:33', 0, 0),
(14, '[{"id":"15","size":"medium","quantity":"2"}]', '2016-11-18 09:12:10', 0, 0),
(15, '[{"id":"15","size":"medium","quantity":"1"}]', '2016-11-18 09:13:56', 0, 0),
(16, '[{"id":"15","size":"medium","quantity":"1"}]', '2016-11-18 17:29:08', 0, 0),
(17, '[{"id":"15","size":"medium","quantity":"1"}]', '2016-11-18 20:49:33', 1, 0),
(18, '[{"id":"16","size":"medium","quantity":"1"}]', '2016-11-18 21:01:34', 1, 0),
(19, '[{"id":"16","size":"medium","quantity":"2"}]', '2016-11-18 21:31:28', 1, 0),
(20, '[{"id":"16","size":"medium","quantity":"2"}]', '2016-11-18 21:35:20', 1, 0),
(21, '[{"id":"17","size":"normal","quantity":"1"},{"id":"15","size":"medium","quantity":"1"}]', '2016-11-18 22:24:30', 0, 0),
(22, '[{"id":"25","size":"small","quantity":"1"}]', '2016-11-19 05:52:53', 1, 0),
(23, '[{"id":"16","size":"large","quantity":"1"}]', '2016-11-19 06:34:08', 1, 0),
(24, '[{"id":"16","size":"large","quantity":1}]', '2016-11-19 21:49:33', 1, 1),
(25, '[{"id":"20","size":"large","quantity":"1"},{"id":"18","size":"medium","quantity":"1"}]', '2016-11-20 08:00:10', 0, 0),
(26, '[{"id":"26","size":"medium","quantity":"1"},{"id":"21","size":"medium","quantity":"1"}]', '2016-11-20 08:01:34', 1, 0),
(27, '[{"id":"25","size":"small","quantity":"1"}]', '2016-11-20 08:18:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(1, 'HardWare', 0),
(2, 'Laptops', 0),
(3, 'Apple', 0),
(4, 'Digital Cameras', 0),
(5, 'Peripherals', 0),
(31, 'Computer Cabinets', 1),
(32, 'Keyboards', 1),
(33, 'Monitors', 1),
(34, 'MotherBoards', 1),
(35, 'Mouse', 1),
(36, 'PSU', 1),
(37, 'Processors', 1),
(38, 'Laptops', 2),
(40, 'Batteries and Chargers', 2),
(42, 'MSI Laptops', 2),
(43, 'Gaming Laptops', 2),
(44, 'Laptop Accessories', 2),
(45, 'MAC PRO', 3),
(46, 'MAC Mini', 3),
(47, 'Macbook', 3),
(48, 'Accessories', 3),
(49, 'Digital Cameras', 4),
(50, 'Digital SLR Cameras', 4),
(51, 'Camera Accessories', 4),
(52, 'CCTV Cameras', 4),
(53, 'CamCorder', 4),
(54, 'Projectors', 5),
(55, 'Printers', 5),
(56, 'Scanners', 5),
(57, 'HeadPhones', 5),
(58, 'DVD Players', 5),
(59, 'Mobiles', 0),
(60, 'Softwares', 0),
(61, 'SmartPhones', 59),
(62, 'Mobile Accessories', 59),
(63, 'Tablets', 59),
(64, 'Operating Systems', 60),
(65, 'Anti-Viruses', 60),
(67, 'Drivers', 60);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`) VALUES
(15, 'mouse', '30.00', '33.00', 9, '35', '/tutorial/images/a2b956294fa5ff36a347d30cc0500930.jpg', '', 1, 'medium:5:2', 0),
(16, 'PSU', '30.99', '45.00', 13, '36', '/tutorial/images/bd511534f9a953675c1c771b198489b6.png', '', 1, 'large:1:2,medium:0:2', 0),
(17, 'i7', '300.00', '325.00', 18, '37', '/tutorial/images/3113186f3a16d39fb659facd62ff9d01.jpg', '', 1, 'normal:5:2', 0),
(18, 'laptop', '10000.00', '10999.00', 9, '38', '/tutorial/images/f267932f52741d81cbfe0ab9ca2bea5f.png', '', 1, 'medium:5:2', 0),
(19, 'laptop battery', '30.00', '33.00', 9, '40', '/tutorial/images/ac6c739caaddb9999940ae86f1afd661.jpg', '', 1, 'medium:5:2', 0),
(20, 'gaming laptop', '15999.00', '16999.00', 19, '43', '/tutorial/images/2f09bdb90be96ea59cdc831e4b12883f.jpg', '', 1, 'large:5:2', 0),
(21, 'mac pro', '150000.00', '169999.00', 17, '45', '/tutorial/images/c6f942dffc67fb9636272595118f600f.jpg', '', 1, 'small:5:,medium:4:', 0),
(22, 'mac mini', '149999.00', '159999.00', 17, '46', '/tutorial/images/5ad44c8bd6af6ad2cc98ffff9417a94e.jpg', '', 1, 'medium:5:2', 0),
(23, 'macbook', '159999.00', '179999.00', 17, '47', '/tutorial/images/d6b58f1a8eb07eef47855fd79e6eb71e.jpg', '', 1, 'medium:10:2', 0),
(24, 'Magic Mouse', '1999.00', '2345.00', 17, '48', '/tutorial/images/d1800deb0e59fc3112236c7905b27ddf.jpg', '', 1, 'medium:20:2', 0),
(25, 'Digital Camera', '2100.00', '2399.00', 20, '49', '/tutorial/images/8468d4c1fc649a5ac13ff7005afac6be.jpg', '', 1, 'small:5:', 0),
(26, 'Digital SLR Camera', '4599.00', '4699.00', 21, '50', '/tutorial/images/58ebae5d6cbce8b043fa900ee562b360.jpg', '', 1, 'medium:9:', 0),
(27, 'Camera Stand Kit', '1299.00', '1599.00', 21, '51', '/tutorial/images/8907e189d0d2ceeae44815c270f53bc4.jpg', '', 1, 'large:6:2', 0),
(28, 'CCTV Camera', '4399.00', '4500.00', 21, '52', '/tutorial/images/5058660acadb0b123ef4d08f935783ea.jpg', '', 1, 'small:5:2', 0),
(29, 'SAMSUNG Camcorder', '2500.00', '2700.00', 22, '53', '/tutorial/images/48b85c4038a1c50cf65c8b08cc34dcf4.jpg', '', 1, 'medium:5:2', 0),
(30, 'EPSON Projector', '1999.00', '2100.00', 23, '54', '/tutorial/images/b9e1c7a8175fee337a2fddf09a65a843.png', '', 1, 'medium:3:2', 0),
(31, 'EPSON Printer', '2799.00', '3000.00', 23, '55', '/tutorial/images/951351827b4dd8e87b5bc5bd706705a4.png', '', 1, 'large:5:2', 0),
(32, 'NEATDESK Scanner', '2999.00', '3199.00', 24, '56', '/tutorial/images/8d14abcf5ed15b0d065cda44e129e495.jpg', '', 1, 'medium:5:2', 0),
(39, 'Test', '56.00', '78.00', 9, '42', '/tutorial/images/a5686a48c12d0072644d330f2ddde5f6.jpg,/tutorial/images/748c007ace7cde716ce5ef05d9df6832.jpg,/tutorial/images/689434ba04b47d17a696a89fcc9b6201.jpg,/tutorial/images/b8a19fa0ced98574c5eb4b419d21bb2d.jpg,/tutorial/images/d5044c294ec796634b539cc217f34d4c.jpg', 'Multi Upload', 0, 'small:5:2', 1),
(41, 'motherboard', '80.00', '89.00', 9, '34', '/tutorial/images/a03fa85c674a96fc9a32d71258797007.jpg', '', 1, 'medium:5:4', 0),
(42, 'Windows', '1599.00', '1499.00', 10, '64', '/tutorial/images/d5f36df368c3d69f1a5cca937578fee8.jpg', 'A Super modified version of windows with many new features....lets buy it....offer limited', 1, '1:3:3', 0),
(43, 'Avira', '959.00', '1000.00', 10, '65', '/tutorial/images/199765628c312363caf721f41cb34f4f.jpg', '', 1, '1:5:7', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `state`, `zip_code`, `country`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(11, 24, 'sudhir meena', 'sureshmeena512@gmail.com', 'NIT Kurukshetra', '', 'Kurukshetra', 'Haryana', '136119', 'India', '30.99', '1.55', '32.54', '1 item from Sudhir Computers', 'pay_on_delivery', '2016-10-21 01:20:08'),
(12, 26, 'sudhir meena', 'sureshmeena512@gmail.com', 'NIT Kurukshetra', '', 'Kurukshetra', 'Haryana', '136119', 'India', '154599.00', '7.00', '154606.00', '2 items from Sudhir Computers', 'pay_on_delivery', '2016-10-21 11:31:59'),
(13, 27, 'sudhir meena', 'sureshmeena512@gmail.com', 'NIT Kurukshetra', 'H-8', 'Kurukshetra', 'Haryana', '136119', 'India', '2100.00', '105.00', '2205.00', '1 item from Sudhir Computers', 'pay_on_delivery', '2016-10-21 11:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permissions`) VALUES
(1, 'Sudhir Meena', 'sureshmeena512@gmail.com', '$2y$10$hlF5u0LmC1rL00i1pigOY.vZ1bRyxqvDcMRY23pMOxeFpZcGJ.wwW', '2016-10-12 02:42:59', '2016-10-22 20:14:12', 'admin,editor'),
(2, 'Shubham Sunny', 'shubhamsahanirockstar1@gmail.com', '$2y$10$CVtBqf8NqGmVqxdYE9s0a.835zQ9Sacl7s7eM0ZA5fihl9UudIcnq', '2016-10-21 11:53:02', '0000-00-00 00:00:00', 'editor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
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
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

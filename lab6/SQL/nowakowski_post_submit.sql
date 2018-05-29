-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 01:25 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpclassspring2018`
--
CREATE DATABASE IF NOT EXISTS `phpclassspring2018` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `phpclassspring2018`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `admin_id` varchar(32) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `can_register` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `user_id`, `can_register`) VALUES
('777d9aca5af64ecb8b3ff0b47a80e2cb', 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `category` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(4, 'TestAdd2'),
(1, 'TestCat1'),
(2, 'TestCat2'),
(8, 'TestImgNotice');

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE `orderitems` (
  `order_id` int(10) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price_paid` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderitems`
--

INSERT INTO `orderitems` (`order_id`, `product_id`, `qty`, `price_paid`) VALUES
(2, 2, 1, 6.66),
(3, 2, 1, 6.66),
(3, 17, 2, 43.21),
(4, 3, 2, 0.99),
(5, 17, 4, 43.21),
(6, 22, 3, 9.99),
(6, 2, 4, 6.66);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shipping_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `shipping_date`) VALUES
(2, 9, '2018-05-27'),
(3, 10, '2018-05-29'),
(4, 10, '2018-05-29'),
(5, 10, '2018-05-29'),
(6, 13, '2018-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `product` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `product`, `price`, `image`) VALUES
(1, 4, 'TEST PRODUCT 1', 500.00, 'uploadtest2.png'),
(2, 1, 'TEST PRODUCT 2', 6.66, NULL),
(3, 2, 'TEST PRODUCT 3', 0.99, 'uploadtest3.png'),
(4, 2, 'TEST PRODUCT 4', 999.99, ''),
(14, 4, 'TestImage1', 12.34, 'uploadtest.png'),
(17, 2, 'TestImage 2', 43.21, 'uploadtest3.png'),
(18, 1, 'TestCat1 Product2', 11.11, NULL),
(19, 1, 'Send Help', 43.19, 'uploadtest2.png'),
(20, 1, 'El Producto', 22.44, NULL),
(21, 2, 'I am not very creative', 7456.32, NULL),
(22, 4, 'Some penguin', 9.99, '220px-Tux.png'),
(23, 4, 'StdMcDefault', 49.98, NULL),
(28, 8, 'UploadNoticeTest', 1.00, 'uploadtest4.png');

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `admin_id` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

INSERT INTO `userinfo` (`user_id`, `first_name`, `last_name`, `admin_id`) VALUES
(7, 'q', 'q', NULL),
(9, 'Dan', 'McTraderGuy', '777d9aca5af64ecb8b3ff0b47a80e2cb'),
(10, 'Generic', 'User', NULL),
(13, 'Qwe', 'Rty', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `created`) VALUES
(9, 'admin@traderdans.net', '$2y$10$K7Owy.TWG6L4XpAC0hm5eevTKD/GIgs7mFa4WRsyt04y57weWH4l2', '2018-05-22 10:06:17'),
(10, 'generic@user.com', '$2y$10$gfYiX7wGtWPiOEBlYOeW/u9ISIMoYI4bBwrRTL3PIuB4nVrPdeRA6', '2018-05-22 10:09:47'),
(13, 'qw@er.ty', '$2y$10$2SYR4BfsXuENcVObrMffR.WylNmISExjNUr2GP/C5mdFkC2Mqh8ui', '2018-05-29 19:22:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD UNIQUE KEY `ndx_userinfo_userid` (`user_id`),
  ADD UNIQUE KEY `ndx_userinfo_adminid` (`admin_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

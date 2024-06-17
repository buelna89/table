-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2023 at 12:51 AM
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
-- Database: `tablemenudb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `secName` varchar(100) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `image`, `firstName`, `secName`, `adminEmail`, `phone`, `password`, `role`) VALUES
(4, '5.jpg', 'IsraTech', 'YT', 'isratech8@gmail.com', '+1 (472) 327-4156', 'isratech.1', 'manager'),
(6, '8.jpg', 'Dimas', 'Aji', 'dimas.aji@gmail.com', '+1 (553) 826-5282', 'isratech.1', 'manager'),
(7, '1.jpg', 'me', 'admin ', 'newsub@gmail.com', '+89987666566', 'new ', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `selectedItemID` int(11) NOT NULL,
  `sessionID` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `foodPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `selectedItemID`, `sessionID`, `qty`, `foodPrice`) VALUES
(1, 53, 'huh92fighvubo914nou92dimeo', 1, 34),
(2, 61, 'huh92fighvubo914nou92dimeo', 2, 48),
(3, 59, 'huh92fighvubo914nou92dimeo', 2, 40),
(4, 45, 'huh92fighvubo914nou92dimeo', 1, 25),
(5, 44, 'huh92fighvubo914nou92dimeo', 2, 20),
(6, 45, 'jnv7ral680p6mdserspiid70e5', 1, 25);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(10) UNSIGNED NOT NULL,
  `sessionID` varchar(255) NOT NULL,
  `foodImage` varchar(255) NOT NULL,
  `foodName` varchar(100) NOT NULL,
  `foodDesc` varchar(255) NOT NULL,
  `foodPrice` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `sessionID`, `foodImage`, `foodName`, `foodDesc`, `foodPrice`, `category`) VALUES
(44, '', 'd1 (5).png', 'Coke', 'This is the description demo for this item. It can be changed in the admin dashboard.', 10, 'soda'),
(45, '', 'p1.png', 'Pizza', 'This is the description demo for this item. It can be changed in the admin dashboard.', 25, 'pizza'),
(46, '', 'p3.png', 'Pizza ', 'This is the description demo for this item. It can be changed in the admin dashboard.', 35, 'pizza'),
(47, '', 'p6.png', 'Pizza', 'This is the description demo for this item. It can be changed in the admin dashboard.', 34, 'pizza'),
(48, '', 'd1 (2).png', 'Sprite', 'This is the description demo for this item. It can be changed in the admin dashboard.', 27, 'soda'),
(49, '', 'd1 (4).png', 'Fanta', 'This is the description demo for this item. It can be changed in the admin dashboard.', 12, 'soda'),
(50, '', 'd1 (6).png', 'Monster Drink', 'This is the description demo for this item. It can be changed in the admin dashboard.', 17, 'soda'),
(52, '', 'f1.png', 'Chiken ribs', 'This is the description demo for this item. It can be changed in the admin dashboard.', 36, 'fries'),
(53, '', 'b3.png', 'Burger', 'This is the description demo for this item. It can be changed in the admin dashboard.', 34, 'burger'),
(54, '', 'b2.png', 'Burger', 'This is the description demo for this item. It can be changed in the admin dashboard.', 33, 'burger'),
(55, '', 'b1.png', 'Shawalma', 'This is the description demo for this item. It can be changed in the admin dashboard.', 19, 'burger'),
(56, '', 'f3.png', 'French fries', 'This is the description demo for this item. It can be changed in the admin dashboard.', 32, 'fries'),
(57, '', 'j3.png', 'Juice', 'This is the description demo for this item. It can be changed in the admin dashboard.', 35, 'juice'),
(58, '', 'j2.png', 'Melon Juice', 'This is the description demo for this item. It can be changed in the admin dashboard.', 34, 'juice'),
(59, '', 'j4.png', 'Ovacado Juice', 'This is the description demo for this item. It can be changed in the admin dashboard.', 20, 'juice'),
(60, '', 'j5.png', 'Mango Juice', 'This is the description demo for this item. It can be changed in the admin dashboard.', 17, 'juice'),
(61, '', 'f4.png', 'Fries', 'This is the description demo for this item. It can be changed in the admin dashboard.', 24, 'fries');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `cartID` int(11) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `tableNumber` int(11) NOT NULL,
  `totalPrice` varchar(255) NOT NULL,
  `orderStatus` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cartID`, `userName`, `tableNumber`, `totalPrice`, `orderStatus`, `phoneNumber`) VALUES
(1, 5, 'Adelia', 1, '167', 'Ordered', '64244834447');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `emailAddress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `emailAddress`) VALUES
(11, 'hello@gmail.com'),
(13, 'Irure non tenetur re');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

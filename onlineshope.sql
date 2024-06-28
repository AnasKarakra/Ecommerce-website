-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 10:51 PM
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
-- Database: `onlineshope`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) NOT NULL,
  `pro_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_amount` int(10) NOT NULL,
  `order_date` date NOT NULL,
  `oreder_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `pro_id`, `user_id`, `order_amount`, `order_date`, `oreder_status`) VALUES
(1, 1200000002, 1, 10, '2024-02-02', 'waiting for processing'),
(2, 1200000002, 1, 30, '2024-02-02', 'waiting for processing'),
(3, 2, 1200000002, 10, '2024-02-02', 'waiting for processing'),
(4, 1200000003, 1200000000, 10, '2024-02-02', 'waiting for processing'),
(5, 1, 1200000000, 3600, '2024-02-02', 'waiting for processing'),
(6, 1200000003, 1200000002, 30, '2024-02-02', 'waiting for processing'),
(7, 1200000004, 1200000000, 15, '2024-02-02', 'waiting for processing'),
(8, 1200000004, 1200000000, 15, '2024-02-02', 'waiting for processing'),
(9, 1200000004, 1200000000, 15, '2024-02-02', 'waiting for processing'),
(10, 1200000004, 1200000000, 15, '2024-02-02', 'waiting for processing'),
(11, 1, 1200000000, 480, '2024-02-02', 'waiting for processing'),
(12, 1, 1200000000, 360, '2024-02-02', 'waiting for processing');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `pro_price` decimal(10,2) NOT NULL,
  `pro_cat` varchar(255) DEFAULT NULL,
  `pro_quantity` int(11) DEFAULT NULL,
  `pro_size` varchar(255) DEFAULT NULL,
  `pro_des` text DEFAULT NULL,
  `pro_remarks` text DEFAULT NULL,
  `pro_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pro_name`, `pro_price`, `pro_cat`, `pro_quantity`, `pro_size`, `pro_des`, `pro_remarks`, `pro_image`) VALUES
(1, 'new', 120.00, 'high_demand', 10, 'large', 'sadfdas', 'asdfsdaf', ''),
(2, 'anas', 10.00, 'high_demand', 55, 'large', 'for anas', 'if you need it', ''),
(1200000000, 'dsgf', 10.00, 'normal', 20, 'large', 'dsfasdgf', 'asdfasdf', ''),
(1200000001, 'food', 10.00, 'new_arrival', 10, 'large', 'sadfdas', 'asdffdsa', ''),
(1200000002, 'anas', 10.00, 'high_demand', 40, 'large', 'for anas', 'if you need it', ''),
(1200000003, 'anas', 10.00, 'high_demand', 10, 'large', 'for anas', 'if you need it', ''),
(1200000004, 'new', 15.00, 'new_arrival', 10, 'large', 'for anas', 'asdffdsa', 'images/new_1706809844.jpeg'),
(1200000005, 'fsdaf', 10.00, 'on_sale', 30, 'sdfas', 'asdf', 'asdf', 'images/fsdaf_1706894072.jpeg'),
(1200000006, 'sadf', 90.00, 'normal', 3, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isadmin` int(1) NOT NULL DEFAULT 0,
  `dob` date NOT NULL,
  `Address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `creditcardnumber` int(11) NOT NULL,
  `expirationdate` varchar(255) NOT NULL,
  `cardname` varchar(255) NOT NULL,
  `issuedbank` varchar(255) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `isadmin`, `dob`, `Address`, `email`, `tel`, `creditcardnumber`, `expirationdate`, `cardname`, `issuedbank`, `idnumber`, `name`) VALUES
(1200000000, 'anaskarakra', '123123123', 0, '0000-00-00', 'sinjel', 'anaskrakra@gmail.com', '+059700592291824', 123456789, '5/11', 'visa', 'arabBanke', 123456789, 'anas ahmad'),
(1200000001, 'anaskarakra2', '123456789', 1, '2024-01-03', 'sinjel', 'anasahmad@gamil.com', '84651', 8465132, '5/11', 'akfdjl', 'adfjslk', 1200467, 'anas'),
(1200000002, 'hassankarakra', '123123123', 0, '2024-01-03', 'sinjel', 'hassan@gmail.com', '4865', 85462, '55/1', 'fasdhkj', 'afsjd', 6451, 'hassan'),
(1200000003, 'anasAhmad', '123123123', 0, '2024-01-04', 'sinjel', 'anaskrakra@gmail.com', '8645132', 512, '46512', 'gfgfds', 'asgfa', 85462, 'anasahmad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1200000007;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1200000004;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

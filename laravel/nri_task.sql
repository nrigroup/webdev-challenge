-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2017 at 07:16 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nri_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `csv_auction_lots`
--

CREATE TABLE `csv_auction_lots` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(64) NOT NULL,
  `lot_title` varchar(64) NOT NULL,
  `lot_location` varchar(255) NOT NULL,
  `lot_condition` varchar(64) NOT NULL,
  `pre_tax_amount` decimal(11,2) NOT NULL DEFAULT '0.00',
  `tax_name` varchar(64) NOT NULL,
  `tax_amount` decimal(11,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='csv auction data gets input here';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `csv_auction_lots`
--
ALTER TABLE `csv_auction_lots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `csv_auction_lots`
--
ALTER TABLE `csv_auction_lots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

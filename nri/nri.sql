-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2015 at 12:09 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nri`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_items`
--

CREATE TABLE IF NOT EXISTS `auction_items` (
`auction_item_id` int(10) unsigned NOT NULL,
  `auction_item_date` date NOT NULL,
  `item_category_id` smallint(5) unsigned NOT NULL,
  `auction_item_lot_title` varchar(255) NOT NULL,
  `auction_item_lot_location` varchar(255) NOT NULL,
  `item_condition_id` smallint(5) unsigned NOT NULL,
  `auction_item_pre_tax_amount` float unsigned NOT NULL,
  `auction_item_tax_name` varchar(50) NOT NULL,
  `auction_item_tax_amount` float unsigned NOT NULL,
  `aution_item_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `csv_files`
--

CREATE TABLE IF NOT EXISTS `csv_files` (
`csv_file_id` int(10) unsigned NOT NULL,
  `csv_file_orignal_name` varchar(255) NOT NULL,
  `csv_file_new_name` varchar(50) NOT NULL,
  `csv_file_items_count` mediumint(8) unsigned NOT NULL COMMENT 'number of items in a CSV file',
  `csv_file_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `csv_files_to_auction_items`
--

CREATE TABLE IF NOT EXISTS `csv_files_to_auction_items` (
`csv_file_to_auction_item_id` int(10) unsigned NOT NULL,
  `csv_file_id` int(10) unsigned NOT NULL,
  `auction_item_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_categories`
--

CREATE TABLE IF NOT EXISTS `items_categories` (
`item_category_id` smallint(5) unsigned NOT NULL,
  `item_category_name` varchar(255) NOT NULL,
  `item_category_count` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'Number of items attached to a category',
  `item_category_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items_conditions`
--

CREATE TABLE IF NOT EXISTS `items_conditions` (
`item_condition_id` smallint(5) unsigned NOT NULL,
  `item_condition_name` varchar(255) NOT NULL,
  `item_condition_count` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'items attached to a condition',
  `item_condition_entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction_items`
--
ALTER TABLE `auction_items`
 ADD PRIMARY KEY (`auction_item_id`), ADD KEY `auction_category_id` (`item_category_id`), ADD KEY `item_condition_id` (`item_condition_id`);

--
-- Indexes for table `csv_files`
--
ALTER TABLE `csv_files`
 ADD PRIMARY KEY (`csv_file_id`);

--
-- Indexes for table `csv_files_to_auction_items`
--
ALTER TABLE `csv_files_to_auction_items`
 ADD PRIMARY KEY (`csv_file_to_auction_item_id`), ADD KEY `csv_files_id` (`csv_file_id`,`auction_item_id`);

--
-- Indexes for table `items_categories`
--
ALTER TABLE `items_categories`
 ADD PRIMARY KEY (`item_category_id`), ADD UNIQUE KEY `item_category_name` (`item_category_name`);

--
-- Indexes for table `items_conditions`
--
ALTER TABLE `items_conditions`
 ADD PRIMARY KEY (`item_condition_id`), ADD UNIQUE KEY `item_condition_name` (`item_condition_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction_items`
--
ALTER TABLE `auction_items`
MODIFY `auction_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `csv_files`
--
ALTER TABLE `csv_files`
MODIFY `csv_file_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `csv_files_to_auction_items`
--
ALTER TABLE `csv_files_to_auction_items`
MODIFY `csv_file_to_auction_item_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items_categories`
--
ALTER TABLE `items_categories`
MODIFY `item_category_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items_conditions`
--
ALTER TABLE `items_conditions`
MODIFY `item_condition_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

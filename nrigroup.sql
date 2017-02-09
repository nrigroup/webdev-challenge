-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 01:36 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nrigroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `auctioned_items`
--

CREATE TABLE `auctioned_items` (
  `id` int(11) NOT NULL,
  `date` varchar(10) CHARACTER SET latin1 NOT NULL,
  `category` varchar(250) CHARACTER SET latin1 NOT NULL,
  `lot_title` varchar(250) CHARACTER SET latin1 NOT NULL,
  `lot_location` tinytext CHARACTER SET latin1 NOT NULL,
  `lot_condition` tinytext CHARACTER SET latin1 NOT NULL,
  `pre_tax_amount` decimal(15,2) NOT NULL,
  `tax_name` varchar(250) CHARACTER SET latin1 NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `month` tinyint(2) NOT NULL,
  `year` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `auctioned_items`
--

INSERT INTO `auctioned_items` (`id`, `date`, `category`, `lot_title`, `lot_location`, `lot_condition`, `pre_tax_amount`, `tax_name`, `tax_amount`, `total`, `month`, `year`) VALUES
(978, '12/1/2013', 'Construction', 'Hauling Transfer Trailers', '783 Park Ave, New York, NY 10021', 'Brand New', '350.00', 'NY Sales tax', '31.06', '381.06', 12, 2013),
(979, '12/15/2013', 'Construction', 'Roll-of trucks', ' 1 Infinite Loop, Cupertino, CA 95014', 'Like Brand New', '235.00', 'CA Sales tax', '17.63', '252.63', 12, 2013),
(980, '12/31/2013', 'Construction', 'End dumps', '1 Infinite Loop, Cupertino, CA 95014', 'Used', '999.00', 'CA Sales tax', '74.93', '1073.93', 12, 2013),
(981, '12/14/2013', 'Construction', 'Skid steer loaders', '1 Infinite Loop, Cupertino, CA 95014', 'For parts or not working', '899.00', 'CA Sales tax', '67.43', '966.43', 12, 2013),
(982, '12/6/2013', 'Construction', 'Bobtail dump trucks', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Brand New', '21000.54', 'CA Sales tax', '1575.04', '22575.58', 12, 2013),
(983, '12/9/2013', 'Construction', 'Front loaders'' engines', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'For parts or not working', '50.00', 'CA Sales tax', '3.75', '53.75', 12, 2013),
(984, '11/10/2013', 'Construction', 'Water trucks', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'For parts or not working', '300.00', 'CA Sales tax', '22.50', '322.50', 11, 2013),
(985, '11/12/2013', 'Mining', 'Shovels', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Like Brand New', '230.00', 'CA Sales tax', '17.25', '247.25', 11, 2013),
(986, '11/20/2013', 'Plastics & Rubber', '2kgs; used rubber tires', '783 Park Ave, New York, NY 10021', 'Used', '200.00', 'NY Sales tax', '15.00', '215.00', 11, 2013),
(987, '10/4/2013', 'Mining', 'Assorted Tools', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Used', '200.00', 'CA Sales tax', '15.00', '215.00', 10, 2013),
(988, '10/12/2013', 'Mining', 'Assorted Tools', '783 Park Ave, New York, NY 10021', 'Used', '1999.00', 'NY Sales tax', '177.41', '2176.41', 10, 2013),
(989, '12/9/2013', 'Plastics & Rubber', '2kgs; used rubber tires', 'The Montreal Museum of Fine Arts, 1380 Rue Sherbrooke O, Montreal, QC H3G 1J5', 'Used', '15.00', 'CA Sales tax', '1.13', '16.13', 12, 2013),
(990, '9/18/2013', 'Plastics & Rubber', '20 plastic sheets', '1 Infinite Loop, Cupertino, CA 95014', 'Brand New', '200.00', 'CA Sales tax', '15.00', '215.00', 9, 2013),
(991, '9/30/2013', 'Mining', 'Assorted Tools', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Like Brand New', '200.00', 'CA Sales tax', '15.00', '215.00', 9, 2013),
(992, '12/30/2013', 'Computer - Hardware', 'Dell XPS 13', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Used', '200.00', 'CA Sales tax', '15.00', '215.00', 12, 2013),
(993, '1/6/2014', 'Computer - Hardware', 'Dell XPS 13', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Used', '200.00', 'CA Sales tax', '15.00', '215.00', 1, 2014),
(994, '1/7/2014', 'Computer - Hardware', 'Dell XPS 13', '1 Infinite Loop, Cupertino, CA 95014', 'Used', '200.00', 'CA Sales tax', '15.00', '215.00', 1, 2014),
(995, '2/3/2014', 'Computer - Software', 'MS OFFICE 2016', '1 Infinite Loop, Cupertino, CA 95014', 'Brand New', '12.00', 'CA Sales tax', '0.90', '12.90', 2, 2014),
(996, '2/18/2014', 'Computer - Software', 'MS OFFICE 2016 Bulk', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Brand New', '1500.00', 'CA Sales tax', '112.50', '1612.50', 2, 2014);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Lily', 'lulu@gmail.com', 'hello', NULL, NULL, NULL),
(2, 'Lily', 'lulu1@gmail.com', 'hello', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auctioned_items`
--
ALTER TABLE `auctioned_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- AUTO_INCREMENT for table `auctioned_items`
--
ALTER TABLE `auctioned_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=997;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

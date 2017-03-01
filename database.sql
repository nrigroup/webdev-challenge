-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2017 at 08:59 AM
-- Server version: 5.6.34
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `category` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_location` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lot_condition` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pre_tax_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `date`, `category`, `lot_title`, `lot_location`, `lot_condition`, `pre_tax_amount`, `tax_name`, `tax_amount`) VALUES
(121, '1970-01-01', 'category', 'lot title', 'lot location', 'lot condition', 'pre-tax amount', 'tax name', 'tax amount'),
(122, '2013-12-01', 'Construction', 'Hauling Transfer Trailers', '783 Park Ave, New York, NY 10021', 'Brand New', '350', 'NY Sales tax', '31.06'),
(123, '2013-12-15', 'Construction', 'Roll-of trucks', '1 Infinite Loop, Cupertino, CA 95014', 'Like Brand New', '235', 'CA Sales tax', '17.63'),
(124, '2013-12-31', 'Construction', 'End dumps', '1 Infinite Loop, Cupertino, CA 95014', 'Used', '999', 'CA Sales tax', '74.93'),
(125, '2013-12-14', 'Construction', 'Skid steer loaders', '1 Infinite Loop, Cupertino, CA 95014', 'For parts or not working', '899', 'CA Sales tax', '67.43'),
(126, '2013-12-06', 'Construction', 'Bobtail dump trucks', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Brand New', '21000.54', 'CA Sales tax', '1575.04'),
(127, '2013-12-09', 'Construction', 'Front loaders\' engines', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'For parts or not working', '50', 'CA Sales tax', '3.75'),
(128, '2013-11-10', 'Construction', 'Water trucks', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'For parts or not working', '300', 'CA Sales tax', '22.5'),
(129, '2013-11-12', 'Mining', 'Shovels', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Like Brand New', '230', 'CA Sales tax', '17.25'),
(130, '2013-11-20', 'Plastics & Rubber', '2kgs; used rubber tires', '783 Park Ave, New York, NY 10021', 'Used', '200', 'NY Sales tax', '15'),
(131, '2013-10-04', 'Mining', 'Assorted Tools', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Used', '200', 'CA Sales tax', '15'),
(132, '2013-10-12', 'Mining', 'Assorted Tools', '783 Park Ave, New York, NY 10021', 'Used', '1999', 'NY Sales tax', '177.41'),
(133, '2013-12-09', 'Plastics & Rubber', '2kgs; used rubber tires', 'The Montreal Museum of Fine Arts, 1380 Rue Sherbrooke O, Montréal, QC H3G 1J5', 'Used', '15', 'CA Sales tax', '1.13'),
(134, '2013-09-18', 'Plastics & Rubber', '20” plastic sheets', '1 Infinite Loop, Cupertino, CA 95014', 'Brand New', '200', 'CA Sales tax', '15'),
(135, '2013-09-30', 'Mining', 'Assorted Tools', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Like Brand New', '200', 'CA Sales tax', '15'),
(136, '2013-12-30', 'Computer - Hardware', 'Dell XPS 13', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Used', '200', 'CA Sales tax', '15'),
(137, '2014-01-06', 'Computer - Hardware', 'Dell XPS 13', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Used', '200', 'CA Sales tax', '15'),
(138, '2014-01-07', 'Computer - Hardware', 'Dell XPS 13', '1 Infinite Loop, Cupertino, CA 95014', 'Used', '200', 'CA Sales tax', '15'),
(139, '2014-02-03', 'Computer – Software', 'MS OFFICE 2016', '1 Infinite Loop, Cupertino, CA 95014', 'Brand New', '12', 'CA Sales tax', '0.9'),
(140, '2014-02-18', 'Computer – Software', 'MS OFFICE 2016 Bulk', '1600 Amphitheatre Parkway, Mountain View, CA 94043', 'Brand New', '1500', 'CA Sales tax', '112.5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

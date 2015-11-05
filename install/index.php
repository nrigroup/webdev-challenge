<?php
include("../site.inc.php");

$con=mysqli_connect("localhost",$username,$password,$database);
if (mysqli_connect_errno()) print "Failed to connect to MySQL: " . mysqli_connect_error();

$category_tbl="CREATE TABLE IF NOT EXISTS `category_tbl` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category` (`category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$items_tbl="CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auction_date` varchar(25) NOT NULL,
  `category` int(11) NOT NULL,
  `lot_title` tinytext NOT NULL,
  `lot_location` int(11) NOT NULL,
  `lot_condition` int(11) NOT NULL,
  `pre_tax_amount` decimal(10,2) NOT NULL,
  `tax_name` int(11) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;";

$lot_condition_tbl="CREATE TABLE IF NOT EXISTS `lot_condition_tbl` (
  `lot_condition_id` int(11) NOT NULL AUTO_INCREMENT,
  `lot_condition` varchar(255) NOT NULL,
  PRIMARY KEY (`lot_condition_id`),
  UNIQUE KEY `lot_condition` (`lot_condition`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$lot_location_tbl="CREATE TABLE IF NOT EXISTS `lot_location_tbl` (
  `lot_location_id` int(11) NOT NULL AUTO_INCREMENT,
  `lot_location` varchar(255) NOT NULL,
  PRIMARY KEY (`lot_location_id`),
  UNIQUE KEY `lot_location` (`lot_location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

$tax_name_tbl="CREATE TABLE IF NOT EXISTS `tax_name_tbl` (
  `tax_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) NOT NULL,
  PRIMARY KEY (`tax_name_id`),
  UNIQUE KEY `tax_name` (`tax_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";

mysqli_query($con,$category_tbl);
mysqli_query($con,$items_tbl);
mysqli_query($con,$lot_condition_tbl);
mysqli_query($con,$lot_location_tbl);
mysqli_query($con,$tax_name_tbl);

mysqli_close($con);
?>
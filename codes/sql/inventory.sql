CREATE TABLE `inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `category` int(11) NOT NULL,
  `lot_title` varchar(50) NOT NULL,
  `lot_location` varchar(255) NOT NULL,
  `lot_condition` int(11) NOT NULL,
  `pre_tax_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_name` int(11) NOT NULL,
  `tax_amount` decimal(10,0) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8


CREATE DATABASE IF NOT EXISTS `nri` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `nri`;

CREATE TABLE `csv` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `csv_date` datetime NOT NULL,
  `category` varchar(128) NOT NULL,
  `lot_title` varchar(256) NOT NULL,
  `lot_location` tinytext NOT NULL,
  `lot_condition` varchar(100) NOT NULL,
  `pre_tax_amount` double NOT NULL,
  `tax_name` varchar(100) NOT NULL,
  `tax_amount` double NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `csv`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `csv`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
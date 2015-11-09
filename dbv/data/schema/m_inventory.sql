CREATE TABLE `m_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Vaccine_name` varchar(30) NOT NULL,
  `max_stock` int(11) NOT NULL,
  `min_stock` int(11) NOT NULL,
  `period_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
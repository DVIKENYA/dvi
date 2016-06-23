CREATE TABLE `m_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_by` varchar(100) NOT NULL,
  `date_created` date NOT NULL,
  `station_level` int(11) NOT NULL,
  `station_id` varchar(100) NOT NULL,
  `order_destination` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
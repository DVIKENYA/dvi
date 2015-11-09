CREATE TABLE `m_physical_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vaccine_id` int(11) NOT NULL,
  `batch_number` varchar(20) NOT NULL,
  `date_of_count` date NOT NULL,
  `available_quantity` int(11) NOT NULL,
  `physical_count` int(11) NOT NULL,
  `discrepancy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
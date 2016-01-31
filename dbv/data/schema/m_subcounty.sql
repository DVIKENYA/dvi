CREATE TABLE `m_subcounty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcounty_name` varchar(255) NOT NULL,
  `county_id` int(14) NOT NULL,
  `population` int(48) NOT NULL,
  `population_one` int(48) NOT NULL,
  `population_women` int(48) NOT NULL,
  `no_facilities` int(48) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
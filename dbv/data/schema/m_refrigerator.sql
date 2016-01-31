CREATE TABLE `m_refrigerator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make_model` varchar(32) NOT NULL,
  `temp_monitor_no` int(11) NOT NULL,
  `main_power_source` varchar(32) NOT NULL,
  `backup_power_source` varchar(32) NOT NULL,
  `refrigerator_age` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
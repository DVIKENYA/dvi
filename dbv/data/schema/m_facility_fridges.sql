CREATE TABLE `m_facility_fridges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `facility_id` int(11) NOT NULL,
  `refrigerator_id` int(11) NOT NULL,
  `temperature_monitor_no` int(11) NOT NULL,
  `main_power_source` varchar(32) NOT NULL,
  `backup_power_source` varchar(32) NOT NULL,
  `refrigerator_age` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
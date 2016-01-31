CREATE TABLE `m_depot` (
  `id` int(14) NOT NULL AUTO_INCREMENT,
  `depot_name` varchar(255) NOT NULL,
  `depot_level` varchar(32) NOT NULL,
  `region_id` varchar(255) NOT NULL,
  `county_id` varchar(255) NOT NULL,
  `subcounty_id` varchar(255) NOT NULL,
  `elec_status` varchar(4) NOT NULL,
  `officer_incharge` varchar(48) NOT NULL,
  `email` text NOT NULL,
  `phone` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
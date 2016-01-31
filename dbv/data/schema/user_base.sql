CREATE TABLE `user_base` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `national` int(11) DEFAULT NULL,
  `region` int(11) DEFAULT NULL,
  `county` int(11) DEFAULT NULL,
  `subcounty` int(11) DEFAULT NULL,
  `facility` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
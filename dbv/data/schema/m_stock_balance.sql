CREATE TABLE `m_stock_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vaccine_id` int(11) NOT NULL,
  `batch_number` varchar(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `stock_balance` int(11) NOT NULL,
  `last_update` date NOT NULL,
  `vvm_status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
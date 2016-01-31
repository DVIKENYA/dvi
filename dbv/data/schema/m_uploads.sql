CREATE TABLE `m_uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(200) NOT NULL,
  `raw_name` varchar(200) NOT NULL,
  `file_type` varchar(20) NOT NULL,
  `full_path` varchar(1000) NOT NULL,
  `upload_date` date NOT NULL,
  `published` varchar(50) NOT NULL,
  `purpose` varchar(250) NOT NULL,
  `owner` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
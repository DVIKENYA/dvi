-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2015 at 02:31 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dvi`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_stock_balance`
--

CREATE TABLE IF NOT EXISTS `m_stock_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vaccine_id` int(11) NOT NULL,
  `batch_number` varchar(11) NOT NULL,
  `expiry_date` date NOT NULL,
  `stock_balance` int(11) NOT NULL,
  `last_update` date NOT NULL,
  `vvm_status` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `m_stock_balance`
--

INSERT INTO `m_stock_balance` (`id`, `vaccine_id`, `batch_number`, `expiry_date`, `stock_balance`, `last_update`, `vvm_status`, `user_id`) VALUES
(1, 11, 'TEST2', '2016-02-06', 770, '2015-09-01', '2', 0),
(2, 11, 'TEST1', '2016-02-06', 500, '2015-09-01', '1', 0),
(3, 12, 'TEST1', '2015-10-21', -1389, '2015-10-22', '2', 0),
(4, 14, 'TEST1', '2015-10-21', -961, '2015-10-22', '2', 0),
(5, 12, 'TEST1', '2015-10-21', -1389, '2015-10-22', '2', 0),
(6, 14, 'TEST2', '2015-10-07', 180, '2015-10-27', '2', 0),
(7, 11, 'TEST2', '2015-11-28', 800, '2015-11-04', '3', 13),
(8, 11, 'TEST2', '2015-11-28', 800, '2015-11-04', '3', 13),
(9, 12, 'TEST2', '2015-11-26', 320, '2015-11-04', '2', 13),
(10, 11, 'TEST2', '2015-11-26', 430, '2015-11-04', '2', 14),
(11, 12, 'TEST2', '2015-11-20', 670, '2015-11-05', '3', 14),
(12, 13, 'TEST2', '2015-10-21', 210, '2015-11-05', '1', 14),
(13, 14, 'TEST2', '2015-11-20', 780, '2015-11-05', '2', 14),
(14, 14, 'TEST2', '2015-11-20', 780, '2015-11-05', '2', 14);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
-- Table structure for table `m_stock_movement`
--

CREATE TABLE IF NOT EXISTS `m_stock_movement` (
  `stock_id` int(11) NOT NULL AUTO_INCREMENT,
  `vaccine_id` int(11) DEFAULT NULL,
  `batch_number` varchar(11) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_type` int(11) DEFAULT NULL,
  `s11` varchar(255) DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `destination` int(11) DEFAULT NULL,
  `quantity_in` int(11) DEFAULT NULL,
  `quantity_out` int(11) DEFAULT NULL,
  `physical_count` int(11) DEFAULT NULL,
  `disparity_reason` text,
  `VVM_status` int(11) DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `m_stock_movement`
--

INSERT INTO `m_stock_movement` (`stock_id`, `vaccine_id`, `batch_number`, `expiry_date`, `transaction_date`, `transaction_type`, `s11`, `source`, `destination`, `quantity_in`, `quantity_out`, `physical_count`, `disparity_reason`, `VVM_status`, `order_number`, `user_id`) VALUES
(1, 11, 'TEST2', '2015-10-07', '0000-00-00', 2, '356458485', NULL, 12, NULL, 800, NULL, NULL, 0, NULL, 13),
(2, 11, 'TEST2', '2015-11-28', '2015-11-04', 1, '2382323', 12, NULL, 800, NULL, NULL, NULL, 3, NULL, 13),
(3, 11, 'TEST2', '2015-11-28', '2015-11-04', 1, '2382323', 12, NULL, 800, NULL, NULL, NULL, 3, NULL, 13),
(4, 12, 'TEST1', '2015-10-21', '0000-00-00', 2, '2312', NULL, 22, NULL, 430, NULL, NULL, 0, NULL, 13),
(5, 12, 'TEST2', '2015-11-26', '2015-11-04', 1, '10', 1, NULL, 320, NULL, NULL, NULL, 2, NULL, 13),
(6, 11, 'TEST1', '2015-10-21', '0000-00-00', 2, '2312', NULL, 22, NULL, 290, NULL, NULL, 0, NULL, 14),
(7, 11, 'TEST2', '2015-11-26', '2015-11-04', 1, '10', 34, NULL, 430, NULL, NULL, NULL, 2, NULL, 14),
(8, 12, 'TEST1', '2015-10-21', '0000-00-00', 2, '10', NULL, 22, NULL, 780, NULL, NULL, 0, NULL, 14),
(9, 12, 'TEST2', '2015-11-20', '2015-11-05', 1, '10', 1, NULL, 670, NULL, NULL, NULL, 3, NULL, 14),
(10, 13, 'TEST2', '2015-10-21', '2015-11-05', 1, '10', 1, NULL, 210, NULL, NULL, NULL, 1, NULL, 14),
(11, 14, 'TEST2', '2015-11-20', '2015-11-05', 1, '10', 1, NULL, 780, NULL, NULL, NULL, 2, NULL, 14),
(12, 14, 'TEST2', '2015-11-20', '2015-11-05', 1, '10', 1, NULL, 780, NULL, NULL, NULL, 2, NULL, 14);

--
-- Triggers `m_stock_movement`
--
DROP TRIGGER IF EXISTS `new_stock_balance`;
DELIMITER //
CREATE TRIGGER `new_stock_balance` AFTER INSERT ON `m_stock_movement`
 FOR EACH ROW begin
 IF (new.transaction_type = 1) THEN 
INSERT INTO m_stock_balance (vaccine_id, batch_number, expiry_date, stock_balance,last_update,vvm_status,user_id)
Values (new.vaccine_id,new.batch_number,new.expiry_date,new.quantity_in,new.transaction_date,new.vvm_status,new.user_id);


ELSE if(new.transaction_type =2 )THEN
UPDATE m_stock_balance
SET stock_balance= (stock_balance - new.quantity_out)
WHERE batch_number= new.batch_number AND expiry_date=new.expiry_date;

END IF;
END IF;
END
//
DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

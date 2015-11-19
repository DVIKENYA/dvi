-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2015 at 05:29 PM
-- Server version: 5.6.25
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dvi`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_mfridge`
--

CREATE TABLE IF NOT EXISTS `m_mfridge` (
  `id` int(10) NOT NULL,
  `model` varchar(100) NOT NULL,
  `user_id` int(10) NOT NULL,
  `date_added` date NOT NULL,
  `station_level` int(10) NOT NULL,
  `station_id` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_mfridge`
--

INSERT INTO `m_mfridge` (`id`, `model`, `user_id`, `date_added`, `station_level`, `station_id`) VALUES
(2, '2', 14, '2015-11-15', 3, 'Baringo County'),
(3, '2', 14, '2015-11-15', 3, 'Baringo County'),
(4, '2', 14, '2015-11-15', 3, 'Baringo County'),
(5, '2', 14, '2015-11-15', 3, 'Baringo County'),
(6, '2', 14, '2015-11-15', 3, 'Baringo County'),
(41, '0', 14, '2015-11-16', 3, 'Baringo County'),
(42, '11', 14, '2015-11-16', 3, 'Baringo County'),
(43, '11', 14, '2015-11-16', 3, 'Baringo County'),
(44, '2', 14, '2015-11-16', 3, 'Baringo County'),
(45, '2', 14, '2015-11-16', 3, 'Baringo County');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_mfridge`
--
ALTER TABLE `m_mfridge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_mfridge`
--
ALTER TABLE `m_mfridge`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

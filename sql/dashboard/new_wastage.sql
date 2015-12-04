-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2015 at 07:05 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dvidb`
--

-- --------------------------------------------------------

--
-- Structure for view `new_wastage`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `new_wastage` AS select `v`.`UnitId` AS `UnitID`,`v`.`bcgwastage` AS `BCG`,`v`.`dptwastage` AS `DPT`,`v`.`measleswastage` AS `MEASLES`,`v`.`opvwastage` AS `OPV`,`v`.`pcvwastage` AS `PCV`,`v`.`yellowfevwastage` AS `YELLOWFEVER`,`s`.`id` AS `facility`,`s`.`region_id` AS `region`,`s`.`county_id` AS `county`,`s`.`subcounty_id` AS `subcounty` from (`new_wastage_unitdid` `v` join `m_facility` `s`) where (`v`.`UnitId` = convert(`s`.`dhis_id` using utf8));

--
-- VIEW  `new_wastage`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

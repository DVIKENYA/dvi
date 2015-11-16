-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 04:19 PM
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
-- Structure for view `wastage_view_userlevel`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `wastage_view_userlevel` AS select `view_wastage_unitid`.`UnitId` AS `UnitId`,`view_wastage_unitid`.`bcgwastage` AS `bcgwastage`,`view_wastage_unitid`.`dptwastage` AS `dptwastage`,`view_wastage_unitid`.`measleswastage` AS `measleswastage`,`view_wastage_unitid`.`opvwastage` AS `opvwastage`,`view_wastage_unitid`.`pcvwastage` AS `pcvwastage`,`view_wastage_unitid`.`ttwastage` AS `ttwastage`,`view_wastage_unitid`.`vita1wastage` AS `vita1wastage`,`view_wastage_unitid`.`vita2wastage` AS `vita2wastage`,`view_wastage_unitid`.`vita5wastage` AS `vita5wastage`,`view_wastage_unitid`.`yellowfevwastage` AS `yellowfevwastage`,`m_facility`.`id` AS `facility`,`m_facility`.`region_id` AS `region`,`m_facility`.`county_id` AS `county`,`m_facility`.`subcounty_id` AS `subcounty` from (`view_wastage_unitid` join `m_facility` on((`view_wastage_unitid`.`UnitId` = convert(`m_facility`.`dhis_id` using utf8))));

--
-- VIEW  `wastage_view_userlevel`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

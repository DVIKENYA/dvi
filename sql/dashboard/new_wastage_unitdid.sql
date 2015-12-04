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
-- Structure for view `new_wastage_unitdid`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `new_wastage_unitdid` AS select `view_wastage_unitid`.`UnitId` AS `UnitId`,((`view_wastage_unitid`.`bcgwastage` - `view_wastage_unitid`.`bcgdosesadm`) / `view_wastage_unitid`.`bcgwastage`) AS `bcgwastage`,((`view_wastage_unitid`.`dptwastage` - `view_wastage_unitid`.`dpt1dosesadm`) / `view_wastage_unitid`.`dptwastage`) AS `dptwastage`,((`view_wastage_unitid`.`measleswastage` - `view_wastage_unitid`.`bcgdosesadm`) / `view_wastage_unitid`.`measleswastage`) AS `measleswastage`,((`view_wastage_unitid`.`opvwastage` - `view_wastage_unitid`.`opv1dosesadm`) / `view_wastage_unitid`.`opvwastage`) AS `opvwastage`,((`view_wastage_unitid`.`pcvwastage` - `view_wastage_unitid`.`pneumococal1adm`) / `view_wastage_unitid`.`pcvwastage`) AS `pcvwastage`,((`view_wastage_unitid`.`yellowfevwastage` - `view_wastage_unitid`.`yellowfeveradm`) / `view_wastage_unitid`.`yellowfevwastage`) AS `yellowfevwastage` from `view_wastage_unitid`;

--
-- VIEW  `new_wastage_unitdid`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

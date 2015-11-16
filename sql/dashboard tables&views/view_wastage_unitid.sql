-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2015 at 04:18 PM
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
-- Structure for view `view_wastage_unitid`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_wastage_unitid` AS select `dvi_dump`.`organisationunitid` AS `UnitId`,((`dvi_dump`.`bcgdosesinstock` + `dvi_dump`.`bcgdosesreceived`) - `dvi_dump`.`bcgdosesremaining`) AS `bcgwastage`,((`dvi_dump`.`dpt+hib+hepbinstock` + `dvi_dump`.`dpt+hib+hepbreceived`) - `dvi_dump`.`dpt+hib+hepbremaining`) AS `dptwastage`,((`dvi_dump`.`measlesinstock` + `dvi_dump`.`measlesreceived`) - `dvi_dump`.`measlesremaining`) AS `measleswastage`,(`dvi_dump`.`opvdosesinstock` - `dvi_dump`.`opvdosesremaining`) AS `opvwastage`,((`dvi_dump`.`pneumococalinstock` + `dvi_dump`.`pneumococalreceived`) - `dvi_dump`.`pneumococalremainin`) AS `pcvwastage`,(`dvi_dump`.`ttdoseinstock` - `dvi_dump`.`ttdoseremaining`) AS `ttwastage`,(`dvi_dump`.`vitamina100stock` - `dvi_dump`.`vitamina100remain`) AS `vita1wastage`,(`dvi_dump`.`vitamina200stock` - `dvi_dump`.`vitamina200remain`) AS `vita2wastage`,(`dvi_dump`.`vitamina50stock` - `dvi_dump`.`vitamina50remaini`) AS `vita5wastage`,((`dvi_dump`.`yellowfeverinstoc` + `dvi_dump`.`yellowfeverreceive`) - `dvi_dump`.`yellowfeverremaini`) AS `yellowfevwastage` from `dvi_dump`;

--
-- VIEW  `view_wastage_unitid`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

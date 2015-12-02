-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2015 at 08:40 AM
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
-- Structure for view `total_doses_adm`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `total_doses_adm` AS select distinct `dhis_usage`.`periodid` AS `periodid`,`dhis_usage`.`periodname` AS `periodname`,sum(`dhis_usage`.`bcgdoseadm`) AS `BCG`,sum(`dhis_usage`.`dpt1dosesadm`) AS `DPT1`,sum(`dhis_usage`.`dpt3dosesadm`) AS `DPT2`,sum(`dhis_usage`.`measlesdosesadm`) AS `Measles`,sum(`dhis_usage`.`opvbirthdosesadm`) AS `OPV`,sum(`dhis_usage`.`opv1dosesadm`) AS `OPV1`,sum(`dhis_usage`.`opv2dosesadm`) AS `OPV2`,sum(`dhis_usage`.`opv3dosesadm`) AS `OPV3`,sum(`dhis_usage`.`pneumococal1adm`) AS `PCV1`,sum(`dhis_usage`.`pneumococal2adm`) AS `PCV2`,sum(`dhis_usage`.`pneumococal3administered`) AS `PCV3`,sum(`dhis_usage`.`rotavirus1dosesadministered`) AS `ROTA`,sum(`dhis_usage`.`rotavirus2dosesadministered`) AS `ROTA2` from `dhis_usage` group by `dhis_usage`.`periodid`;

--
-- VIEW  `total_doses_adm`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

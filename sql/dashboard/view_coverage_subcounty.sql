-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2015 at 08:41 AM
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
-- Structure for view `view_coverage_subcounty`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_coverage_subcounty` AS select `dvi_dump`.`periodname` AS `periodname`,`dvi_dump`.`bcgdosesadm` AS `bcgdosesadm`,`dvi_dump`.`dpt2dosesadministered` AS `dpt2dosesadministered`,`dvi_dump`.`dpt3dosesadm` AS `dpt3dosesadm`,`dvi_dump`.`measlesdosesadm` AS `measlesdosesadm`,`dvi_dump`.`opvbirthdosesadm` AS `opvbirthdosesadm`,`dvi_dump`.`opv1dosesadm` AS `opv1dosesadm`,`dvi_dump`.`opv2dosesadm` AS `opv2dosesadm`,`dvi_dump`.`opv3dosesadm` AS `opv3dosesadm`,`dvi_dump`.`pneumococal1adm` AS `pneumococal1adm`,`dvi_dump`.`pneumococal2adm` AS `pneumococal2adm`,`dvi_dump`.`pneumococal3administered` AS `pneumococal3administered`,`dvi_dump`.`rotavirus1dosesadministered` AS `rotavirus1dosesadministered`,`dvi_dump`.`rotavirus2dosesadministered` AS `rotavirus2dosesadministered`,`m_facility`.`county_id` AS `county_id`,`m_facility`.`subcounty_id` AS `subcounty_id`,`m_subcounty`.`population_one` AS `population_one` from ((`dvi_dump` join `m_facility` on((`dvi_dump`.`organisationunitid` = convert(`m_facility`.`dhis_id` using utf8)))) join `m_subcounty` on((`m_subcounty`.`id` = `m_facility`.`subcounty_id`)));

--
-- VIEW  `view_coverage_subcounty`
-- Data: None
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
